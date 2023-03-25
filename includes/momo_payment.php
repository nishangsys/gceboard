<?php
require_once('Helpers.php');
require_once('Uuid.php');
if (isset($_POST['momoPayment'])) {

    //get connection handler instance
    $dbConnectionHandler = DBConnectionHandler::getInstance();
    //get payment input fields
    $momo_account_number = $dbConnectionHandler->real_escape_string($_POST['tel']);
    $degree_type = $dbConnectionHandler->real_escape_string($_POST['deg_type']);
    $error_message = "";
    //validate input fields
    if (!Helpers::validatePaymentInputs($momo_account_number, $degree_type)) {
        $message = "Please kindly enter your momo phone number to continue containing 9 digits";
        $message = "<div class='alert alert-danger  center'>" . $message . "</div>";
        $url = "../Students/index.php?confirm_dtype&id=" . base64_encode($degree_type) . "&message=" . $message;
        Helpers::redirectTo($url);
    }

    //handle momo payment
    @session_start();
    $userId = $_SESSION['userSession'];
    $countryCode = "237";
    $admissionFormFees = Helpers::getDegreeTypeFees($dbConnectionHandler, $degree_type);
    $momo_account_number = $countryCode . $momo_account_number;
    //initiate momo payment handler
    $momoPaymentHandler = new MoMoPaymentProvider($dbConnectionHandler, $userId, $admissionFormFees, $degree_type, $momo_account_number);
    //save payment transaction in DB in an initiated state
    $momoPaymentTransaction = $momoPaymentHandler->savePaymentTransaction();
    //make momo payment request to MoMo APi
    $momoPaymentResponse = $momoPaymentHandler->makeMoMoPaymentRequest($momoPaymentTransaction);
    if ($momoPaymentResponse->status == 202) {
        //redirect user to payment waiting page
        $message = "MoMo request was successfully initiated. <br/>Kindly dial *126# to confirm the payment, 180s maximum to approved payment request.";
        $successMessage = "<div class='alert alert-success center'>" . $message . "</div>";
        $url = "../Students/index.php?momo_confirm&id=" . base64_encode($degree_type);
        //flash session data to request
        $_SESSION['paymentTransaction'] = (object)$momoPaymentTransaction;
        $_SESSION['successMessage'] = $successMessage;
        Helpers::redirectTo($url);
    } else {
        $message = "Whoops! An error occurred while initiating payment request. Please refresh and try again.";
        $errorMessage = "<div class='alert alert-danger'>" . $message . "</div>";
        $url = "../Students/index.php?confirm_dtype&id=" . base64_encode($degree_type) . "&message=" . $errorMessage;
        Helpers::redirectTo($url);
    }
}

//MoMo Payment Class Handler
class MoMoPaymentProvider
{
    private $userId;
    private $amount;
    private $degreeType;
    private $accountNumber;
    private $connectionHandler;

    function __construct($connection_handler, $user_id, $amount, $degree_type, $account_number)
    {
        $this->connectionHandler = $connection_handler;
        $this->userId = $user_id;
        $this->amount = $amount;
        $this->degreeType = $degree_type;
        $this->accountNumber = $account_number;
    }

