<!-- jQuery -->
<script src="js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="js/jquery.slimscroll.min.js"></script>
		<?php if(Route::is(['jobs-dashboard','user-dashboard'])): ?>
		<!-- Chart JS -->
		<script src="js/Chart.min.js"></script>
		<script src="js/line-chart.js"></script>
		<?php endif; ?>
		<!-- Select2 JS -->
		<script src="js/select2.min.js"></script>

		<script src="js/jquery-ui.min.js"></script>
		<script src="js/jquery.ui.touch-punch.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="js/moment.min.js"></script>
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Calendar JS -->
		<script src="js/jquery-ui.min.js"></script>
        <script src="js/fullcalendar.min.js"></script>
        <script src="js/jquery.fullcalendar.js"></script>

		<!-- Multiselect JS -->
		<script src="js/multiselect.min.js"></script>

		<!-- Datatable JS -->
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap4.min.js"></script>

		<!-- Summernote JS -->
		<script src="plugins/summernote/dist/summernote-bs4.min.js"></script>
		
			
		<script src="plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

		<!-- Task JS -->
		<script src="js/task.js"></script>

		<!-- Dropfiles JS
		<script src="js/dropfiles.js"></script> -->

		<!-- Custom JS -->
		<script src="js/app.js"></script>
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
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
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
		  $(document).on("click",".editBtn",function() {
			  
				deptname = $(this).closest('.trTag').find('.tdTag').html();
				$("#editDeptText").val(deptname)
				$("#editDeptId").val($(this).data('id'))
			});
			$(document).on("click",".deleteBtn",function() {
				$(".deleteDepCont").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".deleteDepCont",function() {
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"<?php echo e(route('delete_department')); ?>",
					data:{"id":id,"_token": "<?php echo e(csrf_token()); ?>"},
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
				alert("hii")
			});
			$(document).on("click",".delEmpBtn",function() {
				
				$(".deleteEmpCont").attr('data-id', $(this).data('id'));
			});
			$(document).on("click",".deleteEmpCont",function() {
				
				var id= $(this).data('id');
				$.ajax({
					type:'POST',
					url:"<?php echo e(route('delete_employee')); ?>",
					data:{"id":id,"_token": "<?php echo e(csrf_token()); ?>"},
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
					url:"<?php echo e(route('delete_designation')); ?>",
					data:{"id":id,"_token": "<?php echo e(csrf_token()); ?>"},
					success:function(data){
						location.reload();
					}
				});
			});
			$('#depList').on('change', function() {
            	var deptId = $(this).val();
				if(deptId) {
					$.ajax({
						url:"<?php echo e(route('getDesignationAjax')); ?>",
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
		});
	</script><?php /**PATH C:\xampp\htdocs\orange\resources\views/layout/partials/footer-scripts.blade.php ENDPATH**/ ?>