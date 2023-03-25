 
        <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
        
                <strong>
                    <i class="ace-icon fa fa-times"></i>
                    Oh snap!
                </strong>
        
                Password Must be at least 6 Characters Long and your email address must be valid
                <br />
              </div>
        
       <form action="" method="post" id="register-form" class="form-horizontal" role="form"  >
       
               

       

     
        <?php CreateUsersAdmin($year_id); ?>
          
          
           <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Full Name: </label>

										<div class="col-sm-9">
        <input type="text" class="form-control" placeholder="Full Names" name="name" required autocomplete="off"  />
        </div>
        </div>
        
        
        
        
        
         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Password: </label>

                    <div class="col-sm-9">
                   <input type="password" class="form-control" placeholder="Password" name="password" required  />
                    </div>
        </div>
        
         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Confirm Password: </label>

                    <div class="col-sm-9">
        <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required  />
        			</div>
        </div>    
       
        
        
        
         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> User Name: </label>

                    <div class="col-sm-9">
        <input type="text" class="form-control" placeholder="User Name" name="email" required autocomplete="off"  />
        			</div>
        </div>
        
         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1">User Role: </label>

                    <div class="col-sm-9">
       <select required class="form-control" id="sel1" name="level">
        <?php
							
								$result = $con->query("SELECT * FROM sectors") or die(mysqli_error($con));
				while($bu=$result->fetch_assoc()){
								?>
                       
        <option></option>          
        <option value="<?php echo $bu['area']; ?>"  ><?php echo $bu['name']; ?> </option>
    <?php } ?> 
        
      </select>
      			</div>
        </div>
        
        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1">Campus: </label>

                    <div class="col-sm-9">
       <select required class="form-control" id="sel1" name="campus">
        <?php
							
								$result = $con->query("SELECT * FROM campus") or die(mysqli_error($con));
				while($bu=$result->fetch_assoc()){
								?>
                       
        <option></option>          
        <option value="<?php echo $bu['id']; ?>"  ><?php echo $bu['camp_name']; ?> </option>
    <?php } ?> 
        
      </select>
      			</div>
        </div>

        <input type="hidden" name="year_id" value="<?php echo $year_id; ?>" class="form-control" placeholder="Repeat password" />
													
											
        
         
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                
                <button type="submit" class="btn btn-success" name="btn-signup">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
			</button> 
           

                
            </div>
        </div>
        
        
      </form>

    </div>
   




<table class="table table-bordered">
              
              <?php 
			$year=date('Y');
			  $d=$con->query("SELECT * from campus,ayear,users WHERE users.user_level!='1' 
        AND users.campus_id=campus.id AND ayear.id=users.year_id  ") or die(mysqli_error($con));
$i=1;
?>
 <thead>
                                        <tr>
                                            <th>#</th>
                                             <th>Name</th>
                                  <th>User Name</th>
                                      <th>Campus</th> 
                                      <th>Academic Year</th>
                                      <th>branch</th>
                                
           
                               </tr>
                                    </thead>
                                    <tbody>
                                       <?php while($bu=$d->fetch_assoc()){ ?>

      <tr>
       
                                  <td><?php  echo $i++; ?></td>
                                  <td><?php  echo $bu['full_name']; ?></td>

                                  <td><?php  echo $bu['user_name']; ?></td>
                                  <td><?php  echo $bu['camp_name']; ?></td>
                                  <td><?php  echo $bu['cur_ayear']; ?></td>
                                  <td>  <a href="?create_users&link=Create Users&delete=<?php echo $bu['id'];  ?>"><button type="submit" class="btn btn-danger btn-xs" name="submit" onclick="return confirm('Are you sure')">Delete</button></a>| 
                                   <a href="?change_pwd&link=Change Password&xxc=<?php echo $bu['id'];  ?>" ><button type="submit" class="btn btn-success btn-xs" name="submit" onclick="return confirm('Are you sure')">Change Password</button></a> 
                                   <a href="?renew_account&link=Change Password&xxc=<?php echo $bu['id'];  ?>" ><button type="submit" class="btn btn-primary btn-xs" name="submit" >Renew Account</button></a></td>

                                            
                                        </tr>
                                     
                                       <?php } ?>
                                    </tbody>
                                    </table>
 
<?php

		  if(isset($_GET['delete'])){
	echo $delete=$_GET['delete'];
 
	 $fj=$con->query("DELETE FROM users where id='$delete'  ") or die(mysqli_error($con));
	 echo "<script>alert('Actiond successfully ')</script>";
	 echo '<meta http-equiv="Refresh" content="0; url=?create_users&link=Create Users">';
	 
		  }
; ?>