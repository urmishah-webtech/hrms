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
                            <h3 class="page-title">Location</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Location</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_location"><i class="fa fa-plus"></i> Add Location</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        
                        <div class="alert alert-danger alert-block locationError" style="display:none">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>You can not delete this location because it belongs to some employee</strong>
                        </div>
                        <div>
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Location Name</th>
                                        <th>Last Updated</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($depts)
                                        @foreach($depts as $val)
                                            <tr class="trTag">
                                                <td>{{$val->id}}</td>
                                                <td class="tdTag">{{ $val->name }}</td>
                                                <td class="tdTag">{{ $val->updated_at }}</td>
                                                <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item editBtn" href="#" data-toggle="modal" data-id="{{ $val->id }}" data-target="#edit_location" ><i class="fa fa-pencil m-r-5" ></i><span > Edit</span></a>
                                                        <a class="dropdown-item  delLocBtn" href="#" data-toggle="modal" data-id="{{ $val->id }}" data-target="#delete_location"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Location Modal -->
            <div id="add_location" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_location') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Location Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Location Modal -->
            
            <!-- Edit Location Modal -->
            <div id="edit_location" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('edit_location') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Location Name <span class="text-danger">*</span></label>
                                    <input class="form-control" value="" type="text" name="name" required id="editDeptText">
                                    <input class="form-control" value="" type="hidden" required name="id" id="editDeptId">
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Location Modal -->

            <!-- Delete Location Modal -->
            <div class="modal custom-modal fade" id="delete_location" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Location</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn deleteLocCont" data-id="">Delete</a>
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
            <!-- /Delete Location Modal -->
            
        </div>
        <!-- /Page Wrapper -->
@endsection
 