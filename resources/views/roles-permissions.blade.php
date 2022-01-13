@include('layout.setting_module_header')
 
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Roles & Permissions</h3>
							</div>
						</div>
					</div>
					
					<!-- /Page Header -->
					@if ($errors->any())
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>    
						   
							@if($errors->any())
							{!! implode('', $errors->all('<div>:message</div>')) !!}
							@endif
						   
						</div>
						@endif
					<div class="row">
						
						<div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
							<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
							<div class="roles-menu">
								<ul>
									{{-- <li class="active">
										<a href="javascript:void(0);">Administrator
											<span class="role-action">
												<span class="action-circle large" data-toggle="modal" data-target="#edit_role">
													<i class="material-icons">edit</i>
												</span>
												<span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role">
													<i class="material-icons">delete</i>
												</span>
											</span>
										</a>
									</li> --}}
									@isset($roles)
										@foreach ($roles as $val)
										<li>
											<a href="javascript:void(0);" id="role_hover{{ $val->id }}" data-id="{{ $val->id }}"><span class="role_name">{{ $val->name }}</span>
												<span class="role-action">
													<span class="action-circle large" data-toggle="modal" data-target="#edit_role">
														<i class="material-icons editRoleBtn"  data-id="{{ $val->id }}">edit</i>
													</span>
													{{-- <span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role">
														<i class="material-icons delRoleBtn"  data-id="{{ $val->id }}">delete</i>
													</span> --}}
												</span>
											</a>
										</li>
										@endforeach
									@endisset
								</ul>
							</div>
						</div>
						<input type="hidden" id="first_role_id" value="{{ @$roles[0]->id }}">
						<div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
							<h6 class="card-title m-b-20">Module Access</h6>
							<div class="m-b-30">
								<ul class="list-group notification-list">
									@isset($modules)
										@foreach ($modules as $val)
										
										<li class="list-group-item">
											{{ @$val->name }}
											<div class="status-toggle">
												<input type="checkbox" id="accessToggle{{ @$val->id }}"  class="check"  data-id="{{ @$val->id }}">
												<label for="accessToggle{{ @$val->id}}" class="checktoggle">checkbox</label>
											</div>
										</li>
									
										@endforeach
									@endisset
								
				
								</ul>
							</div>
							<form action="{{ route('updateModulePermission') }}" method="post">
								@csrf      	
								<div class="table-responsive">
									<table class="table table-striped custom-table">
										<thead>
											<tr>
												<th>Module Permission</th>
												@isset($permissions)
												@foreach ($permissions as $p)
													<th class="text-center">{{ $p->name }}</th>
												@endforeach
												@endisset
												{{-- <th class="text-center">Read</th>
												<th class="text-center">Write</th>
												<th class="text-center">Create</th>
												<th class="text-center">Delete</th>
												<th class="text-center">Import</th>
												<th class="text-center">Export</th> --}}
											</tr>
										</thead>
										<tbody>
											
											@isset($modules)
											@foreach ($modules as $val)
												<tr>
													<td>{{ $val->name }}</td>
													@isset($permissions)
													@foreach ($permissions as $ep)

														<td class="text-center">
															<input name="permission_modules[]" class="permissionCheck" value="{{ $val->id }}_{{ $ep->id }}" type="checkbox">
														</td>
													@endforeach
													@endisset
												</tr>
											@endforeach
											@endisset 
										</tbody>
									</table>
								</div>
								<input type="hidden" value="" name="role_id" id="role_id">
								<input type="submit" value="save" class="btn btn-primary">
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Role Modal -->
				<div id="add_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{ route('add_role') }}" method="post">
									@csrf
									<div class="form-group">
										<label>Role Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="role_name">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Role Modal -->
				
				<!-- Edit Role Modal -->
				<div id="edit_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h5 class="modal-title">Edit Role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{ route('edit_role') }}" method="post">
									@csrf
									<div class="form-group">
										<label>Role Name <span class="text-danger">*</span></label>
										<input class="form-control" id="role_name" name="role_name" required value="" type="text">
										<input class="form-control" id="edit_role_id" name="id" required value="" type="hidden">

									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Role Modal -->

				<!-- Delete Role Modal -->
				<div class="modal custom-modal fade" id="delete_role" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Role</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn deleteRoleCont" data-id="">Delete</a>
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
				<!-- /Delete Role Modal -->
				
             </div>
			<!-- /Page Wrapper -->
			</div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
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
		<script>
			$( document ).ready(function() {
				$(".permissionCheck").prop('checked',false)
				$("*[id^=accessToggle]").prop('checked',false);
				var first_role_id=$("#first_role_id").val();
				$("#role_hover"+first_role_id).click();
				// getChecked();
				// function getChecked(){
				// 	$.ajax({
				// 		type:'GET',
				// 		url:"{{ route('getCheckedValues') }}",
				// 		success:function(data){
				// 			$.each(data.checkedData, function(key, val) 
				// 			{ 
				// 			$(".permissionCheck[value='"+val['module_id']+"_"+val['permission_id']	+"']").prop('checked',true);

				// 			});
				// 		}
				// 	})
				// }
				$(document).on("click",".editRoleBtn",function() {
					var rolename = $(this).closest('li').find('.role_name').html();
					$("#role_name").val(rolename)
					$("#edit_role_id").val($(this).data('id'))
				});
				$(document).on("click",".delRoleBtn",function() {
					$(".deleteRoleCont").attr('data-id', $(this).data('id'));
				});
				$(document).on("click",".deleteRoleCont",function() {
					var id= $(this).data('id');
					$.ajax({
						type:'POST',
						url:"{{ route('delete_role') }}",
						data:{"id":id,"_token": "{{ csrf_token() }}"},
						success:function(data){
							
							location.reload();
							
						}
					});
				});
				$(document).on("click","*[id^=accessToggle]",function() {
					var id=$(this).data('id');
					var role_id=$("#role_id").val();
					var status;
					if($(this).is(":checked")) 
					{
						status=1;
					}
					else{
						status=0;
					}
					
					$.ajax({
						type:'POST',
						url:"{{ route('changeModuleAccess') }}",
						data:{"id":id,"role_id":role_id,"status":status,"_token": "{{ csrf_token() }}"},
						success:function(data){	
							l//location.reload();
						}
					});
				});
			});
			$("*[id^=role_hover]").on("click",function() {
				$(".permissionCheck").prop('checked',false)
				$("*[id^=accessToggle]").prop('checked',false)

				$("*[id^=role_hover]").css("background-color",'transparent')
				var id=$(this).data('id');
				$(this).css("background-color", "#D0D0D0");
				$("#role_id").val(id);
				$.ajax({
					type:'GET',
					url:"{{ route('GetModuleAccess') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){	
						// if(data.module_per.length==0){
							
						// }
						$.each(data.module_per, function(key, val) 
						{ 
							
							$(".permissionCheck[value='"+val['module_id']+"_"+val['permission_id']	+"']").prop('checked',true);
						});
					}
				});
				$.ajax({
					type:'GET',
					url:"{{ route('GetRoleModuleAccess') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){	
						
						$.each(data.module_access, function(key, val) 
						{ 
							if(val['access_status']==1){
							$("#accessToggle"+val['module_id']).prop('checked',true);
							}
							else{
							$("#accessToggle"+val['module_id']).prop('checked',false);
							}
						});
					}
				});
			})
		</script>
    </body>
</html>