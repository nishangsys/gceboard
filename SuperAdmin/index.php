	   <?PHP include '../includes/functions.php';
			  @session_start();
				if(empty($_SESSION['userSession'])){
					
						echo '<meta http-equiv="Refresh" content="0; url=../login.php">';
				}
			
				 else {
					
					$query =$con->query("SELECT * FROM users WHERE id=".$_SESSION['userSession']) or die(mysqli_error($con));
			
					while($userRow=$query->fetch_array()){
					
					$email=$userRow['user_email'];
					$level=$userRow['user_level'];
					
					
					}
						$select =$con->query("SELECT * FROM   ayear WHERE status='1' ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$cur_ayear=$rows['cur_ayear'];
								$year_id=$rows['id'];
							}

     					
				

            if(empty($level)){
            echo '<meta http-equiv="Refresh" content="0; url=../login.php">';

            }
            else if($level!=20){
                echo '<meta http-equiv="Refresh" content="0; url=../login.php">';
                
                }

            
            if($level=='20' ){
	   
	   
	    ?>
       
	   
	   <?php include '../includes/header.php'; ?>	
	   <?php include '../includes/sidebar.php'; ?>
       <?php include '../includes/content.php'; ?>
       <?php include '../includes/footer.php'; ?>
       <?php  } } ?>























			
