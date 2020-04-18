<?php







namespace App\Http\Controllers;







use Illuminate\Http\Request;







use DB;







use App\AttendanceData;







class EmployeeController extends Controller



{



	



	public function dashboard()



	{



		$projects = \App\EmployeeProject::where('user_id',\Auth::user()->id)->orderBy('id','DESC')->get();



		$data['projects'] = $projects;



		return view('employee.dashboard',$data);



	} 



	public function employees(Request $request)



	{



		if($request->type == 'active'){

       $employees = \App\User::where('role','!=',1)->where('is_active',1)->with('personal_profile','cb_profile')->orderBy('id','DESC')->get();

		}

		else{

			$employees = \App\User::where('role','!=',1)->with('personal_profile','cb_profile')->orderBy('id','DESC')->get();

		}

      if(isset($_GET['filter_dep']) || isset($_GET['filter_dep']) ){

		if($_GET['filter_dep'])

		 {	$fil = $_GET['filter_dep'];

         

		   if($_GET['filter_dep1'])



		     { 

		      $fil1 = $_GET['filter_dep1'];

               $data['employees'] = \App\User::where('department', $fil)->where('role',$fil1)->get();

		      }

		      else

		      {

		      	$data['employees'] = \App\User::where('department', $fil)->get();

		      }

		 	//$data['employees'] = \App\User::where('department', $fil)->get();

		 }

		 else

		   {

             if($_GET['filter_dep1'])



		     {  $fil1 = $_GET['filter_dep1'];

		

               $data['employees'] = \App\User::where('role',$fil1)->get();

		      }

		      else

		      {

		      	$data['employees'] = $employees;

		      }

		   }

		}

		else{

       $data['employees'] = $employees;

   }

		return view('admin.employees.index',$data);



	} 



	public function exportEmployees()



	{



		$userExcel = \App\User::select('id as User Id','first_name as First Name','last_name as Last Name','email as Email','gender as Gender','department as Department')->get();



		$assetExcel = \App\Asset::select('asset_code as Asset Code','name as Name','s_no as S.No','purchase_bill_date as Purchase/Bill date','is_warranty as Warranty','warranty_end_date as Warranty End Date','system_id as System Id','status as Status')->get();



		$assetTypeExcel = \App\AssetType::select('id as Asset Type Id','type as Asset Type')->get();



		$AssetAssocExcel = \App\AssetAssoc::select('id as Asset Id','name as Asset Name')->get();



		\Excel::create('Employees Lists', function($excel) use($userExcel) {



			$excel->sheet('Users', function($sheet) use($userExcel) {



				$sheet->fromArray($userExcel);



			});



		})->export('xls');



	} 



