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
					if(isset($aContentInfo->download_id)){
						$edit_id=$aContentInfo->download_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('download_id',$edit_id);
					?>
					<fieldset>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3"><?php show_message()?></div>
						</div>
						
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Title')?>
									<span class="required">*</span></label>
									<div class="col-md-6">
										<?php 
										$caption='';
										if(isset($_POST['caption'])){
											$caption=$_POST['caption'];
										}else if(isset($aContentInfo->caption)){
											$caption=$aContentInfo->caption;
										}?>
										<input id="caption" name="caption" validate="Required" type="text" placeholder="<?php echo lang('File Title')?>" class="form-control" value="<?php echo $caption?>">
										<div class="error" id="error_caption"></div>
									</div>
								</div>	
                                
                                <div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('File')?>
								<span class="required">*</span></label>
								<div class="col-md-3" title="<?php echo lang('Click to browse file')?>">
									<?php 
									$attachment='';
									$validate_attachment='validate="Required"';
									if(isset($_POST['attachment'])){
										$attachment=$_POST['attachment'];
									}else if(isset($aContentInfo->attachment)){
										$attachment=$aContentInfo->attachment;
										$validate_attachment='';
									}?>
																		
									<input id="attachment" name="attachment" <?php echo $validate_attachment?> type="file">
									<div class="text-hint"><?php echo lang('Click to browse file')?></div>
									<div class="error" id="error_attachment"></div>
								</div>	
                                
                                
                                
                               <?php if(isset($aContentInfo->attachment)){ ?> 
                               		<div class="col-md-3 text-left">
									<?php 
									$attachment=$aContentInfo->attachment;										
									?>
																		
									<a href="<?php media_url(); echo $attachment?>" target="_blank"><i class="fa fa-download fa-2x"></i> <?php echo $attachment ?></a>
									<div class="text-hint"><?php echo lang('Click to download the old file')?></div>
									<div class="error" id="error_attachment"></div>
								</div>			
                                <?php } ?>
                                
                                															
							</div>	

								<div class="form-group hide">
									<label class="col-md-3 control-label"><?php echo lang('Short Description')?>
									</label>
									<div class="col-md-6">
										<?php
										$short_description='';
										if(isset($_POST['short_description'])){
											$short_description=$_POST['short_description'];
										}else if(isset($aContentInfo->short_description)){
											$short_description=$aContentInfo->short_description;
										}?>
										<textarea id="short_description" name="short_description" placeholder="<?php echo lang('Short Description')?>" class="form-control"><?php echo $short_description?></textarea>
										<div class="error" id="error_short_description"></div>
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
