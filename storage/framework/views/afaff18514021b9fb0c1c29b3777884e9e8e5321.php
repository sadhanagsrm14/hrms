<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Dashboard'); ?>


<div class="page-inner">
	<div class="page-title">
		<h3>Dashboard</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/hrManager/dashboard')); ?>">Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div>
	</div>
	<div id="main-wrapper">
		<div class="row" id="dashboard">
			<div class="col-lg-3 col-md-6">
				<a href="<?php echo e(URL('/hrManager/employees')); ?>" title="" class="weight-hover">
					<div class="panel info-box panel-white">
						<div class="panel-body">
                        <div class="info-box-icon">
								<i class="icon-users"></i>
							</div>
							<div class="info-box-stats">
								<span class="info-box-title">Active Employees</span>
							</div>

						</div>
					</div>
				</a>
			</div>

			<div class="col-lg-3 col-md-6">
				<a href="<?php echo e(URL('/hrManager/leave-listing?type=pending')); ?>" title="" class="weight-hover">
					<div class="panel info-box panel-white">
						<div class="panel-body">
                        <div class="info-box-icon">
								<i class="icon-users"></i>
							</div>
							<div class="info-box-stats">
								
								<span class="info-box-title">Leave Requests</span>
							</div>
							
							
						</div>
					</div>
					</a>
					</div>

					<div class="col-lg-3 col-md-6">
						<a href="<?php echo e(URL('/hrManager/request/profile-update')); ?>" title="" class="weight-hover">
							<div class="panel info-box panel-white">
								<div class="panel-body">
                                <div class="info-box-icon">
										<i class="icon-users"></i>
									</div>
									<div class="info-box-stats">
										
										<span class="info-box-title">Profile Update Requests</span>
									</div>
									
								
								</div>
							</div>
							</a>
							</div>

							<!--add new div -->
							<div class="col-lg-3 col-md-6">
								<a href="https://drive.google.com/drive/" title="" class="weight-hover">
									<div class="panel info-box panel-white">
										<div class="panel-body">
                                        	<div class="info-box-icon">
												<i class="fa fa-google"></i>
											</div>
											<div class="info-box-stats">
											
												<span class="info-box-title">Google Drive</span>
											</div>
										
											
										</div>
									</div>
									</a>
									</div>
									<div class="col-lg-3 col-md-6">
										<a href="#" data-toggle="modal" data-target="#myModal-changepass" title="" class="weight-hover">
											<div class="panel info-box panel-white">
												<div class="panel-body">
                                                <div class="info-box-icon">
														<i class="icon-pencil"></i>
													</div>

													<div class="info-box-stats">
													
														<span class="info-box-title">Change password</span>
													</div>
													
												

												</div>
											</div>
										</a>
									</div>

									<div class="col-lg-3 col-md-6">
										<a href="<?php echo e(URL('/hrManager/holiday-calender')); ?>" title="" class="weight-hover">
											<div class="panel info-box panel-white">
												<div class="panel-body">
                                                <div class="info-box-icon">
														<i class="fa fa-calendar"></i>
													</div>
													<div class="info-box-stats">
												
														<span class="info-box-title">Holiday Calender</span>
													</div>
													
												</div>
											</div>
											</a>
											</div>

											<!--add new div -->
											<div class="col-lg-3 col-md-6">
												<a href="<?php echo e(URL('/hrManager/attendance')); ?>" title="" class="weight-hover">
													<div class="panel info-box panel-white">
														<div class="panel-body">
                                                        	<div class="info-box-icon">
																<i class="icon-users"></i>
															</div>
															<div class="info-box-stats">
																
																<span class="info-box-title">Attendance</span>
															</div>
														
															
														</div>
													</div>
													</a>
													</div>
													<div class="col-lg-3 col-md-6">
														<a href="<?php echo e(URL('/profile')); ?>" title="" class="weight-hover">
															<div class="panel info-box panel-white">
																<div class="panel-body">
                                                                <div class="info-box-icon">
																		<i class="icon-eye"></i>
																	</div>
																	<div class="info-box-stats">
																
																		<span class="info-box-title">View Profile</span>
																	</div>
																	
																	
																</div>
															</div>
															</a>
															</div>


            <!--add new div --->
			
        </div><!-- Row -->
        </div>


        <div class="page-footer">
        	<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>
        </div>
    </div><!-- Page Inner -->
    <?php $__env->startSection('script'); ?>

    <?php echo e(Html::script("assets/plugins/waypoints/jquery.waypoints.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/jquery-counterup/jquery.counterup.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/toastr/toastr.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/flot/jquery.flot.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/flot/jquery.flot.time.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/flot/jquery.flot.symbol.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/flot/jquery.flot.resize.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/flot/jquery.flot.tooltip.min.js")); ?>

    <?php echo e(Html::script("assets/plugins/curvedlines/curvedLines.js")); ?>

    <?php echo e(Html::script("assets/plugins/metrojs/MetroJs.min.js")); ?>

    <?php echo e(Html::script("assets/js/pages/dashboard.js")); ?>

    <?php $__env->stopSection(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('hrManager.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>