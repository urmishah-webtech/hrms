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
                <form>
                    <div class="form-group">
                        <label>Leave Type <span class="text-danger">*</span></label>
                        <select class="select">
                            <option value="">Select Leave Type</option>
                            <option value="0">Casual Leave</option>
                            <option value="1">Sick Leave</option>
                            <option value="2">Hospitalisation leave</option>
                            @if(Auth::user()->gender==1)
                            <option value="3">Maternity leave</option>
                            @endif
                            @if(Auth::user()->gender==0)
                            <option value="4">paternity leave</option>
                            @endif
                            @if(@$remaining_leaves<=0)
                            <option value="5">Loss of Pay</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>From <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input class="form-control" id="start_date" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>To <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input class="form-control" id="end_date" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Number of days <span class="text-danger">*</span></label>
                        <input class="form-control" readonly type="number" id="number_of_days">
                    </div>
                    <div class="form-group">
                        <label>Remaining Leaves <span class="text-danger">*</span></label>
                        <input class="form-control" readonly value="{{ @$remaining_leaves }}" id="remaining_leaves" type="number">
                    </div>
                    <div class="form-group">
                        <label>Leave Reason <span class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control"></textarea>
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
        $( "#start_date" ).datepicker({minDate:0});
        $( "#end_date" ).datepicker({
        minDate:0,
        onSelect: function(dateText) {
            var start = $('#start_date').datepicker('getDate');
            var end   = $('#end_date').datepicker('getDate');
            var days   = (end - start)/1000/60/60/24;
            $("#number_of_days").val(days)
            var rl=$('#remaining_leaves').val()
            rl=rl-days;
            $('#remaining_leaves').val(rl);
        }
        });

    });

</script>