
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="index.php?all_programs">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text">All Our Programs </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="?view_pmts">
								<i class="menu-icon fa fa-book"></i>
							<span class="menu-text">View Payments Data </span>
						</a>

						<b class="arrow"></b>
					</li>


					<li class="">
						<a href="?step_one">
								<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Start Application </span>
						</a>

						<b class="arrow"></b>
					</li>
                    <?php 
					$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='4'  ") or die(mysqli_error($con));
					$counts=$select_stage->num_rows;
					if($counts<1){
					}
					else {
						$select=$con->query("SELECT * FROM  personal_details where your_id='$your_id'  ") or die(mysqli_error($con));
						while($rows=$select->fetch_assoc()){
			?>

					<li class="">
						<a href="?stage_five&id=<?php echo base64_encode($rows['deg_type']); ?>&g=<?php echo $your_id; ?>">
							<i class="menu-icon fa fa-external-link"></i>

							<span class="menu-text">
								Submit Form

								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>
                    <?php } } ?>




 <?php 
					$select_stage=$con->query("SELECT * FROM  person_stage where your_id='$your_id' AND stage='4'  ") or die(mysqli_error($con));
					$counts=$select_stage->num_rows;
					if($counts<1){
					}
					else {
						$select=$con->query("SELECT * FROM  personal_details where your_id='$your_id'  ") or die(mysqli_error($con));
						while($rows=$select->fetch_assoc()){
			?>

					<li class="">
						<a href="../Admission/Apply/print.php?your_id=<?php  echo $rows['your_id'];  ?>&gdgdggd " target="_blank" >
							<i class="menu-icon fa fa-download"></i>

							<span class="menu-text">
								Download Form

								
							</span>
						</a>

						<b class="arrow"></b>
					</li>
                    <?php } } ?>
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>

							<span class="menu-text">
								Accounts & Users

								
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						

							<li class="">
								<a href="../logout.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Log Out
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
				</ul><!-- /.nav-list -->
              

			

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>