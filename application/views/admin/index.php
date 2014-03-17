<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN STYLE CUSTOMIZER -->

		<!-- END BEGIN STYLE CUSTOMIZER -->    
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Dashboard <small>del <?php echo $start; ?> al <?php echo $end; ?></small>
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio
				</a> 
				<i class="icon-angle-right"></i>
			</li>
			<li><a href="#">Dashboard</a></li>
			<li class="pull-right no-text-shadow">
				<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range" style="display: block;">
					<i class="icon-calendar"></i>
					<span><i style="visibility: hidden;">December 28, 2013 - January 26, 2014</i></span>
					<i class="icon-angle-down"></i>
				</div>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>

<div id="dashboard">
	<!-- BEGIN DASHBOARD STATS -->
	<div class="row-fluid">
		<div class="responsive span6" data-tablet="span6" data-desktop="span6">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="icon-bar-chart"></i>
				</div>
				<div class="details">
					<div class="number">$ <?php echo $sales; ?></div>
					<div class="desc">Total de Ventas</div>
				</div>
				<a class="more">
				</a>                 
			</div>
		</div>
		<div class="responsive span6" data-tablet="span6" data-desktop="span6">
			<div class="dashboard-stat green">
				<div class="visual">
					<i class="icon-shopping-cart"></i>
				</div>
				<div class="details">
					<div class="number"><?php echo $purchase; ?></div>
					<div class="desc">Total de Compras</div>
				</div>
				<a class="more" href="#">
				</a>                 
			</div>
		</div>			
	</div>
</div>
<div class="row-fluid">
	<span>
		<div class="portlet box red" style="margin:;">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>Raking de Productos Vendidos</div>
				<div class="tools">
					<a href="#portlet-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="chart" id="chart-products"></div>
			</div>
		</div>
	</span>
</div>
<script type="text/javascript">
	var chartProduct = JSON.parse('<?php echo $chartProduct; ?>');
</script>