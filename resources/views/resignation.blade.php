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
                            <h3 class="page-title">Resignation</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Resignation</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            @if ($check)
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_resignation"><i class="fa fa-plus"></i> Add Resignation</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive1">
                            <table class="table table-striped custom-table mb-0 datatable" id="resignation-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Resigning Employee </th>
                                        <th>Department </th>
                                        <th>Reason </th>
                                        <th>Notice Date </th>
                                        <th>Resignation Date </th>
                                        <th>Status </th>
                                        <!--<th>Decision By </th>-->
                                        @if (!empty($role) && ($role == 1 || $role==5))
                                            <!-- <th>2 Weeks Notice</th>-->
                                            <!-- <th>Rehireable</th>-->
                                            <th class="text-right">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                   @if (!empty($data))
                                       @foreach ($data as $key => $item)
                                       <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <h2 class="table-avatar blue-link">
                                                {{-- <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a> --}}
                                                <a href="{{route('profile_details', $item->employeeid)}}">{{optional($item->employee)->first_name}} {{optional($item->employee)->last_name}}</a>
                                            </h2>
                                        </td>
                                        <td>{{optional($item->getdepartment)->name}}</td>
                                        <td>{{$item->reason}}</td>
                                        <td>{{$item->noticedate}}</td>
                                        <td>{{$item->resignationdate}}</td>
                                        <td>{{$item->status}}</td>
                                       <!-- <td>{{optional($item->decisionmaker)->first_name}} {{optional($item->decisionmaker)->last_name}}</td>-->
                                        @if (!empty($role) && ($role == 1 || $role==5))
                                           <!--  <td>{{$item->twoweeknotice}}</td>-->
                                           <!--  <td>{{$item->rehireable}}</td>-->
                                            @if($item->employeeid != auth()->user()->id)
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item editresignationlink" href="#" data-toggle="modal" data-target="#edit_resignation" data-id="{{$item->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item deleteresignationlink" href="#" data-toggle="modal" data-target="#delete_resignation" data-id="{{$item->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{route('termination.openCreateForm', $item->id)}}"> Termination</a>
                                                    </div>
                                                </div>
                                            </td>
                                            @endif
                                        @endif
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

            <!-- Add Resignation Modal -->
            <div id="add_resignation" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Resignation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('add-resignation')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Resigning Employee <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{auth()->user()->first_name}} {{auth()->user()->last_name}}" readonly>
                                    <input type="hidden" name="employeeid" class="form-control" value="{{auth()->user()->id}}">
                                </div>
                                <div class="form-group">
                                    <label>Notice Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="noticedate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Resignation Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="resignationdate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Reason <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" name="reason"></textarea>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Resignation Modal -->
            
            <!-- Edit Resignation Modal -->
            <div id="edit_resignation" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Resignation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('update-resignation')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Resigning Employee <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="resemployee" readonly>
                                    <input type="hidden" name="employeeid" id="resemployeeid">
                                    <input type="hidden" name="decisionby" id="resdecisionby">
                                    <input type="hidden" name="id" id="resid">
                                </div>
                                <div class="form-group">
                                    <label>Notice Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="noticedate" id="resnoticedate" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Resignation Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="resignationdate" id="resresignationdate" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Reason <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" readonly id="resreason" name="reason"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" id="resstatus" class="select">
                                        <option value="">--Select--</option>
                                        <option value="Approved">Approve</option>
                                        <option value="Disapproved">Disapprove</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>2 Weeks Notice <span class="text-danger">*</span></label>
                                    <select name="twoweeknotice" id="res2weeknotice" class="select">
                                        <option value="">--Select--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Rehireable <span class="text-danger">*</span></label>
                                    <select name="rehireable" id="resrehireable" class="select">
                                        <option value="">--Select--</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Resignation Modal -->
            
            <!-- Delete Resignation Modal -->
            <div class="modal custom-modal fade" id="delete_resignation" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{route('delete-resignation')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="deleteresignationid">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Resignation</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary continue-btn" style="width:100%">Delete</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Delete Resignation Modal -->
        
        </div>
        <!-- /Page Wrapper -->
@endsection