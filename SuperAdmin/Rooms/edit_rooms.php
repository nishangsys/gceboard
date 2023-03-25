
						<?PHP UpdateRooms();
						
						
						if(isset($_GET['edit'])){
							$select =$con->query("SELECT * FROM  blocks,categories,rooms 
							WHERE rooms.id='".$_GET['edit']."' AND rooms.cate_id=categories.id AND rooms.block_id=blocks.id 
							order by rooms.id DESC  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$room_name=$rows['room_num'];
								
							
						?>
						<form method="POST" action="" class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> ROOM NUMBER: </label>

										<div class="col-sm-9">
											<input type="text" name="num" value="<?php echo $room_name; ?>" id="form-field-1" placeholder="ROOM NUMBER:" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Category: </label>

										<div class="col-sm-9">
											
															<select class="col-sm-5 control-label no-padding-right" required name="cate" id="form-field-select-1">
																<option value="<?php echo $rows['cate_id']; ?>"><?php echo $rows['cate_name']; ?></option>
																<?php
																$select =$con->query("SELECT * FROM  categories WHERE id!='".$rows['cate_id']."' order by cate_name ") or die(mysqli_error($con));							
							                         while($row=$select->fetch_assoc()){
														 ?>
                                                         <option value="<?php echo $row['id']; ?>"><?php echo $row['cate_name']; ?></option>
                                                         
                                                         <?php } ?>
															</select>
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Block/ Flour: </label>

										<div class="col-sm-9">
											
															<select class="col-sm-5 control-label no-padding-right" required name="block" id="form-field-select-1">
																<option value="<?php echo $rows['block_id']; ?>"><?php echo $rows['name']; ?></option>
																<?php
																$select =$con->query("SELECT * FROM  blocks WHERE id!='".$rows['block_id']."' ") or die(mysqli_error($con));							
							                         while($row=$select->fetch_assoc()){
														 ?>
                                                         <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                         
                                                         <?php } ?>
															</select>
										</div>
									</div>
									
                                    
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											
                                            <input type="hidden" name="id"  value="<?php echo $rows['id']; ?>" />
                                            <button class="btn btn-info" type="submit" name="save_update">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Save Updates
											</button>
                                          
											
										</div>
									</div>
                        </form>
                        
                        <?php } } ?>
                        
                        