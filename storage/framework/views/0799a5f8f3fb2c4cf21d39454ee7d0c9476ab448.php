<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','My Leaves'); ?>



<div class="page-inner">

	<div class="page-title">

		<h3>My Leaves</h3>

		<div class="page-breadcrumb">

			<ol class="breadcrumb">

				<li><a href="<?php echo e(URL('/hrManager/dashboard')); ?>">Home</a></li>

				<li class="active">My Leaves</a></li>

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

						<h4 class="panel-title">My Leaves</h4>

					</div>

					<div class="panel-body">

						<div class="table-responsive table-remove-padding">

							<table class="table">

								<thead>

									<tr>

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

										<td><?php echo e($leave->date_from); ?></td>

										<td><?php echo e($leave->date_to); ?></td>

										<td><?php echo e($leave->days); ?></td>

										<td><?php echo e($leave->leave_type->leave_type); ?></td>

										<td>

											<?php if($leave->is_approved == -1): ?>

											<span class="label label-danger">Discarded</span>

											<?php elseif($leave->is_approved == 0): ?>

											<span class="label label-warning">Pending</span>

											<?php elseif($leave->is_approved == 1): ?>

											<span class="label label-success">Approved</span>

											<?php endif; ?>

										</td>
										<td><?php if($leave->is_approved == 1 && $leave->date_from >= date('m/d/Y') ): ?>
											<a href="#" data-target="#myModal<?php echo e($leave->id); ?>" class="btn btn-primary" data-toggle="modal" >Retract</a>
											<?php elseif($leave->is_approved == 2): ?>
											<span class="text-warring">Wait For Admin Action</span>
                                             <?php endif; ?>

										</td>
										<td><!---------------------------Leave modal------------------------------>

 
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo e($leave->id); ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-success">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Apply Retact</h4>
        </div>
        <div class="modal-body">
         <div class="panel-body">

						<form class="form-horizontal" method="post" action="<?php echo e(url('/hrManager/retract/leave/'.$leave->id)); ?>" enctype="multipart/form-data" id="resignForm<?php echo e($leave->id); ?>">

							<div class="box-body">

								<?php echo e(csrf_field()); ?>


								<div class="form-group">

									<label for="reason" class="col-sm-2 control-label">Reason For Restract</label>

									<div class="col-sm-10">

										<select name="reason_retract" id="reason<?php echo e($leave->id); ?>" class="form-control select2" required>

											<option value="">--Select Reason--</option>

											<option value="Work is Completed">Work is Completed</option>

											<option value="You change your mind">You change your mind</option>

											

										</select>

										<?php if($errors->has('reason')): ?>

										<span class="label label-danger"><?php echo e($errors->first('reason')); ?></span>

										<?php endif; ?>

									</div>

								</div>
								

								<input type="hidden" id="resignation_reason<?php echo e($leave->id); ?>">

								<input type="hidden" id="type<?php echo e($leave->id); ?>" name="type">

								<div class="form-group">

									<label for="message" class="col-sm-2 control-label">Message</label>

									<div class="col-sm-10">

										<textarea name="message_retract" id="message<?php echo e($leave->id); ?>" cols="30" rows="10" class="form-control" required></textarea>

										<?php if($errors->has('message')): ?>

										<span class="label label-danger"><?php echo e($errors->first('message')); ?></span>

										<?php endif; ?>

									</div>

								</div>
								

							</div>

							<!-- /.box-body -->

							<div class="modal-footer">

											<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Cancel</button>

											<button type="submit" class="btn btn-info pull-right btn-info-re">Submit</button>

										</div>

										
							<!-- preview Modal -->

						</form>

					</div>
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
  </div>
  

<!-----------------------leave modal--------------------------------></td>

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
<?php echo $__env->make('hrManager.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>