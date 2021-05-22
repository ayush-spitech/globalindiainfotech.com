<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>dashboard/"><span class="glyphicon glyphicon-home"></span></a></li>
			<li class="active"><?php echo $title;?> : Manage</li>
		</ol>
	</div><!--/.row-->		
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : Manage</div>
				<div class="panel-body">
					<?php 
					$edit_id=0;
					$activeClass='';
					if(isset($aContentInfo->role_id)){
						$edit_id=$aContentInfo->role_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open('',$attribute);
					echo form_hidden('role_id',$edit_id);
					?>
					<fieldset>
						<div class="form-group">
							<label class="col-md-3 control-label">User Role
								<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$role='';
									if(isset($_POST['role'])){
										$role=$_POST['role'];
									}else if(isset($aContentInfo->role)){
										$role=$aContentInfo->role;
									}?>
									<input id="role" name="role" validate="Required" type="text" placeholder="User Role" class="form-control" value="<?php echo $role?>">
									<div class="error" id="error_role"></div>
								</div>
							</div>							
							<!-- Form actions -->
							<div class="form-group" >
								<div class="col-md-3">
								</div>
								<div class="col-md-9 error" id="errorMessages">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<input type="hidden" name="submitform" id="submitform" value="submit">	
									<button type="button" onclick="saveForm('form1')" class="btn btn-primary btn-md">Save</button>
								</div>
							</div>
						</fieldset>
						<?php echo form_close();?>		
					</div>
				</div>
			</div>
		</div><!--/.row-->

	</div>	<!--/.main-->	
	<?php include_once('partials/footer-js.php');?>	
	<script>
		function saveForm(form_id){
			if(formValidateOnly(form_id)){
				var formData=$('#'+form_id).serialize();
				$.ajax({
					url:'<?php echo base_url()?>settings/ajaxAddRole/',
					type:'POST',
					data:formData,
					success:function(response){
						var msg='not inserted';
						if(response>0){
							msg='User role created successfully';
							window.location='<?php echo base_url()?>settings/role/';
						}else{
					      		// alert(response);
					      		$('#errorMessages').html(response);
					      	}       
					      }
					  });
			}
		}
	</script>
	<?php include_once('partials/footer-admin.php');?>
