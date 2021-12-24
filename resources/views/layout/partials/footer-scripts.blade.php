<!-- jQuery -->
<script src="/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="/js/jquery.slimscroll.min.js"></script>
		@if(Route::is(['jobs-dashboard','user-dashboard']))
		<!-- Chart JS -->
		<script src="/js/Chart.min.js"></script>
		<script src="/js/line-chart.js"></script>
		@endif
		<!-- Select2 JS -->
		<script src="/js/select2.min.js"></script>

		<script src="/js/jquery-ui.min.js"></script>
		<script src="/js/jquery.ui.touch-punch.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="/js/moment.min.js"></script>
		<script src="/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Calendar JS -->
		<script src="/js/jquery-ui.min.js"></script>
        <script src="/js/fullcalendar.min.js"></script>
        <script src="/js/jquery.fullcalendar.js"></script>

		<!-- Multiselect JS -->
		<script src="/js/multiselect.min.js"></script>

		<!-- Datatable JS -->
		<script src="/js/jquery.dataTables.min.js"></script>
		<script src="/js/dataTables.bootstrap4.min.js"></script>

		<!-- Summernote JS -->
		<script src="/plugins/summernote/dist/summernote-bs4.min.js"></script>
		
			
		<script src="/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

		<!-- Task JS -->
		<script src="/js/task.js"></script>

		<!-- Dropfiles JS
		<script src="js/dropfiles.js"></script> -->

		<!-- Custom JS -->
		<script src="/js/app.js"></script>
		<script>
		 $(document).ready(function(){

		



        // Read value on page load
        $("#result b").html($("#customRange").val());

        // Read value on change
        $("#customRange").change(function(){
            $("#result b").html($(this).val());
        });
    });        
		$(".header").stick_in_parent({
			
		});
		// This is for the sticky sidebar    
		$(".stickyside").stick_in_parent({
			offset_top: 60
		});
		$('.stickyside a').click(function() {
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60
			}, 500);
			return false;
		});
		// This is auto select left sidebar
		// Cache selectors
		// Cache selectors
		var lastId,
			topMenu = $(".stickyside"),
			topMenuHeight = topMenu.outerHeight(),
			// All list items
			menuItems = topMenu.find("a"),
			// Anchors corresponding to menu items
			scrollItems = menuItems.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		// Bind click handler to menu items


		// Bind to scroll
		$(window).scroll(function() {
			// Get container scroll position
			var fromTop = $(this).scrollTop() + topMenuHeight - 250;

			// Get id of current scroll item
			var cur = scrollItems.map(function() {
				if ($(this).offset().top < fromTop)
					return this;
			});
			// Get the id of the current element
			cur = cur[cur.length - 1];
			var id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				lastId = id;
				// Set/remove active class
				menuItems
					.removeClass("active")
					.filter("[href='#" + id + "']").addClass("active");
			}
		});
		$(function () {
			$(document).on("click", '.btn-add-row', function () {
				var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
				console.log(id);
				var div = $("<tr />");
				div.html(GetDynamicTextBox(id));
				$("#"+id+"_tbody").append(div);
			});
			$(document).on("click", "#comments_remove", function () {
				$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
				$(this).closest("tr").remove();
			});
			function GetDynamicTextBox(table_id) {
				$('#comments_remove').remove();
				var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBoxemp[]" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBoxman[]" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		</script>
		<script>
		 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
		$(document).ready(function(){
			$(".departmentError").hide();
			var deptname=''
			$(document).on("click",".delDepBtn",function() {
				
				$(".deleteDepCont").attr('data-id', $(this).data('id'));
			});
		  $(document).on("click",".editBtn",function() {
			  
				deptname = $(this).closest('.trTag').find('.tdTag').html();
				$("#editDeptText").val(deptname)
				$("#editDeptId").val($(this).data('id'))
			});
			 
			$(document).on("click",".deleteDepCont",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_department') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_department').modal('toggle');
							$(".departmentError").show();
						}
						else if(data.error=='3')
						{
							$('#delete_department').modal('toggle');
							$(".employeeError").show();
						}
						else{ 
							location.reload();
						}
					}
				});
			});
			$(document).on("click",".edtEmpBtn",function() {
				var id= $(this).data('id');
				$(".permissionCheck").prop('checked',false)
				$.ajax({
					type:'POST',
					url:"{{ route('edit_employee') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						$("#emp_first_name").val(data.emp[0].first_name)
						$("#emp_last_name").val(data.emp[0].last_name)
						$("#emp_user_name").val(data.emp[0].user_name)
						$("#emp_email").val(data.emp[0].email)
					
						$("#emp_employee_id").val(data.emp[0].employee_id)
						$("#emp_phone_no").val(data.emp[0].phone_no)
						

						var d = new Date(data.emp[0].joing_date);
						var dd = d.getDate(); 
						var mm = d.getMonth()+1; 
						var yyyy = d.getFullYear(); 
						$("#emp_joing_date").val(dd+'/'+mm+'/'+yyyy)
						$("#emp_id").val(data.emp[0].id)
						$("#edit_depList option[value='"+data.emp[0].department_id+"']").prop('selected',true);
						change_designation(data.emp[0].department_id)
						$("#edit_designationList option[value='"+data.emp[0].designation_id	+"']").prop('selected',true);
						$.each(data.permission_modules, function(key, val) 
						{ 
							$(".permissionCheck[value='"+val['module_id']+"_"+val['emp_permission_id']	+"']").prop('checked',true);

						});
						
					}
				});
			});
			function change_designation(id){
				var deptId = id;
				if(deptId) {
					$.ajax({
						url:"{{ route('getDesignationAjax') }}",
						type: "GET",
						data:{"deptId":deptId},
						success:function(data) {	
							$('#edit_designationList').empty();
							$.each(data, function(key,value) {
								console.log(value['name'])
								$('#edit_designationList').append('<option value="'+ value.id +'">'+ value.name +'</option>');
							});
						}
					});
				}else{
					$('#designationList').empty();
				}
			}
			$(document).on("click",".delEmpBtn",function() {
				
				$(".deleteEmpCont").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".deleteEmpCont",function() {
				
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_employee') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						location.reload();
					}
				});
			});
			$(document).on("click",".editDesigBtn",function() {
				var editDesignationText = $(this).closest('.trDesignation').find('.tdDesignation').html();
				$("#editDesignationText").val(editDesignationText)
				var deptid=$(this).data('dept-id');
			
				$("#editDesignationId").val($(this).data('id'))
				
				$(".deptId option[value='"+deptid+"']").prop('selected',true);
			});

			$(document).on("click",".deleteDesigBtn",function() {
				$(".designContDel").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".designContDel",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_designation') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_designation').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				});
			});
			$('#depList').on('change', function() {
            	var deptId = $(this).val();
				if(deptId) {
					$.ajax({
						url:"{{ route('getDesignationAjax') }}",
						type: "GET",
						data:{"deptId":deptId},
						success:function(data) {	
							$('#designationList').empty();
							$.each(data, function(key,value) {
								console.log(value['name'])
								$('#designationList').append('<option value="'+ value.id +'">'+ value.name +'</option>');
							});
						}
					});
				}else{
					$('#designationList').empty();
				}
			});
			$('#edit_depList').on('change', function() {
            	var deptId = $(this).val();
				if(deptId) {
					$.ajax({
						url:"{{ route('getDesignationAjax') }}",
						type: "GET",
						data:{"deptId":deptId},
						success:function(data) {	
							$('#edit_designationList').empty();
							$.each(data, function(key,value) {
								console.log(value['name'])
								$('#edit_designationList').append('<option value="'+ value.id +'">'+ value.name +'</option>');
							});
						}
					});
				}else{
					$('#edit_designationList').empty();
				}
			});
			
			$(document).on("click",".editIndicateBtn",function() {				 
				var indiid=$(this).data('indi-id');							
				$("#editIndicatorId").val($(this).data('id'))				
				$("#edit_designationlist option[value='"+indiid+"']").prop('selected',true);
				var employee_id=$(this).data('employee_id');	
				$("#employee option[value='"+employee_id+"']").prop('selected',true);
				var cust_exp =$(this).data('cust');	
				$("#customer_experience option[value='"+cust_exp+"']").prop('selected',true);
				var integrity =$(this).data('integrity');	
				$("#integrity option[value='"+integrity+"']").prop('selected',true);
				var marketing =$(this).data('marketing');	
				$("#marketing option[value='"+marketing+"']").prop('selected',true);
				var professionalism =$(this).data('professionalism');	
				$("#professionalism option[value='"+professionalism+"']").prop('selected',true);
				var management =$(this).data('management');	
				$("#management option[value='"+management+"']").prop('selected',true);
				var teamwork =$(this).data('teamwork');	
				$("#teamwork option[value='"+teamwork+"']").prop('selected',true);
				var administration =$(this).data('administration');	
				$("#administration option[value='"+administration+"']").prop('selected',true);
				var critical_thinking =$(this).data('critical_thinking');	
				$("#critical_thinking option[value='"+critical_thinking+"']").prop('selected',true);
				var presentation_skills =$(this).data('presentation_skills');	
				$("#presentation_skills option[value='"+presentation_skills+"']").prop('selected',true);
				var conflict_management =$(this).data('conflict_management');	
				$("#conflict_management option[value='"+conflict_management+"']").prop('selected',true);
				var quality_of_work =$(this).data('quality_of_work');	
				$("#quality_of_work option[value='"+quality_of_work+"']").prop('selected',true);
				var attendance =$(this).data('attendance');	
				$("#attendance option[value='"+attendance+"']").prop('selected',true);
				var efficiency =$(this).data('efficiency');	
				$("#efficiency option[value='"+efficiency+"']").prop('selected',true);
				var ability_to_meet_deadline =$(this).data('ability_to_meet_deadline');	
				$("#ability_to_meet_deadline option[value='"+ability_to_meet_deadline+"']").prop('selected',true);
				var status =$(this).data('status');	
				$("#status option[value='"+status+"']").prop('selected',true);									 
			});
			$(document).on("click",".deleteIndicateBtn",function() {
				$(".indicatorContDel").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".indicatorContDel",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_indicator') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_indicator').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				});
			});  
			$(document).on("click",".editAppraisalBtn",function() {				 
				var empid=$(this).data('emp-id');							
				$("#editAppraisalId").val($(this).data('id'))				
				$("#edit_employeeslist option[value='"+empid+"']").prop('selected',true);				
				var d = new Date($(this).data('appraisal_date'));
				var dd = d.getDate(); 
				var mm = d.getMonth()+1; 
				var yyyy = d.getFullYear(); 
				$("#appraisal_date").val(dd+'/'+mm+'/'+yyyy);				
				var cust_exp =$(this).data('cust');	
				$("#customer_experience option[value='"+cust_exp+"']").prop('selected',true);
				var integrity =$(this).data('integrity');	
				$("#integrity option[value='"+integrity+"']").prop('selected',true);
				var marketing =$(this).data('marketing');	
				$("#marketing option[value='"+marketing+"']").prop('selected',true);
				var professionalism =$(this).data('professionalism');	
				$("#professionalism option[value='"+professionalism+"']").prop('selected',true);
				var management =$(this).data('management');	
				$("#management option[value='"+management+"']").prop('selected',true);
				var teamwork =$(this).data('teamwork');	
				$("#teamwork option[value='"+teamwork+"']").prop('selected',true);
				var administration =$(this).data('administration');	
				$("#administration option[value='"+administration+"']").prop('selected',true);
				var critical_thinking =$(this).data('critical_thinking');	
				$("#critical_thinking option[value='"+critical_thinking+"']").prop('selected',true);
				var presentation_skills =$(this).data('presentation_skills');	
				$("#presentation_skills option[value='"+presentation_skills+"']").prop('selected',true);
				var conflict_management =$(this).data('conflict_management');	
				$("#conflict_management option[value='"+conflict_management+"']").prop('selected',true);
				var quality_of_work =$(this).data('quality_of_work');	
				$("#quality_of_work option[value='"+quality_of_work+"']").prop('selected',true);
				var attendance =$(this).data('attendance');	
				$("#attendance option[value='"+attendance+"']").prop('selected',true);
				var efficiency =$(this).data('efficiency');	
				$("#efficiency option[value='"+efficiency+"']").prop('selected',true);
				var ability_to_meet_deadline =$(this).data('ability_to_meet_deadline');	
				$("#ability_to_meet_deadline option[value='"+ability_to_meet_deadline+"']").prop('selected',true);
				var status =$(this).data('status');	
				$("#status option[value='"+status+"']").prop('selected',true);									 
			});
			$(document).on("click",".deleteAppraisalBtn",function() {
				$(".appraisalContDel").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".appraisalContDel",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_appraisal') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_appraisal').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				});
			}); 
			$('.percentage_employee').on('change', function() {            	 
				 var ret = Number($("#quality_id").val()) + Number($("#tat_id").val()) + Number($("#pms_new_ideas").val()) + Number($("#team_productivity").val()) + Number($("#knowledge_sharing").val()) + Number($("#emails_calls").val());
				$("#total_percentage_employee").val(ret);	
			});
			$('.percentage_manager').on('change', function() {            	 
				 var ret = Number($("#quality_manager").val()) + Number($("#tat_manager").val()) + Number($("#pms_new_ideas_manager").val()) + Number($("#team_productivity_manager").val()) + Number($("#knowledge_sharing_manager").val()) + Number($("#emails_calls_manager").val());
				$("#total_percentage_manager").val(ret);	
			});
			$('.personal_employee').on('change', function() {            	 
				 var ret = Number($("#plan_leave_employee").val()) + Number($("#time_cons_employee").val()) + Number($("#team_collaboration_employee").val()) + Number($("#professionalism_employee").val()) + Number($("#policy_employee").val()) + Number($("#initiatives_employee").val()) + Number($("#improvement_employee").val());
				$("#total_score_employee").val(ret);
				var percent = Math.round((ret/ 15)*100);
				$("#total_percentage_empl").val(percent);
			});
			$('.personal_manager').on('change', function() {            	 
				 var ret = Number($("#plan_leave_manager").val()) + Number($("#time_cons_manager").val()) + Number($("#team_collaboration_manager").val()) + Number($("#professionalism_manager").val()) + Number($("#policy_manager").val()) + Number($("#initiatives_manager").val()) + Number($("#improvement_manager").val());
				$("#total_score_manager").val(ret);	
				var percent_man = Math.round((ret/ 15)*100);
				$("#total_percentage_man").val(percent_man);
			});

			$('.percentage_employee_man').on('change', function() {
				           	 
				 var ret = Number($("#quality_id").val()) + Number($("#tat_id").val()) + Number($("#pms_new_ideas").val()) + Number($("#team_productivity").val()) + Number($("#knowledge_sharing").val()) + Number($("#emails_calls").val());
				$("#total_percentage_employee").val(ret);	
			});

			 
		});
	</script>