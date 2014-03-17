<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Productos
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Productos</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Listado de Productos</a></li>
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
	<a href="<?php echo base_url(); ?>admin/product_new" style="margin-bottom: 15px;" class="btn pull-right blue">Agregar Nuevo</a>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-barcode"></i>Listado de Productos</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>		
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Articulo</th>
					<th>SKU</th>
					<th>Precio</th>
					<th>Stock</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $i => $product): ?>
			<tr>
				<td><?php echo $product['name']; ?></td>
				<td><?php echo $product['sku']; ?></td>
				<td>$ <?php echo $product['price']; ?></td>
				<td><?php echo $product['stock']; ?></td>
				<td>
					<?php if (1 == $product['active']): ?>
						<span class="label label-success">Activo</span>
					<?php else: ?>
						<span class="label label-important">Inactivo</span>
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo base_url(); ?>site/product/<?php echo $product['id']; ?>" target="_blank" class="btn icn-only purple  tooltips" data-original-title="Ver Producto"><i class="icon-list"></i></a>
					<a href="<?php echo base_url(); ?>admin/product_edit/<?php echo $product['id']; ?>" class="btn icn-only black  tooltips" data-original-title="Editar"><i class="icon-pencil"></i></a>
					<a href="<?php echo base_url(); ?>admin/product_delete/<?php echo $product['id']; ?>" class="btn icn-only red confirm tooltips" data-original-title="Borrar"><i class="icon-trash"></i></a>
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
