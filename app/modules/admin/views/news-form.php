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
					if(isset($aContentInfo->news_id)){
						$edit_id=$aContentInfo->news_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('news_id',$edit_id);
					?>
					<fieldset>	
						<div class="text-center">
							<?php echo $msg;?>
						</div>	
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('News Date')?></label>
							<div class="col-md-3">
								<?php 
								$date='';
								if(isset($_POST['date'])){
									$date=$_POST['date'];
								}else if(isset($aContentInfo->date)){
									$date=$aContentInfo->date;
								}?>
								<input id="date" name="date"  type="text" class="form-control date" placeholder="<?php echo lang('News Date')?>" value="<?php echo $date?>">					
								<div class="error" id="error_date"></div>			
							</div>
						</div>				
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('News Title')?>
								<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$news_title='';
									if(isset($_POST['title'])){
										$news_title=$_POST['title'];
									}else if(isset($aContentInfo->title)){
										$news_title=$aContentInfo->title;
									}?>
									<input id="title" name="title" validate="Required" type="text" placeholder="<?php echo lang('News Title')?>" class="form-control" value="<?php echo $news_title?>">
									<div class="error" id="error_news_title"></div>
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
