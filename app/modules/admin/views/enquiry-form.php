<?php include_once('partials/header-admin.php');?>	
<style type="text/css">

label{
	font-weight:normal;
}
label.control-label{
	margin:0 !important;
	padding:0 !important;
	text-align:left !important;
	font-weight: bold;
}
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>		

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">

				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Manage')?></div>
				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2 hide">
						<?php 	
						//debug($aContentInfo);				
						$edit_id=0;
						if(isset($aContentInfo->enquiry_id)){
							$edit_id=$aContentInfo->enquiry_id;
						}
						$attribute=array("id"=>"form2","method"=>"post","class"=>"form-horizontal");
						echo form_open('',$attribute);
						echo form_hidden('enquiry_id',$edit_id);
						?>
						<fieldset>														
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Full Name');?></label>
								<label class="col-md-6">
									<?php 
									$name='';
									if(isset($aContentInfo->name)){
										$name=$aContentInfo->name;
									}
									echo $name;
									?>								
								</label>																		
							</div>								

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Contact');?></label>
								<label class="col-md-6">
									<?php 
									$mobile='';
									if(isset($aContentInfo->mobile)){
										$mobile=$aContentInfo->mobile;
									}
									echo $mobile;?>								
								</label>
							</div>								

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Email');?></label>
								<label class="col-md-6">
									<?php 
									$email='';
									if(isset($aContentInfo->email)){
										$email=$aContentInfo->email;
									}
									echo $email;
									?>								
								</label>
							</div>		

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Enquiry Date');?></label>
								<label class="col-md-6">
									<?php 
									$created_date='';
									if(isset($aContentInfo->created_date)){
										$created_date=$aContentInfo->created_date;
										$created_date=config_date($created_date);
									}
									echo $created_date;?>
								</label>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Service/Product');?></label>
								<label class="col-md-6">
									<?php 
									$service_name='';
									if(isset($aContentInfo->service_name)){
										$service_name=$aContentInfo->service_name;
									}
									echo $service_name;
									?>								
								</label>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Message');?></label>
								<label class="col-md-6">
									<?php 
									$message='';
									if(isset($aContentInfo->message)){
										$message=$aContentInfo->message;
									}
									echo $message;?>															
								</label>
							</div>								

							<!-- Form actions -->
							<div class="form-group">
								<div class="col-md-9 col-md-offset-3">
									<input type="hidden" name="submitform" id="submitform" value="submit">	
									<button type="button" onclick="formValidate('form2')" class="hide btn btn-primary btn-md"><?php echo lang('Save');?></button>							
									<button type="button" class="btn btn-danger btn-md" onclick="history.go(-1)"><?php echo lang('Close');?></button>
								</div>
							</div>
						</fieldset>
						<?php echo form_close();?>
						<?php //include_once('role-modal.php');?>
					</div>
				</div>	
				<div class="panel-footer"></div>							
				
			</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->	
<?php include_once('partials/footer-js.php');?>
<?php include_once('partials/footer-admin.php');?>
