
						<?PHP 
						CreateSubDiv();
						UpdateSubDiv($_GET['edit']);
						DeleteSubDiv($_GET['del']);
						$select =$con->query("SELECT * FROM  divisions  WHERE id='".$_GET['id']."' ") or die(mysqli_error($con));
                        				
                          while($rows=$select->fetch_assoc()){
                        echo    $divsion_name=$rows['division_name'];
                          }
						
						if(isset($_GET['edit'])){
							$sub_divname="";
							$subdiv_id="";
							$select =$con->query("SELECT * FROM  sub_divisions where id='".$_GET['edit']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$sub_divname=$rows['subdiv_name'];
								$subdiv_id=$rows['id'];
                            }
						}
							
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">

					       	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Sub Division Name: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $sub_divname; ?>" name="s_name"   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Division Name : </label>

										<div class="col-sm-9">
										<select style="color:#00F; font-weight:bold"   id="countries-list" class="col-xs-10 col-sm-5" required >
											<option style="color:#00F; font-weight:bold" value="<?php echo $_GET['id']; ?>"><?php echo $divsion_name; ?></option>
											
											</select>
										</div>
									</div>

									
                                    
                                    
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											
                                            <?php if(isset($_GET['edit'])){ ?>
                                            <input type="hidden" name="id"  value="<?php echo $_GET['edit']; ?>" />
                                            <button class="btn btn-info" type="submit" name="save_update">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Save Updates
											</button>
											</div>
                                            <?php  } else { ?>
                                            <button class="btn btn-info" type="submit" name="save">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
												

											
										</div>
									</div>
                        </form>
                        <?php  }?>
											
                        
                         <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  sub_divisions WHERE division_id='".$_GET['id']."' order by id DESC   ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['subdiv_name']; ?></td>
                                  
                                <td><a href="?creating_subdiv&id=<?php echo $rows['division_id']; ?>&del=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" onclick="return confirm('Are you sure you wish to Delete <?php echo $rows['subdiv_name']; ?> because  related Data will be lost')" class="btn btn-danger btn-xs">Delete </a>
                            
                                 <a href="?creating_subdiv&id=<?php echo $rows['division_id']; ?>&edit=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-primary btn-xs">Edit</a>
                            </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                   