    function savePaymentTransaction()
    {
        //save payment transaction to DB
        $paymentChannelId = 1;
        $amount = $this->amount;
        $processingNumber = $this->userId . $paymentChannelId . time();
        $paymentMotive = "Admission Application Fees";
        $academicYear = 1;
        $createdAt = date('Y-m-d H:i:s');
        $savePaymentTransaction = $this->connectionHandler->query("INSERT INTO payment_transactions set
            processing_number ='$processingNumber',
            payer_id ='$this->userId',
            account_number='$this->accountNumber',
            payment_channel_id ='$paymentChannelId',
            payment_status='INITIATED',
            transaction_id='',
            amount ='$amount',
            payment_motive ='$paymentMotive',
            transaction_type='CASH_IN',
            year_id ='$academicYear',
            degree_type_id ='$this->degreeType',
            created_at ='$createdAt',
            updated_at ='$createdAt'
            ");
        if ($savePaymentTransaction == TRUE) {
            $paymentID = $this->connectionHandler->insert_id;
            //get saved payment transaction
            $paymentTransaction = $this->getPaymentTransactionById($paymentID);
            return $paymentTransaction;
        }
        return [];
    }

    function getPaymentTransactionById($trans_id)
    {
        $query = $this->connectionHandler->query("SELECT * FROM payment_transactions WHERE id='" . $trans_id . "'")
        or die(mysqli_error($this->connectionHandler));
        $paymentTransaction = array();
        while ($c = $query->fetch_array()) {
            $paymentTransaction['id'] = $c['id'];
            $paymentTransaction['amount'] = $c['amount'];
            $paymentTransaction['processingNumber'] = $c['processing_number'];
            $paymentTransaction['accountNumber'] = $c['account_number'];
            $paymentTransaction['paymentMotive'] = $c['payment_motive'];
            $paymentTransaction['paymentStatus'] = $c['payment_status'];
        }
        return $paymentTransaction;
    }

    function makeMoMoPaymentRequest($paymentTransaction)
    {
        //get momo credentials  from DB
        $momoPaymentCredentials = $this->loadMoMoCredentials();
        //get momo access token
        $paymentAccessToken = $this->getMoMoAccessToken($momoPaymentCredentials);
        //momo details
        $subscriptionKey = $momoPaymentCredentials['subscriptionKey'];
        $paymentUrl = $momoPaymentCredentials['requestToPayUrl'];
        $tagetEnvironment = $momoPaymentCredentials['targetEnvironment'];
        $callBackCred = $momoPaymentCredentials['callBackUrl'];
        $host = "Host: proxy.momoapi.mtn.com";
        $callBackUrl = "X-Callback-Url: " . $callBackCred;
        $paymentRequestReferenceId = (string)Uuid::generate(4);

        //request data;
        $requestBody = array(
            "amount" => $paymentTransaction['amount'],
            "currency" => "XAF",
            "externalId" => $paymentTransaction['processingNumber'],
            "payer" => array("partyIdType" => "MSISDN", "partyId" => $paymentTransaction['accountNumber']),
            "payerMessage" => $paymentTransaction['paymentMotive'],
            "payeeNote" => $paymentRequestReferenceId
        );
        $requestPayload = json_encode($requestBody);
        $requestHeaders = array();
        array_push($requestHeaders, "Authorization: Bearer " . $paymentAccessToken);
        array_push($requestHeaders, "X-Reference-Id: " . $paymentRequestReferenceId);
        array_push($requestHeaders, "X-Target-Environment: " . $tagetEnvironment);
        array_push($requestHeaders, "Ocp-Apim-Subscription-Key: " . $subscriptionKey);
        array_push($requestHeaders, "Content-Type: application/json");
        array_push($requestHeaders, $host);
        array_push($requestHeaders, $callBackUrl);
        //make payment request
        return Helpers::makeHttpCurlRequest($requestPayload, $requestHeaders, $paymentUrl);
    }

    function loadMoMoCredentials()
    {
        $momo_channel = 1;
        $credentials = array();
        $query = $this->connectionHandler->query("SELECT * FROM payment_channel_credentials WHERE payment_channel_id='" . $momo_channel . "'")
        or die(mysqli_error($this->connectionHandler));
        while ($c = $query->fetch_assoc()) {
            if ($c['name'] == "subscriptionKey") {
                $credentials['subscriptionKey'] = $c['value'];
            }
            if ($c['name'] == "targetEnvironment") {
                $credentials['targetEnvironment'] = $c['value'];
            }
            if ($c['name'] == "requestToPayUrl") {
                $credentials['requestToPayUrl'] = $c['value'];
            }
            if ($c['name'] == "referenceId") {
                $credentials['referenceId'] = $c['value'];
            }
            if ($c['name'] == "apiKey") {
                $credentials['apiKey'] = $c['value'];
            }
            if ($c['name'] == "accessTokenUrl") {
                $credentials['accessTokenUrl'] = $c['value'];
            }
            if ($c['name'] == "callBackUrl") {
                $credentials['callBackUrl'] = $c['value'];
            }
            if ($c['name'] == "transferFundsUrl") {
                $credentials['transferFundsUrl'] = $c['value'];
            }
        }
        return $credentials;
    }

    function getMoMoAccessToken($credentials)
    {
        $referenceId = $credentials['referenceId'];
        $apiKey = $credentials['apiKey'];
        $subscriptionKey = $credentials['subscriptionKey'];
        $tokenUrl = $credentials['accessTokenUrl'];
        $targetEnvironment = $credentials['targetEnvironment'];
        $host = "Host: proxy.momoapi.mtn.com";

        $requestHeaders = array();
        array_push($requestHeaders, "Authorization: Basic " . base64_encode($referenceId . ":" . $apiKey));
        array_push($requestHeaders, "Content-Type: application/json");
        array_push($requestHeaders, "Ocp-Apim-Subscription-Key: " . $subscriptionKey);
        array_push($requestHeaders, $host);

        //make curl requets to get access token
        $getAccessTokenResponse = Helpers::makeHttpCurlRequest("", $requestHeaders, $tokenUrl);
        $accessToken = "";
        if ($getAccessTokenResponse->status != 200) {
            return $accessToken;
        }
        $accessToken = json_decode($getAccessTokenResponse->body, true);
        return $accessToken['access_token'];
    }
}

?>
