<div class="main-wrapper">
	<div class="sidebar" id="sidebar">
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="menu-title"> 
						<span>Main</span>
					</li>
					<li class="">						
						@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
						<a  href="{{ url('index') }}"><i class="la la-dashboard"></i><span>Admin Dashboard</span></a>
						@elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 6)
						<a href="{{ url('index') }}"><i class="la la-dashboard"></i><span>Manager Dashboard</span></a>
						@else
						<a href="{{ url('employee-dashboard') }}"><i class="la la-dashboard"></i><span>Employee Dashboard</span></a>
						@endif								
						 </a>								 
					</li>	
					@if(Auth::user()->role_id != 3)				 
					<li class="menu-title"> 
						<span>Employee</span>
					</li>
					
					<li class="submenu">
						<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							@if (Auth::user()->role_id == 1 || Auth::user()->role_id==2 || Auth::user()->role_id == 5 ||  Auth::user()->role_id == 6)
							<li>
								<a class="{{ Request::is('employees') ? 'active' : '' }}" href="{{ url('employees') }}">All Employees</a>
							</li>		
							@endif	
							@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
							<li>
								<a class="{{ Request::is('departments') ? 'active' : '' }}" href="{{ url('departments') }}">Departments</a>
							</li>	
							@endif
							@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
							<li>
								<a class="{{ Request::is('designations') ? 'active' : '' }}" href="{{ url('designations') }}">Designations</a>
							</li>
							@endif
							@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
							<li>
								<a class="{{ Request::is('locations') ? 'active' : '' }}" href="{{ url('locations') }}">Locations</a>
							</li>
							@endif
							
						</ul>
					</li>
					@endif	
					<li class="menu-title"> 
						<span>Performance</span>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-graduation-cap"></i> <span> Performance </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="{{ Request::is('performance-indicator') ? 'active' : '' }}" href="{{ url('performance-indicator') }}"> Performance Indicator  </a>
							</li>
							<!-- @if (Auth::user()->role_id == 3)	
							<li>
								<a class="{{ Request::is('performance') ? 'active' : '' }}" href="{{ url('performance') }}"> Performance Review  </a>
							</li>
							@endif -->	
							@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6)
							<li>
								<a class="{{ Request::is('employees-performance') ? 'active' : '' }}" href="{{ url('employees-performance') }}"> Employee Performance </a>
							</li>
							@endif	
							@if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6)
							<li>
								<a class="{{ Request::is('my-performance') ? 'active' : '' }}" href="{{ route('my-performance', auth()->user()->id) }}">Performance Review</a>
							</li>
							@endif							
							<!--<li>
								<a class="{{ Request::is('performance-appraisal') ? 'active' : '' }}" href="{{ url('performance-appraisal') }}"> Performance Appraisal  </a>
							</li>-->
						</ul>	
					</li>
					@if (auth()->user()->role_id != 3)
					<li class="{{ Request::is('termination') ? 'active' : '' }}">
        				<a  href="{{ url('termination') }}"><i class="la la-external-link-square"></i> <span>Termination</span> </a>
        			</li>
					@endif
					<li>
						<a class="{{ Request::is('employee-warning') ? 'active' : '' }}" href="{{ url('employee-warning') }}"><i class="la la-external-link-square"></i><span>Warning</span></a>
					</li>	
					
					@if (auth()->user()->role_id != 3)
					<li class="{{ Request::is('promotion') ? 'active' : '' }}">
						<a  href="{{ url('promotion') }}"><i class="la la-bullhorn"></i> <span>Promotion</span>  </a>
					</li>
					@endif
					<li class="{{ Request::is('resignation') ? 'active' : '' }}">
						<a  href="{{ url('resignation') }}"><i class="la la-external-link-square"></i> <span>Resignation</span>  </a>
					</li>
					@if (Auth::user()->role_id != 1)
					<li>
						<a class="{{ Request::is('leaves-employee') ? 'active' : '' }}" href="{{ url('leaves-employee') }}"><i class="la la-user-secret"></i>
						<span>Leaves</span></a></li>	
					<li>
					@endif
					@if (Auth::user()->role_id == 1 || Auth::user()->role_id==2 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6)
					<li>
						<a class="{{ Request::is('leaves') ? 'active' : '' }}" href="{{ url('leaves') }}"><i class="la la-cube"></i><span>Leaves Approval</span></a></li>								
	
					<li>
					@endif
					@if (Auth::user()->role_id == 1 || Auth::user()->role_id==2 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6)
					<li>
						<a class="{{ Request::is('leave-calender') ? 'active' : '' }}" href="{{ url('leave-calender') }}"><i class="la la-cube"></i><span>Leave Calender</span></a></li>								
					<li>
					@endif
					<!--<li>
						<a class="{{ Request::is('holidays') ? 'active' : '' }}" href="{{ url('holidays') }}"><i class="la la-bullhorn"></i><span>Holidays</span></a>
					</li>-->
					@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5 )
					<li class="menu-title"> 
						<span>Administration</span>
					</li> 
					<li class="{{ Request::is('settings') ? 'active' : '' }}">
						<a  href="{{ url('settings') }}"><i class="la la-cog"></i><span>Settings</span>  </a>
					</li>
					<li class="{{ Request::is('organizational-chart') ? 'active' : '' }}">
						<a  href="{{ url('organizational-chart') }}"><i class="la la-cog"></i><span>Organizational Chart</span>  </a>
					</li>
					@endif
					<li class="menu-title"> 
						<span>Pages</span>
					</li>
					<li class="submenu">
						<a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li>
								<a class="{{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile_details', auth()->user()->id) }}"> Employee Profile  </a>
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


			