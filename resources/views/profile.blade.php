@extends('layout.mainlayout')
@section('content')
<?php use Illuminate\Support\Str;
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
        @if(!$emp_profile)
        <h4>Employee is Removed</h4>
        @else  
                <!-- /Page Header -->
                @if ($errors->any())
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                   
                    @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
                   
                </div>
                @endif
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view">
                                    <div class="profile-img-wrap">
                                        <div class="profile-img">
                                            <a href="#"><img alt="" src="{{url('img/profiles/avatar-02.jpg')}}"></a>
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0 mb-0">{{$emp_profile->first_name}} {{$emp_profile->last_name}}</h3>
                                                    <input type="hidden" value="{{$emp_profile->first_name}}" id="first_name">
                                                    <input type="hidden" value="{{$emp_profile->last_name}}" id="last_name">
                                                    <input type="hidden" value="{{$emp_profile->phone_no}}" id="phone_no">

                                                    <h6 class="staff-id">Department : {{ @$emp_profile->designation->department->name}}</h6>
                                                    <small class="staff-id">Designation : {{ @$emp_profile->designation->name }}</small>
                                                    <div class="staff-id">Employee ID : {{ @$emp_profile->employee_id }}</div>
                                                     
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <ul class="personal-info">
													<li class="profl_firstedit">
                                                        <div class="title">User Role:</div>
                                                        <div class="text">{{@$emp_profile->role->name}}</div>
                                                    </li>
                                                    <li class="profl_firstedit">
                                                        <div class="title">Phone:</div>
                                                        <div class="text"><a href="tel:{{ @$emp_profile->phone_no }}">{{ @$emp_profile->phone_no }}</a></div>
                                                    </li>
                                                    <li class="profl_firstedit">
                                                        <div class="title">Email:</div>
                                                        <div class="text"><a href="">{{ @$emp_profile->email }}</a></div>
                                                    </li>                                                    
                                                    <li class="profl_firstedit">
                                                        <div class="title">Date of Join:</div>
                                                        <div class="text">{{ @$emp_profile->joing_date }}</div>
                                                    </li> 
                                                </ul>
                                                @if(Auth::id()==$emp_profile->id)
                                                <a href="" class="edit-icon" data-toggle="modal" data-target="#change_info_modal" data-id="{{ @$emp_profile->id }}" data-first_name="{{@$emp_profile->first_name}}"
                                                    data-last_name="{{@$emp_profile->last_name}}"  data-phone_no="{{$emp_profile->phone_no}}"  ><i class="fa fa-pencil"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 
                <div class="tab-content">
                
                    <!-- Profile Info Tab -->
                    <div id="emp_profile" class="pro-overview tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="card profile-box flex-fill">
                                    <div class="card-body">
                                        <h3 class="card-title">Personal Informations 
											<?php if(Auth::user()->role_id == 1){
											if(Auth::id() != $emp_id->id){?>
											 <form action="{{ route('add_approve_status_for_employee') }}" method="post">
											@csrf
											<input type="hidden" name="id" value="@if(isset($emp_id)){{ $emp_id->id}}@endif"> 
											@if($app_status == 0)
											<button type="submit" class="btn btn-primary submit-btn"><input type="hidden" name="approve_status" value="1" id="approve_status">Approve Request</button>
											@endif
											</form>
											<?php } 
											}?>
                                            <a href="#" class="edit-icon edit_personal_info" data-toggle="modal" data-target="#personal_info_modal" data-id="{{@$per_info->id}}" data-passp="{{@$per_info->passport_no}}" data-expdate="{{@$per_info->passport_expiry_date}}" data-tel="{{@$per_info->tel}}" data-nati="{{@$per_info->nationality}}" data-relg="{{@$per_info->religion}}" data-matst="{{@$per_info->marital_status}}" data-empsp="{{@$per_info->employment_of_spouse}}" data-child="{{@$per_info->No_of_children}}"><i class="fa fa-pencil"></i></a>
                                        
                                        </h3>
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Passport No.</div>
                                                <div class="text">{{@$per_info->passport_no}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Passport Exp Date.</div>
                                                <div class="text">{{@$per_info->passport_expiry_date}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Tel</div>
                                                <div class="text"><a href="tel:{{@$per_info->tel}}">{{@$per_info->tel}}</a></div>
                                            </li>
                                            <li>
                                                <div class="title">Nationality</div>
                                                <div class="text">{{@$per_info->nationality}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Religion</div>
                                                <div class="text">{{@$per_info->religion}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Marital status</div>
                                                <div class="text">{{@$per_info->marital_status}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Employment of spouse</div>
                                                <div class="text">{{@$per_info->employment_of_spouse}}</div>
                                            </li>
                                            <li>
                                                <div class="title">No. of children</div>
                                                <div class="text">{{@$per_info->No_of_children}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="card profile-box flex-fill">
                                    <div class="card-body">
                                        <h3 class="card-title">Emergency Contact <a href="#" class="edit-icon edit-emergency-contact" data-toggle="modal" data-target="#emergency_contact_modal" data-id="{{@$contact->id}}" data-pnm="{{@$contact->primary_name}}" data-prs="{{@$contact->primary_relationship}}" data-phn1="{{@$contact->primary_phone1}}" data-phn2="{{@$contact->primary_phone2}}" data-snm="{{@$contact->secondary_name}}" data-srs="{{@$contact->secondary_relationship}}" data-sphn1="{{@$contact->secondary_phone1}}" data-sphn2="{{@$contact->secondary_phone2}}"><i class="fa fa-pencil"></i></a></h3>
                                        <h5 class="section-title">Primary</h5>
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Name</div>
                                                <div class="text">{{@$contact->primary_name}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Relationship</div>
                                                <div class="text">{{@$contact->primary_relationship}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Phone </div>
                                                <div class="text">{{@$contact->primary_phone1}}, {{@$contact->primary_phone2}}</div>
                                                
                                            </li>
                                        </ul>
                                        <hr>
                                        <h5 class="section-title">Secondary</h5>
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Name</div>
                                                <div class="text">{{@$contact->secondary_name}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Relationship</div>
                                                <div class="text">{{@$contact->secondary_relationship}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Phone </div>
                                                <div class="text">{{@$contact->secondary_phone1}}, {{@$contact->secondary_phone2}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="card profile-box flex-fill">
                                    <div class="card-body">
                                        <h3 class="card-title">Employee History <a href="{{route('promotions', ['employee' => $id])}}" class="edit-icon" target="_blank"><i class="fa fa-pencil"></i></a></h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @if (!empty($promotiondata))
                                                    @foreach ($promotiondata as $key =>  $promotions)
                                                        @if ($key == 0)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <a href="#/" class="name">{{optional($promotions->desfrom)->name}} at {{optional(optional($promotions->employee)->getcompany)->company_name}}</a>
                                                                    <span class="time">{{date('d F, Y', strtotime(optional($promotions->employee)->joing_date))}} - {{date('d F, Y', strtotime($promotions->date))}}</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <a href="#/" class="name">{{optional($promotions->desto)->name}} at {{optional(optional($promotions->employee)->getcompany)->company_name}}</a>
                                                                    <span class="time">{{date('d F, Y', strtotime($promotions->date))}} - @if(!empty($promotiondata[$key+1])) {{date('d F, Y', strtotime($promotiondata[$key+1]->date))}}  @else Present  @endif</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->role_id != 1 || Auth::user()->role_id != 5)
                            <div class="col-md-6 d-flex">
                                <div class="card profile-box flex-fill">
                                    <div class="card-body">
                                        <h3 class="card-title">Warnings </h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @isset($first_war)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a  class="name">1st Verbal Warning</a>
                                                            <div>Admin Comment   </div>
                                                            <div>Manager's Comment</div>
                                                            <div>Employee Comment</div>
                                                        </div>
                                                    </div> 
                                                </li>
                                                @endisset
                                                @isset($second_war)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a  class="name">2nd Verbal Warning</a>
                                                            <div>Admin Comment   </div>
                                                            <div>Manager's Comment</div>
                                                            <div>Employee Comment</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endisset
                                                @isset($third_war)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a class="name">3rd Verbal Warning</a>
                                                            <div>Admin Comment   </div>
                                                            <div>Manager's Comment</div>
                                                            <div>Employee Comment</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endisset
                                                @if($first_war || $second_war || $third_war)
                                                <a href="/profile-employee-warning/{{Auth::user()->id}}" class="btn add-btn" style="float: none;margin-left:37px;">View Comment</a>
                                                @endif
                                                @isset($terminate_emp)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">Termination</a>
                                                            <div> Termination Type : {{@$terminate_emp->type}} </div>
                                                            <div>Termination Date : {{@$terminate_emp->termination_date}}</div>
                                                            <div>Reason : {{@$terminate_emp->reason}}</div>
                                                            <div>Notice Date :{{@$terminate_emp->notice_date}}</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endisset
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endif
                        </div>
                          
                    </div>
                        
                </div>
            </div>
      
            @include('change_emp_info')
            <!-- Personal Info Modal -->
            <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Personal Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_personal_info') }}" method="post">
							@csrf
								<input type="hidden" name="id" value="@if(isset($per_info)){{$per_info->id}}@endif" id="emp_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport No</label>
                                            <input type="text" class="form-control" name="passport_no" id="passport_no" value=""  @if($app_status == 1)editable @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport Expiry Date</label>
                                            <div class="cal-icon">
												<input name="passport_expiry_date" class="form-control datetimepicker" id="passport_expiry_date" type="text" value="" @if($app_status == 1)editable @else readonly @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tel</label>
                                            <input name="tel" class="form-control" type="number" id="tel" @if($app_status == 1)editable @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality <span class="text-danger">*</span></label>
                                            <input name="nationality" class="form-control" type="text" id="nationality" @if($app_status == 1)editable @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion</label>
                                                <input name="religion" class="form-control" type="text" id="religion" @if($app_status == 1)editable @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marital status <span class="text-danger">*</span></label>
                                            <select class="form-control" name="marital_status" id="marital_status" @if($app_status == 1)editable @else disabled @endif>
                                                <option value="">-</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employment of spouse</label>
                                            <input class="form-control" type="text" name="employment_of_spouse" id="employment_of_spouse" @if($app_status == 1)editable @else readonly @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. of children </label>
                                            <input class="form-control" type="number" name="No_of_children" id="No_of_children" @if($app_status == 1)editable @else readonly @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" @if($app_status == 1)editable @else disabled @endif>Submit</button>
                                </div>
                            </form>  
							<?php if(Auth::user()->role_id == 3 && $app_status == 0){?>
							<form action="{{ route('send-mail-adminapp') }}" method="post">
                            @csrf
								<div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Request for Changes</button>
                                </div>
							</form>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Personal Info Modal -->
             
            <!-- Emergency Contact Modal -->
            <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Emergency Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_emergency_contact') }}" method="post">
							@csrf
								<input type="hidden" name="id" value="@if(isset($contact)){{$contact->id}}@endif" id="contact_id">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Primary Contact</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="primary_name" id="primary_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="primary_relationship" id="primary_relationship">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="number" name="primary_phone1" id="primary_phone1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 2</label>
                                                    <input class="form-control" type="number" name="primary_phone2" id="primary_phone2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Secondary Contact</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger"></span></label>
                                                    <input type="text" class="form-control" name="secondary_name" id="secondary_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger"></span></label>
                                                    <input class="form-control" type="text" name="secondary_relationship" id="secondary_relationship">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger"></span></label>
                                                    <input class="form-control" type="number" name="secondary_phone1" id="secondary_phone1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 2</label>
                                                    <input class="form-control" type="number" name="secondary_phone2" id="secondary_phone2">
                                                </div>
                                            </div>
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
            <!-- /Emergency Contact Modal -->
            
            <!-- Education Modal -->
            <div id="education_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Education Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Oxford University" class="form-control floating">
                                                        <label class="focus-label">Institution</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Computer Science" class="form-control floating">
                                                        <label class="focus-label">Subject</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="01/06/2002" class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Starting Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="31/05/2006" class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Complete Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="BE Computer Science" class="form-control floating">
                                                        <label class="focus-label">Degree</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Grade A" class="form-control floating">
                                                        <label class="focus-label">Grade</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Oxford University" class="form-control floating">
                                                        <label class="focus-label">Institution</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Computer Science" class="form-control floating">
                                                        <label class="focus-label">Subject</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="01/06/2002" class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Starting Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <div class="cal-icon">
                                                            <input type="text" value="31/05/2006" class="form-control floating datetimepicker">
                                                        </div>
                                                        <label class="focus-label">Complete Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="BE Computer Science" class="form-control floating">
                                                        <label class="focus-label">Degree</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus focused">
                                                        <input type="text" value="Grade A" class="form-control floating">
                                                        <label class="focus-label">Grade</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                            </div>
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
            <!-- /Education Modal -->
            
            <!-- Experience Modal -->
            <div id="experience_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Experience Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="Digital Devlopment Inc">
                                                        <label class="focus-label">Company Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="United States">
                                                        <label class="focus-label">Location</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="Web Developer">
                                                        <label class="focus-label">Job Position</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control floating datetimepicker" value="01/07/2007">
                                                        </div>
                                                        <label class="focus-label">Period From</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control floating datetimepicker" value="08/06/2018">
                                                        </div>
                                                        <label class="focus-label">Period To</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="Digital Devlopment Inc">
                                                        <label class="focus-label">Company Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="United States">
                                                        <label class="focus-label">Location</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="Web Developer">
                                                        <label class="focus-label">Job Position</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control floating datetimepicker" value="01/07/2007">
                                                        </div>
                                                        <label class="focus-label">Period From</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control floating datetimepicker" value="08/06/2018">
                                                        </div>
                                                        <label class="focus-label">Period To</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                            </div>
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
            <!-- /Experience Modal -->
            @endif
        </div>
        <!-- /Page Wrapper -->
@endsection