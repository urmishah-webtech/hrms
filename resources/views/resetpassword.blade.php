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
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
		
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
				{{-- <a href="job-list" class="btn btn-primary apply-btn">Apply Job</a> --}}
				<div class="container">
				
					<!-- Account Logo -->
					{{-- <div class="account-logo">
						<a href="index"><img src="img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div> --}}
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Reset Password</h3>
							
							<!-- Account Form -->
							@if (session()->has('message'))
							<div class="alert alert-danger" id="message">
								{{session()->get('message')}}
							</div>
							@endif
							@if (session()->has('msg'))
							@if (session()->get('status') == 1)
							<div class="alert alert-success">
								{{session()->get('msg')}}
							</div>
							@else
							<div class="alert alert-danger">
								{{session()->get('msg')}}
							</div>
							@endif
							@endif
							<form action="" method="POST">
								@csrf
                                <input type="hidden" name="userid" value="{{$id}}">
                                <input type="hidden" name="token" value="{{$token}}">
								<div class="form-group">
                                    <label>New Password :</label>
                                    <input class="form-control" type="password" placeholder="New Password" id="newpass" name="newpass">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password :</label>
                                    <input class="form-control" type="password" placeholder="Confirm New Password" id="confirmpass" name="confirmpass">
                                    <span id="notmatched" style="color:red; display:none;">password not matched !!</span>
                                    <span id="matched" style="color:green; display:none;">password matched !!</span>
                                </div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" id="changepassbtn">Reset Password</button>
								</div>
								<div class="account-footer">
									<p>Remember your password? <a href="login">Login</a></p>
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
        <script src="{{URL::asset('js/jquery-3.5.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{URL::asset('js/popper.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="js/app.js"></script>
		<script>
            $(function(){
                $("#changepassbtn").prop("disabled", true);
                $("#confirmpass").keyup(function () {
                    var newpass = $("#newpass").val();
                    var confirmpass = $("#confirmpass").val();
                    if (newpass === confirmpass) {
                        $("#notmatched").hide();
                        $("#matched").show();
                        $("#changepassbtn").prop("disabled", false);
                    } else {
                        $("#matched").hide();
                        $("#notmatched").show();
                        $("#changepassbtn").prop("disabled", true);
                    }
                });
            })
        </script>
    </body>
</html>