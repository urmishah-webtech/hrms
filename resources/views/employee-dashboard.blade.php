@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-box">
                            <div class="welcome-img">
                                <img alt="" src="img/profiles/avatar-02.jpg">
                            </div>
                            <div class="welcome-det">
                                <h3>Welcome {{Auth::user()->name}}</h3>
                                <p>Monday, 20 May 2019</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <section class="dash-section">
                            <h1 class="dash-sec-title">Today</h1>
                            <div class="dash-sec-content">
                                <div class="dash-info-list">
                                    <a href="#" class="dash-card text-danger">
                                        <div class="dash-card-container">
                                            <div class="dash-card-icon">
                                                <i class="fa fa-hourglass-o"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p>Richard Miles is off sick today</p>
                                            </div>
                                            <div class="dash-card-avatars">
                                                <div class="e-avatar"><img src="img/profiles/avatar-09.jpg" alt=""></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="dash-info-list">
                                    <a href="#" class="dash-card">
                                        <div class="dash-card-container">
                                            <div class="dash-card-icon">
                                                <i class="fa fa-suitcase"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p>You are away today</p>
                                            </div>
                                            <div class="dash-card-avatars">
                                                <div class="e-avatar"><img src="img/profiles/avatar-02.jpg" alt=""></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="dash-info-list">
                                    <a href="#" class="dash-card">
                                        <div class="dash-card-container">
                                            <div class="dash-card-icon">
                                                <i class="fa fa-building-o"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p>You are working from home today</p>
                                            </div>
                                            <div class="dash-card-avatars">
                                                <div class="e-avatar"><img src="img/profiles/avatar-02.jpg" alt=""></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </section>

                        <section class="dash-section">
                            <h1 class="dash-sec-title">Tomorrow</h1>
                            <div class="dash-sec-content">
                                <div class="dash-info-list">
                                    <div class="dash-card">
                                        <div class="dash-card-container">
                                            <div class="dash-card-icon">
                                                <i class="fa fa-suitcase"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p>2 people will be away tomorrow</p>
                                            </div>
                                            <div class="dash-card-avatars">
                                                <a href="#" class="e-avatar"><img src="img/profiles/avatar-04.jpg" alt=""></a>
                                                <a href="#" class="e-avatar"><img src="img/profiles/avatar-08.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
 
                    </div>
 
                </div>

            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
@endsection