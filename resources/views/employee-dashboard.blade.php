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
                                            @if(!empty($all_all_warning) && count($all_all_warning) > 0)
                                            @foreach($all_all_warning as $val)
                                             <?php  $admin_comments_first_json = json_decode($val->admin_comments_first); 
                                                    $areas_for_improvement_first_json = json_decode($val->areas_for_improvement_first); 
                                                    $hr_input_first_json = json_decode($val->hr_input_first); 
                                                    $employee_documents_json = json_decode($val->employee_documents_first); 

                                                    $employee_documents_second_json = json_decode($val->admin_comments_second); 
                                                    $areas_for_improvement_second_json = json_decode($val->areas_for_improvement_second); 
                                                    $hr_input_second_json = json_decode($val->hr_input_second); 
                                                    $employee_documents_second_json = json_decode($val->employee_documents_second); 
                                                 
                                                    $employee_documents_third_json = json_decode($val->employee_documents_third); 
                                                    $admin_comments_third_json = json_decode($val->admin_comments_third); 
                                                    $areas_for_improvement_third_json = json_decode($val->areas_for_improvement_third); 
                                                    $hr_input_third_json = json_decode($val->hr_input_third);
                                             ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>@if($val->warmingstatus == 1) First @endif @if($val->warmingstatus == 2) Second @endif @if($val->warmingstatus == 3) Third @endif</td>
                                                <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                                <td class="text-center">
                                                    <div class="action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded">
                                                            <i class="fa fa-dot-circle-o @if(@$val->status== '0')text-success @else text-danger @endif"></i> @if(@$val->status== '1') Active @else Withdraw @endif
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            @endif
                                            @if(count($all_all_warning) == 0)
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
