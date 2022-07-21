<!-- Add First  Modal -->

@if($getrecord)
<section class="review-section @if($getrecord->warmingstatus == 1 || $getrecord->warmingstatus == 2 || $getrecord->warmingstatus == 3) disabled @endif">
    <div class="review-header text-center">
        <h3 class="review-title">1st Verbal Warning</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
            
             <input type="hidden" class="form-control" name="indexid" id="indexid" value="{{$getrecord->id}}">
                <table class="table table-bordered table-review review-table mb-0" id="table_goals">
                    <thead>
                        <tr> 
                            <th style="width:40px;">#</th>
                            @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
                            <!--<th>Employee Comment</th>-->
                            <th>HR's Input</th>
                            <th>Comments </th>
                            <th>Area's for Improvement</th> 
                            <th>Documents</th>
                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row-warning"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="table_goals_tbody">
                          <?php $admin_comments_first_json = json_decode($getrecord->admin_comments_first); 
                                $areas_for_improvement_first_json = json_decode($getrecord->areas_for_improvement_first); 
                                $hr_input_first_json = json_decode($getrecord->hr_input_first); 
                                $employee_documents_json = json_decode($getrecord->employee_documents_first); 
                            ?>
                          @foreach($admin_comments_first_json as $key => $comment)   

                         <tr>
                            <td>1</td>
                            @if(Auth::user()->role_id == 3)
                            <input type="hidden" name="second_emp_id" id="edit_emp_id" value="">
                            @endif
                            @if(Auth::user()->role_id != 3)
                            <td>
                                <input type="hidden" name="second_emp_id" id="edit_emp_id" value="">
                                <input type="text" class="form-control" name="emp_name" id="edit_emp_name" value="@if($emp_name1){{$emp_name1->first_name}}@endif" required readonly>
                              
                            </td>
                            @endif
                            <!--<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td> -->
                            <td><input type="text" class="form-control" name="edit_hr_input[]" id="edit_hr_input" value="@if($hr_input_first_json){{$hr_input_first_json[$key]}}@endif" @if(Auth::user()->role_id != 5)readonly @endif></td>
                            <td><textarea type="text" class="form-control" name="edit_admin_comments[]" id="edit_admin_comments" value=""  @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50">@if($comment){{$comment}}@endif</textarea></td>
                            <td><input type="text" class="form-control" name="edit_areas_for_improvement[]" value="@if($areas_for_improvement_first_json){{$areas_for_improvement_first_json[$key]}}@endif" id="edit_areas_for_improvement" @if(Auth::user()->role_id == 3)readonly @endif></td>
                            <td><input type="file" class="form-control" name="edit_fileadd[]" id="edit_fileadd" @if(Auth::user()->role_id == 3)readonly @endif>
                              @if(!empty($employee_documents_json[$key]))
                              <a class="form-control" href="{{ route('download-warming-image',$employee_documents_json[$key]) }}">download</a>
                              @endif
                            </td> 
                            <td></td>
                        </tr>
                        @endforeach
                          
                    </tbody>
                </table>
                <div class="review-header text-center">
                    <button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
                </div>
            </div>
        </div>
    </div>
