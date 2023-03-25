
						<?PHP CreateCategory();
						$block_name="";
						$min="";
						$maxt="";
						
						if(isset($_GET['edit'])){
							$select =$con->query("SELECT * FROM  categories where id='".$_GET['edit']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$block_name=$rows['cate_name'];
								$min=$rows['min_cost'];
								$max=$rows['max_cost'];
							}
						}
						?>
						<form method="POST" action="" class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> CATEGORY NAME: </label>

										<div class="col-sm-9">
											<input type="text" name="block_name" value="<?php echo $block_name; ?>" id="form-field-1" placeholder="CATEGORY NAME:" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> MINIMUM RATE: </label>

										<div class="col-sm-9">
											<input type="number" name="min" value="<?php echo $min; ?>" id="form-field-1" placeholder="MINIMUM RATE:" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> MAXIMUM RATE: </label>

										<div class="col-sm-9">
											<input type="number" name="max" value="<?php echo $min; ?>" id="form-field-1" placeholder="MAXIMUM RATE" class="col-xs-10 col-sm-5" />
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
                        <?PHP UpdateCategory(); ?>
                        
                         <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Minimum Rate</th>
                                <th>Maximum Rate</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  categories order by id DESC  ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['cate_name']; ?></td>
                                  <td><?php echo number_format($rows['min_cost']); ?></td>
                                <td><?php echo number_format($rows['max_cost']); ?></td>
                                <td><a href="?create_category&edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-xs">Edit</button></td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>