	public function importEmployees(Request $request){
		$response = array();
		if($request->hasFile('employeeFile')){
			$extension = \File::extension($request->file('employeeFile')->getClientOriginalName());
			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
				\Excel::load($request->file('employeeFile'), function($reader) {
					$reader->each(function ($sheet){
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



		return view('admin.employees.create',$data);



	} 



	public function getEmployeeProfile($id)



	{



		$employee = \App\User::where('id',$id)->where('role','!=',1)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();



		if(is_null($employee)){



			return redirect('/admin/employees')->with('error',"Employee not found");



		}else{



			$data['employee'] = $employee;

			$userid = $id;

	    $employeeid = \App\EmployeeCbProfile::where('user_id','=',$userid)->first();

			$data['halfdays'] = \App\AttendanceData::where('employee_id','=',$employeeid["employee_id"])->where('status','HD')->count();

			//$data['halfdays'] = \App\AttendanceData::where('employee_id','=',$employeeid["employee_id"])->where('status','HD')->whereBetween('attendance_date', [date('y-m-01'), date('y-m-t')])->count();

			$data['ui'] = \App\AttendanceData::where('employee_id','=',$employeeid["employee_id"])->where('status','UI')->count();

			$data['update_date'] =  strtotime($employeeid['updated_at']);

			$data['current_date']  = strtotime(date('Y-M-d 00:00:00'));

			

			//print_r($data['current_date']."==".$data['update_date']);

           // $data['ui'] = \App\AttendanceData::where('employee_id','=',$employeeid["employee_id"])->where('status','UI')->whereBetween('attendance_date', [date('y-m-01'), date('y-m-t')])->count();

			return view('admin.employees.profile',$data);



		}



	}



	public function postAddEmployee(Request $request){



       $admin = \App\User::where('role',1)->get();

		$date = date('d-m-Y');



		if($request->file('employee_photo') != ""){



			$validator = \Validator::make($request->all(),



				array(



					'department' =>'required',



					'first_name' =>'required',



					'email' =>'required|email',



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



					'email' =>'required|email',



					'password' =>'required',



					'role' =>'required',



					'gender' =>'required',



				)



			);



		}



		



		if($validator->fails())



		{



			return redirect('/admin/add-employee')



			->withErrors($validator)



			->withInput();



		} 



		else



		{   



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















				return redirect('/admin/employee/'.$user->id)->with('success',"Created Successfully");



			}else{



				return redirect('/admin/employees')->with('error',"Something Went Wrong.");



			}



		}







	}







	public function getEditEmployee($id)



	{



		$employee = \App\User::where('id',$id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();



		if(is_null($employee)){



			return redirect('/admin/employees')->with('error',"employee Not found");



		}else{



			$roles = \App\Role::where('role','!=','Admin')->get();



			$data['roles'] = $roles;



			$data['employee'] = $employee;



			return view('admin.employees.edit',$data);



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



				if($request->employee_status){



					$employee_cb_profile->status = $request->employee_status;



					if($request->employee_status == "active"){



						$user->is_active = 1;



					}else{



						$user->is_active = 0;



					}



					$user->save();



				}



				else{



					$employee_cb_profile->status = null;	



				}



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



				$hrs = \App\User::where('role','2')->get();



				foreach ($hrs as $hr) {



					array_push($receiver,$hr->id);



				}



				$title = "Admin Updated Profile -.".' '.$user->first_name ." ".$user->last_name.'('.$employee_cb_profile->employee_id.')';



				$message = "Admin Updated Profile -.".' '.$user->first_name ." ".$user->last_name.'('.$employee_cb_profile->employee_id.')';



				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);



				/*-----------------------------------Send notification----------------------*/







				/*-----------------------------------Send notification-----------------------*/



				$receiver = array($user->id);



				$title = "Admin Updated your Profile";



				$message = "<p>Admin Updated your Profile</p>";



				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);



				/*-----------------------------------Send notification----------------------*/







				return redirect('/admin/employee/'.$request->id)->with('success',"Updated Successfully");



			}else{



				return redirect('/admin/employee/'.$request->id)->with('error',"Something Went Wrong.");



			}



		}



	}







	public function deleteEmployee($id)



	{



		$employee = \App\employee::find($id);



		if(is_null($employee)){



			return redirect('/admin/employees')->with('error','employee Not Found');



		}else{



			$user_id = $employee->user_id;



			if($employee->delete()){



				$user = \App\User::find($user_id);



				if(!is_null($user)){



					$user->delete();



				}



				return redirect('/admin/employees')->with('success','employee Removed Successfully.');



			}else{



				return redirect('/admin/employees')->with('error','Something Went Wrong');



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



			$data['category'] = \Auth::user()->department;



		}



		return view('employee.calender',$data);



	} 



	public function getProfile()



	{



		$data = array();



		$data['employee'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();



		return view('employee.profile.index',$data);



	}







	public function getProfileEdit()



	{



		$data = array();



		$data['employee'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();



		return view('employee.profile.edit',$data);



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



			$message = "<p>".$user->first_name." ".$user->last_name." "."Requested For profile update."."</p>"."<br>";



			$message.= "<a href='".$url."' class='btn btn-primary'>View</a>";



			$admins = \App\User::where('role','1')->get();



			foreach ($admins as $admin) {



				array_push($receiver,$admin->id);



			}



			$hrs = \App\User::where('role','2')->get();



			foreach ($hrs as $hr) {



				array_push($receiver,$hr->id);



			}



			NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);



			/*-----------------------------------Send notification-------------------------------------------*/



			return redirect('/profile')->with('success','Request Sent Successfully.Waiting approval from admin.');



		}



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







	public function getAssisnedProject(){



		$projects = \App\EmployeeProject::where('user_id',\Auth::user()->id)->orderBy('id','DESC')->get();



		$data['projects'] = $projects;



		return view('employee.assigned_projects',$data);



	}

	public function addnewdetails(Request $request,$user_id)

	{



			$validator = \Validator::make($request->all(),

				array(

					'last_company_details' =>'required',

					'last_company_joining_date' =>'required',

					'last_company_relieving' =>'required',

					'last_company_salary' =>'required',

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

           for($k=0; $k<count($request->last_company_details); $k++)

		    {  		

		    		$th=['user_id' => $user_id,

		    		'last_company_details' => $request->last_company_details[$k],

		    		 'last_company_joining_date' => $request->last_company_joining_date[$k],

		    		 'last_company_relieving' => $request->last_company_relieving[$k],

		    		 'last_company_salary' => $request->last_company_salary[$k]];

		    

		         $tn = \App\EmployeeExtraDetail::insert($th);

		   

			if(isset($tn)){

			return redirect()->back()->with('success',"Extra Details Added  Successfully");

			}else{

				return redirect()->back()->with('error',"Something Went Wrong.");

			}

		}



	}

}

public function restract()



	{

		$retracts = \App\Retract::where('user_id','=',\Auth::user()->id)->first();



		$data['retract'] = $retracts;

		//dd($data['retracts']);

        

		return view('employee.restracts.retract',$data);

	}

	public function postapplyretract(Request $request)

     {







		$validator = \Validator::make($request->all(),



			array(



				'reason_retract' =>'required',



				'message_retract' =>'required',





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

            $kt = \App\Retract::where('user_id',\Auth::user()->id)->get();

             if(count($kt)<= 0)

             {





			$retract = new \App\Retract();



			$retract->user_id = \Auth::user()->id;

			

			$retract->reason = $request->reason_retract;



			$retract->message = $request->message_retract;

			

			

			$retract->created_at = date('Y-m-d h:i:s');

		

			if($retract->save()){







				/*-----------------------------------Send notification-------------------------------------------*/



				$user = \App\User::where('id',\Auth::user()->id)->first();



				$receiver = array();



				$receiver_email = array();



				$title = $user->first_name." ".$user->last_name." "."Applied Retract";



				$message = "<p>".$user->first_name." ".$user->last_name." "."Applied Retract."."</p>";

			



				$admins = \App\User::where('role','1')->get();



				foreach ($admins as $admin) {



					array_push($receiver,$admin->id);



					array_push($receiver_email,$admin->email);



				}



				if($user->role != 2){



					$hrs = \App\User::where('role','2')->get();



					foreach ($hrs as $hr) {



						array_push($receiver,$hr->id);



						array_push($receiver_email,$hr->email);



					}



				}



				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);



				/*-----------------------------------Send notification------------------------------------*/







				$templateData['user'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile')->first();



				



				$templateData['retract'] = $retract;



				$MailData = new \stdClass();



				$MailData->subject ='Retract Letter - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;



				$MailData->sender_email = \Auth::user()->email;



				$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;



				$MailData->receiver_email = $receiver_email;



				$MailData->receiver_name = \Auth::user()->email;



				MailController::sendMail('retract_letter',$templateData,$MailData);







				return redirect('/employee/retract/')->with('success',"Waiting for Admin reply....");



				



			}



		}

		else

	     	{

                $retract = \App\Retract::where('user_id',\Auth::user()->id)->get();

               

			  $th = ['reason' => $request->reason_retract,'message' => $request->message_retract,'created_at' => date('Y-m-d h:i:s')];

			  

			$tn = \App\Retract::where('id',$retract[0]->id)->update($th);



			$user = \App\User::where('id',\Auth::user()->id)->first();



				$receiver = array();



				$receiver_email = array();



				$title = $user->first_name." ".$user->last_name." "."Applied Retract again";



				$message = "<p>".$user->first_name." ".$user->last_name." "."Applied Retract again."."</p>";

				$message.= "<a href='"."' class='btn btn-primary'>View</a>";



				$admins = \App\User::where('role','1')->get();



				foreach ($admins as $admin) {



					array_push($receiver,$admin->id);



					array_push($receiver_email,$admin->email);



				}



				if($user->role != 2){



					$hrs = \App\User::where('role','2')->get();



					foreach ($hrs as $hr) {



						array_push($receiver,$hr->id);



						array_push($receiver_email,$hr->email);



					}



				}



				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

			return redirect('/employee/retract/')->with('success',"Waiting for Admin reply....");

		

		    }

	  }



     }

     public function del_kt()

       {

           $kt = \App\KnowledgeTransfer::where('user_id','=',\Auth::user()->id)->first();

           $kt->delete();

           return back();

       }

	   

	public function view_notification(){

		$id= \Auth::user()->id;

		$all_notification = \App\Notification::where('receiver_id',$id)->orderBy('id', 'desc')->paginate(15);

		

		return view('employee.notification',['all_notifications'=>$all_notification]);

	}



}









 