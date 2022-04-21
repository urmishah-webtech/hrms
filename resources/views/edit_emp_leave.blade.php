@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
            
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Leaves</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leaves</li>
                            <li class="breadcrumb-item active">Edit Leave</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="alert alert-danger alert-block error" style="display: none">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong id="errorMessage"></strong>
            </div>
            <div class="alert alert-success alert-block" style="display: none">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong id="successMessage"></strong>
            </div>
          
            <!-- Edit Leave Modal -->
            <div id="">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Leave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="edit_leave_form" enctype="multipart/form-data">
                                @csrf
								{{ csrf_field() }} 
								 <input type="hidden" value="{{ $data->id }}" name="id" id="edit_hiiden_id">
                                <div class="form-group">
                                    <label>Leave Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="leave_type_id" required id="leave_type_chng">
                                        <option value="">Select Leave Type</option>
                                        @if(@$remaining_leaves>0)
                                            <option value="0" @if( @$data->leave_type_id==0)selected @endif>Casual Leave</option>
                                            <option value="1" @if( @$data->leave_type_id==1)selected @endif >Sick Leave</option>
                                            <option value="2" @if( @$data->leave_type_id==2)selected @endif>Hospitalisation leave</option>
                                            @if(Auth::user()->gender==1)
                                                <option @if( @$data->leave_type_id==3)selected @endif value="3">Maternity leave</option>
                                            @endif
                                            @if(Auth::user()->gender==0)
                                                <option @if( @$data->leave_type_id==4)selected @endif value="4">paternity leave</option>
                                            @endif
                                        @endif
                                        @if(@$remaining_leaves<=0)
                                        <option @if( @$data->leave_type_id==5)selected @endif value="5">Loss of Pay</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>From <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input required class="form-control" name="start_date" id="start_date" type="text">
                                    </div>
                                    <span class="start_date_error" style="color:red;display:none">please select proper date</span>
                                </div>

                                <div class="form-group">
                                    <label>To <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input required class="form-control" name="end_date" id="end_date" type="text">
                                    </div>
                                    <span class="end_date_error" style="color:red;display:none">please select proper date</span>
									<span id="limit_maternity" class="end_date_error" style="color:red;display:none">You have only {{ @$maternity_days }} Leaves in Remaining  in as a Maternity Leave, Please Select onther Date</span>
									<span id="limit_sick" class="end_date_error" style="color:red;display:none">You have only {{ @$sick_days }} Leaves in Remaining  in as a Sick Leave, Please Select onther Date</span>
									<span id="limit_hospitalisation" class="end_date_error" style="color:red;display:none">You have only {{ @$hospitalisation_days }} Leaves in Remaining  in as a Hospitalisation, Please Select onther Date</span>
									<span id="limit_Paternity" class="end_date_error" style="color:red;display:none">You have only {{ @$paternity_days }} Leaves in Remaining  in as a Paternity, Please Select onther Date</span>
                                </div> 
                               
                                <div class="form-group">
                                    <label>Number of days <span class="text-danger">*</span></label>
                                    <input class="form-control" name="number_of_days" readonly type="number" value="{{ @$data->number_of_days }}" required id="number_of_days">
                                </div>
                                <div class="form-group">
                                    <label>Remaining Leaves <span class="text-danger">*</span></label>
                                    <input class="form-control" name="remaining_leaves" readonly required value="{{ @$remaining_leaves }}" id="remaining_leaves" type="number">
                                </div>
                                <div class="form-group">
                                    <label>Leave Reason <span class="text-danger">*</span></label>
                                    <textarea rows="4"  name="leave_reason" class="form-control" required >{{ @$data->leave_reason }}</textarea>
                                </div>
								<div class="form-group">
									<label>Documents <span class="text-danger"></span></label>
									<input type="file" class="form-control" name="document_add" id="employee_documents">
                                    @if($data->employee_documents!='') 
									<h4 class="edit_leave_download"><a href="{{url('employee_documents').'/'.@$data->employee_documents}}" download="{{@$data->employee_documents}}"><i class="fa fa-download"></i> Download</a></h4>
									<h4>Name : {{@$data->employee_documents}}</h4>
                                    @endif
								</div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Leave Modal -->
      
        </div>
        <!-- /Page Wrapper -->


