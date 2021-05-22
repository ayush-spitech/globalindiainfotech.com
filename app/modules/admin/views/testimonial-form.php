<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>			
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Manage')?></div>
				<div class="panel-body">
					<?php 
					$edit_id=0;
					$activeClass='';
					if(isset($aContentInfo->testimonial_id)){
						$edit_id=$aContentInfo->testimonial_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('testimonial_id',$edit_id);
					?>
					<fieldset>	
						<div class="text-center">
							<?php echo $msg;?>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Image')?>
								<span class="required">*</span></label>
								<div class="col-md-3 image-upload" title="<?php echo lang('Click on image to browse image')?>">
									<?php 
									$image='';
									$validate_image='validate="Required"';
									if(isset($_POST['image'])){
										$image=$_POST['image'];
									}else if(isset($aContentInfo->image)){
										$image=$aContentInfo->image;
										$validate_image='';
									}?>
									<label for="image">
										<?php
										$attribute=array('id'=>'image_preview','class'=>'img-responsive','alt'=>$caption); 
										show_image($image,$attribute);
										?>
									</label>									
									<input id="image" name="image" onchange="previewImg(this,'image_preview')" <?php echo $validate_image?> type="file">
									<div class="text-hint"><?php echo lang('Click on image to browse image')?></div>
									<div class="error" id="error_image"></div>
								</div>																
							</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Name')?>
								<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$name='';
									if(isset($_POST['name'])){
										$name=$_POST['name'];
									}else if(isset($aContentInfo->name)){
										$name=$aContentInfo->name;
									}?>
									<input id="name" name="name" validate="Required" type="text" placeholder="<?php echo lang('Name')?>" class="form-control" value="<?php echo $name?>">
									<div class="error" id="error_name"></div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Mobile')?></label>
								<div class="col-md-6">
									<?php 
									$mobile='';
									if(isset($_POST['mobile'])){
										$mobile=$_POST['mobile'];
									}else if(isset($aContentInfo->mobile)){
										$mobile=$aContentInfo->mobile;
									}?>
									<input  id="mobile" name="mobile"  type="text" class="form-control" placeholder="<?php echo lang('Mobile Number')?>" value="<?php echo $mobile?>">	
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Email')?></label>
								<div class="col-md-6">
									<?php 
									$email='';
									if(isset($_POST['email'])){
										$email=$_POST['email'];
									}else if(isset($aContentInfo->email)){
										$email=$aContentInfo->email;
									}?>
									<input id="email" name="email"  type="text" class="form-control" placeholder="<?php echo lang('Email')?>" value="<?php echo $email?>">									
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Message')?><span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$message='';
									if(isset($_POST['message'])){
										$message=$_POST['message'];
									}else if(isset($aContentInfo->message)){
										$message=$aContentInfo->message;
									}?>
									<textarea rows="5" validate="Required" id="message" name="message" class="form-control" placeholder="Message"><?php echo $message?></textarea> 
									<div id="error_message" class="error"><?php echo form_error('message')?></div>
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
									<button type="button" onclick="formValidate('form1')" class="btn btn-primary btn-md"><?php echo lang('Save')?></button>
									&nbsp;&nbsp;&nbsp;
										<button type="button" class="btn btn-danger btn-md" onclick="history.go(-1)"><?php echo lang('Cancel')?></button>
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
