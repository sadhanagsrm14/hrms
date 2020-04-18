<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Knowledge Transfer list'); ?>

<style>

.table td, .table>tbody>tr>td

{

	vertical-align:  middle;

}

</style>



<div class="page-inner">

	<div class="page-title">

		<h3>Knowledge Transfer list</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active"><a href="<?php echo e(URL('/admin/kt_list')); ?>">Knowledge Transfer list</a></li>

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

						<h4 class="panel-title">Knowledge Transfer list</h4>

					</div>



					

					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table" id="datatable">

								<thead>

									<tr>

										<th>#</th>

										<th>Employee ID</th>

										<th>Employee </th>

										<th>Projects</th>
										

										<th>Assign Employee</th>
									

									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $kt_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kt_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e($kt_list->id); ?></td>

										<td>EMP00<?php echo e($kt_list->user_id); ?></td>

										<td><b><?php echo e(getUserById($kt_list->user_id)->first_name); ?> <?php echo e(getUserById($kt_list->user_id)->last_name); ?></b></td>

									

										<td><?php echo e(getProject($kt_list->project_id)['name']); ?></td>

										<td><?php echo e(getUserById($kt_list->kt_given_to)['first_name']); ?> <?php echo e(getUserById($kt_list->kt_given_to)['last_name']); ?></td>
									

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



	<!-- Modal -->

	



	<div class="page-footer">

		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>

	</div>

</div><!-- Page Inner -->

<?php $__env->startSection('script'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>