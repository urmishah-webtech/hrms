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
                <form id="add_leave_form">
                    @csrf
                    <div class="form-group">
                        <label>Leave Type <span class="text-danger">*</span></label>
                        <select class="select" name="leave_type_id" required>
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
                                <option value="4">paternity leave</option>
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
                        <span class="end_date_error" style="color:red;display:none">please select proper date</span>
                    </div>
                    <div class="form-group">
                        <label>Number of days <span class="text-danger">*</span></label>
                        <input class="form-control" name="number_of_days" readonly type="number" required id="number_of_days">
                    </div>
                    @if(@$remaining_leaves>0)
                    <div class="form-group">
                        <label>Remaining Leaves <span class="text-danger">*</span></label>
                        <input class="form-control" name="remaining_leaves" readonly required value="{{ @$remaining_leaves }}" id="remaining_leaves" type="number">
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Leave Reason <span class="text-danger">*</span></label>
                        <textarea rows="4" name="leave_reason" class="form-control" required></textarea>
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
                $('.end_date_error').show()      
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
        $.ajax({
          url: "{{ url('save_leave') }}",
          type:"POST",
          data:$(this).serialize(),
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