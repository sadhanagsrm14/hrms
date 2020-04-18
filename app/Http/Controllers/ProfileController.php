<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

class ProfileController extends Controller

{

	public function getRole(){

		if(Auth::check()){

			if(Auth::user()->role == 1){

				return "admin";

			}

			if(Auth::user()->role == 2){

				return "hrManager";

			}

			if(Auth::user()->role == 3){

				return "hrExecutive";

			}

			if(Auth::user()->role == 4){

				return "employee";

			}

			if(Auth::user()->role == 5){

				return "itExecutive";

			}

			if(Auth::user()->role == 6){

				return "employee";

			}

		}

	}

	public function profile()

	{
         $current_date = date('Y-m-d');
         $last_date = date('Y-m-t');
		$profile = \App\User::where('id',Auth::user()->id)->with('personal_profile','cb_profile','previous_employment','cb_appraisal_detail')->first();

		$data['employee'] = $profile;
		$userid = Auth::user()->id;
	    $employeeid = \App\EmployeeCbProfile::select('employee_id')->where('user_id','=',$userid)->first();
	  $data['halfdays'] = \App\AttendanceData::where('employee_id','=',$employeeid["employee_id"])->where('attendance_date','>=',$current_date)->where('attendance_date','<=',$last_date)->where('status','HD')->count();
     //   if($data['halfdays'] == 2 || $data['halfdays'] == 4)
	    // {
	    // 	$cbprofile = \App\EmployeeCbProfile::where('user_id',Auth::user()->id)->first();
           
     //        $update_avail_leaves = $cbprofile->avail_leaves-1;
     //        \App\EmployeeCbProfile::where('user_id',Auth::user()->id)->update(['avail_leaves'=>$update_avail_leaves]);
          
	    // }
	    // else
	    //   {
              
	    //   }



	  $data['ui'] = \App\AttendanceData::where('employee_id','=',$employeeid["employee_id"])->where('status','UI')->count();
	  $data['employee_extra_details'] = \App\EmployeeExtraDetail::where('user_id',$userid)->get();

		return view($this->getRole().'.profile',$data);

	}



	public function postChangePassword(Request $request)

	{

		$response = array();

		$user = \App\User::find(\Auth::user()->id);

		$old_password = $request->old_password;

		$new_password = $request->new_password;

		if(\Hash::check($old_password, $user->getAuthPassword())){

			$user->password = \Hash::make($new_password);

			if($user->save()){

				$response['flag'] = true;

				/*-----------------------------------Send notification-------------------------------------------*/

				$receiver = array();

				$title = $user->first_name." ".$user->last_name." "."Changed Password";

				$message = $user->first_name." ".$user->last_name." "."Changed Password";

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

			}else{

				$response['flag'] = false;

				$response['error'] = "Something Went Wrong!";

			}

		}

		else{

			$response['flag'] = false;

			$response['error'] = "Invalid Old Password";

		}

		return response()->json($response);

	}

	public function updateProfilePic(Request $request)

	{

		$response = array();

		$validator = \Validator::make($request->all(),

			array(

				'profilePic' =>'image',

			)

		);

		if($validator->fails())

		{

			$response['flag'] = false;

			$response['error'] = "Please Upload valid Image";

		}

		else

		{

			$user = \Auth::user();

			if($request->file('profilePic') != ""){

				$employee_cb_profile =  \App\EmployeeCbProfile::where('user_id',$user->id)->first();

				$image = $request->file('profilePic');

				$filename = time().'.'.$image->getClientOriginalExtension();

				$destinationPath = public_path('/images/employees');

				$image->move($destinationPath, $filename);

				$employee_cb_profile->employee_pic = url('/').'/images/employees/'.$filename;

				$employee_cb_profile->save();

				$response['flag'] = true;

			} 

		}

		return response()->json($response);

	}

}

