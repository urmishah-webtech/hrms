
 <!--0.1 to  1.0 Ratings Content -->
 <div class="form-group" id="5ratings_cont_competency" style="display: block">
    <div class="table-responsive">
        <form id="c_scale2Form">
            @csrf
            <table class="table setting-performance-table">
                <thead>
                    <tr>
                        <th>Rating</th>
                        <th>Short Descriptive Word</th>
                        <th>Definition</th>
                    </tr>
                </thead>
                <tbody>
                @for ($i = 1; $i <= 5; $i++)
                 
                    <tr>
                        <td class="rating_cid" style="width:50px;"> {{ $i }} </td>
                        <td style="width: 300px;">
                            <input type="hidden" value="scale_2" name="scale_type">
                            <input type="hidden" name="rating_no[]" class="form-control" value="{{ $i }}">
                            <input type="text" name="rating_value_ten[]" id="c_s2_rating_value_ten{{ $i }}" class="form-control" value="" placeholder="Short word to describe rating of 0.1" required="">
                        </td>
                        <td>
                            <textarea rows="3" name="definition_ten[]"  id="c_s2_definition_ten{{ $i }}" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                        </td>
                    </tr>
                @endfor
                   
                </tbody>
            </table>
            <div class="submit-section m-b-0">
                <button class="btn btn-primary submit-btn create_goal_configuration_submit" id="c_scale2Btn" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- 0.1 to  1.0  Ratings Content -->
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $('#c_scale_2').on('click',function(e){
        $('#5ratings_cont_competency').show();
        $('#10ratings_cont_competency').hide();
        $.ajax({
          url: "{{ url('get_c_scale2') }}",
          type:"POST",
          data:{"type":"scale_2","_token": "{{ csrf_token() }}"},
          success:function(data){
            $.each(data.rate_data, function(key, val) 
			{
                $("#c_s2_rating_value_ten"+key).val(val['short_word'])
                $("#c_s2_definition_ten"+key).val(val['defination']);
            });
          }
        });
    })
    $('#c_scale2Form').on('submit',function(e){
        e.preventDefault();
        $("#c_scale2Btn").html("saving....")
        $.ajax({
          url: "{{ url('save_c_scale2') }}",
          type:"POST",
          data:$(this).serialize(),
          success:function(response){
            setTimeout(function () {
                $("#c_scale2Btn").html("saved")
            }, 3000)
            setTimeout(function () {
                $("#c_scale2Btn").html("save")
            }, 4000)
          },
          error:function(response){
            setTimeout(function () {
                $("#c_scale2Btn").html("failed")
            }, 3000)
            setTimeout(function () {
                $("#c_scale2Btn").html("save")
            }, 4000)
          },
         });
    });
</script>