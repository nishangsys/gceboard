
                     
                         
                         <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Year </th>
                              
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM ayear  ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                <td><?php echo $rows['cur_ayear']; ?></td>
                               
                                <td><a href="Reports/allsupervisor_reports.php?id=<?php echo $rows['id']; ?>&&73838***" target="_new" class="btn btn-primary btn-xs">Print Supervisors Reports</button></td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>