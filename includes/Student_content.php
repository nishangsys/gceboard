<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb" style="font-size:16px">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Students Dashboard</li>
                <li class="active">Academic Year : <span
                            style="color:#f00; font-weight:bold"><?php echo $cur_ayear; ?></span></li>
                <li class="active">Application Starts on : <span
                            style="color:#f00; font-weight:bold"><?php echo date('l d-m-Y', strtotime($start_date));; ?></span>
                </li>

                <li class="active">Application Ends on : <span
                            style="color:#f00; font-weight:bold"><?php echo date('l d-m-Y', strtotime($end_date));; ?></span>
                </li>
            </ul><!-- /.breadcrumb -->

            
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
                            <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar"
                                   autocomplete="off"/>
                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar"
                                   autocomplete="off"/>
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2 ace-save-state"
                                   id="ace-settings-breadcrumbs" autocomplete="off"/>
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off"/>
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2 ace-save-state"
                                   id="ace-settings-add-container" autocomplete="off"/>
                            <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                            </label>
                        </div>
                    </div><!-- /.pull-left -->

                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover"
                                   autocomplete="off"/>
                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact"
                                   autocomplete="off"/>
                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight"
                                   autocomplete="off"/>
                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                        </div>
                    </div><!-- /.pull-left -->
                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <div class="page-header">
                <h1 style="text-align:center;font-weight:bold">
                    <span class="blink">Please remember to submit your Form at the end of this process.
                         Print out your form and 
                         deposit them at the Registry</span>
                         <br>
                         Momo Number - <span style="color:#999">Numéro Momo</span> :<span style="color:#00f">6 71 98 92 92</span> |
                   Momo Name - <span style="color:#999">Non surMomo</span> :<span style="color:#f00">EMELIE BERINYUY ASHUMBENG</span> |
                    Application Fee - <span style="color:#999">Frais d'inscription</span> :<span style="color:#00f">5,000 XAF</span>

                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <?php

                    if (isset($_GET['all_programs'])) {
                        include '../Students/all_programs.php';
                    }

                    if ($opens < 0 && $closes < 0) {
                        echo '<div class="alert alert-warning">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
											<strong>Sorry ' . $full_name . ', our Application Opens on ' . date('l d-m-Y', strtotime($start_date)) . ' and Closes on ' . date('l d-m-Y', strtotime($end_date)) . ' </span></strong>

											<br />
										</div>';

                    } else {

                        if (isset($_GET['view_pmts'])) {
                            include '../Students/view_pmts.php';
                        }
                        /*
                       
                        if (isset($_GET['step_one_starts'])) {
                            include '../Students/chose_campus.php';
                        }
                        */
                        if (isset($_GET['verify_payments'])) {
                            include '../Students/verify_payments.php';
                        }

                        if (isset($_GET['step_one'])) {
                            include '../Students/chose_campus.php';
                        }

                        if (isset($_GET['register_now'])) {
                            include '../Students/step_one.php';
                        }
                        if (isset($_GET['confirm_dtype'])) {
                            include '../Students/confirm_dtype.php';
                        }
                        if (isset($_GET['start_app'])) {
                            include '../Students/start_app.php';
                        }
                        if (isset($_GET['stage_two'])) {
                            include '../Students/stage_two.php';
                        }
                        if (isset($_GET['stage_three'])) {
                            include '../Students/stage_three.php';
                        }
                        if (isset($_GET['stage_four'])) {
                            include '../Students/stage_four.php';
                        }
                        if (isset($_GET['stage_five'])) {
                            include '../Students/stage_five.php';
                        }

                        if (isset($_GET['stage_six'])) {
                            include '../Students/stage_six.php';
                        }
                        if (isset($_GET['print_form'])) {
                            include '../Students/print_form.php';
                        }
                        if (isset($_GET['momo_confirm'])) {
                            include '../Students/momo_confirmation_page.php';
                        }
                        if (isset($_GET['change_password'])) {
                            include '../SuperAdmin/Users/change_password.php';
                        }

                        if (isset($_GET['change_pwd'])) {
                            include '../SuperAdmin/Users/change_pwd.php';
                        }

                        if (isset($_GET['access_others'])) {
                            include '../SuperAdmin/Users/access_others.php';
                        }
                    }
                    ?>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->