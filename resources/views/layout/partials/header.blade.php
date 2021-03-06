<?php use App\Notification;
    $theme_setting=DB::table('theme_settings')->first();
    $setting=DB::table('settings')->first();
?>
<div class="header">
			<?php 
            $role=Auth::user()->role_id;
            if($role==3){
                $logo_url= url('employee-dashboard');
            }
            else{
                $logo_url=url('index');
            }
            ?>
            <!-- Logo -->
            <div class="header-left">
                <a href="{{ $logo_url }}" class="logo">
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
                <h3>
                    @if($setting!=null)
                    @if($setting->company_name==null)
                    Dreamguy's Technologie1s
                    @else
                        {{ $setting->company_name }}
                    @endif</h3>
                    @else
                        Dreamguy's Technologie1s1
                    @endif
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
                $notifications =  getnotifications(auth()->user()->id); 
                $notifications_read =  Notification::where('employeeid', Auth::id())->where('read_at',0)->get(); 
            @endphp
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill" id="noti-badge"> {{count($notifications_read)}}</span>
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
                                        <a href="@if($item->slug)/{{@$item->slug}} @endif">
                                            <div class="media">
                                                <span class="avatar">
                                                    <img alt="" src="{{ url('/').'/img/profiles/avatar-02.jpg'}}">
                                                </span>
                                                <div class="media-body">
													 <form action="{{ route('add_read_notification_status') }}" method="post">
													 @csrf
													 <input type="hidden" name="emp_id" value="{{@$item->employeeid}}" >
													 <input type="hidden" name="read_at" value="1" id="read_at">
													 <input type="hidden" name="created_at" value="{{@$item->created_at}}" >
                                                   <p class="noti-details">
													<span > <button class="@if($item->read_at == 1) read_noti_title @else noti-title @endif" type="submit">{{$item->message}} </button></span> </p> 
                                                    <p class="noti-time"><span class="notification-time">{{date('d-m-Y H:i', strtotime($item->created_at))}}</span></p>
													</form>
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
                            <a href="/activities">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->
                
                <!-- Message Notifications -->
               <!-- <li class="nav-item dropdown">
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
                <?php
                $id=Auth::id();
                ?>
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="{{ url('/').'/img/profiles/avatar-21.jpg'}}" alt="">
                        <span class="status online"></span></span>
                        <span>{{ Auth::user()->first_name }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('profile').'/'.$id }}">My Profile</a>
                        @if(Auth::user()->role_id != 3)<a class="dropdown-item" href="{{ url('settings') }}">Settings</a>@endif
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
                    <a class="dropdown-item" href="{{ url('settings') }}">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
            
        </div>
<style>
.noti-title{border: none; background: none; text-align: left;}
.read_noti_title{border: none; background: none; color: #989c9e;text-align: left;}
</style>