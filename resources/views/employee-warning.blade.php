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
                            <h3 class="page-title">Employees Warning</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employees Warning</li>
                            </ul>
                        </div>
                        @if(Auth::user()->role_id == 1)
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_indicator"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                        @endif 
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
                                        <th>Warning</th>
                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif 
                                        <th>Employee Comments</th>
                                        <th>Manager's Comments</th>
                                        <th>Admin Comments</th>
                                        <th>Areas for Improvement</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                    @if(Auth::user()->role_id == 3)
                                    @isset($first_getw)
                                    @foreach($first_getw as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>First</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>                                       
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin1" href="#" data-id="{{ @$val->id }}" data-emp_id="{{ @$val->emp_id }}"  data-employee_comments="{{ @$val->employee_comments }}" data-managers_comments="{{ @$val->managers_comments }}" data-admin_comments="{{ @$val->admin_comments }}" data-areas_for_improvement="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     @endforeach
                                    @endisset 
                                    @elseif(Auth::user()->role_id == 2)
                                    @isset($war_man)
                                    @foreach($war_man as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>First</td>
                                        <td>{{ @$val->employee->first_name }}</td>
                                        <td>{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin1" href="#" data-id="{{ @$val->id }}" data-emp_id="{{ @$val->emp_id }}" data-employee_comments="{{ @$val->employee_comments }}" data-managers_comments="{{ @$val->managers_comments }}" data-admin_comments="{{ @$val->admin_comments }}" data-areas_for_improvement="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                    @else 
                                    @isset($first_warning_dt)
                                    @foreach($first_warning_dt as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>First</td>
                                        <td>{{ @$val->employee->first_name }}</td>
                                        <td>{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin1" href="#" data-id="{{ @$val->id }}" data-emp_id="{{ @$val->emp_id }}" data-employee_comments="{{ @$val->employee_comments }}" data-managers_comments="{{ @$val->managers_comments }}" data-admin_comments="{{ @$val->admin_comments }}" data-areas_for_improvement="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                    @endif  
                                    <!--- second Warning ---->
                                    @if(Auth::user()->role_id == 3)
                                    @isset($second_emp)
                                    @foreach($second_emp as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>Second</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin2" href="#" data-id2="{{ @$val->id }}" data-emp_id2="{{ @$val->emp_id }}"  data-employee_comments2="{{ @$val->employee_comments }}" data-managers_comments2="{{ @$val->managers_comments }}" data-admin_comments2="{{ @$val->admin_comments }}" data-areas_for_improvement2="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                     
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     @endforeach
                                    @endisset 
                                    @elseif(Auth::user()->role_id == 2)
                                    @isset($war_manag_second)
                                    @foreach($war_manag_second as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>Second</td>
                                        <td>{{ @$val->employee->first_name }}</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin2" href="#" data-id2="{{ @$val->id }}" data-emp_id2="{{ @$val->emp_id }}"  data-employee_comments2="{{ @$val->employee_comments }}" data-managers_comments2="{{ @$val->managers_comments }}" data-admin_comments2="{{ @$val->admin_comments }}" data-areas_for_improvement2="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                    @else 
                                    @isset($second_adman)
                                    @foreach($second_adman as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>Second</td>
                                        <td>{{ @$val->employee->first_name }}</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin2" href="#" data-id2="{{ @$val->id }}" data-emp_id2="{{ @$val->emp_id }}"  data-employee_comments2="{{ @$val->employee_comments }}" data-managers_comments2="{{ @$val->managers_comments }}" data-admin_comments2="{{ @$val->admin_comments }}" data-areas_for_improvement2="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item seconddeleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                    @endif 
                                     <!--- Third Warning ---->
                                     @if(Auth::user()->role_id == 3)
                                    @isset($third_emp)
                                    @foreach($third_emp as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>Third</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin3" href="#" data-id3="{{ @$val->id }}" data-emp_id3="{{ @$val->emp_id }}"  data-employee_comments3="{{ @$val->employee_comments }}" data-managers_comments3="{{ @$val->managers_comments }}" data-admin_comments3="{{ @$val->admin_comments }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item thirddeleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                     @endforeach
                                    @endisset 
                                    @elseif(Auth::user()->role_id == 2)
                                    @isset($war_manag_third)
                                    @foreach($war_manag_third as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>Third</td>
                                        <td>{{ @$val->employee->first_name }}</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin3" href="#" data-id3="{{ @$val->id }}" data-emp_id3="{{ @$val->emp_id }}"   data-employee_comments3="{{ @$val->employee_comments }}" data-managers_comments3="{{ @$val->managers_comments }}" data-admin_comments3="{{ @$val->admin_comments }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item thirddeleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                    @else 
                                    @isset($third_adman)
                                    @foreach($third_adman as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>Third</td>
                                        <td>{{ @$val->employee->first_name }}</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn edslpoin3" href="#" data-id3="{{ @$val->id }}" data-emp_id3="{{ @$val->emp_id }}"   data-employee_comments3="{{ @$val->employee_comments }}" data-managers_comments3="{{ @$val->managers_comments }}" data-admin_comments3="{{ @$val->admin_comments }}" data-toggle="modal" data-target="#edit_warningemployee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item thirddeleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

            <!-- Add First  Modal -->
            <div id="add_indicator" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Set New Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<section class="review-section" >
								<div class="review-header text-center">
									<h3 class="review-title">1st Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('add_EmployeeFirstVerbalWarning') }}" method="post">
										 @csrf
                                         <input type="hidden" class="form-control" name="getid[]" value="" id="getidjq">
											<table class="table table-bordered table-review review-table mb-0" id="table_goals">
												<thead>
													<tr> 
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th>Area's for Improvement</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row-warning"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_goals_tbody">
													 											 
													 <tr>
														<td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id[]" required>
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2)
                                                                @isset($manager_emp)
                                                                    @foreach($manager_emp as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @else
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @endif
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td>
														<td><input type="text" class="form-control" name="managers_comments[]" @if(Auth::user()->role_id != 2)readonly @endif></td>
														<td><input type="text" class="form-control" name="admin_comments[]" @if(Auth::user()->role_id != 1)readonly @endif></td>
														<td><input type="text" class="form-control" name="areas_for_improvement[]" @if(Auth::user()->role_id == 3)readonly @endif></td>
														<td></td>
													</tr>
													  
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section> 
                            <section class="review-section" >
								<div class="review-header text-center">
									<h3 class="review-title">2nd Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('add_EmployeeSecondVerbalWarning') }}" method="post">
										 @csrf
											<table class="table table-bordered table-review2 review-table mb-0" id="table_secondwarning">
												<thead>
													<tr>
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th>Area's for Improvement</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn-second-warning2"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_secondwarning_tbody">		 
													 <tr>
														<td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id[]">
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2)
                                                                @isset($manager_emp)
                                                                    @foreach($manager_emp as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @else
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @endif
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td>
														<td><input type="text" class="form-control" name="managers_comments[]" @if(Auth::user()->role_id != 2)readonly @endif></td>
														<td><input type="text" class="form-control" name="admin_comments[]"  @if(Auth::user()->role_id != 1)readonly @endif></td>
														<td><input type="text" class="form-control" name="areas_for_improvement[]" @if(Auth::user()->role_id == 3)readonly @endif></td>
														<input type="hidden" class="form-control" name="getid[]" value="" >
                                                        <td></td>
													</tr>
													  
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section>
                            <section class="review-section" >
								<div class="review-header text-center">
									<h3 class="review-title">3rd Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('add_EmployeeThirdVerbalWarning') }}" method="post">
										 @csrf
                                         <input type="hidden" class="form-control" name="getid[]" value="" id="getidjq">
											<table class="table table-bordered table-review3 review-table mb-0" id="table_thirdwarning">
												<thead>
													<tr>
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn-third-warning3"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_thirdwarning_tbody">
													 											 
													 <tr>
														<td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id[]" >
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2)
                                                                @isset($manager_emp)
                                                                    @foreach($manager_emp as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @else
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @endif
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td>
														<td><input type="text" class="form-control" name="managers_comments[]" @if(Auth::user()->role_id != 2)readonly @endif></td>
														<td><input type="text" class="form-control" name="admin_comments[]" @if(Auth::user()->role_id != 1)readonly @endif></td>
														<td></td>
													</tr>
													  
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section>   
                            <section class="review-section" >
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-bordered" >
												<tbody >
                                                    <tr>
                                                         <th>System will recommend a Performance Improvement Plan (PIP), which will be measured, and if any issues with completing that PIP, then Termination will be in effect.</th>
                                                     </tr> 	
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</section>                         
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add   Modal -->
             
            <!-- Edit Modal -->
            <div id="edit_warningemployee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">dd Edit Employees Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <section class="review-section" >
								<div class="review-header text-center">
									<h3 class="review-title">1st Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('update_EmployeeFirstVerbalWarning') }}" method="post">
										 @csrf
											<table class="table table-bordered table-review review-table mb-0" id="table_goals_firstw">
												<thead>
													<tr> 
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th>Area's for Improvement</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row-warning"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_goals_firstw_tbody">
													 											 
													 <tr>
														<td id="indexid">1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id[]" id="select_emp_id_edit" >
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2)
                                                                @isset($manager_emp)
                                                                    @foreach($manager_emp as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @else
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @endif
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]" id="employee_comments" @if(Auth::user()->role_id != 3) readonly @endif ></td>
														<td><input type="text" class="form-control" name="managers_comments[]" id="managers_comments" @if(Auth::user()->role_id != 2)readonly @endif></td>
														<td><input type="text" class="form-control" name="admin_comments[]" id="admin_comments" @if(Auth::user()->role_id != 1)readonly @endif></td>
														<td><input type="text" class="form-control" name="areas_for_improvement[]" id="areas_for_improvement" @if(Auth::user()->role_id == 3)readonly @endif></td>
                                                        <input type="hidden" class="form-control" name="getid[]" value="" id="getidjq">
														<td></td>
													</tr>
													  
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section> 
                            <section class="review-section" >
								<div class="review-header text-center">
									<h3 class="review-title">2nd Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('update_EmployeeSecondVerbalWarning') }}" method="post">
										 @csrf
                                         
											<table class="table table-bordered table-review2 review-table mb-0" id="table_secondwarning2">
												<thead>
													<tr>
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th>Area's for Improvement</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn-second-warning2"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_secondwarning2_tbody">
													 											 
													 <tr>
														<td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id[]" id="select_emp_id_edit2" >
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2)
                                                                @isset($manager_emp)
                                                                    @foreach($manager_emp as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @else
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @endif
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]" id="employee_comments2" @if(Auth::user()->role_id != 3) readonly @endif ></td>
														<td><input type="text" id="managers_comments2"  class="form-control" name="managers_comments[]" @if(Auth::user()->role_id != 2)readonly @endif></td>
														<td><input type="text" id="admin_comments2" class="form-control" name="admin_comments[]" @if(Auth::user()->role_id != 1)readonly @endif></td>
														<td><input type="text" id="areas_for_improvement2" class="form-control" name="areas_for_improvement[]" @if(Auth::user()->role_id == 3)readonly @endif></td>
														<input type="hidden" class="form-control" name="getid[]" value="" id="getidjq2">
                                                        <td></td>
													</tr>
													  
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section>
                            <section class="review-section" >
								<div class="review-header text-center">
									<h3 class="review-title">3rd Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('update_EmployeeThirdVerbalWarning') }}" method="post">
										 @csrf
                                          
											<table class="table table-bordered table-review3 review-table mb-0" id="table_thirdwarning3">
												<thead>
													<tr>
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th style="width: 64px;"><button type="button" class="btn btn-primary btn-third-warning3"><i class="fa fa-plus"></i></button></th>
													</tr>
												</thead>
												<tbody id="table_thirdwarning3_tbody">
													 											 
													 <tr>
														<td id="indexid3">1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control edit_warning_pointer" name="emp_id[]" id="select_emp_id_edit3">
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2)
                                                                @isset($manager_emp)
                                                                    @foreach($manager_emp as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @else
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                                @endif
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]" id="employee_comments3" @if(Auth::user()->role_id != 3) readonly @endif ></td>
														<td><input type="text" id="managers_comments3" class="form-control" name="managers_comments[]" @if(Auth::user()->role_id != 2)readonly @endif></td>
														<td><input type="text" id="admin_comments3" class="form-control" name="admin_comments[]" @if(Auth::user()->role_id != 1)readonly @endif></td>
                                                        <input type="hidden" class="form-control" name="getid[]" value="" id="getidjq3">
														<td></td>
													</tr>
													  
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section>   
                            <section class="review-section" >
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-bordered" >
												<tbody >
                                                    <tr>
                                                         <th>System will recommend a Performance Improvement Plan (PIP), which will be measured, and if any issues with completing that PIP, then Termination will be in effect.</th>
                                                     </tr> 	
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</section> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit FirstModal -->
            <!-- Edit Second Modal -->
            <div id="edit_second_warning" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Employees Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							 
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Second Performance Indicator Modal -->
            <!-- Edit Third Modal -->
            <div id="edit_third_warning" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Employees Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<section class="review-section" id="ProfessionalAchived">
								<div class="review-header text-center">
									<h3 class="review-title">3rd Verbal Warning</h3>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('update_EmployeeThirdVerbalWarning') }}" method="post">
										 @csrf
											<table class="table table-bordered table-review3 review-table mb-0" id="table_goals_thir">
												<thead>
													<tr>
														<th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employee</th>@endif
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th> 
                                                        @if(Auth::user()->role_id != 3)<th style="width: 64px;"><button type="button" class="btn btn-primary btn-third-warning3"><i class="fa fa-plus"></i></button></th>@endif
													</tr>
												</thead>
												<tbody id="table_goals_thir_tbody">       
													<tr>  
														<td id="indexid3"></td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id[]" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" id="select_emp_id_edit3" name="emp_id[]" readonly style="pointer-events:none;">
                                                                <option>Select Employee</option>
                                                                @isset($emp_name)
                                                                    @foreach($emp_name as $val)
                                                                        <option value="{{ $val->id }}" >{{ $val->first_name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                        </td>
                                                        @endif
														<td><input type="text" class="form-control" name="employee_comments[]" id="employee_comments3" @if(Auth::user()->role_id != 3) readonly @endif></td>
														<td><input type="text" class="form-control" name="managers_comments[]" id="managers_comments3" @if(Auth::user()->role_id != 2)readonly @endif ></td>
														<td><input type="text" class="form-control" name="admin_comments[]" id="admin_comments3" @if(Auth::user()->role_id != 1)readonly @endif></td>
                                                        <input type="hidden" class="form-control" name="getid[]" value="" id="getidjq3">
													</tr>
												</tbody>
											</table>
											<div class="review-header text-center">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</section> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Third Performance Indicator Modal -->
            <!-- Delete Performance Indicator Modal -->
            <div class="modal custom-modal fade" id="delete_EmpVerbalWarning" role="dialog">
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

 
@endsection