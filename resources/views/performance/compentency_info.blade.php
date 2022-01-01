<style>
   .delBtn{
       color: #f62d51 !important;
   }
</style><div class="col-md-12">
    <div class="form-group">
        <table class="table table-bordered table-center">
            <thead style="background:#f2f2f2">
                <tr>
                    <th style="width: 550px;">Competency</th>
                    <th>Definition</th>
                    <th style="width: 70px;text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody id="AddInTable">
                @isset($compInfo)
                    @foreach($compInfo as $val)
                        <tr id="existingRow{{ $val->id }}">
                            <th>
                                {{ $val->name }} 				
                            </th>
                            <td>
                                <div class="task-textarea">
                                    <textarea placeholder="Definition" id="competency_definition{{ $val->id }}"  class="form-control definition_edit_6" readonly="">
                                    {{ $val->defination }}</textarea>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-primary saveBtn" style="display: none" data-id="{{ $val->id }}" title="" id="saveBtn{{ $val->id }}"  data-original-title="save"><i class="fa fa-save"></i></span>
                                <span class="text-warning editBtn" data-id="{{ $val->id }}" title="" id="editBtn{{ $val->id }}"  data-original-title="Edit"><i class="fa fa-pencil"></i></span>
                                <span href="" class="delBtn" data-id="{{ $val->id }}" class="text-danger" title="" data-toggle="ajaxModal" data-original-title="Delete"><i class="fa fa-times"></i></span>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <form id="CompForm">
            @csrf
            <table class="table performance-table">
                <tbody id="addMoreTr">
                    <tr id="mainRow">
                        <td style="padding-left: 0;">
                            <input type="text" id="firstCompName" class="form-control" name="competency[]" required="" placeholder="Competency">
                        </td>
                        <td>
                            <textarea id="firstDefination" style="height: 44px;" rows="4" cols="20" class="form-control" name="definition[]" placeholder="Definition" required=""></textarea>
                        </td>
                        <td style="padding-right: 0;min-width:55px;max-width:55px;width:55px;">
                            <button type="button" class="btn btn-white add_competency_performance" data-toggle="tooltip" data-original-title="Add Competency" style="height:44px;font-size: 16px;padding:10px 15px;"><i class="fa fa-plus-circle" id="addComp"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="">
                <button class="btn btn-primary" type="submit" id="create_offers_submit">Create Competencies</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $('#addComp').on('click',function(e){
        var text;
        var temp= Math.floor(Math.random() * (100 - 50 + 1) + 50)
        text=`<tr id="row${temp}">
                <td style="padding-left: 0;">
                    <input type="text" class="form-control" name="competency[]" required="" placeholder="Competency">
                </td>
                <td>
                    <textarea style="height: 44px;" rows="4" cols="20" class="form-control" name="definition[]" placeholder="Definition" required=""></textarea>
                </td>
            </tr>`;
        $("#addMoreTr").append(text);
    });
    $('#CompForm').on('submit',function(e){
        e.preventDefault();
        var text;
        $("#create_offers_submit").html("saving....")
        $.ajax({
          url: "{{ url('save_compentency_info') }}",
          type:"POST",
          data:$(this).serialize(),
          success:function(response){
            setTimeout(function () {
                $("#create_offers_submit").html("saved")
            }, 3000)
            setTimeout(function () {
                $("#create_offers_submit").html("Create Competencies")
            }, 4000)
            $.each(response.compentencyInfo, function(key,value) {
                text=`<tr id="existingRow`+value['id']+`">
                            <th>
                               `+value['name']+`			
                            </th>
                            <td>
                                <div class="task-textarea">
                                    <textarea placeholder="Definition" id="competency_definition${ value['id'] }" class="form-control definition_edit_6" readonly="">
                                   `+value['defination']+`</textarea>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-primary saveBtn" style="display: none" data-id="${value['id']}" title="" id="saveBtn${value['id']}"  data-original-title="save"><i class="fa fa-save"></i></span>
                                <span class="text-warning editBtn" title=""data-id="`+value['id']+`"  id="editBtn${value['id']}"  data-original-title="Edit"><i class="fa fa-pencil"></i></span>
                                <span  class="delBtn"  data-id="`+value['id']+`" class="text-danger" title="" data-toggle="ajaxModal" data-original-title="Delete"><i class="fa fa-times"></i></span>
                            </td>
                        </tr>`;
                $("#AddInTable").append(text)
                $("*[id^=row]").empty();
                $("#firstCompName").val('')
                $("#firstDefination").val('')
            });
          },
          error:function(response){
            setTimeout(function () {
                $("#create_offers_submit").html("failed")
            }, 3000)
            setTimeout(function () {
                $("#create_offers_submit").html("save")
            }, 4000)
          },
         });
    });
    $(document).on('click', '.delBtn', function(){
        var id = $(this).data('id');
        $.ajax({
          url: "{{ url('delete_compentency_info') }}",
          type:"POST",
          data:{"id":id,"_token": "{{ csrf_token() }}"},
          success:function(response){
           $('#existingRow'+id).remove()
          }
        })
    }); 
    $(document).on('click', '*[id^=editBtn]', function(){
        var id= $(this).data('id');
        $("#competency_definition"+id).prop("readonly",false); 
        $(this).hide();
        $("#saveBtn"+id).show();
    })
    $(document).on('click', '*[id^=saveBtn]', function(){
        var id= $(this).data('id');
        var defination= $("#competency_definition"+id).val();
        console.log(defination);
        $.ajax({
          url: "{{ url('edit_compentency_info') }}",
          type:"POST",
          data:{"id":id,"_token": "{{ csrf_token() }}","defination":defination},
          success:function(response){
                $("#competency_definition"+id).prop("readonly",true); 
                $('#saveBtn'+id).hide();
                $("#editBtn"+id).show();
            }
        });

    })

</script>