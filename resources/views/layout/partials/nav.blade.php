<div class="main-wrapper">
	<div class="sidebar" id="sidebar">
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="menu-title"> 
						<span>Main</span>
					</li>
					<li class="">						
						@if (Auth::user()->role_id == 1)
						<a  href="{{ url('index') }}"><i class="la la-dashboard"></i><span>Admin Dashboard</span></a>
						@elseif (Auth::user()->role_id == 2)
						<a href="{{ url('index') }}"><i class="la la-dashboard"></i><span>Manager Dashboard</span></a>
						@else
						<a href="{{ url('employee-dashboard') }}"><i class="la la-dashboard"></i><span>Employee Dashboard</span></a>
						@endif								
						 </a>								 
					</li>					 
					<li class="menu-title"> 
						<span>Employees</span>
					</li>
					<li class="submenu">
						<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="{{ Request::is('employees') ? 'active' : '' }}" href="{{ url('employees') }}">All Employees</a>
							</li>			
							<li>
								<a class="{{ Request::is('departments') ? 'active' : '' }}" href="{{ url('departments') }}">Departments</a>
							</li>	
							<li>
								<a class="{{ Request::is('designations') ? 'active' : '' }}" href="{{ url('designations') }}">Designations</a>
							</li>
							<li>
								<a class="{{ Request::is('employee-warning') ? 'active' : '' }}" href="{{ url('employee-warning') }}">Warning</a>
							</li>	
							<li>
        						<a class="{{ Request::is('holidays') ? 'active' : '' }}" href="{{ url('holidays') }}">Holidays</a>
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
								<a class="{{ Request::is('performance-indicator') ? 'active' : '' }}" href="{{ url('performance-indicator') }}"> Performance Indicator  </a>
							</li>
							@if (Auth::user()->role_id == 3)	
							<li>
								<a class="{{ Request::is('performance') ? 'active' : '' }}" href="{{ url('performance') }}"> Performance Review  </a>
							</li>
							@endif	
							@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
							<li>
								<a class="{{ Request::is('employees-performance') ? 'active' : '' }}" href="{{ url('employees-performance') }}"> Employee Performance </a>
							</li>
							@endif								
							<li>
								<a class="{{ Request::is('performance-appraisal') ? 'active' : '' }}" href="{{ url('performance-appraisal') }}"> Performance Appraisal  </a>
							</li>
						</ul>	
					</li>
					<li class="{{ Request::is('termination') ? 'active' : '' }}">
        				<a  href="{{ url('termination') }}"><i class="la la-external-link-square"></i> <span>Termination</span> </a>
        			</li>
	
					<li class="{{ Request::is('promotion') ? 'active' : '' }}">
						<a  href="{{ url('promotion') }}"><i class="la la-bullhorn"></i> <span>Promotion</span>  </a>
					</li>
					<li class="{{ Request::is('resignation') ? 'active' : '' }}">
						<a  href="{{ url('resignation') }}"><i class="la la-external-link-square"></i> <span>Resignation</span>  </a>
					</li>
					<li class="menu-title"> 
						<span>Administration</span>
					</li> 
					<li class="{{ Request::is('settings') ? 'active' : '' }}">
						<a  href="{{ url('settings') }}"><i class="la la-cog"></i><span>Settings</span>  </a>
					</li>
					<li class="menu-title"> 
						<span>Pages</span>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="{{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"> Employee Profile  </a>
							</li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-key"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">						
							<li class="{{ Request::is('forgot-password') ? 'active' : '' }}">
								<a  href="{{ url('forgot-password') }}"> Forgot Password </a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>


			