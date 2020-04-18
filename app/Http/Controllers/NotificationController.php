<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



class NotificationController extends Controller

{

	public static function notify($sender_id,$receiver_id,$title,$message){

		foreach ($receiver_id as $receiver) {

			$notification = new \App\Notification(); 

			$notification->sender_id = $sender_id;

			$notification->receiver_id = $receiver;

			$notification->title = $title;

			$notification->message = $message;

			$notification->save();

		}

		return true;

	}

	public function notification($notification_id){

		$response = array();

		$notification = \App\Notification::find($notification_id);

		if(is_null($notification)){

			$response['flag'] = false;

		}else{

			$notification->is_read = 1;

			$notification->save();

			$response['flag'] = true;

			$response['notification'] = $notification;

		}

		return response()->json($response);

	}
	public function markasread($receiver_id)
	 {
       $markallread = \App\Notification::where('receiver_id',$receiver_id)->update(['is_read'=> 1]);
      
      return $markallread;
	 }



}

