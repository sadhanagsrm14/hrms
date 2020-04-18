<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AttendanceData;

use DB;

class HrManagerController extends Controller

{

	public function dashboard()

	{  
		$employees = \App\User::where('role','!=',1)->where('is_active',1)->with('personal_profile','cb_profile')->get();

		$leaves = \App\Leaves::where('is_approved',0)->get();

		$data['profile_requests'] = \App\User::where('request_json','!=',null)->where('role','!=',1)->get();

		$data['leaves'] = $leaves;

		$data['employees'] = $employees;

		return view('hrManager.dashboard',$data);

	} 

	public function employees(Request $request)

	{

		if($request->type){

			if($request->type == "active"){

				$employees = \App\User::where('role','!=',1)->where('is_active','>', 0)->with('personal_profile','cb_profile')->orderBy('id','DESC')->get();

			}

		}else{

			$employees = \App\User::where('role','!=',1)->with('personal_profile','cb_profile')->orderBy('id','DESC')->get();

		}

		if(isset($_GET['filter_dep']) || isset($_GET['filter_dep']) ){
		 if($_GET['filter_dep'])
		 {	$fil = $_GET['filter_dep'];
            //echo "a";
		   if($_GET['filter_dep1'])

		     {// echo "b";
		      $fil1 = $_GET['filter_dep1'];
               $data['employees'] = \App\User::where('department', $fil)->where('role',$fil1)->get();
		      }
		      else
		      {//echo "c";
		      	$data['employees'] = \App\User::where('department', $fil)->get();
		      }
		 	//$data['employees'] = \App\User::where('department', $fil)->get();
		 }
		 else
		   {//echo "d";
             if($_GET['filter_dep1'])

		     {  $fil1 = $_GET['filter_dep1'];
		// echo "e";
               $data['employees'] = \App\User::where('role',$fil1)->get();
		      }
		      else
		      {
		      	$data['employees'] = $employees;
		      }
		   }
		}
		  else
		  {
		  	$data['employees'] = $employees;
		  }

		return view('hrManager.employees.index',$data);

	} 

	public function exportEmployees()
   {
   $userExcel = \App\User::select('id as User Id','first_name as First Name','last_name as Last Name')->get();
   $assetExcel = \App\Asset::select('asset_code as Asset Code','name as Name','s_no as S.No','purchase_bill_date as Purchase/Bill date','is_warranty as Warranty','warranty_end_date as Warranty End Date','system_id as System Id','status as Status')->get();
    $assetTypeExcel = \App\AssetType::select('id as Asset Type Id','type as Asset Type')->get();
    $AssetAssocExcel = \App\AssetAssoc::select('id as Asset Id','name as Asset Name')->get();
      \Excel::create('Employees Lists', function($excel) use($userExcel) {
        $excel->sheet('Users', function($sheet) use($userExcel) {
	    $sheet->fromArray($userExcel);
        });
     })->export('xls');
   } 
    public function importEmployees(Request $request)

