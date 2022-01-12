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
                            <h3 class="page-title">Performance Appraisal</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Performance</li>
                            </ul>
                        </div>
                        @if(Auth::user()->role_id != 3)
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_appraisal"><i class="fa fa-plus"></i> Add New</a>
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
                                        <th>Employee</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Appraisal Date</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(Auth::user()->role_id == 3)   
                                @isset($login_emp)
                                @foreach($login_emp as $val)
                                    <tr>
                                        <td>{{ @$val->id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{ @$val->employee->first_name }} </a>
                                                
                                            </h2>
                                        </td>
                                        <td>{{ @$val->employee->designation->name }} </td>
                                        <td>{{ @$val->employee->department->name }}</td>
                                        <td>{{date('d M Y', strtotime(@$val->appraisal_date))}}</td>
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1') text-success @else text-danger @endif"></i>  @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>                                            
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item viewempAppraisalBtn" href="#" data-appraisal_date="{{ @$val->appraisal_date }}" data-status="{{ @$val->status }}" data-ability_to_meet_deadline="{{ @$val->ability_to_meet_deadline }}" data-efficiency="{{ @$val->efficiency }}" data-attendance="{{ @$val->attendance }}" data-quality_of_work="{{ @$val->quality_of_work }}" data-conflict_management="{{ @$val->conflict_management }}" data-presentation_skills="{{ @$val->presentation_skills }}" data-critical_thinking="{{ @$val->critical_thinking }}" data-administration="{{ @$val->administration }}" data-teamwork="{{ @$val->teamwork }}" data-management="{{ @$val->management }}" data-professionalism="{{ @$val->professionalism }}" data-marketing="{{ @$val->marketing }}" data-integrity="{{ @$val->integrity }}" data-cust="{{ @$val->customer_experience }}" data-emp-id="{{ @$val->employee_id }}" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#view_emp_appraisal"><i class="fa fa-pencil m-r-5"></i> View</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endisset
                                @elseif(Auth::user()->role_id == 2)
                                @isset($appr_man)
                                @foreach($appr_man as $val)
                                    <tr>
                                        <td>{{ @$val->id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{ @$val->employee->first_name }} </a>
                                                
                                            </h2>
                                        </td>
                                        <td>{{ @$val->employee->designation->name }} </td>
                                        <td>{{ @$val->employee->department->name }}</td>
                                        <td>{{date('d M Y', strtotime(@$val->appraisal_date))}}</td>
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1') text-success @else text-danger @endif"></i>  @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> <input type="radio" class="list_status5_35 status1" name="status" id="status1{{ @$val->id }}"  data-id="{{ @$val->id }}" value="1"> <label for="status1{{ @$val->id }}">Active</label></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> <input type="radio" class="list_status5_35 status0" name="status" id="status0{{ @$val->id }}"  data-id="{{ @$val->id }}"  value="0"><label for="status0{{ @$val->id }}">Inactive</label></a>
                                                </div>                                                
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editAppraisalBtn" href="#" data-appraisal_date="{{ @$val->appraisal_date }}" data-status="{{ @$val->status }}" data-ability_to_meet_deadline="{{ @$val->ability_to_meet_deadline }}" data-efficiency="{{ @$val->efficiency }}" data-attendance="{{ @$val->attendance }}" data-quality_of_work="{{ @$val->quality_of_work }}" data-conflict_management="{{ @$val->conflict_management }}" data-presentation_skills="{{ @$val->presentation_skills }}" data-critical_thinking="{{ @$val->critical_thinking }}" data-administration="{{ @$val->administration }}" data-teamwork="{{ @$val->teamwork }}" data-management="{{ @$val->management }}" data-professionalism="{{ @$val->professionalism }}" data-marketing="{{ @$val->marketing }}" data-integrity="{{ @$val->integrity }}" data-cust="{{ @$val->customer_experience }}" data-emp-id="{{ @$val->employee_id }}" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#edit_appraisal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteAppraisalBtn" data-id="{{ @$val->id }}" href="#" data-toggle="modal" data-target="#delete_appraisal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endisset
                                @else
                                @isset($appraisal)
                                @foreach($appraisal as $val)
                                    <tr>
                                        <td>{{ @$val->id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                                <a href="profile">{{ @$val->employee->first_name }} </a>
                                                
                                            </h2>
                                        </td>
                                        <td>{{ @$val->employee->designation->name }} </td>
                                        <td>{{ @$val->employee->department->name }}</td>
                                        <td>{{date('d M Y', strtotime(@$val->appraisal_date))}}</td>
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1') text-success @else text-danger @endif"></i>  @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> <input type="radio" class="list_status5_35 status1" name="status" id="status1{{ @$val->id }}"  data-id="{{ @$val->id }}" value="1"> <label for="status1{{ @$val->id }}">Active</label></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> <input type="radio" class="list_status5_35 status0" name="status" id="status0{{ @$val->id }}"  data-id="{{ @$val->id }}"  value="0"><label for="status0{{ @$val->id }}">Inactive</label></a>
                                                </div>                                                
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editAppraisalBtn" href="#" data-appraisal_date="{{ @$val->appraisal_date }}" data-status="{{ @$val->status }}" data-ability_to_meet_deadline="{{ @$val->ability_to_meet_deadline }}" data-efficiency="{{ @$val->efficiency }}" data-attendance="{{ @$val->attendance }}" data-quality_of_work="{{ @$val->quality_of_work }}" data-conflict_management="{{ @$val->conflict_management }}" data-presentation_skills="{{ @$val->presentation_skills }}" data-critical_thinking="{{ @$val->critical_thinking }}" data-administration="{{ @$val->administration }}" data-teamwork="{{ @$val->teamwork }}" data-management="{{ @$val->management }}" data-professionalism="{{ @$val->professionalism }}" data-marketing="{{ @$val->marketing }}" data-integrity="{{ @$val->integrity }}" data-cust="{{ @$val->customer_experience }}" data-emp-id="{{ @$val->employee_id }}" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#edit_appraisal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteAppraisalBtn" data-id="{{ @$val->id }}" href="#" data-toggle="modal" data-target="#delete_appraisal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

            <!-- Add Performance Appraisal Modal -->
            <div id="add_appraisal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Give Performance Appraisal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('add_appraisal')}}" method="post">
                            @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee</label>
                                            <select class="select" name="employees">
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
                                        <div class="form-group">
                                            <label>Select Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="appraisal_date"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="tab-box">
                                                    <div class="row user-tabs">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                                                            <ul class="nav nav-tabs nav-tabs-solid">
                                                                <li class="nav-item"><a href="#appr_technical" data-toggle="tab" class="nav-link active">Technical</a></li>
                                                                <li class="nav-item"><a href="#appr_organizational" data-toggle="tab" class="nav-link">Organizational</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div id="appr_technical" class="pro-overview tab-pane fade show active">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="bg-white">
                                                                    <table class="table">
                                                                        <thead>
                                                                          <tr>
                                                                            <th colspan="5">Technical Competencies</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                          <tr>
                                                                            <th colspan="2">Indicator</th>
                                                                            <th colspan="2">Expected Value</th>
                                                                            <th>Set Value</th>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Customer Experience</td>
                                                                            <td colspan="2">Intermediate</td>
                                                                            <td><select name="customer_experience" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Marketing</td>
                                                                            <td colspan="2">Advanced</td>
                                                                            <td><select name="marketing" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Management</td>
                                                                            <td colspan="2">Advanced</td>
                                                                            <td><select name="management" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Administration</td>
                                                                            <td colspan="2">Advanced</td>
                                                                            <td><select name="administration" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Presentation Skill</td>
                                                                            <td colspan="2">Expert / Leader</td>
                                                                            <td><select name="presentation_skills" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Quality Of Work</td>
                                                                            <td colspan="2">Expert / Leader</td>
                                                                            <td><select name="quality_of_work" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td scope="row" colspan="2">Efficiency</td>
                                                                            <td colspan="2">Expert / Leader</td>
                                                                            <td><select name="efficiency" class="form-control">
                                                                                <option value="0">None</option>
                                                                                <option value="1"> Beginner</option>
                                                                                <option value="2"> Intermediate</option>
                                                                                <option value="3"> Advanced</option>
                                                                                <option value="4"> Expert / Leader</option>
                                                                              </select></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="appr_organizational">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="bg-white">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="5">Organizational Competencies</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <th colspan="2">Indicator</th>
                                                                                <th colspan="2">Expected Value</th>
                                                                                <th>Set Value</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Integrity</td>
                                                                                <td colspan="2">Beginner</td>
                                                                                <td>
                                                                                    <select name="integrity" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Professionalism</td>
                                                                                <td colspan="2">Beginner</td>
                                                                                <td>
                                                                                    <select name="professionalism" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Team Work</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select name="teamwork" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Critical Thinking</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select name="critical_thinking" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Conflict Management</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select name="conflict_management" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Attendance</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select name="attendance" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Ability To Meet Deadline</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select name="ability_to_meet_deadline" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <select class="select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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
            <!-- /Add Performance Appraisal Modal -->
            
            <!-- Edit Performance Appraisal Modal -->
            <div id="edit_appraisal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Performance Appraisal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('edit_appraisal') }}" method="post">
                            @csrf   
                                <input class="form-control" value="" name="id" type="hidden" required id="editAppraisalId"> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee</label>
                                            <select class="form-control" id="edit_employeeslist" name="employees">
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
                                        <div class="form-group">
                                            <label>Select Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" value="" id="appraisal_date" name="appraisal_date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="tab-box">
                                                    <div class="row user-tabs">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                                                            <ul class="nav nav-tabs nav-tabs-solid">
                                                                <li class="nav-item"><a href="#appr_technical1" data-toggle="tab" class="nav-link active">Technical</a></li>
                                                                <li class="nav-item"><a href="#appr_organizational1" data-toggle="tab" class="nav-link">Organizational</a></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div id="appr_technical1" class="pro-overview tab-pane fade show active">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="bg-white">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="5">Technical Competencies</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="2">Indicator</th>
                                                                                <th colspan="2">Expected Value</th>
                                                                                <th>Set Value</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Customer Experience</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="customer_experience" name="customer_experience" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Marketing</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="marketing" name="marketing" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Management</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="management" name="management" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Administration</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="administration" name="administration" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Presentation Skill</td>
                                                                                <td colspan="2">Expert / Leader</td>
                                                                                <td>
                                                                                    <select id="presentation_skills" name="presentation_skills" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Quality Of Work</td>
                                                                                <td colspan="2">Expert / Leader</td>
                                                                                <td>
                                                                                    <select id="quality_of_work" name="quality_of_work" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Efficiency</td>
                                                                                <td colspan="2">Expert / Leader</td>
                                                                                <td>
                                                                                    <select id="efficiency" name="efficiency" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="appr_organizational1">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="bg-white">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="5">Organizational Competencies</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="2">Indicator</th>
                                                                                <th colspan="2">Expected Value</th>
                                                                                <th>Set Value</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Integrity</td>
                                                                                <td colspan="2">Beginner</td>
                                                                                <td>
                                                                                    <select id="integrity" name="integrity" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Professionalism</td>
                                                                                <td colspan="2">Beginner</td>
                                                                                <td>
                                                                                    <select id="professionalism" name="professionalism" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Team Work</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="teamwork" name="teamwork" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Critical Thinking</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="critical_thinking" name="critical_thinking" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Conflict Management</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="conflict_management" name="conflict_management" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Attendance</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="attendance" name="attendance" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Ability To Meet Deadline</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="ability_to_meet_deadline" name="ability_to_meet_deadline" class="form-control">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control" name="status" id="status">
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
            <!-- /Edit Performance Appraisal Modal -->

             <!-- View Performance Appraisal Modal -->
             <div id="view_emp_appraisal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Performance Appraisal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee</label>
                                            <select class="form-control view_emp_apprais" id="view_employeeslist">
                                                <option value="">Select Employee</option>
                                                @isset($employees)
                                                    @foreach ($employees as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                    @endforeach
                                                @endisset 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Date <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker view_emp_apprais" value="" id="view_appraisal_date" name="appraisal_date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="tab-box">
                                                    <div class="row user-tabs">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                                                            <ul class="nav nav-tabs nav-tabs-solid">
                                                                <li class="nav-item"><a href="#view_appr_technical1" data-toggle="tab" class="nav-link active">Technical</a></li>
                                                                <li class="nav-item"><a href="#view_appr_organizational1" data-toggle="tab" class="nav-link">Organizational</a></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div id="view_appr_technical1" class="pro-overview tab-pane fade show active">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="bg-white">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="5">Technical Competencies</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="2">Indicator</th>
                                                                                <th colspan="2">Expected Value</th>
                                                                                <th>Set Value</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Customer Experience</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="view_customer_experience"   class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Marketing</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="view_marketing"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Management</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="view_management"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Administration</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="view_administration"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Presentation Skill</td>
                                                                                <td colspan="2">Expert / Leader</td>
                                                                                <td>
                                                                                    <select id="view_presentation_skills"   class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Quality Of Work</td>
                                                                                <td colspan="2">Expert / Leader</td>
                                                                                <td>
                                                                                    <select id="view_quality_of_work" class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Efficiency</td>
                                                                                <td colspan="2">Expert / Leader</td>
                                                                                <td>
                                                                                    <select id="view_efficiency"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="view_appr_organizational1">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="bg-white">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="5">Organizational Competencies</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th colspan="2">Indicator</th>
                                                                                <th colspan="2">Expected Value</th>
                                                                                <th>Set Value</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Integrity</td>
                                                                                <td colspan="2">Beginner</td>
                                                                                <td>
                                                                                    <select id="view_integrity"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Professionalism</td>
                                                                                <td colspan="2">Beginner</td>
                                                                                <td>
                                                                                    <select id="view_professionalism" class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Team Work</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="view_teamwork"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Critical Thinking</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="view_critical_thinking"   class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Conflict Management</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="view_conflict_management"   class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Attendance</td>
                                                                                <td colspan="2">Intermediate</td>
                                                                                <td>
                                                                                    <select id="view_attendance"  class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">Ability To Meet Deadline</td>
                                                                                <td colspan="2">Advanced</td>
                                                                                <td>
                                                                                    <select id="view_ability_to_meet_deadline" class="form-control view_emp_apprais">
                                                                                        <option value="0">None</option>
                                                                                        <option value="1"> Beginner</option>
                                                                                        <option value="2"> Intermediate</option>
                                                                                        <option value="3"> Advanced</option>
                                                                                        <option value="4"> Expert / Leader</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <select class="form-control view_emp_apprais" id="view_status">
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
            <!-- /View Performance Appraisal Modal -->
            
            <!-- Delete Performance Appraisal Modal -->
            <div class="modal custom-modal fade" id="delete_appraisal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Performance Appraisal List</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn appraisalContDel">Delete</a>
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
            <!-- /Delete Performance Appraisal Modal -->
        
        </div>
        <!-- /Page Wrapper -->
  
<style>input.list_status5_35{display:none;}</style>
<script src="js/jquery-3.5.1.min.js"></script>
<script>
		$( document ).ready(function() {  	
			$(document).on("click",".list_status5_35",function() {	
                
				var id=$(this).data('id');	
               	
				var status;
				if($(".status1").is(":checked")) 
				{
					status=1;
				}
				else{
					status=0;
				}
				 	
				$.ajax({
					type:'POST',
					url:"{{ route('chang_appraisal_status') }}",
					data:{"id":id,"status":status,"_token": "{{ csrf_token() }}"},
					success:function(data){	
						location.reload();
					}
				});
			});
		});
        $(document).on("click",".viewempAppraisalBtn",function() {				 
            var empid=$(this).data('emp-id');							
            $("#view_editAppraisalId").val($(this).data('id'))				
            $("#view_employeeslist option[value='"+empid+"']").prop('selected',true);				
            var d = new Date($(this).data('appraisal_date'));
            var dd = d.getDate(); 
            var mm = d.getMonth()+1; 
            var yyyy = d.getFullYear(); 
            $("#view_appraisal_date").val(dd+'/'+mm+'/'+yyyy);				
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