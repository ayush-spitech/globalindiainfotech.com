<?php 

function get_grid_sn(){
	$ci=& get_instance();
	$page=0;
	if($ci->uri->segment(3)){
		$page=$ci->uri->segment(3);
	}
	$sn=config_item('record_limit')*$page+1;
	return $sn;
}

function get_visiter_counter(){

	$file=__DIR__.'/counter.spi';
	$myfile = fopen($file, "r");
	$number1=@fread($myfile,filesize($file));

	$number=$number1+1;
	@fclose($myfile);


	$myfile = fopen($file, "w");
	@fwrite($myfile, $number);

	$number=str_split(str_pad($number,6,0,STR_PAD_LEFT));
	$html='<div class="visiter-counter-container"><ul id="visitor-counter">';
	for($i=0; $i<count($number);$i++)
	{
		$html.='<li style="display:inline">'.$number[$i].'</li>';
	}
	$html.='</ul></div>';
	echo $html; 
};

function get_go_to_top(){
	$html='<!-- BackToTop Button -->
	<a href="javascript:void(0);" id="gototop" title="Scroll to Top" style="display: none;">
	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><span></span></a>
	';
	echo $html;
}

function get_breadcrumb($breadcrumb=array()){
	$html='<div class="row">
	<ol class="breadcrumb">
	<li><a href="'.base_url().'admin_dashboard/">
	<span class="glyphicon glyphicon-home"></span>
	</a>
	</li>';
	if(isset($breadcrumb) && is_array($breadcrumb) && !empty($breadcrumb)){
		foreach($breadcrumb as $link => $label){
			if($link!=''){
				$link=base_url().$link;
				$link='<a href="'.$link.'">
				<span class="glyphicon glyphicon-arrow"></span>'.lang($label).'
				</a>';
			}else{
				$link='
				<span class="glyphicon glyphicon-arrow"></span>'.lang($label).'
				';
			}
			$html.='<li>'.$link.'</li>';
		}
	}
	$html.='</ol></div>';
	echo $html;
}

/*
Google Location Input
*/
function google_location_input($name,$place_holder='Location'){
	$google_api_key='AIzaSyAS6YJIJ2OtbnFdiOsW8TC_OX9QQ_zrZl8';
	$html='<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key='.$google_api_key.'"></script>
	<script src="'.base_url().'assets/js/jquery.geocomplete.min.js"></script>
	<script>
	$(function () {	
		$("#'.$name.'").geocomplete({
			details: ".geo-details",
			detailsAttribute: "data-geo"
		});

	});
	</script>';	
	$html.='<input placeholder="'.lang($place_holder).'" type="text"  name="'.$name.'" id="'.$name.'" class="form-control" />
	<div class="geo-details">
	<input type="hidden" data-geo="country" value="" name="country">
	<input type="hidden" data-geo="country_short" value="" name="country_short">
	<input type="hidden" data-geo="administrative_area_level_1" value="" name="state">
	<input type="hidden" data-geo="administrative_area_level_1_short" value="" name="state_short">
	<input type="hidden" data-geo="administrative_area_level_2" value="" name="city">
	<input type="hidden" data-geo="lat" value="" name="latitude">
	<input type="hidden" data-geo="lng" value="" name="longitude">
	</div>';
	echo $html;
}

/*
$controls=array(from_date'=>1,'to_date'=>1,'export'=>1)
*/
function get_search_form($controls=array(),$module_url,$search_key_place_holder='',$is_add=1,$add_url='add'){
	$search_key=set_value('search_key');
	$from_date=set_value('from_date');
	$to_date=set_value('to_date');

	if($search_key_place_holder==''){
		$search_key_place_holder='Search Here';
	}
	$search_key_place_holder=lang($search_key_place_holder);

	$html='<div class="col-xs-12 no-padding table-search">
	<form method="get"><div class="form-group">';

	$search_col=3;
	$from_date_col=0;
	$to_date_col=0;

	$html.='<div class="col-sm-'.$search_col.' col-xs-12"><input type="text" name="search_key" placeholder="'.$search_key_place_holder.'" class="form-control" value="'.$search_key.'" title="'.$search_key_place_holder.'"></div>';

	if(isset($controls['from_date']) && $controls['from_date']==1){
		$from_date_col=1;
		$html.='<div class="col-sm-1 col-xs-12"><input type="text" name="from_date" placeholder="'.lang('From Date').'" class="form-control date" value="'.$from_date.'" title="'.lang('From Date').'"></div>';
	}

	if(isset($controls['to_date']) && $controls['to_date']==1){
		$to_date_col=1;
		$html.='<div class="col-sm-1 col-xs-12"><input type="text" name="to_date" placeholder="'.lang('To Date').'" class="form-control date" value="'.$to_date.'" title="'.lang('To Date').'"></div>';
	}

	$buttons_col=11-($search_col+$from_date_col+$to_date_col);

	$html.='<div class="col-sm-'.$buttons_col.' col-xs-12 no-padding">
	<button type="submit" name="search" class="btn btn-success" title="'.lang('Search').'">
	<i class="glyphicon glyphicon-search"></i>&nbsp;'.lang('Search').'</button>
	<button type="button" onclick="reload()" class="btn btn-primary" title="'.lang('Reset').'">
	<i class="glyphicon glyphicon-file"></i>&nbsp;'.lang('Reset').'</button>';

	if(isset($controls['export']) && $controls['export']==1){
		$html.='&nbsp;<button type="button" onclick="goto(\''.$module_url.'export/\')" name="export" class="btn btn-danger" title="'.lang('Export').'">
		<i class="glyphicon glyphicon-export"></i>&nbsp;'.lang('Export').'</button>';
	}
	if($is_add==1){
		$html.='&nbsp;<button type="button" onclick="goto(\''.$module_url.$add_url.'/\')" class="btn btn-primary" title="'.lang('Add').'">
		<i class="glyphicon glyphicon-plus"></i>&nbsp;'.lang('Add').'</button>';
	}
	$html.='</div>';
	$html.='</div></form></div>';
	echo $html;
}

