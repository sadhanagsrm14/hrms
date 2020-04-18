@extends('admin.layouts.app')
@section('content')
@section('title','Employee')

<style>
.form-group {margin-right: 13px !important;}
.per-bor {border-bottom: 2px solid;}
.per-bor label {font-size: 20px;padding: 14px 0px 10px 0px;}
</style>



<div class="page-inner">



	<div class="page-title">



		<h3>Employees</h3>



		<div class="page-breadcrumb">

 

			<ol class="breadcrumb">



				<li><a href="{{URL('/admin/dashboard')}}">Home</a></li>



				<li><a href="{{URL('/admin/employees')}}">Employees</a></li>



				<li class="active">Update Employee</li>



			</ol>



		</div>



	</div>



	<div id="main-wrapper">



		<div class="row">



			<div class="col-md-10">



				@if (session('success'))



				<div class="alert alert-success">



					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>



					{{ session('success') }}



				</div>



				@endif



				@if (session('error'))



				<div class="alert alert-danger">



					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>



					{{ session('error') }}



				</div>



				@endif



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



								<form class="form-horizontal" method="post" action="{{URL('/admin/employee/update')}}" enctype="multipart/form-data" id="employeeForm">



									<div class="tab-content">



										{{csrf_field()}}



										<input type="hidden" name="id" value="{{$employee->id}}">



										<div class="tab-pane active fade in" id="tab1">



											<div class="row m-b-lg">



												<div class="col-md-10">



													<div class="row">



														<div class="form-group col-md-12">



															<label for="department">Department</label>



															<select name="department" id="department" class="form-control">



																<option value="">--Select Department--</option>



																<option value="development" {{$employee->department == "development" ? "selected":""}}>DEVELOPMENT</option>



																<option value="sales" {{$employee->department == "sales" ? "selected":""}}>SALES</option>



															</select>



															@if ($errors->has('department'))



															<span class="label label-danger">{{ $errors->first('department') }}</span>



															@endif



														</div>



														



														<div class="form-group col-md-6">



															<label for="first_name">First Name</label>



															<input type="text" class="form-control" name="first_name" id="first_name" value="{{$employee->first_name}}" placeholder="First Name">



															@if ($errors->has('first_name'))



															<span class="label label-danger">{{ $errors->first('first_name') }}</span>



															@endif



														</div>



														<div class="form-group  col-md-6">



															<label for="last_name">Last Name</label>



															<input type="text" class="form-control col-md-6" name="last_name" id="last_name"  value="{{$employee->last_name}}" placeholder="Last Name" >



														</div>



														<div class="form-group col-md-12">



															<label for="email">Email address</label>



															<input type="email" class="form-control" name="email" id="email" readonly value="{{$employee->email}}" placeholder="Enter email" >



														</div>



														



														<div class="form-group  col-md-6">



															<label for="role">Role</label>



															<select name="role" id="role" class="form-control" >



																<option value="">--Select Role--</option>



																@foreach($roles as $role )



																<option value="{{$role->id}}" {{$role->id == $employee->role ? 'selected':''}}>{{$role->role}}</option>



																@endforeach



															</select>



														</div>







														<div class="form-group  col-md-6">



															<label for="gender">Gender</label>



															<select name="gender" id="gender" class="form-control" >



																<option value="">--Select Gender--</option>



																<option value="male" {{$employee->gender == "male" ?'selected':''}}>Male</option>



																<option value="female" {{$employee->gender == "female" ?'selected':''}}>Female</option>



															</select>



															@if ($errors->has('gender'))



															<span class="label label-danger">{{ $errors->first('gender') }}</span>



															@endif



														</div>







														<div class="form-group  col-md-12">



															<label for="address">Address</label>



															<textarea name="address" id="address"  class="form-control" cols="30" rows="10">{{$employee->personal_profile->address}}</textarea>



														</div>



														<div class="form-group  col-md-6">



															<label for="phone_number">Phone #</label>



															<input type="text" class="form-control col-md-6" name="phone_number" id="phone_number" value="{{$employee->personal_profile->phone_number}}" placeholder="Phone number" >



														</div>



														<div class="form-group  col-md-6">



															<label for="aadhar_no">Aadhar #</label>



															<input type="text" class="form-control col-md-6" name="aadhar_no" id="aadhar_no" value="{{$employee->personal_profile->aadhar_no}}" placeholder="Aadhar number" >



														</div>



														



														<div class="form-group  col-md-6">



															<label for="martial_status">Marital  Status</label>



															<select name="martial_status" id="martial_status" class="form-control">



																<option value="">--Select Marital  Status--</option>



																<option value="unmarried" {{$employee->personal_profile->martial_status == "unmarried" ? "selected":''}}>Unmarried</option>



																<option value="married" {{$employee->personal_profile->martial_status == "married" ? "selected":''}}>Married</option>



															</select>



														</div>







														<div class="form-group  col-md-6">



															<label for="dob">Date Of Birth</label>



															<input type="text" class="pastDatepicker form-control col-md-6" name="dob" id="dob"  value="{{$employee->personal_profile->dob}}" placeholder="Date Of Birth" >



														</div>



														<div class="form-group  col-md-6" id="ann_div">



															<label for="anniversary_date">Anniversary</label>



															<input type="text" class="pastDatepicker form-control col-md-6" name="anniversary_date" id="anniversary_date"  value="{{$employee->personal_profile->anniversary_date}}" placeholder="Anniversary" >



														</div>







														<div class="form-group col-md-12 per-bor bg-success">



															<label for="personal_info">Personal Details</label>



														</div>







														<div class="form-group col-md-12">



															<label for="personal_email">Personal Email</label>



															<input type="email" class="form-control" name="personal_email" id="personal_email"  value="{{$employee->personal_profile->personal_email}}" placeholder="Enter email" >



														</div>







														<div class="form-group col-md-6">



															<label for="father_name">Father Name</label>



															<input type="text" class="form-control" name="father_name" id="father_name"  value="{{$employee->personal_profile->father_name}}" placeholder="Father Name">



														</div>



														<div class="form-group col-md-6">



															<label for="mother_name">Mother Name</label>



															<input type="text" class="form-control" name="mother_name" id="mother_name"  value="{{$employee->personal_profile->mother_name}}" placeholder="Mother Name">



														</div>







														<div class="form-group col-md-6">



															<label for="parent_number">Parent Contact No.</label>



															<input type="text" class="form-control" name="parent_number" id="parent_number"  value="{{$employee->personal_profile->parent_contact_number}}" placeholder="Parent Contact Number">



														</div>







														<div class="form-group col-md-12 per-bor bg-success">



															<label for="personal_info">Bank Account information</label>



														</div>







														<div class="form-group col-md-6">



															<label for="account_holder_name">Account Holder Name</label>



															<input type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="{{$employee->personal_profile->account_holder_name}}" placeholder="Account Holder Name" >



														</div>







														<div class="form-group col-md-12">



															<label for="bank_name">Bank Name</label>



															<input type="text" class="form-control" name="bank_name" id="bank_name" value="{{$employee->personal_profile->bank_name}}" placeholder="Bank Name" >



														</div>







														<div class="form-group  col-md-6">



															<label for="account_no">Bank Account #</label>



															<input type="text" class="form-control col-md-6" name="account_no" id="account_no" value="{{$employee->personal_profile->bank_account}}" placeholder="Account number" >



														</div>



														<div class="form-group col-md-6">



															<label for="ifsc_code">IFSC Code</label>



															<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="{{$employee->personal_profile->ifsc_code}}" placeholder="IFSC Code">



														</div>











													</div>



												</div>



											



											</div>



										</div>



										<div class="tab-pane fade" id="tab2">



											<div class="row">



												<div class="col-md-10">



													<div class="row">



														<div class="form-group col-md-6">



															<label for="employee_photo">Photo</label>



															<input type="file" class="form-control" name="employee_photo" id="employee_photo">



															@if ($errors->has('employee_photo'))



															<span class="label label-danger">{{ $errors->first('employee_photo') }}</span>



															@endif



															<img src="{{$employee->cb_profile->employee_pic}}" alt="" height="100" width="100">



														</div>







														<div class="form-group  col-md-6">



															<label for="designation">Designation</label>



															<input type="text" value="{{$employee->cb_profile->designation}}" class="form-control col-md-6" name="designation" id="designation" placeholder="Designation" >



														</div>



														<div class="form-group col-md-12">



															<label for="joined_as">Joined as</label>



															<input type="text" class="form-control" name="joined_as" id="joined_as" value="{{$employee->cb_profile->joined_as}}"  placeholder="Joined as" >



														</div>



														<div class="form-group col-md-6">
															<label for="joining_date">Joining Date</label>
															<input type="text" class="datepicker form-control" name="joining_date" id="joining_date" value="{{$employee->cb_profile->joining_date}}"  placeholder="Joining Date" >
														</div>



														<div class="form-group col-md-6">
															<label for="notice_period">Notice Period</label>
															<input type="number" class=" form-control" name="notice_period" id="notice_period" value="{{$employee->cb_profile->notice_period}}"  placeholder="Notice Period" min="0">
														</div>



														<div class="form-group col-md-12">
															<label for="employee_status">Status</label>



															<select name="employee_status" id="employee_status" class="form-control">



																<option value="active" {{$employee->cb_profile->status=="active"?"selected":''}}>Active</option>



																<option value="deactive" {{$employee->cb_profile->status=="deactive"?"selected":''}}>Deactive</option>



															</select>



														</div>



														<div class="form-group col-md-12">



															<label for="salary">Salary</label>



															<input type="text" class="form-control" name="salary" id="salary"  value="{{$employee->cb_profile->salary}}" placeholder="Salary" >



														</div>







														<div class="form-group col-md-12">





															<input type="text" class="form-control" name="stay_bonus" id="stay_bonus"  value="{{$employee->cb_profile->stay_bonus}}" placeholder="Stay Bonus" >



														</div>







														<div class="form-group col-md-12">



															<label for="appraisal_date">Appraisal Date</label>



															<input type="text" class="datepicker form-control" name="appraisal_date" id="appraisal_date"  value="{{$employee->cb_profile->appraisal_date}}" placeholder="Appraisal Date" >



														</div>



														<div class="form-group col-md-12">



															<label for="epf">EPF Detail</label>



															<input type="text" class="form-control" name="epf" id="epf"  value="{{$employee->cb_profile->epf}}" placeholder="EPF Detail" >



														</div>



														<div class="form-group col-md-12">



															<label for="esi">ESI Detail</label>



															<input type="text" class="form-control" name="esi" id="esi"  value="{{$employee->cb_profile->esi}}" placeholder="ESI Detail" >



														</div>



														



													</div>



												</div>



												



											</div>



										</div>



										<div class="tab-pane fade" id="tab3">



											<div class="row">



												<div class="col-md-10">



													<div class="row">



														<div class="form-group col-md-12">



															<label for="total_experience">Total Experience</label>



															<input type="text" class="form-control" name="total_experience" id="total_experience" value="{{$employee->previous_employment->total_experience}}" placeholder="Total Experience">



														</div>



														<div class="form-group  col-md-12">



															<label for="last_company_details">Last Company Details</label>



															<textarea name="last_company_details" id="last_company_details"  class="form-control" cols="30" rows="10"> {{$employee->previous_employment->last_company_details}}</textarea>



														</div>



														<div class="form-group col-md-12">



															<label for="last_company_joining_date">Last Company Join Date</label>



															<input type="text" class="datepicker form-control" name="last_company_joining_date" id="last_company_joining_date"  value="{{$employee->previous_employment->last_company_joining_date}}" placeholder="Last Company Joining Date" >



														</div>



														<div class="form-group col-md-12">



															<label for="last_company_relieving">Last Company Relieving Date</label>



															<input type="text" class="datepicker form-control" name="last_company_relieving" id="last_company_relieving"  value="{{$employee->previous_employment->last_company_relieving}}" placeholder="Last Company Relieving Date" >



														</div>



														<div class="form-group col-md-12">



															<label for="last_company_salary">Last Company Salary</label>



															<input type="text" class="form-control" name="last_company_salary" id="last_company_salary" value="{{$employee->previous_employment->last_company_salary}}" placeholder="Last Company Salary">



														</div>



														<div class="form-group col-md-12">



															<label for="first_join_date">First Date of Joining</label>



															<input type="text" class="datepicker form-control" name="first_join_date" id="first_join_date"  value="{{$employee->previous_employment->first_join_date}}" placeholder="First Date of Joining">



														</div>



													</div>



												</div>



												



											</div>



										</div>



										<div class="tab-pane fade" id="tab4">



											<div class="row">



												<div class="col-md-10">



													<div class="row">



														<div class="form-group col-md-6">



															<label for="appraisal_term">Appraisal Term</label>



															<select name="appraisal_term" class="form-control" id="appraisal_term">



																<option value="first" {{$employee->cb_appraisal_detail->appraisal_term =="first"?"selected":''}}>First</option>



																<option value="second"  {{$employee->cb_appraisal_detail->appraisal_term =="second"?"selected":''}}>Second</option>



																<option value="third"  {{$employee->cb_appraisal_detail->appraisal_term =="third"?"selected":''}}>Third</option>



															</select>



														</div>



														<div class="form-group  col-md-6">



															<label for="cb_designation">Designation</label>



															<input type="text" class="form-control col-md-6" name="cb_designation" id="cb_designation"  value="{{$employee->cb_appraisal_detail->designation}}" placeholder="Designation" >



														</div>



														<div class="form-group col-md-12">



															<label for="cb_salary">Salary</label>



															<input type="text" class="form-control" name="cb_salary" id="cb_salary" value="{{$employee->cb_appraisal_detail->salary}}" placeholder="Salary" >



														</div>



														<div class="form-group col-md-12">



															<label for="cb_stay_bonus">Stay Bonus</label>



															<input type="text" class="form-control" name="cb_stay_bonus" id="cb_stay_bonus" value="{{$employee->cb_appraisal_detail->stay_bonus}}" placeholder="Stay Bonus" >



														</div>



														<div class="form-group col-md-12">



															<label for="appraisal_comments">Appraisal Comments</label>



															<textarea name="appraisal_comments" class="form-control" id="appraisal_comments" cols="30" rows="10">{{$employee->cb_appraisal_detail->appraisal_comment}}</textarea>



														</div>



														<div class="form-group col-md-12">



															<label for="appraisal_status">Appraisal Status</label>



															<select name="appraisal_status" id="appraisal_status" class="form-control">



																<option value="not_done" {{$employee->cb_appraisal_detail->appraisal_status == "not_done"?'selected':'' }}>Not Done</option>



																<option value="done" {{$employee->cb_appraisal_detail->appraisal_status == "done"?'selected':'' }}>Done</option>



															</select>



														</div>



													</div>



												</div>



												



											</div>



										</div>



										<ul class="pager wizard">



											<input type="submit" name="Submit" class="btn btn-primary">



										</ul> 



									</div>



								</form>















							



					



									</div>



								</div>



							</div>



						</div>



					</div><!-- Row -->



				</div><!-- Main Wrapper -->



				<div class="page-footer">



					<p class="no-s">{{date('Y')}} &copy; Coding Brains Software Solution Pvt Ltd.</p>



				</div>



			</div>







			@section('script')



			{{ Html::script("assets/plugins/waves/waves.min.js") }}



			{{ Html::script("assets/plugins/select2/js/select2.min.js") }}



			{{ Html::script("assets/plugins/summernote-master/summernote.min.js") }}



			{{ Html::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}



			{{ Html::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}



			{{ Html::script("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js") }}



			{{ Html::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}



			{{ Html::script("assets/js/pages/form-elements.js") }}



			<script>



				$(document).ready(function() {


					 $('#last_company_joining_date').datepicker().on('change', function(){
						 endDate   = this.value; 
						 start_date = "{{date('Y-m-d')}}";
						 var diff = new Date(start_date) - new Date(endDate);
                              diff = (diff/1000/60/60/24);
                              console.log(diff); 
						 if(diff  < 1){      
						 	$('#last_company_joining_date').val(''); 
						 	$('#last_company_joining_date').focus(); 
						 	//$('#end_date_error').text('Date should be greater then start data.'); 
						 }
					});



					$('#appraisal_date').datepicker().on('change', function(){
						 endDate    = this.value; 
						 start_date = $('#joining_date').val();
						 
						 var diff   = new Date(endDate) - new Date(start_date);
                             

                            diff    = (diff/1000/60/60/24);
                            

						 if(diff < 1 ){      
						 	$('#appraisal_date').val(''); 
						 	$('#appraisal_date').focus(); 
						 	//$('#end_date_error').text('Date should be greater then start data.'); 
						 }
					});


					$('#last_company_relieving').datepicker().on('change', function(){
						 endDate    = this.value; 
						 start_date = $('#last_company_joining_date').val();
						 crr_date   = "{{date('Y-m-d')}}";
						 var diff   = new Date(endDate) - new Date(start_date);
						     diff2  = new Date(crr_date) - new Date(endDate);
                             diff   = (diff/1000/60/60/24);
                             diff2  = (diff2/1000/60/60/24);
                           
						 if(diff < 1){
						 	$('#last_company_relieving').val(''); 
						 	$('#last_company_relieving').focus(); 
						 	//$('#end_date_error').text('Date should be greater then start data.'); 
						 }
                            //console.log(" diff2 "+diff2);   
						 if(diff2 < 1){    
						    console.log(" diff2d "+diff2);    
						 	$('#last_company_relieving').val(''); 
						 	$('#last_company_relieving').focus();   
						 	//$('#end_date_error').text('Date should be greater then start data.'); 
						 }
					});



					$('.select2').select2();



					$('.pastDatepicker').datepicker({endDate: '0m'});



					$("#martial_status").on('change',function(e){



						if(e.target.value == "unmarried"){



							$('#ann_div').hide();



						}else{



							$('#ann_div').show();



						}



					})



					if($("#martial_status option:selected").val() == 'unmarried'){



						$('#ann_div').hide();



					}



					if($("#martial_status option:selected").val() == 'married'){



						$('#ann_div').show();



					}



					$('#employeeForm').submit(function(event) {



						var file_data = $('#employee_photo').prop('files')[0]; 



						if($('#first_name').val() == ''){



							swal('Oops','First name is required','warning');



							return false;



						}



						else if($('#role option:selected').val() == ''){



							swal('Oops','Role is required','warning');



							return false;



						}



						else if($('#department option:selected').val() == ''){



							swal('Oops','Department is required','warning');



							return false;



						}



						else if($('#gender option:selected').val() == ''){



							swal('Oops','Gender is required','warning');



							return false;



						}else if(file_data != null)



						{



							if (file_data.type!=="image/png" && file_data.type!=="image/jpeg" && file_data.type!=="image/jpg")  



							{



								swal("Oops", "Please upload a valid image file", "warning");



								return false;







							}



						} 



						else{



							return true;



						}



					});



				});



			</script>



			@endsection



			@endsection