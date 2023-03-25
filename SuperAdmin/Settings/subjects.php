
						 
                         <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Abbrevation</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  specialities  order by name   ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['name']; ?></td>
                                 <td><?php echo $rows['abbv']; ?></td>
                                  
                                <td>
                            
                                 <a href="?creating_subjects&id=<?php echo $rows['id']; ?>&888d8d8&link=Creating <?php echo $rows['name'] ;?> Subjects" class="btn btn-primary btn-xs">Create Subjects</a>
                            </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                   