<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Team Members EODs'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Team Members EODs</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li class="active">Team Members EODs</a></li>
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
						<h4 class="panel-title">Team Members EODs</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table" id="datatable">
								<thead>
									<tr>
										<th>EOD Date</th>
										<th>Team Member Name</th>
										<th>Project Name</th>
										<th>Hours Spent</th>
										<th>Tasks</th>
										<th>Comment</th>
									</tr>
								</thead>
								<tbody>
									
									<?php for($i = 0; $i< count($eod) ; $i++): ?>
									<?php $__currentLoopData = $eod[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($eod->date_of_eod); ?></td>
										<td><b><?php echo e(getUserById($eod->user_id)->first_name); ?> <?php echo e(getUserById($eod->user_id)->last_name); ?></b></td>
										<td><b><?php echo e(getProject($eod->project_id)->name); ?></b></td>
										<td><?php echo e($eod->hours_spent); ?></td>
										<td><?php echo e($eod->task); ?></td>
										<td>
											<?php if(is_null($eod->comment)): ?>
											<b>N/A</b>
											<?php else: ?>
											<?php echo e($eod->comment); ?>

											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Row -->
	</div><!-- Main Wrapper -->


	<div class="modal fade view-eod-list" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="mySmallModalLabel" ><i class="fa fa-pencil fa-2x" aria-hidden="true"> EOD Details</i></h4>
					<p>System Code:1110</p>
				</div>
				<div class="modal-body">
					<h5>Date:<span id="eodDate"></span></h5>
					<div class="table-responsive table-remove-padding">
						<table class="table">
							<thead>
								<tr>
									<th>Project</th>
									<th>Hours Spent</th>
									<th>Task</th>
								</tr>
							</thead>
							<tbody id="subEods">
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>

	<div class="page-footer">
		<p class="no-s"> <?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt. Ltd.</p>
	</div>
</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<script>
	
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>