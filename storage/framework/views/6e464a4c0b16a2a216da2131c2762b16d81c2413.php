

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Dashboard'); ?>





<div class="page-inner">

	<div class="page-title">

		<h3>Dashboard</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/')); ?>">Home</a></li>

				<li class="active">Dashboard</li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row" id="dashboard">

			

			<div class="col-lg-4 col-md-6">

				<a href="<?php echo e(URL('/itExecutive/assets/all_assets')); ?>" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-th-list"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">Asset List</span>

							</div>

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-4 col-md-6">

				<a href="<?php echo e(URL('/itExecutive/assets/all_system')); ?>" class="weight-hover">

					<div class="panel info-box panel-white">

						<div class="panel-body">

							<div class="info-box-icon">

								<i class="fa fa-cogs"></i>

							</div>

							<div class="info-box-stats">

								<span class="info-box-title">System List</span>

							</div>

						</div>

					</div>

				</a>

			</div>



			<div class="col-lg-4 col-md-6">

				<a href="#" data-toggle="modal" data-target="#myModal" title="" class="weight-hover">

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



			<div class="col-lg-4 col-md-6">

				<a href="<?php echo e(URL('/itExecutive/holiday-calender')); ?>" title="" class="weight-hover">

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









			<div class="col-lg-4 col-md-6">

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



			<div class="col-lg-4 col-md-6">

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

	</div><!-- Main Wrapper -->

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


<?php echo $__env->make('itExecutive.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>