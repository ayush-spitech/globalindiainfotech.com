<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : Listing</div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form('',$moduleUrl,'Search By Page Title');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="10%"><?php echo lang('Page Name');?></th>
									<th width="20%"><?php echo lang('Page Title');?></th>
									<th width="35%"><?php echo lang('Meta Keywords');?></th>
									<th width="10%"><?php echo lang('Status');?></th>	
									<th width="15%"><?php echo lang('Action');?></th>
								</tr>
							</thead>
							<tbody>
								<?php 	
								$columns=6;		
								//debug($aGrid);									
								if(isset($aGrid->rows) && is_array($aGrid->rows) && !empty($aGrid->rows)){
									$i=get_grid_sn();									
									foreach ($aGrid->rows as $row) {	
										$status=lang('Active');
										if( $row->status==0){
											$status=lang('Inactive');
										}				
										?>
										<tr>
											<td><?php echo $i++?></td>
											<td><?php echo $row->page_name?></td>	
											<td><?php echo $row->page_title?></td>
											<td><?php echo $row->meta_keywords?></td>
											<td><?php echo $status?></td>
											<td class="text-center">
												<a class="edit" href="<?php echo $moduleUrl;?>add/<?php echo $row->cms_id?>"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"><?php echo lang('Edit')?></i></a>
												&nbsp;|&nbsp;
												<a class="delete" href="<?php echo $moduleUrl;?>delete/<?php echo $row->cms_id?>"><i class="glyphicon glyphicon-remove" title="<?php echo lang('Delete')?>"><?php echo lang('Delete')?></i></a>
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
