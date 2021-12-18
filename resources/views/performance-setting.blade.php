@extends('layout.mainlayout')
@section('content') 
		
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Performance Configuration	
                    <button class="btn btn-success m-t-5 btn-sm" type="submit">OKRs  Activated</button>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <p><b>Click the tabs below for more information on each Performance Management module.
                        Only one Performance module can be activated at a time.
                        </b>
                    </p>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item active"><a class="nav-link active" href="#okr_tab" data-toggle="tab">OKRs</a></li>
                        <li class="nav-item "><a class="nav-link" href="#compentency_tab" data-toggle="tab">Competency-based</a></li>
                        <li class="nav-item "><a class="nav-link" href="#smart_goals_tab" data-toggle="tab">SMART Goals</a></li>
                    </ul>
                    <div class="tab-content">

                        <!-- OKR Config -->
                        <div class="tab-pane active" id="okr_tab">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    
                                    <div class="form-group">
                                        <label>OKRs Description</label>
                                        <textarea rows="5" cols="5" class="form-control" name="description">Objectives and Key Results (OKR) is a framework for defining and tracking organizations objectives and their outcomes. OKRs comprise an Objective—a clearly defined goal—and one or more Key Results—specific measures used to track the achievement of that goal. The goal of OKR is to define how to achieve objectives through concrete, specific and measurable actions. Key Results can be measured on a sliding scale from 0.0 - 1.0 or 0-100%. Objectives should also be supported by initiatives, which are the plans and activities that help to achieve the objective and move forward the key results. Once objectives and key results have been established, regular and quarterly check-ins are required to make sure OKRs is progressing</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="rating-list m-t-20">
                                        <span class="rating-bad">
                                        <span class="rating-count">
                                        <a href="">0.0</a>
                                        <a href="">0.1</a>
                                        <a href="">0.2</a>
                                        <a href="">0.3</a>
                                        </span><br>
                                        <span class="rating-text">We failed to make real progress</span>
                                        </span>
                                        <span class="rating-normal">
                                        <span class="rating-count">
                                        <a href="">0.4</a>
                                        <a href="">0.5</a>
                                        <a href="">0.6</a>
                                        </span><br>
                                        <span class="rating-text">We made progress, but fell short of completion</span>
                                        </span>
                                        <span class="rating-good">
                                        <span class="rating-count">
                                        <a href="">0.7</a>
                                        <a href="">0.8</a>
                                        <a href="">0.9</a>
                                        <a href="">1.0</a>
                                        </span><br>
                                        <span class="rating-text">We delivered</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="submit-section my-3">
                                        <button class="btn btn-primary submit-btn performance_status red_circle" data-status="okr" title="Admin can’t activate it again">Activate OKR</button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <hr style="margin-top:0;">
                                    <div class="form-group m-b-0">
                                        <label>Choose Your Rating Scale</label>
                                        <div class="radio_input" id="rating_scale_select_okr">
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale" value="rating_01_010" required="" class="rating_scale">0.1 - 1.0 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" id="rating_scale_15" name="rating_scale" data-sid="5" value="5" required="" class="rating_scale"  checked>1 - 5 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale" value="10" class="rating_scale">1 - 10 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale" value="custom_rating" class="rating_scale">Custom <span class="checkmark"></span>
                                            </label> 
                                        </div>
                                    </div>

                                    <!--0.1 to  1.0 Ratings Content -->
                                    <div class="form-group" id="01ratings_cont_okr" style="display: block">
                                        <div class="table-responsive">
                                            <form>
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
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.1">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="dsdsd" placeholder="Short word to describe rating of 0.1" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">dfsdfa</textarea>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                        <tr>
                                                            <td class="rating_cid" style="width:50px;"> 0.2 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.2">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdfdsf" placeholder="Short word to describe rating of 0.2" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">sdfdsf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.3 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.3">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdfds" placeholder="Short word to describe rating of 0.3" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">fsdf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.4 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.4">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdfds" placeholder="Short word to describe rating of 0.4" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">fsdf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.5 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.5">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdfdsf" placeholder="Short word to describe rating of 0.5" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">sdf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.6 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.6">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdfds" placeholder="Short word to describe rating of 0.6" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">fsdsdf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.7 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.7">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="dsfd" placeholder="Short word to describe rating of 0.7" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">fsdf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.8 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.8">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdfsdf" placeholder="Short word to describe rating of 0.8" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">sdfds</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 0.9 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="0.9">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="sdf" placeholder="Short word to describe rating of 0.9" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">sdfsdsf</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50px;"> 1.0 </td>
                                                            <td style="width: 300px;">
                                                                <input type="hidden" name="rating_no[]" class="form-control" value="1.0">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" value="dg" placeholder="Short word to describe rating of 1.0" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required="">fg</textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="submit-section m-b-0">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- 0.1 to  1.0  Ratings Content -->

                                    <!-- 5 Ratings Content -->
                                    <div class="form-group" id="5ratings_cont_okr" style="display: none">
                                        <div class="table-responsive">
                                            <form>
                                                <table class="table setting-performance-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Rating</th>
                                                            <th>Short Descriptive Word</th>
                                                            <th>Definition</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 50px;"> 1 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" placeholder="Short word to describe rating of 1" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 2 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" placeholder="Short word to describe rating of 2" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 3 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" placeholder="Short word to describe rating of 3" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 4 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" placeholder="Short word to describe rating of 4" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 5 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" placeholder="Short word to describe rating of 5" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                <div class="submit-section m-b-0">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /5 Ratings Content -->

                                    <!-- 10 Ratings Content -->
                                    <div class="form-group" id="10ratings_cont_okr" style="display: none">
                                        <div class="table-responsive">
                                            <form>
                                                <table class="table setting-performance-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Rating</th>
                                                            <th>Short Descriptive Word</th>
                                                            <th>Definition</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr>
                                                            <td style="width: 50px;"> 1 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 1" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 2 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 2" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 3 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 3" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 4 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 4" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 5 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 5" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 6 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 6" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 7 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 7" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 8 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 8" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 9 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 9" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 10 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 10" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- 10 Ratings Content -->

                                    <!-- Custom Ratings Content -->
                                    <div class="form-group" id="custom_rating_cont_okr" style="display: none">
                                        <label>Custom Rating Count</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control custom_rating_input" data-type="okr" id="custom_rating_input3" name="custom_rating_count" value="" placeholder="20" style="width: 160px;">
                                        </div>
                                        <div class="table-responsive">
                                            <form>
                                                
                                                <table class="table setting-performance-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Rating</th>
                                                            <th>Short Descriptive Word</th>
                                                            <th>Definition</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="custom-value_okr">
                                                    </tbody>
                                                </table>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Custom Ratings Content -->

                                </div>
                                
                            </div>
                        </div>

                        <!-- Compentency Config -->
                        <div class="tab-pane" id="compentency_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Competency-based</label>
                                        <textarea rows="4" cols="5" class="form-control" name="competencies_desc">Competency-based performance management allow companies to evaluate employees' performance through define core competencies that align with the company’s mission, vision and goals. A 360-degree assessment can also be added to capture ratings and feedback </textarea>
                                    </div>
                                    <div class="submit-section my-3">			
                                        <button class="m-0 btn btn-sm btn-primary submit-btn performance_status " data-status="competency" title="" style="margin: 23px 0px;">Activate Competency-based</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table class="table table-bordered table-center">
                                            <thead style="background:#f2f2f2">
                                                <tr>
                                                    <th style="width: 250px;">Competency</th>
                                                    <th>Definition</th>
                                                    <th style="width: 70px;text-align:center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Adaptability					
                                                    </th>
                                                    <td>
                                                        <div class="task-textarea">
                                                            <textarea placeholder="Definition" id="competency_definition_6" onkeyup="competency_definition(6)" class="form-control definition_edit_6" readonly="">Ability to handle ambiguity and certain situations outside of their
                                                            control. Dealing with a change in process, systems, role, and direction of
                                                            the company. Adapting to new ways of doing things.</textarea>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" class="text-warning" title="" id="definition_edit_6" onclick="definition_edit(6)" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a href="https://newhrms.com/newhrms_stagging/settings/delete_performance_competency/6" class="text-danger" title="" data-toggle="ajaxModal" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Collaboration &amp; Teamwork					
                                                    </th>
                                                    <td>
                                                        <div class="task-textarea">
                                                            <textarea placeholder="Definition" id="competency_definition_7" onkeyup="competency_definition(7)" class="form-control definition_edit_7" readonly="">Works harmoniously with others to get a job done; shares critical information
                                                            with everyone involved in a project. Works cooperatively with others to achieve
                                                            common goals. Seeks opinions and values the contributions of others; involves
                                                            team in discussion and decision-making.</textarea>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" class="text-warning" title="" id="definition_edit_7" onclick="definition_edit(7)" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a href="https://newhrms.com/newhrms_stagging/settings/delete_performance_competency/7" class="text-danger" title="" data-toggle="ajaxModal" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Communication					
                                                    </th>
                                                    <td>
                                                        <div class="task-textarea">
                                                            <textarea placeholder="Definition" id="competency_definition_8" onkeyup="competency_definition(8)" class="form-control definition_edit_8" readonly="">Communicates in an engaging, effective, and respectful way to a wide
                                                            variety of groups. Delivers convincing and meaningful messages that
                                                            leave a positive impact. Effective oral and written communication skills.
                                                            The ability to persuade and convince others including management.</textarea>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" class="text-warning" title="" id="definition_edit_8" onclick="definition_edit(8)" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a href="https://newhrms.com/newhrms_stagging/settings/delete_performance_competency/8" class="text-danger" title="" data-toggle="ajaxModal" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Customer Service					
                                                    </th>
                                                    <td>
                                                        <div class="task-textarea">
                                                            <textarea placeholder="Definition" id="competency_definition_9" onkeyup="competency_definition(9)" class="form-control definition_edit_9" readonly="">Listens and responds effectively to customer questions; resolves
                                                            customer problems to the customer’s satisfaction; respects all internal
                                                            and external customers; follows up to evaluate customer satisfaction;
                                                            exceeds customer expectations.</textarea>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" class="text-warning" title="" id="definition_edit_9" onclick="definition_edit(9)" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a href="https://newhrms.com/newhrms_stagging/settings/delete_performance_competency/9" class="text-danger" title="" data-toggle="ajaxModal" data-original-title="Delete"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <form>
                                            <table class="table performance-table">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding-left: 0;">
                                                            <input type="text" class="form-control" name="competency[]" required="" placeholder="Competency">
                                                        </td>
                                                        <td>
                                                            <textarea style="height: 44px;" rows="4" cols="20" class="form-control" name="definition[]" placeholder="Definition" required=""></textarea>
                                                        </td>
                                                        <td style="padding-right: 0;min-width:55px;max-width:55px;width:55px;">
                                                            <button type="button" class="btn btn-white add_competency_performance" data-toggle="tooltip" data-original-title="Add Competency" style="height:44px;font-size: 16px;padding:10px 15px;"><i class="fa fa-plus-circle"></i></button>
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
                                <div class="col-md-12 col-lg-12">
                                    <hr style="margin-top:0;">
                                    <div class="form-group m-b-0">
                                        <label>Choose Your Rating Scale</label>
                                        <div class="radio_input" id="rating_scale_select_competency">
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale_competency" value="rating_1_5" required="" class="rating_scale" checked="">1 - 5 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale_competency" value="rating_1_10" class="rating_scale">1 - 10 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale_competency" value="custom_rating" class="rating_scale">Custom <span class="checkmark"></span>
                                            </label> 
                                        </div>
                                    </div>

                                    <!-- 5 Ratings Content -->
                                    <div class="form-group" id="5ratings_cont_competency" style="display: block">
                                        <div class="table-responsive">
                                            <form>
                                                <table class="table setting-performance-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Rating</th>
                                                            <th>Short Descriptive Word</th>
                                                            <th>Definition</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 50px;"> 1 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" value="tst" placeholder="Short word to describe rating of 1" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Lorem ipsum</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 2 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" value="dsgds" placeholder="Short word to describe rating of 2" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Lorem ipsum</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 3 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" value="sdg" placeholder="Short word to describe rating of 3" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Lorem ipsum</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 4 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" value="sdgsdg" placeholder="Short word to describe rating of 4" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Lorem ipsum</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 5 </td>
                                                            <td style="width: 300px;">
                                                                <input type="text" name="rating_value[]" class="form-control" value="sdg" placeholder="Short word to describe rating of 5" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Lorem ipsum</textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="submit-section m-b-0">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /5 Ratings Content -->

                                    <!-- 10 Ratings Content -->
                                    <div class="form-group" id="10ratings_cont_competency" style="display: none">
                                        <div class="table-responsive">
                                            <form>
                                                <table class="table setting-performance-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Rating</th>
                                                            <th>Short Descriptive Word</th>
                                                            <th>Definition</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <tr>
                                                            <td style="width: 50px;"> 1 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 1" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 2 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 2" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 3 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 3" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 4 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 4" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 5 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 5" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 6 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 6" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 7 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 7" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 8 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 8" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 9 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 9" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50px;"> 10 </td>
                                                            <td style="width: 300px;">
                                                                
                                                                <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 10" required="">
                                                            </td>
                                                            <td>
                                                                <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- 10 Ratings Content -->

                                    <!-- Custom Ratings Content -->
                                    <div class="form-group" id="custom_rating_cont_competency" style="display: none">
                                        <label>Custom Rating Count</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control custom_rating_input" data-type="competency" id="custom_rating_input1" name="custom_rating_count" value="" placeholder="20" style="width: 160px;">
                                        </div>
                                        <div class="table-responsive">
                                            <form>
                                                
                                                <table class="table setting-performance-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Rating</th>
                                                            <th>Short Descriptive Word</th>
                                                            <th>Definition</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="custom-value_competency">
                                                    </tbody>
                                                </table>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Custom Ratings Content -->

                                </div>
                            </div>
                        </div>
                        <!-- /Compentency Config -->

                        <!-- Smart Goal Config -->
                        <div class="tab-pane" id="smart_goals_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Smart Goals Configuration</label>
                                        <textarea rows="4" cols="5" class="form-control" name="smart_goals">A 360-degree assessment can also be added to capture ratings and feedback</textarea>
                                    </div>
                                    <div class="submit-section my-3">														
                                        <button class="btn btn-primary submit-btn performance_status " data-status="smart_goals" title="">Activate SMART Goals</button>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top:0;">
                            <div class="form-group m-b-0">
                                <label>Choose Your Rating Scale</label>
                                <div class="radio_input" id="rating_scale_select">
                                    <label class="radio-inline custom_radio">
                                    <input type="radio" name="rating_scale_smart_goal" value="rating_1_5" required="" class="rating_scale" checked="">1 - 5 <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-inline custom_radio">
                                    <input type="radio" name="rating_scale_smart_goal" value="rating_1_10" class="rating_scale">1 - 10 <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-inline custom_radio">
                                    <input type="radio" name="rating_scale_smart_goal" value="custom_rating" class="rating_scale">Custom <span class="checkmark"></span>
                                    </label> 
                                </div>
                            </div>

                            <!-- 5 Ratings Content -->
                            <div class="form-group" id="5ratings_cont" style="display: block">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table setting-performance-table">
                                            <thead>
                                                <tr>
                                                    <th>Rating</th>
                                                    <th>Short Descriptive Word</th>
                                                    <th>Definition</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50px;"> 1 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value[]" class="form-control" value="very bad" placeholder="Short word to describe rating of 1" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">very bad</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 2 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value[]" class="form-control" value="bad" placeholder="Short word to describe rating of 2" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">bad</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 3 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value[]" class="form-control" value="Average" placeholder="Short word to describe rating of 3" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Average</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 4 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value[]" class="form-control" value="Good" placeholder="Short word to describe rating of 4" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Good</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 5 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value[]" class="form-control" value="Very Good" placeholder="Short word to describe rating of 5" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition[]" class="form-control" placeholder="Descriptive Rating Definition" required="">Very Good</textarea>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <div class="submit-section m-b-0">
                                            <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /5 Ratings Content -->

                            <!-- 10 Ratings Content -->
                            <div class="form-group" id="10ratings_cont" style="display: none">
                                <div class="table-responsive">
                                    <form>
                                        <table class="table setting-performance-table">
                                            <thead>
                                                <tr>
                                                    <th>Rating</th>
                                                    <th>Short Descriptive Word</th>
                                                    <th>Definition</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    <td style="width: 50px;"> 1 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 1" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 2 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 2" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 3 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 3" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 4 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 4" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 5 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 5" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 6 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 6" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 7 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 7" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 8 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 8" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 9 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 9" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50px;"> 10 </td>
                                                    <td style="width: 300px;">
                                                        
                                                        <input type="text" name="rating_value_ten[]" class="form-control" placeholder="Short word to describe rating of 10" required="">
                                                    </td>
                                                    <td>
                                                        <textarea rows="3" name="definition_ten[]" class="form-control" placeholder="Descriptive Rating Definition" required=""></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="submit-section m-b-0">
                                            <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- 10 Ratings Content -->

                            <!-- Custom Ratings Content -->
                            <div class="form-group" id="custom_rating_cont" style="display: none">
                                <label>Custom Rating Count</label>
                                <div class="form-group">
                                    <input type="text" class="form-control custom_rating_input" data-type="smart_goal" id="custom_rating_input2" name="custom_rating_count" value="" placeholder="20" style="width: 160px;">
                                </div>
                                <div class="table-responsive">
                                    <form>
                                        
                                        <table class="table setting-performance-table">
                                            <thead>
                                                <tr>
                                                    <th>Rating</th>
                                                    <th>Short Descriptive Word</th>
                                                    <th>Definition</th>
                                                </tr>
                                            </thead>
                                            <tbody class="custom-value_smart_goal">
                                            </tbody>
                                        </table>
                                        <div class="submit-section m-b-0">
                                            <button class="btn btn-primary submit-btn create_goal_configuration_submit" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /Custom Ratings Content -->

                        </div>
                        <!-- /Smart Goal Config -->

                    </div>
                </div>
            </div>
        </div>
    </div>   
<!-- /Page Content -->
</div>
@endsection
<script src="js/jquery-3.5.1.min.js"></script>
<script>
		$( document ).ready(function() {
			$(document).on("click","#rating_scale_15",function() {				
                var rating_no =$(this).data('sid');
                
                  
			});
		});
	</script> 
   