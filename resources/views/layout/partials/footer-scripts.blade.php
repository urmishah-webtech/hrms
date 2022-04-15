<!-- jQuery -->

<script src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{ URL::asset('js/popper.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

		<!-- Slimscroll JS -->
		<script src="{{ URL::asset('js/jquery.slimscroll.min.js') }}"></script>

		<!-- Chart JS -->
		<script src="{{ URL::asset('js/Chart.min.js') }}"></script>
		<script src="{{ URL::asset('js/chart.js') }}"></script>

		<script src="{{ URL::asset('js/line-chart.js') }}"></script>

		<script src="{{URL::asset('plugins/morris/morris.min.js')}}"></script>
		<script src="{{URL::asset('plugins/raphael/raphael.min.js')}}"></script>
		<script src="{{URL::asset('js/chart.js')}}"></script>
		<!-- Select2 JS -->
		<script src="{{ URL::asset('js/select2.min.js') }}"></script>

		<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
		<script src="{{ URL::asset('js/jquery.ui.touch-punch.min.js') }}"></script>

		<!-- Datetimepicker JS -->
		<script src="{{ URL::asset('js/moment.min.js') }}"></script>
		<script src="{{ URL::asset('js/bootstrap-datetimepicker.min.js') }}"></script>

		<!-- Calendar JS -->
		<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ URL::asset('js/fullcalendar.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.fullcalendar.js') }}"></script>

		<!-- Multiselect JS -->
		<script src="{{ URL::asset('js/multiselect.min.js') }}"></script>

		<!-- Datatable JS -->
		<script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ URL::asset('js/dataTables.bootstrap4.min.js') }}"></script>

		<!-- Summernote JS -->
		<script src="{{ URL::asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>


		<script src="{{ URL::asset('plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

		<!-- Task JS -->
		<script src="{{ URL::asset('js/task.js') }}"></script>

		<!-- Dropfiles JS
		<script src="js/dropfiles.js"></script> -->

		<!-- Custom JS -->
		<script src="{{ URL::asset('js/app.js') }}"></script>
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
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBoxemp[]" class="form-control" value = "" @if (Auth::user()->role_id != 3)readonly @endif></td>' + '<td><input type="text" name = "DynamicTextBoxman[]" class="form-control" value = "" @if (Auth::user()->role_id == 3)readonly @endif></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		/// Employee First Warning
		$(function () {
			$(document).on("click", '.btn-add-row-warning', function () {
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
				return '<td>'+rowsLength+'</td>' + '@if(Auth::user()->role_id != 3)<td><select class="form-control" name="emp_id[]" ><option>Select Employee</option>@isset($emp_name) @foreach($emp_name as $val)<option value="{{ $val->id }}">{{ $val->first_name }}</option>@endforeach @endisset</select></td>@endif' + '<td><input type="text" name = "employee_comments[]" class="form-control" @if(Auth::user()->role_id != 3) readonly @endif></td>'+ '<td><input type="text" name = "managers_comments[]" class="form-control" @if(Auth::user()->role_id != 2)readonly @endif></td>' + '<td><input type="text" name = "admin_comments[]" class="form-control" @if(Auth::user()->role_id != 1)readonly @endif></td>' + '<td><input type="text" name = "areas_for_improvement[]" class="form-control" @if(Auth::user()->role_id == 3)readonly @endif></td>' + '<td><input type="file" name = "fileadd[]" class="form-control" @if(Auth::user()->role_id == 3)readonly @endif></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		/// Second Warning
		$(function () {
			$(document).on("click", '.btn-second-warning2', function () {
				var id = $(this).closest("table.table-review2").attr('id');
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
				return '<td>'+rowsLength+'</td>' + '@if(Auth::user()->role_id != 3)<td><select class="form-control" name="emp_id[]" ><option>Select Employee</option>@isset($emp_name) @foreach($emp_name as $val)<option value="{{ $val->id }}">{{ $val->first_name }}</option>@endforeach @endisset</select></td>@endif' +'<td><input type="text" name = "employee_comments[]" class="form-control" @if(Auth::user()->role_id != 3) readonly @endif></td>'+ '<td><input type="text" name = "managers_comments[]" class="form-control" @if(Auth::user()->role_id != 2)readonly @endif></td>' + '<td><input type="text" name = "admin_comments[]" class="form-control" @if(Auth::user()->role_id != 1)readonly @endif></td>' + '<td><input type="text" name = "areas_for_improvement[]" class="form-control" @if(Auth::user()->role_id == 3)readonly @endif></td>' + '<td><input type="file" name = "fileadd[]" class="form-control" @if(Auth::user()->role_id == 3)readonly @endif></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		/// Third Warning
		$(function () {
			$(document).on("click", '.btn-third-warning3', function () {
				var id = $(this).closest("table.table-review3").attr('id');
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
				return '<td>'+rowsLength+'</td>'+ '@if(Auth::user()->role_id != 3)<td><select class="form-control" name="emp_id[]" ><option>Select Employee</option>@isset($emp_name) @foreach($emp_name as $val)<option value="{{ $val->id }}">{{ $val->first_name }}</option>@endforeach @endisset</select></td>@endif' + '<td><input type="text" name = "employee_comments[]" class="form-control" @if(Auth::user()->role_id != 3) readonly @endif></td>'+ '<td><input type="text" name = "managers_comments[]" class="form-control" @if(Auth::user()->role_id != 2)readonly @endif></td>' + '<td><input type="text" name = "admin_comments[]" class="form-control" @if(Auth::user()->role_id != 1)readonly @endif></td>' + '<td><input type="file" name = "fileadd[]" class="form-control" @if(Auth::user()->role_id == 3)readonly @endif></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
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
			$('.locationError').hide();
			var deptname=''
			$(document).on("click",".delDepBtn",function() {

				$(".deleteDepCont").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".delLocBtn",function() {
				$(".deleteLocCont").attr('data-id', $(this).data('id'));
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
			$(document).on("click",".deleteLocCont",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_location') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='3'){
							$('#delete_location').modal('toggle');
							$(".locationError").show();
						}
						else{
							location.reload();
						}
					}
				});
			});
			$(document).on("click",".add-btn",function() {
				var last_emp_id=$("#last_emp_id").val();
				var emp_id="emp_"+last_emp_id+Math.floor(Math.random() * 10000);
				$("#disabled_emp_id").val(emp_id)
				$("#employee_id").val(emp_id)
				$('#add_employee').modal('toggle');

			});
			$(document).on("click",".edtEmpBtn",function() {
				var last_emp_id=$("#last_emp_id").val();
				var emp_id="emp_"+last_emp_id+Math.floor(Math.random() * 10000);
				var id= $(this).data('id');
				var roleid=$(this).data('role_id');

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



						if(data.emp[0].employee_id!=null){
							$("#emp_employee_id").val(data.emp[0].employee_id)
							$("#edit_employee_id").val(data.emp[0].employee_id)

						}
						else{
							$("#emp_employee_id").val(emp_id)
							$("#edit_employee_id").val(emp_id)

						}
						$("#edit_role_id").val(data.emp[0].role_id)

						$("#emp_phone_no").val(data.emp[0].phone_no)

						var d = new Date(data.emp[0].joing_date);
						var dd = d.getDate();
						var mm = d.getMonth()+1;
						var yyyy = d.getFullYear();
						$("#emp_joing_date").val(dd+'/'+mm+'/'+yyyy)
						$("#emp_id").val(data.emp[0].id)
						$("#edit_depList option[value='"+data.emp[0].department_id+"']").prop('selected',true);
						$("#edit_locList option[value='"+data.emp[0].location_id+"']").prop('selected',true);
						$("#gender option[value='"+data.emp[0].gender+"']").prop('selected',true);
						$("#edit_role_id option[value='"+roleid+"']").prop('selected',true);
						change_designation(data.emp[0].department_id)
						$("#edit_designationList option[value='"+data.emp[0].designation_id	+"']").prop('selected',true);
						 
						var file_nm = data.emp[0].employee_documents;
						var image_url="/employee_documents/"+data.emp[0].employee_documents; 
						var logo='<a href="'+image_url+'" download="'+image_url+'"><i class="fa fa-download"></i> Download </a><h4>Name : '+file_nm+'</h4>';  
						$("#employee_document_edit").html(logo);
						 	
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
			$('.achieved_employee').on('change', function() {
				var ret = Number($("#achieved_employee1").val()) + Number($("#achieved_employee12").val()) + Number($("#achieved_employee21").val()) + Number($("#achieved_employee22").val()) + Number($("#achieved_employee31").val()) + Number($("#achieved_employee32").val()) + Number($("#achieved_employee41").val()) + Number($("#achieved_employee42").val()) + Number($("#achieved_employee43").val());
				$("#total_achieved_employee").val(ret);
			});
			$('.scored_employee').on('change', function() {
				var ret = Number($("#scored_employee1").val()) + Number($("#scored_employee12").val()) + Number($("#scored_employee21").val()) + Number($("#scored_employee22").val()) + Number($("#scored_employee31").val()) + Number($("#scored_employee32").val()) + Number($("#scored_employee41").val()) + Number($("#scored_employee42").val()) + Number($("#scored_employee43").val());
				$("#total_scored_employee").val(ret);
			});
			$('.achieved_manager').on('change', function() {
				var ret = Number($("#achieved_manager1").val()) + Number($("#achieved_manager12").val()) + Number($("#achieved_manager21").val()) + Number($("#achieved_manager22").val()) + Number($("#achieved_manager31").val()) + Number($("#achieved_manager32").val()) + Number($("#achieved_manager41").val()) + Number($("#achieved_manager42").val()) + Number($("#achieved_manager43").val());
				$("#total_achieved_manager").val(ret);
			});
			$('.scored_manager').on('change', function() {
				var ret = Number($("#scored_manager1").val()) + Number($("#scored_manager12").val()) + Number($("#scored_manager21").val()) + Number($("#scored_manager22").val()) + Number($("#scored_manager31").val()) + Number($("#scored_manager32").val()) + Number($("#scored_manager41").val()) + Number($("#scored_manager42").val()) + Number($("#scored_manager43").val());
				$("#total_scored_manager").val(ret);
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
			$(document).on("click",".edit_personal_info",function() {
				var id=$(this).data('id');
				$("#passport_no").val($(this).data('passp'));
				$("#tel").val($(this).data('tel'));
				$("#nationality").val($(this).data('nati'));
				$("#religion").val($(this).data('relg'));
				$("#employment_of_spouse").val($(this).data('empsp'));
				$("#No_of_children").val($(this).data('child'));
				var marital_status =$(this).data('matst');
				$("#marital_status option[value='"+marital_status+"']").prop('selected',true);
				if($(this).data('expdate')){
				var d = new Date($(this).data('expdate'));
				var dd = d.getDate();
				var mm = d.getMonth()+1;
				var yyyy = d.getFullYear();
				$("#passport_expiry_date").val(dd+'/'+mm+'/'+yyyy);
				}
			});
			$(document).on("click",".edit-emergency-contact",function() {
				var id=$(this).data('id');
				$("#primary_name").val($(this).data('pnm'));
				$("#primary_relationship").val($(this).data('prs'));
				$("#primary_phone1").val($(this).data('phn1'));
				$("#primary_phone2").val($(this).data('phn2'));
				$("#secondary_name").val($(this).data('snm'));
				$("#secondary_relationship").val($(this).data('srs'));
				$("#secondary_phone1").val($(this).data('sphn1'));
				$("#secondary_phone2").val($(this).data('sphn2'));

			});

			// promotion scripts
			$('#promotionemployeeid').change(function(){
				var empid = $(this).val();
				$.ajax({
					url:"{{route('getdesignation')}}",
					type:'GET',
					data:{'empid':empid},
					success:function(result){
						// console.log(result);
						if (result.status == 1) {
							var curr = result.currentdesignation;
							var designation = result.designationforpromotion;
							$('#promotionfrom').val(curr.name);
							$('#promotionfromid').val(curr.id);
							$('#promotiondepartment').val(curr.department_id);
							$('#promotionto').html('');
							$('#promotionto').append('<option value="">--Select--</option>');
							designation.forEach(element => {
								$('#promotionto').append('<option value="'+element.id+'">'+element.name+'</option>');
							});
						}
					}
				})
			})

			$('#promotion-table tbody tr').each(function(){
				$(this).find('.editpromotionlink').click(function(){
					var proid = $(this).attr('data-id');
					$.ajax({
						url:"{{route('edit-promotion')}}",
						type:'GET',
						data:{'proid':proid},
						success:function(result){
							console.log(result);
							if (result.status == 1) {
							var curr = result.currentdesignation;
							var designation = result.designationforpromotion;
							var editdata = result.data;
							$('#proempname').val(result.employee);
							$('#proidforemp').val(editdata.id);
							$('#proempid').val(editdata.employeeid);
							$('#proempfromid').val(curr.id);
							$('#proempfrom').val(curr.name);
							var d = new Date(editdata.date);
							var day = d.getDate();
							var month = d.getMonth() + 1;
							var year = d.getFullYear();
							if (day < 10) {
								day = "0" + day;
							}
							if (month < 10) {
								month = "0" + month;
							}
							var formatteddate = day + "/" + month + "/" + year;
							$('#proempdate').val(formatteddate);
							$('#proempto').html('');
							$('#proempto').append('<option value="">--Select--</option>');
							designation.forEach(element => {
								if (element.id == editdata.promotionto) {
									var selectattr = 'selected';
								} else {
									var selectattr = '';
								}
								$('#proempto').append('<option value="'+element.id+'" '+selectattr+'>'+element.name+'</option>');
							});
						}
						}
					})
				})

				$(this).find('.deletepromotionlink').click(function(){
					var proid = $(this).attr('data-id');
					$('#deleteproid').val(proid);
				})
			})
			var base_url=window.location.origin+'/employee_documents'+'/';
			$(document).on("click",".editwarningbtn",function() {
				var id=$(this).data('id');
				var seelct_emp=$(this).data('emp_id');
				$("#indexid").text(id);
				$("input[id=getidjq]").val($(this).data('id'));
				var employee_comments = $(this).data('employee_comments');
				$("#employee_comments").val(employee_comments);
				$("#select_emp_id_edit option[value='"+seelct_emp+"']").prop('selected',true);
				$("#managers_comments").val($(this).data('managers_comments'));
				$("#admin_comments").val($(this).data('admin_comments'));
				$("#areas_for_improvement").val($(this).data('areas_for_improvement'));
				var uurl= $(this).data('document'); 
				var text_download=`<a href="`+base_url+uurl+`" download=`+base_url+uurl+` >download</a>`
				//var image_url="/employee_documents/"+uurl; alert(image_url);
				alert(text_download)
				$("#employee_documents").html(text_download);

				var seelct_emp2=$(this).data('emp_id2');
				$("#select_emp_id_edit2 option[value='"+seelct_emp2+"']").prop('selected',true);
				$("#indexid2").text($(this).data('id2'));
				$("input[id=getidjq2]").val($(this).data('id2'));
				$("#employee_comments2").val($(this).data('employee_comments2'));
				$("#managers_comments2").val($(this).data('managers_comments2'));
				$("#admin_comments2").val($(this).data('admin_comments2'));
				$("#areas_for_improvement2").val($(this).data('areas_for_improvement2'));
				var seelct_emp3=$(this).data('emp_id3');
				$("#select_emp_id_edit3 option[value='"+seelct_emp3+"']").prop('selected',true);
				$("#indexid3").text($(this).data('id3'));
				$("input[id=getidjq3]").val($(this).data('id3'));
				$("#employee_comments3").val($(this).data('employee_comments3'));
				$("#managers_comments3").val($(this).data('managers_comments3'));
				$("#admin_comments3").val($(this).data('admin_comments3'));
			})
			$(document).on("click",".edslpoin1",function() {
				$("#select_emp_id_edit").addClass("edit_warning_pointer");
				$("#select_emp_id_edit2").removeClass("edit_warning_pointer");
				$("#select_emp_id_edit3").removeClass("edit_warning_pointer");
			})
			$(document).on("click",".edslpoin2",function() {
				$("#select_emp_id_edit2").addClass("edit_warning_pointer");
				$("#select_emp_id_edit").removeClass("edit_warning_pointer");
				$("#select_emp_id_edit3").removeClass("edit_warning_pointer");
			})
			$(document).on("click",".edslpoin3",function() {
				$("#select_emp_id_edit3").addClass("edit_warning_pointer");
				$("#select_emp_id_edit2").removeClass("edit_warning_pointer");
				$("#select_emp_id_edit").removeClass("edit_warning_pointer");

			})
			$(document).on("click",".thirdeditwarningbtn",function() {
				var id=$(this).data('id');

			})
			$(document).on("click",".deleteWarningbtn",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_EmpVerbalWarning') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_EmpVerbalWarning').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				})
			})
			$(document).on("click",".seconddeleteWarningbtn",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_secondEmpVerbalWarning') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_EmpVerbalWarning').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				})
			})
			$(document).on("click",".thirddeleteWarningbtn",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_EmployeeThirdVerbalWarning') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_EmpVerbalWarning').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				})
			})
			$(document).on("click",".thirddeleteWarningbtn",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"{{ route('delete_EmployeeThirdVerbalWarning') }}",
					data:{"id":id,"_token": "{{ csrf_token() }}"},
					success:function(data){
						if(data.error=='2'){
							$('#delete_EmpVerbalWarning').modal('toggle');
							$(".employeeError").show();
						}else{
						location.reload();
						}
					}
				})
			})

			$('#resignation-table tbody tr').each(function(){
				$(this).find('.editresignationlink').click(function(){
					var resid = $(this).attr('data-id');
					$.ajax({
						url:"{{route('edit-resignation')}}",
						type:'GET',
						data:{'resid':resid},
						success:function(result){
							var editdata = result.data;
							$('#resid').val(editdata.id);
							$('#resemployee').val(result.employee);
							$('#resemployeeid').val(editdata.employeeid);
							$('#resdecisionby').val(result.loggedinuser);
							var d = new Date(editdata.noticedate);
							var day = d.getDate();
							var month = d.getMonth() + 1;
							var year = d.getFullYear();
							if (day < 10) {
								day = "0" + day;
							}
							if (month < 10) {
								month = "0" + month;
							}
							var formatteddate = day + "/" + month + "/" + year;
							$('#resnoticedate').val(formatteddate);
							var d2 = new Date(editdata.resignationdate);
							var day2 = d2.getDate();
							var month2 = d2.getMonth() + 1;
							var year2 = d2.getFullYear();
							if (day2 < 10) {
								day2 = "0" + day2;
							}
							if (month2 < 10) {
								month2 = "0" + month2;
							}
							var formatteddate2 = day2 + "/" + month2 + "/" + year2;
							$('#resresignationdate').val(formatteddate2);
							$('#resreason').val(editdata.reason);
							$("#resstatus").html('');
							var resultstatus = editdata.status;
							if (resultstatus === 'Approved') {
								var approvestatusattr = 'selected';
							}else{
								var approvestatusattr = '';
							}
							if (resultstatus === 'Disapproved') {
								var disapprovestatusattr = 'selected';
							}else{
								var disapprovestatusattr = '';
							}
							$('#resstatus').append('<option value="">--Select--</option><option '+approvestatusattr+' value="Approved">Approve</option><option '+disapprovestatusattr+' value="Disapproved">Disapprove</option>');
							$('#res2weeknotice').html('');
							var resultnotice = editdata.twoweeknotice;
							if (resultnotice === 'Yes') {
								var approvenoticeattr = 'selected';
							}else{
								var approvenoticeattr = '';
							}
							if (resultnotice === 'No') {
								var disapprovenoticeattr = 'selected';
							}else{
								var disapprovenoticeattr = '';
							}
							$('#res2weeknotice').append('<option value="">--Select--</option><option '+approvenoticeattr+' value="Yes">Yes</option><option '+disapprovenoticeattr+' value="No">No</option>');
							$('#resrehireable').html('');
							var resulthire = editdata.rehireable;
							if (resulthire === 'Yes') {
								var approvehireattr = 'selected';
							}else{
								var approvehireattr = '';
							}
							if (resulthire === 'No') {
								var disapprovehireattr = 'selected';
							}else{
								var disapprovehireattr = '';
							}
							$('#resrehireable').append(' <option value="">--Select--</option><option '+approvehireattr+' value="Yes">Yes</option><option '+disapprovehireattr+' value="No">No</option>');
						}
					})
				})

				$(this).find('.deleteresignationlink').click(function(){
					var resid = $(this).attr('data-id');
					$('#deleteresignationid').val(resid);
				});


			});

            var SITEURL = "{{url('/')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#calendar1').fullCalendar({
                events: SITEURL + "/leave_render",
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                    },

            });
		});

	</script>

