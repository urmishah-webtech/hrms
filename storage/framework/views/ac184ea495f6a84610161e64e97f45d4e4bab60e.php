
<?php $__env->startSection('content'); ?>
  
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-2">			 
				<?php if($message = Session::get('error')): ?>
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong><?php echo e($message); ?></strong>
                        </div>
                <?php endif; ?>
				<form method="post" action="<?php echo e(route("emailsetting_update")); ?>">
					 <?php echo csrf_field(); ?>
					 <div class="form-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="mailoption" id="phpmail" <?php if(@$esettings->mailoption=='PHP Mail'): ?> checked <?php endif; ?>  value="PHPMail" checked>
							<label class="form-check-label" for="phpmail">PHP Mail</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="mailoption" id="smtpmail"  <?php if(@$esettings->mailoption=='SMTP'): ?> checked <?php endif; ?> value="SMTP">
							<label class="form-check-label" for="smtpmail">SMTP</label>
						</div>
					</div>
					<h4 class="page-title">PHP Email Settings</h4>
					<div class="row">						 
						<div class="col-sm-6">
							<div class="form-group">
								<label>Email From Address</label>
								<input class="form-control" type="email" name="email_from_address" value="<?php echo e(@$esettings->email_from_address); ?>" required>
							</div>
						</div>					 
						<div class="col-sm-6">
							<div class="form-group">
								<label>Emails From Name</label>
								<input class="form-control" type="text" name="email_from_name" value="<?php echo e(@$esettings->email_from_name); ?>" required>
							</div>
						</div>
					</div>
					<h4 class="page-title m-t-30">SMTP Email Settings</h4>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP HOST</label>
								<input class="form-control" type="text" name="smtp_host" value="<?php echo e(@$esettings->smtp_host); ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP USER</label>
								<input class="form-control" type="text" name="smtp_user" value="<?php echo e(@$esettings->smtp_user); ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP PASSWORD</label>
								<input class="form-control" type="password" name="smtp_password" value="<?php echo e(@$esettings->smtp_password); ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP PORT</label>
								<input class="form-control" type="number" name="smtp_port" value="<?php echo e(@$esettings->smtp_port); ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP Security</label>
								<select class="select" name="smtp_security">
									<option value="">None</option>
									<option <?php if(@$esettings->smtp_security=='SSL'): ?> selected <?php endif; ?> value="SSL">SSL</option>
									<option <?php if(@$esettings->smtp_security=='TLS'): ?> selected <?php endif; ?> value="TLS">TLS</option>									 
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>SMTP Authentication Domain</label>
								<input class="form-control" type="text" name="smtp_domain" value="<?php echo e(@$esettings->smtp_domain); ?>">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hrms\resources\views/email-settings.blade.php ENDPATH**/ ?>