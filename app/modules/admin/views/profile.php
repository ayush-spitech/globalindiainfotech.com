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
				<?php show_message();?>
					<?php 
					$edit_id=0;
					$activeClass='';
					if(isset($aContentInfo->user_id)){
						$edit_id=$aContentInfo->user_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open('',$attribute);
					echo form_hidden('user_id',$edit_id);
					?>
					<fieldset>
						<div class="form-group">
							<label class="col-md-3 control-label">Name
								<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$name='';
									if(isset($_POST['name'])){
										$name=$_POST['name'];
									}else if(isset($aContentInfo->name)){
										$name=$aContentInfo->name;
									}?>
									<input id="name" name="name" validate="Required" type="text" placeholder="Name" class="form-control" value="<?php echo $name?>">
									<div class="error" id="error_name"></div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Mobile<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$mobile='';
									if(isset($_POST['mobile'])){
										$mobile=$_POST['mobile'];
									}else if(isset($aContentInfo->mobile)){
										$mobile=$aContentInfo->mobile;
									}?>
									<input disabled="disabled" id="mobile" name="mobile"  type="text" class="form-control" placeholder="Mobile Number" value="<?php echo $mobile?>">
									<div id="error_mobile" class="error"><?php echo form_error('mobile')?></div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Email<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$email='';
									if(isset($_POST['email'])){
										$email=$_POST['email'];
									}else if(isset($aContentInfo->email)){
										$email=$aContentInfo->email;
									}?>
									<input disabled="disabled" id="email" name="email"  type="text" class="form-control" placeholder="Eamil Id" value="<?php echo $email?>">
									<div id="error_email" class="error"><?php echo form_error('email')?></div>
								</div>
							</div>				

							<!-- Form actions -->
							<div class="form-group" >								
								<div class="col-md-9 col-md-offset-3 error" id="errorMessages">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<input type="hidden" name="submitform" id="submitform" value="submit">	
									<button type="button" onclick="formValidate('form1')" class="btn btn-primary btn-md">Save</button>
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
	<?php include_once('partials/footer-admin.php');?>
