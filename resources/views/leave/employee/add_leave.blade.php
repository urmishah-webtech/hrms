<div id="add_leave" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Leave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_leave_form" enctype="multipart/form-data">
                    @csrf
					{{ csrf_field() }} 
					 
                    <div class="form-group">
                        <label>Leave Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="leave_type_id" required id="leave_type_chng">
                            <option value="">Select Leave Type</option>
                            @if(@$remaining_leaves>0)
                                <option value="0">Casual Leave</option>
                               
                                @if($total_sick_taken<$sick_days)
                                    <option value="1">Sick Leave</option>
                                @endif
                                @if($total_hospitalisation_taken<$hospitalisation_days)
                                    <option value="2">Hospitalisation leave</option>
                                @endif
                                @if(Auth::user()->gender==1 && $total_maternity_taken<$maternity_days)
                                <option value="3">Maternity leave</option>
                                @endif
                                @if(Auth::user()->gender==0 && $total_paternity_taken<$paternity_days)
                                <option value="4">Paternity leave</option>
                                @endif
                            @endif
                            @if(@$remaining_leaves<=0)
                             <option value="5">Loss of Pay</option>
                            @endif 
                        </select>  
                    </div>
                    <div class="form-group">
                        <label>From <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input class="form-control" autocomplete="off" name="start_date" id="start_date" type="text">
                        </div>
                        <span class="start_date_error" style="color:red;display:none">please select proper date</span>
                    </div>
                    <div class="form-group">
                        <label>To <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input class="form-control" autocomplete="off" name="end_date" id="end_date" type="text" required>
                        </div>
                        <span class="end_date_error" style="color:red;display:none">Please Select Proper Date</span>
						<span id="limit_maternity" class="end_date_error" style="color:red;display:none">Please Select another Date</span>
						<span id="limit_sick" class="end_date_error" style="color:red;display:none">Please Select another Date</span>
						<span id="limit_hospitalisation" class="end_date_error" style="color:red;display:none"> Please Select another Date</span>
						<span id="limit_Paternity" class="end_date_error" style="color:red;display:none"> Please Select another Date</span>
                    </div>
                    <div class="form-group">
                        <label>Number of days <span class="text-danger">*</span></label>
                        <input class="form-control" name="number_of_days" readonly type="number" required id="number_of_days">
                    </div>
                    @if(@$remaining_leaves>0)
                    <div class="form-group">
                        <label>Remaining Leaves <span class="text-danger">*</span></label> 
						<input class="form-control remaining_leaves" name="remaining_leaves" readonly required value="{{ @$remaining_leaves }}" id="remaining_leaves" type="number">
                         
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Leave Reason <span class="text-danger">*</span></label>
                        <textarea rows="4" name="leave_reason" class="form-control" required></textarea>
                    </div>
					
					<div class="form-group">
                        <label>Documents <span class="text-danger"></span></label>
                        <input type="file" class="form-control" name="document_add" id="employee_documents">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<script>
 
    $(function() {
        var org_rl=$('#remaining_leaves').val()
        $( "#start_date" ).datepicker({
        defaultDate: new Date(),
        minDate: new Date(),
        onSelect: function(dateStr) 
        {       
            $('.end_date_error').hide()
            $("#end_date").val(dateStr);
            $("#end_date").datepicker("option",{ minDate: new Date(dateStr)})
            var start = $('#start_date').datepicker('getDate');
            var end   = $('#end_date').datepicker('getDate');
            var days   = ((end - start)/1000/60/60/24)+1;
            $("#number_of_days").val(days)
            var rl=$('#remaining_leaves').val()
            rl=org_rl-days;
            $('#remaining_leaves').val(rl);
        }
        });
        $( "#end_date" ).datepicker({
        onSelect: function(dateText) {
            $('.end_date_error').hide()
            var start = $('#start_date').datepicker('getDate');
            var end   = $('#end_date').datepicker('getDate');
            var days   = ((end - start)/1000/60/60/24)+1;
            $("#number_of_days").val(days)
            var rl=$('#remaining_leaves').val()
            rl=org_rl-days;
            $('#remaining_leaves').val(rl);
            if(rl<0){
              //  $("#end_date").datepicker('setDate', null);
                $("#remaining_leaves").val(org_rl)
                $("#number_of_days").val(0)
                $('.end_date_error').show();
				$('#limit_maternity').hide();
				$('#limit_sick').hide();
				$('#limit_hospitalisation').hide();
				$('#limit_Paternity').hide();
				$('button.submit-btn').removeAttr('disabled');
            }
			
			//	Maternity		
			var typeid = $('#leave_type_chng').val();   
			if(typeid == 3) {
				$.ajax({
					url:"{{ route('maternity_remaining_leave_type') }}",
					type: "GET",
					data:{"typeid":typeid, 
						   "days":days },
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
					url:"{{ route('Sick_remaining_leave_type') }}",
					type: "GET",
					data:{"typeid":typeid, 
						   "days":days },
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
						   "days":days },
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
						   "days":days },
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
    });
    $('#add_leave_form').on('submit', function(e) {
        e.preventDefault();
        $('.overlap_error').hide()      
        var rl=$('#remaining_leaves').val()
        var nd=$("#number_of_days").val();
        if(rl<0){
            return false;
        }
        if(nd==0){
            return false;
        }
		 var formData = new FormData(this);
		 
        $.ajax({
          url: "{{ url('save_leave') }}",
          type:"POST", 
			 data : formData,
            dataType : 'json',
			 contentType: false,
            processData: false,
          success:function(response){
              if(response==0){
                $("#add_leave_form")[0].reset();
                $("#add_leave").modal('hide');
                $('.overlap_error').show()      
              }
              else{
              $("#add_leave_form")[0].reset();
              $("#add_leave").modal('hide');
              location.reload();
              }
          }
        })
    });
	
	
	
</script>