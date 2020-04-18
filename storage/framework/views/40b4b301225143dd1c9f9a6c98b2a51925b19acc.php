<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Leaves'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Leave</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li class="active">Leaves</a></li>
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
						<h4 class="panel-title">Leave</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table" id="datatable">
								<thead>
									<tr>
										<th>#</th>
										<th>Applied By</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Days</th>
										<th>Leave Type</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($leave->id); ?></td>
										<td><a href="<?php echo e(URL('/admin/employee/profile/'.$leave->user_id)); ?>"><?php echo e(getUserById($leave->user_id)->first_name); ?></a></td>
										<td><?php echo e($leave->date_from); ?></td>
										<td><?php echo e($leave->date_to); ?></td>
										<td><?php echo e($leave->days); ?></td>
										<td><?php echo e($leave->leave_type->leave_type); ?></td>
										<td>
											<?php if($leave->is_approved == -1): ?>
											<b class="text-danger">Discarded</b>
											<?php elseif($leave->is_approved == 0): ?>
											<b class="text-warning">Pending</b>
											<?php elseif($leave->is_approved == 1): ?>
											<b class="text-primary">Approved</b>
											<?php endif; ?>
										</td>
										<td>
											<?php if($leave->is_approved == 1): ?>
											<a href="<?php echo e(URL('/admin/leave/delete/'.$leave->id)); ?>" class="btn btn-danger">Delete</a>
											<?php else: ?>
											<a href="<?php echo e(URL('/admin/leave/discard/'.$leave->id)); ?>"  class="btn btn-warning">Discard</a>
											<a href="<?php echo e(URL('/admin/leave/approve/'.$leave->id)); ?>"  class="btn btn-primary">Approve</a>
											<a href="<?php echo e(URL('/admin/leave/delete/'.$leave->id)); ?>" class="btn btn-danger">Delete</a>
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
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>