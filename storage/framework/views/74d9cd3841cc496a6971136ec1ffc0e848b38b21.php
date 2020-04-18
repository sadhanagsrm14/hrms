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
            <li class="<?php echo e(setActive('hrManager/dashboard')); ?>"><a href="<?php echo e(URL('/hrManager/dashboard')); ?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

            <li class="droplink <?php echo e(setActive('hrManager/employees')); ?> <?php echo e(setActive('hrManager/add-employee')); ?> <?php echo e(setActive('hrManager/upload-employee')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-users"></span><p>Employees</p><span class="arrow"></span></a>
              <ul class="sub-menu">
                <li><a href="<?php echo e(URL('/hrManager/employees')); ?>">Employee Listing</a></li>
                <li><a href="<?php echo e(URL('/hrManager/add-employee')); ?>">Add New Employee</a></li>
                
              </ul>
            </li>

            <li class="droplink <?php echo e(setActive('hrManager/attendance')); ?>

            <?php echo e(setActive('hrManager/leave-details')); ?>  
            <?php echo e(setActive('hrManager/leave-types')); ?>

            <?php echo e(setActive('hrManager/add-leave-type')); ?>

            <?php echo e(setActive('hrManager/leave-listing')); ?>

            <?php echo e(setActive('hrManager/holidays')); ?>

            <?php echo e(setActive('hrManager/add-holiday')); ?>

            <?php echo e(setActive('hrManager/holiday-calender')); ?>"
            ><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-calendar"></span><p>Attendance / Leave</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/hrManager/attendance')); ?>">Attendance List</a></li>
              <li><a href="<?php echo e(URL('/hrManager/leave-details')); ?>">Leave Details</a></li>              
              <li><a href="<?php echo e(URL('/hrManager/leave-types')); ?>">Leave Types</a></li>
              <li><a href="<?php echo e(URL('/hrManager/add-leave-type')); ?>">Add Leave Types</a></li>
              <li><a href="<?php echo e(URL('/hrManager/leave-listing')); ?>">Leave Listing</a></li>
              <li><a href="<?php echo e(URL('/hrManager/holidays')); ?>">Holidays List</a></li>
              <li><a href="<?php echo e(URL('/hrManager/add-holiday')); ?>">Add Holiday</a></li>
              <li><a href="<?php echo e(URL('/hrManager/holiday-calender')); ?>">Holiday Calender</a></li>
            </ul>
          </li>

          <li class="droplink <?php echo e(setActive('hrManager/assign-team-members')); ?> <?php echo e(setActive('hrManager/teams')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon fa fa-users"></span><p>Teams</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/hrManager/teams')); ?>"> Teams </a></li>
              <li><a href="<?php echo e(URL('/hrManager/assign-team-members')); ?>">Assign Team Members</a></li>
            </ul>
          </li>


          <li class="droplink <?php echo e(setActive('hrManager/request/profile-update')); ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-inbox"></span><p>Requests</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/hrManager/request/profile-update')); ?>">Profile Update Requests</a></li>
              <li><a href="<?php echo e(URL('/hrManager/leave-listing?type=pending')); ?>">Leave Requests</a></li>
            </ul>
          </li>

          <li class="droplink <?php echo e(setActive('hrManager/send-eod')); ?> <?php echo e(setActive('hrManager/sent-eods')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon fa fa-pencil"></span><p>EOD</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/hrManager/send-eod')); ?>"> Send EOD </a></li>
              <li><a href="<?php echo e(URL('/hrManager/sent-eods')); ?>">View EODs</a></li>
            </ul>
          </li> 

          <li class="droplink <?php echo e(setActive('hrManager/apply-leave')); ?> <?php echo e(setActive('hrManager/my-leaves')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon fa fa-calendar"></span><p>My Leaves</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/hrManager/apply-leave')); ?>"> Apply Leave </a></li>
              <li><a href="<?php echo e(URL('/hrManager/my-leaves')); ?>">Applied Leaves</a></li>
            </ul>
          </li>

          <li class="droplink <?php echo e(setActive('/resign')); ?>">
            <a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Resignation</p><span class="arrow"></span></a>
            <ul class="sub-menu">
              <li><a href="<?php echo e(URL('/hrManager/resignations')); ?>">View Employee's Resignations</a></li>
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