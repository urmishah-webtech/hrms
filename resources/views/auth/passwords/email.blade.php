<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Forgot Password - HRMS admin template</title>
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
        <link rel="stylesheet" href="/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="/css/style.css">
		
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
						@isset($theme_setting)
						@if($theme_setting->light_logo!=null)
						<a href="index"><img src="{{ url('/').'/setting_images/'.@$theme_setting->light_logo }}" alt="Dreamguy's Technologies"></a>
						@else
						<a href="index"><img src="img/logo2.png" alt="Dreamguy's Technologies"></a>
						@endif
						@endisset
						 
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Forgot Password?</h3>
							<p class="account-subtitle">Enter your email to get a password reset link</p>
							
							<!-- Account Form -->
							<form method="POST" action="{{ route('password.email') }}">
								@csrf
								<div class="form-group">
									<label>Email Address</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Reset Password</button>
								</div>
								<div class="account-footer">
									<p>Remember your password? <a href="/login">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>

<script src="/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="/js/app.js"></script>
		
    </body>
</html>
