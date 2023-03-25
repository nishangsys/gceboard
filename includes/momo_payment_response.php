<?php
/*
 * @Author:Dieudonne Dengun
 * @Date: 12/07/2021
 * @Description: Handle momo webhook notification
 */
require_once('momo_payment.php');
$paymentTransactionNotification = json_decode(file_get_contents("php://input"), true);
//check if post request was made by MTN MoMo
if (isset($paymentTransactionNotification['externalId'])) {
    $transactionNumber = $paymentTransactionNotification['financialTransactionId'];
    $paymentReference = $paymentTransactionNotification['externalId'];
    $paymentStatus = $paymentTransactionNotification['status'];
    $connectionHandler = DBConnectionHandler::getInstance();
    //check if reference exist and update payment transaction
    $momoPaymentResponse = new MoMoPaymentResponse($connectionHandler, $paymentReference, $paymentStatus, $transactionNumber);
    $saveTransaction = json_decode($momoPaymentResponse->recordMoMoPaymentConfirmation());
    //check if success
    if ($saveTransaction->status) {
        echo json_encode(['message' => 'success']);
        die();
    }
    die("Payment transaction failed to record or doesn't exist");
}

class MoMoPaymentResponse
{
    private $connectionHandler;
    private $referenceNumber;
    private $transactionNumber;
    private $paymentStatus;

    public function __construct($connectionHandler, $referenceNumber, $paymentStatus, $transactionNumber)
    {
        $this->connectionHandler = $connectionHandler;
        $this->referenceNumber = $referenceNumber;
        $this->transactionNumber = $transactionNumber;
        $this->paymentStatus = $paymentStatus;
    }

    public function recordMoMoPaymentConfirmation()
    {
        //check if payment transaction exist by reference number
        $paymentTransaction = $this->getPaymentTransactionByRef($this->referenceNumber);
        if (empty($paymentTransaction)) {
            return json_encode(['status' => false]);
        }
        //check if transaction had been completed
        if ($paymentTransaction['paymentStatus'] == "COMPLETED") {
            return json_encode(['status' => true]);
        }
        $paymentStatus = $this->paymentStatus == 'SUCCESSFUL' ? "COMPLETED" : "FAILED";
        $transactionNumber = $this->paymentStatus == 'SUCCESSFUL' ? $this->transactionNumber : "";
        //update payment transaction table
        $updated_At = date('Y-m-d H:i:s');
        $updatePaymentTransaction = $this->connectionHandler->query("UPDATE payment_transactions set payment_status='$paymentStatus',updated_at='$updated_At',transaction_id='$transactionNumber' WHERE processing_number='$this->referenceNumber'")
        or die(mysqli_error($this->connectionHandler));
        if ($updatePaymentTransaction === TRUE) {
            if ($paymentStatus == "COMPLETED") {
                //store applicant's payment associated info
                $this->saveApplicationTransaction($paymentTransaction);
                return json_encode(['status' => true]);
            }
        }
    }

    public function saveApplicationTransaction($paymentTransaction)
    {
        $createdAt = date('Y-m-d H:i:s');
        $paymentTransaction = (object)$paymentTransaction;
        $this->connectionHandler->query("INSERT INTO transactions set
            reference='$paymentTransaction->id',
            user_id ='$paymentTransaction->userId',
            amount ='$paymentTransaction->amount',
            year_id ='$paymentTransaction->yearId',
            degree_type_id ='$paymentTransaction->degreeType',
            created_at ='$createdAt',
            updated_at ='$createdAt'
            ");
    }

    public
    function getPaymentTransactionByRef($referenceNumber)
    {
        $query = $this->connectionHandler->query("SELECT * FROM payment_transactions WHERE processing_number='" . $referenceNumber . "'");
        $paymentTransaction = array();
        while ($c = $query->fetch_array()) {
            $paymentTransaction['id'] = $c['id'];
            $paymentTransaction['amount'] = $c['amount'];
            $paymentTransaction['processingNumber'] = $c['processing_number'];
            $paymentTransaction['accountNumber'] = $c['account_number'];
            $paymentTransaction['paymentMotive'] = $c['payment_motive'];
            $paymentTransaction['paymentStatus'] = $c['payment_status'];
            $paymentTransaction['userId'] = $c['payer_id'];
            $paymentTransaction['degreeType'] = $c['degree_type_id'];
            $paymentTransaction['yearId'] = $c['year_id'];
        }
        return $paymentTransaction;
    }
}