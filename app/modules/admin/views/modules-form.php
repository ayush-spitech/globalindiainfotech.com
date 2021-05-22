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
					if(isset($aContentInfo->module_id)){
						$edit_id=$aContentInfo->module_id;
					}
					$attribute=array("id"=>"form2","method"=>"post","class"=>"form-horizontal");
					echo form_open('',$attribute);
					echo form_hidden('module_id',$edit_id);
					?>
					<fieldset>						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Module Group');?><span class="required">*</span></label>
							<div class="col-md-3">
								<?php 
								$group_id='';
								if(isset($_POST['group_id'])){
									$group_id=$_POST['group_id'];
								}else if(isset($aContentInfo->group_id)){
									$group_id=$aContentInfo->group_id;
								}
								$aOption=array(''=>'Select Module Group');
								if(isset($aModuleGroup) && is_array($aModuleGroup) && !empty($aModuleGroup)){
									foreach ($aModuleGroup as $key => $value) {
										$aOption[$value->group_id]=$value->title;
									}
								}
								$attribute='id="group_id" class="form-control" validate="Required" ';
								echo form_dropdown('group_id',$aOption,$group_id,$attribute);
								?>
								<div class="error" id="error_group_id"></div>
							</div>								
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Module Name');?><span class="required">*</span></label>
							<div class="col-md-3">
								<?php 
								$title='';
								if(isset($_POST['title'])){
									$title=$_POST['title'];
								}else if(isset($aContentInfo->title)){
									$title=$aContentInfo->title;
								}?>
								<input type="text" id="title" name="title"  class="form-control" placeholder="<?php echo lang('Module Name')?>" value="<?php echo $title?>">
								<div id="error_title" class="error"><?php echo form_error('title')?></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Icon');?><span class="required">*</span></label>
							<div class="col-md-3">
								<?php 
								$icon='glyphicon glyphicon-th';
								if(isset($_POST['icon'])){
									$icon=$_POST['icon'];
								}else if(isset($aContentInfo->icon) && trim($aContentInfo->icon)!=''){
									$icon=$aContentInfo->icon;
								}?>
								<input type="text" id="icon" name="icon"  class="form-control" placeholder="<?php echo lang('Module Icon')?>" value="<?php echo $icon?>">
								<span class="small-text">glyphicon glyphicon-th</span>
								<div id="error_icon" class="error"><?php echo form_error('icon')?></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Module Url');?><span class="required">*</span></label>
							<div class="col-md-3">
								<?php 
								$url='';
								if(isset($_POST['url'])){
									$url=$_POST['url'];
								}else if(isset($aContentInfo->url)){
									$url=$aContentInfo->url;
								}?>
								<input type="text" id="url" name="url"  class="form-control" placeholder="<?php echo lang('Module Url')?>" value="<?php echo $url?>">
								<div id="error_url" class="error"><?php echo form_error('url')?></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Status');?><span class="required">*</span></label>
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
								<div id="error_status" class="error"><?php echo form_error('status')?></div>
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
