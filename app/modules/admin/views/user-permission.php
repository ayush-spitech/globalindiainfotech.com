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
				<div class="panel-heading"><?php echo $title;?> : Permission Settings</div>
				<div class="panel-body">
					<?php show_message(); ?>
					<div align="center">
						<?php
						$attribute = array("height" => "40px", "width" => "40px", "class" => "img-circle");
						//getimg($aContentInfo->photo, $attribute);
						?>
						<h3 style="text-align:center"><?php echo $aContentInfo->name; ?></h3>
						<?php 
						$attribute=array("id"=>"form1","method"=>"post","class"=>"form-horizontal");
						echo form_open('',$attribute);						
						?>				
							<input type="hidden" name="user_id" id='user_id' value="<?php echo $aContentInfo->user_id; ?>"/>
							<table  style="width:100%" class="table table-bordered">
								<thead>
									<tr class="info">
										<th width="3%">#</th>
										<th width="20%">Module</th>
										<th style="text-align: center;">Sub-module Permissions</th>
									</tr>
								</thead>
								<tbody>
									<?php
                    //debug($aUserMenu);
									if (isset($aUserMenu) && is_array($aUserMenu) && !empty($aUserMenu)) {
										$i = 1;
										$j = 0;
										foreach ($aUserMenu as $data) {
                        // debug($data);
											$aModules = $data->aModules;
											?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td><?php echo $data->title; ?></td>
												<td style="padding: 0px;">

													<table  style="width:100%; margin-bottom: 0px;" class="table table-bordered" id="user_tbl">
														<thead>
															<tr class="info">
																<th width="20%">Sub-Module</th>
																<th width="5%" style="text-align: center;">Access</th>
																<th width="5%" style="text-align: center;">Add</th>
																<th width="5%" style="text-align: center;">Edit</th>
																<th width="5%" style="text-align: center;">Export</th>
																<th width="5%" style="text-align: center;">Delete</th>
															</tr>
														</thead>
														<tbody>
															<?php
															if (!empty($aModules)) {

																foreach ($aModules as $data1) {
																	$aWhere = array("module_id" => $data1->module_id, "user_id" => $user_id);
																	$aPermission = get_row('user_permission', $aWhere);
                                    //debug($aPermission);
									$aPermission=(array)$aPermission;
																	?>
																	<input type="hidden" name="module_id[]" value="<?php echo $data1->module_id; ?>" />
																	<tr>
																		<td style="text-align: left;"><?php echo $data1->title; ?></td>
																		<td style="text-align: center;"><input type="checkbox" <?php checked($aPermission['view_permission'], '1'); ?> value="1" name="access<?php echo $j; ?>" id="access<?php echo $j; ?>" /></td>
																		<td style="text-align: center;"><input type="checkbox" <?php checked($aPermission['add_permission'], '1'); ?> value="1" name="add<?php echo $j; ?>" id="add<?php echo $j; ?>" /></td>
																		<td style="text-align: center;"><input type="checkbox" <?php checked($aPermission['edit_permission'], '1'); ?> value="1" name="edit<?php echo $j; ?>" id="edit<?php echo $j; ?>" /></td>
																		<td style="text-align: center;"><input type="checkbox" <?php checked($aPermission['export_permission'], '1'); ?> value="1" name="export<?php echo $j; ?>" id="export<?php echo $j; ?>" /></td>
																		<td style="text-align: center;"><input type="checkbox" <?php checked($aPermission['delete_permission'], '1'); ?> value="1" name="delete<?php echo $j; ?>" id="delete<?php echo $j; ?>" /></td>
																	</tr>
																	<?php
																	$j++;
																}
															}
															?>
														</tbody>
													</table>

												</td>
											</tr>
											<?php
										}
									}
									?>
								</tbody>
							</table>
							<input type="submit" class="btn btn-success btn-flat" value="Save Permissions" name="submit" />
						<?php echo form_close();?>	
					</div>
				</div>
			</div>
		</div><!--/.row-->

	</div>	<!--/.main-->	
	<?php include_once('partials/footer-js.php');?>
	
	<?php include_once('partials/footer-admin.php');?>