</section> 
<section class="review-section @if($getrecord->warmingstatus == 2 || $getrecord->warmingstatus == 3)disabled @endif">
    <div class="review-header text-center">
        <h3 class="review-title">2nd Verbal Warning</h3>
    </div>
    @if($getrecord->warmingstatus == 1) <input type="hidden" class="form-control" name="status" id="status" value="2"> @endif
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-review2 review-table mb-0" id="table_secondwarning">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
                            <!--<th>Employee Comment</th>-->
                            <th>HR's Input</th>
                            <th>Comments</th>
                            <th>Area's for Improvement</th>
                            <th>Documents</th>
                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-second-warning2"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="table_secondwarning_tbody">
                            <?php   $admin_comments_second_json = json_decode($getrecord->admin_comments_second); 
                                    $areas_for_improvement_second_json = json_decode($getrecord->areas_for_improvement_second); 
                                    $hr_input_second_json = json_decode($getrecord->hr_input_second); 
                                     $employee_documents_second_json = json_decode($getrecord->employee_documents_second); 
                                     $employee_documents_third_json = json_decode($getrecord->employee_documents_third); 
                                  //  dd($hr_input_second_json);
                            ?>
                          @if($admin_comments_second_json)
                          @foreach($admin_comments_second_json as $key => $comment)       
                         <tr>
                            <td>1</td>
                             @if(Auth::user()->role_id == 3)
                            <input type="hidden" name="second_emp_id" id="second_edit_emp_id" value="">
                            @endif
                            @if(Auth::user()->role_id != 3)
                            <td>
                                <input type="hidden" name="second_emp_id" id="second_edit_emp_id" value="">
                                <input type="text" class="form-control" name="emp_id" id="second_edit_emp_name" value="@if($emp_name1){{$emp_name1->first_name}}@endif" required readonly>
                              
                            </td>
                            @endif
                            <td><input type="text" class="form-control" name="second_hr_input_second[]" id="second_edit_hr_input" value="@if(!$hr_input_second_json && $hr_input_second_json[$key] !== null){{$hr_input_second_json[$key]}}@endif" @if(Auth::user()->role_id != 5)readonly @endif></td>
                            <td><textarea type="text" class="form-control" name="second_admin_comments_second[]" id="second_edit_admin_comments"  @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50">@if($comment){{$comment[$key]}}@endif</textarea></td>
                            <td><input type="text" class="form-control" name="second_areas_for_improvement_second[]" value="@if($areas_for_improvement_second_json){{$areas_for_improvement_second_json[$key]}}@endif" id="second_edit_areas_for_improvement" @if(Auth::user()->role_id == 3)readonly @endif></td>
                            <td><input type="file" class="form-control" name="second_fileadd_second[]" id="second_fileadd" @if(Auth::user()->role_id == 3)readonly @endif>
                              @if(!empty($employee_documents_second_json[$key]))
                              <a class="form-control" href="{{ route('download-warming-image',$employee_documents_second_json[$key]) }}">download</a>
                              @endif
                            </td>
                            <input type="hidden" class="form-control" id="second_getid" name="second_getid_second" value="" >
                            <td></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>1</td>
                             @if(Auth::user()->role_id == 3)
                            <input type="hidden" name="second_emp_id" id="second_edit_emp_id" value="">
                            @endif
                            @if(Auth::user()->role_id != 3)
                            <td>
                                <input type="hidden" name="second_emp_id" id="second_edit_emp_id" value="">
                                <input type="text" class="form-control" name="emp_id" id="second_edit_emp_name" value="@if($emp_name1){{$emp_name1->first_name}}@endif" required readonly>
                              
                            </td>
                            @endif
                            <td><input type="text" class="form-control" name="second_hr_input_second[]" id="second_edit_hr_input" value="" @if(Auth::user()->role_id != 5)readonly @endif></td>
                            <td><textarea type="text" class="form-control" name="second_admin_comments_second[]" id="second_edit_admin_comments" value=""  @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50"></textarea></td>
                            <td><input type="text" class="form-control" name="second_areas_for_improvement_second[]" value="" id="second_edit_areas_for_improvement" @if(Auth::user()->role_id == 3)readonly @endif></td>
                            <td><input type="file" class="form-control" name="second_fileadd_second[]" id="second_fileadd" @if(Auth::user()->role_id == 3)readonly @endif>
                             @if(!empty($employee_documents_third_json[$key]))
                              <a class="form-control" href="{{ route('download-warming-image',$employee_documents_third_json[$key]) }}">download</a>
                              @endif
                            </td>
                            <input type="hidden" class="form-control" id="second_getid" name="second_getid_second" value="" >
                            <td></td>
                        </tr>
                        @endif

                          
                    </tbody>
                </table>
                <div class="review-header text-center">
                    <button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
                </div>
            
            </div>
        </div>
    </div>
