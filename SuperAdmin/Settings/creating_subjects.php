
						<?PHP 
                        
						CreateSubject($_GET['id']);
                         UpdateSubject($_GET['edit'],$_GET['id']);
                        
						
						if(isset($_GET['edit'])){
							$sub_divname="";
							$subdiv_id="";
							$select =$con->query("SELECT * FROM  subjects where id='".$_GET['edit']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$name=$rows['subject_name'];
								$abbv=$rows['subject_code'];
                            }
						}
							
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">

					       	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Subject Name: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $name; ?>" name="subject" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Code: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $abbv; ?>" name="code" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
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
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  subjects where specailty_id='".$_GET['id']."' order by id DESC   ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['subject_name']; ?></td>
                                 <td><?php echo $rows['subject_code']; ?></td>
                                  
                                <td>
                            
                                 <a href="?creating_subjects&id=<?php echo $_GET['id']; ?>&edit=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-primary btn-xs">Edit</a>
                            </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                   