<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>dashboard/"><span class="glyphicon glyphicon-home"></span></a></li>
			<li class="active"><?php echo $title;?> : Listing</li>
		</ol>
	</div><!--/.row-->		

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : Listing</div>
				<div class="panel-body">
					<?php show_message();?>
					<table id="table">
						<thead>
							<tr>
								<th  data-field="state" data-checkbox="true" ></th>
								<th  data-field="sn" data-sortable="false">SN</th>
								<th  data-field="role"  data-sortable="true">Role</th>								
								<th data-field="action_commands" data-sortable="false">Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->

</div>	<!--/.main-->

<?php include_once('partials/footer-js.php');?>

<script type="text/javascript">
	$(document).ready(function () {  

		$('#table').bootstrapTable({	    	
	    	url:'<?php echo $moduleUrl;?>getRoleList/',
	    	queryParams:function(p){
	    		return {
	    			searchKey:$('#tblSearch').val(),
	    			limit:p.limit,
	    			offset:p.offset,
	    			sort:p.sort,
	    			order:p.order
	    		}
	    	},      	
	    	toggle:"table",	    	
	    	useRowAttrFunc:false,
			reorderableRows:false,   	
	    	addUrl:'<?php echo $moduleUrl;?>add_role/',	    	
	    	exportUrl:'<?php echo $moduleUrl;?>export/',
	    	showDeleteButton:false,
	    	showExportButton:false,
	    });  

	}); 

</script>
<?php include_once('partials/footer-admin.php');?>