function get_norecord($count){	
	$html='<tr><td colspan="'.$count.'" class="text-center">No Records Found</td></tr>';	
	echo $html;
}

function set_value($param){
	$param1='';
	if(isset($_GET[$param])){
		$param1=$_GET[$param];
	}else if(isset($_POST[$param])){
		$param1=$_POST[$param];
	}
	return $param1;
}


function grid($row_id,$res,$header,$fields,$actions){		
	$pages=$res->pages;
	$aData=$res->rows;
	$body=array();
	foreach ($aData as $key => $value) {
		$tmp=array();
		for($i=0;$i<count($fields);$i++){
			array_push($tmp,$value->$fields[$i]);
		}
		$body[]=array("row_id"=>$value->$row_id,"data"=>$tmp);
	}
	$grid=new StdClass();
	$grid->header=$header;
	$grid->body=$body;
	$grid->actions=$actions;
	$grid->footer=array();
	$grid->pages=$pages;	
	return $grid;
}

//------get tabl grid view-------------------
//$aGrid={header=array(),body=array(),actions=array(),footer=array(),pages=string}
function get_grid($aGrid){
	$field_count=count($aGrid->header)+2;
	?>
	<div class="table-container">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>								
					<th>SN</th>
					<?php if(isset($aGrid->header) && is_array($aGrid->header) && !empty($aGrid->header)){
						foreach ($aGrid->header as $row) {
							?>
							<th><?php echo $row;?></th>
							<?php
						}
					}
					?>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//debug($aGrid);
				if(isset($aGrid->body) && is_array($aGrid->body) && !empty($aGrid->body)){
					$i=get_grid_sn();
					foreach ($aGrid->body as $row) {
						//print_r($grid_row);
						?>
						<tr>
							<!--SN-->	
							<td><?php echo $i++?></td>
							<!--Body-->	
							<?php
							foreach ($row['data'] as $key=>$value) {							
								echo '<td>'.$value.'</td>';
							}
							?>
							<td>
								<!--Actions-->	
								<?php // edit
								if(isset($aGrid->actions['edit']) && $aGrid->actions['edit']==1){
									?>
									<a href="<?php echo $moduleUrl;?>add/<?php echo $row['row_id']?>">
										<i class="glyphicon glyphicon-edit" title="Edit"></i></a>
										<?php 
									}
									?>
									<?php //delete
									if(isset($aGrid->actions['delete']) && $aGrid->actions['delete']==1){
										?>
										&nbsp;|&nbsp;
										<a href="<?php echo $moduleUrl;?>delete/<?php echo $row['row_id']?>">
											<i class="glyphicon glyphicon-remove" title="Delete"></i></a>
											<?php 
										}
										?>
									<?php //view
									if(isset($aGrid->actions['view']) && $aGrid->actions['view']==1){
										?>
										&nbsp;|&nbsp;
										<a href="<?php echo $moduleUrl;?>view/<?php echo $row['row_id']?>">
											<i class="glyphicon glyphicon-search" title="View"></i></a>
											<?php 
										}
										?>
									</td>
								</tr>
								<?php						
							}
						}else{
							get_norecord($field_count);
						}
						?>								
					</tbody>
					<tfoot>
						<tr>
							<?php for($i=0;$i<$field_count;$i++){?>
							<td></td>
							<?php } ?>			
						</tr>
					</tfoot>
				</table>
				<?php if(isset($aGrid->pages)){echo $aGrid->pages;}?>
				<?php
			}

	//-----------get search view ----------------
			function get_search($moduleUrl){
				?>
				<div class="col-xs-12 no-padding table-search ">
					<form method="get">
						<div class="form-group">
							<div class="col-sm-2 col-xs-12">
								<input type="text" name="from_date" placeholder="From Date" class="form-control date" value="<?php echo set_value('from_date')?>">
							</div>
							<div class="col-sm-2 col-xs-12">
								<input type="text" name="to_date" placeholder="To Date" class="form-control date" value="<?php echo set_value('to_date')?>">
							</div>
							<div class="col-sm-4 col-xs-12">
								<input type="text" name="search_key" placeholder="Search Here" class="form-control" value="<?php echo set_value('search_key')?>">
							</div>
							<div class="col-sm-4 col-xs-12 no-padding">
								<button type="submit" name="search" class="btn btn-primary" title="Search">
									<i class="glyphicon glyphicon-search"></i></button>

									<button type="button" onclick="reload()" class="btn btn-primary" title="Reset">
										<i class="glyphicon glyphicon-file"></i></button>

										<button type="button" name="add" onclick="goto('<?php echo $moduleUrl?>add/')" class="btn btn-success" title="Add New <?php echo $title;?>">
											<i class="glyphicon glyphicon-plus"></i></button>

											<button type="button" name="delete" class="btn btn-danger" title="Delete">
												<i class="glyphicon glyphicon-remove"></i></button>

												<button type="button" onclick="goto('<?php echo $moduleUrl?>export/')" name="export" class="btn btn-danger" title="Export">
													<i class="glyphicon glyphicon-export"></i></button>
												</div>
											</div>
										</form>
									</div>
									<?php
								}
								?>