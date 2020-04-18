<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

class ResignController extends Controller

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



	public function resignations()

	{

		$data = array();

		$data['resignations'] = \App\Resignation::where('user_id',\Auth::user()->id)->orderBy('id','DESC')->get();

		return view($this->getRole().'.resignation.index',$data);

	}



	public function getApplyResign()

	{

		$data = array();

		$resign = \Auth::user()->resignation;
		$data['current_projects'] = \App\EmployeeProject::where('user_id',\Auth::user()->id)->where('project_status',0)->orderBy('id','DESC')->get();
		
        $data['employees'] = \App\User::where('role', 6)->where('id','!=',\Auth::user()->id)->where('department','development')->orwhere('role', 4)->get();
         $data['kt_status'] = \App\KnowledgeTransfer::where('user_id',\Auth::user()->id)->first();
        
		if(!is_null($resign)){

			$data['resign'] = $resign;

			return view($this->getRole().'.resignation.resign',$data);

		}else{

			$data['notice_period'] = \Auth::user()->cb_profile->notice_period;

			$data['date_of_resign'] = date('Y-m-d');
            if(!is_null($data['notice_period'])){
			$data['last_working_day'] =  date('Y-m-d', strtotime($data['date_of_resign']. ' + '.$data['notice_period'].' days'));
		   
            }
             else
             {
             	$data['last_working_day'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
             }
			$data['fnf_date'] =  date('Y-m-d', strtotime($data['last_working_day']. ' + 45 days'));
           

			$data['current_projects'] = \App\EmployeeProject::where('user_id',\Auth::user()->id)->where('project_status',0)->orderBy('id','DESC')->get();

			$data['reporting_managers'] = \App\EmployeeProject::where('user_id',\Auth::user()->id)->where('project_status',0)->orderBy('id','DESC')->get();

			return view($this->getRole().'.resignation.apply-resign',$data);

		}

	}





	public function postApplyResign(Request $request)

	{

		$validator = \Validator::make($request->all(),

			array(

				'reason' =>'required',

				'message' =>'required',

			)

		);

		if($validator->fails())

		{

			return redirect('/resign')

			->withErrors($validator)

			->withInput();

		}

		else

		{

			$resignation = new \App\Resignation();

			$resignation->user_id = \Auth::user()->id;

			$resignation->date_of_resign = $request->date_of_resign;

			$resignation->last_working_day = $request->last_working_day;

			$resignation->fnf_date = $request->fnf_date;

			if($request->reporting_manager){

				$resignation->manager_id = $request->reporting_manager;

			}

			if($request->current_project){

				$resignation->current_project_id = $request->current_project;

			}

			$resignation->reason = $request->reason;

			$resignation->message = $request->message;

			// $resignation->is_active = 1;
			$url = url('role/resignations/' );

			if($resignation->save()){



				/*-----------------------------------Send notification-------------------------------------------*/

				$user = \App\User::where('id',\Auth::user()->id)->first();

				$receiver = array();

				$receiver_email = array();

				$title = $user->first_name." ".$user->last_name." "."Applied Resignation";

				$message = "<p>".$user->first_name." ".$user->last_name." "."Applied Resignation."."</p>";
				$message.= "<a href='".$url."' class='btn btn-primary resign'>View</a>";

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

				

				$templateData['resign'] = $resignation;

				$MailData = new \stdClass();

				$MailData->subject ='Resignation Letter - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;

				$MailData->sender_email = \Auth::user()->email;

				$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;

				$MailData->receiver_email = $receiver_email;

				$MailData->receiver_name = \Auth::user()->email;

				MailController::sendMail('resignation_letter',$templateData,$MailData);



				return redirect('/resign/')->with('success',"Resignation Submitted Waiting For Admin Approval ");

				

			}

		}

	}



	public function previewResign($id)

	{

		$response = array();

		$resign = \App\Resignation::find($id);
		$project = \App\Project::where('id',$resign->current_project_id)->select('name')->first();

		if(is_null($resign)){

			$response['flag'] = false;

			$response['message'] = "Resignation not Found";

		}else{

			$response['flag'] = true;

			$response['resign'] = $resign;
			$response['project'] = $project;

		}
       
		return response()->json($response);

	}

	

	public function retractResign($id)

	{

		$resign = \App\Resignation::where('user_id',$id)->first();
		
		if(is_null($resign)){

			return redirect()->back()->with('error',"Resignation not Found");

		}else{
			
			$kt = \App\KnowledgeTransfer::where('user_id',$resign->user_id)->get();
             
			if(!is_null($kt)){
		      foreach($kt as $k){
              $k->delete();
		       }
             }
             $kt1 = \App\KnowledgeTransferConfirm::where('user_id',$resign->user_id)->get();
             
			if(!is_null($kt1)){
		      foreach($kt1 as $k1){
              $k1->delete();
		       }
             }
			$retract = \App\Retract::where('user_id',$resign->user_id)->first();
			if(!is_null($retract)){
				 $retract->delete();
			}
			if($resign->delete()){

				/*-----------------------------------Send notification-------------------------------------------*/

				$user = \App\User::where('id',\Auth::user()->id)->first();

				$receiver = array();

				$receiver_email = array();

				$title = $user->first_name." ".$user->last_name." "."Retracted Applied Resignation";

				$message = "<p>".$user->first_name." ".$user->last_name." "."Retracted Applied Resignation."."</p>";

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

				/*-----------------------------------Send notification-------------------------------------------*/



				$templateData['user'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile')->first();

				

				$templateData['resign'] = $resign;

				$MailData = new \stdClass();

				$MailData->subject ='Resignation Retracted - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;

				$MailData->sender_email = \Auth::user()->email;

				$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;

				$MailData->receiver_email = $receiver_email;

				$MailData->receiver_name = \Auth::user()->email;

				// MailController::sendMail('resignation_retracted',$templateData,$MailData);



				return redirect('/resign')->with('success',"Resignation Retracted and Application Deleted Successfully");

			}else{

				

			}

		}

	}



	public function submitResign($id)

	{

		$resign = \App\Resignation::find($id);

		if(is_null($resign)){

			return redirect()->back()->with('error',"Resignation not Found");

		}else{

			$resign->is_active = 1;

			if($resign->save()){

				

				$templateData['user'] = \App\User::where('id',\Auth::user()->id)->with('personal_profile','cb_profile')->first();

				

				$templateData['resign'] = $resign;

				$MailData = new \stdClass();

				$MailData->subject ='Resignation Letter - '.\Auth::user()->first_name.' '.\Auth::user()->last_name;

				$MailData->sender_email = \Auth::user()->email;

				$MailData->sender_name = \Auth::user()->first_name.' '.\Auth::user()->last_name;

				$MailData->receiver_email = $receiver_email;

				$MailData->receiver_name = \Auth::user()->email;

				MailController::sendMail('resignation_letter',$templateData,$MailData);

				return redirect('/resignations')->with('success',"Resignation Submitted Successfully");

			}else{

				

			}

		}

	}
	public function restract()
	{
		return view($this->getRole().'.restracts.apply-restract');
	}
	public function previewRetract($id)
     {
     	$response = array();

		$retracts = \App\Retract::find($id);
		
		if(is_null($retracts)){

			$response['flag'] = false;

			$response['message'] = "Resignation not Found";

		}else{

			$response['flag'] = true;

			$response['retracts'] = $retracts;

		}
       
		return response()->json($response);
     }
       public function assignkt(Request $request)
	{    
        if($request->konwledge_transfer_to[0] == null || $request->konwledge_transfer_to[0] == "" || $request->konwledge_transfer_to[0] == "0"){
        	
        	return redirect()->back()->with('error','Please select employee..');
        }

        else{

		 $kt = \App\KnowledgeTransfer::where('user_id',\Auth::user()->id)->get();
            if(count($kt)<= 0)
            {
          
		$knowledgetransfer = new \App\KnowledgeTransfer();
         
		    for($k=0; $k<count($request->ktproject); $k++)
		    {  		 
		    		$th=['user_id' => \Auth::user()->id,
		    		'project_id' => $request->ktproject[$k],
		    		'project_name' => \App\Project::where('id',$request->ktproject[$k])->value('name'),
		    		 'kt_given_to' => $request->konwledge_transfer_to[$k],
		    		 'kt_given_to_name' => \App\User::where('id',$request->konwledge_transfer_to[$k])->value('first_name','Last_name'),
		    		 'is_actived' => 1];


		    	if(['kt_given_to'] != null){	 
		         $tn = \App\KnowledgeTransfer::insert($th);
		        }
		    	else
		    	{
		    		return back()->with('error','Please assign the knowledge transfer to employee..');
		    	}  	
		     
		    }
                  if(isset($tn))
		         {
                     $user = \App\User::where('id',\Auth::user()->id)->first();

				$receiver = array();

				$receiver_email = array();

				$title = $user->first_name." ".$user->last_name." "."Assign Knowledge Transfer";

				$message = "<p>".$user->first_name." ".$user->last_name." "."Assign Knowledge Transfer."."</p>";
				

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
                   

		    	  	 	return redirect()->back()->with('success','Knowledge Transfer Request send to admin. Waiting for confirmation ..');
		    	  	 }
		    	  	 else
		    	  	 {
                       return redirect()->back()->with('error','something wrong in assign Knowledge transfer..');
		    	  	 }
		 
		   }
		   else
		   { 
		   	$knowledgetransfer = \App\KnowledgeTransfer::where('user_id',\Auth::user()->id)->get();
         
		    for($k=0; $k<count($request->ktproject); $k++)
		    {  		 
		    		$th=[
		    		'project_id' => $request->ktproject[$k],
		    		'project_name' => \App\Project::where('id',$request->ktproject[$k])->value('name'),
		    		 'kt_given_to' => $request->konwledge_transfer_to[$k],
		    		 'kt_given_to_name' => \App\User::where('id',$request->konwledge_transfer_to[$k])->value('first_name','Last_name'),
		    		 'is_actived' => 1];


		    	if(['kt_given_to'] != null)
		    	{	 

		         $tn = \App\KnowledgeTransfer::where('id',$knowledgetransfer[$k]->id)->update($th);


		        }
		    	else
		    	{
		    		return back()->with('error','Please assign the knowledge transfer to employee..');
		    	}  	
		     
		    } 
		     $user = \App\User::where('id',\Auth::user()->id)->first();

				$receiver = array();

				$receiver_email = array();

				$title = $user->first_name." ".$user->last_name." "."submitted Knowledge transfer";

				$message = "<p>".$user->first_name." ".$user->last_name." "."submitted Knowledge transfer."."</p>";
				

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
		   	return back()->with('success','Knowledge transfer assigned successfully..');

		   }
	      
        }
	}
	public function previewkt($id)
	  {
      $response = array();

		$resign = \App\Resignation::find($id);
		$kt_given = \App\KnowledgeTransfer::where('user_id',$resign->user_id)->select('project_name','kt_given_to_name')->get();
		
         
		//$ktuser = \App\User::where('id',$resign->knowledge_transfer_to)->select('first_name','Last_name')->first();

		if(is_null($resign)){

			$response['flag'] = false;

			$response['message'] = "Resignation not Found";

		}else{

			$response['flag'] = true;
			$response['$kt_given'] = $kt_given;

		}
       
		return response()->json($response);

	  }

}

