
						<?PHP 
                       
						 
                       RegisterSessions($_GET['id'],$year_id);
                       UpdateSessions($_GET['id'],$_GET['edit']);
                       DelSessions($_GET['id']);

                       if(isset($_GET['edit'])){
                        $address_id=$rows['address_id'];
                        $address_id="";
                        $school_id="";
                        $subject_id="";
                        $tranport="";
                        $num_of_sessions="";
                        $subject_name="";
                        $subject_code="";
                        $name_school="";

                        $select =$con->query("SELECT * FROM  schools,subjects,student_registration where student_registration.id='".$_GET['edit']."'
                        AND student_registration.address_id=schools.id  AND subjects.id=student_registration.subject_id ") or die(mysqli_error($con));
                      
                        while($rows=$select->fetch_assoc()){
                            $name_school=$rows['school_name'];
                            $address_id=$rows['address_id'];
                           $school_id=$rows['address_id'];
                           $subject_id=$rows['subject_id'];
                           $subject_name=$rows['subject_name'];
                           $subject_code=$rows['subject_code'];
                           $tranport=$rows['transport'];
                           $num_of_sessions=$rows['sess_num'];
                        }
                    }
						
						if(isset($_GET['id'])){
							
							$select =$con->query("SELECT * FROM  schools where id='".$_GET['id']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$name=$rows['school_name'];
								$abbv=$rows['center_num'];
                               $division_id=$rows['subdiv_id'];
                                
                         
							
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">

					       	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> School: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $name; ?>" name="subject" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>

                            

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Subject : </label>

										<div class="col-sm-9">
										<select style="color:#00F; font-weight:bold" name="subject_id"   id="countries-list" class="col-xs-10 col-sm-5" required >
											<option style="color:#00F; font-weight:bold" value="<?php echo $subject_id; ?>"  ><?php echo $subject_name; ?>
                                             (<?php echo $subject_code; ?>) </option>

                                            <?php
                                        $select_prog =$con->query("SELECT * FROM  specialities,subjects,student_registration 
                                        WHERE   subjects.id=student_registration.subject_id AND student_registration.acc_center_id='".$_GET['id']."'
                                       AND specialities.id=subjects.specailty_id  AND  student_registration.year_id='$year_id'
                                       
                                        GROUP BY   student_registration.subject_id order by subjects.subject_code") or die(mysqli_error($con));
                                                        
                                            while($ok=$select_prog->fetch_assoc()){
                                        
                                                        ?>
                                            <option style="color:#00F; font-weight:bold" value="<?php echo $ok['subject_id']; ?>"><?php echo $ok['subject_name']; ?> (<?php echo $ok['subject_code']; ?>)</option>
                                                                                <?php } ?>
											
											</select>
										</div>
									</div>

									

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Sessions: </label>

										<div class="col-sm-9">
											<input type="number" value="<?php echo $num_of_sessions; ?>" name="sess" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>



                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Address: </label>

										<div class="col-sm-9">
										<select style="color:#00F; font-weight:bold" name="acc_center"   id="countries-list" class="col-xs-10 col-sm-5" required >
											<option style="color:#00F; font-weight:bold" value="<?php echo $school_id; ?>"  > <?php echo $name_school; ?> </option>

                                            <?php
                                        $select_prog =$con->query("SELECT * FROM  schools where  acc_center='1' order by school_name ") or die(mysqli_error($con));
                                                        
                                            while($ok=$select_prog->fetch_assoc()){
                                        
                                                        ?>
                                            <option style="color:#00F; font-weight:bold" value="<?php echo $ok['id']; ?>"><?php echo $ok['school_name']; ?> (<?php echo $ok['center_num']; ?>)</option>
                                                                                <?php } ?>
											
											</select>
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Transport: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $tranport; ?>" name="transport" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
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
											
                        <h1>All Supervision Session Records of <?php echo $name; ?> this <?php echo $cur_ayear; ?></h1> 

                                            <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Subject</th>
                                <th>Number of Sessions</th>
                                <th>Address</th>
                                <th>Transport</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  schools,subjects,student_registration WHERE student_registration.school_id='".$_GET['id']."'
                            AND schools.id=student_registration.school_id AND student_registration.year_id='$year_id' 
                            AND subjects.id=student_registration.subject_id order by student_registration.id DESC   ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['subject_name']; ?>(<?php echo $rows['subject_code']; ?>)</td>
                                 <td><?php echo $rows['sess_num']; ?></td>
                                 <td><?php          
                                $check_exits=$con->query("SELECT * FROM  schools where id='".$rows['address_id']."'   ") 
                                    or die(mysqli_error($con));
                                while($row=$check_exits->fetch_assoc()){
                                   $school_acc=$row['school_name'] ;
                                 $center_number=$row['center_num'];
                                }?>
                                <?php echo $school_acc; ?>(<?php echo $center_number; ?>)</td>
                                
                            <td><?php echo $rows['transport']; ?></td>
                                  
                                <td><a href="?recording_sessions&id=<?php echo $rows['school_id']; ?>&del=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" onclick="return confirm('Are you sure you wish to Delete <?php echo $rows['subject_name']; ?> because  related Data will be lost')" class="btn btn-danger btn-xs">Delete </a>
                                <a href="?recording_sessions&id=<?php echo $rows['school_id']; ?>&edit=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-primary btn-xs">Edit</a>
                            
                            </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                       