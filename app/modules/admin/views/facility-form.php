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
					if(isset($aContentInfo->facility_id)){
						$edit_id=$aContentInfo->facility_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('facility_id',$edit_id);
					?>
					<fieldset>	
						<div class="text-center">
							<?php echo $msg;?>
						</div>	
										
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Facilty Title')?>
								<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$facility_title='';
									if(isset($_POST['title'])){
										$facility_title=$_POST['title'];
									}else if(isset($aContentInfo->title)){
										$facility_title=$aContentInfo->title;
									}?>
									<input id="title" name="title" validate="Required" type="text" placeholder="<?php echo lang('Facilty Title')?>" class="form-control" value="<?php echo $facility_title?>">
									<div class="error" id="error_facility_title"></div>
								</div>
							</div>
                            
                            
                            <div class="form-group">
									<label class="col-md-3 control-label"><?php echo lang('Facility Description')?>
									</label>
									<div class="col-md-6">
										<?php
										$description='';
										if(isset($_POST['description'])){
											$description=$_POST['description'];
										}else if(isset($aContentInfo->description)){
											$description=$aContentInfo->description;
										}?>
										<textarea id="description" name="description" placeholder="<?php echo lang('Facility Description')?>" class="form-control"><?php echo $description?></textarea>
										<?php full_ckeditor('description','700px','150px');?>
										<div class="error" id="error_description"></div>
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
