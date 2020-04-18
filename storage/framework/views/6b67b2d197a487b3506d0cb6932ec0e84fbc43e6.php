      <div class="page-sidebar sidebar">
      	<div class="page-sidebar-inner slimscroll">
      		<div class="sidebar-header">
      			<div class="sidebar-profile">
              <!-- <a href="javascript:void(0);" id="profile-menu-link"> -->
                <a href="javascript:void(0);">
                 <div class="sidebar-profile-image">
                  <img src="<?php echo e(\Auth::user()->cb_profile->employee_pic); ?>" class="img-circle img-responsive" alt="">
                </div>
                <div class="sidebar-profile-details">
                  <span><?php echo e(\Auth::user()->first_name); ?><br><small><?php echo e(\Auth::user()->cb_profile->designation); ?></small></span>
                </div>
              </a>
            </div>
          </div>

          <ul class="menu accordion-menu">
           <li class="<?php echo e(setActive('employee/dashboard')); ?>"><a href="<?php echo e(URL('/employee/dashboard')); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

           <li class="droplink <?php echo e(setActive('employee/apply-leave')); ?>  <?php echo e(setActive('employee/my-leaves')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Leaves</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/employee/apply-leave')); ?>">Apply Leave</a></li>
              <li><a href="<?php echo e(URL('/employee/my-leaves')); ?>">My Leaves</a></li>
            </ul>
          </li>

          <li class="droplink <?php echo e(setActive('employee/send-eod')); ?> <?php echo e(setActive('employee/sent-eods')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>EODs</p><span class="arrow"></span></a>
            <ul class="sub-menu">

            	<?php if(Auth::user()->role == 4): ?>
              <li><a href="<?php echo e(URL('/employee/see-eod')); ?>">Team Member's EOD</a></li>
              <?php endif; ?>

              <li><a href="<?php echo e(URL('/employee/sent-eods')); ?>">My Sent EODs</a></li>
              <li><a href="<?php echo e(URL('/employee/send-eod')); ?>">Send</a></li>
            </ul>
          </li>

          <li class="droplink <?php echo e(setActive('resign')); ?>">
            <a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Resignation</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <?php if(is_null(\Auth::user()->resignation)): ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">Apply Resignation</a></li>
              <?php else: ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">View Resignation</a></li>
              <?php endif; ?>
            </ul>
          </li>
          
          
        </ul>
      </div><!-- Page Sidebar Inner -->
      </div><!-- Page Sidebar -->