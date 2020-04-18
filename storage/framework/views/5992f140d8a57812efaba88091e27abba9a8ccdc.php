<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','EODs'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>EODs</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li class="active">All EODs</a></li>
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
						<!-- <h4 class="panel-title">Sent EODs</h4> -->
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table" id="datatable">
								<thead>
									<tr>
										<th>Employee</th>
										<th>Date</th>
										<th>Project Name</th>
										<th>Hours Spent</th>
										<th>Task</th>
										<th>Comment</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $eods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($eod->date_of_eod); ?></td>
										<td><a href="<?php echo e(URL('/admin/employee/profile/'.$eod->user_id)); ?>"><?php echo e(getUserById($eod->user_id)->first_name); ?></a></td>
										<td><?php echo e(getProject($eod->project_id)->name); ?></td>
										<td><?php echo e($eod->hours_spent); ?></td>
										<td><?php echo e($eod->task); ?></td>
										<td>
											<?php if(is_null($eod->comment)): ?>
											<b>N/A</b>
											<?php else: ?>
											<?php echo e($eod->comment); ?>

											<?php endif; ?>
										</td>
										<td>
											<a href="<?php echo e(URL('admin/eod/delete/'.$eod->id)); ?>" class="btn btn-danger">Delete</a>
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