      <div class="page-sidebar sidebar">

      	<div class="page-sidebar-inner slimscroll">

      		<div class="sidebar-header">

      			<div class="sidebar-profile">

              <!-- <a href="javascript:void(0);" id="profile-menu-link"> -->

                <a href="javascript:void(0);">

                 <div class="sidebar-profile-image">

                  <a href="<?php echo e(URL('/employee/dashboard')); ?>"><img src="<?php echo e(\Auth::user()->cb_profile->employee_pic); ?>" class="img-circle img-responsive" alt=""></a>

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

              <!-- <li><a href="<?php echo e(URL('/employee/apply-leave')); ?>">Apply Leave</a></li> -->
                <?php if(is_null(\Auth::user()->resignation)): ?>
               
              <li><a href="<?php echo e(URL('/employee/apply-leave')); ?>">Apply Leave</a></li>
               
               <?php else: ?>
               
               
               
              <?php endif; ?>

              <li><a href="<?php echo e(URL('/employee/my-leaves')); ?>">My Leaves</a></li>

            </ul>

          </li>
          <?php if(Auth::user()->role == 4): ?>
          <li class="droplink <?php echo e(setActive('teamLead/projects')); ?> 
        <?php echo e(setActive('teamLead/add-project')); ?> 
        <?php echo e(setActive('teamLead/assign-project')); ?> 
        <?php echo e(setActive('teamLead/employee-projects')); ?> "><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-folder"></span><p>Project</p><span class="arrow"></span></a>
        <ul class="sub-menu">
        <!--   <li><a href="<?php echo e(URL('/teamLead/projects')); ?>">Project List</a></li> -->
          <!-- <li><a href="<?php echo e(URL('/teamLead/add-project')); ?>">Add New Project</a></li> -->
          <li><a href="<?php echo e(URL('/teamLead/assign-project')); ?>">Assign Project</a></li>
          <li><a href="<?php echo e(URL('/teamLead/employee-projects')); ?>">Team Project List</a></li>
        </ul>
      </li>
       <?php endif; ?>



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

              <!-- <?php if(is_null(\Auth::user()->resignation)): ?>

              <li><a href="<?php echo e(URL('/resign')); ?>">Apply Resignation</a></li>
              <?php else: ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">View  Resignation</a></li>
             <?php endif; ?> -->

            
                           <?php if(is_null(\App\Resignation::where('user_id',\Auth::user()->id)->first())) { ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">Apply Resignation</a></li>
      
              <?php } elseif(is_null(\App\Retract::where('user_id',\Auth::user()->id)->first())) { ?>
              <li><a href="<?php echo e(URL('/resign')); ?>">View Resignation</a></li>
             <?php }else  {?>
              <li><a href="<?php echo e(URL('/employee/retract')); ?>">View Retract</a></li>
            <?php } ?>
             
              
            
             
                
                
           
              

            </ul>

          </li>

          

          

        </ul>

      </div><!-- Page Sidebar Inner -->

      </div><!-- Page Sidebar -->