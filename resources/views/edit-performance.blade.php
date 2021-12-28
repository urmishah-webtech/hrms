<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Dashboard - HRMS admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/line-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}">
		
		<!-- Calendar CSS -->
		<link rel="stylesheet" href="{{ URL::asset('css/fullcalendar.min.css') }}">

        <!-- Tagsinput CSS -->
		<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}">
         
		<!-- Summernote CSS -->
		<link rel="stylesheet" href="{{ URL::asset('plugins/summernote/dist/summernote-bs4.css') }}">
		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{ URL::asset('plugins/morris/morris.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
       
    </head>	
<body>
@include('layout.partials.footer-scripts') 
 
    <!-- Main Wrapper -->
    <div class="main-wrapper">
    
        <!-- Header -->
        <div class="header">
        
            <!-- Logo -->
            <div class="header-left">
                <a href="index" class="logo">
                    <img src="{{ URL::asset('img/logo.png') }}" width="40" height="40" alt="">
                </a>
            </div>
            <!-- /Logo -->
            
            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            
            <!-- Header Title -->
            <div class="page-title-box">
                <h3>Dreamguy's Technologies</h3>
            </div>
            <!-- /Header Title -->
            
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            
            <!-- Header Menu -->
            <ul class="nav user-menu">
            
                <!-- Search -->
                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="search">
                            <input class="form-control" type="text" placeholder="Search here">
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
                <!-- /Search -->
            
                <!-- Flag -->
                <li class="nav-item dropdown has-arrow flag-nav">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <img src="../img/flags/us.png" alt="" height="20"> <span>English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="../img/flags/us.png" alt="" height="16"> English
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="../img/flags/fr.png" alt="" height="16"> French
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="../img/flags/es.png" alt="" height="16"> Spanish
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="../img/flags/de.png" alt="" height="16"> German
                        </a>
                    </div>
                </li>
                <!-- /Flag -->
            
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{ URL::asset('img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{ URL::asset('img/profiles/avatar-03.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{ URL::asset('img/profiles/avatar-06.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{ URL::asset('img/profiles/avatar-17.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{ URL::asset('img/profiles/avatar-13.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->
                
                <!-- Message Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Messages</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::asset('img/profiles/avatar-09.jpg') }}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Richard Miles </span>
                                                <span class="message-time">12:28 AM</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::asset('img/profiles/avatar-02.jpg') }}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">John Doe</span>
                                                <span class="message-time">6 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::asset('img/profiles/avatar-03.jpg') }}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author"> Tarah Shropshire </span>
                                                <span class="message-time">5 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::asset('img/profiles/avatar-05.jpg') }}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Mike Litorus</span>
                                                <span class="message-time">3 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{ URL::asset('img/profiles/avatar-08.jpg') }}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author"> Catherine Manseau </span>
                                                <span class="message-time">27 Feb</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="chat">View all Messages</a>
                        </div>
                    </div>
                </li>
                <!-- /Message Notifications -->

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="{{ URL::asset('img/profiles/avatar-21.jpg') }}" alt="">
                        <span class="status online"></span></span>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile">My Profile</a>
                        <a class="dropdown-item" href="settings">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();                                document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->
            
            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile">My Profile</a>
                    <a class="dropdown-item" href="settings">Settings</a>
                    <a class="dropdown-item" href="login">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
            
        </div>
        <!-- /Header -->
        
        <div class="sidebar" id="sidebar">
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="menu-title"> 
						<span>Main</span>
					</li>
					<li class="">						
						@if (Auth::user()->role_type == "admin")
						<a href="{{ url('index') }}"><i class="la la-dashboard"></i><span>Admin Dashboard</span></a>
						@elseif (Auth::user()->role_type == "manager")
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
							@if (Auth::user()->role_type == "employee")	
							<li>
								<a class="{{ Request::is('performance') ? 'active' : '' }}" href="{{ url('performance') }}"> Performance Review  </a>
							</li>
							@endif	
							@if (Auth::user()->role_type == "admin" || Auth::user()->role_type == "manager")
							<li>
								<a class="{{ Request::is('employees-performance/') ? 'active' : '' }}" href="{{ url('employees-performance') }}"> Employee Performance </a>
							</li>
							@endif								
							<li>
								<a class="{{ Request::is('performance-appraisal') ? 'active' : '' }}" href="{{ url('performance-appraisal') }}"> Performance Appraisal  </a>
							</li>
						</ul>	
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
        </div>
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Performance</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Performance</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <section class="review-section information">
                    <div class="review-header text-center">
                        <h3 class="review-title">Employee Basic Information</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap review-table mb-0">
                                    <tbody>
										<form>
                                        <tr>
                                            <td>                                              
												<div class="form-group">
													<label for="name">Employee</label>
													<input type="text" class="form-control" id="name" value="{{ @$emps->first_name }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="depart3">Department</label>
													<input type="text" class="form-control" id="depart3" value="{{ @$emps->designation->department->name}}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="departa">Designation</label>
													<input type="text" class="form-control" id="departa" value="{{ @$emps->designation->name }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
                                            </td>
                                            <td>                                                
												<div class="form-group">
													<label for="qualif1">Email</label>
													<input type="text" class="form-control" id="qualif1" value="{{ @$emps->email }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="doj">Emp ID</label>
													<input type="text" class="form-control" value="{{ @$emps->employee_id }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="doj">Date of Join</label>
													<input type="text" class="form-control" id="doj" value="{{ @$emps->joing_date }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
                                            </td>
                                            <td>                                               
												<div class="form-group">
													<label for="name1"> Manager's Name</label>
													<input type="text" class="form-control" id="name1" @if (Auth::user()->role_type == "employee")readonly @endif value="@if (Auth::user()->role_type == "manager"){{Auth::user()->name}}@endif">
												</div>
												                                         
                                            </td>
                                        </tr>
									</form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>	 
                
                <section class="review-section professional-excellence">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Excellence</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
							 <form action="{{ route('edit_man_professionalExcellence') }}" method="post">
                             @csrf  
								 
								 
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Key Result Area</th>
                                            <th>Key Performance Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th>
                                            <th>Points Scored <br>( self )</th>
                                            <th>Percentage achieved <br>( Manager's Score )</th>
                                            <th>Points Scored <br>( Manager )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Production</td>
                                            <td>Quality</td>
                                            <td><input type="text" class="form-control" readonly value="30"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="quality_employee" id="quality_id"value="{{ @$professional->quality_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="quality_manager" id="quality_manager"  value="{{ @$professional->quality_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <input type="hidden" name="getid" value="@if(isset($professional)){{ $professional->emp_id}}@endif">
                                            <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        </tr>
                                        <tr>
                                            <td>TAT (turn around time)</td>
                                            <td><input type="text" class="form-control" readonly value="30"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="tat_employee" id="tat_id" value="{{ @$professional->tat_employee }}" readonly  ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="tat_manager" id="tat_manager" value="{{ @$professional->tat_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                             
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Process Improvement</td>
                                            <td>PMS,New Ideas</td>
                                            <td><input type="text" class="form-control" readonly value="10"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="pms_new_ideas_employee" id="pms_new_ideas" value="{{ @$professional->pms_new_ideas_employee }}" readonly></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="pms_new_ideas_manager" id="pms_new_ideas_manager"  value="{{ @$professional->pms_new_ideas_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Team Management</td>
                                            <td>Team Productivity,dynaics,attendance,attrition</td>
                                            <td><input type="text" class="form-control" readonly value="5"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="team_productivity_employee" id="team_productivity" value="{{ @$professional->team_productivity_employee }}" readonly  ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="team_productivity_manager" id="team_productivity_manager"  value="{{ @$professional->team_productivity_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                             
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Knowledge Sharing</td>
                                            <td>Sharing the knowledge for team productivity </td>
                                            <td><input type="text" class="form-control" readonly value="5"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="knowledge_sharing_employee" id="knowledge_sharing" value="{{ @$professional->knowledge_sharing_employee }}" readonly  ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="knowledge_sharing_manager" id="knowledge_sharing_manager" value="{{ @$professional->knowledge_sharing_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Reporting and Communication</td>
                                            <td>Emails/Calls/Reports and Other Communication</td>
                                            <td><input type="text" class="form-control" readonly value="5"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="emails_calls_employee" id="emails_calls" value="{{ @$professional->emails_calls_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="emails_calls_manager" id="emails_calls_manager"  value="{{ @$professional->emails_calls_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                             
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="85"></td>
                                            <td><input type="text" class="form-control" readonly name="total_percentage_employee" id="total_percentage_employee" value="{{ @$professional->total_percentage_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control" readonly name="total_percentage_manager" id="total_percentage_manager" value="{{ @$professional->total_percentage_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            
                                        </tr>
                                        							
                                    </tbody>
                                </table>	
								<div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
								</form>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="review-section personal-excellence">
                    <div class="review-header text-center">
                        <h3 class="review-title">Personal Excellence</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_PersonalExcellence') }}" method="post">
                             @csrf
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Personal Attributes</th>
                                            <th>Key Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th>
                                            <th>Points Scored <br>( self )</th>
                                            <th>Percentage achieved <br>( Manager's Score )</th>
                                            <th>Points Scored <br>( Manager )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Attendance</td>
                                            <td>Planned or Unplanned Leaves</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="plan_leave_employee" id="plan_leave_employee" value="{{ @$personal->plan_leave_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control" name="plan_leave_manager" id="plan_leave_manager" value="{{ @$personal->plan_leave_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <input type="hidden" name="getid" value="@if(isset($personal)){{ $personal->emp_id}}@endif">
                                            <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        </tr>
                                        <tr>
                                            <td>Time Consciousness</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="time_cons_employee" id="time_cons_employee" value="{{ @$personal->time_cons_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="time_cons_manager" id="time_cons_manager" value="{{ @$personal->time_cons_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">2</td>
                                            <td rowspan="2">Attitude & Behavior</td>
                                            <td>Team Collaboration</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="team_collaboration_employee" id="team_collaboration_employee" value="{{ @$personal->team_collaboration_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="team_collaboration_manager" id="team_collaboration_manager" value="{{ @$personal->team_collaboration_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Professionalism & Responsiveness</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="professionalism_employee" id="professionalism_employee" value="{{ @$personal->professionalism_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="professionalism_manager" id="professionalism_manager" value="{{ @$personal->professionalism_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Policy & Procedures </td>
                                            <td>Adherence to policies and procedures</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="policy_employee" id="policy_employee" value="{{ @$personal->policy_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="policy_manager" id="policy_manager" value="{{ @$personal->policy_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                        <td>4</td>
                                            <td>Initiatives</td>
                                            <td>Special Efforts, Suggestions,Ideas,etc.</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="initiatives_employee" id="initiatives_employee" value="{{ @$personal->initiatives_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="initiatives_manager" id="initiatives_manager" value="{{ @$personal->initiatives_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Continuous Skill Improvement</td>
                                            <td>Preparedness to move to next level & Training utilization</td>
                                            <td><input type="text" class="form-control" readonly value="3"></td>
                                            <td><input type="text" class="form-control personal_employee" name="improvement_employee" id="improvement_employee" value="{{ @$personal->improvement_employee }}" readonly></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="improvement_manager" id="improvement_manager" value="{{ @$personal->improvement_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="15"></td>
                                            <td><input type="text" class="form-control" readonly  name="total_score_employee" id="total_score_employee" value="{{ @$personal->total_score_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0" ></td>
                                            <td><input type="text" class="form-control" readonly name="total_score_manager" id="total_score_manager" value="{{ @$personal->total_score_manager }}"  readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center"><b>Total Percentage(%)</b></td>
                                            <td></td>
                                            <td colspan="2" class="text-center"><input type="text" class="form-control" name="total_percentage_employee" id="total_percentage_empl" readonly value="{{ @$personal->total_percentage_employee }}"></td>
                                            <td colspan="2" class="text-center"><input type="text" class="form-control" name="total_percentage_manager" id="total_percentage_man" readonly value="{{ @$personal->total_percentage_manager }}"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="grade-span">
                                                    <h4>Grade</h4>
                                                    <span class="badge bg-inverse-danger">Below 65 Poor</span> 
                                                    <span class="badge bg-inverse-warning">65-74 Average</span> 
                                                    <span class="badge bg-inverse-info">75-84 Satisfactory</span> 
                                                    <span class="badge bg-inverse-purple">85-92 Good</span> 
                                                    <span class="badge bg-inverse-success">Above 92 Excellent</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>                            
                                <div class="review-header text-center">
									<button type="submit" name="personal" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Special Initiatives, Achievements, contributions if any</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_SpecialInitiatives') }}" method="post">
                             @csrf
                                
                                <table class="table table-bordered table-review review-table mb-0" id="table_achievements">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_achievements_tbody">
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($specialInitiatives) && count($specialInitiatives) > 0)
                                        @foreach($specialInitiatives as $val)
                                        <tr>
                                        <input type="hidden" name="getid" value="@if(isset($specialInitiatives)){{ $val->emp_id}}@endif">
                                        
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                            
                                        </tr>
                                        @endif  
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>    
                            </div>
                        </div>
                    </div>
                </section>
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Comments on the role</h3>
                        <p class="text-muted">alterations if any requirred like addition/deletion of responsibilities</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_CommentsRole') }}" method="post">
                             @csrf
                             <input class="form-control" value="" name="id" type="hidden" required> 
                                <table class="table table-bordered table-review review-table mb-0" id="table_alterations">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>                                           
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_alterations_tbody">
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($comments_role) && count($comments_role) > 0)
                                        @foreach($comments_role as $val)
                                        <tr>
                                            <input type="hidden" name="getid" value="@if(isset($comments_role)){{ $val->emp_id}}@endif">
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"   readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>                                            
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>                                            
                                        </tr>
                                        @endif  
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form> 
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Comments on the role</h3>
                        <p class="text-muted">alterations if any requirred like addition/deletion of responsibilities</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_AdditionComment') }}" method="post">
                             @csrf
                             
                             <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                             @php $i = 1; @endphp
                               @foreach($add_comments_id as $val)
                               <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_comments_id)){{ $val->emp_id}}@endif">
                               @php $i++; @endphp
                              @endforeach                              
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Strengths</th>
                                            <th>Area's for Improvement</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[0])){{$add_comments[0]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[0])){{$add_comments[0]['areas_improvement']}} @endif"></td>                                             
                                        </tr>                                         
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[1])){{$add_comments[1]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[1])){{$add_comments[1]['areas_improvement']}} @endif"></td>                                            
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[2])){{$add_comments[2]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[2])){{$add_comments[2]['areas_improvement']}} @endif"></td>                                             
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[3])){{$add_comments[3]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[3])){{$add_comments[3]['areas_improvement']}} @endif"></td>                                             
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[4])){{$add_comments[4]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[4])){{$add_comments[4]['areas_improvement']}} @endif"></td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Appraisee's Strengths and Areas for Improvement perceived by the Reporting officer</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('edit_man_AppraiseeStrength') }}" method="post">
                                @csrf
                                <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                @php $i = 1; @endphp
                                @foreach($add_appraiseest_id as $val)
                                <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_appraiseest_id)){{ $val->emp_id}}@endif">                                 
                                @php $i++; @endphp
                                @endforeach      
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Strengths</th>
                                            <th>Area's for Improvement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['areas_improvement']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['areas_improvement']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['areas_improvement']}} @endif"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Personal Goals</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('edit_man_PersonalGoal') }}" method="post">
                                @csrf
                                <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                @php $i = 1; @endphp
                                @foreach($add_personalgoal_id as $val)
                                <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_personalgoal_id)){{ $val->emp_id}}@endif">
                                @php $i++; @endphp
                                @endforeach
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Goal Achieved during last year</th>
                                            <th>Goal set for current year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[0])){{$add_personalgoal[0]['goal_last_year']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[0])){{$add_personalgoal[0]['goal_current_year']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[1])){{$add_personalgoal[1]['goal_last_year']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[1])){{$add_personalgoal[1]['goal_current_year']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[2])){{$add_personalgoal[2]['goal_last_year']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[2])){{$add_personalgoal[2]['goal_current_year']}} @endif"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                 
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Goals Achieved for last year</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_ProfessionalGoalsAchieved') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_goals">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_goals_tbody">
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($professional_achived) && count($professional_achived) > 0)
                                        @foreach($professional_achived as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" name="getid" value="@if(isset($professional_achived)){{ $val->emp_id}}@endif" >
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif  
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Goals for the forthcoming year</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_ProfessionalGoalsForthcoming') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_forthcoming">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_forthcoming_tbody">
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($professional_forthcoming) && count($professional_forthcoming) > 0)
                                        @foreach($professional_forthcoming as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly  ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                            <input type="hidden" name="getid" value="@if(isset($professional_forthcoming)){{ $val->emp_id}}@endif">
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form> 
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Training Requirements</h3>
                        <p class="text-muted">if any to achieve the Performance Standard Targets completely</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_TrainingRequirements') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_targets">
                                    <thead>
                                        <tr>
                                        <th style="width:40px;">#</th>
                                        <th>By Self</th>
                                        <th>Manager's Comment</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_targets_tbody">
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($training_requirements) && count($training_requirements) > 0)
                                        @foreach($training_requirements as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                            <input type="hidden" name="getid" value="@if(isset($training_requirements)){{ $val->emp_id}}@endif">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif  
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form> 
                            </div>
                        </div>
                    </div>
                </section>

                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Any other general comments, observations, suggestions etc.</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_OtherGeneralComment') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="general_comments">
                                    <thead>
                                        <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Self</th>
                                        <th>Manager</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="general_comments_tbody" >
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($general_comment) && count($general_comment) > 0)
                                        @foreach($general_comment as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->employee_comments}}"readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comments}}"></td>
                                           <td></td>
                                           <input type="hidden" name="getid" value="@if(isset($general_comment)){{ $val->emp_id}}@endif">
                                           <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly @if (Auth::user()->role_type == "employee")editable @endif></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif 
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form> 
                            </div>
                        </div>
                    </div>
                </section>

               <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">For Manager's Use Only</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_PerfomanceManagerUse') }}" method="post">
                             @csrf
                             <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                             @php $i = 1; @endphp
                               @foreach($perfomancemanageruse as $val)
                               <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($perfomancemanageruse)){{ $val->emp_id}}@endif">
                               @php $i++; @endphp
                              @endforeach 
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Yes/No</th>
                                            <th>If Yes - Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>The Team member has Work related Issues</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The Team member has Work related Issues">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[0])) @if($perfomancemanageruse[0]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[0])) @if($perfomancemanageruse[0]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[0])){{$perfomancemanageruse[0]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>The Team member has Leave Issues</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The Team member has Leave Issues">
                                            <td>
                                            <select class="form-control select" name="select_option[]">
                                                <option value="">Select</option>
                                                <option  @if(isset($perfomancemanageruse[1])) @if($perfomancemanageruse[1]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                <option @if(isset($perfomancemanageruse[1])) @if($perfomancemanageruse[1]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                            </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[1])){{$perfomancemanageruse[1]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>The team member has Stability Issues</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The team member has Stability Issues">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[2])) @if($perfomancemanageruse[2]['select_option']  == "Yes") selected @endif @endif  value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[2])) @if($perfomancemanageruse[2]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[2])){{$perfomancemanageruse[2]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>The Team member exhibits non-supportive attitude</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The Team member exhibits non-supportive attitude">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[3])) @if($perfomancemanageruse[3]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[3])) @if($perfomancemanageruse[3]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[3])){{$perfomancemanageruse[3]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>Any other points in specific to note about the team member</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="Any other points in specific to note about the team member">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[4])) @if($perfomancemanageruse[4]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[4])) @if($perfomancemanageruse[4]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[4])){{$perfomancemanageruse[4]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                        <td>Overall Comment /Performance of the team member</td>
                                        <input type="hidden" class="form-control" name="issues[]" value="Overall Comment /Performance of the team member">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[5])) @if($perfomancemanageruse[5]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[5])) @if($perfomancemanageruse[5]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[5])){{$perfomancemanageruse[5]['yes_details']}} @endif"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit"  class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <form action="{{ route('edit_manPerformanceIdentity') }}" method="post">
                            @csrf
                            <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                            @php $i = 1; @endphp
                               @foreach($add_perfoIdent as $val)
                               <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_perfoIdent)){{ $val->emp_id}}@endif">
                               @php $i++; @endphp
                              @endforeach 
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Signature</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employee</td>
                                        <input type="hidden" name="user_role[]" value="Employee">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent[0])){{$add_perfoIdent[0]['name']}} @endif" readonly></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent[0])){{$add_perfoIdent[0]['signature']}} @endif" readonly></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control datetimepicker" name="date[]" value="@if(isset($add_perfoIdent[0])){{$add_perfoIdent[0]['date']}} @endif" readonly></div></td>
                                    </tr>
                                    <tr>
                                        <td>Manager</td>
                                        <input type="hidden" name="user_role[]" value="Manager">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent[1])){{$add_perfoIdent[1]['name']}} @endif"></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent[1])){{$add_perfoIdent[1]['signature']}} @endif"></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control datetimepicker" name="date[]" value="@if(isset($add_perfoIdent[1])){{$add_perfoIdent[1]['date']}} @endif"></div></td>
                                    </tr>
                                     
                                </tbody>
                            </table>
                            <div class="review-header text-center">
									<button type="submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
         	 
       

		<!-- Bootstrap Core JS -->
        <script src="{{ URL::asset('js/popper.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

		<!-- Slimscroll JS -->
		<script src="{{ URL::asset('js/jquery.slimscroll.min.js') }}"></script>
		
		<!-- Select2 JS -->
		<script src="{{ URL::asset('js/select2.min.js') }}"></script>

		<!-- Custom JS -->
		 
		
    </body>
</html>     
		 
		 
		 
    </body>
</html>
 