<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use DB;



use App\AttendanceData;



class AttendanceController extends Controller

{



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

		$data['emp_type'] = $type;

		$data['current_month'] = $m;

		$data['day_in_month'] = cal_days_in_month(CAL_GREGORIAN,$m,$y);

		$data['employees'] = $employees;
		$data['type'] = $type;

		$data['dayTypes'] = DB::table('dayType')->get();

		return view('admin.attendance.attendance',$data);

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

}