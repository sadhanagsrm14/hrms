<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Resignation'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Resignation</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/itExecutive/dashboard')); ?>">Home</a></li>
				<li class="active">Resignation</a></li>
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
					<div class="message-header">
						<h3>Resignation letter </h3>
						<div class="list">
							<ul class="list-item">
								<li><span>Resignation Date: </span><?php echo e($resign->date_of_resign); ?></li>
								<li><span>Last Working Day: </span><?php echo e($resign->last_working_day); ?></li>
								<li><span>FNF Date: </span><?php echo e($resign->fnf_date); ?></li>
							</ul>
						</div>
					</div>
					<div class="message-content">
						<div class="reg-decripation">
							<table class="table">
								<tbody>
									<tr>
										<td class="table-reg-mod">Current Project</td>
										<td><?php if(is_null($resign->current_project_id)): ?>
											<b>N/A</b>
											<?php else: ?>
											<b><?php echo e(getProjectById($resign->current_project_id)->name); ?> </b>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<td class="table-reg-mod">Reporting  Manager</td>
										<td><?php if(is_null($resign->manager_id)): ?>
											<b>N/A</b>
											<?php else: ?>
											<b><?php echo e(getUserById($resign->manager_id)->first_name); ?> <?php echo e(getUserById($resign->manager_id)->last_name); ?></b>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<td class="table-reg-mod">Reason For Leaving</td>
										<td><?php echo e($resign->reason); ?></td>
									</tr>
									<tr>
										<td class="table-reg-mod">Message</td>
										<td ><?php echo e($resign->message); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<?php if($resign->is_active == 1): ?>
					<div class="message-options pull-right">
						<a href="<?php echo e(URL('/itExecutive/resignation/retract/'.$resign->id)); ?>" class="btn btn-danger"><i class="fa fa-reply m-r-xs"></i>Retract</a> 
					</div>
				</div>
				<?php endif; ?>
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
<?php echo $__env->make('itExecutive.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>