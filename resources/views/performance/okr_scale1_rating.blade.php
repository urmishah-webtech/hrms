
 <!--0.1 to  1.0 Ratings Content -->
 <div class="form-group" id="01ratings_cont_okr" style="display: none">
    <div class="table-responsive">
        <form id="scale1Form">
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
                @for ($i = 1; $i <= 10; $i++)
                 
                    <tr>
                        <td class="rating_cid" style="width:50px;"> {{ $i/10 }} </td>
                        <td style="width: 300px;">
                            <input type="hidden" value="scale_1" name="scale_type">
                            <input type="hidden" name="rating_no[]" class="form-control" value="{{ $i/10 }}">
                            <input type="text" name="rating_value_ten[]" id="s1_rating_value_ten{{ $i }}" class="form-control" value="" placeholder="Short word to describe rating of 0.1" required="">
                        </td>
                        <td>
                            <textarea rows="3" name="definition_ten[]"  id="s1_definition_ten{{ $i }}"  class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                        </td>
                    </tr>
                @endfor
                   
                </tbody>
            </table>
            <div class="submit-section m-b-0">
                <button class="btn btn-primary submit-btn create_goal_configuration_submit" id="scale1Btn" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- 0.1 to  1.0  Ratings Content -->
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $('#scale_1').on('click',function(e){
        $('#5ratings_cont_okr').hide();
        $('#01ratings_cont_okr').show();
        $('#10ratings_cont_okr').hide();
        
        $('#scale1_bar').show();
        $('#scale2_bar').hide();
        $('#scale3_bar').hide();


        $.ajax({
          url: "{{ url('get_scale2') }}",
          type:"POST",
          data:{"type":"scale_1","_token": "{{ csrf_token() }}"},
          success:function(data){
            $.each(data.rate_data, function(key, val) 
			{
               
                if(data.rate_data!=null){
                $("#s1_rating_value_ten"+key*10).val(val['short_word'])
                $("#s1_definition_ten"+key*10).val(val['defination']);
                }
            });
          }
        });
    })
    $('#scale1Form').on('submit',function(e){
        e.preventDefault();
        $("#scale1Btn").html("saving....")
        $.ajax({
          url: "{{ url('save_scale2') }}",
          type:"POST",
          data:$(this).serialize(),
          success:function(response){
            setTimeout(function () {
                $("#scale1Btn").html("saved")
            }, 3000)
            setTimeout(function () {
                $("#scale1Btn").html("save")
            }, 4000)
          },
          error:function(response){
            setTimeout(function () {
                $("#scale1Btn").html("failed")
            }, 3000)
            setTimeout(function () {
                $("#scale1Btn").html("save")
            }, 4000)
          },
         });
    });
</script>