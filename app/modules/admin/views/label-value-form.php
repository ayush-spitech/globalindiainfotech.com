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
					//debug($aContentInfo);
					if(isset($aContentInfo->banner_id)){
						$edit_id=$aContentInfo->banner_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open_multipart('',$attribute);
					echo form_hidden('banner_id',$edit_id);
					?>
					<fieldset>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3"><?php show_message()?></div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo lang('Select Language')?>
								<span class="required">*</span></label>
								<div class="col-md-3">
									<?php 
									$language_id=$language_id;
									$aLang=$this->common_model->get_languages();	
									$aOption=array();			
									if(isset($aLang) && is_array($aLang) && !empty($aLang)){
										foreach ($aLang as $key => $value) {
											$aOption[$value->language_id]=strtoupper($value->language);
										}
									}
									$attribute='id="language_id" class="form-control" onchange="load_language()"';
									echo form_dropdown('language_id',$aOption,$language_id,$attribute);
									?>	
								</div>							
								<div class="col-md-6">
									<input type="hidden" name="submitform" id="submitform" value="submit">	
									<button type="button" onclick="formValidate('form1')" class="btn btn-primary btn-md"><?php echo lang('Save All')?></button>
									&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-danger btn-md" onclick="history.go(-1)"><?php echo lang('Cancel')?></button>
								</div>
							</div>
							<?php 
							foreach ($aGrid as $key => $value) {
								$label_id=$value->label_id;
								$label=$value->label;
								$label_value=$value->value;								
								?>
								<div class="form-group">
									<input type="hidden" name="aLabelId[]" value="<?php echo $label_id?>">
									<div class="col-md-4 col-xs-12">
										<input type="text" class="form-control" name="aLabel[]" value="<?php echo $label;?>">
									</div>
									<div class="col-md-8 col-xs-12">										
										<input type="text" class="form-control" name="aValue[]" value="<?php echo $label_value;?>">
									</div>
								</div>
								<?php
							}
							?>
						</fieldset>
						<?php echo form_close();?>	
					</div>
				</div>
			</div><!--/.row-->

		</div>	<!--/.main-->	
		<?php include_once('partials/footer-js.php');?>		
		<script type="text/javascript">
			function load_language(){
				var lang=$('#language_id').val();
				window.location=BASE_URL+'admin_language/add/'+lang;
			}
		</script>	
		<?php include_once('partials/footer-admin.php');?>
