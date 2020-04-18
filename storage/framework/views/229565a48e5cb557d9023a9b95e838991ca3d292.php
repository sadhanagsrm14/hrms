<?php $__env->startSection('style'); ?>
<?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables.min.css")); ?>

<?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables_themeroller.css")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Leave Types'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Leave Type</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/hrManager/dashboard')); ?>">Home</a></li>
				<li class="active">Leave Types</a></li>
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
						<h4 class="panel-title">Leave Types</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table" id="datatable">
								<thead>
									<tr>
										<th>#</th>
										<th>Leave Type</th>
										<th>Description</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $leave_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($leave_type->id); ?></td>
										<td><?php echo e($leave_type->leave_type); ?></td>
										<td><?php echo e($leave_type->description); ?></td>
										<td> 
											<a class="btn btn-primary" href="<?php echo e(URL('hrManager/leave-type/'.$leave_type->id)); ?>">Edit</a>
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
<?php echo e(Html::script("assets/plugins/datatables/js/jquery.datatables.min.js")); ?>

<script>
	$( "#datatable" ).DataTable();
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('hrManager.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>