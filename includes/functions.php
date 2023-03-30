<?php
    //include sms gateway 
    require_once("Helpers.php");
    // Turn off all error reporting
     error_reporting(0); 

    $con = mysqli_connect('localhost','nishang','google1234','gce_board');
    //$con = mysqli_connect('localhost','u182156984_stlouisapp','Cpadmin@123','u182156984_stlouisapp');;        
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
		  
    function dbcon(){
	  static $conn;
    if ($conn===NULL){ 
		$conn = mysqli_connect ('localhost','nishang','google1234','gce_board');;
       // $conn = mysqli_connect ('localhost','u182156984_stlouisapp','Cpadmin@123','u182156984_stlouisapp');;
    }
    return $conn;
    }
	date_default_timezone_set('Africa/Douala');
	$query = $con->query("SELECT * FROM ayear WHERE status='1'  " ) or die(mysqli_error($con));

    while ($userRow = $query->fetch_array()) {

        $year_id = $userRow['id'];
        
    }
	function Login($year_id){
		$con= dbcon();
	
			if (isset($_POST['doLogin'])) {
				
				$email = strip_tags($_POST['usr_email']);
				$password = strip_tags($_POST['password']);
				
				$email = $con->real_escape_string($email);
				$password = $con->real_escape_string($password);
				
				$query = $con->query("SELECT id, user_email,tel, pwd,year_id FROM users WHERE user_email='$email'
				OR tel='$email' AND year_id='$year_id' ") or die(mysqli_error($con));
				$row=$query->fetch_array();
				
				 $count = $query->num_rows; // if email/password are correct returns must be 1 row
				
				if (password_verify($password, $row['pwd']) && $count==1)
				 {
					 
					 
				$_SESSION['userSession'] = $row['id'];
					
				
				
				////get the email of the user using the session_id  
					
			$query =$con->query("SELECT * FROM users WHERE id=".$_SESSION['userSession']." AND year_id='$year_id' ") or die(mysqli_error($con));
			
			 while($userRow=$query->fetch_array()){
			 
			echo $email=$userRow['user_email'];
			 $status=$userRow['user_level'];
			 
			 }
			
			 
			 ////////////////
			 $query =$con->query("SELECT * FROM sectors WHERE area='$status'  ") or die(mysqli_error($con));
			 
			 while($userRow=$query->fetch_array()){
			 
			 $link=$userRow['link'];
			 
					echo '<meta http-equiv="Refresh" content="0; url='.$link.'">';
			  
			 
			 }
			 
			 /////////////////
			
				  
					echo '<meta http-equiv="Refresh" content="0; url='.$link.'">';
			  
			  
				} 
				else {
					echo $msg = "<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
							</div>";
				}
				$con->close();
			}
	}


	function CreateSubDiv(){
			
		
		$con= dbcon();
			if(isset($_POST['save'])){
				
				$subdiv_name=ucfirst($_POST['s_name']);				
				$division_id=$_GET['id'];
				
			$select =$con->query("SELECT * FROM sub_divisions WHERE  subdiv_name='$subdiv_name'  ") or die(mysqli_error($con));	
			 $counts=$select->num_rows;	
			if($counts>0){
				echo "<script>alert('ERROR. Subdivsion Already Exists')</script>";
				echo '<meta http-equiv="Refresh" content="0; url=?creating_subdiv&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
			}
			else {
			$query =$con->query("INSERT INTO sub_divisions  set subdiv_name='$subdiv_name',division_id='$division_id' ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?creating_subdiv&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
			}
			}
	}

	function UpdateSubDiv($id){
			
		
		$con= dbcon();
			if(isset($_POST['save_update'])){
				
				$subdiv_name=ucwords($_POST['s_name']);				
				
			$query =$con->query("UPDATE sub_divisions  set subdiv_name='$subdiv_name' WHERE id='$id'  ") or die(mysqli_error($con));
			echo "<script>alert('Update Successfull!')</script>";	 
			echo '<meta http-equiv="Refresh" content="0; url=?creating_subdiv&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
			}
		}

		function DeleteSubDiv($id){
			
		
			$con= dbcon();
				 	
				if(isset($_GET['del'])){				
					
				$query =$con->query("DELETE FROM sub_divisions    WHERE id='$id'  ") or die(mysqli_error($con));
				echo "<script>alert(' Successfully Deleted!')</script>";	 
				echo '<meta http-equiv="Refresh" content="0; url=?creating_subdiv&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
				}
			}
	

			function CreateSchools($subdivison_id){
			
		
				$con= dbcon();
					if(isset($_POST['save'])){
						
						$school_name=ucwords($_POST['school_name']);
						$center_num=ucwords($_POST['c_num']);				
						 
						
					$select =$con->query("SELECT * FROM schools WHERE  school_name='$school_name'  AND center_num='$center_num' ") or die(mysqli_error($con));	
					 $counts=$select->num_rows;	

					 $select_2 =$con->query("SELECT * FROM schools WHERE    center_num='$center_num' ") or die(mysqli_error($con));	
					 $counts_cennum=$select_2->num_rows;	


					if($counts>0){
						echo "<script>alert('ERROR. School Already Exists')</script>";
						echo '<meta http-equiv="Refresh" content="0; url=?creating_acoomo_center&id='.$subdivison_id.'&gdgdggd&link='.$_GET['link'].'">';
					}
					if($counts_cennum>0){
						echo "<script>alert('ERROR. Center Number ".$center_num." already in Use')</script>";
						echo '<meta http-equiv="Refresh" content="0; url=?creating_acoomo_center&id='.$subdivison_id.'&gdgdggd&link='.$_GET['link'].'">';
					}
					else {
					$query =$con->query("INSERT INTO schools  set school_name='$school_name',subdiv_id='$subdivison_id',center_num='$center_num' ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?creating_acoomo_center&id='.$subdivison_id.'&gdgdggd&link='.$_GET['link'].'">';
					}
					}
			}

			
			function UpdateSchools($id){
			
		
				$con= dbcon();
					if(isset($_POST['save_update'])){
						
						$school_name=ucwords($_POST['school_name']);
						$center_num=ucwords($_POST['c_num']);	
						$subdiv_id=$_POST['subdiv_id'];			
						 
						 
					 $select_center_num=$con->query("SELECT * FROM schools WHERE    center_num='$center_num' AND id!='$id' ") or die(mysqli_error($con));	
					 $counts_center_num=$select_center_num->num_rows;	
					  if($counts_center_num>0){
						echo "<script>alert('ERROR. Center Number Already Exists')</script>";
						echo '<meta http-equiv="Refresh" content="0; url=?creating_acoomo_center&id='.$_GET['id'].'&gdgdggd&link='.$_GET['link'].'">';	
					}
					else {
					$query =$con->query("UPDATE schools  set school_name='$school_name' ,center_num='$center_num',subdiv_id='$subdiv_id' WHERE id='$id' ") or die(mysqli_error($con));
					echo "<script>alert('Successfully Updated')</script>";
					echo '<meta http-equiv="Refresh" content="0; url=?creating_acoomo_center&id='.$_GET['id'].'&gdgdggd&link='.$_GET['link'].'">';
					}
					}
			}

			function DeleteSchools($id){
			
		
				$con= dbcon();
				if(isset($_GET['del'])){				
					
					$query =$con->query("DELETE FROM schools   WHERE id='$id'  ") or die(mysqli_error($con));
					echo "<script>alert(' Successfully Deleted!')</script>";	 
					echo '<meta http-equiv="Refresh" content="0; url=?creating_acoomo_center&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
					}
			}

			
			function SetSchools(){
			
		
				$con= dbcon();
				if(isset($_GET['set'])){				
					$id=$_GET['set'];
					$query =$con->query("UPDATE schools SET acc_center='1'   WHERE id='$id'  ") or die(mysqli_error($con));
					echo "<script>alert('You have Successfully Set School as Accomodation Center!')</script>";	 
					echo '<meta http-equiv="Refresh" content="0; url=?set_acoomo_center&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
					}
			}

			function UnSetSchools(){
			
		
				$con= dbcon();
				if(isset($_GET['unset'])){				
					$id=$_GET['unset'];
					$query =$con->query("UPDATE schools SET acc_center='0'   WHERE id='$id'  ") or die(mysqli_error($con));
					echo "<script>alert('You have Successfully Remove School as Accomodation Center!')</script>";	 
					echo '<meta http-equiv="Refresh" content="0; url=?set_acoomo_center&id='.$_GET['id'].'&gdgdggd&link'.$_GET['link'].'">';
					}
			}

			function CreateRegCenter($acc_center_id){
			
		
				$con= dbcon();
					if(isset($_POST['save'])){
						
						$school_id=ucwords($_POST['school']);
						 		
						 
						
					$select =$con->query("SELECT * FROM registration_recenters WHERE  school_id='$school_id'  ") or die(mysqli_error($con));	
					 $counts=$select->num_rows;	
					if($counts>0){
						echo "<script>alert('ERROR. School Already Exists')</script>";
						echo '<meta http-equiv="Refresh" content="0; url=?create_reg_center&id='.$_GET['id'].'&subdiv='.$_GET['subdiv'].'&gdgdggd&link='.$_GET['link'].'">';
					}
					else {
					$query =$con->query("INSERT INTO registration_recenters  set school_id='$school_id',acc_center_id='$acc_center_id'  ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?create_reg_center&id='.$_GET['id'].'&subdiv='.$_GET['subdiv'].'&gdgdggd&link='.$_GET['link'].'">';
				}
					}
			}

			
			function DeleteRegCenter($id){
			
		
				$con= dbcon();
				if(isset($_GET['del'])){				
					
					$query =$con->query("DELETE FROM registration_recenters   WHERE id='$id'  ") or die(mysqli_error($con));
					echo "<script>alert(' Successfully Deleted!')</script>";	 
					echo '<meta http-equiv="Refresh" content="0; url=?create_reg_center&id='.$_GET['id'].'&subdiv='.$_GET['subdiv'].'&gdgdggd&link='.$_GET['link'].'">';
					}
			}

			function CreateSpecialities(){
			
		
				$con= dbcon();
					if(isset($_POST['save'])){
						
						$special_name=ucwords($_POST['special_name']);
						$abbv=strtoupper($_POST['abbv']);
						 		
						 
						
					$select =$con->query("SELECT * FROM specialities WHERE  name='$special_name'  ") or die(mysqli_error($con));	
					 $counts=$select->num_rows;	
					if($counts>0){
						echo "<script>alert('ERROR. Specialty Already Exists')</script>";
						echo '<meta http-equiv="Refresh" content="0; url=?speciality&gdgdggd&link='.$_GET['link'].'">';
					}
					else {
					$query =$con->query("INSERT INTO specialities  set name='$special_name', abbv='$abbv'  ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?speciality&gdgdggd&link='.$_GET['link'].'">';
				}
					}
			}


			function UpdateSpecialities($id){
			
		
				$con= dbcon();
					if(isset($_POST['save_update'])){
						
						$special_name=ucwords($_POST['special_name']);
						$abbv=strtoupper($_POST['abbv']);
						 
					$query =$con->query("UPDATE specialities  set name='$special_name', abbv='$abbv' WHERE id='$id' ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?speciality&gdgdggd&link='.$_GET['link'].'">';
				} 
			}

			function CreateSubject($id){
			
		
				$con= dbcon();
					if(isset($_POST['save'])){
						
						$special_name=$con->real_escape_string(ucwords($_POST['subject']));
						$abbv=strtoupper($_POST['code']);
						 		
						 
						
					$select =$con->query("SELECT * FROM subjects WHERE  subject_name='$special_name' AND subject_code='$abbv'  ") or die(mysqli_error($con));	
					 $counts=$select->num_rows;	
					if($counts>0){
						echo "<script>alert('ERROR. Subject Already Exists')</script>";
						echo '<meta http-equiv="Refresh" content="0; url=?creating_subjects&id='.$id.'&888d8d8&link='.$_GET['link'].'">';
					}
					else {
					$query =$con->query("INSERT INTO subjects  set subject_name='$special_name', subject_code='$abbv',specailty_id='$id'  ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?creating_subjects&id='.$id.'&888d8d8&link='.$_GET['link'].'">';
				}
					}
			}

			function UpdateSubject($id,$sid){
			
		
				$con= dbcon();
					if(isset($_POST['save_update'])){
						
						$special_name=$con->real_escape_string(ucwords($_POST['subject']));
						$abbv=strtoupper($_POST['code']);
						 		
						 
					$query =$con->query("UPDATE  subjects  set subject_name='$special_name', subject_code='$abbv' WHERE id='$id'  ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?creating_subjects&id='.$sid.'&888d8d8&link='.$_GET['link'].'">';
				}
					 
			}

			
			function SubjectRate($sid){
			
		
				$con= dbcon();
					if(isset($_POST['save'])){
						
						$special_name=$con->real_escape_string(ucwords($_POST['subject']));
						$rate=strtoupper($_POST['rate']);
						 		
						 
					$query =$con->query("UPDATE  subjects  set rate_per_student='$rate' WHERE id='$sid'  ") or die(mysqli_error($con));
					echo '<meta http-equiv="Refresh" content="0; url=?rates&link=Rate%20Per%20Candidate">';
				}
					 
			}

			function RecStudents($sid,$year_id){
				$con= dbcon();
				if(isset($_POST['save'])){
			
				$subject_id=$_POST['subject_id'];
				$num=$_POST['num'];
						 
				 
				
			$select =$con->query("SELECT * FROM registered_students WHERE  school_id='$sid' AND year_id='$year_id' AND subject_id='$subject_id'  ") or die(mysqli_error($con));	
			 $counts=$select->num_rows;	
			if($counts>0){
				$query =$con->query("UPDATE registered_students  set num_ofstudents='$num' WHERE  school_id='$sid' AND 
				 year_id='$year_id' AND subject_id='$subject_id'
			 ") or die(mysqli_error($con));
				echo '<meta http-equiv="Refresh" content="0; url=?registering_materials&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
			}
			else {
			$query =$con->query("INSERT INTO registered_students  set school_id='$sid', year_id='$year_id',subject_id='$subject_id'
			,num_ofstudents='$num' ") or die(mysqli_error($con));
				echo '<meta http-equiv="Refresh" content="0; url=?registering_materials&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
		}
			}
		}


		function RegisterStudents($sid,$year_id){
			$con= dbcon();
			if(isset($_POST['save'])){
		
			$subject_id=$_POST['subject_id'];
			$num=$_POST['num'];
			$acc_center=$_POST['acc_center'];
					 
		
			
			$select =$con->query("SELECT * FROM subjects WHERE  id='$subject_id'  ") or die(mysqli_error($con));	
			while($Row=$select->fetch_assoc())	 {
				$cost=$Row['rate_per_student'];

			}
			
		$select =$con->query("SELECT * FROM student_registration WHERE  school_id='$sid' AND 
		year_id='$year_id' AND subject_id='$subject_id'  ") or die(mysqli_error($con));	
		 $counts=$select->num_rows;	
		if($counts>0){
			$query =$con->query("UPDATE student_registration  set num_ofstudents='$num',acc_center_id='$acc_center' WHERE  school_id='$sid' AND 
			 year_id='$year_id' AND subject_id='$subject_id'
		 ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?student_regs&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
		}
		else {
		$query =$con->query("INSERT INTO student_registration  set school_id='$sid', year_id='$year_id',subject_id='$subject_id'
		,num_ofstudents='$num',acc_center_id='$acc_center',cost_price='$cost' ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?student_regs&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
	}
		}
	}

	function DelRegisterStudents($sid){
			
		
		$con= dbcon();
		if(isset($_GET['del'])){	
			$id=$_GET['del'];			
			
			$query =$con->query("DELETE FROM student_registration   WHERE id='$id'  ") or die(mysqli_error($con));
			echo "<script>alert(' Successfully Deleted!')</script>";	 
			echo '<meta http-equiv="Refresh" content="0; url=?student_regs&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
			}
	}

	function GetAccCenterInfo($region_id,$year_id){
			
		
		$con= dbcon();
		$get_schools_inreg=$con->query("SELECT * FROM  regions,student_registration, divisions,schools WHERE   regions.id='".$region_id."' AND
		divisions.id=schools.subdiv_id AND  regions.id=divisions.region_id
		AND student_registration.year_id='".$year_id."' AND student_registration.school_id=schools.id 
		GROUP BY student_registration.school_id  order by  schools.center_num ") 
		or die(mysqli_error($con));
	   echo $num_of_courses=$get_schools_inreg->num_rows;
		while($row_schools=$get_schools_inreg->fetch_assoc()){
		}
	}
			
	
	function RegisterSessions($sid,$year_id){
		$con= dbcon();
			if(isset($_POST['save'])){
		
			$subject_id=$_POST['subject_id'];
			$num=$_POST['sess'];
			$acc_center=$_POST['acc_center'];
			$transport=$_POST['transport'];
					 
		
			
			
		$select =$con->query("SELECT * FROM student_registration WHERE  school_id='$sid' AND 
		year_id='$year_id' AND subject_id='$subject_id'  ") or die(mysqli_error($con));	
		 $counts=$select->num_rows;	
		if($counts>0){
			$query =$con->query("UPDATE student_registration  set sess_num='$num',address_id='$acc_center' WHERE  school_id='$sid' AND 
			 year_id='$year_id' AND subject_id='$subject_id'
		 ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?recording_sessions&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
		}
		else {
		$query =$con->query("INSERT INTO student_registration  set school_id='$sid', year_id='$year_id',subject_id='$subject_id'
		,sess_num='$num',address_id='$acc_center' ,transport='$transport' ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?recording_sessions&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
	}
		}
	}

	function DelSessions($sid){
			
		
		$con= dbcon();
		if(isset($_GET['del'])){	
			$id=$_GET['del'];			
			
			$query =$con->query("DELETE FROM student_registration   WHERE id='$id'  ") or die(mysqli_error($con));
			echo "<script>alert(' Successfully Deleted!')</script>";	 
			echo '<meta http-equiv="Refresh" content="0; url=?recording_sessions&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
			}
	}

	
	function UpdateSessions($sid,$id){
		$con= dbcon();
			if(isset($_POST['save_update'])){
		
			$subject_id=$_POST['subject_id'];
			$num=$_POST['sess'];
			$acc_center=$_POST['acc_center'];
			$transport=$_POST['transport'];
					 
		
			$query =$con->query("UPDATE student_registration  set sess_num='$num',address_id='$acc_center',transport='$transport'
			 WHERE    id='$id'
		 ") or die(mysqli_error($con));
		 echo "<script>alert('Update Successfull')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?recording_sessions&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
		
		}
	}

	function UpdateInvPay($sid,$year){
		$con= dbcon();
			if(isset($_POST['save'])){
		
			$subject_id=$_POST['subject_id'];
			$num=$_POST['cost'];
			 	 
		
			$query =$con->query("UPDATE student_registration  set inv_cost='$num' 	 WHERE    subject_id='$sid'
			AND year_id='$year'
		 ") or die(mysqli_error($con));
		 echo "<script>alert('Update Successfull')</script>";
		
			echo '<meta http-equiv="Refresh" content="0; url= ?recording_invpay&year_id='.$year.'&id='.$sid.'&gdgdggd&link='.$_GET['link'].'">';
		
		}
	}


	function CreateSupervisor(){
		$con= dbcon();
			if(isset($_POST['save'])){
		
			$name=$_POST['name'];
			$addr=$_POST['addr'];
			
			
			
		$select =$con->query("SELECT * FROM supervisors WHERE  name='$name' ") or die(mysqli_error($con));	
		 $counts=$select->num_rows;	
		if($counts>0){
			echo "<script>alert('".$name." Already Exists ')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?create_supervisor&gdgdggd&link='.$_GET['link'].'">';
		}
		else {
		$query =$con->query("INSERT INTO supervisors  set name='$name',addr='$addr' ") or die(mysqli_error($con));
			echo '<meta http-equiv="Refresh" content="0; url=?create_supervisor&gdgdggd&link='.$_GET['link'].'">';
	}
		}
	}

	function UpdateSupervisor($id){
		$con= dbcon();
			if(isset($_POST['save_update'])){
		
			$name=$_POST['name'];
			$addr=$_POST['addr'];
			
			
		
		$query =$con->query("UPDATE supervisors  set name='$name',addr='$addr' WHERE id='$id' ") or die(mysqli_error($con));
		echo "<script>alert('Update Successfull ')</script>";
			echo '<meta http-equiv="Refresh" content="0; url=?create_supervisor&gdgdggd&link='.$_GET['link'].'">';
	
		}
	}


			

		
		
		

	
	function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
	

	
	
	
			
			// With this function you can calculate on how many days someone has birthday
	function countdays($date)   // declare the function and get the birth date as a parameter
	{
		 $olddate =  substr($d, 4); // use this line if you have a date in the format YYYY-mm-dd.
		 $newdate = date("Y") ."".$olddate; //set the full birth date this year
		 $nextyear = date("Y")+1 ."".$olddate; //set the full birth date next year
		 
		 
			if(strtotime($newdate) > strtotime(date("Y-m-d"))) //check if the birthday has passed this year. In order to check use strotime(). if it has not....
			{
			$start_ts = strtotime($newdate); // set a variable equal to the birthday in seconds (Unix timestamp, check php manual for more information)
			$end_ts = strtotime(date("Y-m-d"));// and a variable equal to today in seconds
			$diff = $end_ts - $start_ts; // calculate the difference of today minus birthday
			$n = round($diff / (60*60*24));// divide the diffence with the seconds of one day to get the dates. Use round() to get a round number.
										//(60*60*24) represents 60 seconds * 60 minutes * 24 hours = 1 day in seconds. You can also directly write 86400
			$return = substr($n, 1); //you need this to get the right value without -
			return $return; // return the value
			}
			else // else if the birthday has past this year
			{
			$start_ts = strtotime(date("Y-m-d")); // set a variable equal to the today in seconds
			$end_ts = strtotime($nextyear); // and a variable with the birtday next year
			$diff = $end_ts - $start_ts; // calculate the difference of next birthday minus today
			$n = round($diff / (60*60*24)); // divide the diffence with the seconds of one day to get the dates.
			$return = $n; // assign the dates to return
			return $return; // return the value
		
			}
		
		}
				
			
	
	