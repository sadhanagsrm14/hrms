<?php $__env->startSection('style'); ?>

<?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables.min.css")); ?>


<?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables_themeroller.css")); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Profile Update Request'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Profile Update Request</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/hrManager/dashboard')); ?>">Home</a></li>

				<li class="active">All Profile Update Request</a></li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row">

			<div class="col-md-12">

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

				<div class="panel panel-white">

					<div class="panel-heading clearfix">

						<!-- <h4 class="panel-title">Sent employees</h4> -->

					</div>

					<div class="panel-body">

						<div class="table-responsive">

							<table class="table" id="datatable">

								<thead>

									<tr>

										<th>#</th>

										<th>Employee Name</th>

										<th>Date</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($employee->id); ?></td>

										<td><a href="<?php echo e(URL('/hrManager/employee/profile/'.$employee->id)); ?>"><?php echo e($employee->first_name); ?></a></td>

										<td><?php echo e($employee->updated_at); ?></td>

										<td>

											<a href="<?php echo e(URL('hrManager/request/profile/'.$employee->id)); ?>" class="btn btn-primary">View</a>

											<!-- <a href="<?php echo e(URL('hrManager/request/profile/approve/'.$employee->id)); ?>" class="btn btn-danger">Approve</a>

											<a href="<?php echo e(URL('hrManager/request/profile/discard/'.$employee->id)); ?>" class="btn btn-danger">Discard</a> -->

										</tr>

										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									</tbody>

								</table>

							</div>

						</div>

					</div>

				</div>

			</div><!-- Row -->

		</div><!-- Main Wrapper -->

		<div class="page-footer">

			<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>

		</div>

	</div><!-- Page Inner -->

	<?php $__env->startSection('script'); ?>

	<?php echo e(Html::script("assets/plugins/datatables/js/jquery.datatables.min.js")); ?>


	<script>

		$( "#datatable" ).DataTable({

			"order": [[ 0, "desc" ]]

		});

	</script>

	<?php $__env->stopSection(); ?>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('hrManager.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>