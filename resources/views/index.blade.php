@extends('layout.mainlayout')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome {{Auth::user()->first_name}}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{@$per_status_complete}}</h3>
                            <span>Performance Complete</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{@$per_status_incomp}}</h3>
                            <span>Performance Incomplete</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{@$man_total}}</h3>
                            <span>Managers</span>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{@$terminated_emp_under_me}}</h3>
                            <span>Terminated Employees</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{@$emp_total}}</h3>
                            <span>Employees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)
        @include('percentage_stat')
        @endif

		<div class="row">

            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Leave Calendar</h3>
                        <div class="card card-transparent p-4" role="tabpanel">
                            <div class="tab-content p-0 bg-white">
                                <div class="tab-pane active home_calendar" id="home" role="tabpanel">
                                    <div class="response"></div>
                                    <div id='calendar1'></div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)

			<div class="col-md-6 text-center">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Employees Overview</h3>
						<input type="hidden" id="linechartdata" value="{{$linechartdata}}">
						<div id="line-charts-employees"></div>
					</div>
				</div>
			</div>
            @else
            <div class="col-md-6">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">My leaves</h3>
                        @isset($my_leaves)
                        @foreach($my_leaves as $val)
                        <div class="leave-info-box">
                            <div class="media align-items-center">

                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-6">
                                    <h6 class="mb-0">{{ $val->from_date }} - {{$val->to_date}}</h6>
                                    <span class="text-sm text-muted">Leave Date</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="badge @if(@$val->status==1) bg-inverse-warning @elseif(@$val->status==2) bg-inverse-success  @else bg-inverse-danger  @endif">
                                    @if(@$val->status==1)Pending
                                    @elseif(@$val->status==2)Approved
                                    @else Disapproved @endif</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                        <div class="load-more text-center">
                            <a class="text-dark" href="{{ url('leaves') }}">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
		</div>

        <!-- Statistics Widget -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill dash-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Today Leave <strong>{{$on_leave}} <small>/ {{$total_emp}}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar @if($progress_leave >= 61) bg-danger @elseif($progress_leave >= 31 || $progress_leave <= 60) bg-warning @else bg-primary @endif" role="progressbar" style="width: {{$progress_leave}}%" aria-valuenow="{{$progress_leave}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Planned Leaves <strong>{{$plan_count}} <small>/ {{$on_leave}}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar @if($plan_data >= 61) bg-danger @elseif($plan_data >= 31 || $plan_data <= 60) bg-warning @else bg-primary @endif" role="progressbar" style="width: {{$plan_data}}%" aria-valuenow="{{$plan_data}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Unplanned Leaves <strong>{{$unplan_data}} <small>/ {{$on_leave}}</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar @if($unplan_count >= 61) bg-danger @elseif($unplan_count >= 31 || $unplan_count <= 60) bg-warning @else bg-primary @endif" role="progressbar" style="width: {{$unplan_count}}%" aria-valuenow="{{$unplan_count}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Pending Requests <strong>{{$pending_req}}</strong></p>
                                <div class="progress">
                                    <div class="progress-bar @if($pending_persent >= 61) bg-danger @elseif($pending_persent >= 31 || $pending_persent <= 60) bg-warning @else bg-primary @endif" role="progressbar" style="width: {{$pending_persent}}%" aria-valuenow="{{$pending_persent}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--<div class="stats-info">
                                <p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>--->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">Personal Excellence</h4>
                        <div class="statistics">
                            <div class="row">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box mb-4">
                                        <p>Performance <br>Complete</p>
                                        <h3>{{@$per_status_complete}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box mb-4">
                                        <p>Performance Incomplete</p>
                                        <h3>{{@$per_status_incomp}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->role_id == 2)
                        <div class="progress mb-4">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: {{round($man_width_80100, 2)}}%" aria-valuenow="{{round($man_width_80100, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($man_width_80100, 2)}}%</div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{round($man_width_6079, 2)}}%" aria-valuenow="{{round($man_width_6079, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($man_width_6079, 2)}}%</div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{round($man_width_4059, 2)}}%" aria-valuenow="{{round($man_width_4059, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($man_width_4059, 2)}}%</div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{round($man_width_2039, 2)}}%" aria-valuenow="{{round($man_width_2039, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($man_width_2039, 2)}}%</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{round($man_width_119, 2)}}%" aria-valuenow="{{round($man_width_119, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($man_width_119, 2)}}%</div>
                        </div>
                        <div>
                            <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>80 -100 %<span class="float-right">{{$man_excel_80100}}</span></p>
                            <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>60 - 80 %<span class="float-right">{{$man_excel_6079}}</span></p>
                            <p><i class="fa fa-dot-circle-o text-success mr-2"></i>40 - 60 %<span class="float-right">{{$man_excel_4059}}</span></p>
                            <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>20 - 40 %<span class="float-right">{{$man_excel_2039}}</span></p>
                            <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>1 - 20 %<span class="float-right">{{$man_excel_119}}</span></p>
                        </div>
                        @else
                        <div class="progress mb-4">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: {{round($width_80100, 2)}}%" aria-valuenow="{{round($width_80100, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($width_80100, 2)}}%</div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{round($width_6079, 2)}}%" aria-valuenow="{{round($width_6079, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($width_6079, 2)}}%</div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{round($width_4059, 2)}}%" aria-valuenow="{{round($width_4059, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($width_4059, 2)}}%</div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{round($width_2039, 2)}}%" aria-valuenow="{{round($width_2039, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($width_2039, 2)}}%</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{round($width_119, 2)}}%" aria-valuenow="{{round($width_119, 2)}}" aria-valuemin="0" aria-valuemax="100">{{round($width_119, 2)}}%</div>
                        </div>
                        <div>
                            <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>80 -100 %<span class="float-right">{{$excel_80100}}</span></p>
                            <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>60 - 80 %<span class="float-right">{{$excel_6079}}</span></p>
                            <p><i class="fa fa-dot-circle-o text-success mr-2"></i>40 - 60 %<span class="float-right">{{$excel_4059}}</span></p>
                            <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>20 - 40 %<span class="float-right">{{$excel_2039}}</span></p>
                            <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>1 - 20 %<span class="float-right">{{$excel_119}}</span></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ml-2">{{$on_leave}}</span></h4>
                        @isset($on_leave_data)
                        @foreach($on_leave_data as $val)
                        <div class="leave-info-box">
                            <div class="media align-items-center">
                                <a href="profile" class="avatar"><img alt="" src="img/user.jpg"></a>
                                <div class="media-body">
                                    <div class="text-sm my-0">{{$val->employee->first_name}}</div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-6">
                                    <h6 class="mb-0">{{date('d M Y', strtotime(@$val->from_date))}} - {{date('d M Y', strtotime(@$val->to_date))}}</h6>
                                    <span class="text-sm text-muted">Leave Date</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="badge bg-inverse-danger">
                                    @if(@$val->status==1)Pending
                                    @elseif(@$val->status==2)Approved
                                    @else Disapproved @endif</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                        <div class="load-more text-center">
                            <a class="text-dark" href="{{ url('leaves') }}">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Statistics Widget -->



        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employees</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Manager Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($emp->isEmpty())
                                    @foreach ($emp as $employee)
                                    <tr>
                                        <td><a href="{{route('profile_details', @$employee->id)}}">{{$employee->employee_id}}</a></td>
                                        <td>
                                            <h2><a href="{{route('profile_details', $employee->id)}}">{{$employee->first_name}}</a></h2>
                                        </td>
                                        <?php
                                        $manager=DB::table('employees')->where('id',$employee->man_id)->first();
                                        ?>
                                        <td>{{@$manager->first_name.' '.@$manager->last_name}}</td>
                                        <td>{{@$employee->designation->department->name}}</td>
                                        <td>
                                            <span class="badge bg-inverse-warning">{{@$employee->designation->name}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('employees') }}">View all Employees</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Resignations</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Resigning Employee</th>
                                        <th>Notice Date</th>
                                        <th>Resignation Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($res->isEmpty())
                                    @foreach ($res as $resemp)
                                    <tr>
                                        <td><a href="{{route('profile_details', @$resemp->employee->id)}}">{{@$resemp->employee->first_name}}</a></td>
                                        <td>{{date('d-m-Y', strtotime($resemp->noticedate))}}</td>
                                        <td>{{date('d-m-Y', strtotime($resemp->resignationdate))}}</td>
                                        <td><span class="badge bg-inverse-warning">{{$resemp->status}}</span></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('resignation') }}">View all Resignations</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Promotions</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0" id="promotion-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Promotion From</th>
                                        <th>Promotion To</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($promotion->isEmpty())
                                    @foreach ($promotion as $item)
                                       <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{route('profile_details', $item->employeeid)}}" class="avatar"><img alt="" src="img/profiles/avatar-19.jpg"></a>
                                                <a href="{{route('profile_details', $item->employeeid)}}">{{@$item->employee->first_name}} <span>{{$item->getdepartment->name}}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{@$item->desfrom->name}}</td>
                                        <td>{{@$item->desto->name}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editpromotionlink" href="#" data-toggle="modal" data-target="#edit_promotion" data-id="{{$item->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deletepromotionlink" href="#" data-toggle="modal" data-target="#delete_promotion" data-id="{{$item->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('promotion') }}">View all Promotions</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Performance Appraisal</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Employee Name </th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Appraisal Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($appraisal->isEmpty())
                                    @foreach ($appraisal as $item)
                                    <tr>
                                        <td>
                                            <h2><a href="{{route('profile_details', @$item->employee->id)}}">{{ @$item->employee->first_name }}</a></h2>
                                        </td>
                                        <td>{{@$item->employee->designation->name}}</td>
                                        <td>{{@$item->employee->department->name}}</td>
                                        {{-- <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$item->status== '1') text-success @else text-danger @endif"></i>  @if(@$item->status== '1') Active @else Inactive @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> <input type="radio" class="list_status5_35 status1" name="status" id="status1{{ @$item->id }}"  data-id="{{ @$item->id }}" value="1"> <label for="status1{{ @$item->id }}">Active</label></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> <input type="radio" class="list_status5_35 status0" name="status" id="status0{{ @$item->id }}"  data-id="{{ @$item->id }}"  value="0"><label for="status0{{ @$item->id }}">Inactive</label></a>
                                                </div>
                                            </div>
                                         </td> --}}
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$item->status== '1') text-success @else text-danger @endif"></i>  @if(@$item->status== '1') Active @else Inactive @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{date('d-m-Y', strtotime($item->appraisal_date))}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('performance-appraisal')}}">View all Appraisals</a>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->role_id==2)
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
                                        <th>Employee Name</th>
                                        <th>Warning Stage</th>
                                        <th>Date</th>
                                    <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    <!---3 Warning and withdraw---->
                                    @if(!empty($third_withdraw) && count($third_withdraw) > 0)
                                    @foreach($third_withdraw as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$val->employee->first_name}}</td>
                                            <td>Third</td>
                                            <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded">
                                                        @if($val->status == 0) <i class="fa fa-dot-circle-o text-success"></i> Withdraw
                                                        @elseif($val->status == 1) <i class="fa fa-dot-circle-o text-danger"></i> Active @endif
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                    <!---2 Warning and withdraw---->
                                    @elseif(!empty($second_withdraw) && count($second_withdraw) > 0)
                                    @foreach($second_withdraw as $val)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$val->employee->first_name}}</td>
                                        <td>Second</td>
                                        <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" >
                                                    @if($val->status == 0) <i class="fa fa-dot-circle-o text-success"></i> Withdraw
                                                        @elseif($val->status == 1) <i class="fa fa-dot-circle-o text-danger"></i> Active @endif
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                    <!---1 Warning and withdraw---->
                                    @elseif(!empty($first_withdraw) && count($first_withdraw) > 0)
                                    @foreach($first_withdraw as $val)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$val->employee->first_name}}</td>
                                        <td>First</td>
                                        <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" >
                                                    @if($val->status == 0) <i class="fa fa-dot-circle-o text-success"></i> Withdraw
                                                    @elseif($val->status == 1) <i class="fa fa-dot-circle-o text-danger"></i> Active @endif
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                    @else
                                    @endif
                                    <!--- warning--->

                                    <!--- termination --->
                                    @if(!empty($terminate_emp) && count($terminate_emp) > 0)
                                    @foreach($terminate_emp as $val)
                                    <tr>
                                        <td>{{$i}} </td>
                                        <td>{{$val->employee->first_name}}</td>
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
                                    {{-- @if(count($third_withdraw) == 0 && count($third_war)==0 && count($second_withdraw)==0 && count($second_war)==0 && count($first_withdraw)==0 && count($first_war)==0 && count($terminate_emp)==0)
                                    <tr> <td colspan="4" style="text-align: center;">No Data Found<td></tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--<div class="row">
            <div class="col-md-12">
                <div class="card-group m-b-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">New Employees</span>
                                </div>
                                <div>
                                    <span class="text-success">+10%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">10</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Overall Employees 218</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Earnings</span>
                                </div>
                                <div>
                                    <span class="text-success">+12.5%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">$1,42,300</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month <span class="text-muted">$1,15,852</span></p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Expenses</span>
                                </div>
                                <div>
                                    <span class="text-danger">-2.8%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">$8,500</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Profit</span>
                                </div>
                                <div>
                                    <span class="text-danger">-75%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">$1,12,000</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

<!-- Edit Promotion Modal -->
<div id="edit_promotion" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('update-promotion')}}">
                    @csrf
                    <input type="hidden" id="proidforemp" name="id">
                    <div class="form-group">
                        <label>Promotion For <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="proempname" readonly>
                        <input class="form-control" type="hidden" id="proempid" name="employeeid">
                    </div>
                    <div class="form-group">
                        <label>Promotion From <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" readonly id="proempfrom">
                        <input type="hidden" id="proempfromid" name="promotionform">
                    </div>
                    <div class="form-group">
                        <label>Promotion To <span class="text-danger">*</span></label>
                        <select class="select" id="proempto" name="promotionto">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Promotion Date <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" name="date" id="proempdate">
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Promotion Modal -->

<!-- Delete Promotion Modal -->
<div class="modal custom-modal fade" id="delete_promotion" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Promotion</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="{{route('delete-promotion')}}" method="POST">
                        @csrf
                    <div class="row">
                            <input type="hidden" id="deleteproid" name="id">

                        <div class="col-6">
                            <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Promotion Modal -->

<script>

</script>
@endsection
