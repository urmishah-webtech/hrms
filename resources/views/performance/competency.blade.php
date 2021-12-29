<div class="col-md-12">
    <form id="compForm">
    <div class="form-group">
        <label>Competency-based</label>
        <textarea rows="4" cols="5" class="form-control"  name="competencies_desc"  id="competencies_desc">
            {{ @$settings->competency_based }}
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="save" class="btn btn-primary" id="saveCompBtn">
    </div>
    <div class="submit-section my-3">			
        <button class="m-0 btn btn-sm btn-primary submit-btn performance_status " data-status="competency" title="" style="margin: 23px 0px;">Activate Competency-based</button>
    </div>
    </form>
</div>
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $('#compForm').on('submit',function(e){
        e.preventDefault();
        $("#saveCompBtn").val("saving....")
        var competencies_desc = $('#competencies_desc').val();
        $.ajax({
          url: "{{ url('save_competency') }}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            competencies_desc:competencies_desc
          },
          success:function(response){
            setTimeout(function () {
                $("#saveCompBtn").val("saved")
            }, 3000)
            setTimeout(function () {
                $("#saveCompBtn").val("save")
            }, 4000)
          },
          error:function(response){
            setTimeout(function () {
                $("#saveCompBtn").val("failed")
            }, 3000)
            setTimeout(function () {
                $("#saveCompBtn").val("save")
            }, 4000)
          },
         });
    
    });
</script>