<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    // Initiate the Pusher JS library
    Pusher.logToConsole = true;
    var pusher = new Pusher('49d473f998e2216d17cc', {
        cluster: 'ap2',
        forceTLS: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('promotion-added');
	var authuser = {{auth()->user()->id}};
    var channelname = 'promotionadded-'+authuser;

    // Bind a function to a Event (the full Laravel class)
    channel.bind(channelname, function(data) {
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
    });

	var channel_resignation = pusher.subscribe('employee-resignation');
	var channelname_resignation = 'employeeresignation-'+authuser;

	channel_resignation.bind(channelname_resignation, function(data) {
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
    });

    var termination_channel = pusher.subscribe('termination-added');
    var termination_channelname = 'terminationadded-'+authuser;

    termination_channel.bind(termination_channelname, function(termination_data) {
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+termination_data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
    });


	var leave_added_channel = pusher.subscribe('leave-added');
    var leave_added_channelname = 'leaveadded'

	var leave_added_auth_id={{ Auth::id() }}
	leave_added_channel.bind(leave_added_channelname, function(leave_added_data) {
	   if(leave_added_auth_id==leave_added_data.id || jQuery.inArray(leave_added_auth_id, leave_added_data.admin_ids) !== -1){
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+leave_added_data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
	   }
    });

	var indistatus_added_channel = pusher.subscribe('indicator-status');
    var indistatus_added_channelname = 'indicatorstatus'
	var indistatus_added_auth_id={{ Auth::id() }}
	indistatus_added_channel.bind(indistatus_added_channelname, function(indistatus_added_data) {
	   if(indistatus_added_auth_id==indistatus_added_data.id || jQuery.inArray(indistatus_added_auth_id) !== -1){
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+indistatus_added_data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
	   }
    });

	var appraisalstatus_added_channel = pusher.subscribe('appraisal-status');
    var appraisalstatus_added_channelname = 'appraisalstatus'
	var appraisalstatus_added_auth_id={{ Auth::id() }}
	appraisalstatus_added_channel.bind(appraisalstatus_added_channelname, function(appraisalstatus_added_data) {
	   if(appraisalstatus_added_auth_id==appraisalstatus_added_data.id || jQuery.inArray(appraisalstatus_added_auth_id) !== -1){
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+appraisalstatus_added_data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
	   }
    });

	var empperfomstatus_added_channel = pusher.subscribe('employee-perfomance-status');
    var empperfomstatus_added_channelname = 'empperfomancestatus'
	var empperfomstatus_added_auth_id={{ Auth::id() }}
	empperfomstatus_added_channel.bind(empperfomstatus_added_channelname, function(empperfomstatus_added_data) {
	   if(empperfomstatus_added_auth_id==empperfomstatus_added_data.id || jQuery.inArray(empperfomstatus_added_auth_id) !== -1){
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+empperfomstatus_added_data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
	   }
    });

	var leave_approve_channel = pusher.subscribe('leave-approved');
    var leave_approve_channelname = 'leaveapproved'

	var leave_approve_auth_id={{ Auth::id() }}

	leave_approve_channel.bind(leave_approve_channelname, function(leave_approve_data) {
	   if(leave_approve_auth_id==leave_approve_data.id){
       var pre = $('#noti-badge').html();
	   var newcount = parseInt(pre) + parseInt(1);
	   $('#noti-badge').html(newcount);
	   $('.notification-list').prepend('<li class="notification-message"><a href="activities"><div class="media"><span class="avatar"><img alt="" src="img/profiles/avatar-03.jpg"></span><div class="media-body"><p class="noti-details"><span class="noti-title">'+leave_approve_data.message+'</span> </p><p class="noti-time"><span class="notification-time">a few seconds ago</span></p></div></div></a></li>')
	   }
    });
	$(".clear-noti").click(function(){
		var logged_id={{ Auth::id() }}
		$(".notification-list").empty();
		$('#noti-badge').html(0);
		$.ajax({
          url: "{{ url('clear_notification') }}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            "id":logged_id
          },
          success:function(response){
		  }
		});
	})



	// Line Chart
	var linechartdata = $('#linechartdata').val();
	arr = $.parseJSON(linechartdata);
	finalarr = arr.reverse();
	console.log(finalarr);
	console.log([
			{ y: '2006', a: 50, b: 90 },
			{ y: '2007', a: 75,  b: 65 },
			{ y: '2008', a: 50,  b: 40 },
			{ y: '2009', a: 75,  b: 65 },
			{ y: '2010', a: 50,  b: 40 },
			{ y: '2011', a: 75,  b: 65 },
			{ y: '2012', a: 100, b: 50 }
		]);
	Morris.Line({
		element: 'line-charts-employees',
		data: finalarr,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['New Employess', 'Resigned Employees'],
		lineColors: ['#ff9b44','#fc6075'],
		lineWidth: '3px',
		resize: true,
		redraw: true
	});
 </script>


{{-- organizational chart --}}
<script>
	/*  plugin - dtree
    version - 1.0.0
*/

(function ($) {
    $.fn.dtree = function (options) {
        var $this = this,
            settings = $.extend({
                isHorizontal: false,
                customTemplate: false,
                gutter: 20,
                zoom: true,
                placeholderImg: "https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg",
                isCollapsible: true,
                searchbox: true
            }, options),
            _parents = [],
            _nodeDims = {},
            _iniScale = 0,
            _domNodes = {},
            _dtreeID = $this.attr("id") || "dtree" + Math.round(Math.random() * 100),
            init = {
                logger: function () {
                    _parents = calc.getParentChildObj();
                    _nodeDims = init.getNodeDimensions();

                    $this.html(init.buildNodes(_nodeDims));
                    init.rearrangeDom();
                    init.setSelectors();
                    console.log(settings.nodes, _nodeDims, _parents);
                },
                buildNodes: function (nodeDims) {
                    if (settings.customTemplate) {

                    } else {
                        var activepid = _parents.rootNode.id,
                            pNodes = _parents.listParents.length,
                            ndPipe = [activepid],
                            nodeHTML = "<div class=\"dtree-wrapper " + (settings.isHorizontal ? 'dtree-x' : '') + "\">";

                        if (settings.searchbox) {
                            nodeHTML += "<div class=\"dtree-searchbox\"><input type=\"text\" class=\"dtree-search-control\"><i class=\"dtree-search-icon\"></i>" +
                                "<ul class=\"dtree-search-list\"></ul>" +
                                "</div>";
                        }


                        nodeHTML += "<div class=\"dtree-node-wrapper\" id=\"" + _dtreeID + "_node_0\" style=\"width:100%\">" +
                            "<div class=\"dtree-node-cell\">" +
                            "<div class=\"dtree-node-main\">" +
                            "<div class=\"dtree-node \" style=\"margin:" + settings.gutter + "px\">" +
                            // "<div class=\"dtree-img\"><img src=\"" + (_parents.rootNode.img || settings.placeholderImg) + "\"></div>" +
                            "<div class=\"dtree-name\">" + _parents.rootNode.name + "</div>" +
                            (settings.isCollapsible ? "<div class=\"node-collapse\" data-dtree-collpase-node=\"#" + _dtreeID + "_node_" + activepid + "\"  style=\"bottom : " + settings.gutter / 2 + "px\"></div>" : "");
                        nodeHTML += (settings.isHorizontal) ? "<i class=\"dtree-branch liney\" style=\"height:50%; top:50%; left: " + settings.gutter + "px; width: calc(100% - " + settings.gutter + "px)\"></i>" : "<i class=\"dtree-branch liney\" style=\"width:50%; left:50%; top: " + settings.gutter + "px; height: calc(100% - " + settings.gutter + "px)\"></i>";
                        nodeHTML += "</div></div><div class=\"dtree-child-container\" id=\"" + _dtreeID + "_node_" + activepid + "\"></div></div></div>";

                        while (pNodes && ndPipe.length) {
                            activepid = ndPipe.shift();
                            var childNdsObj = _parents.parentObj[_parents.listParents.indexOf(activepid)];
                            if (!childNdsObj) {
                                continue;
                            }
                            var childNds = childNdsObj.childNodes;

                            nodeHTML += "<div class=\"dtree-node-wrapper \" id=\"" + _dtreeID + "_parent_" + activepid + "\"  >";

                            for (var i = 0; i < childNds.length; i++) {
                                var isParent = (_parents.listParents.indexOf(childNds[i].id) !== -1),
                                    hasSiblings = childNds.length - 1,
                                    xRight = (i == 0) ? "0" : "50%",
                                    xWidth = "50%",
                                    isMiddle = (i > 0 && i < childNds.length - 1),
                                    imgSrc = childNds[i].img || settings.placeholderImg,
                                    parObj = _parents.parentObj[_parents.listParents.indexOf(childNds[i].id)],
                                    isCollapsedNode = childNds[i].isCollapsed;

                                if (isMiddle) {
                                    xWidth = "100%";
                                    xRight = "0";
                                }
                                settings.nodes[_parents.nodeById[childNds[i].id]].lvl = 1 + settings.nodes[_parents.nodeById[activepid]].lvl;
                                // width: 100/childNds.length
                                nodeHTML += "<div class=\"dtree-node-cell \"  >" +
                                    "<div class=\"dtree-node-main\">" +
                                    "<div class=\"dtree-node "+(isCollapsedNode && "dtree-collapsed")+"\" style=\"margin:" + settings.gutter + "px\">" +
                                    // "<div class=\"dtree-img\"><img src=\"" + imgSrc + "\"></div>" +
                                    "<div class=\"dtree-name\">" + childNds[i].name + "</div>";
                                nodeHTML += isParent ? (settings.isCollapsible ? "<div class=\"node-collapse\" data-dtree-collpase-node=\"#" + _dtreeID + "_node_" + childNds[i].id + "\" style=\"bottom : " + settings.gutter / 2 + "px\"></div>" : "") : "";

                                if (settings.isHorizontal) {
                                    nodeHTML += (!isParent && parObj ? (parObj.childNodes.length > 1) : parObj) ? "<i class=\"dtree-branch liney\" ></i>" : "<i class=\"dtree-branch liney\" style=\"width:calc(100% - " + settings.gutter + "px); left: 0\"></i>";

                                } else {
                                    nodeHTML += (!isParent && parObj ? (parObj.childNodes.length > 1) : parObj) ? "<i class=\"dtree-branch liney\"></i>" : "<i class=\"dtree-branch liney\" style=\"height:calc(100% - " + settings.gutter + "px); top: 0\"></i>";
                                    nodeHTML += hasSiblings ? "<i class=\"dtree-branch linex\" style=\"right: " + xRight + "; width: " + xWidth + "\"></i>" : "";
                                }

                                nodeHTML += "</div></div>" +
                                    ((hasSiblings && (settings.isHorizontal)) ? "<i class=\"dtree-branch linex\" style=\"bottom: " + xRight + "; height: " + xWidth + "\"></i>" : "") +
                                    "<div class=\"dtree-child-container  "+(isCollapsedNode && "dtree-target-collapsed")+"\" id=\"" + _dtreeID + "_node_" + childNds[i].id + "\"></div></div>";
                                ndPipe.push(childNds[i].id);
                            }
                            nodeHTML += "</div>";
                            pNodes--;
                        }


                        return nodeHTML + "</div>";
                    }
                },
                rearrangeDom: function () {
                    var $parents = $this.find(".dtree-node-wrapper").not("#" + _dtreeID + "_node_0"),
                        $childs = $this.find(".dtree-child-container");

                    $parents.each(function () {
                        var custNodeId = $(this).attr("id").split("_"),
                            cutNode = $(this).detach(),
                            pasteNode = $childs.filter("#" + _dtreeID + "_node_" + custNodeId[custNodeId.length - 1]);
                        if (pasteNode) {
                            cutNode.appendTo(pasteNode);
                        }
                    });
                },
                getNodeDimensions: function () {
                    $('body').append("<div id=\"tempNode\"><div class=\"dtree-node\"><div class=\"dtree-img\"><img src=\"https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg\"></div> <div class=\"dtree-name\">mmmmmmmmmm</div><span class=\"dtree-branch\"><i></i><i></i></span></div></div>");
                    var $tempNode = $("#tempNode");
                    var tw = $tempNode.children().eq(0).outerWidth(true),
                        th = $tempNode.children().eq(0).outerHeight(true);

                    $tempNode.remove();
                    return {
                        nodeWidth: tw,
                        nodeHeight: th
                    };
                },
                setSelectors: function () {
                    _domNodes.nodes = $this.find(".dtree-node");
                    _domNodes.nodeContainers = $this.find(".dtree-node-main");
                    _domNodes.nodeCollapseToggles = $this.find(".node-collapse");
                    _domNodes.searchControl = $this.find(".dtree-search-control");
                    _domNodes.searchResults = $this.find(".dtree-search-list");

                    _domNodes.nodeCollapseToggles.on("click", handlers.onToggleCollapseClick);
                    _domNodes.searchControl.on("keyup", handlers.onSearchKeyup);
                    _domNodes.searchControl.on("blur", handlers.onSearchBlur);
                    $this.on("mousedown", handlers.onBoardMouseDown);
                    $this.on("mouseup", handlers.onBoardMouseUp);
                },
                buildSearchResults: function (listObj, skey) {
                    var listHTML = "";
                    for (var i = 0; i < listObj.length; i++) {
                        // var si = listObj[i].name.indexOf(skey) !== -1 ? listObj[i].name.indexOf(skey) : listObj[i].txt.indexOf(skey),
                        //     name = listObj[i]

                        listHTML += "<li>" + listObj[i].name + "</li>";
                    }

                    _domNodes.searchResults.html(listHTML);
                }
            },
            handlers = {
                onToggleCollapseClick: function (e) {
                    var $thisBtn = $(this),
                        $target = $($thisBtn.attr("data-dtree-collpase-node"));
                    $thisBtn.parent().toggleClass("dtree-collapsed");
                    $target.toggleClass("dtree-target-collapsed");
                },
                onSearchKeyup: function () {
                    var searchKey = $(this).val(),
                        resultSet = [];

                    resultSet = settings.nodes.filter(function (i, n) {
                        return (i.name.indexOf(searchKey) !== -1 || i.txt.indexOf(searchKey) !== -1);
                    });

                    init.buildSearchResults(resultSet, searchKey);
                },
                onSearchBlur: function () {
                    _domNodes.searchResults.html("");
                },
                onBoardMouseDown: function (e) {
                    _iniScale = e.offsetX;
                    $this.on("mousemove", handlers.onBoardMouseMove);
                },
                onBoardMouseUp: function (e) {
                    $this.off("mousemove", handlers.onBoardMouseMove);
                },
                onBoardMouseMove: function (e) {
                    e.preventDefault();
                    var pleft = _iniScale - e.offsetX;
                    $this.children().eq(0).scrollLeft($this.children().eq(0).scrollLeft() + pleft);
                },
                onScroll: function () {

                },
                onWheel: function (event) {
                    return;
                    event.preventDefault();
                    _iniScale = 0;
                    console.log(event.originalEvent);
                    if (!event.originalEvent.wheelDelta) {
                        if (event.deltaY < 0) {
                            _iniScale += 0.08;
                        } else {
                            _iniScale -= 0.05;
                        }
                    } else {
                        if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                            _iniScale + 0.08;
                        } else {
                            _iniScale -= 0.05;
                        }
                    }

                    $this.children().eq(0).css("transform", "scale(" + _iniScale + ")");
                }
            },
            calc = {
                getParentChildObj: function () {
                    var nodes = settings.nodes,
                        keyNodeId = {},
                        parents = nodes.map(function (i, n) {
                            var childNd = nodes.filter(function (k) {
                                return k.pid == i.id
                            });
                            keyNodeId[i.id] = n;
                            return {
                                pid: i.id,
                                pname: i.name,
                                childNodes: childNd
                            }
                        }).filter(function (i) {
                            return i.childNodes.length
                        });

                    return {
                        parentObj: parents,
                        listParents: parents.map(function (i) {
                            return i.pid
                        }),
                        rootNode: nodes.filter(function (i) {
                            return i.pid == 0
                        })[0],
                        nodeById: keyNodeId
                    };
                }
            };

        init.logger();
        return $this;
    }
}(jQuery));
/* usage */
$(function(){

// var treeNodes = [{
//         id: 22,
//         pid: 71,
//         name: "amar",
//         txt: "COO",
//         isCollapsed: true,
//         img: "https://cdn.dribbble.com/users/2424688/screenshots/5785083/amitabh.jpg"
//     },
//     {
//         id: 13,
//         pid: 22,
//         name: "om",
//         txt: "CTO",
//         img: "https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_auto:good%2Cw_300/MTE4MDAzNDEwMjg4MDE4OTU4/daniel-craig-201264-2-402.jpg"
//     },
//     {
//         id: 5,
//         pid: 13,
//         name: "dinanath",
//         txt: "Manager",
//         img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQbB9PU-bMhyGNvTO3TjQT7EEkFdvWl4uy2Qm1XKvHO4xi5eTB"
//     },
//     {
//         id: 7,
//         pid: 79,
//         name: "jani",
//         txt: "Treasurer",
//         img: "https://c.saavncdn.com/artists/Bappi_Lahiri.jpg"
//     },
//     {
//         id: 71,
//         pid: 0,
//         name: "Daddoo",
//         txt: "CEO",
//         img: "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b18ee09c-09cf-469b-aa16-d212554ba065/dbn4eh4-34dab0a9-6d71-4258-b05b-d8ebb7cdbdb3.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2IxOGVlMDljLTA5Y2YtNDY5Yi1hYTE2LWQyMTI1NTRiYTA2NVwvZGJuNGVoNC0zNGRhYjBhOS02ZDcxLTQyNTgtYjA1Yi1kOGViYjdjZGJkYjMuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.RZu4ZB_b6e6he-W6iIpUMMSv9WMKeUCLiodwSn4AcBg"
//     },
//     {
//         id: 79,
//         pid: 71,
//         name: "akbar",
//         txt: "CFO",
//         img: "https://in.bmscdn.com/iedb/artist/images/website/poster/large/rishi-kapoor-1883-12-09-2017-06-08-03.jpg"
//     },
//     {
//         id: 24,
//         pid: 22,
//         name: "jai",
//         txt: "Assistance Techical Officer",
//         img: "https://www.nzherald.co.nz/resizer/f6nbpG5XjgJAFYU3N0EtFv3pBnE=/360x384/filters:quality(70)/arc-anglerfish-syd-prod-nzme.s3.amazonaws.com/public/RBHF3AOWM5BTJJZPFIT6IEFJKM.jpg"
//     },
//     {
//         id: 26,
//         pid: 79,
//         name: "dany",
//         txt: "Assistant Manager",
//         img: ""
//     },
//     {
//         id: 9,
//         pid: 7,
//         name: "banananana",
//         txt: "just banana",
//         img: "https://images-na.ssl-images-amazon.com/images/I/71gI-IUNUkL._SY355_.jpg"
//     },
//     {
//         id: 10,
//         pid: 9,
//         name: "bana",
//         txt: "lonely banana",
//         img: "https://target.scene7.com/is/image/Target/GUEST_f5d0cfc3-9d02-4ee0-a6c6-ed5dc09971d1?wid=488&hei=488&fmt=pjpeg"
//     },
//     {
//         id: 8,
//         pid: 9,
//         name: "nanana",
//         txt: "Jr banana",
//         img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV97jxP66XYBaXCpw9BHnB9p8P9uxgxYwMdUOGHAU2jzSif3euQw"
//     },
//     {
//         id: 88,
//         pid: 22,
//         name: "jagdish",
//         txt: "Marketing Manager",
//         img: "https://static.indiatvnews.com/ins-web/images/rohit-getty-1519822385.jpg"
//     },
//     {
//         id: 25,
//         pid: 5,
//         name: "ajay",
//         txt: "Executive",
//         img: ""
//     },
//     {
//         id: 28,
//         pid: 5,
//         name: "vijay",
//         txt: "Executive",
//         img: ""
//     },
//     {
//         id: 1,
//         pid: 88,
//         name: "alpha",
//         txt: "robo1",
//         img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUAW3DBuMFkkXW15RIGRWJt7ID2XnjygOIyK5Tdj9KXVp12NCR"
//     },
//     {
//         id: 2,
//         pid: 88,
//         name: "beta",
//         txt: "robo2",
//         img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgc55Ng1-rAgGMT6GKcHO0aFUcXSWUHwOp88n2QFQ2T92FJk-t"
//     },
//     {
//         id: 33,
//         pid: 88,
//         name: "gamma",
//         txt: "robo3",
//         img: ""
//     },
//     {
//         id: 4,
//         pid: 88,
//         name: "delta",
//         txt: "robo4",
//         img: ""
//     },
//     {
//         id: 125,
//         pid: 4,
//         name: "eric",
//         txt: "Executive",
//         img: ""
//     },
//     {
//         id: 124,
//         pid: 4,
//         name: "t'challa",
//         txt: "Executive",
//         img: "https://static1.squarespace.com/static/56000fe2e4b05e6e3887d5c4/5602274ae4b0641e3a0e98e7/5a961d9424a694da8598769c/1519787606726/Screen+Shot+2018-02-27+at+10.12.55+PM.png?format=1000w"
//     },
// ];
var treedata = $('#treedata').val();
treearr = $.parseJSON(treedata);
// console.log(treearr);
// console.log(treeNodes);
  $("#ochart").dtree({
    isHorizontal: false,
    nodes : treearr
  });
});
</script>