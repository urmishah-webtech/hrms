@include('layout.setting_module_header')

   <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Termination Type</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Termination Type</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_terminationtype"><i class="fa fa-plus"></i> Add Termination Type</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Termination Type</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										@if($types)
										@foreach($types as $type)
										<tr>
											<td>
												{{$type->id}}		
											</td>
											<td>{{$type->type}}</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
														@if($type->status == 'Inactive')
														<i class="fa fa-dot-circle-o text-danger"></i> Inactive
														@else
														<i class="fa fa-dot-circle-o text-success"></i> Active
														@endif
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="/termination-type/{{$type->id}}/status/Active" class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a href="/termination-type/{{$type->id}}/status/Inactive" class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a id="editForm" class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_terminationtype" data-id="{{$type->id}}" data-type="{{$type->type}}" data-status="{{$type->status}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a id="deleteForm" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_leavetype" data-id="{{$type->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
				
				<!-- Add Leavetype Modal -->
				<div id="add_terminationtype" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Termination Type</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{route('termination-type.save')}}" method="POST">
									@csrf
									<div class="form-group">
										<label>Termination Type <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="type">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Leavetype Modal -->
				
				<!-- Edit Leavetype Modal -->
				<div id="edit_terminationtype" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Termination Type</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="{{route('termination-type.update')}}">
									@csrf
									<input type="hidden" name="id" id="id" />
									<div class="form-group">
										<label>Termination Type <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="type" id="type">
									</div>
									<div class="form-group">
										<label>Status <span class="text-danger">*</span></label>
										 <select class="select" name="status" id="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Leavetype Modal -->
				
				<!-- Delete Leavetype Modal -->
				<div class="modal custom-modal fade" id="delete_leavetype" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Termination Type</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a id="delete_url" href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
				<!-- /Delete Leavetype Modal -->
				
    </div>

         <script src="js/jquery-3.5.1.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="js/select2.min.js"></script>

		<!-- Custom JS -->
		<script src="js/app.js"></script>

	<script type="text/javascript">
        $(document).ready(function () {
            
	        $('body').on('click', '#editForm', function (event) {

	            event.preventDefault();
	            var type = $(this).data('type'), status = $(this).data('status'), id = $(this).data('id');
	            $('#id').val(id);
	            $('#type').val(type);
	            $('#status').val(status).change();
	           
	        });

	        $('body').on('click', '#deleteForm', function (event) {

	            event.preventDefault();
	            var id = $(this).data('id');
	            $('#delete_url').attr("href", '/delete-termination-type/'+id); 
	           
	        });
		});

	</script>
		