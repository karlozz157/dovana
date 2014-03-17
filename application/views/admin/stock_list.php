<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Reportes
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Reportes</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Reporte de Inventario</a></li>
		</ul>
	</div>
</div>
<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success hide" style="display: block;">
	<button class="close" data-dismiss="alert"></button>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>
<div class="row-fluid">
	<div class="pagination pull-left" style="margin-top: 0;">
		<ul>
		<?php if($pages > 1): ?>	
			<?php for($i = 1; $i <= $pages; $i++): ?>
				<li><a href="<?php echo base_url(); ?>admin/product_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		<?php endif; ?>
		</ul>
	</div>
	<div class="btn-group pull-right">
		<a class="btn purple dropdown-toggle" data-toggle="dropdown" href="#">
		Filtro <i class="icon-angle-down"></i>
		</a>
		<ul class="dropdown-menu">
			<li><a href="?order=desc" id="select-all"> Mayor Existencia</a></li>
			<li><a href="?order=asc" id="cancel-selection"> Menor Existencia</a></li>
		</ul>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-file-text"></i>Reporte de Inventario</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>		
	<div class="portlet-body">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Articulo</th>
					<th>Stock</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $i => $product): ?>
			<tr style="background: <?php echo 0 == $product['stock'] ? 'e02222' : ''; ?>;">
				<td><?php echo $product['name']; ?></td>
				<td>
					<?php echo $product['stock']; ?>
				</td>
				<td>
					<a href="<?php echo base_url(); ?>site/product/<?php echo $product['id']; ?>" target="_blank" class="btn icn-only purple  tooltips" data-original-title="Ver Producto"><i class="icon-list"></i></a>
				</td>
			</tr>
			<?php endforeach ?>					
			</tbody>
		</table>
	</div>
</div>
<div class="pagination">
	<ul>
	<?php if($pages > 1): ?>	
		<?php for($i = 1; $i <= $pages; $i++): ?>
			<li><a href="<?php echo base_url(); ?>admin/product_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>
	<?php endif; ?>
	</ul>
</div>