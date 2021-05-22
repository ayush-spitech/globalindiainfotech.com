<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Listing')?></div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form(array('from_date'=>1,'to_date'=>1),$moduleUrl,'Search Module Name,Url,Group Name',1,'modules_add');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="10%"><?php echo lang('Module Group');?></th>
									<th width="15%"><?php echo lang('(Id)Module Name');?></th>
									<th width="15%"><?php echo lang('Url');?></th>	
									<th width="15%"><?php echo lang('Icon');?></th>	
									<th width="10%"><?php echo lang('Status');?></th>	
									<th width="5%"><?php echo lang('Sequence');?></th>
									<th width="5%"><?php echo lang('Action');?></th>
								</tr>
							</thead>
							<tbody>
								<?php 	
								$columns=7;											
								if(isset($aGrid->rows) && is_array($aGrid->rows) && !empty($aGrid->rows)){
									$i=get_grid_sn();								
									foreach ($aGrid->rows as $row) {
										$status=status()[$row->status];
										?>
										<tr>
											<td><?php echo $i++?></td>
											<td><?php echo $row->group_name?></td>	
											<td class="status-<?php echo strtolower($status)?>">(<?php echo $row->module_id?>)<?php echo $row->title?></td>	
											<td><?php echo $row->url?></td>	
											<td><?php echo $row->icon?></td>
											<td><?php echo $status?></td>
											<td class="text-center"><?php echo $row->sequence_no?></td>
											<td class="text-center">
												<a href="<?php echo $moduleUrl;?>modules_add/<?php echo $row->module_id?>"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"><?php echo lang('Edit')?></i></a>
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
