
						<?PHP 
						CreateSchools($_GET['id']);
						UpdateSchools($_GET['edit']);
						DeleteSchools($_GET['del']);
						$select =$con->query("SELECT * FROM  divisions  WHERE id='".$_GET['id']."' ") or die(mysqli_error($con));
                        				
                          while($rows=$select->fetch_assoc()){
                           $divsion_name=$rows['division_name'];
                          }
						
						if(isset($_GET['edit'])){
							$sub_divname="";
							$subdiv_id="";
							$select =$con->query("SELECT * FROM  schools where id='".$_GET['edit']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$center_name=$rows['school_name'];
								$center_num=$rows['center_num'];
                            }
						}
							
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">

					       	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> School Name: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $center_name; ?>" name="school_name" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Center Number: </label>

										<div class="col-sm-9">
											<input type="number" value="<?php echo $center_num; ?>" name="c_num" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Sub Division: </label>

										<div class="col-sm-9">
										<select style="color:#00F; font-weight:bold" name="subdiv_id"   id="countries-list" class="col-xs-10 col-sm-5" required >
											<option style="color:#00F; font-weight:bold" value="<?php echo $_GET['id']; ?>"><?php echo $divsion_name; ?></option>

                                                                         <?php
                                                                        $select_prog =$con->query("SELECT * FROM  divisions  ORDER By division_name") or die(mysqli_error($con));
                                                                                      
                                                                          while($ok=$select_prog->fetch_assoc()){
                                                                        
							                                                          ?>
                                                                         <option style="color:#00F; font-weight:bold" value="<?php echo $ok['id']; ?>"><?php echo $ok['division_name']; ?></option>
																		                                     <?php } ?>
											
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
                                <th>School</th>
                                <th>Center Number</th>
                                <th>Edit</th>
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
									
                                 <a href="?creating_acoomo_center&id=<?php echo $rows['subdiv_id']; ?>&edit=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-primary btn-xs">Edit</a>
                            </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                   