<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Sliders
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Sliders</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Listado de Sliders</a></li>
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
				<li><a href="<?php echo base_url(); ?>admin/slider_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		<?php endif; ?>
		</ul>
	</div>
	<a href="<?php echo base_url(); ?>admin/slider_new" style="margin-bottom: 15px;" class="btn pull-right blue">Agregar Nuevo</a>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-sitemap"></i>Listado de Sliders</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>		
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Url</th>
					<th>Imagen</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sliders as  $slider): ?>
				<tr>
					<td><?php echo $slider['url']; ?></td>
					<td>
						<a href="<?php echo base_url(); ?>assets/media/img/<?php echo $slider['image']; ?>" target="_blank"><?php echo $slider['image']; ?></a>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>admin/slider_edit/<?php echo $slider['id']; ?>" class="btn icn-only black  tooltips" data-original-title="Editar"><i class="icon-pencil"></i></a>
						<a href="<?php echo base_url(); ?>admin/slider_delete/<?php echo $slider['id']; ?>" class="btn icn-only red confirm tooltips" data-original-title="Borrar"><i class="icon-trash"></i></a>
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
			<li><a href="<?php echo base_url(); ?>admin/slider_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>
	<?php endif; ?>
	</ul>
</div>
