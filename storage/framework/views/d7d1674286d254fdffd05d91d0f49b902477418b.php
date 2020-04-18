

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Profile Update Request'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Profile Update Request</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

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

						<div class="table-responsive table-remove-padding">

							<table class="table datatable" id="">

								<thead>

									<tr>

										<th>Employee Name</th>

										<th>Date</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><a href="<?php echo e(URL('/admin/employee/'.$employee->id)); ?>"><?php echo e($employee->first_name); ?></a></td>

										<td><?php echo e($employee->updated_at); ?></td>

										<td>

											<a href="<?php echo e(URL('admin/request/profile/'.$employee->id)); ?>" class="btn btn-primary">View</a>

											<!-- <a href="<?php echo e(URL('admin/request/profile/approve/'.$employee->id)); ?>" class="btn btn-danger">Approve</a>

											<a href="<?php echo e(URL('admin/request/profile/discard/'.$employee->id)); ?>" class="btn btn-danger">Discard</a> -->

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

	<script>

		$( ".datatable" ).DataTable({

			"order": [[ 1, "desc" ]]

		});

	</script>

	<?php $__env->stopSection(); ?>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>