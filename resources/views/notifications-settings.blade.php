@extends('layout.mainlayout')
@section('content') 

<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Notifications Settings</h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<div>
					<ul class="list-group notification-list">
					@isset($modules)
						@foreach ($modules as $val)
						<li class="list-group-item">
							{{ @$val->name }}
							<div class="status-toggle">
								<input type="checkbox" id="notification_module{{ @$val->id }}" @if(@$val->notification_status==1) checked @endif class="check" data-id="{{ @$val->id }}">
								<label for="notification_module{{ @$val->id}}" class="checktoggle">checkbox</label>
							</div>
						</li>
						@endforeach
					@endisset						 
					</ul>
				</div>  
			</div>
		</div>
	</div>
	<!-- /Page Content -->	
</div>
@endsection
<script src="js/jquery-3.5.1.min.js"></script>
<script>
		$( document ).ready(function() {
			$(document).on("click","*[id^=notification_module]",function() {				
				var id=$(this).data('id');				
				var notification_status;
				if($(this).is(":checked")) 
				{
					notification_status=1;
				}
				else{
					notification_status=0;
				}
				
				$.ajax({
					type:'POST',
					url:"{{ route('chg_Notifi') }}",
					data:{"id":id,"notification_status":notification_status,"_token": "{{ csrf_token() }}"},
					success:function(data){	
						location.reload();
					}
				});
			});
		});
	</script>
			 