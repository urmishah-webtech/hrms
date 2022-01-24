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
                                {{-- <p>{{ Auth::user()->designation()->name }}</p> --}}
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
                                            @if(count($third_withdraw) == 0 && count($third_war)==0 && count($second_withdraw)==0 && count($second_war)==0 && count($first_withdraw)==0 && count($first_war)==0 && count($terminate_emp)==0)
                                               <tr> <td colspan="4" style="text-align: center;">No Data Found<td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>

                    </div>
                    @include('employee_dashboard.working_history_and_performance')
                    @include('employee_dashboard.leave')
                   
                    @if(!empty($resignation) && count($resignation) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-table">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Employees Resignation</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap custom-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Resignation Reason</th>
                                                    <th>Notice Date</th>
                                                    <th>Resignation Date</th>
                                                   <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($resignation as $res)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{@$res->reason}}</td>
                                                    <td>{{@$res->noticedate}}</td>
                                                    <td>{{@$res->resignationdate}}</td>
                                                    <td>{{@$res->status}}</td>
                                                </tr>
                                                <?php $i++ ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="load-more text-center" style="margin: 10px">
                                            <a class="text-dark" href="{{ url('resignation') }}">View all</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
 
                        </div> 
 
                        
                    </div>
                    {{-- @else
                    <p>No Data Available</p> --}}
                    @endif
                </div>

            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
@endsection
