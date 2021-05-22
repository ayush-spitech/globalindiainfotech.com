<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>		

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Manage')?></div>
				<div class="panel-body">						
					<?php 
					//debug($aContentInfo);
					$edit_id=0;
					if(isset($aContentInfo->id)){
						$edit_id=$aContentInfo->id;
					}
					$attribute=array("id"=>"form2","method"=>"post","class"=>"form-horizontal");
					echo form_open('',$attribute);
					echo form_hidden('id',$edit_id);
					?>
					<fieldset>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Template Name');?><span class="required">*</span></label>
							<div class="col-md-6">
								<?php 
								$template='';
								if(isset($_POST['template'])){
									$template=$_POST['template'];
								}else if(isset($aContentInfo->template)){
									$template=$aContentInfo->template;
								}?>
								<input type="text" id="template" name="template"  class="form-control" placeholder="<?php echo lang('Template Name')?>" value="<?php echo $template?>">
								<div id="error_template" class="error"><?php echo form_error('template')?></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Subject');?><span class="required">*</span></label>
							<div class="col-md-6">
								<?php 
								$subject='';
								if(isset($_POST['subject'])){
									$subject=$_POST['subject'];
								}else if(isset($aContentInfo->subject)){
									$subject=$aContentInfo->subject;
								}?>
								<input type="text" id="subject" name="subject"  class="form-control" placeholder="<?php echo lang('Subject')?>" value="<?php echo $subject?>">
								<div id="error_subject" class="error"><?php echo form_error('subject')?></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('From Email');?><span class="required">*</span></label>
							<div class="col-md-6">
								<?php 
								$from_email='';
								if(isset($_POST['from_email'])){
									$from_email=$_POST['from_email'];
								}else if(isset($aContentInfo->from_email)){
									$from_email=$aContentInfo->from_email;
								}?>
								<input type="text" id="from_email" name="from_email"  class="form-control" placeholder="<?php echo lang('From Email')?>" value="<?php echo $from_email?>">
								<div id="error_from_email" class="error"><?php echo form_error('from_email')?></div>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('From Name');?><span class="required">*</span></label>
							<div class="col-md-6">
								<?php 
								$from_name='';
								if(isset($_POST['from_name'])){
									$from_name=$_POST['from_name'];
								}else if(isset($aContentInfo->from_name)){
									$from_name=$aContentInfo->from_name;
								}?>
								<input type="text" id="from_name" name="from_name"  class="form-control" placeholder="<?php echo lang('From Name')?>" value="<?php echo $from_name?>">
								<div id="error_from_name" class="error"><?php echo form_error('from_name')?></div>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Message');?></label>
							<div class="col-md-6">
								<?php 
								$message='';
								if(isset($_POST['message'])){
									$message=$_POST['from_name'];
								}else if(isset($aContentInfo->message)){
									$message=$aContentInfo->message;
								}?>
								<textarea  id="message" name="message" type="text" class="form-control"><?php echo $message;?></textarea>
								<?php full_ckeditor('message','700px','400px');?>
								</div>
						</div>																				

							<!-- Form actions -->
							<div class="form-group">
								<div class="col-md-9 col-md-offset-3">
									<input type="hidden" name="submitform" id="submitform" value="submit">	
									<button type="button" onclick="formValidate('form2')" class="btn btn-primary btn-md"><?php echo lang('Save');?></button>
									&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-danger btn-md" onclick="history.go(-1)"><?php echo lang('Cancel');?></button>
								</div>
							</div>
						</fieldset>
						<div class="panel-footer"></div>
						<?php echo form_close();?>
						<?php //include_once('role-modal.php');?>								
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->	
	<?php include_once('partials/footer-js.php');?>
	<?php include_once('partials/footer-admin.php');?>
