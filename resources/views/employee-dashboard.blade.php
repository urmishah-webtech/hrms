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
                                <h3>Welcome {{Auth::user()->first_name}}</h3>
                                <p>Monday, 20 May 2019</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-table">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Employees Warning</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-nowrap custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Warning Stage</th>
                                                <th>Date</th>
                                               <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @php $i = 1; @endphp
                                            <!---withdraw---->
                                            @if(!empty($third_withdraw) && count($third_withdraw) > 0)
                                            @foreach($third_withdraw as $val)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>Third</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded">
                                                            <i class="fa fa-dot-circle-o text-success"></i>Withdraw 
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr> 
                                            @php $i++; @endphp   
                                            @endforeach
                                                                                          
                                            @elseif(!empty($second_withdraw) && count($second_withdraw) > 0)
                                            @foreach($second_withdraw as $val)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>Second</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded" >
                                                            <i class="fa fa-dot-circle-o text-success"></i>Withdraw
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            
                                            @elseif(!empty($first_withdraw) && count($first_withdraw) > 0)
                                            @foreach($first_withdraw as $val)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>First</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded" >
                                                            <i class="fa fa-dot-circle-o text-success"></i>Withdraw
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach                                             
                                            @else
                                            @endif
                                            <!--- warning--->
                                            @if(!empty($third_war) && count($third_war) > 0)
                                            @foreach($third_war as $val)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>Third</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded" >
                                                            <i class="fa fa-dot-circle-o text-danger"></i>Active  
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            @elseif(!empty($second_war) && count($second_war) > 0)
                                            @foreach($second_war as $val)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>Second</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded" >
                                                            <i class="fa fa-dot-circle-o text-danger"></i>Active  
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            @elseif(!empty($first_war) && count($first_war) > 0)
                                            @foreach($first_war as $val)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>First</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded" >
                                                            <i class="fa fa-dot-circle-o text-danger"></i>Active  
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            @else
                                            @endif
                                            <!--- termination --->
                                            @if(!empty($terminate_emp) && count($terminate_emp) > 0)
                                            @foreach($terminate_emp as $val)
                                            <tr>
                                                <td>{{$i}} </td>
                                                <td>Fourth</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded">
                                                            <i class="fa fa-dot-circle-o text-danger"></i>Termination 
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr> @php $i++; @endphp
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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