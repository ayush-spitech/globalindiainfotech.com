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
					if(isset($aContentInfo->career_id)){
						$edit_id=$aContentInfo->career_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('career_id',$edit_id);
					?>
					<fieldset>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3"><?php show_message()?></div>
						</div>						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Job Title')?>
								<span class="required">*</span>
							</label>
							<div class="col-md-6">
								<?php 
								$job_title='';
								if(isset($_POST['job_title'])){
									$job_title=$_POST['job_title'];
								}else if(isset($aContentInfo->job_title)){
									$job_title=$aContentInfo->job_title;
								}?>
								<input id="job_title" name="job_title" validate="Required" type="text" placeholder="<?php echo lang('Job Title')?>" class="form-control" value="<?php echo $job_title?>">
								<div class="error" id="error_job_title"></div>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('No. of Posts')?>
								<span class="required">*</span>
							</label>
							<div class="col-md-2">
								<?php 
								$posts='';
								if(isset($_POST['posts'])){
									$posts=$_POST['posts'];
								}else if(isset($aContentInfo->posts)){
									$posts=$aContentInfo->posts;
								}?>
								<input id="posts" name="posts" validate="Required" type="number" placeholder="<?php echo lang('No. of Posts')?>" min="1" class="form-control" value="<?php echo $posts?>">
								<div class="error" id="error_posts"></div>
							</div>
						</div>		

						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Job Description')?>
							</label>
							<div class="col-md-6">
								<?php
								$job_description='';
								if(isset($_POST['job_description'])){
									$job_description=$_POST['job_description'];
								}else if(isset($aContentInfo->job_description)){
									$job_description=$aContentInfo->job_description;
								}?>
								<textarea id="job_description" name="job_description" placeholder="<?php echo lang('Job Description')?>" class="form-control"><?php echo $job_description?></textarea>
								<?php full_ckeditor('job_description','700px','700px');?>
								<div class="error" id="error_job_description"></div>
							</div>
						</div>					

						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Status')?></label>
							<div class="col-md-3">
								<?php 
								$status='';
								if(isset($_POST['status'])){
									$status=$_POST['status'];
								}else if(isset($aContentInfo->status)){
									$status=$aContentInfo->status;
								}
								$aOption=status();
								$attribute='id="status" class="form-control"';
								echo form_dropdown('status',$aOption,$status,$attribute);
								?>									
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
