@extends('layout.mainlayout')
@section('content')
<?php use App\Employee ?>
<?php use App\OtherGeneralComment ?>
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
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap review-table mb-0">
                                    <tbody>
										 
                                        <tr>
                                            <td>                                              
												<div class="form-group">
													<label for="name">Employee</label>
													<input type="text" class="form-control" id="name" value="{{ @$emps->first_name }}" @if (Auth::user()->role_id == 3)readonly @endif>
												</div>
												<div class="form-group">
													<label for="depart3">Department</label>
													<input type="text" class="form-control" id="depart3" value="{{ @$emps->designation->department->name}}" @if (Auth::user()->role_id == 3)readonly @endif>
												</div>
												<div class="form-group">
													<label for="departa">Designation</label>
													<input type="text" class="form-control" id="departa" value="{{ @$emps->designation->name }}" @if (Auth::user()->role_id == 3)readonly @endif>
												</div>
                                            </td>
                                            <td>                                                
												<div class="form-group">
													<label for="qualif1">Email</label>
													<input type="text" class="form-control" id="qualif1" value="{{ @$emps->email }}" @if (Auth::user()->role_id == 3)readonly @endif>
												</div>
												<div class="form-group">
													<label for="doj">Emp ID</label>
													<input type="text" class="form-control" value="{{ @$emps->employee_id }}" @if (Auth::user()->role_id == 3)readonly @endif>
												</div>
												<div class="form-group">
													<label for="doj">Date of Join</label>
													<input type="text" class="form-control" id="doj" value="{{ @$emps->joing_date }}" @if (Auth::user()->role_id == 3)readonly @endif>
												</div>
                                            </td>
                                            <td>     
											<form action="{{ route('add_Perfomance_date_for_employee') }}" method="post">	
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">  
												<div class="cal-icon">
													<label for="name1">Performance Date</label>
													<input type="text" class="form-control datetimepicker" name="perfomance_date" value="{{ @$emps->perfomance_date }}"> 
												</div> 
												<button type="submit" id="comple_stat" class="btn btn-primary submit-btn"> SUBMIT</button> 
											</form>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>	 
                
                <section class="review-section professional-excellence" id="professionalexcel">
                    <div class="review-header text-center">
                        <h3 class="review-title">Professional Excellence</h3>
                        <p class="text-muted">Key Performance Indicators</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
							 <form action="{{ route('add_KeyprofessionalExcellences') }}" method="post" id="professionalExcellence">
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
                                            <!--<th>Points Scored <br>( self )</th>-->
                                            <th>Percentage achieved <br>( Manager's Score )</th>
                                            <!--<th>Points Scored <br>( Manager )</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <?php if($prof_excel){
                                        $prof_data1 = json_decode($prof_excel->percentage_achieved_employee, true);
                                        $scoredemp = json_decode($prof_excel->points_scored_employee, true);
                                        $achi_man1 = json_decode($prof_excel->percentage_achieved_manager, true);
                                        $score_man = json_decode($prof_excel->points_scored_manager, true);
                                        } ?>                       
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Leadership</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="1">                                             
                                            <td>Staff Retention</td>                                            
                                            <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td rowspan="2"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee1" value="@isset($prof_data1){{$prof_data1[1]['percentage_achieved_employee']}}@endisset" max="25" required></td>
                                            <!--<td><input type="text" class="form-control scored_employee" name="points_scored_employee[]" id="scored_employee1" value=""></td>-->
                                            <td rowspan="2"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager1" value="@isset($prof_data1){{$achi_man1[1]['percentage_achieved_manager']}}@endisset" max="25" readonly></td>
                                            <!--<td><input type="text" name="points_scored_manager[]" class="form-control scored_manager" id="scored_manager1" value=" " readonly></td>-->
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <td>Positive 360 degrees feedback from colleagues</td>  
                                        </tr>
                                        <tr>
                                            <td rowspan="2">2</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="2.1">
                                            <td rowspan="2">Customer Satisfaction</td>                                             
                                            <td >Customer feedback from mystery shopping</td>
                                            <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td rowspan="2"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee21" value="@isset($prof_data1){{$prof_data1['2.1']['percentage_achieved_employee']}}@endisset" max="25"></td> 
                                            <td rowspan="2"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager21" value="@isset($prof_data1){{$achi_man1['2.1']['percentage_achieved_manager']}}@endisset" max="25" readonly></td> 
                                            <input type="hidden" class="form-control" name="getid[]" value="">
                                        </tr>
                                        <tr>
                                            <td>Zero complains</td> 
                                        </tr>
                                        <tr>
                                            <td rowspan="2">3</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="3.1">
                                            <td rowspan="2">Sales Goals / Increase / Operational Excellence</td>
                                            <td>Company financials</td>
                                           <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td rowspan="2"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee31" value="@isset($prof_data1){{$prof_data1['3.1']['percentage_achieved_employee']}}@endisset" max="25"></td> 
                                            <td rowspan="2"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager31"  value="@isset($prof_data1){{$achi_man1['3.1']['percentage_achieved_manager']}}@endisset" readonly max="25"></td> 
                                        </tr>
                                        <tr> 
                                            <td>Retail Standard Audit / Regulatory Audit</td>
                                           
                                        </tr>
                                        <tr>
                                            <td rowspan="3">4</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="4.1">
                                            <td rowspan="3">Professional Development </td>
                                            <td>Completion of learning journey </td>
                                            <td rowspan="3"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td rowspan="3"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee41" value="@isset($prof_data1){{$prof_data1['4.1']['percentage_achieved_employee']}}@endisset" max="25"></td> 
                                            <td rowspan="3"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager41"  value="@isset($prof_data1){{$achi_man1['4.1']['percentage_achieved_manager']}}@endisset" max="25" readonly></td> 
                                        </tr>
                                        <tr>
                                             <td>Well trained team</td>    
                                             
                                        </tr>
                                        <tr>
                                             <td>Team performance</td>
                                             
                                        </tr>                                         
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="100%"></td>
                                            <td> 
                                            <input type="text" class="form-control" readonly name="total_achieved_employee" id="total_achieved_employee" value="{{@$prof_excel->total_achieved_employee}}"></td> 
                                            <td><input type="text" class="form-control" readonly name="total_achieved_manager" id="total_achieved_manager" value="{{@$prof_excel->total_achieved_manager}}"></td>
                                             
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
                        <h3 class="review-title">Personal & Behavioral Excellence</h3>
                        <p class="text-muted">Adhering to Wazobia Core Values</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_personalexcel') }}" method="post" id="personal_Behavioralexcel">
                             @csrf
								<input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">   
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Personal Attributes</th>
                                            <th>Key Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th>
                                            <!--<th>Points Scored <br>( self )</th>-->
                                            <th>Percentage achieved <br>( Manager's Score )</th>
                                            <!--<th>Points Scored <br>( Manager )</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if($per_excel){
                                        $prof_data = json_decode($per_excel->percentage_achieved_employee, true);
                                        $scoredemp = json_decode($per_excel->points_scored_employee, true);
                                        $achi_man = json_decode($per_excel->percentage_achieved_manager, true);
                                        $score_man = json_decode($per_excel->points_scored_manager, true);
                                        } ?>  
                                        <tr>
                                            <td rowspan="3">1</td>
                                            <td rowspan="3">Customer Oriented</td>
											<input type="hidden" name="key_no[]" class="form-control" value="1">
                                            <td>Keep customers as our Top Priority</td>
                                            <td rowspan="3"><input type="text" class="form-control" readonly value="25%" ></td>
                                            <td rowspan="3"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee1" value="@isset($prof_data){{$prof_data[1]['percentage_achieved_employee']}}@endisset" required max="25"></td> 
                                            <td rowspan="3"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager1" value="@isset($prof_data){{$achi_man['1']['percentage_achieved_manager']}}@endisset" max="25" @if (Auth::user()->role_id == 3)readonly @endif >
											 </td>
                                             
                                        </tr>
                                        <tr>
                                            <td>Listens to our customers and consistently seek ways to meet their needs.</td>  
                                        </tr>
										<tr>
                                            <td>Considers customers in all business decisions.</td> 
                                        </tr>
                                        <tr>
                                            <td rowspan="4">2</td>
                                            <td rowspan="4">People/Staff Development </td>
											<input type="hidden" name="key_no[]" class="form-control" value="2.1">
                                            <td>Ready to be of assistance to others</td>
                                            <td rowspan="4"><input type="text" class="form-control" readonly value="15%"></td>
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee21" value="@isset($prof_data){{$prof_data['2.1']['percentage_achieved_employee']}}@endisset" max="15"></td> 
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager21" value="@isset($prof_data){{$achi_man['2.1']['percentage_achieved_manager']}}@endisset" max="15" @if (Auth::user()->role_id == 3)readonly @endif ></td> 
                                        </tr>
                                        <tr>
                                            <td>Committed to teams professional and personal growth</td>  
                                        </tr>
										<tr>
                                            <td>Inspires and motivate teams by displaying positive attitude.</td> 
											 
                                        </tr>
										<tr>
                                            <td>Promotes a 'We' mentality instead of a 'Me' mentality.</td> 
											 
                                        </tr>
                                        <tr>
                                            <td rowspan="4">3</td>
                                            <td rowspan="4">Respect</td>
											<input type="hidden" name="key_no[]" class="form-control" value="3.1">
                                            <td>Does not discriminate</td>
                                            <td rowspan="4"><input type="text" class="form-control" readonly value="15%"></td>
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee31" value="@isset($prof_data){{$prof_data['3.1']['percentage_achieved_employee']}}@endisset" max="15"></td> 
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager31" value="@isset($prof_data){{$achi_man['3.1']['percentage_achieved_manager']}}@endisset" max="15" @if (Auth::user()->role_id == 3)readonly @endif ></td> 
                                        </tr>
										<tr>
                                            <td>Considerate and shows respect to others.</td> 
											 
                                        </tr>
										<tr>
                                            <td>Kind to others</td> 
											 
                                        </tr>
										<tr>
                                            <td>Seeks no reward for help rendered.</td> 
											 
                                        </tr>
                                        <tr>
                                        <td rowspan="4">4</td>
                                            <td rowspan="4">Consistent </td>
											<input type="hidden" name="key_no[]" class="form-control" value="4.1">
                                            <td>Punctual</td>
                                            <td rowspan="4"><input type="text" class="form-control" readonly value="15%"></td>
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee41" value="@isset($prof_data){{$prof_data['4.1']['percentage_achieved_employee']}}@endisset" max="15"></td> 
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager41" value="@isset($prof_data){{$achi_man['4.1']['percentage_achieved_manager']}}@endisset" max="15" @if (Auth::user()->role_id == 3)readonly @endif ></td> 
                                        </tr>
										<tr>
                                            <td>Consistently delivers excellence in all activities</td> 
											 
                                        </tr>
										<tr>
                                            <td>Delivers consistent customer experience at every touch point.</td> 
											 
                                        </tr>
										<tr>
                                            <td>Consistently take up challenges</td> 
											 
                                        </tr>
                                        <tr>
                                            <td rowspan="5">5</td>
											<input type="hidden" name="key_no[]" class="form-control" value="5.1">
                                            <td rowspan="5">Hardworking</td>
                                            <td>Completes all assigned tasks on-time</td>
                                            <td rowspan="5"><input type="text" class="form-control" readonly value="15%"></td>
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee51" value="@isset($prof_data){{$prof_data['5.1']['percentage_achieved_employee']}}@endisset" max="15"></td> 
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager51" value="@isset($prof_data){{$achi_man['5.1']['percentage_achieved_manager']}}@endisset" max="15" @if (Auth::user()->role_id == 3)readonly @endif ></td> 
                                        </tr>
										<tr>
                                            <td>Result Oriented</td> 
											 
                                        </tr>
										<tr>
                                            <td>Works Hard & Smart</td> 
											 
                                        </tr>
										<tr>
                                            <td>Pays attention to details while executing tasks</td> 
											 
                                        </tr>
										<tr>
                                            <td>Team player</td>
											 
                                        </tr>
										<tr>
                                            <td rowspan="5">6</td>
                                            <td rowspan="5">Trend Setters </td>
											<input type="hidden" name="key_no[]" class="form-control" value="6.1">
                                            <td>Committed to continuous improvement</td>
                                            <td rowspan="5"><input type="text" class="form-control" readonly value="15%"></td>
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee61" value="@isset($prof_data){{$prof_data['6.1']['percentage_achieved_employee']}}@endisset" max="15"></td> 
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager61" value="@isset($prof_data){{$achi_man['6.1']['percentage_achieved_manager']}}@endisset" max="15" @if (Auth::user()->role_id == 3)readonly @endif ></td> 
                                        </tr>
										<tr>
                                            <td>Innovative</td> 
											 
                                        </tr>
										<tr>
                                            <td>Thinks outside the box</td> 
											 
                                        </tr>
										<tr>
                                            <td>Dresses neatly & appropriately</td> 
											 
                                        </tr>
										<tr>
                                            <td>Demonstrates personal leadership</td> 
											  
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Total </td>
                                            <td><input type="text" class="form-control" readonly value="100%"></td>
                                            <td><input type="text" class="form-control" readonly  name="total_score_employee" id="total_personal_score_employee" value="{{ @$personal->total_score_employee }}"></td> 
                                            <td><input type="text" class="form-control" readonly name="total_score_manager" id="total_personal_score_manager" value="{{ @$personal->total_score_manager }}" @if (Auth::user()->role_id == 3)readonly @endif></td> 
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center"><b>Total Percentage(%)</b></td>
                                            <td></td>
                                            <td   class="text-center"><input type="text" class="form-control" name="total_percentage_employee" id="total_percentage_empl" readonly value="{{ @$personal->total_percentage_employee }}"></td>
                                            <td  class="text-center"><input type="text" class="form-control" name="total_percentage_manager" id="total_percentage_man" readonly value="{{ @$personal->total_percentage_manager }}"></td>                                            
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
                         
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_specialInitiatives') }}" method="post" id="specialInitiatives_validate">
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
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->by_employee}}"required></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"@if (Auth::user()->role_id == 3)readonly @endif></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" @if (Auth::user()->role_id == 3)readonly @endif></td>
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
                <section class="review-section" id="CommentsRole" style="display:none;">
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
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}"@if (Auth::user()->role_id == 3)readonly @endif></td>                                            
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" @if (Auth::user()->role_id == 3)readonly @endif></td>
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
                
                <section class="review-section" id="AdditionCommentRole" style="display:none;">
                    <div class="review-header text-center">
                        <h3 class="review-title">Comments on the role</h3>
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
                <section class="review-section" id="AppraiseeStrength">
                    <div class="review-header text-center">
                        <h3 class="review-title">Appraisee's Strengths and Areas for Improvement perceived by the Manager/Supervisor</h3>
                        
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
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['strengths']}} @endif" required readonly></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[0])){{$add_appraiseest[0]['areas_improvement']}} @endif" required readonly></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['strengths']}} @endif" required readonly></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[1])){{$add_appraiseest[1]['areas_improvement']}} @endif" required readonly></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['strengths']}} @endif" required readonly></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value="@if(isset($add_appraiseest[2])){{$add_appraiseest[2]['areas_improvement']}} @endif" required readonly></td>
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
                
                <section class="review-section" id="PersonalGoal" style="display:none;">
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
                 
                <section class="review-section" id="ProfessionalAchived" style="display:none;">
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
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}" @if (Auth::user()->role_id == 3)readonly @endif></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" @if (Auth::user()->role_id == 3)readonly @endif></td>
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
                
                <section class="review-section" id="ProfForthcoming" style="display:none;">
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
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}" @if (Auth::user()->role_id == 3)readonly @endif></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" @if (Auth::user()->role_id == 3)readonly @endif></td>
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
                
                <section class="review-section" id="TrainingRequirement" style="display:none;">
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
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comment}}" @if (Auth::user()->role_id == 3)readonly @endif></td>
                                            <td></td>
                                            <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" @if (Auth::user()->role_id == 3)readonly @endif></td>
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
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <form action="{{ route('add_general_comment') }}" method="post" id="general_comment">
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
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="{{ $val->employee_comments}}" required id="other_comment1_24"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="{{ $val->managers_comments}}" @if (Auth::user()->role_id == 3)readonly @endif required></td>
                                           <td></td>
                                           <input type="hidden" class="form-control" name="getid[]" value="{{ $val->id}}">
                                        </tr>
                                        @php $i++; @endphp
                                        @endforeach  
                                        @else
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" required></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" required @if (Auth::user()->role_id == 3)readonly @endif></td>
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

               <!--  <section class="review-section">
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
                </section>-->
                
                <section class="review-section row" id="PerfomanceIdentitie" style="display:none">
                    <div class="col-md-12">
                        <div class="">
                        <form action="{{ route('add_perfomanceIdentitie') }}" method="post">
                            @csrf
                            <input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">
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
                                        <input type="hidden" name="user_role[]" value="3">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent_employ[0])){{$add_perfoIdent_employ[0]['name']}} @endif"></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent_employ[0])){{$add_perfoIdent_employ[0]['signature']}} @endif"></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control datetimepicker" name="date[]" value="@if(isset($add_perfoIdent_employ[0])){{$add_perfoIdent_employ[0]['date']}} @endif"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Manager</td>
                                        <input type="hidden" name="user_role[]" value="2">
                                        <td><input type="text" class="form-control" name="name[]" value="@if(isset($add_perfoIdent_man[1])){{$add_perfoIdent_man[1]['name']}} @endif" @if (Auth::user()->role_id == 3)readonly @endif></td>
                                        <td><input type="text" class="form-control" name="signature[]" value="@if(isset($add_perfoIdent_man[1])){{$add_perfoIdent_man[1]['signature']}} @endif" @if (Auth::user()->role_id == 3)readonly @endif></td>
                                        <td><div class="cal-icon"><input type="text" class="form-control datetimepicker" name="date[]" value="@if(isset($add_perfoIdent_man[1])){{$add_perfoIdent_man[1]['date']}} @endif" @if (Auth::user()->role_id == 3)readonly @endif></div></td>
                                    </tr>
                                     
                                </tbody>
                            </table>
                            <div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
                            </form>
                        </div>
                    </div>
                </section>
                <div class="row"  >
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <form action="{{ route('add_Perfomance_status_user_for_employee') }}" method="post">
                            @csrf
                            <input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">                                 
                                <div class="review-header text-center"> 
                                <button type="submit" id="comple_stat"  class="btn btn-primary submit-btn"   disabled><input type="hidden" name="perfomance_status" value="1" id="perfomance_status">SUBMIT</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->
		 <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script>
		jQuery(document).ready(function(){
			<?php $comp_status = Employee::where('id',Auth::id())->where('complete_professional_excellence',1)->where('complete_personal_excellence',1)->where('complete_special_initiative',1)->where('complete_other_general_comments',1)->first();
			if($comp_status){  ?>
			 $('#comple_stat').removeAttr("disabled")	
			<?php }?>
		 });
		 
		$(function () {
			$(document).on("click", '.btn-add-row', function () {
				var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
				console.log(id);
				var div = $("<tr />");
				div.html(GetDynamicTextBox(id));
				$("#"+id+"_tbody").append(div);
			});
			$(document).on("click", "#comments_remove", function () {
				$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
				$(this).closest("tr").remove();
				
			});
			  
			function GetDynamicTextBox(table_id) {   
				$('#comments_remove').remove();
				var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBoxemp[]" class="form-control" value = "" @if(Auth::user()->id == $emps->id) editable @else readonly @endif></td>' + '<td><input type="text" name = "DynamicTextBoxman[]" class="form-control" value = "" @if(Auth::user()->id != $emps->id) editable @else readonly @endif></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		</script>
		<style>
		.cal-icon:after{top: 38px;}
		</style>
@endsection
 