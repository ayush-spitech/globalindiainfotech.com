<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<?php get_breadcrumb($breadcrumb)?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title;?> : <?php echo lang('Listing')?></div>
				<div class="panel-body">
					<?php show_message();?>					
					<?php get_search_form('',$moduleUrl,'Search By Recipe Name');?>				
					<!--GRID START-->
					<div class="table-container">
						<table class="table table-bordered table-responsive row-sorting">
							<thead>
								<tr>								
									<th width="5%"><?php echo lang('SN');?></th>
									<th width="10%"><?php echo lang('Recipe Thumnail');?></th>
									<th width="15%"><?php echo lang('Recipe Name');?></th>
                                    <th width="10%"><?php echo lang('Category');?></th>
                                     <th width="10%"><?php echo lang('Cuisine');?></th>
                                     <th width="10%"><?php echo lang('Recipe of the Day');?></th>
									<th width="10%"><?php echo lang('Status');?></th>	
									<th width="10%"><?php echo lang('Action');?></th>
								</tr>
							</thead>
							<tbody>
								<?php 	
								$columns=8;											
								if(isset($aGrid->rows) && is_array($aGrid->rows) && !empty($aGrid->rows)){
									$i=get_grid_sn();								
									foreach ($aGrid->rows as $row) {
										$status=status();
										$status=$status[$row->status];
										$aCategory=get_row('category',array("category_id"=>$row->category_id))
										?>
										<tr id='sequences_<?php echo $row->recipe_id; ?>'>
											<td><?php echo $i++?></td>
											<td><?php	
											show_image($row->thumbnail,array("width"=>"80","height"=>"80"));
											?></td>
											<td><?php echo $row->title?></td>
                                            <td><?php echo $aCategory->title?></td>
                                            <td><?php echo $row->cuisine?></td>
                                             <td class="text-center"><?php if($row->recipe_type==1){ echo "<b class='text-success'>Yes</b>"; }else{echo "No";}?></td>
											<td><?php echo $status?></td>
											<td class="text-center">
                                            
                                            <a data-toggle="modal" data-target="#viewModal<?php echo $row->recipe_id?>" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-search" title="<?php echo lang('View')?>"></i></a>
												<a href="<?php echo $moduleUrl;?>add/<?php echo $row->recipe_id?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil" title="<?php echo lang('Edit')?>"></i></a>
											</td>
										</tr>
                                        
                                        <div id="viewModal<?php echo $row->recipe_id?>" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background:#5ABFDD;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#FFF;"><?php echo $row->title?></h4>
      </div>
      <div class="modal-body">
      
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
              <div class="col-md-3"><strong><?php echo lang('Cuisine');?></strong></div>
             <div class="col-md-9 text-info"><?php echo $row->cuisine?></div>
       </div>
   
       
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
             <div class="col-md-3"><strong><?php echo lang('Recipe of the day');?></strong></div>
             <div class="col-md-9 text-info"><?php if($row->recipe_type==1){ echo "<b class='text-success'>Yes</b>"; }else{echo "No";}?></div>
       </div>
       
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
             <div class="col-md-3"><strong><?php echo lang('Category');?></strong></div>
             <div class="col-md-9 text-info"><?php echo $aCategory->title?></div>
       </div>
       
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
             <div class="col-md-3"><strong><?php echo lang('Recipe Description');?></strong></div>
             <div class="col-md-9 text-info"><?php echo $row->description?></div>
       </div>
       
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
             <div class="col-md-3"><strong><?php echo lang('Recipe Ingredients');?></strong></div>
             <div class="col-md-9 text-info"><?php echo $row->ingredients?></div>
       </div>
       
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
             <div class="col-md-3"><strong><?php echo lang('Recipe Method');?></strong></div>
             <div class="col-md-9 text-info"><?php echo $row->method?></div>
       </div>
       
       
       
        <div class="row" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #EFEFEF;">
             <div class="col-md-3"><strong><?php echo lang('Status');?></strong></div>
             <div class="col-md-9 text-info"><?php echo $status?></div>
       </div>
       
        <div class="row" style="padding-top:10px;border-bottom:1px solid #EFEFEF;">
          <div class="col-md-3"><strong><?php echo lang('Thumbnail & Featured Image');?></strong></div>
             <div class="col-md-3  text-info"><strong>Thumbnail</strong><br><?php show_image($row->thumbnail,array("width"=>"100%","height"=>"200")); ?> </div>
             <div class="col-md-6 text-info"><strong>Featured Image</strong><br><?php show_image($row->featured_image,array("width"=>"100%","height"=>"200")); ?></div>
       </div>
       
       
       
       
       
      </div>
      <div class="modal-footer"  style="background:#5ABFDD;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                                        
                                        
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
