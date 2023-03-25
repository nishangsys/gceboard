
						<?PHP CreateRooms();
						$block_name="";
						$min="";
						$maxt="";
						
						if(isset($_GET['edit'])){
							$select =$con->query("SELECT * FROM  categories where id='".$_GET['edit']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$room_name=$rows['cate_name'];
								$min=$rows['min_cost'];
								$max=$rows['max_cost'];
							}
						}
						?>
						<form method="POST" action="" class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> ROOM NUMBER: </label>

										<div class="col-sm-9">
											<input type="text" name="num" value="<?php echo $block_name; ?>" id="form-field-1" placeholder="ROOM NUMBER:" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Category: </label>

										<div class="col-sm-9">
											
															<select class="col-sm-5 control-label no-padding-right" required name="cate" id="form-field-select-1">
																<option value=""></option>
																<?php
																$select =$con->query("SELECT * FROM  categories order by cate_name ") or die(mysqli_error($con));							
							                         while($rows=$select->fetch_assoc()){
														 ?>
                                                         <option value="<?php echo $rows['id']; ?>"><?php echo $rows['cate_name']; ?></option>
                                                         
                                                         <?php } ?>
															</select>
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Block/ Flour: </label>

										<div class="col-sm-9">
											
															<select class="col-sm-5 control-label no-padding-right" required name="block" id="form-field-select-1">
																<option value=""></option>
																<?php
																$select =$con->query("SELECT * FROM  blocks  ") or die(mysqli_error($con));							
							                         while($rows=$select->fetch_assoc()){
														 ?>
                                                         <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>
                                                         
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
                                            <?php  } else { ?>
                                            <button class="btn btn-info" type="submit" name="save">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
												<?php } ?>

											
										</div>
									</div>
                        </form>
                        
                        
                         <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Room Number</th>
                                <th>Block</th>
                                <th>Category</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  blocks,categories,rooms 
							WHERE rooms.cate_id=categories.id AND rooms.block_id=blocks.id 
							order by rooms.id DESC  ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['room_num']; ?></td>
                                  <td><?php echo  $rows['name']; ?></td>
                                <td><?php echo $rows['cate_name']; ?></td>
                                <td><a href="?edit_rooms&edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-xs">Edit</button></td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>