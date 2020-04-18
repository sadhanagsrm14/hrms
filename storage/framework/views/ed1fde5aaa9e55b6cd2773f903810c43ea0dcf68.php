

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Projects'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>Projects</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active">Projects</a></li>

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

						<h4 class="panel-title">Projects</h4>

					</div>

					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table" id="datatable">

								<thead>

									<tr>

										<th>Project ID</th>
										<th>Project Name</th>
										<th>Assigned To</th>
										<th>Reporting To</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Client Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>

								</thead>

								<tbody>

									<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>

										<td><b><?php echo e($project->project_id); ?></b></td>
										<td><a href="<?php echo e(URL('/admin/project/'.$project->id)); ?>"><?php echo e(getProjectById($project->id)->name); ?></a></td>
											<td><a href="<?php echo e(URL('/admin/employee/profile/'.$project->user_id)); ?>"><?php echo e(getUserById($project->user_id)['first_name']); ?></a></td>
												<td><a href="<?php echo e(URL('/admin/employee/profile/'.$project->reporting_to)); ?>"><?php echo e(getUserById($project->reporting_to)['first_name']); ?> <?php echo e(getUserById($project->reporting_to)['last_name']); ?></a></td>
										<td><?php echo e($project->start_date); ?></td>
										<td><?php echo e($project->end_date); ?></td>
										<td><?php echo e($project->client_name); ?></td>
										<td><?php if($project->project_status == -1): ?>
											<b class="text-warning">Not Started</b>
											<?php elseif($project->project_status == 0): ?>
											<b class="text-primary">In Progress</b>
											<?php elseif($project->project_status == 1): ?>
											<b class="text-danger">Completed</b>
											<?php endif; ?></td>
										<td>
											<a href="<?php echo e(URL('/admin/project/'.$project->id)); ?>" class="btn btn-primary">View</a>
											<!-- <a href="<?php echo e(URL('/admin/project/'.$project->id)); ?>" class="btn btn-primary">Update</a> -->
											<!-- <a href="<?php echo e(URL('/admin/project/delete/'.$project->id)); ?>" class="btn btn-danger">Delete</a> -->
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
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>