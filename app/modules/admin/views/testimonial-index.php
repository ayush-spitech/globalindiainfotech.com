<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Listing')?></div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form('',$moduleUrl,'Search By Name,Mobile,Email');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="20%"><?php echo lang('Photo');?></th>
									<th width="35%"><?php echo lang('Message');?></th>
									<th width="15%"><?php echo lang('Name');?></th>
									<th width="10%"><?php echo lang('Mobile');?></th>	
									<th width="15%"><?php echo lang('Action');?></th>
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
											<td><?php	
											show_image($row->image,array("width"=>"80","height"=>"80"));
											?></td>
											<td><?php echo $row->message;?></td>
											<td class="name"><?php echo $row->name;?></td>	
											<td class="mobile"><?php echo $row->mobile;?></td>
											<td class="action">
												<a class="edit" href="<?php echo $moduleUrl;?>add/<?php echo $row->testimonial_id?>"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"><?php echo lang('Edit')?></i></a>
												&nbsp;
												<a class="delete" href="<?php echo $moduleUrl;?>delete/<?php echo $row->testimonial_id?>"><i class="glyphicon glyphicon-remove" title="<?php echo lang('Delete')?>"><?php echo lang('Delete')?></i></a>
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
