<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use DB;
use App\HrEod; 
use App\Eod; 



class EODController extends Controller

{

	public function getSeeTeamEOD(){

		$data = array();

		$teamMembers = \App\TeamMember::where('team_leader_id',\Auth::user()->id)->get();

		$i = 0;

		if(count($teamMembers)>0){

			foreach ($teamMembers as $teamMember) {

				$sent_eod = \App\Eod::orderBy('id','desc')->where('user_id',$teamMember->team_member_id)->get();

				$data['eod'][$i] = $sent_eod;

				$i++;

			}

		}else{

			$data['eod'] = array();

		}

		return view('employee.eod.seeTeamEOD',$data);



	}


	public function hr_eod_list(){
		 $data['eods'] = HrEod::orderBy('id','DESC')->paginate(10);

		 return view('admin.eod.hr_eod',$data); 
	}

	public function hr_eod_details(Request $request){
      $eod = HrEod::whereId($request->id)->first();     
      $html = "";

      $html.="<p> <b> Employee : </b>".$eod->user->first_name."</p>";   
      $html.="<p> <b> EOD Date : </b> $eod->date_of_eod</p>";
      $html.="<p> <b> Recruitment : </b> $eod->recruitment</p>";
      $html.="<p> <b> Generalist  : </b> $eod->generalist</p>"; 

      return $html;
	}

	public function eod_details(Request $request){
      $eod = Eod::whereId($request->id)->first();     
      $html = ""; 
      $html.="<p> <b> Employee : </b>".$eod->user->first_name."</p>";   
      $html.="<p> <b> EOD Date : </b> $eod->date_of_eod</p>";
      $html.="<p> <b> Project Name : </b> ".$eod->project->name."</p>"; 
      $html.="<p> <b> Task  : </b> $eod->task</p>"; 

      return $html;
	}

	public function deleteHR_EOD($id){

		HrEod::whereId($id)->delete(); 

		return redirect()->back(); 
	}
     
	public function eod_list(){
        $data['eods_filter'] = DB::table('eods')->select('project_id')->distinct('project_id')->get();
        $sent_eod = \App\Eod::orderBy('id','desc')->get();
		$data['eods'] = $sent_eod;
		return view('admin.eod.index',$data); 

	} 


	public function eod_list_filter(Request $request)
	{
		   $fil = $request->filter;
		   $data['eods_filter'] = DB::table('eods')->select('project_id')->distinct('project_id')->get();
		   $data['eods'] = DB::table('eods')->orderBy('id','desc')->where('project_id',$fil)->get();
		 
          return view('admin.eod.index',$data);
	}

	public function sent_eod()

	{

		$sent_eod = \App\Eod::where('user_id',\Auth::user()->id)->orderBy('id','desc')->get();

		$data['eods'] = $sent_eod;

		return view('employee.eod.index',$data);

	} 

	public function getSendEOD()

	{

		$data = array();

		//$data['projects'] = \App\Project::all();
		 $data['projects'] = \App\EmployeeProject::where('user_id',\Auth::user()->id)->get();

		return view('employee.eod.send-eod',$data);

	} 

	public function postSendEOD(Request $request){

		$date = '';

		if(count($request->project) > 0) {

			for ($i=0; $i < count($request->project) ; $i++) { 

				$eod = new \App\Eod();

				$eod->user_id = \Auth::user()->id;

				$eod->date_of_eod = $request->date_of_eod;

				$date = $request->date_of_eod;

				$eod->project_id = $request->project[$i];

				$eod->hours_spent = $request->hours_spent[$i];

				$eod->task = $request->task[$i];

				if($request->comment){

					$eod->comment = $request->comment;

				}

				$eod->save();

			}

		}

		$templateData['user'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile')->first();

		$templateData['eods'] = \App\Eod::where('user_id',\Auth::user()->id)->where('date_of_eod',$date)->get();

		$templateData['date_of_eod'] = $date;



		$receiver_email = array();

		$admins = \App\User::where('role','1')->get();

		foreach ($admins as $admin) {

			array_push($receiver_email,$admin->email);

		}

		$team_leaders = \App\TeamMember::where('team_member_id',\Auth::user()->id)->get();

		foreach ($team_leaders as $team_leader) {

			$user = \App\User::where('id',$team_leader->team_leader_id)->first();

			array_push($receiver_email,$user->email);

		}

		$MailData = new \stdClass();

		$MailData->subject ='EOD - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;

		$MailData->sender_email = \Auth::user()->email;

		$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;

		$MailData->receiver_email = $receiver_email;

		$MailData->receiver_name = \Auth::user()->email;

		$MailData->subject = 'EOD Report '.$date.' -'.\Auth::user()->first_name.' '.\Auth::user()->last_name;

        

		MailController::sendMail('eod',$templateData,$MailData);

		return redirect('/employee/sent-eods')->with('success',"Sent Successfully.");

	}





	public function getEODToAdmin($id)

	{

		$eod = \App\Eod::where('id',$id)->first();

		if(is_null($eod)){

			return redirect('/admin/eods')->with('error',"EOD Not found");

		}else{

			$data['eod'] = $eod;

			return view('admin.eod.edit',$data);

		}

	} 

	public function getEOD($id)

	{

		$eod = \App\Eod::where('id',$id)->first();

		if(is_null($eod)){

			return redirect('/employee/sent-eods')->with('error',"eod Not found");

		}else{

			$data['eod'] = $eod;

			return view('employee.eod.edit',$data);

		}

	} 



	public function deleteEOD($id)

	{

		$eod = \App\Eod::find($id);

		if(is_null($eod)){

			return redirect('/admin/eods')->with('error','EOD Not Found');

		}else{

			if($eod->delete()){

				return redirect('/admin/eods')->with('success','Removed Successfully.');

			}else{

				return redirect('/admin/eods')->with('error','Something Went Wrong');

			}

		}

	}

}

