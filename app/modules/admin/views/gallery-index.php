<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : Listing</div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form('',$moduleUrl,'Search By Title');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="10%"><?php echo lang('Title');?></th>
									<th width="65%"><?php echo lang('Images');?></th>
									<th width="20%"><?php echo lang('Action');?></th>
								</tr>
							</thead>
							<tbody>
								<?php 	
								$columns=6;											
								//debug($aGrid->rows);
								if(isset($aGrid->rows) && is_array($aGrid->rows) && !empty($aGrid->rows)){
									$i=get_grid_sn();									
									foreach ($aGrid->rows as $row) {	
										$status=status()[$row->status];
										?>
										<tr>
											<td><?php echo $i++?></td>
											<td><?php echo $row->title?></td>
											<td>
												<?php 
												$aImage=$row->aImage;

												if(isset($aImage) && is_array($aImage) && !empty($aImage)){
													$photos='';
													foreach ($aImage as $value) {	
														$image=base_url().'media/'.$value->image;
														$photos.='<div id="div_'.$value->image_id.'" class="tbl-img" title="'.$value->title.'"><img src="'.$image.'" height="100" width="100" alt="'.$value->title.'"/><br/>';
														$photos.='<center>
														<span onclick="deleteImg('.$value->image_id.')" class="btn text-center text-red fa fa-times" title="Delete"></span>';
														$photos.='</center></div>';	
													}
													echo $photos;
												}?>
											</td>										
											<td class="text-center">
												<a href="<?php echo $moduleUrl;?>add_image/<?php echo $row->gallery_id;?>" title="Add Images">
													<i class="fa fa-plus"></i>&nbsp;<?php echo lang('Add Images');?>
												</a> &nbsp;
												<a href="<?php echo $moduleUrl;?>add/<?php echo $row->gallery_id?>"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"><?php echo lang('Edit')?></i></a>
											</td>
										</tr>
										<?php } 
									} 
									else{
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
	<script type="text/javascript">
		function deleteImg(img_id){
			var csrf_token_name='<?php echo $this->security->get_csrf_token_name()?>';
			var csrf_value='<?php echo $this->security->get_csrf_hash();?>';
			$.ajax({
				url:'<?php echo $moduleUrl;?>deleteImg/',
				type:'POST',
				data:{rowId:img_id,csrf_token_name:csrf_value},
				success:function(response){
                   window.location='<?php echo $moduleUrl;?>';
				}
			});
		}
	</script>
	<?php include_once('partials/footer-admin.php');?>
