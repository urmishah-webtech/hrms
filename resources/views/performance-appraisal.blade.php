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
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_appraisal"><i class="fa fa-plus"></i> Add New</a>
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
                                        <td>{{ @$val->appraisal_date }}</td>
                                        <td>
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '1') text-success @else text-danger @endif"></i>  @if(@$val->status== '1') Active @else Inactive @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
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
                                                <option>Select Employee</option>
                                                @isset($employees)
                                                    @foreach ($employees as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                    @endforeach
                                                @endisset                                                 
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
                                                @isset($employees)
                                                    @foreach ($employees as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}</option> 
                                                    @endforeach
                                                @endisset 
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
@endsection