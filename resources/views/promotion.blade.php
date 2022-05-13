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
                            <h3 class="page-title">Promotion</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Promotion</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            @if (auth()->user()->role_id != 3)
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_promotion"><i class="fa fa-plus"></i> Add Promotion</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        
                            <!-- Promotion Table -->
                            <table class="table table-striped custom-table mb-0 datatable" id="promotion-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Promoted Employee </th>
                                        <th>Department</th>
                                        <th>Promotion Designation From </th>
                                        <th>Promotion Designation To </th>
                                        <th>Promotion Date </th>
                                        @if (auth()->user()->role_id != 3)
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
                                            <td>{{optional($item->desfrom)->name}}</td>
                                            <td>{{optional($item->desto)->name}}</td>
                                            <td>{{date('F j, Y', strtotime($item->date))}}</td>
                                            @if (auth()->user()->role_id != 3)
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item editpromotionlink" href="#" data-toggle="modal" data-target="#edit_promotion" data-id="{{$item->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item deletepromotionlink" href="#" data-toggle="modal" data-target="#delete_promotion" data-id="{{$item->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <!-- /Promotion Table -->
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Promotion Modal -->
            <div id="add_promotion" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Promotion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('add-promotion')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Promotion For <span class="text-danger">*</span></label>
                                    <select name="employeeid" id="promotionemployeeid" class="select">
                                        <option value="">--Select--</option>
                                        @if (!empty($employees))
                                            @foreach ($employees as $emp)
                                                <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Promotion From <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="promotionfrom" readonly>
                                    <input type="hidden" id="promotionfromid" name="promotionform">
                                    <input type="hidden" id="promotiondepartment" name="department">
                                </div>
                                <div class="form-group">
                                    <label>Promotion To <span class="text-danger">*</span></label>
                                    <select class="select" id="promotionto" name="promotionto">
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Promotion Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="date">
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
            <!-- /Add Promotion Modal -->
            
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
                                        <button type="submit" class="btn btn-primary continue-btn" style="width: 100%;">Delete</button>
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
        
        </div>
        <!-- /Page Wrapper -->
@endsection