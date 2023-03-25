




<table class="table table-bordered">
              
              <?php 
			$year=date('Y');
			  $d=$con->query("SELECT * from users ") or die(mysqli_error($con));
$i=1;
?>
 <thead>
                                        <tr>
                                            <th>#</th>
                                             <th>Name</th>
     <th>User Name</th>
        <th>Date</th> 
        <th>Service</th>
         <th>branch</th>
  
           
                               </tr>
                                    </thead>
                                    <tbody>
                                       <?php while($bu=$d->fetch_assoc()){ ?>

      <tr>
       
           <td><?php  echo $i++; ?></td>
                                            <td><?php  echo $bu['full_name']; ?></td>
                                        
                                            <td><?php  echo $bu['user_name']; ?></td>
                                            <td><?php  echo $bu['date']; ?></td>
                                          <td><?php  echo $bu['country']; ?></td>
                                         <td>  <a href="?create_user&link=Create Users&ban=<?php echo $bu['id'];  ?>"><button type="submit" class="btn btn-danger" name="submit" onclick="return confirm('Are you sure')">Suspend Account</button></a>| 
                                          <a href="?change_pwd&link=Change Password&xxc=<?php echo $bu['id'];  ?>"><button type="submit" class="btn btn-success" name="submit" onclick="return confirm('Are you sure')">Change Password</button></a></td>
                                     
                                            
                                        </tr>
                                     
                                       <?php } ?>
                                    </tbody>
                                    </table>
 
<?php

		  if(isset($_GET['delete'])){
	echo $delete=$_GET['delete'];
 
	 $fj=$con->query("DELETE FROM users where id='$delete'  ") or die(mysqli_error($con));
	 echo "<script>alert('Actiond successfully ')</script>";
	 echo '<meta http-equiv="Refresh" content="0; url=?create_user&link=Create Users">';
	 
		  }
; ?>