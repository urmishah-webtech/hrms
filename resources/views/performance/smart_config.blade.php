<div class="col-md-12">
    <form id="smartForm">
    <div class="form-group">
        <label>Smart Goals Configuration</label>
        <textarea rows="4" cols="5" class="form-control"  name="smart_desc"  id="smart_desc">
            {{ @$settings->smart_goals_configuration }}
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="save" class="btn btn-primary" id="saveSmartBtn">
    </div>
    <div class="submit-section my-3">
        @if(@$settings->smart_goals_active==0)			
        <a  href="{{ url('changeStatus/3') }}"  class="m-0 btn btn-sm btn-primary submit-btn performance_status " data-status="competency" title="" style="margin: 23px 0px;">Activate SMART GOALS</a>
        @else
        <a  href=""  class="m-0 btn btn-sm btn-primary submit-btn performance_status " data-status="competency" title="" style="margin: 23px 0px;">SMART GOALS Activated </a>
        @endif
    </div>
    </form>
</div>
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $('#smartForm').on('submit',function(e){
        e.preventDefault();
        $("#saveSmartBtn").val("saving....")
        var smart_desc = $('#smart_desc').val();
        $.ajax({
          url: "{{ url('save_smart_config') }}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            smart_desc:smart_desc
          },
          success:function(response){
            setTimeout(function () {
                $("#saveSmartBtn").val("saved")
            }, 3000)
            setTimeout(function () {
                $("#saveSmartBtn").val("save")
            }, 4000)
          },
          error:function(response){
            setTimeout(function () {
                $("#saveSmartBtn").val("failed")
            }, 3000)
            setTimeout(function () {
                $("#saveSmartBtn").val("save")
            }, 4000)
          },
         });
    
    });
</script>