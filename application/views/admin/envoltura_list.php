<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Envolturas
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Envolturas</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Listado Envolturas</a></li>
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
	<a href="<?php echo base_url(); ?>admin/envoltura_new" style="margin-bottom: 15px;" class="btn blue pull-right">Agregar Nuevo</a>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-sitemap"></i>Listado de Envolturas</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>		
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Status</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($envolturas as  $envoltura): ?>
				<tr>
					<td><?php echo $envoltura['name']; ?></td>
					<td><?php echo $envoltura['price']; ?></td>
					<td>
					<?php if (1 == $envoltura['status']): ?>
						<span class="label label-success">Activa</span>
					<?php else: ?>
						<span class="label label-important">Desactiva</span>
					<?php endif; ?>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>admin/envoltura_edit/<?php echo $envoltura['id']; ?>" class="btn mini blue"><i class="icon-edit"></i> Editar</a>
						<a href="<?php echo base_url(); ?>admin/envoltura_delete/<?php echo $envoltura['id']; ?>" class="btn mini red"><i class="icon-trash"></i> Borrar</a>
					</td>
				</tr>
				<?php endforeach; ?>		
			</tbody>
		</table>
	</div>	
</div>
<div class="pagination">
	<ul>
	<?php if($pages > 1): ?>
		<?php for($i = 1; $i <= $pages; $i++): ?>
			<li><a href="<?php echo base_url(); ?>admin/sending_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>
	<?php endif; ?>
	</ul>
</div>