
						d <?PHP 
                        
						 
                         SubjectRate($_GET['id']);
                        
						
						if(isset($_GET['id'])){
							$sub_divname="";
							$subdiv_id="";
							$select =$con->query("SELECT * FROM  subjects where id='".$_GET['id']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$name=$rows['subject_name'];
								$abbv=$rows['subject_code'];
                                $rate_per_student=$rows['rate_per_student'];
                         
							
						
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

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Rate per Student: </label>

										<div class="col-sm-9">
											<input type="number" value="<?php echo $rate_per_student; ?>" name="rate" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
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
                        <?php    }
						} }?>
											
                        
                       