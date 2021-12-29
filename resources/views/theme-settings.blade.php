@include('layout.setting_module_header')
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Theme Settings</h3>
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
							<form action="{{ route("theme_setting_update") }}" method="post"  enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Website Name</label>
									<div class="col-lg-9">
										<input name="website_name" class="form-control" value="{{ @$settings->website_name }}" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Light Logo</label>
									<div class="col-lg-7">
										<input type="file" name="light_logo" class="form-control">
										<span class="form-text text-muted">Recommended image size is 500px x 500px</span>
									</div>
									<div class="col-lg-2">
										<div class="img-thumbnail float-right">
											@isset($settings)
												@if($settings->light_logo!=null)
												<img src="{{ url('/').'/setting_images/'.@$settings->light_logo }}" alt="" width="40" height="40">
												@else
												<img src="{{ url('/').'/img/favicon.png'}}" alt="" width="40" height="40">
												@endif
											@else
											<img src="{{ url('/').'/img/favicon.png'}}" alt="" width="40" height="40">
											@endif
										</div>

									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Favicon</label>
									<div class="col-lg-7">
										<input type="file" name="favicon" class="form-control">
										<span class="form-text text-muted">Recommended image size is 300px x 300px</span>
									</div>
									<div class="col-lg-2">
										@isset($settings)
											@if($settings->favicon!=null)
											<div class="settings-image img-thumbnail float-right"><img src="{{ url('/').'/setting_images/'.@$settings->favicon }}" class="img-fluid" width="16" height="16" alt=""></div>
											@else
											<img src="{{ url('/').'/img/logo.png'}}" alt="" width="40" height="40">
											@endif
										@else
										<img src="{{ url('/').'/img/favicon.png'}}" alt="" width="40" height="40">
										@endif
									</div>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
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
		
    </body>
</html>