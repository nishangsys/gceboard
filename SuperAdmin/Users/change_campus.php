


<?php   ChangePwd(); ?>




<?php
 $id=$_GET['xxc'];
	$a = $con->query("SELECT * from users where id='".$id."'") or die(mysqli_error($con));
			
		while($rows = $a->fetch_assoc()) {
			?>
            <BR /><BR />
     
      <form action="" method="post" name="regForm" class="form-horizontal" id="regForm" style="margin-top:30px">
                <div class="form-group">

         
       
         <form class="form-horizontal">
         
  
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="text" placeholder="Username" value="<?php echo $rows['user_name']; ?>" name="user_name" readonly="readonly">
      </div>
    </div>
 
 
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Full Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="text" placeholder="Username" value="<?php echo $rows['full_name']; ?>" name="user_name" readonly="readonly">
      </div>
    </div>
   
       
       
    
      <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">New Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
      </div>
    </div>
    
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pwd" name="pwd2" placeholder="Enter password again" required>
      </div>
    </div>
    
    
  
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" name="submit">CHANGE PASSWORD</button>
      </div>
   
      </form>
     
	<?php } ?>

</div>
</div>

