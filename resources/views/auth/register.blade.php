<?php use App\Role;?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Register - HRMS admin template</title>
		<?php
			$theme_setting=DB::table('theme_settings')->first();
		?>
		<!-- Favicon --> 
        @if($theme_setting)
			@if($theme_setting->favicon!=null)
			<link rel="shortcut icon" type="image/x-icon" href="{{ url('/').'/setting_images/'.@$theme_setting->favicon }}">
			@else
			<link rel="shortcut icon" type="image/x-icon" href="{{ url('/').'img/favicon.png'}}">
			@endif
		@else
			<link rel="shortcut icon" type="image/x-icon" href="{{ url('/').'img/favicon.png'}}">
		@endif
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<div class="main-wrapper">
			<div class="account-content">
				 
				<div class="container">
					<?php
						$theme_setting=DB::table('theme_settings')->first();
						$setting=DB::table('settings')->first();
					?>
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index"><img src="{{ url('/').'/img/login_logo.png'}}" alt="HRMS"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Register</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form action="{{ route('register') }}" method="post">
								@csrf
								<div class="form-group">
									<label>Name</label>									 
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
									
									@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>								
							  	<div class="form-group">
									<label>Email</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Password</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Repeat Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
								</div>
								<div class="form-group">
									<label>Select Role</label>									
									<select class="form-control" id="role_id" name="role_id" required>
										<option value="">Select Role</option>
										@php $role_name = Role::get(); @endphp
										@isset($role_name)
                                        @foreach ($role_name as $item)
										<option value="{{ $item->id }}">{{ $item->name }}</option> 
										@endforeach
                                        @endisset
									</select>
								</div>								 
								<div class="form-group">
									<label class="col-form-label">Gender</label>
									<select class="form-control" name="gender" required>
										<option value="">Select Gender</option>
										<option value="0">Male</option> 
										<option value="1">Female</option> 
										<option value="2">Others</option> 
									</select>
								</div>                                    
								<input type="hidden" name="_token" value="{{csrf_token()}}"> 
								<div class="form-group text-center">
									<button name="button" class="btn btn-primary account-btn" type="submit">Register</button>
								</div>
								<div class="account-footer">
									<p>Already have an account? <a href="login">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>
	
 <script src="js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="js/app.js"></script>
		
    </body>
</html>
