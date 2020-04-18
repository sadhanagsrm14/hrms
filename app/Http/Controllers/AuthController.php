<?php







namespace App\Http\Controllers;



use Faker;



use App\User;



use Illuminate\Http\Request;

use mail;

use DB;







class AuthController extends Controller



{



	public function index()



	{

       

		return view('login');



	}







	public function login(Request $request){

		$validator = \Validator::make(
			[
				'email' =>$request->email,
				'password' =>$request->password,
			],
			[
				'email' =>'required|email',
				'password' =>'required',
			]
		);

		if($validator->fails()){
			return redirect('/login')->withErrors($validator)->withInput();
		}else{

			$is_diactive_user = DB::table('users')->where('email',$request->email)->where('is_active',0)->count();
			$is_left_company = DB::table('users')->where('email',$request->email)->where('is_active',2)->count();

			if($is_left_company == 1){				
				return redirect('/login')->with('error',"Your Account is Expired. Please Contact Admin");
			}else if( $is_diactive_user == 1){
				return redirect('/login')->with('error',"Your Account is Deactivated. Please Contact Admin");
			}else{
				$creds = ['email'=>$request->email,'password'=>$request->password,'is_active'=>1];
				if(\Auth::attempt($creds)){
						return redirect('/login');
					//print_r($creds);die;
				}else{
					return redirect('/login')->with('error',"Invalid Email or Password");
				}
			}
		}



	}



	public function getForgetPassword()



	{



		return view('forget-password');



	}



	public function postForgetPassword(Request $request)



	{



		$validator = \Validator::make(



			array(



				'email' =>$request->email,



			),



			array(



				'email' =>'required|email',



			)



		);



		if($validator->fails())



		{



			return redirect('/forget-password')



			->withErrors($validator)



			->withInput();



		}



		else



		{



			$internals = Faker\Factory::create('en_US');



			$auth_pass = $internals->uuid;



			$user = User::where('role',1)->first();



			if(!is_null($user)){



				if (\DB::table('password_resets')->where('email', $request->email)->insert(array('email'=>$request->email,'token' => $auth_pass))) {



					$templateData['confirmation_code'] = $auth_pass;



					$MailData = new \stdClass();



					$MailData->receiver_email = $request->email;



					$MailData->receiver_name = $request->email;



					$MailData->sender_email = $user->email;



					$MailData->sender_name = $user->first_name.' '.$user->last_name;



					$MailData->subject = 'Password Reset';



             

				MailController::sendMail('forget_password',$templateData,$MailData);



					return redirect('/forget-password')->with('success','We have sent an email to your Email');



				}



			}else{



				return redirect('/forget-password')->with('error','This email is not registered With Us');



			}



		}



	}



	public function verify_reset_token($token)



	{



		$response = array();



		$result = \DB::table('password_resets')->where('token', '=', $token)->first();



		if (count($result)>0) {



			\Session::put('email',$result->email);



			return view('reset_password');



		}else{



			return redirect('/forget-password')->with('error','invalid Or expired token');



		}



	}



	public function post_reset_password(Request $request)



	{



		$validator = \Validator::make(



			array(



				'new_password' =>$request->new_password,



				'confirm_password' =>$request->confirm_password,



			),



			array(



				'new_password' =>'required',



				'confirm_password' =>'required|same:new_password',



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



			$email = \Session::pull('email');



			$user = \App\User::where('email',$email)->first();



			if(!is_null($user)){



				$user->password = \Hash::make($request->new_password);



				if($user->save()){



					/*-----------------------------------Send notification---------------------*/



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



					NotificationController::notify($user->id,$receiver,$title,$message);



					/*-----------------------------------Send notification----------------------*/



					



					\Session::forget('email');



					\DB::table('password_resets')->where('email', '=', $email)->delete();



					return redirect('/login')->with('success','New Password has been set.');



				}else{



					\Session::forget('email');



					return redirect()->back()->with('error','Session Expired');



				}



			}else{



				\Session::forget('email');



				return redirect()->back()->with('error','Session Expired');



			}







		}



	}







	public function logout(){



		\Auth::logout();

		\Cache::flush();

         \Session::flush();

		return redirect('/login');



	}

	public function updatevalue()

	   {

	 

             	\DB::table('employee_cb_profiles')->increment('avail_leaves',1);

        }

}



