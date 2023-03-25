


<?php 
 $id=$_GET['xxc'];

Renew($id); ?>




<?php
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
      <label class="control-label col-sm-2" for="pwd">Academic Year:</label>
      <div class="col-sm-10">
      <select required class="form-control" id="sel1" name="ayear" rqeuired>
          <option></option>
        <?php
							
		$result = $con->query("SELECT * FROM ayear") or die(mysqli_error($con));
				while($bu=$result->fetch_assoc()){
								?>
                            
        <option value="<?php echo $bu['id']; ?>"  ><?php echo $bu['cur_ayear']; ?> </option>
    <?php } ?> 
        
      </select>
      </div>
    </div>
    
    
    
    
  
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" name="submit">RENEW ACCOUNT FOR ACADEMIC YEAR</button>
      </div>
   
      </form>
     
	<?php } ?>

</div>
</div>

