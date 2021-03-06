<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRMS | <?php echo $__env->yieldContent('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
  <?php echo e(Html::style("assets/plugins/pace-master/themes/blue/pace-theme-flash.css")); ?>

  <?php echo e(Html::style("assets/plugins/uniform/css/uniform.default.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/bootstrap/css/bootstrap.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/fontawesome/css/font-awesome.css")); ?>

  <?php echo e(Html::style("assets/plugins/line-icons/simple-line-icons.css")); ?>

  <?php echo e(Html::style("assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css")); ?>

  <?php echo e(Html::style("assets/plugins/waves/waves.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/switchery/switchery.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/3d-bold-navigation/css/style.css")); ?>

  <?php echo e(Html::style("assets/plugins/slidepushmenus/css/component.css")); ?>

  <?php echo e(Html::style("assets/plugins/summernote-master/summernote.css")); ?>

  <?php echo e(Html::style("assets/plugins/bootstrap-datepicker/css/datepicker3.css")); ?>

  <?php echo e(Html::style("assets/plugins/bootstrap-colorpicker/css/colorpicker.css")); ?>

  <?php echo e(Html::style("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")); ?>

  <?php echo e(Html::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css")); ?>

  <?php echo e(Html::style("assets/css/modern.min.css")); ?>

  <?php echo e(Html::style("assets/css/themes/green.css")); ?>

  <?php echo e(Html::style("assets/css/custom.css")); ?>

  <?php echo e(Html::style("assets/css/hrms.css")); ?>

  <?php echo e(Html::style("assets/css/sweetalert2.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/select2/css/select2.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables.min.css")); ?>

  <?php echo e(Html::style("assets/plugins/datatables/css/jquery.datatables_themeroller.css")); ?>

  <?php echo e(Html::script("assets/plugins/3d-bold-navigation/js/modernizr.js")); ?>

  <?php echo e(Html::script("assets/plugins/offcanvasmenueffects/js/snap.svg-min.js")); ?>


  <body class="page-header-fixed">
    <div class="overlay"></div>

    <div class="menu-wrap">
      <nav class="profile-menu">
        <div class="profile"><img src="assets/images/profile-menu-image.png" width="60" alt="David Green"/><span>David Green</span></div>
        <div class="profile-menu-list">
          <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a>
          <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a>
          <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a>
          <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a>
        </div>
      </nav>
      <button class="close-button" id="close-button">Close Menu</button>
    </div>
    <form class="search-form" action="#" method="GET">
      <div class="input-group">
        <input type="text" name="search" class="form-control search-input" placeholder="Search...">
        <span class="input-group-btn">
          <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
        </span>
      </div><!-- Input Group -->
    </form><!-- Search Form -->
    <main class="page-content content-wrap">
      <div class="navbar">
        <div class="navbar-inner">
          <div class="sidebar-pusher">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
              <i class="fa fa-bars"></i>
            </a>
          </div>
          <div class="logo-box">
            <a href="<?php echo e(URL('/itExecutive/dashboard')); ?>" class="logo-text"><span>CB-HRMS</span></a>
          </div><!-- Logo Box -->
          <div class="search-button">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
          </div>
          <div class="topmenu-outer">
            <div class="top-menu">
              <ul class="nav navbar-nav navbar-left">
                <li>    
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                </li>
                <li>    
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                </li>

              </ul>
              <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                <?php  $notifications = getNotificationsById(\Auth::user()->id); ?>
                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right total_unread"><?php echo e(getUnreadNotificationsById(\Auth::user()->id)); ?></span></a>
                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                  <li><p class="drop-title">You have <span id="unreadMsg"><?php echo e(getUnreadNotificationsById(\Auth::user()->id)); ?></span> notification !</p></li>
                  <li class="dropdown-menu-list slimscroll tasks">
                    <ul class="list-unstyled">
                      <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li id="notification_<?php echo e($notification->id); ?>">
                        <a href="#" onclick="viewNotification(<?php echo e($notification->id); ?>)">
                          <div class="task-icon badge badge-success"><i class="icon-bell"></i></div>
                          <span class="badge badge-roundless badge-default pull-right"><?php echo e(calculateTimeSpan($notification->created_at)); ?></span>
                          <p class="task-details"><?php echo e($notification->title); ?></p>
                        </a>
                      </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </li>
                  <!-- <li class="drop-all"><a href="#" class="text-center">All Tasks</a></li> -->
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                  <span class="user-name"><?php echo e(\Auth::user()->first_name); ?><i class="fa fa-angle-down"></i></span>
                  <img class="img-circle avatar" src="<?php echo e(\Auth::user()->cb_profile->employee_pic); ?>" width="40" height="40" alt="">
                </a>
                <ul class="dropdown-menu dropdown-list" role="menu">
                  <li role="presentation"><a href="<?php echo e(URL('/profile')); ?>"><i class="fa fa-user"></i>Profile</a></li>
                  <li role="presentation"><a href="<?php echo e(URL('/itExecutive/holiday-calender')); ?>"><i class="fa fa-calendar"></i>Holiday Calendar</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil m-r-xs"></i>Change Password</a></li>
                  
                </ul>
              </li>
              <li>
                <a href="<?php echo e(URL('/logout')); ?>" class="log-out waves-effect waves-button waves-classic">
                  <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                </a>
              </li>

            </ul><!-- Nav -->
          </div><!-- Top Menu -->
        </div>
      </div>
    </div><!-- Navbar -->
    
    <!-- Notification Modal -->
    <div class="modal fade empList-modal-lg" id="viewNotificationModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-body">
          <div class="panel panel-success">
            <div class="panel-heading clearfix">
              <h4 class="panel-title" id="notificationTitle">Notification Title</h4> 
            </div>
            <div class="panel-body" id="notificationMessage">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Notification Modal -->
    
    <!-- change password Modal -->
    <div class="modal fade empList-modal-lg changePassModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-body">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <h4 class="panel-title" id="msg">Change Password</h4> 

            </div>
            <div class="panel-body">
              <form class="form-horizontal" >
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <label for="old_password" class="col-sm-4 control-label">Old Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="new_password" class="col-sm-4 control-label">New Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">  
                  </div>
                </div>
                <div class="form-group">
                  <label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">  
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a  id="changePassword"  class="btn btn-success">Change</a>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- change password Modal -->

    <?php echo $__env->make('itExecutive.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>

  </main><!-- Page Content -->
  <?php echo $__env->make('itExecutive.layouts.footer_navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <div class="cd-overlay"></div>


  <?php echo e(Html::script("assets/plugins/jquery/jquery-2.1.4.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/jquery-ui/jquery-ui.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/pace-master/pace.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/jquery-blockui/jquery.blockui.js")); ?>

  <?php echo e(Html::script("assets/plugins/bootstrap/js/bootstrap.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/switchery/switchery.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/uniform/jquery.uniform.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/offcanvasmenueffects/js/classie.js")); ?>

  <?php echo e(Html::script("assets/plugins/offcanvasmenueffects/js/main.js")); ?>

  <?php echo e(Html::script("assets/plugins/waves/waves.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/3d-bold-navigation/js/main.js")); ?>

  <?php echo e(Html::script("assets/js/modern.min.js")); ?>

  <?php echo e(Html::script("assets/js/sweetalert2.min.js")); ?>

  <?php echo e(Html::script("assets/plugins/datatables/js/jquery.datatables.min.js")); ?>

  <script>
   $( function() {
    $( ".datepicker" ).datepicker();
    $( "#datatable" ).DataTable();
  } );
</script>
<script>

  function viewNotification(notification_id){
    var url  = "<?php echo e(URL('/readNotification/')); ?>";
    $.ajax({
      url: url+'/'+notification_id,
      type: 'GET',
      success: function (data) {
        console.log(data);
        if(data.flag){
          var total_unread = $('.total_unread').text();
          $('#notificationTitle').text(data.notification.title);
          $('#notificationMessage').text(data.notification.message);
          $('.total_unread').text((total_unread-1));
          $('#unreadMsg').text((total_unread-1));
          $('#notification_'+notification_id).remove();
          $('#viewNotificationModal').modal('toggle');
        }else{
          $('#notificationTitle').text("Notification Not Found.");
          $('#notificationMessage').text("Something Went Wrong. Please Refresh the Page Again.");
          $('#viewNotificationModal').modal('toggle');
        }
      }
    });
  }

  $('#changePassword').on('click',function(){
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
    if(old_password == ""){
     swal('Oops',"Old Password Required",'warning');  
   }else if(new_password == ""){
     swal('Oops',"New Password Required",'warning');  
   }else if(confirm_password == ""){
    swal('Oops',"Confirm Password Required",'warning');  
  }else if(confirm_password !== new_password){
    swal('Oops',"Confirm Password & New Password Not Matched ",'warning');  
  }else{
    $.ajaxSetup({
      headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });
    var url  = "<?php echo e(URL('/postChangePassword')); ?>";
    $.ajax({
      url: url,
      type: 'POST',
      data: {'old_password':old_password,'new_password':new_password},
      success: function (data) {
        console.log(data);
        if(data.flag){
          $('.changePassModal').modal('toggle');
          swal('Success','Password Changed Successfully','success'); 
        }else{
          $('.changePassModal').modal('toggle');
          swal('Oops',data.error,'warning');  
        }
      }
    });
  }

});
</script>
<?php  $mydate = date('Y-m-d');  $employee_id = Auth::user()->cb_profile->employee_id;  ?>
<?php if(!isAttendanceDone($mydate,$employee_id) && date('H') >= 16 && date('H') <= 24): ?>  

<script type="text/javascript">

  swal({
    title: 'Attendence',
    text: "You Haven't Marked Your Attendence Today.",
    type: 'warning',
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonColor: '#15ab35',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Do it Now!'
  }).then(function () {
    var url = "/itExecutive/addAttendance";
    var mydate = "<?php echo e($mydate); ?>";
    var employee_id = "<?php echo e($employee_id); ?>";
    $.ajaxSetup({
      headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });
    $.ajax({
      url: url,
      type: 'POST',
      data: {'mydate':mydate,'employee_id':employee_id},
      dataType:"json",
      success: function (data) {
        console.log(data);
        if(data.success == true){

          swal('Success','Your Attendence has been Marked!','success'); 
        }else{
          $('.empList-modal-lg').modal('toggle');
          swal('Oops',data.error,'warning');  
        }
      }
    });


  }, function (dismiss) {
    if (dismiss === 'cancel') {
      swal('Cancelled','Your Attribute is safe :)','error')
    }
  })

</script>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
