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
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_indicator"><i class="fa fa-plus"></i> Add New</a>
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
                                        <th>Employee Comments</th>
                                        <th>Manager's Comments</th>
                                        <th>Admin Comments</th>
                                        <th>Areas for Improvement</th>                                  
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($first_warning_dt)
                                    @foreach($first_warning_dt as $val)
                                    <tr class="trindicator">
                                        <input type="hidden" name="editid" value="{{ @$val->id }}">
                                        <td>{{ @$val->id }}</td>
                                        <td class="tdindicator">{{ @$val->employee_comments }}</td>                                        
                                        <td>{{ @$val->managers_comments}}</td>                                        
                                        <td>{{ @$val->admin_comments}}</td>
                                        <td>{{ @$val->areas_for_improvement }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item editwarningbtn" href="#" data-id="{{ @$val->id }}"  data-employee_comments="{{ @$val->employee_comments }}" data-managers_comments="{{ @$val->managers_comments }}" data-admin_comments="{{ @$val->admin_comments }}" data-areas_for_improvement="{{ @$val->areas_for_improvement }}" data-toggle="modal" data-target="#edit_indicator"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deleteWarningbtn" href="#" data-id="{{ @$val->id }}" data-toggle="modal" data-target="#delete_EmpVerbalWarning"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

            <!-- Add   Modal -->
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
							<section class="review-section" id="ProfessionalAchived">
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
														<td><input type="text" class="form-control" name="employee_comments[]" value=""></td>
														<td><input type="text" class="form-control" name="managers_comments[]" value=""  ></td>
														<td><input type="text" class="form-control" name="admin_comments[]" value=""></td>
														<td><input type="text" class="form-control" name="areas_for_improvement[]" value=""></td>
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add   Modal -->
            
            <!-- Edit   Modal -->
            <div id="edit_indicator" class="modal custom-modal fade" role="dialog">
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
									<h3 class="review-title">1st Verbal Warning</h3>
									 
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<form action="{{ route('update_EmployeeFirstVerbalWarning') }}" method="post">
										 @csrf
											<table class="table table-bordered table-review review-table mb-0" id="table_goals">
												<thead>
													<tr>
														<th style="width:40px;">#</th>
														<th>Employee Comment</th>
														<th>Manager's Comment</th>
														<th>Admin Comment</th>
														<th>Area's for Improvement</th>
													</tr>
												</thead>
												<tbody id="table_goals_tbody">       
													<tr>  
														<td id="indexid"></td>
														<td><input type="text" class="form-control" name="employee_comments" id="employee_comments" value=""></td>
														<td><input type="text" class="form-control" name="managers_comments" id="managers_comments" value="" ></td>
														<td><input type="text" class="form-control" name="admin_comments" id="admin_comments" value=""></td>
														<td><input type="text" class="form-control" name="areas_for_improvement" id="areas_for_improvement" value=""></td>										 
                                                        <input type="hidden" class="form-control" name="getid" value="" id="getidjq">
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
            <!-- /Edit Performance Indicator Modal -->
            
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
					url:"{{ route('chang_status') }}",
					data:{"id":id,"status":status,"_token": "{{ csrf_token() }}"},
					success:function(data){	
						location.reload();
					}
				});
			});
		});
	</script>
@endsection