</section>
<section class="review-section @if($getrecord->warmingstatus == 3 || $getrecord->warmingstatus == 1) disabled @endif">
    <div class="review-header text-center">
        <h3 class="review-title">3rd Verbal Warning</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
              @if($getrecord->warmingstatus == 2) <input type="hidden" class="form-control" name="status" id="status" value="3"> @endif
             <input type="hidden" class="form-control" name="getid_third" value="" id="getidjq">
                <table class="table table-bordered table-review3 review-table mb-0" id="table_thirdwarning">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            @if(Auth::user()->role_id != 3)<th>Employees</th>@endif
                            <!--<th>Employee Comment</th>-->
                            <th>HR's Input</th>
                            <th>Comments</th>
                            <th>Documents</th>
                            <th style="width: 64px;"><button type="button" class="btn btn-primary btn-third-warning3"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="table_thirdwarning_tbody">
                        <?php $admin_comments_third_json = json_decode($getrecord->admin_comments_third); 
                                $areas_for_improvement_third_json = json_decode($getrecord->areas_for_improvement_third); 
                                $hr_input_third_json = json_decode($getrecord->hr_input_third); 
                            ?>
                        @if($admin_comments_third_json)
                          @foreach($admin_comments_third_json as $key => $comment)                                          
                         <tr>
                            <td>1</td>
                            @if(Auth::user()->role_id == 3)
                            <input type="hidden" name="third_edit_emp_id" id="third_edit_emp_id" value="{{Auth::user()->id}}">
                            @endif
                            @if(Auth::user()->role_id != 3)
                            <td>
                                <input type="hidden" name="third_edit_emp_id" id="third_edit_emp_id" value="">
                                <input type="text" class="form-control" name="emp_id" id="third_emp_name" value="@if($emp_name1){{$emp_name1->first_name}}@endif" required readonly>
                              
                            </td>
                            @endif
                            <!--<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td>-->
                            <td><input type="text" class="form-control" name="third_hr_input_third[]" id="third_hr_input_third" value="@if($hr_input_third_json){{$hr_input_third_json[$key]}}@endif" @if(Auth::user()->role_id != 5)readonly @endif></td>
                            <td><textarea type="text" class="form-control" name="third_admin_comments_third[]" id="third_admin_comments_third" value="" @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50">@if($comment){{$comment}}@endif</textarea></td>
                            <td><input type="file" class="form-control" name="third_fileadd_third[]" id="fileadd_third" @if(Auth::user()->role_id == 3)readonly @endif>

                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                        @else
                         <tr>
                            <td>1</td>
                            @if(Auth::user()->role_id == 3)
                            <input type="hidden" name="third_edit_emp_id" id="third_edit_emp_id" value="{{Auth::user()->id}}">
                            @endif
                            @if(Auth::user()->role_id != 3)
                            <td>
                                <input type="hidden" name="third_edit_emp_id" id="third_edit_emp_id" value="">
                                <input type="text" class="form-control" name="emp_id" id="third_emp_name" value="@if($emp_name1){{$emp_name1->first_name}}@endif" required readonly>
                              
                            </td>
                            @endif
                            <!--<td><input type="text" class="form-control" name="employee_comments[]"  @if(Auth::user()->role_id != 3) readonly @endif ></td>-->
                            <td><input type="text" class="form-control" name="third_hr_input_third[]" id="third_hr_input_third" value="" @if(Auth::user()->role_id != 5)readonly @endif></td>
                            <td><textarea type="text" class="form-control" name="third_admin_comments_third[]" id="third_admin_comments_third" value="" @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 6)editable @else readonly @endif rows="4" cols="50"></textarea></td>
                            <td><input type="file" class="form-control" name="third_fileadd_third[]" id="fileadd_third" @if(Auth::user()->role_id == 3)readonly @endif></td>
                            <td></td>
                        </tr>
                        @endif
                          
                    </tbody>
                </table>
                <div class="review-header text-center">
                    <button type="submit" name="email_setting_submit" class="btn btn-primary submit-btn">Save &amp; update</button>
                </div>
            
            </div>
        </div>
    </div>
</section>   
<section class="review-section" >
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" >
                    <tbody >
                        <tr>
                             <th>System will recommend a Performance Improvement Plan (PIP), which will be measured, and if any issues with completing that PIP, then Termination will be in effect.</th>
                         </tr>  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>  
@endif
                                

