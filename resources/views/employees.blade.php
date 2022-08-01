@extends('layout.mainlayout')
@section('content')
<?php use Illuminate\Support\Str;
?>
<style type="text/css">
    .disabled {
    pointer-events: none;
    opacity: 0.4;
}
</style>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Employee</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employee</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            @if(Auth::user()->role_id==1 || Auth::user()->role_id == 5)
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                            @endif
                            <div class="view-icons">
                                {{-- <a href="employees" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a> --}}
                                {{-- <a href="employees-list" class="list-view btn btn-link"><i class="fa fa-bars"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <form action="{{ route('import_employees') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success">Import</button>
                        </div>
                    </div>
                    <br>
                   
                   
                </form>
                <!-- Search Filter -->
                <form action="{{ route('search_employee') }}" method="get">
                    @csrf
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group form-focus">
                                <input type="text" value="{{ @$search_employee_id }}" name="search_employee_id" class="form-control floating">
                                <label class="focus-label">Employee ID</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group form-focus">
                                <input type="text" value="{{ @$search_name }}"  name="search_name" class="form-control floating">
                                <label class="focus-label" >Employee Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus select-focus">
                                <select class="select floating" name="search_designation"> 
                                    <option value="">Select Designation</option>
                                    @isset($des)
                                        @foreach ($des as $item)
                                            <option value="{{ $item->id }}" @if(@$search_designation==$item->id ) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <label class="focus-label">Designation</label>
                            </div>
                        </div>
                    <div class="col-sm-6 col-md-3">  
                        <input type="submit" class="btn btn-success btn-block" value="search">  
                    </div>
                </form>
                </div>
                <!-- Search Filter -->
                @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                   
                    @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
                   
                </div>
                @endif
                @isset($emps)
                <div class="row staff-grid-row">
                    @foreach($emps as $val)
                        
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="{{route('profile_details', $val->id)}}" class="avatar"><img src="img/profiles/avatar-02.jpg" alt=""></a>
                                    </div>
									 
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item edtEmpBtn" href="#" data-toggle="modal" data-role_id="{{@$val->role_id}}" data-assis_man_id="{{@$val->assi_manager_id}}" data-id="{{ @$val->id }}" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item delEmpBtn" href="#" data-toggle="modal" data-id="{{ @$val->id }}" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
									 
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{route('profile_details', $val->id)}}">{{ @$val->first_name }} {{ @$val->last_name }}</a></h4>
                                    <div class="small text-muted">
                                        {{ @$val->designation->name }}</div>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                @endisset 
            <!-- /Page Content -->
            
            <!-- Add Employee Modal -->
            <div id="add_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_employee') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Role</label>
                                            <select class="form-control" name="role_id" id="edit_role_id" required>
                                                <option value="">Select Role</option>
                                                @isset($roles)
                                                    @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Select Manager <span class="text-danger">*</span></label>
                                            <select class="form-control" name="man_id" id="manager_id_add" required>
												<option  value="">Select Manager</option>
												@isset($manager)
                                                    @foreach ($manager as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}  {{$item->last_name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
									@if(Auth::user()->role_id != 1 && Auth::user()->role_id != 5)
                                    <div class="col-sm-6 add-class" id="assi_manager_hide">
                                        <div class="form-group">
                                            <label class="col-form-label">Select Assistant Manager <span class="text-danger">*</span></label>
                                            <select class="form-control requiredornot" name="assis_man_id" id="assi_manager_id_add">
                                                <option  value="">Select Assistant Manager</option>
                                                @isset($assistantmanager)
                                                    @foreach ($assistantmanager as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}  {{$item->last_name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
									@endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="user_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Password</label>
                                            <input class="form-control" type="password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Confirm Password</label>
                                            <input class="form-control" name="confirm_password" type="password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" disabled required id="disabled_emp_id">
                                            <input type="hidden" class="form-control" id="employee_id" name="employee_id" required>
                                            <input type="hidden" class="form-control" id="last_emp_id" value="{{ @$last_emp_id->id }}"  name="last_emp_id">
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Gender</label>
                                            <select class="form-control" name="gender" required>
												<option value="">Select Gender</option>
												<option value="0">Male</option> 
												<option value="1">Female</option> 
												<option value="2">Others</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="joing_date" type="text" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone </label>
                                            <input class="form-control" type="text" name="phone_no" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Company</label>
                                            <select class="select" name="company_id" required>
            
                                                <option value="1">Wazobia Market</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">*</span></label>
                                            <select class="select" id="depList" name="department_id" required>
                                                <option>Select Department</option>
                                                @isset($dep)
                                                    @foreach($dep as $val)
                                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation <span class="text-danger">*</span></label>
                                            <select class="select" name="designation_id" id="designationList" required>
                                                <option value="">Select Designation</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Documents </label>
                                            <input class="form-control" type="file" name="document_add"  >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location <span class="text-danger">*</span></label>
                                            <select class="select" id="locList" name="location_id" required>
                                                <option value="">Select Location</option>
                                                @isset($location)
                                                    @foreach($location as $val)
                                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th>Module Permission</th>
                                                @isset($emp_permissions)
                                                    @foreach ($emp_permissions as $ep)
                                                        <th class="text-center">{{ $ep->name }}</th>
                                                    @endforeach
                                                @endisset
                                                {{-- <th class="text-center">Read</th>
                                                <th class="text-center">Write</th>
                                                <th class="text-center">Create</th>
                                                <th class="text-center">Delete</th>
                                                <th class="text-center">Import</th>
                                                <th class="text-center">Export</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @isset($modules)
                                        @foreach ($modules as $val)
                                            <tr>
                                                <td>{{ $val->name }}</td>
                                                @isset($emp_permissions)
                                                @foreach ($emp_permissions as $ep)
                                                    <td class="text-center">
                                                        <input name="permission_modules[]" value="{{ $val->id }}_{{ $ep->id }}" type="checkbox">
                                                    </td>
                                                @endforeach
                                                @endisset
                                               
                                            </tr>
                                        @endforeach
                                        @endisset 
                        
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Employee Modal -->
            
            <!-- Edit Employee Modal -->
            <div id="edit_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Employee </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="edit_employee_form30" action="{{ route('update_employee') }}" method="post" enctype="multipart/form-data" >
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}" id="hidden_from"> 
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" required type="text" name="first_name" id="emp_first_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" value="" type="hidden" name="id" id="emp_id">
                                            <input class="form-control" value="" type="text" name="last_name" id="emp_last_name">
                                        </div>
                                    </div>
									@if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                    @else
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Role </label>
                                            <select class="form-control" name="role_id" id="edit_role_id_data" required>
												<option value="">Select Role</option>
												@isset($roles)
                                                    @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Select Manager<span class="text-danger">*</span></label>
                                            <select class="form-control" name="man_id" id="manager_id" required>
												<option  value="">Select Manager</option>
												@isset($manager)
                                                    @foreach ($manager as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}  {{$item->last_name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
									@if(Auth::user()->role_id != 1 && Auth::user()->role_id != 5)
									<div class="col-sm-6 add-class" id="assi_manager_hide_data">
                                        <div class="form-group">
                                            <label class="col-form-label">Select Assistant Manager<span class="text-danger">*</span></label>
                                            <select class="form-control requiredornot" name="assis_man_id" id="assi_manager_id_add_data">
                                                <option  value="">Select Assistant Manager</option>
                                                @isset($assistantmanager)
                                                    @foreach ($assistantmanager as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}  {{$item->last_name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
									@endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                            <label class="col-form-label">Username <span class="text-danger"></span></label>
                                            <input class="form-control" value="" type="text" disabled name="" id="emp_user_name">
                                            @else
                                            <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" type="text" name="user_name" id="emp_user_name">
                                            @endif
                                        </div>
                                    </div>
                                    @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" type="email" disabled name="" id="emp_email">
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" value="" type="email"  name="email" id="emp_email">
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                    @else
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Password</label>
                                            <input class="form-control" value="" type="password"    name="password" placeholder="*****">
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                    @else
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Confirm Password</label>
                                            <input class="form-control" value="" type="password" name="confirm_password">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                            <input type="text" value="" disabled class="form-control" name="emp_employee_id" id="emp_employee_id">
                                            <input type="hidden" value=""  class="form-control" name="employee_id" id="edit_employee_id">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Gender</label>
                                            <select class="form-control" name="gender" required id="gender">
												<option value="">Select Gender</option>
												<option value="0">Male</option> 
												<option value="1">Female</option> 
												<option value="2">Others</option> 
                                            </select>
                                        </div>
                                    </div>
                                    @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" disabled name="" type="text" id="emp_joing_date"></div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="joing_date" type="text" id="emp_joing_date"></div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone </label>
                                            <input class="form-control" value="" type="text" name="phone_no" id="emp_phone_no">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Company</label>
                                            @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                            <select class="form-control" id="company_name" name="company_id" disabled>
                                                <option value="1">Wazobia Market</option>
                                            </select>
                                            @else
                                            <select class="select" name="company_id">
                                                <option value="1">Wazobia Market</option>
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department <span class="text-danger">*</span></label>
                                            @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                            <select class="form-control" id="edit_depList" name="" disabled>
                                                <option>Select Department</option>
                                                @isset($dep)
                                                    @foreach($dep as $val)
                                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @else
                                            <select class="form-control" id="edit_depList" name="department_id">
                                                <option>Select Department</option>
                                                @isset($dep)
                                                    @foreach($dep as $val)
                                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if(Auth::user()->role_id==2 || Auth::user()->role_id==6)
                                            <label>Designation <span class="text-danger">*</span></label>
                                            <select class="select" name="" disabled id="edit_designationList">
                                                <option value="">Select Designation</option>
                                            </select>
                                            @else
                                            <label>Designation <span class="text-danger">*</span></label>
                                            <select class="select" name="designation_id" id="edit_designationList">
                                                <option value="">Select Designation</option>
                                            </select>
                                            @endif  
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Documents </label>
                                            <input class="form-control" type="file" name="document_add" >
											<div  id="employee_document_edit"></div>
											<div  id="employee_document_edit1"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Location <span class="text-danger">*</span></label>
                                            <select class="form-control" id="edit_locList" name="location_id" required>
                                                <option value="">Select Location</option> 
                                                @isset($location)
                                                    @foreach($location as $val)
                                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
								@if(Auth::user()->role_id != 2 && Auth::user()->role_id!=6)
                                <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th>Module Permission</th>
                                                @isset($emp_permissions)
                                                    @foreach ($emp_permissions as $ep)
                                                        <th class="text-center">{{ $ep->name }}</th>
                                                    @endforeach
                                                @endisset
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($modules)
                                            @foreach ($modules as $val)
                                                <tr>
                                                    <td>{{ $val->name }}</td>
                                                    @isset($emp_permissions)
                                                    @foreach ($emp_permissions as $ep)
                                                        <td class="text-center">
                                                            <input class="permissionCheck" name="permission_modules[]" value="{{ $val->id }}_{{ $ep->id }}" type="checkbox">
                                                        </td>
                                                    @endforeach
                                                    @endisset            
                                                </tr>
                                            @endforeach
                                            @endisset 
                                        </tbody>
                                    </table>
                                </div>
								@endif
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Employee Modal -->
            
            <!-- Delete Employee Modal -->
            <div class="modal custom-modal fade" id="delete_employee" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Employee</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn deleteEmpCont" data-id="">Delete</a>
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
            <!-- /Delete Employee Modal -->
            
        </div>
        <!-- /Page Wrapper -->
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">
		jQuery(document).ready(function() {
		<?php  if(Auth::user()->role_id==2 || Auth::user()->role_id==6){ ?> 
		jQuery("form.edit_employee_form30 input").css('pointer-events','none');
		jQuery("form.edit_employee_form30 input").css('background-color','#e9ecef!important');
		 
		jQuery("form.edit_employee_form30 select#manager_id").css('pointer-events','none');
		jQuery("form.edit_employee_form30 select#manager_id").css('background-color','#e9ecef!important');
		jQuery("form.edit_employee_form30 select#gender").css('pointer-events','none');
		jQuery("form.edit_employee_form30 select#gender").css('background-color','#e9ecef!important');
		jQuery("form.edit_employee_form30 select#edit_depList").css('pointer-events','none');
		jQuery("form.edit_employee_form30 select#edit_depList").css('background-color','#e9ecef!important');
		jQuery("form.edit_employee_form30 select#company_name").css('pointer-events','none');
		jQuery("form.edit_employee_form30 select#company_name").css('background-color','#e9ecef!important');
		jQuery("form.edit_employee_form30 select#edit_locList").css('pointer-events','none');
		jQuery("form.edit_employee_form30 select#edit_locList").css('background-color','#e9ecef!important'); 
		 
		 
		 
		<?php } ?>
		});
		</script>
@endsection