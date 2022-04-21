@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="alert alert-danger alert-block overlap_error" style="display: none">
                    <button type="button" class="close" data-dismiss="alert">×</button>      
                   <div>Please make proper date selection , you have already applied on the same date</div>
                </div>
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
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Leave Statistics -->
                @include('leave.employee.statistics')
                <!-- /Leave Statistics -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>No of Days</th>
                                        <th>Reason</th>
                                        <th class="text-center">Status</th>
                                        <th>Approved by</th>
                                        <th>Manager Comments</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($data))
                                    @foreach ($data as $val)
                                        <tr>
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
                                                <div class="action-label">
                                                    @if($val->status==1)
                                                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                        <i class="fa fa-dot-circle-o text-purple"></i> pending
                                                    </a>
                                                    @elseif($val->status==2)
                                                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                        <i class="fa fa-dot-circle-o text-success"></i> Apprroved
                                                    </a>
                                                    @else
                                                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                        <i class="fa fa-dot-circle-o text-danger"></i> disapproved
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile" class="avatar avatar-xs"><img src="img/profiles/avatar-09.jpg" alt=""></a>
                                                    <a href="#">{{ @$my_manager_name->first_name }}</a>
                                                    @empty($my_manager_name)
                                                        Admin
                                                    @endempty
                                                </h2>
                                            </td>
                                            <td>{{@$val->manager_comment}}</td>
                                            <td class="text-right">
                                                @if($val->status==1)
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        
                                                        <a class="dropdown-item edtBtn" href="{{ url('edit_emp_leave').'/'.$val->id }}"   data-id="{{ @$val->id }}" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item delBtn" data-id="{{ @$val->id }}" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                       
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>No Data</td>
                                    <tr>
                                    @endif     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
           
            <!-- Add Leave Modal -->
            @include('leave.employee.add_leave')
            <!-- /Add Leave Modal -->
            
            <!-- Edit Leave Modal -->
            {{-- @include('leave.employee.edit_leave') --}}
            <!-- /Edit Leave Modal -->
            
            <!-- Delete Leave Modal -->
            <div class="modal custom-modal fade" id="delete_approve" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Leave</h3>
                                <p>Are you sure want to Cancel this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="" class="btn btn-primary continue-btn">Delete</a>
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


<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script>
    $(document).on("click",".delBtn",function() {
        $(".continue-btn").attr('href', '{{ url("delete_emp_leave") }}'+'/'+$(this).data('id'));
    });
</script>
@endsection