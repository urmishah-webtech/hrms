@extends('layout.mainlayout')
@section('content')
<?php use App\Employee ?>
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
                                <li class="breadcrumb-item active">Edit Performance</li>
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
									<form action="{{ route('add_managerid_Employees') }}" method="post">
										@csrf 
										<input type="hidden" name="id" value="{{ @$emps->id }}">
                                        <tr>
                                            <td>                                              
												<div class="form-group">
													<label for="name">Employee</label>
													<input type="text" class="form-control" id="name" value="{{ @$emps->first_name }}" readonly>
												</div>
												<div class="form-group">
													<label for="depart3">Department</label>
													<input type="text" class="form-control" id="depart3" value="{{ @$emps->designation->department->name}}" readonly>
												</div>
												<div class="form-group">
													<label for="departa">Designation</label>
													<input type="text" class="form-control" id="departa" value="{{ @$emps->designation->name }}" readonly>
												</div>
                                            </td>
                                            <td>                                                
												<div class="form-group">
													<label for="qualif1">Email</label>
													<input type="text" class="form-control" id="qualif1" value="{{ @$emps->email }}" readonly>
												</div>
												<div class="form-group">
													<label for="doj">Emp ID</label>
													<input type="text" class="form-control" value="{{ @$emps->employee_id }}" readonly>
												</div>
												<div class="form-group">
													<label for="doj">Date of Join</label>
													<input type="text" class="form-control" id="doj" value="{{ @$emps->joing_date }}" readonly>
												</div>
                                            </td>
                                            <td>                                               
												<div class="form-group">
													<label for="name1"> Manager's Name</label>
														@isset($emps)
														@php $man_name = Employee::where('id',  @$emps->man_id )->first();
														@endphp
														<input type="hidden" name="get_manager_id" value="{{ @$man_name->first_name }}">
														@endisset 
													<select class="form-control" name="man_id" id="edit_manager_id" required @if(Auth::user()->role_id==2)disabled @endif>
														<option value="">Select Manager</option>
														@isset($manager_user)
															@foreach ($manager_user as $item)
															<option @if($item->first_name == @$man_name->first_name)selected @endif value="{{ $item->id }}">{{ $item->first_name.' '.$item->last_name }}</option> 
															@endforeach							
														@endisset
													</select>										 
												</div> 
												<div class="review-header text-center" style="border:none;">
												<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
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
                
                <section class="review-section professional-excellence" id="professionalexcel">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Excellence</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
							 <form action="{{ route('edit_man_professionalExcellence') }}" method="post">
                             @csrf 

                             <input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">  
								 
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
                                        <?php if($prof_excel){
                                        $prof_data = json_decode($prof_excel->percentage_achieved_employee, true);
                                        $scoredemp = json_decode($prof_excel->points_scored_employee, true);
                                        $achi_man = json_decode($prof_excel->percentage_achieved_manager, true);
                                        $score_man = json_decode($prof_excel->points_scored_manager, true);
                                        } ?>                       
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Leadership</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="1">                                             
                                            <td>Staff Retention</td>                                            
                                            <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee1" value="@isset($prof_data){{$prof_data[1]['percentage_achieved_employee']}}@endisset" @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee1" value="@isset($prof_data){{$scoredemp[1]['points_scored_employee']}}@endisset" @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager1" value="@isset($prof_data){{$achi_man[1]['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" name="points_scored_manager[]" class="form-control scored_manager" id="scored_manager1" value="@isset($prof_data){{$score_man[1]['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="key_no[]" class="form-control" value="1.2">
                                            <td>Positive 360 degrees feedback from colleagues</td>                                            
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee12" value="@isset($prof_data){{$prof_data['1.2']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" name="points_scored_employee[]" class="form-control scored_employee" id="scored_employee12" value="@isset($prof_data){{$scoredemp['1.2']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager12" value="@isset($prof_data){{$achi_man['1.2']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" class="form-control scored_manager" name="points_scored_manager[]" id="scored_manager12" value="@isset($prof_data){{$score_man['1.2']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <td rowspan="2">2</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="2.1">
                                            <td rowspan="2">Customer Satisfaction</td>                                             
                                            <td >Customer feedback from mystery shopping</td>
                                            <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee21" value="@isset($prof_data){{$prof_data['2.1']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" name="points_scored_employee[]" class="form-control scored_employee" id="scored_employee21" value="@isset($prof_data){{$scoredemp['2.1']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager21" value="@isset($prof_data){{$achi_man['2.1']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" name="points_scored_manager[]" class="form-control scored_manager" id="scored_manager21" value="@isset($prof_data){{$score_man['2.1']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="key_no[]" class="form-control" value="2.2">
                                            <td>Zero complains</td>
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee22" value="@isset($prof_data){{$prof_data['2.2']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee"  name="points_scored_employee[]" id="scored_employee22" value="@isset($prof_data){{$scoredemp['2.2']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager22" value="@isset($prof_data){{$achi_man['2.2']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" class="form-control scored_manager" name="points_scored_manager[]" id="scored_manager22" value="@isset($prof_data){{$score_man['2.2']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <td rowspan="2">3</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="3.1">
                                            <td rowspan="2">Sales Goals / Increase / Operational Excellence</td>
                                            <td>Company financials</td>
                                           <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee31" value="@isset($prof_data){{$prof_data['3.1']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee31" value="@isset($prof_data){{$scoredemp['3.1']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager31"  value="@isset($prof_data){{$achi_man['3.1']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" name="points_scored_manager[]" class="form-control scored_manager" id="scored_manager31" value="@isset($prof_data){{$score_man['3.1']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="key_no[]" class="form-control" value="3.2">
                                            <td>Retail Standard Audit / Regulatory Audit</td>
                                           <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee32" value="@isset($prof_data){{$prof_data['3.2']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee32" value="@isset($prof_data){{$scoredemp['3.2']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager32"  value="@isset($prof_data){{$achi_man['3.2']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" class="form-control scored_manager" name="points_scored_manager[]" id="scored_manager32" value="@isset($prof_data){{$score_man['3.2']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <td rowspan="3">4</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="4.1">
                                            <td rowspan="3">Professional Development </td>
                                            <td>Completion of learning journey </td>
                                            <td rowspan="3"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee41" value="@isset($prof_data){{$prof_data['4.1']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee41" value="@isset($prof_data){{$scoredemp['4.1']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager41"  value="@isset($prof_data){{$achi_man['4.1']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" class="form-control scored_manager" name="points_scored_manager[]" id="scored_manager41" value="@isset($prof_data){{$score_man['4.1']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value=" ">
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="key_no[]" class="form-control" value="4.2">
                                            <td>Well trained team</td>    
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee42" value="@isset($prof_data){{$prof_data['4.2']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee42" value="@isset($prof_data){{$scoredemp['4.2']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager42"  value="@isset($prof_data){{$achi_man['4.2']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" class="form-control scored_manager" name="points_scored_manager[]" id="scored_manager42" value="@isset($prof_data){{$score_man['4.2']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value=" ">
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="key_no[]" class="form-control" value="4.3">
                                            <td>Team performance</td>
                                            <td><input type="text" class="form-control achieved_employee" name="percentage_achieved_employee[]" id="achieved_employee43" value="@isset($prof_data){{$prof_data['4.3']['percentage_achieved_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee43" value="@isset($prof_data){{$scoredemp['4.3']['points_scored_employee']}}@endisset"  @if (Auth::user()->role_id != 3)readonly @endif></td>
                                            <td><input type="text" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager43" value="@isset($prof_data){{$achi_man['4.3']['percentage_achieved_manager']}}@endisset"></td>
                                            <td><input type="text" class="form-control scored_manager" name="points_scored_manager[]" id="scored_manager43" value="@isset($prof_data){{$score_man['4.3']['points_scored_manager']}}@endisset"></td>
                                            <input type="hidden" class="form-control" name="getid[]" value=" ">
                                        </tr>                                         
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="100%"></td>
                                            <td> 
                                            <input type="text" class="form-control" readonly name="total_achieved_employee" id="total_achieved_employee" value="{{@$prof_excel->total_achieved_employee}}"></td>
                                            <td> 
                                            <input type="text" class="form-control" name="total_scored_employee" id="total_scored_employee" readonly value="{{@$prof_excel->total_scored_employee}}"></td>
                                            <td><input type="text" class="form-control" readonly name="total_achieved_manager" id="total_achieved_manager" value="{{@$prof_excel->total_achieved_manager}}"></td>
                                            <td><input type="text" class="form-control" name="total_scored_manager" id="total_scored_manager" readonly value="{{@$prof_excel->total_scored_manager}}"></td>
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
                <section class="review-section personal-excellence" id="PersonalExcellence">
                    <div class="review-header text-center">
                        <h3 class="review-title">Personal Excellence</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_PersonalExcellence') }}" method="post">
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
                                            <td><input type="text" class="form-control personal_employee" name="plan_leave_employee" id="plan_leave_employee" value="{{ @$personal->plan_leave_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control" name="plan_leave_manager" id="plan_leave_manager" value="{{ @$personal->plan_leave_manager }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <input type="hidden" name="getid" value="@if(isset($personal)){{ $personal->emp_id}}@endif">
                                            <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        </tr>
                                        <tr>
                                            <td>Time Consciousness</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="time_cons_employee" id="time_cons_employee" value="{{ @$personal->time_cons_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="time_cons_manager" id="time_cons_manager" value="{{ @$personal->time_cons_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">2</td>
                                            <td rowspan="2">Attitude & Behavior</td>
                                            <td>Team Collaboration</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="team_collaboration_employee" id="team_collaboration_employee" value="{{ @$personal->team_collaboration_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="team_collaboration_manager" id="team_collaboration_manager" value="{{ @$personal->team_collaboration_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Professionalism & Responsiveness</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="professionalism_employee" id="professionalism_employee" value="{{ @$personal->professionalism_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="professionalism_manager" id="professionalism_manager" value="{{ @$personal->professionalism_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Policy & Procedures </td>
                                            <td>Adherence to policies and procedures</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="policy_employee" id="policy_employee" value="{{ @$personal->policy_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="policy_manager" id="policy_manager" value="{{ @$personal->policy_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                        <td>4</td>
                                            <td>Initiatives</td>
                                            <td>Special Efforts, Suggestions,Ideas,etc.</td>
                                            <td><input type="text" class="form-control" readonly value="2"></td>
                                            <td><input type="text" class="form-control personal_employee" name="initiatives_employee" id="initiatives_employee" value="{{ @$personal->initiatives_employee }}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="initiatives_manager" id="initiatives_manager" value="{{ @$personal->initiatives_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Continuous Skill Improvement</td>
                                            <td>Preparedness to move to next level & Training utilization</td>
                                            <td><input type="text" class="form-control" readonly value="3"></td>
                                            <td><input type="text" class="form-control personal_employee" name="improvement_employee" id="improvement_employee" value="{{ @$personal->improvement_employee }}" readonly></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                            <td><input type="text" class="form-control personal_manager" name="improvement_manager" id="improvement_manager" value="{{ @$personal->improvement_manager }}" ></td>
                                            <td><input type="text" class="form-control" readonly value="0"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="15"></td>
                                            <td><input type="text" class="form-control" readonly  name="total_score_employee" id="total_score_employee" value="{{ @$personal->total_score_employee }}"></td>
                                            <td><input type="text" class="form-control" readonly value="0" ></td>
                                            <td><input type="text" class="form-control" readonly name="total_score_manager" id="total_score_manager" value="{{ @$personal->total_score_manager }}"  readonly ></td>
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

                <section class="review-section" id="specialInitiatives">
                    <div class="review-header text-center">
                        <h3 class="review-title">Special Initiatives, Achievements, contributions if any</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_SpecialInitiatives') }}" method="post">
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
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($specialInitiatives) && count($specialInitiatives) > 0)
                                        @foreach($specialInitiatives as $val)
                                        <tr>
                                        <input type="hidden" name="getid" value="@if(isset($specialInitiatives)){{ $val->emp_id}}@endif">
                                        
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
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
                <section class="review-section" id="CommentsRole">
                    <div class="review-header text-center">
                        <h3 class="review-title">Comments on the role</h3>
                        <p class="text-muted">alterations if any requirred like addition/deletion of responsibilities</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_CommentsRole') }}" method="post">
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
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($comments_role) && count($comments_role) > 0)
                                        @foreach($comments_role as $val)
                                        <tr>
                                            <input type="hidden" name="getid" value="@if(isset($comments_role)){{ $val->emp_id}}@endif">
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"   readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>                                            
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly></td>
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
                
                <section class="review-section" id="AdditionCommentRole">
                    <div class="review-header text-center">
                        <h3 class="review-title">Comments on the role</h3>
                        <p class="text-muted">alterations if any requirred like addition/deletion of responsibilities</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_AdditionComment') }}" method="post">
                             @csrf
                             
                             <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                             @php $i = 1; @endphp
                               @foreach($add_comments_id as $val)
                               <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_comments_id)){{ $val->emp_id}}@endif">
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
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[0])){{$add_comments[0]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[0])){{$add_comments[0]['areas_improvement']}} @endif"></td>                                             
                                        </tr>                                         
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[1])){{$add_comments[1]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[1])){{$add_comments[1]['areas_improvement']}} @endif"></td>                                            
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[2])){{$add_comments[2]['strengths']}} @endif"  ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[2])){{$add_comments[2]['areas_improvement']}} @endif"></td>                                             
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[3])){{$add_comments[3]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_comments[3])){{$add_comments[3]['areas_improvement']}} @endif"></td>                                             
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_comments[4])){{$add_comments[4]['strengths']}} @endif" ></td>
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
                <section class="review-section" id="AppraiseeStrength">
                    <div class="review-header text-center">
                        <h3 class="review-title">Appraisee's Strengths and Areas for Improvement perceived by the Reporting officer</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('edit_man_AppraiseeStrength') }}" method="post">
                                @csrf
                                <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                @php $i = 1; @endphp
                                @foreach($add_appraiseest_id as $val)
                                <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_appraiseest_id)){{ $val->emp_id}}@endif">                                 
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
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['areas_improvement']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['strengths']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['areas_improvement']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['strengths']}} @endif"  ></td>
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
                
                <section class="review-section" id="PersonalGoal">
                    <div class="review-header text-center">
                        <h3 class="review-title">Personal Goals</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('edit_man_PersonalGoal') }}" method="post">
                                @csrf
                                <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                @php $i = 1; @endphp
                                @foreach($add_personalgoal_id as $val)
                                <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_personalgoal_id)){{ $val->emp_id}}@endif">
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
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[0])){{$add_personalgoal[0]['goal_last_year']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[0])){{$add_personalgoal[0]['goal_current_year']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[1])){{$add_personalgoal[1]['goal_last_year']}} @endif" ></td>
                                            <td><input type="text" class="form-control" name="goal_current_year[]" value="@if(isset($add_personalgoal[1])){{$add_personalgoal[1]['goal_current_year']}} @endif"></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="goal_last_year[]" value="@if(isset($add_personalgoal[2])){{$add_personalgoal[2]['goal_last_year']}} @endif"  ></td>
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
                 
                <section class="review-section" id="ProfessionalAchived">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Goals Achieved for last year</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_ProfessionalGoalsAchieved') }}" method="post">
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
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($professional_achived) && count($professional_achived) > 0)
                                        @foreach($professional_achived as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" name="getid" value="@if(isset($professional_achived)){{ $val->emp_id}}@endif" >
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
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
                
                <section class="review-section" id="ProfForthcoming">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Goals for the forthcoming year</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_ProfessionalGoalsForthcoming') }}" method="post">
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
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($professional_forthcoming) && count($professional_forthcoming) > 0)
                                        @foreach($professional_forthcoming as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly  ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                            <input type="hidden" name="getid" value="@if(isset($professional_forthcoming)){{ $val->emp_id}}@endif">
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
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
                
                <section class="review-section" id="TrainingRequirement">
                    <div class="review-header text-center">
                        <h3 class="review-title">Training Requirements</h3>
                        <p class="text-muted">if any to achieve the Performance Standard Targets completely</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_TrainingRequirements') }}" method="post">
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
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($training_requirements) && count($training_requirements) > 0)
                                        @foreach($training_requirements as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}" readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                            <input type="hidden" name="getid" value="@if(isset($training_requirements)){{ $val->emp_id}}@endif">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly ></td>
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

                <section class="review-section" id="GeneralComment">
                    <div class="review-header text-center">
                        <h3 class="review-title">Any other general comments, observations, suggestions etc.</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_OtherGeneralComment') }}" method="post">
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
                                        <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                                        @php $i = 1; @endphp
                                        @if(!empty($general_comment) && count($general_comment) > 0)
                                        @foreach($general_comment as $val)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->employee_comments}}"readonly ></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comments}}"></td>
                                           <td></td>
                                           <input type="hidden" name="getid" value="@if(isset($general_comment)){{ $val->emp_id}}@endif">
                                           <input type="hidden" class="form-control" name="getid_arry[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" readonly @if (Auth::user()->role_id == 3)editable @endif></td>
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

               <section class="review-section" id="PerfomanceManagerUse">
                    <div class="review-header text-center">
                        <h3 class="review-title">For Manager's Use Only</h3>
                        <p class="text-muted">Lorem ipsum dollar</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('edit_man_PerfomanceManagerUse') }}" method="post">
                             @csrf
                             <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                             @php $i = 1; @endphp
                               @foreach($perfomancemanageruse as $val)
                               <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($perfomancemanageruse)){{ $val->emp_id}}@endif">
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
                <section class="review-section row" id="PerfomanceIdentitie">
                    <div class="col-md-12">
                        <div class="">
                        <form action="{{ route('edit_manPerformanceIdentity') }}" method="post">
                            @csrf
                            <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                            @php $i = 1; @endphp
                               @foreach($add_perfoIdent as $val)
                               <input type="hidden" class="form-control" name="getid_arry[]" value="{{$val->id}}">
                               <input type="hidden" name="getid" value="@if(isset($add_perfoIdent)){{ $val->emp_id}}@endif">
                               @php $i++; @endphp
                              @endforeach 
                            <table id="identity" class="table table-bordered review-table mb-0">
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
                                        <input type="hidden" name="user_role[]" value="3">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent_employ[0])){{$add_perfoIdent_employ[0]['name']}} @endif" readonly></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent_employ[0])){{$add_perfoIdent_employ[0]['signature']}} @endif" readonly></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control datetimepicker" name="date[]" value="@if(isset($add_perfoIdent_employ[0])){{$add_perfoIdent_employ[0]['date']}} @endif" readonly></div></td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Manager</td>
                                        <input type="hidden" name="user_role[]" value="2">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent_man[1])){{$add_perfoIdent_man[1]['name']}} @endif"></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent_man[1])){{$add_perfoIdent_man[1]['signature']}} @endif"></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control datetimepicker" name="date[]" value="@if(isset($add_perfoIdent_man[1])){{$add_perfoIdent_man[1]['date']}} @endif"></div></td>

                                    </tr>
                                     
                                </tbody>
                            </table>
                            <div class="review-header text-center">
									<button type="submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                        </div>
                    </div>
                </section>
                <div class="row" >
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <form action="{{ route('add_Perfomance_status') }}" method="post">
                            @csrf
                            <input type="hidden" name="empid" value="@if(isset($emp_id)){{ $emp_id->id}}@endif">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">                                 
                                <div class="review-header text-center">
                                <button type="submit" class="btn btn-primary submit-btn"><input type="hidden" name="perfomance_status" value="1" id="perfomance_status">Complete Status</button>
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		<?php  
		$hr_id = Employee::where('role_id',5)->get();
    
        foreach($hr_id as $hr_id)
        {
		    $compl= Employee::where('performance_completed_by',$hr_id->id)->where('id',$emp_hrcomp)->where('perfomance_status',1)->first();  
           
        
       
		if($compl){?>
		jQuery("input").attr('disabled','disabled');
		jQuery("select").attr('disabled','disabled');
		jQuery(".btn-add-row").css('pointer-events','none');
		});
		<?php }
        }
		 ?>
		</script>	 