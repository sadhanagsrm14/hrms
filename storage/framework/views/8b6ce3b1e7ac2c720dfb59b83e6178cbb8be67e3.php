<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Asset'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Asset</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/admin/dashboard')); ?>">Home</a></li>
				<li class="active"><a href="<?php echo e(URL('/admin/assets')); ?>">Asset</a></li>
			</ol>
		</div>
	</div>
	<div id="main-wrapper">
		<div class="row">

			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Responsive table</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Asset Code</th>
										<th>System</th>
										<th>Name</th>
										<th>S.No</th>
										<th>Purchase/Bill Date</th>
										<th>Repair/Replacement Date</th>
										<th>Warranty</th>
										<th>Warranty End Date</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($asset->asset_code); ?></td>
										<td><?php echo e($asset->master_asset->name); ?></td>
										<td><?php echo e($asset->asset->name); ?></td>
										<td><?php echo e($asset->s_no); ?></td>
										<td><?php echo e($asset->purchase_bill_date); ?></td>
										<td><?php echo e($asset->repair_replacement_date); ?></td>
										<td><b><?php echo e($asset->is_warranty = 1 ?"Yes":"No"); ?></b></td>
										<td><?php echo e($asset->warranty_end_date); ?></td>
										<td><?php echo e($asset->user_id); ?></td>
										<td><?php echo e($asset->status); ?></td>
										<td> 
											<?php if($asset->status == "assigned"): ?>
											<a class="btn btn-primary" href="<?php echo e(URL('admin/asset/release'.$asset->id)); ?>">Release</a>
											<?php else: ?>
											<a class="btn btn-primary" href="<?php echo e(URL('admin/asset/'.$asset->id)); ?>">Assign</a>
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
		<p class="no-s">2015 &copy; Modern by Steelcoders.</p>
	</div>
</div><!-- Page Inner -->
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>