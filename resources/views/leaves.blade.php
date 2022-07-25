@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Leaves</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Leaves</li>
                            </ul>
                        </div>
                        {{-- @if(Auth::user()->role_id!=1)
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
                        </div>
                        @endif --}}
                    </div>
                </div>
                <!-- /Page Header -->
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <!-- Leave Statistics -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Today Presents</h6>
                            <h4>{{@$present_emp}} / {{@$total_emp}}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Planned Leaves</h6>
                            <h4>{{@$plan_count}} <span>Today</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Unplanned Leaves</h6>
                            <h4>{{@$unplan_count}} <span>Today</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Pending Requests</h6>
                            <h4>{{@$pending_req}}</h4>
                        </div>
                    </div>
                </div>
                <!-- /Leave Statistics -->
                
                <!-- Search Filter -->
                <form action="{{ route('search_leave_employees') }}" method="post">
                @csrf
                <div class="row filter-row">
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus select-focus">
                        <select class="form-control" name="search_employee_name"> 
                            <option value="">-- Select --</option>
                            @isset($employee_tb)
                                @foreach ($employee_tb as $item)
                                <option value="{{ $item->id }}" @if(@$search_employee_name==$item->id ) selected @endif>{{ $item->first_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                            <label class="focus-label">Employee Name</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="search_leave_type">
                                <option value="">-- Select --</option>
                                <option value="0"  @if(@$search_leave_type=='0') selected @endif>Casual Leave</option>
                                <option value="1" @if(@$search_leave_type==1) selected @endif>Sick Leave</option>
                                <option value="2" @if(@$search_leave_type==2) selected @endif>Hospitalisation</option>
                                <option value="3" @if(@$search_leave_type==3) selected @endif>Maternity</option>
                                <option value="4" @if(@$search_leave_type==4) selected @endif>Paternity</option>
                                <option value="5" @if(@$search_leave_type==5) selected @endif>Lop</option>
                            </select>
                            <label class="focus-label">Leave Type</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="search_leave_status"> 
                                <option value=""> -- Select -- </option>
                                <option value="1" @if(@$search_leave_status==1) selected @endif>Pending</option>
                                <option value="2" @if(@$search_leave_status==2) selected @endif>Approved </option>
                                <option value="3" @if(@$search_leave_status==3) selected @endif>Disapproved </option>
                            </select>
                            <label class="focus-label">Leave Status</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                            <input class="form-control floating datetimepicker"  type="text" name="search_from_date"  value="{{@$search_from_date}}" id="fromt_date">
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="search_to_date" value="{{@$search_to_date}}">
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                   <input type="submit" class="btn btn-success btn-block" value="search">  
                   </div>     
                </div>
                </form>
                <!-- /Search Filter -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive1">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>No of Days</th>
                                        <th>Reason</th>
                                        <th class="text-center">Status</th>
										 <th>Manager Comment</th>
                                        {{-- <th class="text-right">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(!empty($data))
                                            @foreach ($data as $val)
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-09.jpg"></a>
                                                            {{ @$val->employee->first_name }} <br>
                                                            <span>{{ @$val->employee->designation->name }}</span>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        @if(@$val->leave_type_id==0)
                                                        Casual Leave
                                                        @elseif(@$val->leave_type_id==1)
                                                        Sick Leave
                                                        @elseif(@$val->leave_type_id==2)
                                                        Hospitalisation
                                                        @elseif(@$val->leave_type_id==3)
                                                        maternity leave
                                                        @elseif(@$val->leave_type_id==4)
                                                        paternity leave
                                                        @else
                                                        Loss Of pay
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ @$val->from_date }}
                                                    </td>
                                                    <td>
                                                        {{ @$val->to_date }}
                                                    </td>
                                                    <td>
                                                        {{ @$val->number_of_days }} 
                                                    </td>
                                                    <td>
                                                        {{ @$val->leave_reason }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown action-label">
                                                            @if(@$val->status==1)
                                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-dot-circle-o text-purple"></i> pending
                                                            </a>
                                                            @elseif(@$val->status==2)
                                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-dot-circle-o text-success"></i> Approved
                                                            </a>
                                                            @else
                                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-dot-circle-o text-purple"></i> Disapproved
                                                            </a>
                                                            @endif
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ url('change_leave_status').'/1'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
                                                                <a class="dropdown-item" href="{{ url('change_leave_status').'/2'.'/'.@$val->id  }}"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                                                <a class="dropdown-item disapproved"  data-id="{{@$val->id}}" data-comment="{{@$val->manager_comment}}"><i class="fa fa-dot-circle-o text-danger"></i> Disapproved</a>
                                                                <!--<a class="dropdown-item disapproved" href="{{ url('change_leave_status').'/3'.'/'.@$val->id  }}"><i class="fa fa-dot-circle-o text-danger"></i> Disapproved</a>-->
                                                            </div>
                                                        </div>
                                                    </td>
													<td>
													@if(@$val->status == 3)
													<a href="">{{@$val->manager_comment}}</a>
													<a href="#" id="man_comment_edit" class="edit-icon edit_personal_info" data-toggle="modal" data-target="#personal_info_modal" data-id="{{@$val->id}}" data-comment="{{@$val->manager_comment}}"><i class="fa fa-pencil"></i></a>
													@endif
													</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                
                                        {{-- <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Leave Modal -->
            <div id="add_leave" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            @if(Auth::user()->role_id!=1)
                            <h5 class="modal-title">Add Leave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @endif
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Leave Type <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select Leave Type</option>
                                        <option>Casual Leave 12 Days</option>
                                        <option>Medical Leave</option>
                                        <option>Loss of Pay</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>From <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>To <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Number of days <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly type="text">
                                </div>
                                <div class="form-group">
                                    <label>Remaining Leaves <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly value="12" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Leave Reason <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control"></textarea>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Leave Modal -->
            
            <!-- Edit Leave Modal -->
            <div id="edit_leave" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Leave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Leave Type <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select Leave Type</option>
                                        <option>Casual Leave 12 Days</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>From <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" value="01-01-2019" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>To <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" value="01-01-2019" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Number of days <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly type="text" value="2">
                                </div>
                                <div class="form-group">
                                    <label>Remaining Leaves <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly value="12" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Leave Reason <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control">Going to hospital</textarea>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Leave Modal -->

            <!-- Approve Leave Modal -->
            <div class="modal custom-modal fade" id="approve_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Leave Approve</h3>
                                <p>Are you sure want to approve for this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Decline</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Approve Leave Modal -->
            
            <!-- Delete Leave Modal -->
            <div class="modal custom-modal fade" id="delete_approve" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Leave</h3>
                                <p>Are you sure want to delete this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Leave Modal -->
            
        </div>
        <!-- /Page Wrapper -->
      <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Manager Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_manager_comment') }}" method="post">
							@csrf
								 
								<input type="hidden" name="id" value="" id="hidden_id">
								 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Reason</label>
											<textarea name="manager_comment" class="form-control" id="man_comment_text"></textarea> 
                                        </div>
                                    </div> 
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
 
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script> 
<script type="text/javascript">
$(document).ready(function () {
	$('.datetimepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'en'
	});
});
$(document).on("click","#man_comment_edit",function() {
	var id= $(this).data('id');
	var comment=$(this).data('comment');
	$('#hidden_id').val(id);
	$('#man_comment_text').val(comment);
});
$(document).on("click",".disapproved",function() {
	$("#personal_info_modal").addClass("show");
	$("#personal_info_modal").css("display","block");
	$("#personal_info_modal").css("padding-right","17px");
	var id= $(this).data('id');
	var comment=$(this).data('comment');
	$('#hidden_id').val(id);
	$('#man_comment_text').val(comment);
});

</script>
@endsection    