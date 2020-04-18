<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRMS | <?php echo $__env->yieldContent('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
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

  <?php echo e(Html::style("assets/plugins/select2/css/select2.min.css")); ?>

  <?php echo e(Html::script("assets/plugins/3d-bold-navigation/js/modernizr.js")); ?>

  <?php echo e(Html::script("assets/plugins/offcanvasmenueffects/js/snap.svg-min.js")); ?>


  <body class="page-header-fixed">
    <div class="overlay"></div>
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
      <h3><span class="pull-left">Chat</span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
      <div class="slimscroll">
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="assets/images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
      </div>
    </nav>
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
      <h3><span class="pull-left">Sandra Smith</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
      <div class="slimscroll chat">
        <div class="chat-item chat-item-left">
          <div class="chat-image">
            <img src="assets/images/avatar2.png" alt="">
          </div>
          <div class="chat-message">
            Hi There!
          </div>
        </div>
        <div class="chat-item chat-item-right">
          <div class="chat-message">
            Hi! How are you?
          </div>
        </div>
        <div class="chat-item chat-item-left">
          <div class="chat-image">
            <img src="assets/images/avatar2.png" alt="">
          </div>
          <div class="chat-message">
            Fine! do you like my project?
          </div>
        </div>
        <div class="chat-item chat-item-right">
          <div class="chat-message">
            Yes, It's clean and creative, good job!
          </div>
        </div>
        <div class="chat-item chat-item-left">
          <div class="chat-image">
            <img src="assets/images/avatar2.png" alt="">
          </div>
          <div class="chat-message">
            Thanks, I tried!
          </div>
        </div>
        <div class="chat-item chat-item-right">
          <div class="chat-message">
            Good luck with your sales!
          </div>
        </div>
      </div>
      <div class="chat-write">
        <form class="form-horizontal" action="javascript:void(0);">
          <input type="text" class="form-control" placeholder="Say something">
        </form>
      </div>
    </nav>
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
            <a href="index-2.html" class="logo-text"><span>Modern</span></a>
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
                  <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a>
                </li>
                <li>    
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                    <i class="fa fa-cogs"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                    <li class="li-group">
                      <ul class="list-unstyled">
                        <li class="no-link" role="presentation">
                          Fixed Header 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right fixed-header-check" checked>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="li-group">
                      <ul class="list-unstyled">
                        <li class="no-link" role="presentation">
                          Fixed Sidebar 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right fixed-sidebar-check">
                          </div>
                        </li>
                        <li class="no-link" role="presentation">
                          Horizontal bar 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right horizontal-bar-check">
                          </div>
                        </li>
                        <li class="no-link" role="presentation">
                          Toggle Sidebar 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right toggle-sidebar-check">
                          </div>
                        </li>
                        <li class="no-link" role="presentation">
                          Compact Menu 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right compact-menu-check">
                          </div>
                        </li>
                        <li class="no-link" role="presentation">
                          Hover Menu 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right hover-menu-check">
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="li-group">
                      <ul class="list-unstyled">
                        <li class="no-link" role="presentation">
                          Boxed Layout 
                          <div class="ios-switch pull-right switch-md">
                            <input type="checkbox" class="js-switch pull-right boxed-layout-check">
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="li-group">
                      <ul class="list-unstyled">
                        <li class="no-link" role="presentation">
                          Choose Theme Color
                          <div class="color-switcher">
                            <a class="colorbox color-blue" href="indexca00.html?theme=blue" title="Blue Theme" data-css="blue"></a>
                            <a class="colorbox color-green" href="indexaf91.html?theme=green" title="Green Theme" data-css="green"></a>
                            <a class="colorbox color-red" href="index0e99.html?theme=red" title="Red Theme" data-css="red"></a>
                            <a class="colorbox color-white" href="index13d4.html?theme=white" title="White Theme" data-css="white"></a>
                            <a class="colorbox color-purple" href="index938c.html?theme=purple" title="purple Theme" data-css="purple"></a>
                            <a class="colorbox color-dark" href="index4965.html?theme=dark" title="Dark Theme" data-css="dark"></a>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="no-link"><button class="btn btn-default reset-options">Reset Options</button></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li>  
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right">4</span></a>
                  <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                    <li><p class="drop-title">You have 4 new  messages !</p></li>
                    <li class="dropdown-menu-list slimscroll messages">
                      <ul class="list-unstyled">
                        <li>
                          <a href="#">
                            <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar2.png" alt=""></div>
                            <p class="msg-name">Sandra Smith</p>
                            <p class="msg-text">Hey ! I'm working on your project</p>
                            <p class="msg-time">3 minutes ago</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar4.png" alt=""></div>
                            <p class="msg-name">Amily Lee</p>
                            <p class="msg-text">Hi David !</p>
                            <p class="msg-time">8 minutes ago</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar3.png" alt=""></div>
                            <p class="msg-name">Christopher Palmer</p>
                            <p class="msg-text">See you soon !</p>
                            <p class="msg-time">56 minutes ago</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar5.png" alt=""></div>
                            <p class="msg-name">Nick Doe</p>
                            <p class="msg-text">Nice to meet you</p>
                            <p class="msg-time">2 hours ago</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar2.png" alt=""></div>
                            <p class="msg-name">Sandra Smith</p>
                            <p class="msg-text">Hey ! I'm working on your project</p>
                            <p class="msg-time">5 hours ago</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar4.png" alt=""></div>
                            <p class="msg-name">Amily Lee</p>
                            <p class="msg-text">Hi David !</p>
                            <p class="msg-time">9 hours ago</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right">3</span></a>
                  <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                    <li><p class="drop-title">You have 3 pending tasks !</p></li>
                    <li class="dropdown-menu-list slimscroll tasks">
                      <ul class="list-unstyled">
                        <li>
                          <a href="#">
                            <div class="task-icon badge badge-success"><i class="icon-user"></i></div>
                            <span class="badge badge-roundless badge-default pull-right">1min ago</span>
                            <p class="task-details">New user registered.</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="task-icon badge badge-danger"><i class="icon-energy"></i></div>
                            <span class="badge badge-roundless badge-default pull-right">24min ago</span>
                            <p class="task-details">Database error.</p>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="task-icon badge badge-info"><i class="icon-heart"></i></div>
                            <span class="badge badge-roundless badge-default pull-right">1h ago</span>
                            <p class="task-details">Reached 24k likes</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="drop-all"><a href="#" class="text-center">All Tasks</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                    <span class="user-name">David<i class="fa fa-angle-down"></i></span>
                    <img class="img-circle avatar" src="assets/images/avatar1.png" width="40" height="40" alt="">
                  </a>
                  <ul class="dropdown-menu dropdown-list" role="menu">
                    <li role="presentation"><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                    <li role="presentation"><a href="calendar.html"><i class="fa fa-calendar"></i>Calendar</a></li>
                    <li role="presentation"><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right">4</span></a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                    <li role="presentation"><a href="login.html"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                  </ul>
                </li>
                <li>
                  <a href="login.html" class="log-out waves-effect waves-button waves-classic">
                    <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic" id="showRight">
                    <i class="fa fa-comments"></i>
                  </a>
                </li>
              </ul><!-- Nav -->
            </div><!-- Top Menu -->
          </div>
        </div>
      </div><!-- Navbar -->
      <?php echo $__env->make('admin.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->yieldContent('content'); ?>

    </main><!-- Page Content -->
    <?php echo $__env->make('admin.layouts.footer_navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

    <script>
     $( function() {
      $( ".datepicker" ).datepicker();
    } );
  </script>
  <?php echo $__env->yieldContent('script'); ?>
</body>
</html>
