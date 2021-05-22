<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Listing')?></div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form('',$moduleUrl,'Search News');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="15%"><?php echo lang('Date');?></th>
									<th width="45%"><?php echo lang('News Title');?></th>
									<th width="20%"  class="text-center"><?php echo lang('Attachemnt');?></th>
									<th width="15%"  class="text-center"><?php echo lang('Action');?></th>
								</tr>
							</thead>
							<tbody>
								<?php 	
								$columns=5;	
								//debug($aGrid->rows);										
								if(isset($aGrid->rows) && is_array($aGrid->rows) && !empty($aGrid->rows)){
									$i=get_grid_sn();								
									foreach ($aGrid->rows as $row) {	
										?>
										<tr>
											<td><?php echo $i++?></td>
											<td><?php echo config_date($row->date);?></td>
											<td><?php echo $row->title;?></td>
											   <td align="center"><a href="<?php media_url(); echo $row->attachment?>" target="_blank"  class="btn btn-xs btn-success"><i class="fa fa-download"></i> Download</a></td>
											<td class="action">
												<a class="edit" href="<?php echo $moduleUrl;?>add/<?php echo $row->news_id?>"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"><?php echo lang('Edit')?></i></a>
												&nbsp;
												<a class="delete" href="<?php echo $moduleUrl;?>delete/<?php echo $row->news_id?>"><i class="glyphicon glyphicon-remove" title="<?php echo lang('Delete')?>"><?php echo lang('Delete')?></i></a>
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
