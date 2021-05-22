<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">	
	<ul class="nav menu">
		<li>
			<a href="<?php echo base_url()?>" target="_blank"><span class="glyphicon glyphicon-dashboard"></span> <?php echo lang('View Website')?></a>
		</li>
		<li class="<?php get_active("dashboard",$menu)?>">
			<a href="<?php echo base_url()?>admin_dashboard/"><span class="glyphicon glyphicon-dashboard"></span> <?php echo lang('Dashboard')?></a>
		</li>

		<?php
		$aMenu = my_all_menu();
		//debug($aMenu);
		if ($_SESSION['aUser']->user_id > 1) {
			$aMenu = my_menu($_SESSION['aUser']->user_id);
		}   
		if (isset($aMenu) && is_array($aMenu) && !empty($aMenu)) {
			foreach ($aMenu as $data) {  
				$aChildMenu = $data->aModules;       
				if (isset($aChildMenu) && is_array($aChildMenu) && !empty($aChildMenu)) {
					?>			
					<li class="parent <?php get_active($data->selected_id,$menu)?>">
						<?php 
						$collapse='';
						if($menu==$data->selected_id){
							$collapse='in';
						}
						?>
						<a data-toggle="collapse" href="#sub-item-<?php echo $data->group_id;?>">
							<span class="<?php echo $data->icon;?>"></span>&nbsp;<?php echo lang($data->title);?><span data-toggle="collapse" href="#sub-item-<?php echo $data->group_id;?>" class="icon pull-right">
							<em class="glyphicon glyphicon-s glyphicon-plus"></em>
						</span> 
					</a>					
					<ul class="children collapse <?php echo $collapse;?>" id="sub-item-<?php echo $data->group_id;?>">
						<?php
						foreach ($aChildMenu as $data1) {
							?>
							<li>
								<a href="<?php echo base_url() ?><?php echo $data1->url; ?>/"><span class="<?php echo $data1->icon;?>"></span>&nbsp;<?php echo lang($data1->title); ?></a>
							</li>
							<?php }
							?>
						</ul>
					</li>
					<?php
				}
			}
		}
		?>

	<?php if(isset($_SESSION['aUser']->role_id) && $_SESSION['aUser']->role_id=='1'){?>
	<li class="parent <?php get_active("config",$menu)?>">
		<?php 
		$collapse='';
		if($menu=='config'){
			$collapse='in';
		}
		?>
		<a href="#">
			<span class="fa fa-gears"></span>Super Admin<span data-toggle="collapse" href="#sub-item-superadmin" class="icon pull-right">
			<em class="glyphicon glyphicon-s glyphicon-plus"></em>
		</span> 
	</a>
	<ul class="children collapse <?php echo $collapse;?>" id="sub-item-superadmin">
		<li>
			<a class="" href="<?php echo base_url()?>superadmin/">
				<span class="glyphicon glyphicon-th"></span><?php echo lang('General Settings')?>
			</a>
		</li>
		<li>
			<a class="" href="<?php echo base_url()?>admin_language/">
				<span class="glyphicon glyphicon-th"></span><?php echo lang('Label')?>
			</a>
		</li>
		<li>
			<a class="" href="<?php echo base_url()?>admin_language/add/1">
				<span class="glyphicon glyphicon-th"></span><?php echo lang('Label Value')?>
			</a>
		</li>	
		<li>
			<a class="" href="<?php echo base_url()?>admin_user/" title="<?php echo lang('Manage Admin Users')?>">
				<span class="glyphicon glyphicon-th"></span><?php echo lang('Admin Users')?>
			</a>
		</li>			
		<li>
			<a class="" href="<?php echo base_url()?>superadmin/modules/" title="><?php echo lang('Manage modules')?>">
				<span class="glyphicon glyphicon-th"></span><?php echo lang('Modules')?>
			</a>
		</li>	
		<li>
			<a class="" href="<?php echo base_url()?>superadmin/message_template/" title="<?php echo lang('Manage message Template')?>">
				<span class="glyphicon glyphicon-th"></span><?php echo lang('Message Template')?>
			</a>
		</li>									
	</ul>
</li>
<?php }?>					
</ul>
</div>
</div>
<!--/.sidebar-->