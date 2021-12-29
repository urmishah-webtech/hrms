<div class="col-md-12 col-lg-12">
    <form id="okrForm">
    <div class="form-group">
        <label>OKRs Description</label>
        <textarea rows="5" cols="5" class="form-control" name="okr_description" id="okr_description">
            {{ @$settings->okr_description }}
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="save" class="btn btn-primary" id="saveBtn">
    </div>
    </form>
</div>
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $('#okrForm').on('submit',function(e){
        e.preventDefault();
        $("#saveBtn").val("saving....")
        var okr_description = $('#okr_description').val();
        
        $.ajax({
          url: "{{ url('save_okr') }}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            okr_description:okr_description
          },
          success:function(response){
            setTimeout(function () {
                $("#saveBtn").val("saved")
            }, 3000)
            setTimeout(function () {
                $("#saveBtn").val("save")
            }, 4000)
          },
          error:function(response){
            setTimeout(function () {
                $("#saveBtn").val("failed")
            }, 3000)
            setTimeout(function () {
                $("#saveBtn").val("save")
            }, 4000)
          },
         });
    
    });
</script>