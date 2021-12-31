<div class="main-wrapper">
	<div class="sidebar" id="sidebar">
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="menu-title"> 
						<span>Main</span>
					</li>
					<li class="">						
						<?php if(Auth::user()->role_type == "admin"): ?>
						<a  href="<?php echo e(url('index')); ?>"><i class="la la-dashboard"></i><span>Admin Dashboard</span></a>
						<?php elseif(Auth::user()->role_type == "manager"): ?>
						<a href="<?php echo e(url('index')); ?>"><i class="la la-dashboard"></i><span>Manager Dashboard</span></a>
						<?php else: ?>
						<a href="<?php echo e(url('employee-dashboard')); ?>"><i class="la la-dashboard"></i><span>Employee Dashboard</span></a>
						<?php endif; ?>								
						 </a>								 
					</li>					 
					<li class="menu-title"> 
						<span>Employees</span>
					</li>
					<li class="submenu">
						<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="<?php echo e(Request::is('employees') ? 'active' : ''); ?>" href="<?php echo e(url('employees')); ?>">All Employees</a>
							</li>			
							<li>
								<a class="<?php echo e(Request::is('departments') ? 'active' : ''); ?>" href="<?php echo e(url('departments')); ?>">Departments</a>
							</li>	
							<li>
								<a class="<?php echo e(Request::is('designations') ? 'active' : ''); ?>" href="<?php echo e(url('designations')); ?>">Designations</a>
							</li>		
						</ul>
					</li>
					<li class="menu-title"> 
						<span>Performance</span>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-graduation-cap"></i> <span> Performance </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="<?php echo e(Request::is('performance-indicator') ? 'active' : ''); ?>" href="<?php echo e(url('performance-indicator')); ?>"> Performance Indicator  </a>
							</li>
							<?php if(Auth::user()->role_type == "employee"): ?>	
							<li>
								<a class="<?php echo e(Request::is('performance') ? 'active' : ''); ?>" href="<?php echo e(url('performance')); ?>"> Performance Review  </a>
							</li>
							<?php endif; ?>	
							<?php if(Auth::user()->role_type == "admin" || Auth::user()->role_type == "manager"): ?>
							<li>
								<a class="<?php echo e(Request::is('employees-performance') ? 'active' : ''); ?>" href="<?php echo e(url('employees-performance')); ?>"> Employee Performance </a>
							</li>	
							<?php endif; ?>								
							<li>
								<a class="<?php echo e(Request::is('performance-appraisal') ? 'active' : ''); ?>" href="<?php echo e(url('performance-appraisal')); ?>"> Performance Appraisal  </a>
							</li>
						</ul>	
					</li>	
					<li class="menu-title"> 
						<span>Administration</span>
					</li> 
					<li class="<?php echo e(Request::is('settings') ? 'active' : ''); ?>">
						<a  href="<?php echo e(url('settings')); ?>"><i class="la la-cog"></i><span>Settings</span>  </a>
					</li>
					<li class="menu-title"> 
						<span>Pages</span>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="<?php echo e(Request::is('profile') ? 'active' : ''); ?>" href="<?php echo e(url('profile')); ?>"> Employee Profile  </a>
							</li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-key"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">						
							<li class="<?php echo e(Request::is('forgot-password') ? 'active' : ''); ?>">
								<a  href="<?php echo e(url('forgot-password')); ?>"> Forgot Password </a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>


			<?php /**PATH C:\xampp\htdocs\hrms\resources\views/layout/partials/nav.blade.php ENDPATH**/ ?>