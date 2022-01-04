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
                            <h3 class="page-title">Termination</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Termination</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_termination"><i class="fa fa-plus"></i> Add Termination</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Terminated Employee </th>
                                        <th>Department</th>
                                        <th>Termination Type </th>
                                        <th>Termination Date </th>
                                        <th>Reason</th>
                                        <th>Notice Date </th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($terminations)
                                    @foreach($terminations as $termination)
                                    <tr>
                                        <td>{{$termination->id}}</td>
                                        <td>
                                            <h2 class="table-avatar blue-link">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{$termination->employee->first_name}} {{$termination->employee->last_name}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$termination->employee->department->name}}</td>
                                        <td>{{$termination->type}}</td>
                                        <td>{{date('d M Y', strtotime($termination->termination_date))}}</td>
                                        <td>{{$termination->reason}}</td>
                                        <td>{{date('d M Y', strtotime($termination->notice_date))}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a id="editForm" class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_termination" data-id="{{$termination->id}}" data-employee_id="{{$termination->employee_id}}" data-type="{{$termination->type}}" data-termination_date="{{$termination->termination_date}}" data-reason="{{$termination->reason}}" data-notice_date="{{$termination->notice_date}}" >
                                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a id="deleteForm" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_termination" data-id="{{$termination->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                </div>
            </div>
            <!-- /Page Content -->

            <!-- Add Termination Modal -->
            <div id="add_termination" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Termination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('termination.save')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Terminated Employee <span class="text-danger">*</span></label>
                                    
                                    <select class="select" name="employee_id">
                                        @if($employees)
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Termination Type <span class="text-danger">*</span></label>
                                    <div class="add-group-btn">
                                        <select class="select" name="type">
                                            @if($types)
                                            @foreach($types as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                            @endforeach
                                            @endif
                                            
                                        </select>
                                        <a class="btn btn-primary" href="{{route('termination-type')}}"><i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Termination Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="termination_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Reason <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" name="reason"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Notice Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="notice_date">
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
            <!-- /Add Termination Modal -->
            
            <!-- Edit Termination Modal -->
            <div id="edit_termination" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Termination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('termination.update')}}">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label>Terminated Employee <span class="text-danger">*</span></label>
                                    <select class="select" name="employee_id" id="employee_id">
                                        @if($employees)
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Termination Type <span class="text-danger">*</span></label>
                                    <div class="add-group-btn">
                                        <select class="select" name="type">
                                            @if($types)
                                            @foreach($types as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                            @endforeach
                                            @endif
                                            
                                        </select>
                                        <a class="btn btn-primary" href="javascript:void(0);"><i class="fa fa-plus"></i> Add</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Termination Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" value="28/02/2019" name="termination_date" id="termination_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Reason <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" name="reason" id="reason"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Notice Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="notice_date" id="notice_date">
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Termination Modal -->
            
            <!-- Delete Termination Modal -->
            <div class="modal custom-modal fade" id="delete_termination" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Termination</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a id="delete_url" href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
            <!-- /Delete Termination Modal -->
        
        </div>
        <!-- /Page Wrapper -->
@endsection
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>

<script type="text/javascript">
        $(document).ready(function () {

            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en'
            });
        
            
            $('body').on('click', '#editForm', function (event) {

                event.preventDefault();
                $('#id').val($(this).data('id'));
                $('#termination_date').val($(this).data('termination_date'));
                $('#reason').val($(this).data('reason'));
                $('#notice_date').val($(this).data('notice_date'));
                $('#employee_id').val($(this).data('employee_id')).change();
                $('#type').val($(this).data('type')).change();
               
            });

            $('body').on('click', '#deleteForm', function (event) {

                event.preventDefault();
                var id = $(this).data('id');
                $('#delete_url').attr("href", '/delete-termination/'+id); 
               
            });
        });

    </script>