
						<?PHP 
                       
						 
                       
                       UpdateInvPay($_GET['id'],$year_id);
                        

                       
						
						if(isset($_GET['id'])){
							
							$select =$con->query("SELECT * FROM  subjects,student_registration where student_registration.subject_id='".$_GET['id']."' 
                            AND subjects.id=student_registration.subject_id 
                            AND year_id='".$year_id."' order by student_registration.id DESC LIMIT 1 ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$subject_name=$rows['subject_name'];
								$subject_code=$rows['subject_code'];
                                $inv_pay=$rows['inv_cost'];
                                
                         
							
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">

					       

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Subject : </label>

										<div class="col-sm-9">
										<select style="color:#00F; font-weight:bold" name="subject_id"   id="countries-list" class="col-xs-10 col-sm-5" required >
											<option style="color:#00F; font-weight:bold" value="<?php echo $_GET['id']; ?>"  ><?php echo $subject_name; ?>
                                             (<?php echo $subject_code; ?>) </option>

                                           
											</select>
										</div>
									</div>

									 
 

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Invigliator Pay: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $inv_pay; ?>" name="cost" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
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
											
                        <h1>  Invigilators Pay  for <?php echo $subject_name; ?> this <?php echo $cur_ayear; ?></h1> 

                                            <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Subject</th>
                                <th>Cost Per Inivilator</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  subjects,student_registration where student_registration.subject_id='".$_GET['id']."' 
                            AND subjects.id=student_registration.subject_id order by student_registration.id DESC LIMIT 1  ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['subject_name']; ?>(<?php echo $rows['subject_code']; ?>)</td>
                                 <td><?php echo $rows['inv_cost']; ?></td>
                                 
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                       