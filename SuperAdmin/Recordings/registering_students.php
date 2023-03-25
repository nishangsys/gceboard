
						<?PHP 
                       
						 
                        RecStudents($_GET['id'],$year_id);
                        
						
						if(isset($_GET['id'])){
							$sub_divname="";
							$subdiv_id="";
							$select =$con->query("SELECT * FROM  schools where id='".$_GET['id']."'  ") or die(mysqli_error($con));
							
							while($rows=$select->fetch_assoc()){
								$name=$rows['school_name'];
								$abbv=$rows['center_num'];
                                
                         
							
						
						?>
						<form method="POST" action="" class="form-horizontal" role="form">

					       	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> School: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $name; ?>" name="subject" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Center Number: </label>

										<div class="col-sm-9">
											<input type="text" value="<?php echo $abbv; ?>" name="code" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Subject : </label>

										<div class="col-sm-9">
										<select style="color:#00F; font-weight:bold" name="subject_id"   id="countries-list" class="col-xs-10 col-sm-5" required >
											<option style="color:#00F; font-weight:bold"  > </option>

                                            <?php
                                        $select_prog =$con->query("SELECT * FROM  subjects  ORDER By subject_code") or die(mysqli_error($con));
                                                        
                                            while($ok=$select_prog->fetch_assoc()){
                                        
                                                        ?>
                                            <option style="color:#00F; font-weight:bold" value="<?php echo $ok['id']; ?>"><?php echo $ok['subject_name']; ?> (<?php echo $ok['subject_code']; ?>)</option>
                                                                                <?php } ?>
											
											</select>
										</div>
									</div>

									

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  autocomplete="off" for="form-field-1"> Number of Candidates: </label>

										<div class="col-sm-9">
											<input type="number" value="<?php echo $rate_per_student; ?>" name="num" required   id="form-field-1"   class="col-xs-10 col-sm-5" />
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
											
                        <h1>All Materials for <?php echo $name; ?> this <?php echo $cur_ayear; ?></h1> 

                                            <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Subject</th>
                                <th>Materials to be Used</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
							$select =$con->query("SELECT * FROM  schools,subjects,registered_students WHERE registered_students.school_id='".$_GET['id']."'
                            AND schools.id=registered_students.school_id AND registered_students.year_id='$year_id' 
                            AND subjects.id=registered_students.subject_id order by registered_students.id DESC   ") or die(mysqli_error($con));
							$a=1;	
							while($rows=$select->fetch_assoc()){
							?>
                              <tr>
                                <td><?php echo $a++; ?></td>
                                 <td><?php echo $rows['subject_name']; ?>(<?php echo $rows['subject_code']; ?>)</td>
                                 <td><?php echo $rows['num_ofstudents']; ?></td>
                                  
                                <td><a href="?creating_acoomo_center&id=<?php echo $rows['subdiv_id']; ?>&del=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" onclick="return confirm('Are you sure you wish to Delete <?php echo $rows['school_name']; ?> because  related Data will be lost')" class="btn btn-danger btn-xs">Delete </a>
                            
                                 <a href="?creating_acoomo_center&id=<?php echo $rows['subdiv_id']; ?>&edit=<?php echo $rows['id']; ?>&888d8d8&link=<?php echo $_GET['link'] ;?>" class="btn btn-primary btn-xs">Edit</a>
                            </td>
                              </tr>
                             <?php } ?>
                            </tbody>
                      </table>
                       