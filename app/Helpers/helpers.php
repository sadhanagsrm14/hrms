<?php 



function getAttendanceBydate($mydate,$employee_id){

    $attendance = \App\AttendanceData::where('attendance_date',$mydate)->where('employee_id',$employee_id)->first(); 

    if(count($attendance) == 1){

        return $attendance->status;   

    }else{

        return false;   

    }   

    

    

}



function isAttendanceDone($mydate,$employee_id){

    $attendance = \App\AttendanceData::where('attendance_date',$mydate)->where('employee_id',$employee_id)->first(); 

    if(count($attendance) == 1){

        return true;   

    }else{

        return false;   

    }   

    

    

}





function getRoleById($role_id){

    $role = \App\Role::find($role_id);

    $role_name = $role->role;

    return $role_name;

}

function getEmpStatusById($id){

    $employee_status = \DB::table('employee_status')->where('id',$id)->first();

    $employee_status_name = $employee_status->status_name;

    return $employee_status_name;
	
}
function getEmpId($id){
$employee_cb_id = \DB::table('employee_cb_profiles')->where('user_id',$id)->first();
          $employee_id       = $employee_cb_id->employee_id;
          return $employee_id;
}

function getUserById($user_id){

    $user = \App\User::find($user_id);

    return $user;

}

function getSystemById($system_id){

    $system = \App\System::find($system_id);

    return $system;

}

function getAssetById($asset_id,$asset_type_id){
     if($asset_type_id == '1'){
    $asset = \App\Monitor::find($asset_id);

    return $asset;
}
    if($asset_type_id == '2'){
    $asset = \App\Keyboard::find($asset_id);

    return $asset;
}
    if($asset_type_id == '3'){
    $asset = \App\Mouse::find($asset_id);

    return $asset;
}
    if($asset_type_id == '4'){
    $asset = \App\Cabinet::find($asset_id);

    return $asset;
}
    if($asset_type_id == '5'){
    $asset = \App\Motherboard::find($asset_id);

    return $asset;
}
    if($asset_type_id == '6'){
    $asset = \App\Ram::find($asset_id);

    return $asset;
}
    if($asset_type_id == '7'){
    $asset = \App\Processer::find($asset_id);

    return $asset;
}
    if($asset_type_id == '8'){
    $asset = \App\UpsBattery::find($asset_id);

    return $asset;
}
    if($asset_type_id == '9'){
    $asset = \App\Smps::find($asset_id);

    return $asset;
}
    if($asset_type_id == '10'){
    $asset = \App\Hdd::find($asset_id);

    return $asset;
}

    if($asset_type_id == '11'){
    $asset = \App\Desktop::find($asset_id);

    return $asset;
}
 if($asset_type_id == '12'){
    $asset = \App\Laptop::find($asset_id);

    return $asset;
}
 if($asset_type_id == '13'){
    $asset = \App\MacMini::find($asset_id);

    return $asset;
}
 if($asset_type_id == '14'){
    $asset = \App\IMac::find($asset_id);

    return $asset;
}
 if($asset_type_id == '15'){
    $asset = \App\NetworkSwitch::find($asset_id);

    return $asset;
}
 if($asset_type_id == '16'){
    $asset = \App\Router::find($asset_id);

    return $asset;
}
 if($asset_type_id == '17'){
    $asset = \App\Repeater::find($asset_id);

    return $asset;
}
 if($asset_type_id == '18'){
    $asset = \App\Ups::find($asset_id);

    return $asset;
}
 if($asset_type_id == '19'){
    $asset = \App\PenDrive::find($asset_id);

    return $asset;
}
 if($asset_type_id == '20'){
    $asset = \App\Dvr::find($asset_id);

    return $asset;
}
 if($asset_type_id == '21'){
    $asset = \App\Camera::find($asset_id);

    return $asset;
}
 if($asset_type_id == '22'){
    $asset = \App\WebCam::find($asset_id);

    return $asset;
}
 if($asset_type_id == '23'){
    $asset = \App\Printer::find($asset_id);

    return $asset;
}
 if($asset_type_id == '24'){
    $asset = \App\Chair::find($asset_id);

    return $asset;
}
 if($asset_type_id == '25'){
    $asset = \App\Desk::find($asset_id);

    return $asset;
}
 if($asset_type_id == '26'){
    $asset = \App\Fan::find($asset_id);

    return $asset;
}
 if($asset_type_id == '27'){
    $asset = \App\AC::find($asset_id);

    return $asset;
}
 if($asset_type_id == '28'){
    $asset = \App\Almirah::find($asset_id);

    return $asset;
}
 if($asset_type_id == '29'){
    $asset = \App\Headphone::find($asset_id);

    return $asset;
}
 

}
function getAssetMonitorById($asset_id){

    $asset = \App\Monitor::find($asset_id);

    return $asset;

}

