<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
		<?php
			$theme_setting=DB::table('theme_settings')->first();
			$setting=DB::table('settings')->first();

		?>
		@if($theme_setting)
		@if($theme_setting->website_name!=null)
		<title>Settings - {{ @$theme_setting->website_name }}</title>
		@else
		<title>Settings - HRMS admin template</title>
		@endif
		@else
		<title>Settings - HRMS admin template</title>
		@endif
        
		<!-- Favicon -->
		
		@if($theme_setting)
			@if($theme_setting->favicon!=null)
			<link rel="shortcut icon" type="image/x-icon" href="{{ url('/').'/setting_images/'.@$theme_setting->favicon }}">
			@else
			<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
			@endif
		@else
			<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		@endif
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ url('css/line-awesome.min.css') }}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ url('css/select2.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('css/style.css') }}">
	
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="index" class="logo">
						@isset($theme_setting)
						@if($theme_setting->light_logo!=null)
						<img src="{{ url('/').'/setting_images/'.@$theme_setting->light_logo }}" alt="" width="150px" height="auto">
						@else
						<img src="{{ url('/').'/img/logo.png'}}" alt="" width="40" height="40">
						@endif
						@else
						<img src="{{ url('/').'/img/logo.png'}}" alt="" width="40" height="40">
						@endif
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
					<h3>{{ @$setting->company_name }}</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					{{-- <li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li> --}}
					<!-- /Search -->
				
					<!-- Flag -->
					{{-- <li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<img src="img/flags/us.png" alt="" height="20"> <span>English</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="img/flags/us.png" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="img/flags/fr.png" alt="" height="16"> French
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="img/flags/es.png" alt="" height="16"> Spanish
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="img/flags/de.png" alt="" height="16"> German
							</a>
						</div>
					</li> --}}
					<!-- /Flag -->
					@php
                	$notifications = getnotifications(auth()->user()->id);
            		@endphp
					<!-- Notifications -->
					<li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill" id="noti-badge">{{count($notifications)}}</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                @if (!empty($notifications))
                                    @foreach ($notifications as $item)
                                    <li class="notification-message">
                                        <a href="activities">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="{{ url('/').'/img/profiles/avatar-02.jpg'}}">
                                                </span>
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">{{$item->message}}</span> </p>
                                                    <p class="noti-time"><span class="notification-time">{{date('d-m-Y H:i', strtotime($item->created_at))}}</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                                {{-- <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{ url('/').'/img/profiles/avatar-03.jpg'}}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities">View all Notifications</a>
                        </div>
                    </div>
                </li> 
					<!-- /Notifications -->
					
					<!-- Message Notifications -->
					<!--<li class="nav-item dropdown">
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
									 
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="chat">View all Messages</a>
							</div>
						</div>
					</li>-->
					<!-- /Message Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img src="{{ url('/').'/img/profiles/avatar-21.jpg'}}" alt="">
							<span class="status online"></span></span>
							<span>{{ Auth::user()->first_name }}</span>
						</a>
						<div class="dropdown-menu">
							 <?php
							$id=Auth::id();
							?>
							<a class="dropdown-item" href="{{ url('profile').'/'.$id }}">My Profile</a>
							@if(Auth::user()->role_id != 3)<a class="dropdown-item" href="settings">Settings</a>@endif
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
						<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
<!-- Sidebar -->

           <!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div class="sidebar-menu">
			<ul>
				<li class="{{ Request::is('index') ? 'active' : '' }}">
					@if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
					<a  href="{{ url('index') }}"><i class="la la-home"></i><span>Back to Home</span></a>
					@elseif (Auth::user()->role_id == 2)
					<a href="{{ url('index') }}"><i class="la la-home"></i><span>Back to Home</span></a>
					@else
					<a href="{{ url('employee-dashboard') }}"><i class="la la-home"></i><span>Back to Home</span></a>
					@endif
					 
				</li>							
				<li class="menu-title">Settings</li>
				<li class="{{ Request::is('settings') ? 'active' : '' }}">
					<a  href="{{ url('settings') }}"><i class="la la-building"></i><span>Company Settings</span>  </a>
				</li>
				<li class="{{ Request::is('theme-settings') ? 'active' : '' }}">
					<a  href="{{ url('theme-settings') }}"><i class="la la-photo"></i><span>Theme Settings</span>  </a>
				</li>
				@if(Auth::user()->role_id==1)
				<li class="{{ Request::is('leave-settings') ? 'active' : '' }}">
					<a  href="{{ url('leave-settings') }}"><i class="la la-photo"></i><span>Leave Settings</span>  </a>
				</li>
				@endif
				<li class="{{ Request::is('roles-permissions') ? 'active' : '' }}">
					<a  href="{{ url('roles-permissions') }}"><i class="la la-key"></i> <span>Roles & Permissions</span>  </a>
				</li>
				<li class="{{ Request::is('email-settings') ? 'active' : '' }}">
					<a  href="{{ url('email-settings') }}"><i class="la la-at"></i><span>Email Settings</span>  </a>
				</li>
				<li class="{{ Request::is('performance-setting') ? 'active' : '' }}"> 
					<a href="{{ url('performance-setting') }}"><i class="la la-bar-chart"></i> <span>Performance Settings</span></a>
				</li>							
				<li class="{{ Request::is('notifications-settings') ? 'active' : '' }}">
					<a  href="{{ url('notifications-settings') }}"><i class="la la-globe"></i><span>Notifications</span>  </a>
				</li>
				<li class="{{ Request::is('change-password') ? 'active' : '' }}">
					<a  href="{{ url('change-password') }}"><i class="la la-lock"></i><span>Change Password</span>  </a>
				</li>
				<li class="{{ Request::is('termination-type') ? 'active' : '' }}">
					<a  href="{{ url('termination-type') }}"><i class="la la-cogs"></i><span>Termination Type</span>  </a>
				</li>
			</ul>
		</div>
	</div>
</div>
 		<!-- Sidebar -->
