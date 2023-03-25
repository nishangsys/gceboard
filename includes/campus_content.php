<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Welcome</a>
							</li>
							<li class="active">Campus Admission Officer for <span style="color:#00f; font-weight:bold"><?php echo $camp_name; ?></span></li>
						    <li class="active">Academic Year : <span
                            style="color:#f00; font-weight:bold"><?php echo $cur_ayear; ?></span></li>
                        
                        </ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								<?php if (isset($_GET['link'])){
									echo $_GET['link'];
								}
								; ?>
							
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php
									if(isset($_GET['start_reg'])){
										include '../Campus/chose_campus.php';
									}
									if(isset($_GET['create_student'])){
										include '../Campus/create_student.php';
									}
									
									 if (isset($_GET['step_one'])) {
                            include '../Campus/Apply/step_one.php';
                        }
                        if (isset($_GET['confirm_dtype'])) {
                            include '../Campus/Apply/confirm_dtype.php';
                        }
                        if (isset($_GET['start_app'])) {
                            include '../Campus/Apply/start_app.php';
                        }
                        if (isset($_GET['stage_two'])) {
                            include '../Campus/Apply/stage_two.php';
                        }
                        if (isset($_GET['stage_three'])) {
                            include '../Campus/Apply/stage_three.php';
                        }
                        if (isset($_GET['stage_four'])) {
                            include '../Campus/Apply/stage_four.php';
                        }
                        if (isset($_GET['stage_five'])) {
                            include '../Campus/Apply/stage_five.php';
                        }
                        if (isset($_GET['print_form'])) {
                            include '../Campus/Apply/all_applied.php';
                        }

						if (isset($_GET['change_campus'])) {
                            include '../Campus/Apply/all_applicants.php';
                        }
						if (isset($_GET['changing_campus'])) {
                            include '../Campus/Apply/changing_campus.php';
                        }

						if (isset($_GET['update_bio'])) {
                            include '../Campus/Apply/update_bio.php';
                        }
						if (isset($_GET['continue'])) {
                            include '../Campus/Apply/all_started.php';
                        }
						if (isset($_GET['admit_applicant'])) {
                            include '../Campus/Apply/all_applicant.php';
                        }

                        if (isset($_GET['daily_apps'])) {
                            include '../Campus/Apply/daily_app.php';
                        }
                        
                        if (isset($_GET['details'])) {
                            include '../Campus/Apply/details.php';
                        }
                        if (isset($_GET['details_date'])) {
                            include '../Campus/Apply/details_date.php';
                        }

						
						if (isset($_GET['Campus_letters'])) {
                            include '../Campus/Apply/Campus_letters.php';
                        }

						if (isset($_GET['Campus'])) {
                            include '../Campus/Apply/Campus.php';
                        }

						if (isset($_GET['distant_applicant'])) {
                            include '../Campus/Apply/distant_applicant.php';
                        }
						if (isset($_GET['distant'])) {
                            include '../Campus/Apply/distant_Campus.php';
                        }


						if(isset($_GET['by_program'])){
							include '../SuperAdmin/Reports/by_program_camp.php';
						}
						
						if(isset($_GET['prog_app'])){
							include '../SuperAdmin/Reports/prog_app_bycamp.php';
						}
						
						if(isset($_GET['to_applicants'])){
							include '../SuperAdmin/SMS/index.php';
						}
						if(isset($_GET['app_degre'])){
							include '../SuperAdmin/Reports/app_deg.php';
						}
                        if(isset($_GET['app_degre_camp'])){
							include '../SuperAdmin/Reports/app_deg_camp.php';
						}
						if(isset($_GET['uncompleted_distant_applicant'])){
							include '../Campus/Apply/uncompleted_distant_applicant.php';
						}
                        if (isset($_GET['financial'])) {
                            include '../Campus/Apply/financial.php';
                        }
						if(isset($_GET['class_lists'])){
							include '../SuperAdmin/Reports/class_lists.php';
						}
						if(isset($_GET['classlists_bycamp'])){
							include '../SuperAdmin/Reports/classlists_bycamp.php';
						}
                        
							
							
							
									
									
									
									if(isset($_GET['reset_password'])){
										include '../SuperAdmin/Settings/reset_password.php';
									}
									if(isset($_GET['approve_pmts'])){
										include '../SuperAdmin/Settings/approve_pmts.php';
									}

									if(isset($_GET['approve_this_pmts'])){
										include '../SuperAdmin/Settings/approve_this_pmts.php';
									}

									
									if(isset($_GET['edit_rooms'])){
										include '../SuperAdmin/Rooms/edit_rooms.php';
									}
								
									
									if(isset($_GET['by_degree'])){
										include '../SuperAdmin/Reports/by_degree.php';
									}
									if(isset($_GET['general_finance'])){
										include '../SuperAdmin/Reports/general_finance.php';
									}
									if(isset($_GET['sector_finance'])){
										include '../SuperAdmin/Reports/sector_finance.php';
									}


									
						if (isset($_GET['change_prog'])) {
                            include '../Campus/Apply/change_prog.php';
                        }
						
						if (isset($_GET['changing_prog'])) {
                            include '../Campus/Apply/changing_prog.php';
                        }
						if (isset($_GET['changing_progsave'])) {
                            include '../Campus/Apply/changing_progsave.php';
                        }
                        if (isset($_GET['admission_letters'])) {
                            include '../Admission/Apply/admission_letters.php';
                        }

						if (isset($_GET['admission'])) {
                            include '../Campus/Apply/admission.php';
                        }
									
									
									
									
									
									
									
									
									if(isset($_GET['change_password'])){
										include '../SuperAdmin/Users/change_password.php';
									}
								
								   if(isset($_GET['change_pwd'])){
										include '../SuperAdmin/Users/change_pwd.php';
									}
								
								   if(isset($_GET['access_others'])){
										include '../SuperAdmin/Users/access_others.php';
									}
									  if(isset($_GET['create_users'])){
										include '../SuperAdmin/Users/create_users.php';
									}
								
								?>
                                
                                
                                
                                
                                
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->