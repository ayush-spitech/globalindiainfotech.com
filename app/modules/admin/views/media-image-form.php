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
					if(isset($aContentInfo->media_id)){
						$edit_id=$aContentInfo->image_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal","enctype"=>"multipart/form-data");
					echo form_open('',$attribute);
					echo form_hidden('image_id',$edit_id);
					echo form_hidden('media_id',$aContentInfo->media_id);
					?>
					<fieldset>	
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Media Category')?>
								</label>
								<div class="col-md-6">
									<?php 
									$title=$aContentInfo->title;
									?>
									<input disabled="disabled"  type="text" placeholder="<?php echo lang('Media Category')?>" class="form-control" value="<?php echo $title?>">									
								</div>
							</div>							
							
							<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Image Caption')?><span class="required">*</span>
								</label>
								<div class="col-md-6">
									<?php 
									$caption='';
									if(isset($_POST['caption'])){
										$caption=$_POST['caption'];
									}
									?>
									<input id="title" name="title" value="<?php echo $caption?>" type="text" placeholder="<?php echo lang('Image Caption')?>" class="form-control" validate="Required">	
									<div id="error_title"></div>
								</div>
							</div>	

							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo lang('Browse Image')?><span class="required">*</span></label>
								<div class="col-md-6">
									<input type="file" name="image" id="image" validate="Required">
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
