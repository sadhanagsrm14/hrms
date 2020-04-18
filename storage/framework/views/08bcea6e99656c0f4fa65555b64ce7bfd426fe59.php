<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title','Profile'); ?>

<style>

.form-group {

	margin-right: 13px !important;

}

.per-bor {

	border-bottom: 2px solid;

}



.per-bor label {

	font-size: 20px;

	padding: 14px 0px 10px 0px;

}



#profile-page label {

	font-size: 16px;

	font-weight: 800;

}



#profile-page p {

	font-size:  15px;

}

</style>

<div class="page-inner">

	<div class="profile-cover">

		<div class="row">

			<div class="col-md-3 profile-image">

				<div class="profile-image-container">

					<img src="<?php echo e(is_null($employee->cb_profile->employee_pic) ? 'assets/images/default-user.png':$employee->cb_profile->employee_pic); ?>" alt="">

					

				</div>



			</div>



		</div>

	</div>

	<div id="main-wrapper">

		<div class="row">

			<div class="col-md-12">
              <table>
				<tr><a href="<?php echo e(URL('admin/employee/'.$employee->id)); ?>" class="btn btn-danger pull-right">Edit Profile</a></tr>
               <!--  <?php if(date('d') == 3 && $update_date < $current_date): ?>
					
						<tr><a href="<?php echo e(url('/leavecount/'.$employee->id)); ?>" class="btn btn-info pull-right" id="" >Update Leave info</a></tr>
						<?php else: ?>
						<tr><input type="button" class="btn btn-info pull-right" disabled value="Update Leave info" /></tr>
						<?php endif; ?> -->
					</table>
			</div>

			<div class="col-md-3 user-profile">

				<!--added new table-->

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
            
						<table>
						<tr><h4 class="panel-title text-center">Leave Info</h4></tr>
                      
					    
					</table>
					</div>

					<div class="panel-body">

						<div class="table-responsive">

							<table  class="display table" style="width: 100%; cellspacing: 0;">

								<tbody>

									<tr>

										 <?php if(is_null(\App\Resignation::where('user_id',$employee->id)->where('is_active',1)->first())) { ?>
                                <td>Available Leave(days)</td>
										<td><?php echo e($employee->cb_profile->avail_leaves); ?></td>
      
             
                                   <?php }else  {?>
                                      <td>Available Leave(days)</td>
										<td>0</td>
                                     <?php } ?>

									</tr>

									<tr>

										<td>Rejected Application</td>

										<td><?php echo e(count(getLeaves($employee->id,-1))); ?></td>

									</tr>

									<tr>

										<td>Pending Application</td>

										<td><?php echo e(count(getLeaves($employee->id,0))); ?></td>

									</tr>

									<tr>

										<td>Approved Application</td>

										<td><?php echo e(count(getLeaves($employee->id,1))); ?></td>

									</tr>
									<tr>
										<td>Half Days</td>
										<td><?php echo e($halfdays); ?></td>
									</tr>
									<tr>
										<td>Uninform Leave</td>
										<td><?php echo e($ui); ?></td>
									</tr>

									<tr>

										<td>Leave Taken(days)</td>

										<td><?php echo e($employee->cb_profile->leaves_taken); ?></td>

									</tr>



								</tr>

							</tbody>

						</table>

					</div>

				</div>

			</div>











			<!--added new table-->

		</div>

		<div class="col-md-9 m-t-lg">

			<div class="panel panel-white">

				<div class="panel-body">

					<div id="rootwizard">

						<ul class="nav nav-tabs" role="tablist">

							<li role="presentation" class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-user m-r-xs"></i>Personal Info</a></li>

							<li role="presentation"><a href="#tab2" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Employee CB Profile</a></li>

							<li role="presentation"><a href="#tab3" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Previous Employment Profile</a></li>

							<li role="presentation"><a href="#tab4" data-toggle="tab"><i class="fa fa-check m-r-xs"></i>Employee CB More Details</a></li>

						</ul>

						<div class="progress progress-sm m-t-sm">

							<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

							</div>

						</div>





						<!-- <form id="wizardForm"> -->

							<div class="form-horizontal">

								<div class="tab-content" id="profile-page">

									<div class="tab-content">

										<div class="tab-pane active fade in" id="tab1">

											<div class="row m-b-lg">



												<div class="row">

													<div class="form-group col-md-6">

														<label for="first_name">First Name</label>

														<p><?php echo e($employee->first_name); ?></p>

													</div>

													<div class="form-group  col-md-6">

														<label for="last_name">Last Name</label>

														<p><?php echo e($employee->last_name); ?></p>

													</div>



													<div class="form-group col-md-6">

														<label for="email">Email address</label>

														<p><?php echo e($employee->email); ?></p>

													</div>



													<div class="form-group  col-md-6">

														<label for="role">Role</label>

														<p><?php echo e(getRoleById($employee->role)); ?></p>

													</div>

													<div class="form-group  col-md-6">

														<label for="address">Gender</label>

														<address><p><?php echo e($employee->gender); ?></p></address>

													</div>



													<div class="form-group  col-md-6">

														<label for="address">Address</label>

														<address><p><?php echo e($employee->personal_profile->address); ?></p></address>

													</div>

													<div class="form-group  col-md-6">

														<label for="phone_number">Phone #</label>

														<p><?php echo e($employee->personal_profile->phone_number); ?></p>

													</div>

													<div class="form-group  col-md-6">

														<label for="account_no">Aadhar #</label>

														<p><?php echo e($employee->personal_profile->aadhar_no); ?></p>

													</div>

													<div class="form-group  col-md-6">

														<label for="martial_status">Marital Status</label>

														<p><?php echo e($employee->personal_profile->martial_status); ?></p>

													</div>



													<div class="form-group  col-md-6">

														<label for="dob">Date Of Birth</label>

														<p><?php echo e($employee->personal_profile->dob); ?></p>

													</div>

													<?php if($employee->personal_profile->martial_status == 'married'): ?>

													<div class="form-group  col-md-6">

														<label for="anniversary_date">Anniversary</label>

														<p><?php echo e($employee->personal_profile->anniversary_date); ?></p>

													</div>

													<?php endif; ?>

													<div class="form-group col-md-12 per-bor bg-success">

														<label for="personal_info">Personal Details</label>

													</div>



													<div class="form-group col-md-12">

														<label for="personal_email">Personal Email</label>

														<p><?php echo e($employee->personal_profile->personal_email); ?></p>

													</div>



													<div class="form-group col-md-6">

														<label for="father_name">Father Name</label>

														<p><?php echo e($employee->personal_profile->father_name); ?></p>

													</div>

													<div class="form-group col-md-6">

														<label for="mother_name">Mother Name</label>

														<p><?php echo e($employee->personal_profile->mother_name); ?></p>

													</div>



													<div class="form-group col-md-6">

														<label for="parent_number">Parent Contact No.</label>

														<p><?php echo e($employee->personal_profile->parent_contact_number); ?></p>

													</div>



													<div class="form-group col-md-12 per-bor bg-success">

														<label for="personal_info">Bank Account information</label>

													</div>



													<div class="form-group col-md-12">

														<label for="">Account Holder Name</label>

														<p><?php echo e($employee->personal_profile->account_holder_name); ?></p>

													</div>



													<div class="form-group col-md-6">

														<label for="">Bank Name</label>

														<p><?php echo e($employee->personal_profile->bank_name); ?></p>

													</div>

													<div class="form-group col-md-6">

														<label for="">Account Number</label>

														<p><?php echo e($employee->personal_profile->bank_account); ?></p>

													</div>



													<div class="form-group col-md-6">

														<label for="">IFSC code</label>

														<p><?php echo e($employee->personal_profile->ifsc_code); ?></p>

													</div>

												</div>





											</div>

										</div>

										<div class="tab-pane fade" id="tab2">



											<div class="row">





												<div class="form-group  col-md-6">

													<label for="designation">Designation</label>

													<p><?php echo e($employee->cb_profile->designation); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="joined_as">Joined as</label>

													<p><?php echo e($employee->cb_profile->joined_as); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="joining_date">Joining Date</label>

													<p><?php echo e($employee->cb_profile->joining_date); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="employee_status">Status</label>

													<p><?php echo e($employee->cb_profile->status); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="salary">Salary</label>

													<p>Rs.<?php echo e($employee->cb_profile->salary); ?></p>

												</div>



												<div class="form-group col-md-6">

													<label for="stay_bonus">Stay Bonus</label>

													<p>Rs.<?php echo e($employee->cb_profile->stay_bonus); ?></p>

												</div>



												<div class="form-group col-md-6">

													<label for="appraisal_date">Appraisal Date</label>

													<p><?php echo e($employee->cb_profile->appraisal_date); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="epf">EPF Detail</label>

													<p><?php echo e($employee->cb_profile->epf); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="esi">ESI Detail</label>

													<p><?php echo e($employee->cb_profile->esi); ?></p>

												</div>



											</div>



										</div>

										<div class="tab-pane fade" id="tab3">



											<div class="row">

												<div class="form-group col-md-6">

													<label for="total_experience">Total Experience</label>

													<p><?php echo e($employee->previous_employment->total_experience); ?></p>

												</div>

												<div class="form-group  col-md-6">

													<label for="last_company_details">Last Company Details</label>

													<address>

														<p><?php echo e($employee->previous_employment->last_company_details); ?></p>

													</address>

												</div>

												<div class="form-group col-md-6">

													<label for="last_company_joining_date">Last Company Join Date</label>

													<p><?php echo e($employee->previous_employment->last_company_joining_date); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="last_company_relieving">Last Company Relieving Date</label>

													<p><?php echo e($employee->previous_employment->last_company_relieving); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="last_company_salary">Last Company Salary</label>

													<p><?php echo e($employee->previous_employment->last_company_salary); ?></p>

												</div>

												<div class="form-group col-md-6">

													<label for="first_join_date">First Date of Joining</label>

													<p><?php echo e($employee->previous_employment->first_join_date); ?></p>

												</div>

											</div>



										</div>

										<div class="tab-pane fade" id="tab4">



											<div class="row">

												<div class="form-group col-md-6">

													<label for="appraisal_term">Appraisal Term</label>

													<p><?php echo e($employee->cb_appraisal_detail->appraisal_term); ?></p>

												</div>

												<div class="form-group  col-md-6">

													<label for="cb_designation">Designation</label>

													<p><?php echo e($employee->cb_appraisal_detail->designation); ?></p>

												</div>

												<div class="form-group col-md-12">

													<label for="cb_salary">Salary</label>

													<p><?php echo e($employee->cb_appraisal_detail->salary); ?></p>

												</div>

												<div class="form-group col-md-12">

													<label for="cb_stay_bonus">Stay Bonus</label>

													<p>Rs.<?php echo e($employee->cb_appraisal_detail->stay_bonus); ?></p>

												</div>

												<div class="form-group col-md-12">

													<label for="appraisal_comments">Appraisal Comments</label>

													<p><?php echo e($employee->cb_appraisal_detail->appraisal_comment); ?></p>

												</div>

												<div class="form-group col-md-12">

													<label for="appraisal_status">Appraisal Status</label>

													<p><?php echo e($employee->cb_appraisal_detail->appraisal_status); ?></p>

												</div>

											</div>



										</div>



									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>                       

		</div>

	</div>

	<div class="page-footer">

		<p class="no-s"><?php echo e(date('Y')); ?> &copy; Coding Brains Software Solution Pvt Ltd.</p>

	</div>

</div><!-- Page Inner -->

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>