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
				<div class="col-md-8 col-md-offset-2">
						<?php 	
						//debug($aContentInfo);				
						$edit_id=0;
						if(isset($aContentInfo->customer_id)){
							$edit_id=$aContentInfo->customer_id;
						}
						$attribute=array("id"=>"form2","method"=>"post","class"=>"form-horizontal");
						echo form_open('',$attribute);
						echo form_hidden('customer_id',$edit_id);
						?>
						<fieldset>	
							<div class="form-group">
								<label class="col-md-2 control-label">
								</label>
								<div class="col-md-6">
									<?php 
									$photo='';
									if(isset($aContentInfo->photo)){
										$photo=$aContentInfo->photo;
									}	
									show_image($photo,array("width"=>"80","height"=>"80"));
									?>
								</div>																		
							</div>						
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
								<label class="col-md-2 control-label"><?php echo lang('Caste');?></label>
								<label class="col-md-6">
									<?php 
									$cast='';
									if(isset($aContentInfo->cast)){
										$cast=$aContentInfo->cast;
									}
									echo $cast;
									?>								
								</label>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Profession');?></label>
								<label class="col-md-6">
									<?php 
									$profession='';
									if(isset($aContentInfo->profession)){
										$profession=$aContentInfo->profession;
									}
									echo $profession;?>															
								</label>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Age');?></label>
								<label class="col-md-6">
									<?php 
									$age='';
									if(isset($aContentInfo->age)){
										$age=$aContentInfo->age.' Years';
									}
									echo $age;?>								
								</label>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Gender');?></label>
								<label class="col-md-6">
									<?php 
									$gender='';
									if(isset($aContentInfo->gender)){
										$gender=$aContentInfo->gender;
									}
									echo $gender;
									?>								
								</label>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('Country');?></label>
								<label class="col-md-6">
									<?php 
									$country_name='';
									if(isset($aContentInfo->country_name)){
										$country_name=$aContentInfo->country_name;
									}
									echo $country_name;
									?>
								</label>								
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('State');?></label>
								<label class="col-md-6">
									<?php 
									$state_name='';
									if(isset($aContentInfo->state_name)){
										$state_name=$aContentInfo->state_name;
									}
									echo $state_name;
									?>								
								</label>								
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo lang('City');?></label>
								<label class="col-md-6">
									<?php 
									$city_name='';
									if(isset($aContentInfo->city_name)){
										$city_name=$aContentInfo->city_name;
									}
									echo $city_name;
									?>							
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