<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<script>
 $(function() {
    var org_rl=parseInt($('#remaining_leaves').val())
    var org_num=parseInt($("#number_of_days").val())
    var rl=0;
    $( "#start_date" ).datepicker({
             dateFormat: "yy-mm-dd",
             minDate: new Date(),
            onSelect: function(dateStr) 
            {       
                $('.end_date_error').hide()
                $("#end_date").val(dateStr);
                $("#end_date").datepicker("option",{ minDate: new Date(dateStr)})
                var start = $('#start_date').datepicker('getDate');
                var end   = $('#end_date').datepicker('getDate');
                var days   = ((end - start)/1000/60/60/24)+1;
                if(org_num>days){
                     rl=(org_rl+(org_num-days));
                }
                if(days>org_num)
                {
                    rl=org_rl-(days-org_num);
                }
                if(days==org_num){
                     rl=org_rl
                }
            //    else{
            //          rl=org_rl-days;
            //    }
                $("#number_of_days").val(days)
                $('#remaining_leaves').val(rl);
            }
    });
    $("#start_date").datepicker('setDate', '{{ $data->from_date }}');
    $( "#end_date" ).datepicker({ dateFormat: "yy-mm-dd",minDate:0,
        onSelect: function(dateText) {
            $('.end_date_error').hide()
            var start = $('#start_date').datepicker('getDate');
            var end   = $('#end_date').datepicker('getDate');
            var days   = ((end - start)/1000/60/60/24)+1;
            console.log(days)
            $("#number_of_days").val(days)
            if(org_num>days){
                rl=org_rl+(org_num-days);
            }
            if(days>org_num)
            {
                rl=org_rl-(days-org_num);
            }
            if(days==org_num){
                rl=org_rl
            }
            $('#remaining_leaves').val(rl);
            if(days<=0){
                $("#remaining_leaves").val(org_rl)
                $("#number_of_days").val(0)
                $('.end_date_error').show()
				$('#limit_maternity').hide();
				$('#limit_sick').hide();
				$('#limit_hospitalisation').hide();
				$('#limit_Paternity').hide();
				$('button.submit-btn').removeAttr('disabled');	
            }
			//	Maternity		
			var typeid = $('#leave_type_chng').val();  
			var id = $('#edit_hiiden_id').val();   
			if(typeid == 3) {
				$.ajax({
					url:"{{ route('maternity_remaining_leave_type') }}",
					type: "GET",
					data:{"typeid":typeid, 
						   "days":days,
							"id":id},
					success:function(data) {
						  if(data == false){
							$('#limit_maternity').show();
							$('button.submit-btn').attr('disabled','disabled');
						  }
						  else{
							$('#limit_maternity').hide();
							$('button.submit-btn').removeAttr('disabled');
						  }
						}
					});			 
				}
			/// Sick
			if(typeid == 1) {
				$.ajax({
					url:"{{ URL::route('Edit_Sick_remaining_leave_type', 'id') }}",
					type: "GET",
					data:{"typeid":typeid, 
						   "days":days,
							"id":id},
					success:function(data) {
						  if(data == false){
							$('#limit_sick').show();
							$('button.submit-btn').attr('disabled','disabled');
						  }
						  else{
							$('#limit_sick').hide();
							$('button.submit-btn').removeAttr('disabled');
						  }
						}
					});			 
				}
			/// Hospitalisation
			if(typeid == 2) {
				$.ajax({
					url:"{{ route('Hospitalisation_remaining_leave_type') }}",
					type: "GET",
					data:{"typeid":typeid, 
						   "days":days,
							"id":id},
					success:function(data) {
						  if(data == false){
							$('#limit_hospitalisation').show();
							$('button.submit-btn').attr('disabled','disabled');
						  }
						  else{
							$('#limit_hospitalisation').hide();
							$('button.submit-btn').removeAttr('disabled');
						  }
						}
					});			 
				}
			/// Paternity
			if(typeid == 4) {
				$.ajax({
					url:"{{ route('Paternity_remaining_leave_type') }}",
					type: "GET",
					data:{"typeid":typeid, 
						   "days":days,
							"id":id},
					success:function(data) {
						  if(data == false){
							$('#limit_Paternity').show();
							$('button.submit-btn').attr('disabled','disabled');
						  }
						  else{
							$('#limit_Paternity').hide();
							$('button.submit-btn').removeAttr('disabled');
						  }
						}
					});			 
				}
        }
    });
    $("#end_date").datepicker('setDate', '{{ $data->to_date }}');
    $('#edit_leave_form').on('submit', function(e) {
        e.preventDefault();
        var rl=$('#remaining_leaves').val()
        var nd=$("#number_of_days").val();
        if(rl<0){
            return false;
        }
        if(nd==0){
            return false;
        }
        if(nd<=0){
            return false;
        }
		 var formData = new FormData(this);
        $.ajax({
          url: "{{ url('update_leave') }}",
          type:"POST",
           data : formData,
		   
			 contentType: false,
            processData: false,
          success:function(response){
            if(response.status==0){
                $(".error").show();
                $("#errorMessage").html(response.message);
			//	location.reload();
            }else{
                location.reload();
            }
          }
        })
    });

})
</script>
<style>
h4.edit_leave_download{margin-top: 14px;}
</style>

@endsection