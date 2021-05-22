<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Listing')?></div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form(array('from_date'=>1,'to_date'=>1),$moduleUrl,'Search Template Name,From Name,From Email',1,'message_template_add');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="15%"><?php echo lang('Template');?></th>
									<th width="25%"><?php echo lang('Subject');?></th>
									<th width="15%"><?php echo lang('From Name');?></th>	
									<th width="15%"><?php echo lang('From Email');?></th>
									<th width="10%"><?php echo lang('Created Date');?></th>
									<th width="5%"><?php echo lang('Action');?></th>
								</tr>
							</thead>
							<tbody>
								<?php 	
								$columns=6;											
								if(isset($aGrid->rows) && is_array($aGrid->rows) && !empty($aGrid->rows)){
									$i=get_grid_sn();								
									foreach ($aGrid->rows as $row) {
										?>
										<tr>
											<td><?php echo $i++?></td>
											<td><?php echo $row->template?></td>	
											<td><?php echo $row->subject?></td>	
											<td><?php echo $row->from_name?></td>	
											<td><?php echo $row->from_email?></td>
											<td><?php echo config_date($row->created_date)?></td>
											<td class="text-center">
												<a href="<?php echo $moduleUrl;?>message_template_add/<?php echo $row->id?>"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"><?php echo lang('Edit')?></i></a>
											</td>
										</tr>
										<?php
									}
								}else{
									?>
									<tr><td colspan="<?php echo $columns?>" class="text-center"><?php echo lang('No Records Found');?></td></tr>	
									<?php
								}
								?>
							</tbody>										
						</table>
						<?php if(isset($aGrid->pages)){echo $aGrid->pages;}?>
					</div>
					<!--GRID STOP-->
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div><!--/.main-->

<?php include_once('partials/footer-js.php');?>
<?php include_once('partials/footer-admin.php');?>
