@extends('layout.mainlayout')
@section('content')
 
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
                            <h3 class="page-title">Employees Warning</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employees Warning</li>
                            </ul>
                        </div>
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 5 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)
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
                      
                                        <th>Warming</th>
                                        @if(Auth::user()->role_id != 3)<th>Employees</th> @endif 
                                        <!--<th>Employee Comments</th>-->
                                        <th>HR's Input</th>
                                        <th>Comments</th>
                                       
                                        <th>Areas for Improvement</th>
                                        <th>Employee Documents</th>
                                        <th>Date</th>
                                        <th>Status</th>                                        
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>          
                                    @if($all_all_warning)
                                    @foreach($all_all_warning as $val)
                                    <?php   $admin_comments_first_json = json_decode($val->admin_comments_first); 
                                            $areas_for_improvement_first_json = json_decode($val->areas_for_improvement_first); 
                                            $hr_input_first_json = json_decode($val->hr_input_first); 
                                            $employee_documents_json = json_decode($val->employee_documents_first); 

                                        $admin_comments_second_json = json_decode($val->admin_comments_second); 
                                        $areas_for_improvement_second_json = json_decode($val->areas_for_improvement_second); 
                                        $hr_input_second_json = json_decode($val->hr_input_second); 
                                        $employee_documents_second_json = json_decode($val->employee_documents_second); 
                                     
                                        $employee_documents_third_json = json_decode($val->employee_documents_third); 
                                        $admin_comments_third_json = json_decode($val->admin_comments_third); 
                                        $areas_for_improvement_third_json = json_decode($val->areas_for_improvement_third); 
                                        $hr_input_third_json = json_decode($val->hr_input_third);

                                    ?>
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td>@if($val->warmingstatus == 1) First @endif @if($val->warmingstatus == 2) Second @endif @if($val->warmingstatus == 3) Third @endif</td>                              
                                        <td>{{ @$val['employee_name'][0]['first_name'] }}</td>                              
                                        <td>@if($val->warmingstatus == 1) @if($hr_input_first_json){{$hr_input_first_json[0]}} @endif @endif @if($val->warmingstatus == 2) @if($hr_input_second_json) {{$hr_input_second_json[0]}}@endif @endif @if($val->warmingstatus == 3) @if($hr_input_third_json){{$hr_input_third_json[0]}}@endif @endif</td>                                        
                                        <td>@if($val->warmingstatus == 1) @if($admin_comments_first_json){{$admin_comments_first_json[0]}} @endif @endif @if($val->warmingstatus == 2) @if($admin_comments_second_json) {{$admin_comments_second_json[0]}}@endif @endif @if($val->warmingstatus == 3) @if($admin_comments_third_json){{$admin_comments_third_json[0]}}@endif @endif</td> 
                                   
                                      <td>@if($val->warmingstatus == 1) @if($areas_for_improvement_first_json){{$areas_for_improvement_first_json[0]}} @endif @endif @if($val->warmingstatus == 2) @if($areas_for_improvement_second_json) {{$areas_for_improvement_second_json[0]}}@endif @endif @if($val->warmingstatus == 3) @if($areas_for_improvement_third_json){{$areas_for_improvement_third_json[0]}}@endif @endif</td>

                                        <td>

                                        @if($val->warmingstatus == 1) @if($employee_documents_json)<a href="{{ route('download-warming-image',$employee_documents_json[0]) }}" ><i class="fa fa-download"></i>Download</a> @endif @endif 

                                        @if($val->warmingstatus == 2) @if($employee_documents_second_json && $employee_documents_second_json[0] != '')<a href="{{ route('download-warming-image',$employee_documents_second_json[0]) }}" ><i class="fa fa-download"></i>Download</a>@endif @endif 

                                        @if($val->warmingstatus == 3) @if($employee_documents_third_json && $employee_documents_third_json[0] != '')
                                        <a href="{{ route('download-warming-image',$employee_documents_third_json[0]) }}" ><i class="fa fa-download"></i>Download</a> @endif @endif
                                        

                                        </td> 
                                        <td>{{date('d M Y', strtotime(@$val->updated_at))}}</td>
                                        <td>
                                          <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if(@$val->status== '0')text-success @else text-danger @endif"></i> @if(@$val->status== '1') Active @else Withdraw @endif
                                                </a>
                                                <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('changeFirstWarningstatus').'/1'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-danger"></i>Active</a>
                                                    <a class="dropdown-item" href="{{ url('changeFirstWarningstatus').'/0'.'/'.@$val->id }}"><i class="fa fa-dot-circle-o text-success"></i>Withdraw</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editallwarning edslpoin1" href="#" data-id="{{ @$val->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                   
             
                                    @endforeach
                                  
                                    @endif                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
             <div id="editRecordModal" class="modal fade editRecordModal" abindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Verbal Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('update_EmployeeFirstVerbalWarning') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="dyanamic-wrap">
                                     @include('employee-warning-edit')
                                </div>
                             </form>                       
                        </div>
                    </div>
                </div>
            </div>
              <!-- /Add   Modal -->
 
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
                                        <form action="{{ route('add_EmployeeFirstVerbalWarning') }}" method="post" enctype="multipart/form-data">
                                         @csrf
                                         <input type="hidden" class="form-control" name="getid" value="" id="getidjq">
                                            <table class="table table-bordered table-review review-table mb-0" id="table_goals">
                                                <thead>
                                                    <tr> 
                                                        <th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
                                                        <!--<th>Employee Comment</th>-->
                                                        <th>HR's Input</th>
                                                        <th>Comments </th>
                                                        <th>Area's for Improvement</th> 
                                                        <th>Documents</th>
                                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row-warning"><i class="fa fa-plus"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_goals_tbody">
                                                                                                 
                                                     <tr>
                                                        <td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control first-select" id="first-select" name="emp_id" required>
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 6)
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
                                                        <!--<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td> -->
                                                        <td><input type="text" class="form-control" name="hr_input[]" @if(Auth::user()->role_id != 5)readonly @endif></td>
                                                        <td><textarea type="text" class="form-control" name="admin_comments[]" @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50"></textarea></td>
                                                        <td><input type="text" class="form-control" name="areas_for_improvement[]" @if(Auth::user()->role_id == 3)readonly @endif></td>
                                                        <td><input type="file" class="form-control" name="fileadd[]" @if(Auth::user()->role_id == 3)readonly @endif></td> 
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
                            <section class="review-section disabled" >
                                <div class="review-header text-center">
                                    <h3 class="review-title">2nd Verbal Warning</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                        <form action="{{ route('add_EmployeeFirstVerbalWarning') }}" method="post" enctype="multipart/form-data">
                                         @csrf
                                            <table class="table table-bordered table-review2 review-table mb-0" id="table_secondwarning">
                                                <thead>
                                                    <tr>
                                                        <th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
                                                        <!--<th>Employee Comment</th>-->
                                                        <th>HR's Input</th>
                                                        <th>Comments</th>
                                                        <th>Area's for Improvement</th>
                                                        <th>Documents</th>
                                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-second-warning2"><i class="fa fa-plus"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_secondwarning_tbody">       
                                                     <tr>
                                                        <td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id_second" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id_second">
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 6)
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
                                                        <!--<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td> -->
                                                        <td><input type="text" class="form-control" name="hr_input_second" @if(Auth::user()->role_id != 5)readonly @endif></td>
                                                        <td><textarea type="text" class="form-control" name="admin_comments_second"  @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50"></textarea></td>
                                                        <td><input type="text" class="form-control" name="areas_for_improvement_second" @if(Auth::user()->role_id == 3)readonly @endif></td>
                                                        <td><input type="file" class="form-control" name="fileadd_second" @if(Auth::user()->role_id == 3)readonly @endif></td>
                                                        <input type="hidden" class="form-control" name="getid_second" value="" >
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
                            <section class="review-section disabled" >
                                <div class="review-header text-center">
                                    <h3 class="review-title">3rd Verbal Warning</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                        <form action="{{ route('add_EmployeeThirdVerbalWarning') }}" method="post" enctype="multipart/form-data">
                                         @csrf
                                         <input type="hidden" class="form-control" name="getid_third" value="" id="getidjq">
                                            <table class="table table-bordered table-review3 review-table mb-0" id="table_thirdwarning">
                                                <thead>
                                                    <tr>
                                                        <th style="width:40px;">#</th>
                                                        @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
                                                        <!--<th>Employee Comment</th>-->
                                                        <th>HR's Input</th>
                                                        <th>Comments</th>
                                                        <th>Documents</th>
                                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-third-warning3"><i class="fa fa-plus"></i></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_thirdwarning_tbody">
                                                                                                 
                                                     <tr>
                                                        <td>1</td>
                                                        @if(Auth::user()->role_id == 3)
                                                        <input type="hidden" name="emp_id_third" value="{{Auth::user()->id}}">
                                                        @endif
                                                        @if(Auth::user()->role_id != 3)
                                                        <td>
                                                            <select class="form-control" name="emp_id_third" >
                                                                <option>Select Employee</option>
                                                                @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 6)
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
                                                        <!--<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td>-->
                                                        <td><input type="text" class="form-control" name="hr_input_third"  @if(Auth::user()->role_id != 5)readonly @endif></td>
                                                        <td><textarea type="text" class="form-control" name="admin_comments_third" @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50"></textarea></td>
                                                        <td><input type="file" class="form-control" name="fileadd_third" @if(Auth::user()->role_id == 3)readonly @endif></td>
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