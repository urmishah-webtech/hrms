@extends('layout.mainlayout')
@section('content')
  
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-2">			 
				@if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                @endif
				<form method="post" action="{{ route("emailsetting_update") }}">
					 @csrf
					 
					 <div class="form-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="mailoption" id="phpmail" @if(@$esettings->mailoption=='PHP Mail') checked @endif  value="PHPMail" checked>
							<label class="form-check-label" for="phpmail">PHP Mail</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="mailoption" id="smtpmail"  @if(@$esettings->mailoption=='SMTP') checked @endif value="SMTP">
							<label class="form-check-label" for="smtpmail">SMTP</label>
						</div>
					</div>
					<h4 class="page-title">PHP Email Settings</h4>
					<div class="row">						 
						<div class="col-sm-6">
							<div class="form-group">
								<label>Email From Address</label>
								<input class="form-control" type="email" name="email_from_address" value="{{ @$esettings->email_from_address }}">
							</div>
						</div>					 
						<div class="col-sm-6">
							<div class="form-group">
								<label>Emails From Name</label>
								<input class="form-control" type="text" name="email_from_name" value="{{ @$esettings->email_from_name }}">
							</div>
						</div>
					</div>
					<h4 class="page-title m-t-30">SMTP Email Settings</h4>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP HOST</label>
								<input class="form-control" type="text" name="smtp_host" value="{{ @$esettings->smtp_host }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP USER</label>
								<input class="form-control" type="text" name="smtp_user" value="{{ @$esettings->smtp_user }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP PASSWORD</label>
								<input class="form-control" type="password" name="smtp_password" value="{{ @$esettings->smtp_password }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP PORT</label>
								<input class="form-control" type="number" name="smtp_port" value="{{ @$esettings->smtp_port }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP Security</label>
								<select class="select" name="smtp_security">
									<option value="">None</option>
									<option @if(@$esettings->smtp_security=='SSL') selected @endif value="SSL">SSL</option>
									<option @if(@$esettings->smtp_security=='TLS') selected @endif value="TLS">TLS</option>									 
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP Authentication Domain</label>
								<input class="form-control" type="text" name="smtp_domain" value="{{ @$esettings->smtp_domain }}">
							</div>
						</div>
					</div>
					<div class="submit-section">
						<button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
	
</div>
@endsection