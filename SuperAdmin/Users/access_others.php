




<table class="table table-bordered">
              
              <?php 
			$year=date('Y');
			  $d=$con->query("SELECT * from sectors where area!='20' ") or die(mysqli_error($con));
$i=1;
?>
     <thead>
        <tr>
         <th>#</th>
         <th>Name</th>        
         <th>Access</th>
      
               
       </tr>
       </thead>
       <tbody>
          <?php while($bu=$d->fetch_assoc()){ ?>

      <tr>
       
           <td><?php  echo $i++; ?></td>
            <td><?php  echo $bu['name']; ?></td>
            
             <td> <a href="../<?php  echo $bu['name']; ?>" target="new">Access Accounts</a>
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