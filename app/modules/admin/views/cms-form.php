<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>		
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Manage')?></div>
				<div class="panel-body">
                <?php show_message();?>	
					<?php 
					$edit_id=0;
					$activeClass='';
					if(isset($aContentInfo->cms_id)){
						$edit_id=$aContentInfo->cms_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal","enctype"=>"multipart/form-data");
					echo form_open('',$attribute);
					echo form_hidden('cms_id',$edit_id);
					?>
					<fieldset>													
						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Page Name')?>
								<span class="required">*</span></label>
								<div class="col-md-9">
									<?php 
									$page_name='';
									$disable='';
									
									if(isset($_POST['page_name'])){
										$page_name=$_POST['page_name'];
									}else if(isset($aContentInfo->page_name)){
										$page_name=$aContentInfo->page_name;										
										if(isset($_SESSION['aUser']->role_id) && $_SESSION['aUser']->role_id>1){
											$disable='readonly';
										}
									}?>
									<input id="page_name" name="page_name" validate="Required" type="text" placeholder="Page Name" class="form-control" value="<?php echo $page_name?>"  <?php echo $disable;?>>
									<div class="error" id="error_page_name"></div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Page Title');?><span class="required">*</span></label>
								<div class="col-md-9">
									<?php 
									$page_title='';
									if(isset($_POST['page_title'])){
										$page_title=$_POST['page_title'];
									}else if(isset($aContentInfo->page_title)){
										$page_title=$aContentInfo->page_title;
									}?>
									<input validate="Required" id="page_title" name="page_title"  type="text" class="form-control" placeholder="Page Title" value="<?php echo $page_title?>">
									<div id="error_page_title" class="error"><?php echo form_error('page_title')?></div>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Menu Id');?><span class="required">*</span></label>
								<div class="col-md-9">
									<?php 
									$menu='';
									if(isset($_POST['menu'])){
										$menu=$_POST['menu'];
									}else if(isset($aContentInfo->menu)){
										$menu=$aContentInfo->menu;
									}?>
									<input validate="Required" id="menu" name="menu"  type="text" class="form-control" placeholder="Menu Id for showing active menu" value="<?php echo $menu?>">
									<div id="error_menu" class="error"><?php echo form_error('menu')?></div>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Page Content')?></label>
								<div class="col-md-9">
									<?php 
									$long_content='';
									if(isset($_POST['long_content'])){
										$long_content=$_POST['long_content'];
									}else if(isset($aContentInfo->page_content)){
										$long_content=$aContentInfo->page_content;
									}									
									?>
									<textarea rows="10" id="long_content" name="long_content" type="text" class="form-control">
									<?php echo $long_content;?></textarea>
									<?php full_ckeditor('long_content','700px','700px');?>
								</div>								
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Meta Keywords');?></label>
								<div class="col-md-9">
									<?php 
									$meta_keywords='';
									if(isset($_POST['meta_keywords'])){
										$meta_keywords=$_POST['meta_keywords'];
									}else if(isset($aContentInfo->meta_keywords)){
										$meta_keywords=$aContentInfo->meta_keywords;
									}?>
									<input  id="meta_keywords" name="meta_keywords"  type="text" class="form-control" placeholder="<?php echo lang('Meta Keywords');?>" value="<?php echo $meta_keywords?>">
									<div id="error_meta_keywords" class="error"><?php echo form_error('meta_keywords')?></div>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Meta Description');?></label>
								<div class="col-md-9">
									<?php 
									$meta_description='';
									if(isset($_POST['meta_description'])){
										$meta_description=$_POST['meta_description'];
									}else if(isset($aContentInfo->meta_description)){
										$meta_description=$aContentInfo->meta_description;
									}?>
									<input  id="meta_description" name="meta_description"  type="text" class="form-control" placeholder="<?php echo lang('Meta Description');?>" value="<?php echo $meta_description?>">
									<div id="error_meta_description" class="error"><?php echo form_error('meta_description')?></div>
								</div>
							</div>	
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Meta Robots');?></label>
								<div class="col-md-9">
									<?php 
									$meta_robots='';
									if(isset($_POST['meta_robots'])){
										$meta_robots=$_POST['meta_robots'];
									}else if(isset($aContentInfo->meta_robots)){
										$meta_robots=$aContentInfo->meta_robots;
									}?>
									<input  id="meta_robots" name="meta_robots"  type="text" class="form-control" placeholder="<?php echo lang('Meta Robots')?>" value="<?php echo $meta_robots?>">									
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
										$aOption=array("1"=>lang("Active"),"0"=>lang("Inactive"));
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
								<div class="col-md-9 col-md-offset-3">
									<input type="hidden" name="submitform" id="submitform" value="submit">	
									<button type="button" onclick="formValidate('form1')" class="btn btn-primary btn-md">Save</button>
									&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-danger btn-md" onclick="history.go(-1)">Cancel</button>
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
