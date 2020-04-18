<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Assigned Projects'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>My Assigned Projects</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>

				<li class="active">My Assigned Projects</a></li>

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

						<h4 class="panel-title">My Assigned Projects</h4>

					</div>

					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table">

								<thead>

									<tr>

										<th>Project</th>

										<th>Reporting To</th>

										<th>From Date</th>

										<th>End Date</th>

										<th>Status</th>
											
									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><?php echo e(getProjectById($project->project_id)->name); ?></td>

										<td><?php echo e(getUserById($project->reporting_to)->first_name); ?></td>

										<td><?php echo e($project->from_date); ?></td>

										<td><?php echo e($project->end_date); ?></td>

										<td>

											<?php if($project->project_status == -1): ?>

											<b class="text-warning">Not Started</b>

											<?php elseif($project->project_status == 0): ?>

											<b class="text-primary">In Progress</b>

											<?php elseif($project->project_status == 1): ?>

											<b class="text-danger">Completed</b>

											<?php endif; ?>

										</td>

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

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>