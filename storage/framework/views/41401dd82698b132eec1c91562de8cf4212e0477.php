<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Resignations'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Resignation</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/itExecutive/dashboard')); ?>">Home</a></li>
				<li class="active">Resignations</a></li>
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
						<h4 class="panel-title">Resignations</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive table-remove-padding">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Resignation Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $resignations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resignation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($resignation->id); ?></td>
										<td><?php echo e($resignation->date_of_resign); ?></td>
										<td>
											<?php if($resignation->is_active == 1): ?>
											<span class="label label-danger">Active</span>
											<?php else: ?>
											<span class="label label-danger">Retracted</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if($resignation->is_active == 1): ?>
											<a href="<?php echo e(URL('/itExecutive/resignation/retract/'.$resignation->id)); ?>" class="btn btn-danger"><i class="fa fa-reply m-r-xs"></i>Retract</a>
											<?php else: ?>
											<span class="label label-danger">Retracted</span>
											<?php endif; ?>
											<a href="<?php echo e(URL('/resignation/'.$resignation->id)); ?>" class="btn btn-primary"><i class="fa fa-eye m-r-xs"></i>View</a>
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
<?php echo $__env->make('itExecutive.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>