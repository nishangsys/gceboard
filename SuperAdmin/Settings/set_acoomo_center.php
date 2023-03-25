
						<?PHP 
						SetSchools();
						UnSetSchools();
					 
						
							
						
						?>
							
                        
                         <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>School</th>
                                <th>Center Number</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  schools WHERE subdiv_id='".$_GET['id']."' order by id DESC   ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['school_name']; ?></td>
                                 <td><?php echo $rows['center_num']; ?></td>
                                  
                                <td>
                                <?php if($rows['acc_center']==0){

                                ?>
                                 <a href="?set_acoomo_center&id=<?php echo $rows['subdiv_id']; ?>&set=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-success btn-xs">Set as Accomdation Center</a>
                           <?php } else { ?>
                            <a href="?set_acoomo_center&id=<?php echo $rows['subdiv_id']; ?>&unset=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-danger btn-xs">Remove as Accomdation Center</a>

                            <?php } ?>
                           
                                </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                   