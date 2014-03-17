<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Usuarios
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Usuarios</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Listado de Usuarios</a></li>
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
	<?php if($pages > 1): ?>
	<div class="pagination pull-left" style="margin-top: 0;">
		<ul>
			<?php for($i = 1; $i <= $pages; $i++): ?>
				<li><a href="<?php echo base_url(); ?>admin/product_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</div>
	<?php endif; ?>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-user"></i>Listado de Usuarios</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>		
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Email</th>				
					<th>Nombre Completo</th>
					<th>Sexo</th>
					<th>Fecha de Registro</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $i => $user): ?>
				<tr>
					<td><?php echo $user['email']; ?></td>
					<td><?php echo $user['first_name'].' '.$user['last_name']; ?></td>
					<td><?php echo $user['gender']; ?></td>					
					<td><?php echo $user['create_at'] ?></td>
					<td>
						<!--<a href="<?php echo base_url(); ?>admin/user_disabled/<?php echo $user['id']; ?>" class="btn mini green"><i class="icon-edit"></i> Desactivar</a>-->
						<a href="<?php echo base_url(); ?>admin/user_delete/<?php echo $user['id']; ?>" class="btn icn-only red confirm tooltips" data-original-title="Borrar"><i class="icon-trash"></i></a>
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
				<li><a href="<?php echo base_url(); ?>admin/user_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		<?php endif; ?>
	</ul>
</div>
