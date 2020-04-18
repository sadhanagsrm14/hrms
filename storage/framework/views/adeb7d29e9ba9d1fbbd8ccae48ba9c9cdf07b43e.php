<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Resignation'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Resignation</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/employee/dashboard')); ?>">Home</a></li>
				<li class="active">Retract</a></li>
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
				<div class="mailbox-content">
					
					<div class="message-content">
						<div class="reg-decripation">
							<table class="table">
								<tbody>
									
									
									<tr>
										<td class="table-reg-mod">Reason For Leaving</td>
										<td><?php echo e($retract['reason']); ?></td>
									</tr>
									
									
									<tr>
										<td class="table-reg-mod">Message</td>
										<td ><?php echo e($retract['message']); ?></td>
									</tr>

								</tbody>
							</table>
							
						</div>
						
					</div>
					
					
					<div class="pull-left">
					<p>Retract Status:<?php if($retract->is_active == 1): ?>
											<b class="text-success">Accepted</b>

											<?php elseif($retract->is_active== 0): ?>
											<b class="text-warning">Pending</b>
											<?php elseif($retract->is_active == -1): ?>
											<b class="text-danger">Rejected</b>
											<?php endif; ?></p>
										</div>
										<?php if($retract->is_active == 1): ?>
										<div class="message-options pull-right">Click buton to retract
						<a href="<?php echo e(URL('/employee/resignation/retract/'.$retract->user_id)); ?>" class="btn btn-danger"><i class="fa fa-reply m-r-xs"></i>Retract</a>
						<?php elseif($retract->is_active == -1): ?>
						<p class="text-danger pull-right">Your Request is rejected by Admin </p>
						<?php else: ?> 
					</div>
					<?php endif; ?>
				</div>
				
			</div>
		</div>
	</div><!-- Row -->
	<!-- Main Wrapper -->
	<div class="page-footer">
		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>
	</div>
</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>