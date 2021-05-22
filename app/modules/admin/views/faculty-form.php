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
					if(isset($aContentInfo->faculty_id)){
						$edit_id=$aContentInfo->faculty_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('faculty_id',$edit_id);
					?>
					<fieldset>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3"><?php show_message()?></div>
						</div>
                        
                        <div class="row">
                 
                        <div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label" ><?php echo lang('Faculty Photo')?>
								<span class="required">*</span></label>
								<div class="col-md-8 image-upload" faculty_name="<?php echo lang('Click on image to browse image')?>">
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
								<label class="col-md-3 control-label"><?php echo lang('Faculty Name')?>
									<span class="required">*</span></label>
									<div class="col-md-8">
										<?php 
										$faculty_name='';
										if(isset($_POST['faculty_name'])){
											$faculty_name=$_POST['faculty_name'];
										}else if(isset($aContentInfo->faculty_name)){
											$faculty_name=$aContentInfo->faculty_name;
										}?>
										<input id="faculty_name" name="faculty_name" validate="Required" type="text" placeholder="<?php echo lang('Faculty Name')?>" class="form-control" value="<?php echo $faculty_name?>">
										<div class="error" id="error_faculty_name"></div>
									</div>
								</div>	
                                </div>
                                
                                 
                        </div>
                        
                        <div class="row"> 
                             <div class="col-md-12">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Faculty Designation')?>
									<span class="required">*</span></label>
									<div class="col-md-8">
										<?php 
										$designation='';
										if(isset($_POST['designation'])){
											$designation=$_POST['designation'];
										}else if(isset($aContentInfo->designation)){
											$designation=$aContentInfo->designation;
										}?>
										<input id="designation" name="designation" validate="Required" type="text" placeholder="<?php echo lang('Faculty Designation')?>" class="form-control" value="<?php echo $designation?>">
										<div class="error" id="error_designation"></div>
									</div>
								</div>	
                                </div>
                                
                                 
                        </div>
                        
                        <div class="row"> 
                             <div class="col-md-12">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Faculty Qualification')?>
									<span class="required">*</span></label>
									<div class="col-md-8">
										<?php 
										$qualification='';
										if(isset($_POST['qualification'])){
											$qualification=$_POST['qualification'];
										}else if(isset($aContentInfo->qualification)){
											$qualification=$aContentInfo->qualification;
										}?>
										<input id="qualification" name="qualification" validate="Required" type="text" placeholder="<?php echo lang('Faculty Qualification')?>" class="form-control" value="<?php echo $qualification?>">
										<div class="error" id="error_qualification"></div>
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
