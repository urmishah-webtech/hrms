@extends('layout.mainlayout')
@section('content')
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Performance</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Performance</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <section class="review-section information">
                    <div class="review-header text-center">
                        <h3 class="review-title">Employee Basic Information</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap review-table mb-0">
                                    <tbody>
										<form>
                                        <tr>
                                            <td>                                              
												<div class="form-group">
													<label for="name">Employee</label>
													<input type="text" class="form-control" id="name" value="{{ @$emps->first_name }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="depart3">Department</label>
													<input type="text" class="form-control" id="depart3" value="{{ @$emps->designation->department->name}}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="departa">Designation</label>
													<input type="text" class="form-control" id="departa" value="{{ @$emps->designation->name }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
                                            </td>
                                            <td>                                                
												<div class="form-group">
													<label for="qualif1">Email</label>
													<input type="text" class="form-control" id="qualif1" value="{{ @$emps->email }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="doj">Emp ID</label>
													<input type="text" class="form-control" value="{{ @$emps->employee_id }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
												<div class="form-group">
													<label for="doj">Date of Join</label>
													<input type="text" class="form-control" id="doj" value="{{ @$emps->joing_date }}" @if (Auth::user()->role_type == "employee")readonly @endif>
												</div>
                                            </td>
                                            <td>                                               
												<div class="form-group">
													<label for="name1"> Manager's Name</label>
													<input type="text" class="form-control" id="name1" @if (Auth::user()->role_type == "employee")readonly @endif value="@if (Auth::user()->role_type == "manager"){{Auth::user()->name}}@endif">
												</div>                                      
                                            </td>
                                        </tr>
									</form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>	 
                
                <section class="review-section professional-excellence">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Excellence</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
							 <form action="{{ route('add_professionalexcel') }}" method="post">
                             @csrf
								
								 
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Key Result Area</th>
                                            <th>Key Performance Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th>
                                            <th>Points Scored <br>( self )</th>
                                            <th>Percentage achieved <br>( Manager's Score )</th>
                                            <th>Points Scored <br>( Manager )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Production</td>
                                            <td>Quality</td>
                                            <td><input type="text" class="form-control" readonly value="30"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="quality_employee" id="quality_id"value="{{ @$professional->quality_employee }}"  ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="quality_manager" id="quality_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$val->quality_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>TAT (turn around time)</td>
                                            <td><input type="text" class="form-control" readonly value="30"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="tat_employee" id="tat_id" value="{{ @$professional->tat_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="tat_manager" id="tat_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$professional->tat_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Process Improvement</td>
                                            <td>PMS,New Ideas</td>
                                            <td><input type="text" class="form-control" readonly value="10"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="pms_new_ideas_employee" id="pms_new_ideas" value="{{ @$professional->pms_new_ideas_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="pms_new_ideas_manager" id="pms_new_ideas_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$professional->pms_new_ideas_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Team Management</td>
                                            <td>Team Productivity,dynaics,attendance,attrition</td>
                                            <td><input type="text" class="form-control" readonly value="5"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="team_productivity_employee" id="team_productivity" value="{{ @$professional->team_productivity_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="team_productivity_manager" id="team_productivity_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$professional->team_productivity_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Knowledge Sharing</td>
                                            <td>Sharing the knowledge for team productivity </td>
                                            <td><input type="text" class="form-control" readonly value="5"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="knowledge_sharing_employee" id="knowledge_sharing" value="{{ @$professional->knowledge_sharing_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="knowledge_sharing_manager" id="knowledge_sharing_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$professional->knowledge_sharing_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Reporting and Communication</td>
                                            <td>Emails/Calls/Reports and Other Communication</td>
                                            <td><input type="text" class="form-control" readonly value="5"></td>
                                            <td><input type="text" class="form-control percentage_employee" name="emails_calls_employee" id="emails_calls" value="{{ @$professional->emails_calls_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control percentage_manager" name="emails_calls_manager" id="emails_calls_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$professional->emails_calls_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="85"></td>
                                            <td><input type="text" class="form-control" readonly name="total_percentage_employee" id="total_percentage_employee" value="{{ @$professional->total_percentage_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control" readonly name="total_percentage_manager" id="total_percentage_manager" value="{{ @$professional->total_percentage_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
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
                <section class="review-section personal-excellence">
                    <div class="review-header text-center">
                        <h3 class="review-title">Personal Excellence</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_personalexcel') }}" method="post">
                             @csrf
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Personal Attributes</th>
                                            <th>Key Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th>
                                            <th>Points Scored <br>( self )</th>
                                            <th>Percentage achieved <br>( Manager's Score )</th>
                                            <th>Points Scored <br>( Manager )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Attendance</td>
                                            <td>Planned or Unplanned Leaves</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="plan_leave_employee" id="plan_leave_employee" value="{{ @$personal->plan_leave_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control" name="plan_leave_manager" id="plan_leave_manager" @if (Auth::user()->role_type == "employee")readonly @endif value="{{ @$personal->plan_leave_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Time Consciousness</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="time_cons_employee" id="time_cons_employee" value="{{ @$personal->time_cons_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="time_cons_manager" id="time_cons_manager" value="{{ @$personal->time_cons_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">2</td>
                                            <td rowspan="2">Attitude & Behavior</td>
                                            <td>Team Collaboration</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="team_collaboration_employee" id="team_collaboration_employee" value="{{ @$personal->team_collaboration_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="team_collaboration_manager" id="team_collaboration_manager" value="{{ @$personal->team_collaboration_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Professionalism & Responsiveness</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="professionalism_employee" id="professionalism_employee" value="{{ @$personal->professionalism_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="professionalism_manager" id="professionalism_manager" value="{{ @$personal->professionalism_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Policy & Procedures </td>
                                            <td>Adherence to policies and procedures</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="policy_employee" id="policy_employee" value="{{ @$personal->policy_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="policy_manager" id="policy_manager" value="{{ @$personal->policy_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                        <td>4</td>
                                            <td>Initiatives</td>
                                            <td>Special Efforts, Suggestions,Ideas,etc.</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="initiatives_employee" id="initiatives_employee" value="{{ @$personal->initiatives_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="initiatives_manager" id="initiatives_manager" value="{{ @$personal->initiatives_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Continuous Skill Improvement</td>
                                            <td>Preparedness to move to next level & Training utilization</td>
                                            <td><input type="text" class="form-control" readonly value="3"></td>
                                            <td><input type="text" class="form-control personal_employee" name="improvement_employee" id="improvement_employee" value="{{ @$personal->improvement_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="improvement_manager" id="improvement_manager" value="{{ @$personal->improvement_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="15"></td>
                                            <td><input type="text" class="form-control" readonly  name="total_score_employee" id="total_score_employee" value="{{ @$personal->total_score_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0" ></td>
                                            <td><input type="text" class="form-control" readonly name="total_score_manager" id="total_score_manager" value="{{ @$personal->total_score_manager }}" @if (Auth::user()->role_type == "employee")readonly @endif></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center"><b>Total Percentage(%)</b></td>
                                            <td></td>
                                            <td colspan="2" class="text-center"><input type="text" class="form-control" name="total_percentage_employee" id="total_percentage_empl" readonly value="{{ @$personal->total_percentage_employee }}"></td>
                                            <td colspan="2" class="text-center"><input type="text" class="form-control" name="total_percentage_manager" id="total_percentage_man" readonly value="{{ @$personal->total_percentage_manager }}"></td>                                            
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="grade-span">
                                                    <h4>Grade</h4>
                                                    <span class="badge bg-inverse-danger">Below 65 Poor</span> 
                                                    <span class="badge bg-inverse-warning">65-74 Average</span> 
                                                    <span class="badge bg-inverse-info">75-84 Satisfactory</span> 
                                                    <span class="badge bg-inverse-purple">85-92 Good</span> 
                                                    <span class="badge bg-inverse-success">Above 92 Excellent</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>                            
                                <div class="review-header text-center">
									<button type="submit" name="personal" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Special Initiatives, Achievements, contributions if any</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_specialInitiatives') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_achievements">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_achievements_tbody">
                                        @php $i = 1; @endphp
                                        @if(!empty($specialInitiatives) && count($specialInitiatives) > 0)
                                        @foreach($specialInitiatives as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                            
                                        </tr>
                                        @endif  
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
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Comments on the role</h3>
                        <p class="text-muted">alterations if any requirred like addition/deletion of responsibilities</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_commentsRole') }}" method="post">
                             @csrf
                             <input class="form-control" value="" name="id" type="hidden" required> 
                                <table class="table table-bordered table-review review-table mb-0" id="table_alterations">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>                                           
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_alterations_tbody">
                                        @php $i = 1; @endphp
                                        @if(!empty($comments_role) && count($comments_role) > 0)
                                        @foreach($comments_role as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>                                            
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                            
                                        </tr>
                                        @endif  
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
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Admin Comments on the role</h3>
                        <p class="text-muted">alterations if any requirred like addition/deletion of responsibilities</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_additioncommentRole') }}" method="post">
                             @csrf
                             @php $i = 1; @endphp
                               @foreach($add_comments_id as $val)
                               <input type="hidden" class="form-control" name="getid[]" value="{{$val->id}}">
                               @php $i++; @endphp
                              @endforeach                              
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Strengths</th>
                                            <th>Area's for Improvement</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[0])){{$add_comments[0]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[0])){{$add_comments[0]['areas_improvement']}} @endif"></td>                                             
                                        </tr>                                         
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[1])){{$add_comments[1]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[1])){{$add_comments[1]['areas_improvement']}} @endif"></td>                                            
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[2])){{$add_comments[2]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[2])){{$add_comments[2]['areas_improvement']}} @endif"></td>                                             
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[3])){{$add_comments[3]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[3])){{$add_comments[3]['areas_improvement']}} @endif"></td>                                             
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[4])){{$add_comments[4]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[4])){{$add_comments[4]['areas_improvement']}} @endif"></td>                                            
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
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Appraisee's Strengths and Areas for Improvement perceived by the Reporting officer</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('add_appraiseestrength') }}" method="post">
                                @csrf
                                @php $i = 1; @endphp
                                @foreach($add_appraiseest_id as $val)
                                <input type="hidden" class="form-control" name="getid[]" value="{{$val->id}}">
                                @php $i++; @endphp
                                @endforeach      
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Strengths</th>
                                            <th>Area's for Improvement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['areas_improvement']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['areas_improvement']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['strengths']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['areas_improvement']}} @endif"></td>
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
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Personal Goals</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('add_personalGoal') }}" method="post">
                                @csrf
                                @php $i = 1; @endphp
                                @foreach($add_personalgoal_id as $val)
                                <input type="hidden" class="form-control" name="getid[]" value="{{$val->id}}">
                                @php $i++; @endphp
                                @endforeach
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Goal Achieved during last year</th>
                                            <th>Goal set for current year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[0])){{$add_personalgoal[0]['goal_last_year']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[0])){{$add_personalgoal[0]['goal_current_year']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[1])){{$add_personalgoal[1]['goal_last_year']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[1])){{$add_personalgoal[1]['goal_current_year']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[2])){{$add_personalgoal[2]['goal_last_year']}} @endif"></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[2])){{$add_personalgoal[2]['goal_current_year']}} @endif"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                 
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Goals Achieved for last year</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_professional_achived') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_goals">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_goals_tbody">
                                        @php $i = 1; @endphp
                                        @if(!empty($professional_achived) && count($professional_achived) > 0)
                                        @foreach($professional_achived as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif  
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
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Goals for the forthcoming year</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_professional_forthcoming') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_forthcoming">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>By Self</th>
                                            <th>Manager's Comment</th>
                                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_forthcoming_tbody">
                                        @php $i = 1; @endphp
                                        @if(!empty($professional_forthcoming) && count($professional_forthcoming) > 0)
                                        @foreach($professional_forthcoming as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form> 
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Training Requirements</h3>
                        <p class="text-muted">if any to achieve the Performance Standard Targets completely</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_training_requirements') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="table_targets">
                                    <thead>
                                        <tr>
                                        <th style="width:40px;">#</th>
                                        <th>By Self</th>
                                        <th>Manager's Comment</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_targets_tbody">
                                        @php $i = 1; @endphp
                                        @if(!empty($training_requirements) && count($training_requirements) > 0)
                                        @foreach($training_requirements as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif  
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

                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">Any other general comments, observations, suggestions etc.</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_general_comment') }}" method="post">
                             @csrf
                                <table class="table table-bordered table-review review-table mb-0" id="general_comments">
                                    <thead>
                                        <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Self</th>
                                        <th>Manager</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody id="general_comments_tbody" >
                                        @php $i = 1; @endphp
                                        @if(!empty($general_comment) && count($general_comment) > 0)
                                        @foreach($general_comment as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->employee_comments}}"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comments}}"></td>
                                           <td></td>
                                           <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""></td>
                                            <td></td>
                                        </tr>
                                        @endif 
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

                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">For Manager's Use Only</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_perfomancemanageruse') }}" method="post">
                             @csrf
                             @php $i = 1; @endphp
                               @foreach($add_manager_id as $val)
                               <input type="hidden" class="form-control" name="getid[]" value="{{$val->id}}">
                               @php $i++; @endphp
                              @endforeach 
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Yes/No</th>
                                            <th>If Yes - Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>The Team member has Work related Issues</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The Team member has Work related Issues">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[0])) @if($perfomancemanageruse[0]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[0])) @if($perfomancemanageruse[0]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[0])){{$perfomancemanageruse[0]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>The Team member has Leave Issues</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The Team member has Leave Issues">
                                            <td>
                                            <select class="form-control select" name="select_option[]">
                                                <option value="">Select</option>
                                                <option  @if(isset($perfomancemanageruse[1])) @if($perfomancemanageruse[1]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                <option @if(isset($perfomancemanageruse[1])) @if($perfomancemanageruse[1]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                            </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[1])){{$perfomancemanageruse[1]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>The team member has Stability Issues</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The team member has Stability Issues">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[2])) @if($perfomancemanageruse[2]['select_option']  == "Yes") selected @endif @endif  value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[2])) @if($perfomancemanageruse[2]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[2])){{$perfomancemanageruse[2]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>The Team member exhibits non-supportive attitude</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="The Team member exhibits non-supportive attitude">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[3])) @if($perfomancemanageruse[3]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[3])) @if($perfomancemanageruse[3]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[3])){{$perfomancemanageruse[3]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>Any other points in specific to note about the team member</td>
                                            <input type="hidden" class="form-control" name="issues[]" value="Any other points in specific to note about the team member">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[4])) @if($perfomancemanageruse[4]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[4])) @if($perfomancemanageruse[4]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[4])){{$perfomancemanageruse[4]['yes_details']}} @endif"></td>
                                        </tr>
                                        <tr>
                                        <td>Overall Comment /Performance of the team member</td>
                                        <input type="hidden" class="form-control" name="issues[]" value="Overall Comment /Performance of the team member">
                                            <td>
                                                <select class="form-control select" name="select_option[]">
                                                    <option value="">Select</option>
                                                    <option @if(isset($perfomancemanageruse[5])) @if($perfomancemanageruse[5]['select_option']  == "Yes") selected @endif @endif value="Yes">Yes</option>
                                                    <option @if(isset($perfomancemanageruse[5])) @if($perfomancemanageruse[5]['select_option']  == "No") selected @endif @endif value="No">No</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="yes_details[]" value="@if(isset($perfomancemanageruse[5])){{$perfomancemanageruse[5]['yes_details']}} @endif"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="review-header text-center">
									<button type="submit"  class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <form action="{{ route('add_perfomanceIdentitie') }}" method="post">
                            @csrf
                            @php $i = 1; @endphp
                               @foreach($add_perfoIdent as $val)
                               <input type="hidden" class="form-control" name="getid[]" value="{{$val->id}}">
                               @php $i++; @endphp
                              @endforeach 
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Signature</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employee</td>
                                        <input type="hidden" name="user_role[]" value="Employee">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent[0])){{$add_perfoIdent[0]['name']}} @endif"></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent[0])){{$add_perfoIdent[0]['signature']}} @endif"></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control " name="date[]" value="@if(isset($add_perfoIdent[0])){{$add_perfoIdent[0]['date']}} @endif"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Manager</td>
                                        <input type="hidden" name="user_role[]" value="Manager">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent[1])){{$add_perfoIdent[1]['name']}} @endif"></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent[1])){{$add_perfoIdent[1]['signature']}} @endif"></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control" name="date[]" value="@if(isset($add_perfoIdent[1])){{$add_perfoIdent[1]['date']}} @endif"></div></td>
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

            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->
@endsection
 