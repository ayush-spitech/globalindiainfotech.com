<?php include_once('partials/header-admin.php');?>	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>			
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Manage')?></div>
				<div class="panel-body">
					<?php 					
					//debug($this->config);
					$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal",'enctype'=>'multipart/form-data');
					echo form_open('',$attribute);
					?>
					<fieldset>	
						<div class="text-center">
							<span class="hide">Testing Value : <?php echo config_money(120050);?><br/></span>
							<?php echo show_message();?>							
						</div>
						<div class="col-sm-7 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading"><?php echo lang('Logo Settings')?></div>
								<div class="panel-body">
									<div class="form-group">
										
										<div class="col-md-8 image-upload" title="<?php echo lang('Click on image to browse image')?>">
											<div><label><?php echo lang('Site Logo')?>
												<span class="required">*</span></label>
											</div>
											<?php 
											$site_logo='';
											$validate_image='validate="Required"';
											if(isset($aContentInfo->site_logo)){
												$site_logo=$aContentInfo->site_logo;
												$validate_image='';
											}?>
											<label for="site_logo">
												<?php
												$attribute=array('id'=>'site_logo_preview','height'=>'100','width'=>'300','alt'=>'site_logo'); 
												show_image($site_logo,$attribute);
												?>
											</label>	
											<input type="hidden" name="old_site_logo" value="<?php echo $site_logo?>">									
											<input id="site_logo" name="site_logo" onchange="previewImg(this,'site_logo_preview')" <?php echo $validate_image?> type="file">
											<div class="text-hint"><?php echo lang('Click on image to browse image')?></div>
											<div class="error" id="error_site_logo"></div>
										</div>																


										<div class="col-md-4 image-upload" title="<?php echo lang('Click on image to browse image')?>">
											<div><label><?php echo lang('Favicon')?>
												<span class="required">*</span></label>
											</div>
											<?php 
											$site_favicon='';
											$validate_image='validate="Required"';
											if(isset($aContentInfo->site_favicon)){
												$site_favicon=$aContentInfo->site_favicon;
												$validate_image='';
											}?>
											<label for="site_favicon">
												<?php
												$attribute=array('id'=>'site_favicon_preview','height'=>'50','width'=>'50','alt'=>'site_favicon'); 
												show_image($site_favicon,$attribute);
												?>
											</label>
											<input type="hidden" name="old_site_favicon" value="<?php echo $site_favicon?>">									
											<input id="site_favicon" name="site_favicon" onchange="previewImg(this,'site_favicon_preview')" <?php echo $validate_image?> type="file">
											<div class="text-hint"><?php echo lang('Click on image to browse image')?></div>
											<div class="error" id="error_site_favicon"></div>
										</div>																
									</div>	

									</div>
									</div>
									<div class="panel panel-primary">
								<div class="panel-heading"><?php echo lang('General Settings')?></div>
								<div class="panel-body">									

									<div class="form-group">
										<label class="col-md-4"><?php echo lang('Date Format')?><span class="required">*</span></label>
										<div class="col-md-8">
											<?php 
											$date_format='';
											if(isset($_POST['date_format'])){
												$date_format=$_POST['date_format'];
											}else if(isset($aContentInfo->date_format)){
												$date_format=$aContentInfo->date_format;
											}
											$aOption=get_date_format();
											$attribute='validate="Required" id="date_format" class="form-control"';
											echo form_dropdown('date_format',$aOption,$date_format,$attribute);
											?>									
											<div id="error_date_format" class="error"><?php echo form_error('date_format')?></div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 "><?php echo lang('Site Url')?><span class="required">*</span></label>
										<div class="col-md-8">
											<?php 
											$site_url='';
											if(isset($_POST['site_url'])){
												$site_url=$_POST['site_url'];
											}else if(isset($aContentInfo->site_url)){
												$site_url=$aContentInfo->site_url;
											}?>
											<input validate="Required|Url" id="site_url" name="site_url"  type="text" class="form-control" placeholder="<?php echo lang('Site Url With http://')?>" value="<?php echo $site_url?>">
											<div id="error_site_url" class="error"><?php echo form_error('site_url')?></div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 "><?php echo lang('Site Name')?>
											<span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$site_name='';
												if(isset($_POST['site_name'])){
													$site_name=$_POST['site_name'];
												}else if(isset($aContentInfo->site_name)){
													$site_name=$aContentInfo->site_name;
												}?>
												<input id="site_name" name="site_name" validate="Required" type="text" placeholder="<?php echo lang('Site Name')?>" class="form-control" value="<?php echo $site_name?>">
												<div class="error" id="error_site_name"></div>
											</div>
										</div>											

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Site Email')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$site_email='';
												if(isset($_POST['site_email'])){
													$site_email=$_POST['site_email'];
												}else if(isset($aContentInfo->site_email)){
													$site_email=$aContentInfo->site_email;
												}?>
												<input validate="Required|Email" id="site_email" name="site_email"  type="text" class="form-control" placeholder="<?php echo lang('Site Email')?>" value="<?php echo $site_email?>">
												<div id="error_site_email" class="error"><?php echo form_error('site_email')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Site Contact')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$site_contact='';
												if(isset($_POST['site_contact'])){
													$site_contact=$_POST['site_contact'];
												}else if(isset($aContentInfo->site_contact)){
													$site_contact=$aContentInfo->site_contact;
												}?>
												<input validate="Required|Phone" id="site_contact" name="site_contact"  type="text" class="form-control" placeholder="<?php echo lang('Site Contact')?>" value="<?php echo $site_contact?>">
												<div id="error_site_contact" class="error"><?php echo form_error('site_contact')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Site Address')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$site_address='';
												if(isset($_POST['site_address'])){
													$site_address=$_POST['site_address'];
												}else if(isset($aContentInfo->site_address)){
													$site_address=$aContentInfo->site_address;
												}?>
												<textarea validate="Required" id="site_address" name="site_address"  type="text" class="form-control" placeholder="<?php echo lang('Site Address')?>" ><?php echo $site_address?></textarea> 
												<div id="error_site_address" class="error"><?php echo form_error('site_address')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Decimal Seperator')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$decimal_seperator='';
												if(isset($_POST['decimal_seperator'])){
													$decimal_seperator=$_POST['decimal_seperator'];
												}else if(isset($aContentInfo->decimal_seperator)){
													$decimal_seperator=$aContentInfo->decimal_seperator;
												}?>
												<input validate="Required" id="decimal_seperator" name="decimal_seperator"  type="text" class="form-control" placeholder="<?php echo lang('Decimal Seperator')?>" value="<?php echo $decimal_seperator?>">
												<div id="error_decimal_seperator" class="error"><?php echo form_error('decimal_seperator')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Thousand Seperator')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$thousand_seperator='';
												if(isset($_POST['thousand_seperator'])){
													$thousand_seperator=$_POST['thousand_seperator'];
												}else if(isset($aContentInfo->thousand_seperator)){
													$thousand_seperator=$aContentInfo->thousand_seperator;
												}?>
												<input validate="Required" id="thousand_seperator" name="thousand_seperator"  type="text" class="form-control" placeholder="<?php echo lang('Thousand Seperator')?>" value="<?php echo $thousand_seperator?>">
												<div id="error_thousand_seperator" class="error"><?php echo form_error('thousand_seperator')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Decimal Places')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$decimal_places='';
												if(isset($_POST['decimal_places'])){
													$decimal_places=$_POST['decimal_places'];
												}else if(isset($aContentInfo->decimal_places)){
													$decimal_places=$aContentInfo->decimal_places;
												}?>
												<input validate="Required" id="decimal_places" name="decimal_places"  type="text" class="form-control" placeholder="<?php echo lang('Decimal Places')?>" value="<?php echo $decimal_places?>">
												<div id="error_decimal_places" class="error"><?php echo form_error('decimal_places')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Currency Symbol')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$currency='';
												if(isset($_POST['currency'])){
													$currency=$_POST['currency'];
												}else if(isset($aContentInfo->currency)){
													$currency=$aContentInfo->currency;
												}?>
												<input validate="Required" id="currency" name="currency"  type="text" class="form-control" placeholder="<?php echo lang('Currency')?>" value="<?php echo $currency?>">
												<div id="error_currency" class="error"><?php echo form_error('currency')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Currency Placement')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$currency_placement='';
												if(isset($_POST['currency_placement'])){
													$currency_placement=$_POST['currency_placement'];
												}else if(isset($aContentInfo->currency_placement)){
													$currency_placement=$aContentInfo->currency_placement;
												}
												$aOption=array(
													''=>lang('Select Currency Placement'),
													'before'=>lang('Before'),
													'after'=>lang('After')
												);
												$attribute='validate="Required" id="currency_placement" class="form-control"';
												echo form_dropdown('currency_placement',$aOption,$currency_placement,$attribute);
												?>										
												<div id="error_currency_placement" class="error"><?php echo form_error('currency_placement')?></div>
											</div>
										</div>


										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Registration Date')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$reg_date='';
												if(isset($_POST['reg_date'])){
													$reg_date=$_POST['reg_date'];
												}else if(isset($aContentInfo->reg_date)){
													$reg_date=$aContentInfo->reg_date;
												}?>
												<input validate="Required" id="reg_date" name="reg_date"  type="text" class="form-control date" placeholder="<?php echo lang('Registration Date')?>" value="<?php echo $reg_date?>">
												<div id="error_reg_date" class="error"><?php echo form_error('reg_date')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Is Underconstruction?')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$is_underconstruction='';
												if(isset($_POST['is_underconstruction'])){
													$is_underconstruction=$_POST['is_underconstruction'];
												}else if(isset($aContentInfo->is_underconstruction)){
													$is_underconstruction=$aContentInfo->is_underconstruction;
												}
												$aOption=array('0'=>"No","1"=>"Yes");
												$attribute='validate="Required" id="is_underconstruction" class="form-control"';
												echo form_dropdown('is_underconstruction',$aOption,$is_underconstruction,$attribute);
												?>												
												<div id="error_is_underconstruction" class="error"><?php echo form_error('is_underconstruction')?></div>
											</div>
										</div>


										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Expiry Date')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$expiry_date='';
												if(isset($_POST['expiry_date'])){
													$expiry_date=$_POST['expiry_date'];
												}else if(isset($aContentInfo->expiry_date)){
													$expiry_date=$aContentInfo->expiry_date;
												}?>
												<input validate="Required" id="expiry_date" name="expiry_date"  type="text" class="form-control date" placeholder="<?php echo lang('Expiry Date')?>" value="<?php echo $expiry_date?>">
												<div id="error_expiry_date" class="error"><?php echo form_error('expiry_date')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Is Suspeneded?')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$is_suspended='';
												if(isset($_POST['is_suspended'])){
													$is_suspended=$_POST['is_suspended'];
												}else if(isset($aContentInfo->is_suspended)){
													$is_suspended=$aContentInfo->is_suspended;
												}
												$aOption=array('0'=>"No","1"=>"Yes");
												$attribute='validate="Required" id="is_suspended" class="form-control"';
												echo form_dropdown('is_suspended',$aOption,$is_suspended,$attribute);
												?>												
												<div id="error_is_suspended" class="error"><?php echo form_error('is_suspended')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('App Version')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$version='';
												if(isset($_POST['version'])){
													$version=$_POST['version'];
												}else if(isset($aContentInfo->currency_placement)){
													$version=$aContentInfo->version;
												}?>
												<input validate="Required" id="version" name="version"  type="text" class="form-control" placeholder="<?php echo lang('App Version')?>" value="<?php echo $version?>">
												<div id="error_version" class="error"><?php echo form_error('version')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Listing Count')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$record_limit='';
												if(isset($_POST['record_limit'])){
													$record_limit=$_POST['record_limit'];
												}else if(isset($aContentInfo->record_limit)){
													$record_limit=$aContentInfo->record_limit;
												}?>
												<input validate="Required" id="record_limit" name="record_limit"  type="text" class="form-control" placeholder="<?php echo lang('Record Listing Count')?>" value="<?php echo $record_limit?>">
												<div id="error_record_limit" class="error"><?php echo form_error('record_limit')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Is Multilingual?')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$is_multilingual='';
												if(isset($_POST['is_multilingual'])){
													$is_multilingual=$_POST['is_multilingual'];
												}else if(isset($aContentInfo->is_multilingual)){
													$is_multilingual=$aContentInfo->is_multilingual;
												}
												$aOption=array('0'=>"No","1"=>"Yes");
												$attribute='validate="Required" id="is_multilingual" class="form-control"';
												echo form_dropdown('is_multilingual',$aOption,$is_multilingual,$attribute);
												?>												
												<div id="error_is_multilingual" class="error"><?php echo form_error('is_multilingual')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Default Language')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$language='english';
												if(isset($_POST['language'])){
													$language=$_POST['language'];
												}else if(isset($aContentInfo->language)){
													$language=$aContentInfo->language;
												}
												$aOption=array();
												if(isset($aLangugae) && is_array($aLangugae) && !empty($aLangugae))
												{
													foreach ($aLangugae as $row) {
														$aOption[$row->language]=strtoupper($row->language);
													}
												}
												$attribute='validate="Required" id="language" class="form-control"';
												echo form_dropdown('language',$aOption,$language,$attribute);
												?>												
												<div id="error_language" class="error"><?php echo form_error('language')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Financial Year')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$financial_year='';
												if(isset($_POST['financial_year'])){
													$financial_year=$_POST['financial_year'];
												}else if(isset($aContentInfo->financial_year)){
													$financial_year=$aContentInfo->financial_year;
												}
												$aOption=get_financial_year();
												$attribute='validate="Required" id="financial_year" class="form-control"';
												echo form_dropdown('financial_year',$aOption,$financial_year,$attribute);
												?>											
												<div id="error_financial_year" class="error"><?php echo form_error('financial_year')?></div>
											</div>
										</div>
									</div>
								</div>


							</div>
							<div class="col-sm-5 col-xs-12">
								<!--Email Setting Box-->
								<div class="panel panel-primary">
									<div class="panel-heading"><?php echo lang('Email Setting')?></div>
									<div class="panel-body">
										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('SMTP Server')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$smtp_server='';
												if(isset($_POST['smtp_server'])){
													$smtp_server=$_POST['smtp_server'];
												}else if(isset($aContentInfo->smtp_server)){
													$smtp_server=$aContentInfo->smtp_server;
												}?>
												<input validate="Required" id="smtp_server" name="smtp_server"  type="text" class="form-control" placeholder="<?php echo lang('SMTP Server')?>" value="<?php echo $smtp_server?>">
												<div id="error_smtp_server" class="error"><?php echo form_error('smtp_server')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('SMTP Port')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$smtp_port='';
												if(isset($_POST['smtp_port'])){
													$smtp_port=$_POST['smtp_port'];
												}else if(isset($aContentInfo->smtp_port)){
													$smtp_port=$aContentInfo->smtp_port;
												}?>
												<input validate="Required" id="smtp_port" name="smtp_port"  type="text" class="form-control" placeholder="<?php echo lang('SMTP Port')?>" value="<?php echo $smtp_port?>">
												<div id="error_smtp_port" class="error"><?php echo form_error('smtp_port')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('SMTP User')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$smtp_user='';
												if(isset($_POST['smtp_user'])){
													$smtp_user=$_POST['smtp_user'];
												}else if(isset($aContentInfo->smtp_user)){
													$smtp_user=$aContentInfo->smtp_user;
												}?>
												<input validate="Required|Email" id="smtp_user" name="smtp_user"  type="text" class="form-control" placeholder="<?php echo lang('SMTP User')?>" value="<?php echo $smtp_user?>">
												<div id="error_smtp_user" class="error"><?php echo form_error('smtp_user')?></div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('SMTP Pass')?><span class="required">*</span></label>
											<div class="col-md-8">
												<?php 
												$smtp_pass='';
												if(isset($_POST['smtp_pass'])){
													$smtp_pass=$_POST['smtp_pass'];
												}else if(isset($aContentInfo->smtp_pass)){
													$smtp_pass=$aContentInfo->smtp_pass;
												}?>
												<input validate="Required" id="smtp_pass" name="smtp_pass"  type="text" class="form-control" placeholder="<?php echo lang('SMTP Pass')?>" value="<?php echo $smtp_pass?>">
												<div id="error_smtp_pass" class="error"><?php echo form_error('smtp_pass')?></div>
											</div>
										</div>

									</div>
								</div>
								<!--Bulk SMS Setting Box-->
								<div class="panel panel-primary">
									<div class="panel-heading"><?php echo lang('Bulk SMS Setting')?></div>
									<div class="panel-body">
										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('API Url')?></label>
											<div class="col-md-8">
												<?php 
												$bulk_sms_url='';
												if(isset($_POST['bulk_sms_url'])){
													$bulk_sms_url=$_POST['bulk_sms_url'];
												}else if(isset($aContentInfo->bulk_sms_url)){
													$bulk_sms_url=$aContentInfo->bulk_sms_url;
												}?>
												<input id="bulk_sms_url" name="bulk_sms_url"  type="text" class="form-control" placeholder="<?php echo lang('API Url')?>" value="<?php echo $bulk_sms_url?>">	
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Sender Id')?></label>
											<div class="col-md-8">
												<?php 
												$bulk_sms_sender_id='';
												if(isset($_POST['bulk_sms_sender_id'])){
													$bulk_sms_sender_id=$_POST['bulk_sms_sender_id'];
												}else if(isset($aContentInfo->bulk_sms_sender_id)){
													$bulk_sms_sender_id=$aContentInfo->bulk_sms_sender_id;
												}?>
												<input  id="bulk_sms_sender_id" name="bulk_sms_sender_id"  type="text" class="form-control" placeholder="<?php echo lang('Sender Id')?>" value="<?php echo $bulk_sms_sender_id?>">
											</div>
										</div>



										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Username')?></label>
											<div class="col-md-8">
												<?php 
												$bulk_sms_username='';
												if(isset($_POST['bulk_sms_username'])){
													$bulk_sms_username=$_POST['bulk_sms_username'];
												}else if(isset($aContentInfo->bulk_sms_username)){
													$bulk_sms_username=$aContentInfo->bulk_sms_username;
												}?>
												<input id="bulk_sms_username" name="bulk_sms_username"  type="text" class="form-control" placeholder="<?php echo lang('Username')?>" value="<?php echo $bulk_sms_username?>">	
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Password')?></label>
											<div class="col-md-8">
												<?php 
												$bulk_sms_pass='';
												if(isset($_POST['bulk_sms_pass'])){
													$bulk_sms_pass=$_POST['bulk_sms_pass'];
												}else if(isset($aContentInfo->bulk_sms_pass)){
													$bulk_sms_pass=$aContentInfo->bulk_sms_pass;
												}?>
												<input id="bulk_sms_pass" name="bulk_sms_pass"  type="text" class="form-control" placeholder="<?php echo lang('Password')?>" value="<?php echo $bulk_sms_pass?>">	
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-4">
												<?php 
												$bulk_sms_param1='';
												if(isset($_POST['bulk_sms_param1'])){
													$bulk_sms_param1=$_POST['bulk_sms_param1'];
												}else if(isset($aContentInfo->bulk_sms_param1)){
													$bulk_sms_param1=$aContentInfo->bulk_sms_param1;
												}?>
												<input id="bulk_sms_param1" name="bulk_sms_param1"  type="text" class="form-control" placeholder="<?php echo lang('Parameter')?>1" value="<?php echo $bulk_sms_param1?>">
											</div>
											<div class="col-md-8">
												<?php 
												$bulk_sms_param_value1='';
												if(isset($_POST['bulk_sms_param_value1'])){
													$bulk_sms_param_value1=$_POST['bulk_sms_param_value1'];
												}else if(isset($aContentInfo->bulk_sms_param_value1)){
													$bulk_sms_param_value1=$aContentInfo->bulk_sms_param_value1;
												}?>
												<input  id="bulk_sms_param_value1" name="bulk_sms_param_value1"  type="text" class="form-control" placeholder="<?php echo lang('Value')?>1" value="<?php echo $bulk_sms_param_value1?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-4">
												<?php 
												$bulk_sms_param2='';
												if(isset($_POST['bulk_sms_param2'])){
													$bulk_sms_param2=$_POST['bulk_sms_param2'];
												}else if(isset($aContentInfo->bulk_sms_param2)){
													$bulk_sms_param2=$aContentInfo->bulk_sms_param2;
												}?>
												<input  id="bulk_sms_param2" name="bulk_sms_param2"  type="text" class="form-control" placeholder="<?php echo lang('Parameter')?>2" value="<?php echo $bulk_sms_param2?>">
											</div>
											<div class="col-md-8">
												<?php 
												$bulk_sms_param_value2='';
												if(isset($_POST['bulk_sms_param_value2'])){
													$bulk_sms_param_value2=$_POST['bulk_sms_param_value2'];
												}else if(isset($aContentInfo->bulk_sms_param_value2)){
													$bulk_sms_param_value2=$aContentInfo->bulk_sms_param_value2;
												}?>
												<input id="bulk_sms_param_value2" name="bulk_sms_param_value2"  type="text" class="form-control" placeholder="<?php echo lang('Value')?>2" value="<?php echo $bulk_sms_param_value2?>">	
											</div>
										</div>
										<div class="form-group">											
											<div class="col-md-4">
												<?php 
												$bulk_sms_param3='';
												if(isset($_POST['bulk_sms_param3'])){
													$bulk_sms_param3=$_POST['bulk_sms_param3'];
												}else if(isset($aContentInfo->bulk_sms_param3)){
													$bulk_sms_param3=$aContentInfo->bulk_sms_param3;
												}?>
												<input id="bulk_sms_param3" name="bulk_sms_param3"  type="text" class="form-control" placeholder="<?php echo lang('Parameter')?>3" value="<?php echo $bulk_sms_param3?>">
											</div>
											<div class="col-md-8">
												<?php 
												$bulk_sms_param_value3='';
												if(isset($_POST['bulk_sms_param_value3'])){
													$bulk_sms_param_value3=$_POST['bulk_sms_param_value3'];
												}else if(isset($aContentInfo->bulk_sms_param_value3)){
													$bulk_sms_param_value3=$aContentInfo->bulk_sms_param_value3;
												}?>
												<input  id="bulk_sms_param_value3" name="bulk_sms_param_value3"  type="text" class="form-control" placeholder="<?php echo lang('Value')?>3" value="<?php echo $bulk_sms_param_value3?>">	
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-4">
												<?php 
												$bulk_sms_param4='';
												if(isset($_POST['bulk_sms_param4'])){
													$bulk_sms_param4=$_POST['bulk_sms_param4'];
												}else if(isset($aContentInfo->bulk_sms_param4)){
													$bulk_sms_param4=$aContentInfo->bulk_sms_param4;
												}?>
												<input id="bulk_sms_param4" name="bulk_sms_param4"  type="text" class="form-control" placeholder="<?php echo lang('Parameter')?>4" value="<?php echo $bulk_sms_param4?>">
											</div>
											<div class="col-md-8">
												<?php 
												$bulk_sms_param_value4='';
												if(isset($_POST['bulk_sms_param_value4'])){
													$bulk_sms_param_value4=$_POST['bulk_sms_param_value4'];
												}else if(isset($aContentInfo->bulk_sms_param_value4)){
													$bulk_sms_param_value4=$aContentInfo->bulk_sms_param_value4;
												}?>
												<input id="bulk_sms_param_value4" name="bulk_sms_param_value4"  type="text" class="form-control" placeholder="<?php echo lang('Value')?>4" value="<?php echo $bulk_sms_param_value4?>">
											</div>
										</div>

									</div>
								</div>

								<!--Social Network Setting Box-->
								<div class="panel panel-primary">
									<div class="panel-heading"><?php echo lang('Social Network Setting')?></div>
									<div class="panel-body">
										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Facebook Page')?></label>
											<div class="col-md-8">
												<?php 
												$facebook='';
												if(isset($_POST['facebook'])){
													$facebook=$_POST['facebook'];
												}else if(isset($aContentInfo->facebook)){
													$facebook=$aContentInfo->facebook;
												}?>
												<input  id="facebook" name="facebook"  type="text" class="form-control" placeholder="<?php echo lang('Facebook Page')?>" value="<?php echo $facebook?>">	
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Twiter Page')?></label>
											<div class="col-md-8">
												<?php 
												$twitter='';
												if(isset($_POST['twitter'])){
													$twitter=$_POST['twitter'];
												}else if(isset($aContentInfo->twitter)){
													$twitter=$aContentInfo->twitter;
												}?>
												<input id="twitter" name="twitter"  type="text" class="form-control" placeholder="<?php echo lang('Twiter Page')?>" value="<?php echo $twitter?>">	
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Google Plus')?></label>
											<div class="col-md-8">
												<?php 
												$google_plus='';
												if(isset($_POST['google_plus'])){
													$google_plus=$_POST['google_plus'];
												}else if(isset($aContentInfo->google_plus)){
													$google_plus=$aContentInfo->google_plus;
												}?>
												<input  id="google_plus" name="google_plus"  type="text" class="form-control" placeholder="<?php echo lang('Google Plus')?>" value="<?php echo $google_plus?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Linked In')?></label>
											<div class="col-md-8">
												<?php 
												$linkdin='';
												if(isset($_POST['linkdin'])){
													$linkdin=$_POST['linkdin'];
												}else if(isset($aContentInfo->linkdin)){
													$linkdin=$aContentInfo->linkdin;
												}?>
												<input  id="linkdin" name="linkdin"  type="text" class="form-control" placeholder="<?php echo lang('Linked In')?>" value="<?php echo $linkdin?>">	
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-4 "><?php echo lang('Youtube')?></label>
											<div class="col-md-8">
												<?php 
												$youtube='';
												if(isset($_POST['youtube'])){
													$youtube=$_POST['youtube'];
												}else if(isset($aContentInfo->youtube)){
													$youtube=$aContentInfo->youtube;
												}?>
												<input id="youtube" name="youtube"  type="text" class="form-control" placeholder="<?php echo lang('Youtube')?>" value="<?php echo $youtube?>">
											</div>
										</div>

									</div>
								</div>
								<!--Google Analytics Setting Box-->
								<div class="panel panel-primary">
									<div class="panel-heading"><?php echo lang('Google Analytics')?></div>
									<div class="panel-body">
										<div class="form-group">
											<div class="col-md-12">
												<?php 
												$google_analytics_code='';
												if(isset($_POST['google_analytics_code'])){
													$google_analytics_code=$_POST['google_analytics_code'];
												}else if(isset($aContentInfo->google_analytics_code)){
													$google_analytics_code=$aContentInfo->google_analytics_code;
												}?>
												<textarea rows="10" id="google_analytics_code" name="google_analytics_code" class="form-control"><?php echo $google_analytics_code?></textarea>
											</div>
										</div>											
									</div>
								</div>
							</div>

							<!-- Form actions -->
							<div class="form-group" >
								<div class="col-md-4">
								</div>
								<div class="col-md-9 error" id="errorMessages">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-3">
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
