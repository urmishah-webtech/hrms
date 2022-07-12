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
											<div class="cal-icon">
											<label for="name1">Performance Date</label>
											<input type="text" id="add_perfomance_date" class="form-control  " name="perfomance_date" value="{{ @$emps->perfomance_date }}">
											<p id="select_date_error" style="display:none;"> Please Select Date</p>
											</div> 											
											<!--<form action="{{ route('add_Perfomance_date_for_employee') }}" method="post">	
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">  
											<input type="hidden" name="pri_id" value="@if(isset($keyprofessional)){{ $keyprofessional}}@endif">  
												<div class="cal-icon">
													<label for="name1">Performance Date</label>
													 
												</div> 
												<button type="submit" id="comple_stat" class="btn btn-primary submit-btn"> SUBMIT</button> 
											</form>-->
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
							 <form action="{{ route('edit_professionalExcellence') }}" method="post" id="professionalExcellence">
                             @csrf

                              <input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif"> <input type="hidden" name="pri_id" value="@if(isset($keyprofessional)){{ $keyprofessional}}@endif">                      
                               <input type="hidden" name="perfomance_date" id="get_perfomance_date1">     							 
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Key Result Area</th>
                                            <th>Key Performance Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th> 
                                            <th>Percentage achieved <br>( Manager's Score )</th> 
                                        </tr>
                                    </thead>
                                    <tbody>                    
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td rowspan="2">Leadership</td>
                                            <input type="hidden" name="key_no[]" class="form-control" value="1">                                             
                                            <td>Staff Retention</td>                                            
                                            <td rowspan="2"><input type="text" class="form-control" readonly value="25%"></td>
                                            <td rowspan="2"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee1" value="" max="25" required></td> 
                                            <td rowspan="2"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager1" value="" max="25" readonly></td> 
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
                                            <td rowspan="2"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee21" value=" " max="25"></td> 
                                            <td rowspan="2"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager21" value=" " max="25" readonly></td> 
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
                                            <td rowspan="2"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee31" value=" " max="25"></td> 
                                            <td rowspan="2"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager31"  value=" " readonly max="25"></td> 
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
                                            <td rowspan="3"><input type="number" class="form-control achieved_employee_perfo" name="percentage_achieved_employee[]" id="achieved_employee41" value=" " max="25"></td> 
                                            <td rowspan="3"><input type="number" class="form-control achieved_manager" name="percentage_achieved_manager[]" id="achieved_manager41"  value=" " max="25" readonly></td> 
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
                                            <input type="text" class="form-control" readonly name="total_achieved_employee" id="total_achieved_employee" value=" "></td> 
                                            <td><input type="text" class="form-control" readonly name="total_achieved_manager" id="total_achieved_manager" value=" "></td>
                                             
                                        </tr>                                       
                                    </tbody>
                                </table>	
								<div class="review-header text-center">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn add_perfo_btn">Save &amp; update</button>
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
                            <form action="{{ route('myperformance_PersonalExcellence') }}" method="post" id="personal_Behavioralexcel">
                             @csrf
								<input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif"> 
								<input type="hidden" name="perfomance_date" id="get_Personal_Behavioral_date">
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Personal Attributes</th>
                                            <th>Key Indicators</th>
                                            <th>Weightage</th>
                                            <th>Percentage achieved <br>( self Score )</th> 
                                            <th>Percentage achieved <br>( Manager's Score )</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
										  
                                        <tr>
                                            <td rowspan="3">1</td>
                                            <td rowspan="3">Customer Oriented</td>
											<input type="hidden" name="key_no[]" class="form-control" value="1">
                                            <td>Keep customers as our Top Priority</td>
                                            <td rowspan="3"><input type="text" class="form-control" readonly value="25%" ></td>
                                            <td rowspan="3"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee1" value=" " required max="25"></td> 
                                            <td rowspan="3"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager1" value=" " max="25" readonly >
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
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee21" value=" " max="15"></td> 
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager21" value=" " max="15" readonly ></td> 
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
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee31" value=" " max="15"></td> 
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager31" value=" " max="15"  readonly ></td> 
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
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee41" value="" max="15"></td> 
                                            <td rowspan="4"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager41" value="" max="15"  readonly ></td> 
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
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee51" value="" max="15"></td> 
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager51" value="" max="15" readonly ></td> 
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
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_employee" name="percentage_achieved_employee[]" id="percentage_achieved_employee61" value="" max="15"></td> 
                                            <td rowspan="5"><input type="number" class="form-control percentage_achieved_manager" name="percentage_achieved_manager[]" id="percentage_achieved_manager61" value="" max="15"  readonly  ></td> 
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
                                            <td><input type="text" class="form-control" readonly  name="total_score_employee" id="total_personal_score_employee" value=""></td> 
                                            <td><input type="text" class="form-control" readonly name="total_score_manager" id="total_personal_score_manager" value="" @if (Auth::user()->role_id == 3)readonly @endif></td> 
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center"><b>Total Percentage(%)</b></td>
                                            <td></td>
                                            <td   class="text-center"><input type="text" class="form-control" name="total_percentage_employee" id="total_percentage_empl" readonly value=""></td>
                                            <td  class="text-center"><input type="text" class="form-control" name="total_percentage_manager" id="total_percentage_man" readonly value=""></td>                                            
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
                                <div class="review-header text-center" id="personal_Behavioralexce_next">
									<button type="submit" name="personal" class="btn btn-primary submit-btn add_perfo_btn">Save &amp; update</button>
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
                            <form action="{{ route('myperformance_SpecialInitiatives') }}" method="post" id="specialInitiatives_validate">
                             @csrf
								<input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">
								<input type="hidden" name="perfomance_date" id="get_specialInitiatives_date">
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
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value=""required></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value="" readonly  ></td>
                                            <td></td> 
                                        </tr>
                                        @php $i++; @endphp 
                                    </tbody>
                                </table>
                                <div class="review-header text-center" id="specialInitiatives_next">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn add_perfo_btn">Save &amp; update</button>
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
                            <form action="{{ route('myperformance_OtherGeneralComment') }}" method="post" id="general_comment">
                             @csrf
							 <input type="hidden" name="perfomance_date" id="get_general_comment_date">
							 <input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">
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
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxemp[]" value="" required id="other_comment1_24"></td>
                                            <td><input type="text" class="form-control" name="DynamicTextBoxman[]" value=""  readonly required></td>
                                           <td></td>
                                           <input type="hidden" class="form-control" name="getid[]" value=" ">
                                        </tr>
                                        @php $i++; @endphp 
										
                                    </tbody>
                                </table>
                                <div class="review-header text-center" id="GeneralComment_next">
									<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn add_perfo_btn">Save &amp; update</button>
								</div>
                            </form> 
                            </div>
                        </div>
                    </div>
                </section>
				  
                <section class="review-section" id="AppraiseeStrength">
                    <div class="review-header text-center">
                        <h3 class="review-title">Appraisee's Strengths and Areas for Improvement perceived by the <span style="color:#FF0000;">Manager/Supervisor</span></h3> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="" method="post">
                                @csrf
                                @php $i = 1; @endphp
                                @foreach($add_appraiseest_id as $val)
                                <input type="hidden" class="form-control" name="getid[]" value="{{$val->id}}">
                                @php $i++; @endphp
                                @endforeach 
								<input type="hidden" name="perfomance_date" id="get_appraiseestrength_date">
								<input type="hidden" name="empid" value="@if(isset($emps)){{ $emps->id}}@endif">
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
                                            <td><input type="text" class="form-control" name="strengths[]" value=" " required readonly></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value=" " required readonly></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value=" " required readonly></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value=" " required readonly></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><input type="text" class="form-control" name="strengths[]" value=" " required readonly></td>
                                            <td><input type="text" class="form-control" name="areas_improvement[]" value=" " required readonly></td>
                                        </tr>
                                    </tbody>
                                </table>  
								@if(Auth::user()->role_id != 3 || Auth::user()->id != $emps->id)
                                <div class="review-header text-center">
									<button disabled type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
								</div>
								@endif
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                 
                
 
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
                <div class="row"  style="display:none">
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script type="text/javascript">  
		 
		 
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
		$(function() {
			$("#add_perfomance_date").datepicker(); 
			$("#add_perfomance_date").val();
			
			$("#add_perfomance_date").on("change",function(){
				var selected = $(this).val();
				$("#get_perfomance_date1").val(selected);
				$("#get_Personal_Behavioral_date").val(selected);
				$("#get_specialInitiatives_date").val(selected);
				$("#get_appraiseestrength_date").val(selected);
				$("#get_general_comment_date").val(selected); 
			});
		});
		
		$(".add_perfo_btn").click(function(event){
			var per_date = $("#add_perfomance_date").val();
			if (per_date == ""){  
				event.preventDefault();
				$("#select_date_error").css('display','block');
				alert("Please Select Performance Date"); 
			}  
		});
		
		</script>
		<style>
		.cal-icon:after{top: 38px;}
		#select_date_error{color:red}
		</style>
@endsection
 