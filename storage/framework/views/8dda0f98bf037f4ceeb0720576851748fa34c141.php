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
	padding: 4px 0px 10px 0px;
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
                <a href="javascript:void(0)" class="btn btn-success profile-pic" data-toggle="modal" data-target="#uploadProfilePicModal"><i class="fa fa-camera 2x"></i></a>
					<img src="<?php echo e(is_null($employee->cb_profile->employee_pic) ? 'assets/images/profile-picture.png':$employee->cb_profile->employee_pic); ?>" alt="">     
				</div>
			</div>
		</div>
	</div>
	<div id="main-wrapper" class="hr-manager">
		<div class="row">
			<div class="col-md-3 user-profile">
				
								<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title text-center">Leave Info</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table  class="display table" style="width: 100%; cellspacing: 0;">
								<tbody>
									<tr>
										<td>Available Leave(days)</td>
										<td><span class="leave-info-badges leave-info-badges-colorAv"><?php echo e(\Auth::user()->cb_profile->avail_leaves); ?></span></td>
									</tr>
									<tr>
										<td>Rejected Application</td>
										<td><span class="leave-info-badges leave-info-badges-colorRe"><?php echo e(count(getLeaves(\Auth::user()->id,-1))); ?></span></td>
									</tr>
									<tr>
										<td>Pending Application</td>
										<td><span class="leave-info-badges leave-info-badges-colorPe"><?php echo e(count(getLeaves(\Auth::user()->id,0))); ?></span></td>
									</tr>
									<tr>
										<td>Approved Application</td>
										<td><span class="leave-info-badges leave-info-badges-colorAp"><?php echo e(count(getLeaves(\Auth::user()->id,1))); ?></span></td>
									</tr>
									<tr>
										<td>Leave Taken(days)</td>
										<td><span class="leave-info-badges leave-info-badges-colorLe"><?php echo e(\Auth::user()->cb_profile->leaves_taken); ?></span></td>
									</tr>

								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
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
															<p><?php echo e($employee->cb_profile->designation); ?></p>
														</div>


														<div class="form-group  col-md-12">
															<label for="address">Address</label>
															<address><p><?php echo e($employee->personal_profile->address); ?></p></address>
														</div>
														<div class="form-group  col-md-6">
															<label for="phone_number">Phone #</label>
															<p><?php echo e($employee->personal_profile->phone_no); ?></p>
														</div>
														<div class="form-group  col-md-6">
															<label for="account_no">Account #</label>
															<p><?php echo e($employee->personal_profile->bank_account); ?></p>
														</div>
														<div class="form-group  col-md-6">
															<label for="martial_status">Martial Status</label>
															<p><?php echo e($employee->personal_profile->martial_status); ?></p>
														</div>

														<div class="form-group  col-md-6">
															<label for="dob">Date Of Birth</label>
															<p><?php echo e($employee->personal_profile->dob); ?></p>
														</div>
														<div class="form-group  col-md-6">
															<label for="anniversary_date">Anniversary</label>
															<p>24-feb-1993</p>
														</div>

														<div class="form-group col-md-12 per-bor">
															<label for="personal_info">Personal Details</label>
														</div>

														<div class="form-group col-md-12">
															<label for="personal_email">Personal Email</label>
															<p><?php echo e($employee->personal_profile->martial_status); ?></p>
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
														<p><i class="fa fa-inr" aria-hidden="true"></i><?php echo e($employee->cb_profile->salary); ?></p>
													</div>

													<div class="form-group col-md-6">
														<label for="stay_bonus">Stay Bonus</label>
														<p><i class="fa fa-inr" aria-hidden="true"></i><?php echo e($employee->cb_profile->stay_bonus); ?></p>
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
														<p><i class="fa fa-inr" aria-hidden="true"></i><?php echo e($employee->cb_appraisal_detail->stay_bonus); ?></p>
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
			<p class="no-s">2015 &copy; Modern by Steelcoders.</p>
		</div>
		<div class="modal fade" id="uploadProfilePicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm hr-profile-md">
				<div class="modal-body">
					<div class="panel panel-success">
						<div class="panel-heading clearfix">
							<h4 class="panel-title" id="msg">Upload Profile Picture</h4>	
						</div>
						<div class="panel-body">
							<form class="form-horizontal" >
								<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<label for="profilePic" class="col-sm-2 control-label">Photo</label>
									<div class="col-sm-10">
										<input type="file" class="form-control" id="profilePic" name="profilePic">	
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<a  id="uploadProfilePic"  class="btn btn-success">Update</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div><!-- Page Inner -->
	<?php $__env->startSection('script'); ?>
	<script>
		$('#uploadProfilePic').on('click',function(){
			var profilePic = document.querySelector('#profilePic');
			if(profilePic.files[0]) {
				var file_data = $('#profilePic').prop('files')[0];
				var form_data = new FormData();
				form_data.append('profilePic', file_data);
				$.ajaxSetup({
					headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
				});
				var url  = "<?php echo e(URL('/profile/update/profile-pic')); ?>";
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					success: function (data) {
						if(data.flag){
							$('#uploadProfilePicModal').modal('toggle');
							swal('Success','File Upload Successfully','success');	
							setTimeout(function(){
								location.reload();
							}, 2000)  
						}else{
							$('#uploadProfilePicModal').modal('toggle');
							swal('Oops',data.error,'warning');	
						}
					},
					contentType: false,
					cache: false,
					processData: false
				});
			}else{
				swal('Error','Upload an Image','warning');	
			}
		});
	</script>
	<?php $__env->stopSection(); ?>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('hrManager.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>