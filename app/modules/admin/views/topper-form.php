<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>		
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title?> : <?php echo lang('Manage')?></div>
				<div class="panel-body">
					<?php 
					$edit_id=0;
					$activeClass='';					
					if(isset($aContentInfo->topper_id)){
						$edit_id=$aContentInfo->topper_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('topper_id',$edit_id);
					?>
					<fieldset>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3"><?php show_message()?></div>
						</div>
                        
                        <div class="row">
                 
                        <div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label" ><?php echo lang('Topper Photo')?>
								<span class="required">*</span></label>
								<div class="col-md-8 image-upload" topper_name="<?php echo lang('Click on image to browse image')?>">
									<?php 
									$thumbnail='';
									$validate_thumbnail='validate="Required"';
									if(isset($_POST['thumbnail'])){
										$thumbnail=$_POST['thumbnail'];
									}else if(isset($aContentInfo->thumbnail)){
										$thumbnail=$aContentInfo->thumbnail;
										$validate_thumbnail='';
									}?>
									<label for="thumbnail">
										<?php
										$attribute=array('id'=>'thumbnail_preview','class'=>'img-responsive','alt'=>$caption,'width'=>'150','height'=>'150'); 
										show_image($thumbnail,$attribute);
										?>
									</label>									
									<input id="thumbnail" name="thumbnail" onchange="previewImg(this,'thumbnail_preview')" <?php echo $validate_thumbnail?> type="file" >
									<div class="text-hint"><?php echo lang('Click on image to browse image')?></div>
									<div class="error" id="error_thumbnail"></div>
								</div>																
							</div>
                            </div>
                                
                            
                       </div>
                            <div class="row"> 
                             <div class="col-md-12">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Topper Name')?>
									<span class="required">*</span></label>
									<div class="col-md-8">
										<?php 
										$topper_name='';
										if(isset($_POST['topper_name'])){
											$topper_name=$_POST['topper_name'];
										}else if(isset($aContentInfo->topper_name)){
											$topper_name=$aContentInfo->topper_name;
										}?>
										<input id="topper_name" name="topper_name" validate="Required" type="text" placeholder="<?php echo lang('Topper Name')?>" class="form-control" value="<?php echo $topper_name?>">
										<div class="error" id="error_topper_name"></div>
									</div>
								</div>	
                                </div>
                                
                                 
                        </div>
                        
                        <div class="row"> 
                             <div class="col-md-12">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Topper Exam')?>
									<span class="required">*</span></label>
									<div class="col-md-8">
										<?php 
										$standard='';
										if(isset($_POST['standard'])){
											$standard=$_POST['standard'];
										}else if(isset($aContentInfo->standard)){
											$standard=$aContentInfo->standard;
										}?>
										<input id="standard" name="standard" validate="Required" type="text" placeholder="<?php echo lang('Topper Exam')?>" class="form-control" value="<?php echo $standard?>">
										<div class="error" id="error_standard"></div>
									</div>
								</div>	
                                </div>
                                
                                 
                        </div>
                        
                        <div class="row"> 
                             <div class="col-md-12">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Topper Rank')?>
									</label>
									<div class="col-md-8">
										<?php 
										$percentage='';
										if(isset($_POST['percentage'])){
											$percentage=$_POST['percentage'];
										}else if(isset($aContentInfo->percentage)){
											$percentage=$aContentInfo->percentage;
										}?>
										<input id="percentage" name="percentage"  type="text" placeholder="<?php echo lang('Topper Rank')?>" class="form-control" value="<?php echo $percentage?>">
										<div class="error" id="error_percentage"></div>
									</div>
								</div>	
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
