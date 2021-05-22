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
					if(isset($aContentInfo->recipe_id)){
						$edit_id=$aContentInfo->recipe_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('recipe_id',$edit_id);
					?>
					<fieldset>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3"><?php show_message()?></div>
						</div>
                        
                        <div class="row">
                 
                        <div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" ><?php echo lang('Thumbnail')?>
								<span class="required">*</span></label>
								<div class="col-md-6 image-upload" title="<?php echo lang('Click on image to browse image')?>">
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
										$attribute=array('id'=>'thumbnail_preview','class'=>'img-responsive','alt'=>$caption); 
										show_image($thumbnail,$attribute);
										?>
									</label>									
									<input id="thumbnail" name="thumbnail" onchange="previewImg(this,'thumbnail_preview')" <?php echo $validate_thumbnail?> type="file">
									<div class="text-hint"><?php echo lang('Click on image to browse image')?></div>
									<div class="error" id="error_thumbnail"></div>
								</div>																
							</div>
                            </div>
                                <div class="col-md-6">
                            <div class="form-group">
							<label class="col-md-4 control-label"><?php echo lang('Featured Image')?>
								<span class="required">*</span></label>
								<div class="col-md-6 image-upload" title="<?php echo lang('Click on image to browse image')?>">
									<?php 
									$featured_image='';
									$validate_featured_image='validate="Required"';
									if(isset($_POST['featured_image'])){
										$featured_image=$_POST['featured_image'];
									}else if(isset($aContentInfo->featured_image)){
										$featured_image=$aContentInfo->featured_image;
										$validate_featured_image='';
									}?>
									<label for="featured_image">
										<?php
										$attribute=array('id'=>'featured_image_preview','class'=>'img-responsive','alt'=>$caption); 
										show_image($featured_image,$attribute);
										?>
									</label>									
									<input id="featured_image" name="featured_image" onchange="previewImg(this,'featured_image_preview')" <?php echo $validate_featured_image?> type="file">
									<div class="text-hint"><?php echo lang('Click on image to browse image')?></div>
									<div class="error" id="error_featured_image"></div>
								</div>																
							</div>
                            </div>
                            
                       </div>
                            <div class="row"> 
                             <div class="col-md-12">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Recipe Title')?>
									<span class="required">*</span></label>
									<div class="col-md-8">
										<?php 
										$title='';
										if(isset($_POST['title'])){
											$title=$_POST['title'];
										}else if(isset($aContentInfo->title)){
											$title=$aContentInfo->title;
										}?>
										<input id="title" name="title" validate="Required" type="text" placeholder="<?php echo lang('Recipe Title')?>" class="form-control" value="<?php echo $title?>">
										<div class="error" id="error_title"></div>
									</div>
								</div>	
                                </div>
                                
                                 
                        </div>
                        
                        <div class="row">
                        <div class="col-md-12">
                                
                                <div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Cuisine')?>
									</label>
									<div class="col-md-8">
										<?php 
										$cuisine='';
										if(isset($_POST['cuisine'])){
											$cuisine=$_POST['cuisine'];
										}else if(isset($aContentInfo->cuisine)){
											$cuisine=$aContentInfo->cuisine;
										}?>
										<input id="cuisine" name="cuisine"  type="text" placeholder="<?php echo lang('Cuisine')?>" class="form-control" value="<?php echo $cuisine?>">
										<div class="error" id="error_cuisine"></div>
									</div>
								</div>	
                                
                                </div>
                        </div>
                        
                        <div class="row">
                        <div class="col-md-12">
                                
                                <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('Recipe of the day')?>
									</label>
                                <div class="col-md-8">
                                <?php 
										$recipe_type='';
										if(isset($_POST['recipe_type'])){
											$recipe_type=$_POST['recipe_type'];
										}else if(isset($aContentInfo->recipe_type)){
											$recipe_type=$aContentInfo->recipe_type;
										}
										$checked="";
										if($recipe_type==1)
										{
											$checked=' checked="checked" ';
										}
										?>
                           
<label class="checkbox-inline"><input type="checkbox" value="1" <?php echo $checked ?>   id="recipe_type" name="recipe_type" >Yes</label>

                                </div>
                                
                           
								</div>	
                                
                                </div>
                        </div>
                        
                        <div class="row">
                        <div class="col-md-12">
                                
                                <div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Category')?><span class="required">*</span>
									</label>
									<div class="col-md-8">
								<?php 
								$category_id='';
								if(isset($_POST['category_id'])){
									$category_id=$_POST['category_id'];
								}else if(isset($aContentInfo->category_id)){
									$category_id=$aContentInfo->category_id;
								}
								$aOption=array(''=>'Select Required Category');
								if(isset($aCategory) && is_array($aCategory) && !empty($aCategory)){
									foreach ($aCategory as $key => $value) {
										$aOption[$value->category_id]=$value->title;
									}
								}
								$attribute='id="category_id" class="form-control" validate="Required" ';
								echo form_dropdown('category_id',$aOption,$category_id,$attribute);
								?>
								<div class="error" id="error_category_id"></div>
							</div>
								</div>	
                                
                                </div>
                        </div>
                        
                        
								<div class="form-group">
									<label class="col-md-3 control-label"><?php echo lang('Recipe Description')?><span class="required">*</span>
									</label>
									<div class="col-md-6">
										<?php
										$description='';
										if(isset($_POST['description'])){
											$description=$_POST['description'];
										}else if(isset($aContentInfo->description)){
											$description=$aContentInfo->description;
										}?>
										<textarea id="description" name="description" placeholder="<?php echo lang('Recipe Description')?>" class="form-control"><?php echo $description?></textarea>
										<?php full_ckeditor('description','700px','150px');?>
										<div class="error" id="error_description"></div>
									</div>
								</div>		
                                
                                <div class="form-group">
									<label class="col-md-3 control-label"><?php echo lang('Recipe Ingredients')?>
									<span class="required">*</span></label>
									<div class="col-md-6">
										<?php
										$ingredients='';
										if(isset($_POST['ingredients'])){
											$ingredients=$_POST['ingredients'];
										}else if(isset($aContentInfo->ingredients)){
											$ingredients=$aContentInfo->ingredients;
										}?>
										<textarea id="ingredients" name="ingredients" placeholder="<?php echo lang('Recipe Ingredients')?>"    class="form-control"><?php echo $ingredients ?></textarea>
										<?php full_ckeditor('ingredients','700px','150px');?>
										<div class="error" id="error_ingredients"></div>
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="col-md-3 control-label"><?php echo lang('Recipe Method')?>
									<span class="required">*</span></label>
									<div class="col-md-6">
										<?php
										$method='';
										if(isset($_POST['method'])){
											$method=$_POST['method'];
										}else if(isset($aContentInfo->method)){
											$method=$aContentInfo->method;
										}?>
										<textarea id="method" name="method" placeholder="<?php echo lang('Recipe Method')?>" class="form-control"><?php echo $method?></textarea>
										<?php full_ckeditor('method','700px','300px');?>
										<div class="error" id="error_method"></div>
									</div>
								</div>		
                                
                                <?php /*?><div class="form-group">
									<label class="col-md-3 control-label"><?php echo lang('Recipe Tips')?>
									</label>
									<div class="col-md-6">
										<?php
										$tips='';
										if(isset($_POST['tips'])){
											$tips=$_POST['tips'];
										}else if(isset($aContentInfo->tips)){
											$tips=$aContentInfo->tips;
										}?>
										<textarea id="tips" name="tips" placeholder="<?php echo lang('Recipe Tips')?>" class="form-control"><?php echo $tips?></textarea>
										<?php full_ckeditor('tips','700px','150px');?>
										<div class="error" id="error_tips"></div>
									</div>
								</div><?php */?>	

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
