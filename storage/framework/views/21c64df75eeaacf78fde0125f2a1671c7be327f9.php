<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Employees'); ?>

<style>

.table td, .table>tbody>tr>td

{

	

	vertical-align:  middle;

}
span.pad {
    padding-left: 5px;
}
</style>



<div class="page-inner">

	<div class="page-title">

		<h3>Employees</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>

				<li class="active"><a href="#">Employees</a></li>

			</ol>

		</div>

	</div>

	<div id="main-wrapper">

		<div class="row">

			<div class="col-md-12">
			
				<div class="panel panel-white">

					<div class="panel-heading clearfix">

						<h4 class="panel-title">View Notification</h4>

					</div>
					<div class="panel-body">

						<div class="col-sm-12 col-xl-6">
							<div class="card">
								
								<div class="card-body">
									<div class="list-group" id="notify_me_all">
									<?php $__currentLoopData = $all_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<a onclick="viewNotification(<?php echo e($notification->id); ?>)" class="list-group-item list-group-item-action flex-column align-items-start <?php echo e($notification->is_read=='1' ? '' : 'active'); ?>" href="#">
										<div class="d-flex w-100 justify-content-between">
										<small class="pull-right"><?php echo e(calculateTimeSpan($notification->created_at)); ?></small>
										<h5 class="mb-1"><?php echo e($notification->title); ?></h5>
										
										</div>
										<?php  
                                          $text = strip_tags($notification->message); 
									    ?>
										<p class="mb-1"><?php echo e(substr($text, 0, strlen($text)-4)); ?></p>
										</a>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								    <?php echo e($all_notifications->links()); ?>

								</div>
								</div>	
							</div>
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