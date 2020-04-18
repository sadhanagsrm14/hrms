<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Dashboard'); ?>





<div class="page-inner">

	<div class="page-title">

		<h3>Dashboard</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>

				<li class="active">Dashboard</li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row" id="dashboard">

			<?php if(session('success')): ?>

			<div class="alert alert-success">

				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

				<?php echo e(session('success')); ?>

			</div>

			<?php endif; ?>

			<?php if(session('error')): ?>

			<div class="alert alert-danger">

				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

				<?php echo e(session('error')); ?>

			</div>

			<?php endif; ?>

			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/employee/my-leaves?type=approved')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Approved Applications</span>

							</div>

						</div>

					</div>

				</a>

			</div>

			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/employee/my-leaves?type=rejected')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Rejected Applications</span>

							</div>

						</div>

					</div>

				</a>

			</div>

			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/employee/my-leaves?type=pending')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-users"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Pending Applications</span>

							</div>

						</div>

					</div>

				</a>

			</div>

			<div class="col-lg-3 col-md-6">

				<a href="#" data-toggle="modal" data-target="#myModal-emp" title="" class="weight-hover">

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

				<a href="<?php echo e(URL('/employee/holiday-calender')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-calendar"></i>

							</div>

							<div class="info-box-stats">



								<span class="info-box-title">Holiday Calender / Attendance</span>

							</div>



						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/employee/assigned-projects')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-calendar"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">My Assigned Projects</span>

							</div>

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/employee/send-eod')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-pencil"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Send EOD</span>

							</div>

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/employee/sent-eods')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="icon-eye"></i>

							</div>

							<div class="info-box-stats">



								<span class="info-box-title">View EOD List</span>

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



			<div class="col-lg-3 col-md-6">

				<a href="<?php echo e(URL('/logout')); ?>" title="" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-sign-out m-r-xs"></i>

							</div>

							<div class="info-box-stats">



								<span class="info-box-title">Logout</span>

							</div>





						</div>

					</div>

				</a>

			</div>

		</div>

	</div>



	<!-- Main Wrapper -->

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


<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>