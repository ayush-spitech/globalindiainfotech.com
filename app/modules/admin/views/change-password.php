<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>dashboard/"><span class="glyphicon glyphicon-home"></span></a></li>
			<li class="active"><?php echo $title;?> : Manage</li>
		</ol>
	</div><!--/.row-->		
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : Manage</div>
				<div class="panel-body">
					<?php show_message();?>
					<?php 
					$edit_id=0;
					$activeClass='';
					if(isset($aContentInfo->user_id)){
						$edit_id=$aContentInfo->user_id;
						$activeClass='hide';
					}
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
					echo form_open('',$attribute);
					echo form_hidden('user_id',$edit_id);
					?>
					<fieldset>
						<div class="form-group">
							<label class="col-md-3 control-label">Old Password
								<span class="required">*</span></label>
								<div class="col-md-6">
									<?php 
									$password='';
									if(isset($_POST['password'])){
										$password=$_POST['password'];
									}else if(isset($aContentInfo->password)){
										$password=$aContentInfo->password;
									}?>
									<input id="password" name="password" validate="Required" type="password" placeholder="Old Password" class="form-control" value="<?php echo $password?>">
									<div class="error" id="error_password"></div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">New Password
									<span class="required">*</span></label>
									<div class="col-md-6">
										<?php 
										$new_password='';
										if(isset($_POST['new_password'])){
											$new_password=$_POST['new_password'];
										}?>
										<input id="new_password" name="new_password" validate="Required" type="password" placeholder="New Password" class="form-control" value="<?php echo $new_password?>">
										<div class="error" id="error_new_password"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Re Password
										<span class="required">*</span></label>
										<div class="col-md-6">
											<?php 
											$re_password='';
											if(isset($_POST['re_password'])){
												$re_password=$_POST['re_password'];
											}?>
											<input id="re_password" name="re_password" validate="Required" type="password" placeholder="Re Password" class="form-control" value="<?php echo $re_password?>">
											<div class="error" id="error_re_password"></div>
										</div>
									</div>


									<!-- Form actions -->
									<div class="form-group" >								
										<div class="col-md-9 col-md-offset-3 error" id="errorMessages">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-3">
											<input type="hidden" name="submitform" id="submitform" value="submit">	
											<button type="button" onclick="formValidate('form1')" class="btn btn-primary btn-md">Save</button>
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
