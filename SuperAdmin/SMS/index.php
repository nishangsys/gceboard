
						<?PHP 
						testSmsGroup();
						
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Message : </label>

										<div class="col-sm-9">
	                              <textarea class="form-control" name="message" cols="8" rows="10" id="form-field-8" placeholder="Default Text"></textarea>

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
												Send SMS to all applicants
											</button>
												<?php } ?>

											
										</div>
									</div>
                        </form>
                        
                        