<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Profile'); ?>

<div class="page-inner">
	<div class="page-title">
		<h3>Profile</h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo e(URL('/hrManager/dashboard')); ?>">Home</a></li>
				<li><a href="<?php echo e(URL('/hrManager/request/profile-update')); ?>">Request</a></a></li>
				<li class="active"><?php echo e($profile->first_name); ?></a></li>
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
						<form action="" method="post" >
							<?php echo e(csrf_field()); ?>

							<div class="col-md-12">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="first_name">First Name</label>
										<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo e($profile->first_name); ?>" placeholder="First Name">
									</div>
									<div class="form-group  col-md-6">
										<label for="last_name">Last Name</label>
										<input type="text" class="form-control col-md-6" name="last_name" id="last_name"  value="<?php echo e($profile->last_name); ?>" placeholder="Last Name" >
									</div>

									<div class="form-group  col-md-12">
										<label for="address">Address</label>
										<textarea name="address" id="address"  class="form-control" cols="30" rows="10"><?php echo e($profile->address); ?></textarea>
									</div>
									<div class="form-group  col-md-6">
										<label for="phone_number">Phone #</label>
										<input type="text" class="form-control col-md-6" name="phone_number" id="phone_number" value="<?php echo e($profile->phone_number); ?>" placeholder="Phone number" >
									</div>
									<div class="form-group  col-md-6">
										<label for="account_no">Account #</label>
										<input type="text" class="form-control col-md-6" name="account_no" id="account_no" value="<?php echo e($profile->bank_account); ?>" placeholder="Account number" >
									</div>
									
									<div class="form-group  col-md-6">
										<label for="dob">Date Of Birth</label>
										<input type="text" class="datepicker form-control col-md-6" name="dob" id="dob"  value="<?php echo e($profile->dob); ?>" placeholder="Date Of Birth" >
									</div>
									<div class="form-group  col-md-6">
										<label for="anniversary_date">Anniversary</label>
										<input type="text" class="datepicker form-control col-md-6" name="anniversary_date" id="anniversary_date"  value="<?php echo e($profile->anniversary_date); ?>" placeholder="Anniversary" >
									</div>

									<div class="form-group col-md-12 per-bor">
										<label for="personal_info">Personal Details</label>
									</div>

									<div class="form-group col-md-12">
										<label for="personal_email">Personal Email</label>
										<input type="email" class="form-control" name="personal_email" id="personal_email"  value="<?php echo e($profile->personal_email); ?>" placeholder="Enter email" >
									</div>

									<div class="form-group col-md-6">
										<label for="father_name">Father Name</label>
										<input type="text" class="form-control" name="father_name" id="father_name"  value="<?php echo e($profile->father_name); ?>" placeholder="Father Name">
									</div>
									<div class="form-group col-md-6">
										<label for="mother_name">Mother Name</label>
										<input type="text" class="form-control" name="mother_name" id="mother_name"  value="<?php echo e($profile->mother_name); ?>" placeholder="Mother Name">
									</div>

									<div class="form-group col-md-6">
										<label for="parent_number">Parent Contact No.</label>
										<input type="text" class="form-control" name="parent_number" id="parent_number"  value="<?php echo e($profile->parent_contact_number); ?>" placeholder="Parent Contact Number">
									</div>
								</div>
								<ul class="pager wizard">
									<a href="<?php echo e(URL('/hrManager/request/profile/approve/'.$employee->id)); ?>" class="btn btn-primary" >Approve</a>
									<a href="<?php echo e(URL('/hrManager/request/profile/discard/'.$employee->id)); ?>" class="btn btn-danger" >Discard</a>
								</ul> 
							</form>
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