function getProjectById($user_id){

    $project = \App\Project::find($user_id);

    return $project;

}

function getProject($id){

    $project = \App\Project::find($id);

    // if(is_null($project)){

    //     $project = new \stdClass();

    //     $project->name = "N/A";

    // }

    return $project;

}

function getUnreadNotificationsById($receiver_id){

    $notifications = \App\Notification::where('receiver_id',$receiver_id)->where('is_read',0)->orderBy('id','DESC')->get();

    return count($notifications);

}

function getNotificationsById($receiver_id){

    $notifications = \App\Notification::where('receiver_id',$receiver_id)->where('is_read',0)->orderBy('id','DESC')->get();

    return $notifications;

}

function calculateTimeSpan($date){

    $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);



    $months = floor($seconds / (3600*24*30));

    $day = floor($seconds / (3600*24));

    $hours = floor($seconds / 3600);

    $mins = floor(($seconds - ($hours*3600)) / 60);

    $secs = floor($seconds % 60);



    if($seconds < 60){

        $time = $secs." sec ago";

    }

    else if($seconds < 60*60 ){

        $time = $mins." min ago";

    }

    else if($seconds < 24*60*60){

        $time = $hours." hrs ago";

    }

    else if($seconds < 24*60*60*30){

        $time = $day." day ago";

    }

    else{

        $time = $months." month ago";

    }

    return $time;

}

function isHoliday($date,$category){

    $holiday = \App\Holiday::where('date',$date)->where('category',$category)->first();

    if(is_null($holiday)){

        return false;

    }else{

        return true;

    }

}

function holidayComment($date,$category){

    $holiday = \App\Holiday::where('date',$date)->where('category',$category)->first();

    if(is_null($holiday)){

        return false;

    }else{

        return $holiday;

    }

}

function getLeaves($user_id,$is_approved){
     //DD(\Auth::user()->id);
    $leaves = \App\Leaves::where('user_id',$user_id)->where('is_approved',$is_approved)->get();

    return $leaves;

} 

function setActive($path)

{

    return Request::is($path) ? 'open' : '1';

}
function calculateteammem($team_leader_id)
{
     $counemp = DB::table('team_members')->select('team_member_id') ->where('team_leader_id','=', $team_leader_id)->count();
     return $counemp;
}
function getAssetDescriptionsById($asset_id){

    $assetname = array();
  foreach($asset_id as $asset_ids){

    $asset = \App\Asset::where('id',$asset_ids)->value('descriptions');
  
       array_push($assetname, $asset);
    }
   
    $aa = implode(',', $assetname);
    return   $aa ;
}
function getSystemAssetById($system_id){
    $system = DB::table('system_assets')->where('system_id','=', $system_id)->get()->pluck('asset_id');
   
   $system = $system->toArray();
   
    return $system;
}
function getAssoc_name($id){
     $assoc_name = DB::table('asset_types')->where('id','=',$id)->first();
       return $assoc_name->type;
}
?>