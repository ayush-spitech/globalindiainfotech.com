<?php include_once('partials/header-admin.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>dashboard/"><span class="glyphicon glyphicon-home"></span></a></li>
			<li class="active">Dashboard</li>
		</ol>
	</div><!--/.row-->	


	<div class="row hide">
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-blue panel-widget ">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">120</div>
						<div class="text-muted">Events</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-orange panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<em class="glyphicon glyphicon-comment glyphicon-l"></em>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">52</div>
						<div class="text-muted">Tickets</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<em class="glyphicon glyphicon-user glyphicon-l"></em>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">24</div>
						<div class="text-muted">Orders</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-red panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<em class="glyphicon glyphicon-stats glyphicon-l"></em>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">25</div>
						<div class="text-muted">Customers</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->		
</div>	<!--/.main-->
<?php include_once('partials/footer-js.php');?>
<?php include_once('partials/footer-admin.php');?>
