@include('layout.setting_module_header')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Performance Configuration
                     <div style="display:block" id="okr_badge">
                        @if(@$settings->okr_active==1)
                        <button class="btn btn-success m-t-5 btn-sm" type="submit">OKRs  Activated</button>
                        @else	
                            <button class="btn btn-danger m-t-5 btn-sm" type="submit">OKRs  Dectivated</button>
                        @endif 
                     </div>
                     <div style="display:none" id="compentency_badge">
                        @if(@$settings->compentency_active==1)
                        <button class="btn btn-success m-t-5 btn-sm" type="submit">Compentency  Activated</button>
                        @else	
                            <button class="btn btn-danger m-t-5 btn-sm" type="submit">Compentency  Dectivated</button>
                        @endif 
                     </div>
                     <div style="display:none" id="smart_badge">
                        @if(@$settings->smart_goals_active==1)
                        <button class="btn btn-success m-t-5 btn-sm" type="submit">SMART GOALS  Activated</button>
                        @else	
                            <button class="btn btn-danger m-t-5 btn-sm" type="submit">SMART GOALS  Dectivated</button>
                        @endif 
                     </div>
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
                        <li class="nav-item active"><a class="nav-link active" id="okrtab" href="#okr_tab" data-toggle="tab">OKRs</a></li>
                        <li class="nav-item "><a class="nav-link" id="compentencytab" href="#compentency_tab" data-toggle="tab">Competency-based</a></li>
                        <li class="nav-item "><a class="nav-link" id="smartgoalstab" href="#smart_goals_tab" data-toggle="tab">SMART Goals</a></li>
                    </ul>
                    <div class="tab-content">

                        <!-- OKR Config -->
                        <div class="tab-pane active" id="okr_tab">
                            <div class="row">
                                @include('performance.okr')
                                @include('performance.scale1_bar')
                                @include('performance.scale2_bar')
                                @include('performance.scale3_bar')

                                
                                <div class="col-md-12 col-lg-12">
                                    <hr style="margin-top:0;">
                                    <div class="form-group m-b-0">
                                        <label>Choose Your Rating Scale</label>
                                        <div class="radio_input" id="rating_scale_select_okr">
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale" id="scale_1" value="1" data-least="0.1" data-most="1.0" required="" class="rating_scale">0.1 - 1.0 <span class="checkmark"></span>
                                            </label>
                                             <label class="radio-inline custom_radio">
                                            <input type="radio" id="scale_2" name="rating_scale" data-sid="5" value="2" required="" class="rating_scale"  checked>1 - 5 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale" id="scale_3" value="3" class="rating_scale">1 - 10 <span class="checkmark"></span>
                                            </label>
                                            {{-- <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale" value="custom_rating" class="rating_scale">Custom <span class="checkmark"></span>
                                            </label>  --}}
                                        </div>
                                    </div>
                                    @include('performance.okr_scale1_rating')
                                    @include('performance.okr_scale2_rating')
                                    @include('performance.okr_scale3_rating')
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
                                @include('performance.competency')
                                @include('performance.compentency_info')
                              
                                <div class="col-md-12 col-lg-12">
                                    <hr style="margin-top:0;">
                                    <div class="form-group m-b-0">
                                        <label>Choose Your Rating Scale</label>
                                        <div class="radio_input" id="rating_scale_select_competency">
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale_competency" id="c_scale_2" value="rating_1_5" required="" class="rating_scale" checked="">1 - 5 <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-inline custom_radio">
                                            <input type="radio" name="rating_scale_competency" id="c_scale_3" value="rating_1_10" class="rating_scale">1 - 10 <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                   
                                    @include('performance.competency_scale2_rating')
                                    @include('performance.competency_scale3_rating')
                                   

                                 
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
                                @include('performance.smart_config')
                            </div>
                            <hr style="margin-top:0;">
                            <div class="form-group m-b-0">
                                <label>Choose Your Rating Scale</label>
                                <div class="radio_input" id="rating_scale_select">
                                    <label class="radio-inline custom_radio">
                                    <input type="radio" name="rating_scale_smart_goal"  id="s_scale_2" value="rating_1_5" required="" class="rating_scale" checked="">1 - 5 <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-inline custom_radio">
                                    <input type="radio" name="rating_scale_smart_goal" id="s_scale_3" value="rating_1_10" class="rating_scale">1 - 10 <span class="checkmark"></span>
                                    </label>
                                    {{-- <label class="radio-inline custom_radio">
                                    <input type="radio" name="rating_scale_smart_goal" value="custom_rating" class="rating_scale">Custom <span class="checkmark"></span>
                                    </label>  --}}
                                </div>
                            </div>
                            @include('performance.smart_scale2_rating')
                            @include('performance.smart_scale3_rating')
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
 
<script>
		$( document ).ready(function() {
            $("#scale_2").click();
            $("#c_scale_2").click();
            $("#s_scale_2").click(); 
            $("#okrtab").click(); 

			$(document).on("click","#rating_scale_15",function() {				
                var rating_no =$(this).data('sid');
			});
            $(document).on("click","#okrtab",function() {	
                $("#okr_badge").show();
                $("#compentency_badge").hide();
                $("#smart_goals_badge").hide();
            });
            $(document).on("click","#compentencytab",function() {	
                $("#okr_badge").hide();
                $("#compentency_badge").show();
                $("#smart_goals_badge").hide();
            });
            $(document).on("click","#smartgoals",function() {	
                $("#okr_badge").hide();
                $("#compentency_badge").hide();
                $("#smart_goals_badge").show();
            });
		});
	</script> 
<!-- /Page Wrapper -->
 </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="js/jquery-3.5.1.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="js/select2.min.js"></script>

		<!-- Custom JS -->
		<script src="js/app.js"></script>
		
    </body>
</html>
   