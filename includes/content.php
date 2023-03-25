<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Reception Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
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
									if(isset($_GET['create_subdiv'])){
										include '../SuperAdmin/Settings/create_subdiv.php';
									}
									if(isset($_GET['creating_subdiv'])){
										include '../SuperAdmin/Settings/creating_subdiv.php';
									}
									if(isset($_GET['accomo_center'])){
										include '../SuperAdmin/Settings/acommo_center.php';
									}

									if(isset($_GET['creating_acoomo_center'])){
										include '../SuperAdmin/Settings/creating_acoomo_center.php';
									}
									
									if(isset($_GET['create_accomo_center'])){
										include '../SuperAdmin/Settings/create_acommo_center.php';
									}
									if(isset($_GET['set_acoomo_center'])){
										include '../SuperAdmin/Settings/set_acoomo_center.php';
									}
									if(isset($_GET['reg_center'])){
										include '../SuperAdmin/Settings/reg_center.php';
									}

									if(isset($_GET['create_reg_center'])){
										include '../SuperAdmin/Settings/creating_reg_center.php';
									}
									if(isset($_GET['speciality'])){
										include '../SuperAdmin/Settings/speciality.php';
									}

									if(isset($_GET['subjects'])){
										include '../SuperAdmin/Settings/subjects.php';
									}

									if(isset($_GET['creating_subjects'])){
										include '../SuperAdmin/Settings/creating_subjects.php';
									}
									
									if(isset($_GET['rates'])){
										include '../SuperAdmin/Settings/rates.php';
									}
									if(isset($_GET['subject_rate'])){
										include '../SuperAdmin/Settings/subject_rate.php';
									}

///////////////////////////////////////// Recordings 

									if(isset($_GET['rec_student'])){
										include '../SuperAdmin/Recordings/index.php';
									}
									if(isset($_GET['register_students'])){
										include '../SuperAdmin/Recordings/all_schools.php';
									}

									if(isset($_GET['registering_materials'])){
										include '../SuperAdmin/Recordings/registering_students.php';
									}

									if(isset($_GET['student_regs'])){
										include '../SuperAdmin/Recordings/students_registering.php';
									}

									////////////////Reports

									if(isset($_GET['materials'])){
										include '../SuperAdmin/Reports/index.php';
									}
									
									if(isset($_GET['regstud_reports'])){
										include '../SuperAdmin/Reports/regstud_reports.php';
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
										include '../SuperAdmin/Reports/index.php';
									}
									if(isset($_GET['by_camp'])){
										include '../SuperAdmin/Reports/by_camp.php';
									}
									if(isset($_GET['class_lists'])){
										include '../SuperAdmin/Reports/class_lists.php';
									}
									if(isset($_GET['classlists_bycamp'])){
										include '../SuperAdmin/Reports/classlists_bycamp.php';
									}
									if(isset($_GET['general_finance'])){
										include '../SuperAdmin/Reports/general_finance.php';
									}
									if(isset($_GET['sector_finance'])){
										include '../SuperAdmin/Reports/sector_finance.php';
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

									if(isset($_GET['change_campus'])){
										include '../SuperAdmin/Users/change_campus.php';
									}

									if(isset($_GET['renew_account'])){
										include '../SuperAdmin/Users/renew_account.php';
									}
								
								?>
                                
                                
                                
                                
                                
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->