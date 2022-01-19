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
                            <h3 class="page-title">Performance Indicator</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Performance</li>
                            </ul>
                        </div>
                        @if(Auth::user()->role_id != 3)
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_indicator"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @if($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                    </div>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Employee</th>
                                        <th>Create At</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Auth::user()->role_id == 3)
                                    @isset($login_emp)
                                    @foreach($login_emp as $val)
                                    <tr class="trindicator">
                                        <td>{{ @$val->id }}</td>
                                        <td class="tdindicator">{{ @$val->designation->name }}</td>                                        
                                        <td>{{ @$val->designation->department->name}}</td>                                        
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{ @$val->employee->first_name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{date('d M Y', strtotime(@$val->created_at))}}</td>
                                        <td> 
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1')text-success @else text-danger @endif"></i> @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item empviewindicater" href="#" data-id="{{ @$val->id }}" data-employee_id="{{ @$val->employee->first_name }}" data-status="{{ @$val->status }}" data-ability_to_meet_deadline="{{ @$val->ability_to_meet_deadline }}" data-efficiency="{{ @$val->efficiency }}" data-attendance="{{ @$val->attendance }}" data-quality_of_work="{{ @$val->quality_of_work }}" data-conflict_management="{{ @$val->conflict_management }}" data-presentation_skills="{{ @$val->presentation_skills }}" data-critical_thinking="{{ @$val->critical_thinking }}" data-administration="{{ @$val->administration }}" data-teamwork="{{ @$val->teamwork }}" data-management="{{ @$val->management }}" data-professionalism="{{ @$val->professionalism }}" data-marketing="{{ @$val->marketing }}" data-integrity="{{ @$val->integrity }}" data-cust="{{ @$val->customer_experience }}" data-designation="{{ @$val->designation->name }}" data-toggle="modal" data-target="#view_emp_indicator"><i class="fa fa-eye m-r-5"></i> View</a>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset 
                                    @elseif(Auth::user()->role_id == 2)
                                    @isset($indi_man)
                                    @foreach($indi_man as $val)
                                    <tr class="trindicator">
                                        <td>{{ @$val->id }}</td>
                                        <td class="tdindicator">{{ @$val->designation->name }}</td>                                        
                                        <td>{{ @$val->designation->department->name}}</td>                                        
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{ @$val->employee->first_name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{date('d M Y', strtotime(@$val->created_at))}}</td>
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1')text-success @else text-danger @endif"></i> @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('changestatusDropdown').'/1'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-success"></i>Active</a>
                                                    <a class="dropdown-item" href="{{ url('changestatusDropdown').'/0'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-danger"></i>Inactive</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editIndicateBtn" href="#" data-employee_id="{{ @$val->employee_id }}" data-status="{{ @$val->status }}" data-ability_to_meet_deadline="{{ @$val->ability_to_meet_deadline }}" data-efficiency="{{ @$val->efficiency }}" data-attendance="{{ @$val->attendance }}" data-quality_of_work="{{ @$val->quality_of_work }}" data-conflict_management="{{ @$val->conflict_management }}" data-presentation_skills="{{ @$val->presentation_skills }}" data-critical_thinking="{{ @$val->critical_thinking }}" data-administration="{{ @$val->administration }}" data-teamwork="{{ @$val->teamwork }}" data-management="{{ @$val->management }}" data-professionalism="{{ @$val->professionalism }}" data-marketing="{{ @$val->marketing }}" data-integrity="{{ @$val->integrity }}" data-cust="{{ @$val->customer_experience }}" data-indi-id="{{ @$val->designation_id }}" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#edit_indicator"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteIndicateBtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_indicator"><i class="fa fa-trash-o m-r-5"></i> Delete</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset 
                                    @else
                                    @isset($indicators)
                                    @foreach($indicators as $val)
                                    <tr class="trindicator">
                                        <td>{{ @$val->id }}</td>
                                        <td class="tdindicator">{{ @$val->designation->name }}</td>                                        
                                        <td>{{ @$val->designation->department->name}}</td>                                        
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{ @$val->employee->first_name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{date('d M Y', strtotime(@$val->created_at))}}</td>
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1')text-success @else text-danger @endif"></i> @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('changestatusDropdown').'/1'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-success"></i>Active</a>
                                                    <a class="dropdown-item" href="{{ url('changestatusDropdown').'/0'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-danger"></i>Inactive</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editIndicateBtn" href="#" data-employee_id="{{ @$val->employee_id }}" data-status="{{ @$val->status }}" data-ability_to_meet_deadline="{{ @$val->ability_to_meet_deadline }}" data-efficiency="{{ @$val->efficiency }}" data-attendance="{{ @$val->attendance }}" data-quality_of_work="{{ @$val->quality_of_work }}" data-conflict_management="{{ @$val->conflict_management }}" data-presentation_skills="{{ @$val->presentation_skills }}" data-critical_thinking="{{ @$val->critical_thinking }}" data-administration="{{ @$val->administration }}" data-teamwork="{{ @$val->teamwork }}" data-management="{{ @$val->management }}" data-professionalism="{{ @$val->professionalism }}" data-marketing="{{ @$val->marketing }}" data-integrity="{{ @$val->integrity }}" data-cust="{{ @$val->customer_experience }}" data-indi-id="{{ @$val->designation_id }}" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#edit_indicator"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteIndicateBtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_indicator"><i class="fa fa-trash-o m-r-5"></i> Delete</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     @endforeach
                                    @endisset
                                    @endif                         
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

            <!-- Add Performance Indicator Modal -->
            <div id="add_indicator" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Set New Indicator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_indicators') }}" method="post">
                             @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Designation</label>
                                            <select class="form-control" name="designation">
                                                <option value="">Select Designation</option>
                                                @isset($designations)
                                                    @foreach ($designations as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                                    @endforeach
                                                @endisset
                                            </select>                                           
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee</label>
                                            <select class="form-control" name="employee" >
                                                <option value="">Select Employee</option>
                                                @if(Auth::user()->role_id == 1)
                                                @isset($admin_emp)
                                                    @foreach ($admin_emp as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                    @endforeach
                                                @endisset
                                                @else
                                                @isset($select_emp_man)
                                                    @foreach ($select_emp_man as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                    @endforeach
                                                @endisset
                                                @endif
                                            </select>                                           
                                        </div>
                                    </div>                   
                                   <div class="col-sm-6">
                                        <h4 class="modal-sub-title">Technical</h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Customer Experience</label>
                                            <select class="form-control" name="customer_experience">
                                                <option value="0" selected>None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option  value="3">Advanced</option>
                                                <option  value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Marketing</label>
                                            <select class="form-control" name="marketing" required>
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Management</label>
                                            <select class="form-control" name="management">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Administration</label>
                                            <select class="form-control" name="administration">
                                                <option  value="0">None</option>
                                                <option  value="1">Beginner</option>
                                                <option  value="2">Intermediate</option>
                                                <option  value="3">Advanced</option>
                                                <option  value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Presentation Skill</label>
                                            <select class="form-control" name="presentation_skills">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Quality Of Work</label>
                                            <select class="form-control" name="quality_of_work">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Efficiency</label>
                                            <select class="form-control" name="efficiency">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="modal-sub-title">Organizational</h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Integrity</label>
                                            <select class="form-control" name="integrity">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Professionalism</label>
                                            <select class="form-control" name="professionalism">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Team Work</label>
                                            <select class="form-control" name="teamwork">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Critical Thinking</label>
                                            <select class="form-control" name="critical_thinking">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Conflict Management</label>
                                            <select class="form-control" name="conflict_management">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option  value="2">Intermediate</option>
                                                <option  value="3">Advanced</option>
                                                <option  value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Attendance</label>
                                            <select class="form-control" name="attendance">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Ability To Meet Deadline</label>
                                            <select class="form-control" name="ability_to_meet_deadline">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" name="perf_indicator_sub" class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Performance Indicator Modal -->
            
            <!-- Edit Performance Indicator Modal -->
            <div id="edit_indicator" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Performance Indicator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('edit_indicators') }}" method="post">
                                @csrf   
                                <input class="form-control" value="" name="id" type="hidden" required id="editIndicatorId">                                                           
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group"> 
                                            <label class="col-form-label">Designation</label> 
                                            <select class="form-control indicatorId" id="edit_designationlist" name="designation" required>
                                                <option value>Select Designation</option>
                                                @isset($designations)
                                                    @foreach ($designations as $item) 
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>  
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee</label>
                                            <select class="form-control" id="employee" name="employee">
                                                <option value="">Select Employee</option>
                                                @if(Auth::user()->role_id == 1)
                                                    @isset($admin_emp)
                                                        @foreach ($admin_emp as $item)
                                                        <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                        @endforeach
                                                    @endisset
                                                @else
                                                    @isset($select_emp_man)
                                                        @foreach ($select_emp_man as $item)
                                                        <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                        @endforeach
                                                    @endisset
                                                @endif
                                            </select>                                           
                                        </div>
                                    </div>                                                                                                          
                                    <div class="col-sm-6">
                                        <h4 class="modal-sub-title">Technical</h4>
                                        <div class="form-group">                                           
                                            <label class="col-form-label">Customer Experience</label>                                            
                                            <select class="form-control" id="customer_experience" name="customer_experience">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Marketing</label>
                                            <select class="form-control" id="marketing" name="marketing">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Management</label>
                                            <select class="form-control" id="management" name="management">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Administration</label>
                                            <select class="form-control" id="administration" name="administration">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Presentation Skill</label>
                                            <select class="form-control" id="presentation_skills" name="presentation_skills">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Quality Of Work</label>
                                            <select class="form-control" id="quality_of_work" name="quality_of_work">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Efficiency</label>
                                            <select class="form-control" id="efficiency" name="efficiency">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-sm-6">
                                        <h4 class="modal-sub-title">Organizational</h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Integrity</label>
                                            <select class="form-control" id="integrity" name="integrity">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Professionalism</label>
                                            <select class="form-control" id="professionalism" name="professionalism">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Team Work</label>
                                            <select class="form-control" id="teamwork" name="teamwork">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Critical Thinking</label>
                                            <select class="form-control" id="critical_thinking" name="critical_thinking">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Conflict Management</label>
                                            <select class="form-control" id="conflict_management" name="conflict_management">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Attendance</label>
                                            <select class="form-control" id="attendance" name="attendance">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Ability To Meet Deadline</label>
                                            <select class="form-control" id="ability_to_meet_deadline" name="ability_to_meet_deadline">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>                                            
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
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
            <!-- /Edit Performance Indicator Modal -->

            <!-- view Performance Indicator Modal -->
            <div id="view_emp_indicator" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Performance Indicator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group"> 
                                            <label class="col-form-label">Designation</label> 
                                            <p class="form-control" id="view_designationlist"> </p> 
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee</label>
                                            <p class="form-control" id="view_employee"> </p>
                                        </div>
                                    </div>                            
                                    <div class="col-sm-6">
                                        <h4 class="modal-sub-title">Technical</h4>
                                        <div class="form-group">                                           
                                            <label class="col-form-label">Customer Experience</label>    
                                            <select class="form-control view_emp_indicat" id="view_customer_experience">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Marketing</label>
                                            <select class="form-control view_emp_indicat" id="view_marketing">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Management</label>
                                            <select class="form-control view_emp_indicat" id="view_management" name="management">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Administration</label>
                                            <select class="form-control view_emp_indicat" id="view_administration" >
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Presentation Skill</label>
                                            <select class="form-control view_emp_indicat" id="view_presentation_skills" >
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Quality Of Work</label>
                                            <select class="form-control view_emp_indicat" id="view_quality_of_work">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Efficiency</label>
                                            <select class="form-control view_emp_indicat" id="view_efficiency">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-sm-6">
                                        <h4 class="modal-sub-title">Organizational</h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Integrity</label>
                                            <select class="form-control view_emp_indicat" id="view_integrity">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Professionalism</label>
                                            <select class="form-control view_emp_indicat" id="view_professionalism">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Team Work</label>
                                            <select class="form-control view_emp_indicat" id="view_teamwork">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Critical Thinking</label>
                                            <select class="form-control view_emp_indicat" id="view_critical_thinking">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Conflict Management</label>
                                            <select class="form-control view_emp_indicat" id="view_conflict_management">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Attendance</label>
                                            <select class="form-control view_emp_indicat" id="view_attendance">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Ability To Meet Deadline</label>
                                            <select class="form-control view_emp_indicat" id="view_ability_to_meet_deadline">
                                                <option value="0">None</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Advanced</option>
                                                <option value="4">Expert / Leader</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>                                            
                                            <select class="form-control view_emp_indicat" id="view_status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- /View Performance Indicator Modal -->
            
            <!-- Delete Performance Indicator Modal -->
            <div class="modal custom-modal fade" id="delete_indicator" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Performance Indicator List</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-id="" class="btn btn-primary continue-btn indicatorContDel">Delete</a>
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
            <!-- /Delete Performance Indicator Modal -->
        
        </div>
        <!-- /Page Wrapper -->

<style>input.list_status5_35{display:none;}</style>
<script src="js/jquery-3.5.1.min.js"></script>
<script>
		 
        $(document).on("click",".empviewindicater",function(){
            $("#view_designationlist").text($(this).data('designation'));
            $("#view_employee").text($(this).data('employee_id'));
            var cust_exp =$(this).data('cust');	
			$("#view_customer_experience option[value='"+cust_exp+"']").prop('selected',true);
            var integrity =$(this).data('integrity');	
            $("#view_integrity option[value='"+integrity+"']").prop('selected',true);
            var marketing =$(this).data('marketing');	
            $("#view_marketing option[value='"+marketing+"']").prop('selected',true);
            var professionalism =$(this).data('professionalism');	
            $("#view_professionalism option[value='"+professionalism+"']").prop('selected',true);
            var management =$(this).data('management');	
            $("#view_management option[value='"+management+"']").prop('selected',true);
            var teamwork =$(this).data('teamwork');	
            $("#view_teamwork option[value='"+teamwork+"']").prop('selected',true);
            var administration =$(this).data('administration');	
            $("#view_administration option[value='"+administration+"']").prop('selected',true);
            var critical_thinking =$(this).data('critical_thinking');	
            $("#view_critical_thinking option[value='"+critical_thinking+"']").prop('selected',true);
            var presentation_skills =$(this).data('presentation_skills');	
            $("#view_presentation_skills option[value='"+presentation_skills+"']").prop('selected',true);
            var conflict_management =$(this).data('conflict_management');	
            $("#view_conflict_management option[value='"+conflict_management+"']").prop('selected',true);
            var quality_of_work =$(this).data('quality_of_work');	
            $("#view_quality_of_work option[value='"+quality_of_work+"']").prop('selected',true);
            var attendance =$(this).data('attendance');	
            $("#view_attendance option[value='"+attendance+"']").prop('selected',true);
            var efficiency =$(this).data('efficiency');	
            $("#view_efficiency option[value='"+efficiency+"']").prop('selected',true);
            var ability_to_meet_deadline =$(this).data('ability_to_meet_deadline');	
            $("#view_ability_to_meet_deadline option[value='"+ability_to_meet_deadline+"']").prop('selected',true);
            var status =$(this).data('status');	
            $("#view_status option[value='"+status+"']").prop('selected',true);
             
            
            							 
        });
	</script>
@endsection