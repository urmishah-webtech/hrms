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
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		
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
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<a href="job-list" class="btn btn-primary apply-btn">Apply Job</a>
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index"><img src="img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Register</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form action="{{route('register-user')}}" method="post">
								@if(Session::has('success'))
								<div>{{Session::get('success')}}</div>
								@endif
								@if(Session::has('fail'))
								<div>{{Session::get('fail')}}</div>
								@endif
								@csrf
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" name="name" value="">
									<span>@error('name') {{$message}} @enderror</span>
								</div>								
							  	<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="email" name="email">
									<span>@error('email') {{$message}} @enderror</span>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="password">
									<span>@error('password') {{$message}} @enderror</span>
								</div>
								<!--<div class="form-group">
									<label>Repeat Password</label>
									<input class="form-control" type="password">
								</div>-->
								<div class="form-group">
									<label>Select Role</label>									
									<select class="form-control" id="role_id" name="role_id" required>
										<option value>Role</option>
										<option value="admin">Admin</option>
										<option value="employee">Employee</option>
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
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="js/app.js"></script>
		
    </body>
</html>