
<script src="<?php assets();?>js/bootstrap.min.js"></script>
<script src="<?php assets();?>js/bootstrap-datepicker.js"></script>
<script src="<?php assets();?>js/select2.js"></script>
<script src="<?php assets();?>js/bootstrap-clockpicker.js"></script>

<script src="<?php assets();?>bootstrap-table/bootstrap-table.js"></script>
<script src="<?php assets();?>bootstrap-table/extensions/reorder-rows/jquery.tablednd.js"></script>
<script src="<?php assets();?>bootstrap-table/extensions/reorder-rows/bootstrap-table-reorder-rows.js"></script>
<script src="<?php assets();?>js/jquery.tablednd_0_5.js"></script>


<script>
	$(document).ready(function(){
		Dropzone.options.myAwesomeDropzone = { 
			// The camelized version of the ID of the form element
			// The configuration we've talked about above
			url: '#',
			previewsContainer: ".dropzone-previews",
			uploadMultiple: true,
			parallelUploads: 100,
			maxFiles: 100
		}
	});

	$('.clockpicker').clockpicker();
	$('.select2').select2({
		minimumResultsForSearch: -1,
		placeholder:function(){
			$(this).data('placeholder');
		}
	});
	$('.date').datepicker({
		format: "dd-M-yyyy",
		//todayBtn: true,
		//clearBtn: true,
		autoclose: true,
		todayHighlight: true
	});

	!function ($) {
		$(document).on("click","ul.nav li.parent > a > span.icon", function(){
			$(this).find('em:first').toggleClass("glyphicon-minus");
		});
		$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
	}(window.jQuery);
	$(window).on('resize', function () {
		if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
	})
	$(window).on('resize', function () {
		if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
	})
</script>
<script type="text/javascript">
	//------row sorting------------
	$(".row-sorting tbody").tableDnD({
		onDrop: function (table, row) {
			var sequences = $.tableDnD.serialize();					
			$.ajax({
				url:BASE_URL+'common/row_sorting/',
				type:'POST',
				data:{sequences:sequences,csrf_token_name:csrf_value,module_id:MODULE_ID},
				dataType: 'json',
				success:function(response){									
					csrf_token_name=response.csrf_token_name;
					csrf_value=response.csrf_hash;									
				}
			});

		}
	});
</script>