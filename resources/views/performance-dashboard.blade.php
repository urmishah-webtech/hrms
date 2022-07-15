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
                    <h3 class="page-title">Performance Dashboard</h3>
                    
                </div>
            </div>
        </div>
          
			@if(auth::user()->role_id ==  1 || auth::user()->role_id == 5)
			<div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employes To Be Reviewed </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        
                                        <th>Performance Date</th> 
                                    </tr>
                                </thead>   
                                <tbody>
                                    @isset($manger_emp)
                                    @foreach ($manger_emp as $item)
                                    <tr>
                                        <td>  
                                            <h2><a href="edit-performance/{{@$item->id}}/{{@$item->perfomance_date}}">{{ @$item->first_name }} </a></h2>
                                        </td>
										<td>  
                                            <h2><a href="{{route('profile_details', @$item->id)}}">  {{ @$item->last_name }}</a></h2>
                                        </td>
                                       
                                        <td>{{@$item->perfomance_date}}</td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			@endif
			@if(Auth::user()->role_id == 2)
			<div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employess To Be Reviewed</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Performance Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($pending_emp)
                                    @foreach ($pending_emp as $item)
                                    <tr>
                                        <td>  
                                            <h2><a href="edit-performance/{{@$item->id}}/{{$item->perfomance_date}}">{{ @$item->first_name }} </a></h2>
                                        </td>
										<td>  
                                            <h2><a href="{{route('profile_details', @$item->id)}}">  {{ @$item->last_name }}</a></h2>
                                        </td>
                                        <td>{{@$item->perfomance_date}}</td>

                                         
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>
			@endif
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
