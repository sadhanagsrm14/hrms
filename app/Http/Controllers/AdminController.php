<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use DB;


class AdminController extends Controller

{

	public function dashboard()

	{
       $data['activeemp'] = \App\User::where('role','!=',1)->where('is_active',1)->with('personal_profile','cb_profile')->get();

		 $data['pendleave'] = \App\Leaves::where('is_approved','0')->get();
		 $data['is_requested_approved'] = \App\User::where('request_json','!=',null)->where('role','!=',1)->get();
		return view('admin.dashboard',$data);

	}



	public function teams()

	{
		$team_leaders = array();

		$data = array();

		$team_leaders = \App\User::where('role',4)->with('personal_profile','cb_profile')->orderBy('id','DESC')->get();

		$data['team_leaders'] = $team_leaders;

		return view('admin.teams.teams',$data);

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

		//$team_members = \App\User::where('role',6)->with('personal_profile','cb_profile')->get();
         $team_members = DB::select('SELECT * FROM users WHERE role = 6 and users.id NOT IN (SELECT team_member_id FROM team_members)');
		$team_leaders = \App\User::where('role',4)->with('personal_profile','cb_profile')->get();

		$data['team_members'] = $team_members;

		$data['team_leaders'] = $team_leaders;

		return view('admin.teams.assign-team-members',$data);

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

			return redirect('/admin/assign-team-members')

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

						$title = "Admin Assigned You Team Leader ("." ".getUserById($request->team_leader)->first_name.')';

						$message = "Admin Assigned You Team Leader ("." ".getUserById($request->team_leader)->first_name.')';

						NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

						/*---------------------------------Send notification--------------------------*/



						/*---------------------------------Send notification--------------------------*/

						$receiver = array($request->team_leader);

						$title = "Admin Assigned You Team Member ("." ".getUserById($request->team_members[$i])->first_name.')';

						$message = "Admin Assigned You Team Member ("." ".getUserById($request->team_members[$i])->first_name.')';

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

			return redirect('/admin/assign-team-members')->with('success',$msg);

		}

	}



	public function resignations(Request $request)

	{
    
  
    $table=DB::table('resignations')->leftjoin('knowledge_transfers','resignations.user_id','=','knowledge_transfers.user_id')->select('resignations.*','knowledge_transfers.is_actived')->distinct('resignations.id')->orderBy('id','DESC')->get();
		$data['resignations'] = $table;

	//	$data['kt_status'] = \App\KnowledgeTransfer::where('user_id',$resignation->user_id)->first();
       
		return view('admin.resignation.resignations',$data);

	}
	public function resignationsaccepted($id)
	{
       $resignations = \App\Resignation::find($id);
       $user = \App\User::where('id','=',$resignations->user_id)->first();

       if(is_null($resignations)){

			 return redirect()->back()->with('error','Error');
       }
       else{
       $resignation = DB::table('resignations')->where('id',$id)->update(['is_active'=> 1]);
       
         $resignation_details = DB::table('resignations')->where('id',$id)->first();
     $resignation_date = $resignation_details->date_of_resign;
      
        $newDate = date("d-m-Y", strtotime($resignation_details->date_of_resign));
       $leaves_details = DB::table('leaves')->where('user_id',$resignation_details->user_id)->where('date_from','>=',$newDate)->get();
        print_r($leaves_details);
       if(!isset($leaves_details)){
       $leave_id = $leaves_details[0]->id; 
      
         $leave_info  = DB::table('leaves')->where('id',$leave_id)->update(['is_approved'=>-1]);
    //      $receiver = array($resignations->user_id);
				// $title = "Admin Discarted Your leave.";
				// $message = "Admin Discarted Your leave ";
				// $admins = \App\User::where('role','1')->get();
				// NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);
				/*-----------------------------------leave discarted Send ----*/


         }



     $templateData['user1'] = \App\User::where('id',$resignations->user_id)->with('personal_profile','cb_profile')->first();
        

				/*-----------------------------------Send notification-------------------------------------------*/
				$receiver = array($resignations->user_id);
				$title = "Admin Accepted Your Resignation.";
				$message = "Admin Accepted Your Resignation Request ";
				$admins = \App\User::where('role','1')->get();
				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);
				/*-----------------------------------Send notification-------------------------------------------*/

				$MailData = new \stdClass();
		$MailData->subject ='Resignation Accepted - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->sender_email = \Auth::user()->email;
		$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->receiver_email = $user->email;
		$MailData->receiver_name = $user->first_name.' '.$user->last_name;
      //  print_r($templateData."".$MailData);
		MailController::sendMail('accepted_resignation',$templateData,$MailData);  
       return redirect()->back()->with('success','Successfully Accepted Resignation');

	}
	  
      }
      public function resignationsrejected($id)
	 {
        $resignations = \App\Resignation::find($id);
       $user = \App\User::where('id','=',$resignations->user_id)->first();

       if(is_null($resignations)){

			 return redirect()->back()->with('error','Error');
       }
       else{
       $resignation = DB::table('resignations')->where('id',$id)->update(['is_active'=> -1]);
       $templateData['user1'] = \App\User::where('id',$resignations->user_id)->with('personal_profile','cb_profile')->first();
      
       

				/*-----------------------------------Send notification-------------------------------------------*/
				$receiver = array($resignations->user_id);
				$title = "Admin Rejected Your Resignation.";
				$message = "Admin Rejected Your Resignation Request";
				$admins = \App\User::where('role','1')->get();
				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);
				/*-----------------------------------Send notification-------------------------------------------*/

				$MailData = new \stdClass();
		$MailData->subject ='Resignation Rejected - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->sender_email = \Auth::user()->email;
		$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->receiver_email = $user->email;
		$MailData->receiver_name = $user->first_name.' '.$user->last_name;
      //  print_r($templateData."".$MailData);
		MailController::sendMail('rejected_resignation',$templateData,$MailData);  
       return redirect()->back()->with('success','Successfully Rejected Resignation');

     }
  }

 public function restract()
        {
        	$retracts = \App\Retract::where('user_id','!=',\Auth::user()->id)->orderBy('id','DESC')->get();

		$data['retracts'] = $retracts;
		//print_r($data['id']);
        
		return view('admin.restracts.retracts',$data);
        }

    public function restractaccepted($id)
        {
        	 $retracts = \App\Retract::find($id);
       $user = \App\User::where('id','=',$retracts->user_id)->first();

       if(is_null($retracts)){

			 return redirect()->back()->with('error','Error');
       }
       else{
       $retract = DB::table('retracts')->where('id',$id)->update(['is_active'=> 1]);
       $retract1 = DB::table('retracts')->where('id',$id)->first();
        $retract1_user = $retract1->user_id;

        $resignation_details = DB::table('resignations')->where('user_id',$retract1_user )->first();
       $resignation_date = $resignation_details->date_of_resign;
       $newDate = date("d-m-Y", strtotime($resignation_details->date_of_resign));
       $leaves_details = DB::table('leaves')->where('user_id',$resignation_details->user_id)->where('date_from','>=',$newDate)->get();
      // print_r($leaves_details);
       if(!isset($leaves_details)){
       $leave_id = $leaves_details[0]->id; 
      
         $leave_info  = DB::table('leaves')->where('id',$leave_id)->update(['is_approved'=>1]);
         
         }

        //dd(  $leave_info);


     $templateData['user1'] = \App\User::where('id',$retracts->user_id)->with('personal_profile','cb_profile')->first();
        

				/*-----------------------------------Send notification-------------------------------------------*/
				$receiver = array($retracts->user_id);
				$title = "Admin Accepted Your Retract.";
				$message = "Admin Accepted Your Retract Request ";
				$admins = \App\User::where('role','1')->get();
				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);
				/*-----------------------------------Send notification-------------------------------------------*/

				$MailData = new \stdClass();
		$MailData->subject ='Retract Accepted - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->sender_email = \Auth::user()->email;
		$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->receiver_email = $user->email;
		$MailData->receiver_name = $user->first_name.' '.$user->last_name;
       // print_r($MailData);
		MailController::sendMail('accepted_retract',$templateData,$MailData);  
       return redirect()->back()->with('success','Successfully Accepted Retract');

	  }
        }
        public function restractrejected($id)
	 {
        $retracts = \App\Retract::find($id);
       $user = \App\User::where('id','=',$retracts->user_id)->first();

       if(is_null($retracts)){

			 return redirect()->back()->with('error','Error');
       }
       else{
       $retract = DB::table('retracts')->where('id',$id)->update(['is_active'=> -1]);
       $templateData['user1'] = \App\User::where('id',$retracts->user_id)->with('personal_profile','cb_profile')->first();
      
       

				/*-----------------------------------Send notification-------------------------------------------*/
				$receiver = array($retracts->user_id);
				$title = "Admin Rejected Your Resignation.";
				$message = "Admin Rejected Your Resignation Request";
				$admins = \App\User::where('role','1')->get();
				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);
				/*-----------------------------------Send notification-------------------------------------------*/

				$MailData = new \stdClass();
		$MailData->subject ='Retract Rejected - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->sender_email = \Auth::user()->email;
		$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;
		$MailData->receiver_email = $user->email;
		$MailData->receiver_name = $user->first_name.' '.$user->last_name;
     // dd($MailData);
		MailController::sendMail('rejected_retract',$templateData,$MailData);  
       return redirect()->back()->with('success','Successfully Rejected Retract');

     }
  }

    public function ktassign_confirm($id)
     {
     	$retracts = \App\Resignation::find($id);
     	$kt = \App\KnowledgeTransfer::where('user_id',$retracts->user_id)->get();
     	
       $user = \App\User::where('id','=',$retracts->user_id)->first();

       if(is_null($retracts)){

			 return redirect()->back()->with('error','Error');
       }
       else{
      // $retract = DB::table('retracts')->where('id',$id)->update(['is_active'=> -1]);
         $kt_confirm = new \App\KnowledgeTransferConfirm();
   
         for($k=0; $k<count($kt); $k++){
                  $th=['user_id' => $kt[$k]->user_id,
		    		'project_id' => $kt[$k]->project_id,
		    		'project_name' => $kt[$k]->project_name,
		    		 'kt_given_to' => $kt[$k]->kt_given_to,
		    		  'kt_given_to_name' => $kt[$k]->kt_given_to_name,
		    		 'is_actived' =>  $kt[$k]->is_actived,
		    		 ];
		        
		         $tn = \App\KnowledgeTransferConfirm::insert($th);
        }
         $retract = DB::table('knowledge_transfers')->where('user_id',$retracts->user_id)->update(['is_actived'=> 2]);
         $assign_user = \App\User::where('id',$th['kt_given_to'])->get();
         $assign_user1 = \App\User::where('id',$th['user_id'])->get();
       $templateData['user1'] = \App\User::where('id',$retracts->user_id)->with('personal_profile','cb_profile')->first();
             
				/*-----------------------------------Send notification-------------------------------------------*/
				$receiver = array($retracts->user_id);
				$title = "Admin Accepted Your Knowledge Transfer.";
				$message = "Admin Accepted Your Knowledge Transfer";
				$admins = \App\User::where('role','1')->get();
				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				/*----------------notification send to assign user---------------------------------*/
				
				$receiver = array($assign_user[0]->id);

				$title = "A New knowledge Transfer Assign To You";

				$message = "<p>"."A  project ".$th['project_name']." assigned you by ".$assign_user1[0]->first_name.   "</p>";

				NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);

				
 
       return redirect()->back()->with('success','Knowledge transfer status confirm successfully');

     }


     }
    public function kt_list(){
		
        $data['kt_lists'] = \App\KnowledgeTransferConfirm::get();
             //dd($data['kt_lists']);
        return view('/admin/kt_lists/kt_list',$data);
    }
    public function ktassign_rejected($id){		
	
     	$retracts = \App\Resignation::find($id);
     	$kt = \App\KnowledgeTransfer::where('user_id',$retracts->user_id)->get();     	
		$user = \App\User::where('id','=',$retracts->user_id)->first();

		if(is_null($retracts)){
			return redirect()->back()->with('error','Error');
		}else{
			// $retract = DB::table('retracts')->where('id',$id)->update(['is_active'=> -1]);
			$kt_confirm = new \App\KnowledgeTransferConfirm();
   
        
			$retract = DB::table('knowledge_transfers')->where('user_id',$retracts->user_id)->update(['is_actived'=> -1]);
			$templateData['user1'] = \App\User::where('id',$retracts->user_id)->with('personal_profile','cb_profile')->first();
      
			/*-----------------------------------Send notification-------------------------------------------*/
			$receiver = array($retracts->user_id);
			$title = "Admin Rejected Your Knowledge Transfer.";
			$message = "Admin Rejected Your Knowledge Transfer";
			$admins = \App\User::where('role','1')->get();
			NotificationController::notify(\Auth::user()->id,$receiver,$title,$message);
			return redirect()->back()->with('success','Knowledge transfer status Rejected successfully');
		}
	 
	}
	// View All Notification 
	public function view_notification(){
		$id= \Auth::user()->id;
		$all_notification = \App\Notification::where('receiver_id','=',$id)->orderBy('id', 'desc')->paginate(15);
		return view('admin.notification',['all_notifications'=>$all_notification]);
		
	}
}