	{

		$response = array();

		if($request->hasFile('employeeFile'))

		{

			$extension = \File::extension($request->file('employeeFile')->getClientOriginalName());

			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

				\Excel::load($request->file('employeeFile'), function($reader) {

					$reader->each(function ($sheet)

					{

						$user =  new \App\User();

						$user->first_name = $sheet->first_name;

						if($sheet->last_name){

							$user->last_name = $sheet->last_name;

						}

						$user->email = $sheet->email;

						$user->password = \Hash::make($sheet->password);

						$user->role = $sheet->role;

						$user->department = $sheet->department;

						$user->gender = $sheet->gender;

						if($user->save()){

							$employee =  new \App\EmployeePersonalDetail();

							$employee->user_id = $user->id;

							if($sheet->address){

								$employee->address = $sheet->address;

							}if($sheet->account_no){

								$employee->bank_account = $sheet->account_no;

							}if($sheet->martial_status){

								$employee->martial_status = $sheet->martial_status;

							}if($sheet->phone_number){

								$employee->phone_number = $sheet->phone_number;

							}if($sheet->anniversary_date){

								$employee->anniversary_date = $sheet->anniversary_date;

							}if($sheet->dob){

								$employee->dob = $sheet->dob;

							}if($sheet->personal_email){

								$employee->personal_email = $sheet->personal_email;

							}if($sheet->father_name){

								$employee->father_name = $sheet->father_name;

							}if($sheet->mother_name){

								$employee->mother_name = $sheet->mother_name;

							}if($sheet->parent_number){

								$employee->parent_contact_number = $sheet->parent_number;

							}

							if($sheet->aadhar_no){

								$employee->aadhar_no = $sheet->aadhar_no;

							}if($sheet->account_holder_name){

								$employee->account_holder_name = $sheet->account_holder_name;

							}if($sheet->bank_name){

								$employee->bank_name = $sheet->bank_name;

							}if($sheet->ifsc_code){

								$employee->ifsc_code = $sheet->ifsc_code;

							}

							$employee->save();



							$employee_cb_profile =  new \App\EmployeeCbProfile();

							$employee_cb_profile->user_id = $user->id;

							$employee_cb_profile->employee_id = 'CB0'.$user->id;

							$employee_cb_profile->employee_pic = url('/').'/images/employees/default-user.png';

							if(date('d') > 15){

								$employee_cb_profile->avail_leaves = 0;

							}else{

								$employee_cb_profile->avail_leaves = 1;

							}



							$employee_cb_profile->save();



							$employee_previous_employment =  new \App\EmployeePreviousEmployment();

							$employee_previous_employment->user_id = $user->id;

							$employee_previous_employment->save();



							$employee_cb_appraisal_detail =  new \App\EmployeeCbAppraisalDetail();

							$employee_cb_appraisal_detail->user_id = $user->id;

							$employee_cb_appraisal_detail->save();

						}



					});

				});

				$response['flag'] = true;

				$response['message'] = "Uploaded Successfully.";

			}else {

				$response['flag'] = false;

				$response['error'] = 'Invalid file';

			}

			return response()->json($response);

		}

	} 

	public function getAddEmployee()

	{

		$roles = \App\Role::where('role','!=','Admin')->get();

		$data['roles'] = $roles;

		return view('hrManager.employees.create',$data);

	} 

	public function postAddEmployee(Request $request){

        $admin = \App\User::where('role',1)->get();
		$date = date('d-m-Y');

		if($request->file('employee_photo') != ""){

			$validator = \Validator::make($request->all(),

				array(

					'department' =>'required',

					'first_name' =>'required',

				//	'email' =>'required|unique:users',

					'password' =>'required',

					'role' =>'required',

					'gender' =>'required',

					'employee_photo' =>'image',

				)

			);

		}else{

			$validator = \Validator::make($request->all(),

				array(

					'department' =>'required',

					'first_name' =>'required',

				//	'email' =>'required|unique:users',

					'password' =>'required',

					'role' =>'required',

					'gender' =>'required',

				)

			);

		}

		if($validator->fails()){

			return redirect('/hrManager/add-employee')

			->withErrors($validator)

			->withInput();

		}else{
			

			$check = \App\User::whereEmail($request->email)->where('is_active',1)->first(); 

			if(!empty($check)){
                 $err['email'] = "This email already assigned to another employee. please try another."; 
				 return redirect()->back()->withErrors($err)->withInput();     
			}
			
			$user =  new \App\User();

			$user->first_name = $request->first_name;

			if($request->last_name){

				$user->last_name = $request->last_name;

			}

			$user->email = $request->email;

			$user->password = \Hash::make($request->password);

			$user->role = $request->role;

			$user->department = $request->department;

			$user->gender = $request->gender;

			if($user->save()){

				$employee =  new \App\EmployeePersonalDetail();

				$employee->user_id = $user->id;

				if($request->address){

					$employee->address = $request->address;

				}if($request->account_no){

					$employee->bank_account = $request->account_no;

				}if($request->martial_status){

					$employee->martial_status = $request->martial_status;

				}if($request->phone_number){

					$employee->phone_number = $request->phone_number;

				}if($request->anniversary_date){

					$employee->anniversary_date = $request->anniversary_date;

				}if($request->dob){

					$employee->dob = $request->dob;

				}if($request->personal_email){

					$employee->personal_email = $request->personal_email;

				}if($request->father_name){

					$employee->father_name = $request->father_name;

				}if($request->mother_name){

					$employee->mother_name = $request->mother_name;

				}if($request->parent_number){

					$employee->parent_contact_number = $request->parent_number;

				}

				if($request->aadhar_no){

					$employee->aadhar_no = $request->aadhar_no;

				}if($request->account_holder_name){

					$employee->account_holder_name = $request->account_holder_name;

				}if($request->bank_name){

					$employee->bank_name = $request->bank_name;

				}if($request->ifsc_code){

					$employee->ifsc_code = $request->ifsc_code;

				}

				$employee->save();



				$employee_cb_profile =  new \App\EmployeeCbProfile();

				$employee_cb_profile->user_id = $user->id;

				$employee_cb_profile->employee_id = 'CB0'.$user->id;

				$employee_cb_profile->employee_pic = url('/').'/images/employees/default-user.png';

				if(date('d') > 15){

					$employee_cb_profile->avail_leaves = 0;

				}else{

					$employee_cb_profile->avail_leaves = 1;

				}



				$employee_cb_profile->save();



				$employee_previous_employment =  new \App\EmployeePreviousEmployment();

				$employee_previous_employment->user_id = $user->id;

				$employee_previous_employment->save();



				$employee_cb_appraisal_detail =  new \App\EmployeeCbAppraisalDetail();

				$employee_cb_appraisal_detail->user_id = $user->id;

				$employee_cb_appraisal_detail->save();



				/*-----------------------------------Send notification-----------------------*/

				$receiver = array();

				$admins = \App\User::where('role','1')->get();

				foreach ($admins as $admin) {

					array_push($receiver,$admin->id);

				}

				$title = "HR Created New Employee.".$user->first_name ." ".$user->last_name.'('.$employee_cb_profile->employee_id.')';

				$message = "HR Created New Employee.".$user->first_name ." ".$user->last_name.'('.$employee_cb_profile->employee_id.')';

				$admins = \App\User::where('role','1')->get();

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*-----------------------------------Send notification----------------------*/

				/*-----------------------------------send mail to employee------------------------------------------------*/
				$templateData['details'] = $request->email;
				$templateData['password'] = $request->password;
				$templateData['user_name'] = $request->first_name.' '.$request->last_name;
				$MailData = new \stdClass();
				$MailData->subject ='Your Login Details';
				$MailData->sender_email = \Auth::user()->email;
				$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;
				$MailData->receiver_email = $request->email;
				$MailData->receiver_name = $request->first_name.' '.$request->last_name;
				$MailData->subject = 'Your Login Details '.$date.' -'.\Auth::user()->first_name.' '.\Auth::user()->last_name;

				MailController::sendMail('newemployeeadd',$templateData,$MailData);
				/*-----------------------------------send mail to employee------------------------------------------------*/

				return redirect('/hrManager/employee/'.$user->id)->with('success',"Created Successfully");

			}else{

				return redirect('/hrManager/employees')->with('error',"Something Went Wrong.");

			}

			



		}

	}

	public function getEmployeeProfile($id)

	{

		$employee = \App\User::where('id',$id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();

		if(is_null($employee)){

			return redirect('/hrManager/employees')->with('error',"employee Not found");

		}else{

			$data['employee'] = $employee;
			

			return view('hrManager.employees.profile',$data);

		}

	}

	public function getEditEmployee($id)

	{

		$employee = \App\User::where('id',$id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();

		if(is_null($employee)){

			return redirect('/hrManager/employees')->with('error',"employee Not found");

		}else{

			$roles = \App\Role::where('role','!=',1)->get();

			$data['roles'] = $roles;

			$data['employee'] = $employee;
			
			$data['employee_status'] = \DB::table('employee_status')->get();

			return view('hrManager.employees.edit',$data);

		}

	} 

	public function postEditEmployee(Request $request){

		if($request->file('employee_photo') != ""){

			$validator = \Validator::make($request->all(),

				array(

					'department' =>'required',

					'first_name' =>'required',

					'role' =>'required',

					'gender' =>'required',

					'employee_photo' =>'image',

				)

			);

		}else{

			$validator = \Validator::make($request->all(),

				array(

					'department' =>'required',

					'first_name' =>'required',

					'role' =>'required',

					'gender' =>'required',

				)

			);

		}

		if($validator->fails())

		{

			return redirect()->back()

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$user =   \App\User::find($request->id);

			$user->first_name = $request->first_name;

			if($request->last_name){

				$user->last_name = $request->last_name;

			}

			$user->email = $request->email;

			$user->role = $request->role;

			$user->department = $request->department;

			$user->gender = $request->gender;
			
			$user->is_active = $request->emp_status;
			
		
		

			if($user->save()){
				
					
				$employee =   \App\EmployeePersonalDetail::where('user_id',$request->id)->first();

				if($request->address){

					$employee->address = $request->address;

				}else{

					$employee->address = null;

				}

				if($request->account_no){

					$employee->bank_account = $request->account_no;

				}else{

					$employee->bank_account = null;

				}

				if($request->martial_status){

					$employee->martial_status = $request->martial_status;

				}else{

					$employee->martial_status = null;

				}

				if($request->phone_number){

					$employee->phone_number = $request->phone_number;

				}else{

					$employee->phone_number = null;

				}

				if($request->martial_status == "married"){

					if($request->anniversary_date){

						$employee->anniversary_date = $request->anniversary_date;

					}else{

						$employee->anniversary_date = null;

					}

				}else{

					$employee->anniversary_date = null;

				}

				if($request->dob){

					$employee->dob = $request->dob;

				}else{

					$employee->dob = null;

				}

				if($request->personal_email){

					$employee->personal_email = $request->personal_email;

				}else{

					$employee->personal_email = null;

				}

				if($request->father_name){

					$employee->father_name = $request->father_name;

				}else{

					$employee->father_name = null;

				}

				if($request->mother_name){

					$employee->mother_name = $request->mother_name;

				}else{

					$employee->mother_name = null;

				}

				if($request->parent_number){

					$employee->parent_contact_number = $request->parent_number;

				}else{

					$employee->parent_contact_number = null;

				}

				if($request->aadhar_no){

					$employee->aadhar_no = $request->aadhar_no;

				}else{

					$employee->aadhar_no = null;

				}

				if($request->account_holder_name){

					$employee->account_holder_name = $request->account_holder_name;

				}else{

					$employee->account_holder_name = null;

				}

				if($request->bank_name){

					$employee->bank_name = $request->bank_name;

				}else{

					$employee->bank_name = null;

				}

				if($request->ifsc_code){

					$employee->ifsc_code = $request->ifsc_code;

				}else{

					$employee->ifsc_code = null;

				}

				$employee->save();



				$employee_cb_profile =  \App\EmployeeCbProfile::where('user_id',$request->id)->first();

				if($request->file('employee_photo') != ""){

					$image = $request->file('employee_photo');

					$filename = time().'.'.$image->getClientOriginalExtension();

					$destinationPath = public_path('/images/employees');

					$image->move($destinationPath, $filename);

					$employee_cb_profile->employee_pic = url('/').'/images/employees/'.$filename;

				} 

				if($request->designation){

					$employee_cb_profile->designation = $request->designation;

				}

				else{

					$employee_cb_profile->designation = null;	

				}

				if($request->joined_as){

					$employee_cb_profile->joined_as = $request->joined_as;

				}

				else{

					$employee_cb_profile->joined_as = null;	

				}

				if($request->joining_date){

					$employee_cb_profile->joining_date = $request->joining_date;

				}

				else{

					$employee_cb_profile->joining_date = null;	

				}

				//if($request->employee_status){

					$employee_cb_profile->status = $request->employee_status;

				/*	if($request->employee_status == "active"){

						$user->is_active = 1;

					}else{

						$user->is_active = 0;

					}

					$user->save();

				}

				else{

					$employee_cb_profile->status = null;	

				}*/

				if($request->salary){

					$employee_cb_profile->salary = $request->salary;

				}

				else{

					$employee_cb_profile->salary = null;	

				}

				if($request->stay_bonus){

					$employee_cb_profile->stay_bonus = $request->stay_bonus;

				}

				else{

					$employee_cb_profile->stay_bonus = null;	

				}

				if($request->appraisal_date){

					$employee_cb_profile->appraisal_date = $request->appraisal_date;

				}

				else{

					$employee_cb_profile->appraisal_date = null;	

				}

				if($request->notice_period){

					$employee_cb_profile->notice_period = $request->notice_period;

				}

				else{

					$employee_cb_profile->notice_period = null;	

				}

				if($request->epf){

					$employee_cb_profile->epf = $request->epf;

				}

				else{

					$employee_cb_profile->epf = null;	

				}

				if($request->esi){

					$employee_cb_profile->esi = $request->esi;

				}

				else{

					$employee_cb_profile->esi = null;	

				}





				$employee_cb_profile->save();



				$employee_previous_employment =   \App\EmployeePreviousEmployment::where('user_id',$request->id)->first();

				if($request->total_experience){

					$employee_previous_employment->total_experience = $request->total_experience;

				}else{

					$employee_previous_employment->total_experience = null;

				}if($request->last_company_details){

					$employee_previous_employment->last_company_details = $request->last_company_details;

				}else{

					$employee_previous_employment->last_company_details = null;

				}if($request->last_company_joining_date){

					$employee_previous_employment->last_company_joining_date = $request->last_company_joining_date;

				}else{

					$employee_previous_employment->last_company_joining_date = null;

				}if($request->last_company_relieving){

					$employee_previous_employment->last_company_relieving = $request->last_company_relieving;

				}else{

					$employee_previous_employment->last_company_relieving = null;

				}if($request->last_company_salary){

					$employee_previous_employment->last_company_salary = $request->last_company_salary;

				}else{

					$employee_previous_employment->last_company_salary = null;

				}if($request->first_join_date){

					$employee_previous_employment->first_join_date = $request->first_join_date;

				}else{

					$employee_previous_employment->first_join_date = null;

				}

				$employee_previous_employment->save();



				$employee_cb_appraisal_detail =   \App\EmployeeCbAppraisalDetail::where('user_id',$request->id)->first();

				if($request->appraisal_term){

					$employee_cb_appraisal_detail->appraisal_term = $request->appraisal_term;

				}else{

					$employee_cb_appraisal_detail->appraisal_term = null;

				}

				if($request->cb_designation){

					$employee_cb_appraisal_detail->designation = $request->cb_designation;

				}else{

					$employee_cb_appraisal_detail->designation = null;

				}

				if($request->cb_salary){

					$employee_cb_appraisal_detail->salary = $request->cb_salary;

				}else{

					$employee_cb_appraisal_detail->salary = null;

				}

				if($request->cb_stay_bonus){

					$employee_cb_appraisal_detail->stay_bonus = $request->cb_stay_bonus;

				}else{

					$employee_cb_appraisal_detail->stay_bonus = null;

				}

				if($request->appraisal_comments){

					$employee_cb_appraisal_detail->appraisal_comment = $request->appraisal_comments;

				}else{

					$employee_cb_appraisal_detail->appraisal_comment = null;

				}

				if($request->appraisal_status){

					$employee_cb_appraisal_detail->appraisal_status = $request->appraisal_status;

				}else{

					$employee_cb_appraisal_detail->appraisal_status = null;

				}

				$employee_cb_appraisal_detail->save();



				/*-----------------------------------Send notification-----------------------*/

				$receiver = array();

				$admins = \App\User::where('role','1')->get();

				foreach ($admins as $admin) {

					array_push($receiver,$admin->id);

				}

				$title = "HR Updated Profile -.".' '.$user->first_name ." ".$user->last_name.'('.$employee_cb_profile->employee_id.')';

				$message = "HR Updated Profile -.".' '.$user->first_name ." ".$user->last_name.'('.$employee_cb_profile->employee_id.')';

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*-----------------------------------Send notification----------------------*/



				/*-----------------------------------Send notification-----------------------*/

				$receiver = array($user->id);

				$title = "HR manager Updated your Profile";

				$message = "HR manager Updated your Profile";

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*-----------------------------------Send notification----------------------*/



				return redirect('/hrManager/employee/'.$request->id)->with('success',"Updated Successfully");

			}else{

				return redirect('/hrManager/employee/'.$request->id)->with('error',"Something Went Wrong.");

			}

		}

	}



	public function deleteEmployee($id)

	{

		$employee = \App\employee::find($id);

		if(is_null($employee)){

			return redirect('/hrManager/employees')->with('error','employee Not Found');

		}else{

			$user_id = $employee->user_id;

			if($employee->delete()){

				$user = \App\User::find($user_id);

				if(!is_null($user)){

					$user->delete();

				}

				return redirect('/hrManager/employees')->with('success','employee Removed Successfully.');

			}else{

				return redirect('/hrManager/employees')->with('error','Something Went Wrong');

			}

		}

	}

	public function leave_listing(Request $request)

	{

		if($request->type == "approved"){

			$leaves = \App\Leaves::where('is_approved',1)->with('leave_type')->where('user_id','!=',\Auth::user()->id)->orderBy('id','DESC')->get();

		}else if($request->type == "discarded"){

			$leaves = \App\Leaves::where('is_approved',-1)->with('leave_type')->where('user_id','!=',\Auth::user()->id)->orderBy('id','DESC')->get();

		}

		else if($request->type == "pending"){

			$leaves = \App\Leaves::where('is_approved',0)->with('leave_type')->where('user_id','!=',\Auth::user()->id)->orderBy('id','DESC')->get();

		}else{

			$leaves = \App\Leaves::where('user_id','!=',\Auth::user()->id)->get();

		}

		$data['leaves'] = $leaves;

		return view('hrManager.leaves.leaves',$data);

	} 

	public function leave_types()

	{

		$leave_types = \App\LeaveType::all();

		$data['leave_types'] = $leave_types;

		return view('hrManager.leaves.leave_types',$data);

	} 

	public function getAddLeaveType()

	{

		return view('hrManager.leaves.create_leaves_type');

	} 

	public function postAddLeaveType(Request $request){

		$validator = \Validator::make($request->all(),

			array(

				'leave_type' =>'required',

				'description' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect('/hrManager/add-leave-type')

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$leave_type =  new \App\LeaveType();

			$leave_type->leave_type = $request->leave_type;

			$leave_type->description = $request->description;

			if($leave_type->save()){ 

				return redirect('/hrManager/leave-types')->with('success',"Added Successfully.");

			}else{

				return redirect('/hrManager/leave-types')->with('error',"Something Went Wrong.");

			}

		}



	}



	public function getEditLeaveType($id)

	{

		$leave_type = \App\LeaveType::where('id',$id)->first();

		if(is_null($leave_type)){

			return redirect('/hrManager/leave-types')->with('error',"leave_type Not found");

		}else{

			$data['leave_type'] = $leave_type;

			return view('hrManager.leaves.edit_leaves_type',$data);

		}

	} 

	public function postEditLeaveType(Request $request){

		$validator = \Validator::make($request->all(),

			array(

				'leave_type' =>'required',

				'description' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect()->back()

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$leave_type =  \App\LeaveType::find($request->id);

			$leave_type->leave_type = $request->leave_type;

			$leave_type->description = $request->description;

			if($leave_type->save()){

				return redirect('/hrManager/leave-types')->with('success',"Updated Successfully");

			}else{

				return redirect('/hrManager/leave-types')->with('error',"Something Went Wrong.");

			}

		}

	}



	public function deleteLeaveType($id)

	{

		$leave_type = \App\LeaveType::find($id);

		if(is_null($leave_type)){

			return redirect('/hrManager/leave-types')->with('error','leave type Not Found');

		}else{

			if($leave_type->delete()){

				return redirect('/hrManager/leave-types')->with('success','leave type Removed Successfully.');

			}else{

				return redirect('/hrManager/leave-types')->with('error','Something Went Wrong');

			}

		}

	}



	public function approveLeave($id)

	{

		$leave = \App\Leaves::find($id);

		if(is_null($leave)){

			return redirect('/hrManager/leave-listing')->with('error','Leave Not Found');

		}else{

			$leave->is_approved = 1;

			$employee =   \App\user::where('id',$leave->user_id)->first();

			$employee_cb_profile =   \App\EmployeeCbProfile::where('user_id',$leave->user_id)->first();

			$remainDays = ($employee_cb_profile->avail_leaves - $leave->days);

			if($remainDays < 0){

				$employee_cb_profile->avail_leaves = 0;

				$employee_cb_profile->leaves_taken =  ($employee_cb_profile->leaves_taken + abs($remainDays));

			}else{

				$employee_cb_profile->avail_leaves = $remainDays;

			}



			if($leave->save()){

				$employee_cb_profile->save();

				/*-----------------------------------Send notification-------------------------*/

				$receiver = array($leave->user_id);

				$title = "HR Accepted Your leave request.";

				$message = "HR Accepted Your leave request.";

				$admins = \App\User::where('role','1')->get();

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*-----------------------------------Send notification----------------------*/

				/*-----------------------------------Send notification-----------------------*/

				$receiver1 = array();

				$title = "HR Accepted"." ".$employee->first_name." " .$employee->last_name ."'s leave request.";

				$message = "HR Accepted"." ".$employee->first_name." " .$employee->last_name ."'s leave request.";

				$admins = \App\User::where('role','1')->get();

				foreach ($admins as $admin) {

					array_push($receiver1,$admin->id);

				}

				NotificationController::notify(\Auth::user()->id,$receiver1,$title,$message);

				/*-----------------------------------Send notification----------------------*/





				return redirect()->back()->with('success','Leave Status Updated Successfully.');

			}else{

				return redirect()->back()->with('error','Something Went Wrong');

			}

		}

	}



	public function discardLeave($id)

	{

		$leave = \App\Leaves::find($id);

		if(is_null($leave)){

			return redirect('/hrManager/leave-listing')->with('error','Leave Not Found');

		}else{

			$leave->is_approved = -1;

			if($leave->save()){

				$employee =   \App\user::where('id',$leave->user_id)->first();

				/*-----------------------------------Send notification-----------------------*/

				$receiver = array($leave->user_id);

				$title = "HR Discarded Your leave request.";

				$message = "HR Discarded Your leave request.";

				$admins = \App\User::where('role','1')->get();

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*-----------------------------------Send notification-----------------------*/

				/*-----------------------------------Send notification-----------------------*/

				$receiver1 = array();

				$title = "HR Discarded"." ".$employee->first_name." " .$employee->last_name ."'s leave request.";

				$message =  "HR Discarded"." ".$employee->first_name." " .$employee->last_name ."'s leave request.";

				$admins = \App\User::where('role','1')->get();

				foreach ($admins as $admin) {

					array_push($receiver1,$admin->id);

				}

				NotificationController::notify(\Auth::user()->id,$receiver1,$title,$message);

				/*-----------------------------------Send notification----------------------*/

				return redirect()->back()->with('success','Leave Status Updated Successfully.');

			}else{

				return redirect()->back()->with('error','Something Went Wrong');

			}

		}

	}



	public function deleteLeave($id)

	{

		$leave = \App\Leaves::find($id);

		if(is_null($leave)){

			return redirect()->back()->with('error','Leave Not Found');

		}else{

			if($leave->delete()){

				return redirect()->back()->with('success','Leave Removed Successfully.');

			}else{

				return redirect()->back()->with('error','Something Went Wrong');

			}

		}

	}

	public function holidayCalender(Request $request)

	{

		$holidays = \App\Holiday::all();

		if($request->year){

			$data['year'] = $request->year;

		}else{

			$data['year'] = date('Y');

		}

		if($request->category){

			$data['category'] = $request->category;

		}else{

			$data['category'] = 'development';

		}
      // print_r($data);
	return view('hrManager.holidays.calender',$data);

	} 

	public function holidays()

	{

		$holidays = \App\Holiday::all();

		$data['holidays'] = $holidays;

		return view('hrManager.holidays.index',$data);

	} 

	public function getAddHoliday()

	{

		return view('hrManager.holidays.create');

	} 

	public function postAddHoliday(Request $request){

		$validator = \Validator::make($request->all(),

			array(

				'month' =>'required',

				'date' =>'required',

				'category' =>'required',

				'comments' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect('/hrManager/add-holiday')

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$holiday =  new \App\Holiday();

			$holiday->month = $request->month;

			$holiday->date = $request->date;

			$holiday->category = $request->category;

			$holiday->comments = $request->comments;

			if($holiday->save()){ 

				return redirect('/hrManager/holidays')->with('success',"Added Successfully.");

			}else{

				return redirect('/hrManager/holidays')->with('error',"Something Went Wrong.");

			}

		}



	}



	public function getEditHoliday($id)

	{

		$holiday = \App\Holiday::where('id',$id)->first();

		if(is_null($holiday)){

			return redirect('/hrManager/holidays')->with('error',"holiday Not found");

		}else{

			$data['holiday'] = $holiday;

			return view('hrManager.holidays.edit',$data);

		}

	} 

	public function postEditHoliday(Request $request){

		$validator = \Validator::make($request->all(),

			array(

				'month' =>'required',

				'date' =>'required',

				'category' =>'required',

				'comments' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect()->back()

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$holiday =  \App\Holiday::find($request->id);

			$holiday->month = $request->month;

			$holiday->date = $request->date;

			$holiday->category = $request->category;

			$holiday->comments = $request->comments;

			if($holiday->save()){

				return redirect('/hrManager/holidays')->with('success',"Updated Successfully");

			}else{

				return redirect('/hrManager/holidays')->with('error',"Something Went Wrong.");

			}

		}

	}





	public function exportHolidayExcel()

	{

		$holidayExcel = \App\Holiday::all();

		\Excel::create('HolidayExcel', function($excel) use($holidayExcel) {

			$excel->sheet('Sheet 1', function($sheet) use($holidayExcel) {

				$sheet->fromArray($holidayExcel);

			});

		})->export('xls');

	}

	public function importHolidayExcel(Request $request)

	{

		$response = array();

		if($request->hasFile('holidayFile'))

		{

			$extension = \File::extension($request->file('holidayFile')->getClientOriginalName());

			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

				\Excel::load($request->file('holidayFile'), function($reader) {

					$reader->each(function ($sheet)

					{

						$holiday = \App\Holiday::find($sheet->id);

						if(is_null($holiday)){

							$holiday = new \App\Holiday();

						}

						$holiday->month = $sheet->month;

						$holiday->date = date('m/d/Y',strtotime($sheet->date));

						$holiday->category = $sheet->category;

						$holiday->comments = $sheet->comments;

						$holiday->save();

					});

				});

				$response['flag'] = true;

				$response['message'] = "Uploaded Successfully.";

			}else {

				$response['flag'] = false;

				$response['error'] = 'Invalid file';

			}

			return response()->json($response);

		}

	}



	public function deleteHoliday($id)

	{

		$holiday = \App\Holiday::find($id);

		if(is_null($holiday)){

			return redirect('/hrManager/holidays')->with('error','Holiday Not Found');

		}else{

			if($holiday->delete()){

				return redirect('/hrManager/holidays')->with('success','Removed Successfully.');

			}else{

				return redirect('/hrManager/holidays')->with('error','Something Went Wrong');

			}

		}

	}



	public function profileUpdateRequest()

	{

		$data = array();

		$data['employees'] = \App\User::where('request_json','!=',null)->where('role','!=',1)->where('role','!=',2)->get();

		return view('hrManager.requests.profile-requests',$data);

	}

	public function getProfileUpdateRequest($id)

	{

		$data = array();

		$user = \App\User::where('id',$id)->first();
		$data['details'] = \App\EmployeePersonalDetail::where('user_id',$id)->first();

		if(is_null($user)){

			return redirect('/hrManager/request/profile-update/')->with('error','User not found.');

		}else{

			if(is_null($user->request_json)){

				return redirect('/hrManager/request/profile-update')->with('error','No Request Found');

			}else{

				$data['employee'] = $user;

				$data['profile'] = json_decode($user->request_json);

				return view('hrManager.requests.profile-request',$data);

			}

		}

	}

	public function approveProfileUpdateRequest($id)

	{

		$user = \App\User::where('id',$id)->first();

		if(is_null($user)){

			return redirect('/hrManager/request/profile-update')->with('error','User not found.');

		}

		else{

			if(is_null($user->request_json)){

				return redirect('/hrManager/request/profile-update')->with('error','No Request Found');

			}else{

				$profile = json_decode($user->request_json);

				$user->first_name = $profile->first_name;

				$user->last_name = $profile->last_name;

				$user->save();

				$employee =  \App\EmployeePersonalDetail::where('user_id',$user->id)->first();

				$employee->address = $profile->address;

				$employee->bank_account = $profile->bank_account;

				$employee->martial_status = $profile->martial_status;

				$employee->phone_number = $profile->phone_number;

				$employee->anniversary_date = $profile->anniversary_date;

				$employee->dob = $profile->dob;

				$employee->personal_email = $profile->personal_email;

				$employee->father_name = $profile->father_name;

				$employee->mother_name = $profile->mother_name;

				$employee->parent_contact_number = $profile->parent_contact_number;

				$employee->save();

				$user->request_json = null;

				$user->is_request_approved = 1;

				if($user->save()){

					/*-----------------------------------Send notification-----------------------*/

					$receiver = array($user->id);

					$title = "HR Approved Your Profile change request.";

					$message = "HR Approved Your Profile change request.";

					NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

					/*-----------------------------------Send notification-------------------------*/

					return redirect('/hrManager/request/profile-update')->with('success','Approved Successfully.');

				}else{

					return redirect('/hrManager/request/profile-update')->with('error','Something Went Wrong');

				}

			}

		}

	}



	public function discardProfileUpdateRequest($id)

	{

		$user = \App\User::where('id',$id)->first();

		if(is_null($user)){

			return redirect('/hrManager/request/profile-update/')->with('error','User not found.');

		}else{

			if(is_null($user->request_json)){

				return redirect('/hrManager/request/profile-update')->with('error','No Request Found');

			}else{

				$user->request_json = null;

				$user->is_request_approved = -1;

				if($user->save()){

					/*-----------------------------------Send notification-----------------------*/

					$receiver = array($user->id);

					$title = "HR Discarded Your Profile change request.";

					$message = "HR Discarded Your Profile change request.";

					NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

					/*-----------------------------------Send notification-------------------------*/

					return redirect('/hrManager/request/profile-update')->with('success','Request Updated Successfully.');

				}else{

					return redirect('/hrManager/request/profile-update')->with('error','Something Went Wrong');

				}

			}

		}

	}





	public function attendance(Request $request){

		

		if($request->month == ""){

			$m = date('m');

		}else{

			$m = $request->month;

		}

		if($request->year == ""){

			$y = date('Y');

		}else{

			$y = $request->year ;

		}	

		if($request->type == ""){

			$type = "development";

		}else{

			if($request->type == "development"){

				$type = "development";

			}elseif($request->type == "sales"){

				$type = "sales";

			}else{

				$type = "development";

			}

		}	

		$employees = DB::table('users')->join('employee_cb_profiles','employee_cb_profiles.user_id','=','users.id')->select('users.first_name','users.last_name','employee_cb_profiles.employee_id')->where('users.role','<>',1)->where('users.department',$type)->get();

		$data['current_year'] = date('Y');

		$data['search_year'] = $y;

		$data['current_month'] = $m;

		$data['emp_type'] = $type;

		$data['day_in_month'] = cal_days_in_month(CAL_GREGORIAN,$m,$y);

		$data['employees'] = $employees;
		$data['emptype'] = $type;


		$data['dayTypes'] = DB::table('dayType')->get();

		return view('hrManager.attendance.attendance',$data);

	}





	public function submitAttendance(Request $request){

		$attendance = $request->attendance;

		foreach ($attendance as $key => $value) {	

			$is_added = AttendanceData::where('attendance_date',$request->attendanceDate)->where('employee_id',$value['employee_id'])->first(); 

			if(count($is_added) == 1){

				$attendance_data = AttendanceData::find($is_added->id);				

			}else{

				$attendance_data = new AttendanceData();				

			}	

			$attendance_data->attendance_date = $request->attendanceDate;

			$attendance_data->status = $value['status'];

			$attendance_data->employee_id = $value['employee_id'];

			$attendance_data->save();	



		}

		return json_encode(['success'=>true]);

	}

	public function exportAttendanceExcel()

	{

		$holidayExcel = AttendanceData::all();

		\Excel::create('AttendanceExcel', function($excel) use($holidayExcel) {

			$excel->sheet('Sheet 1', function($sheet) use($holidayExcel) {

				$sheet->fromArray($holidayExcel);

			});

		})->export('xls');

	}



	public function importAttendanceExcel(Request $request){

		$response = array();

		if($request->hasFile('attendanceFile'))

		{

			$extension = \File::extension($request->file('attendanceFile')->getClientOriginalName());

			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

				\Excel::load($request->file('attendanceFile'), function($reader) {

					$reader->each(function ($sheet)

					{

						$attendance_data = AttendanceData::find($sheet->id);

						if(is_null($attendance_data)){

							$attendance_data = new AttendanceData();

						}				

						$attendance_data->attendance_date = $sheet->attendance_date;

						$attendance_data->status = $sheet->status;

						$attendance_data->employee_id = $sheet->employee_id;

						$attendance_data->save();	

					});

				});

				$response['flag'] = true;

				$response['message'] = "Uploaded Successfully.";

			}else {

				$response['flag'] = false;

				$response['error'] = 'Invalid file';

			}

			return response()->json($response);

		}

	}



	public function getcurentAttendance(Request $request){

		$current_date = $request->muydate;
		$emptype = $request->emptype;

		$attendanceDone = DB::table('users')->join('employee_cb_profiles','employee_cb_profiles.user_id','=','users.id')

		->join('attendance_data','attendance_data.employee_id','=','employee_cb_profiles.employee_id')

		->select('users.first_name','users.last_name','employee_cb_profiles.employee_id','attendance_data.status')->where('users.department','=',$emptype)->where('users.role','<>',1)->where('attendance_data.attendance_date',$current_date)->get();



		$allemployees = DB::table('users')->join('employee_cb_profiles','employee_cb_profiles.user_id','=','users.id')->select('users.first_name','users.last_name','employee_cb_profiles.employee_id')->where('users.department','=',$emptype)->where('users.role','<>',1)->get();



		$allData = array();



		foreach ($allemployees as $key => $value) {





			$allData[$key]['first_name'] = $value->first_name;

			$allData[$key]['last_name'] = $value->last_name;

			$allData[$key]['employee_id'] = $value->employee_id;

			$isMatch = false;

			foreach ($attendanceDone as $key1 => $value1) {	



				if($value->employee_id == $value1->employee_id){



					$allData[$key]['status'] = $value1->status;

					$isMatch = true;

				}



			}



			if($isMatch == false){

				$allData[$key]['status'] = "no";

			}



		}





		$dayTypes = DB::table('dayType')->get();

		return json_encode(['success'=>true,'current_date'=>$current_date,'employees'=>$allData,'dayTypes'=>$dayTypes]);

	}





	public function addAttendance(Request $request){



		$is_added = AttendanceData::where('attendance_date',$request->mydate)->where('employee_id',$request->employee_id)->first(); 

		if(count($is_added) == 1){

			$attendance_data = AttendanceData::find($is_added->id);				

		}else{

			$attendance_data = new AttendanceData();				

		}	

		$attendance_data->attendance_date = $request->mydate;

		$attendance_data->status = "P";

		$attendance_data->employee_id =$request->employee_id;

		if($attendance_data->save()){

			$data["success"] = true;

		}else{

			$data["success"] = false;			

		}	

		return json_encode($data);

	}



	public function leave_details(){

		$employees = DB::table('users')->join('employee_cb_profiles','employee_cb_profiles.user_id','=','users.id')->select('users.id as user_id','users.first_name','users.last_name','employee_cb_profiles.employee_id','employee_cb_profiles.avail_leaves','employee_cb_profiles.leaves_taken')->where('users.role','<>',1)->get();



		return view('hrManager.leaves.leaveDetails',['employees'=>$employees]);

	}



	public function teams()

	{

		$team_leaders = array();

		$data = array();

		$team_leaders = \App\User::where('role',4)->with('personal_profile','cb_profile')->orderBy('id','DESC')->get();

		$data['team_leaders'] = $team_leaders;

		return view('hrManager.teams.teams',$data);

	}

	public function teamMembers($id)

	{

		$response = array();

		$team_members = \App\TeamMember::where('team_leader_id',$id)->orderBy('id','DESC')->get();

		if(count($team_members) > 0){

			$response['flag'] = true;

			$response['team_members'] = $team_members;

		}else{

			$response['flag'] = false;

		}

		return response()->json($response);

	}

	public function removeTeamMember($id)

	{

		$response = array();

		$team_member = \App\TeamMember::where('team_member_id',$id)->first();

		if(!is_null($team_member)){

			if($team_member->delete()){

				$response['flag'] = true;

			}else{

				$response['flag'] = false;

			}

		}else{

			$response['flag'] = false;

		}

		return response()->json($response);

	}



	public function getAddAssignTeam()

	{

		 $team_members = DB::select('SELECT * FROM users WHERE role = 6 and users.id NOT IN (SELECT team_member_id FROM team_members)');
		$team_leaders = \App\User::where('role',4)->with('personal_profile','cb_profile')->get();

		$data['team_members'] = $team_members;

		$data['team_leaders'] = $team_leaders;

		return view('hrManager.teams.assign-team-members',$data);

	}

	public function postAddAssignTeam(Request $request)

	{

		$validator = \Validator::make($request->all(),

			array(

				'team_leader' =>'required',

				'team_members' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect('/hrManager/assign-team-members')

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$old = false;

			if(count($request->team_members) > 0) {

				$members = "";

				for ($i=0; $i < count($request->team_members) ; $i++) { 

					$team_member = new \App\TeamMember();

					$team_member->team_leader_id = $request->team_leader;

					$team_member->team_member_id = $request->team_members[$i];

					$old_team_member =  \App\TeamMember::where('team_member_id',$request->team_members[$i])->first();

					if(is_null($old_team_member)){

						$team_member->save();



						/*---------------------------------Send notification--------------------------*/

						$receiver = array($request->team_members[$i]);

						$title = "HR Assigned You Team Leader ("." ".getUserById($request->team_leader)->first_name.')';

						$message = "HR Assigned You Team Leader ("." ".getUserById($request->team_leader)->first_name.')';

						NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

						/*---------------------------------Send notification--------------------------*/



						/*---------------------------------Send notification--------------------------*/

						$receiver = array($request->team_leader);

						$title = "HR Assigned You Team Member ("." ".getUserById($request->team_members[$i])->first_name.')';

						$message = "HR Assigned You Team Member ("." ".getUserById($request->team_members[$i])->first_name.')';

						NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

						/*---------------------------------Send notification--------------------------*/

					}else{

						$members .= " ".getUserById($request->team_members[$i])->first_name.',';

						$old = true;

					}

					

				}

				if($old){

					$msg = "Operation executed successfully But Skipped some members(".$members.") because they are already Assigned.";

				}else{

					$msg = "Assigned Successfully";

				}

			}

			return redirect('/hrManager/assign-team-members')->with('success',$msg);

		}

	}





	public function eod_list()

	{

		$sent_eod = \App\Eod::orderBy('id','desc')->get();

		$data['eods'] = $sent_eod;

		return view('hrManager.eod.index',$data);

	} 

	public function sent_eod()

	{

		$sent_eod = \App\HrEod::where('user_id',\Auth::user()->id)->orderBy('id','desc')->get();

		$data['eods'] = $sent_eod;

		return view('hrManager.eod.index',$data);

	} 

	public function getSendEOD()

	{

		$data = array();

		$data['projects'] = \App\Project::all();

		return view('hrManager.eod.send-eod',$data);

	} 

	public function postSendEOD(Request $request){

		$date = '';

		
			$eod = new \App\HrEod();

				$eod->user_id = \Auth::user()->id;

				$eod->date_of_eod = $request->date_of_eod;

				$date = $request->date_of_eod;

				$eod->recruitment = $request->recruitment;
                $eod->generalist = $request->generalist;
				if($request->comment){

					$eod->comment = $request->comment;

				}

				$eod->save();

		

		$templateData['user'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile')->first();

		$templateData['eods'] = \App\HrEod::where('user_id',\Auth::user()->id)->where('date_of_eod',$date)->get();

		$templateData['date_of_eod'] = $date;



		$receiver_email = array();

		$admins = \App\User::where('role','1')->get();

		foreach ($admins as $admin) {

			array_push($receiver_email,$admin->email);

		}

		// $team_leaders = \App\TeamMember::where('team_member_id',\Auth::user()->id)->get();

		// foreach ($team_leaders as $team_leader) {

		// 	$user = \App\User::where('id',$team_leader->team_leader_id)->first();

		// 	array_push($receiver_email,$user->email);

		// }

		$MailData = new \stdClass();

		$MailData->subject ='EOD - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;

		$MailData->sender_email = \Auth::user()->email;

		$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;

		$MailData->receiver_email = $receiver_email;

		$MailData->receiver_name = \Auth::user()->email;

		$MailData->subject = 'EOD Report '.$date.' -'.\Auth::user()->first_name.' '.\Auth::user()->last_name;



		MailController::sendMail('hr_eod',$templateData,$MailData);

		return redirect('/hrManager/sent-eods')->with('success',"Sent Successfully.");

	}





	public function getProfileEdit()

	{

		$data = array();

		$data['employee'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();

		return view('hrManager.profile.edit',$data);

	}

	public function postProfileEdit(Request $request)

	{

		$user_array['first_name'] = $request->first_name;

		$user_array['last_name'] = $request->last_name;

		$user_array['address'] = $request->address;

		$user_array['phone_number'] = $request->phone_number;

		$user_array['bank_account'] = $request->account_no;

		$user_array['martial_status'] = $request->martial_status;

		$user_array['dob'] = $request->dob;

		$user_array['anniversary_date'] = $request->anniversary_date;

		$user_array['personal_email'] = $request->personal_email;

		$user_array['father_name'] = $request->father_name;

		$user_array['mother_name'] = $request->mother_name;

		$user_array['parent_contact_number'] = $request->parent_number;

		$user = \App\User::where('id',\Auth::user()->id)->first();

		$user->request_json = json_encode($user_array);

		$user->is_request_approved = 0;

		$url = url('role/request/profile/'.$user->id);

		if($user->save()){

			/*-----------------------------------Send notification-------------------------------------------*/

			$receiver = array();

			$title = $user->first_name." ".$user->last_name." "."Requested For profile update.";

			$message = $user->first_name." ".$user->last_name." "."Requested For profile update."."<br>";

			$message.= "<a href='".$url."' class='btn btn-primary'>View</a>";

			$admins = \App\User::where('role','1')->get();

			foreach ($admins as $admin) {

				array_push($receiver,$admin->id);

			}

			NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

			/*-----------------------------------Send notification-------------------------------------------*/

			return redirect('/profile')->with('success','Request Sent Successfully.Waiting approval from admin.');

		}

	}



	public function myLeaves(Request $request)

	{

		if($request->type){

			if($request->type == 'approved'){

				$is_approved = 1;

			}

			elseif($request->type == 'pending'){

				$is_approved = 0;

			}

			elseif($request->type == 'rejected'){

				$is_approved = -1;

			}

			$leaves = \App\Leaves::where('user_id',\Auth::user()->id)->where('is_approved',$is_approved)->with('leave_type')->get();

		}else{

			$leaves = \App\Leaves::where('user_id',\Auth::user()->id)->with('leave_type')->get();

		}

		$data['leaves'] = $leaves;

		return view('hrManager.my-leave.index',$data);

	} 

	public function getAddLeave()

	{

		$leave_types = \App\LeaveType::all();

		$data['leave_types'] = $leave_types;

		return view('hrManager.my-leave.apply-leave',$data);

	} 

	public function postAddLeave(Request $request){

		$validator = \Validator::make($request->all(),

			array(

				'leave_type' =>'required',

				'date_from' =>'required',

				'date_to' =>'required',

				'contact_number' =>'required',

				'reason' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect('/hrManager/apply-leave')

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$leave =  new \App\Leaves();

			$leave->user_id = \Auth::user()->id;

			$leave->leave_type_id = $request->leave_type;

			$leave->date_from = $request->date_from;

			$leave->date_to = $request->date_to;

			$leave->days = $request->days;

			$leave->contact_number = $request->contact_number;

			$leave->reason = $request->reason;

			$url = url('role/leave-listing?type=pending');

			if($leave->save()){ 

				/*-----------------------------------Send notification-------------------------------------------*/

				$user = \App\User::where('id',\Auth::user()->id)->first();

				$receiver = array();

				$title = $user->first_name." ".$user->last_name." "."Requested for Leave";

				$message = $user->first_name." ".$user->last_name." "."Requested for Leave."."<br>";

				$message.= "<a href='".$url."' class='btn btn-primary'>view</a>";

				$admins = \App\User::where('role','1')->get();

				foreach ($admins as $admin) {

					array_push($receiver,$admin->id);

				}

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*-----------------------------------Send notification-------------------------------------------*/

				return redirect('/hrManager/my-leaves')->with('success',"Added Successfully.");

			}else{

				return redirect('/hrManager/my-leaves')->with('error',"Something Went Wrong.");

			}

		}



	}



	public function resignations(Request $request)

	{

		$resignations = \App\Resignation::where('user_id','!=',\Auth::user()->id)->orderBy('id','DESC')->get();

		$data['resignations'] = $resignations;

		return view('hrManager.resignation.resignations',$data);

	}
	
	// View All Notification 
	public function view_notification(){
		$id= \Auth::user()->id;
		$all_notification = \App\Notification::where('receiver_id',$id)->orderBy('id', 'desc')->paginate(15);
		return view('hrManager.notification',['all_notifications'=>$all_notification]);
		
	}



}

