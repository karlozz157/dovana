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
			<li><a href="#">Nueva Envoltura</a></li>
		</ul>
	</div>
</div>
<?php if('' != validation_errors()): ?>
	<div class="alert alert-error">
		<button class="close" data-dismiss="alert"></button>
		La validación de los campos ha fallado.
	</div>
<?php endif; ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i> Nueva Envoltura</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="" method="post" enctype="multipart/form-data" id="validate-form" class="form-horizontal">			
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Nombre</label>
				<div class="controls">
					<input type="text" name="name" class="span6 validate[required] m-wrap">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Precio</label>
				<div class="controls">
					<input name="price" class="m-wrap span2 validate[required[custom[number]]]" type="text">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Activo</label>
				<div class="controls">
					<input type="checkbox" name="status" value="1">
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue">Guardar</button>
				<a href="<?php echo base_url(); ?>admin/sending_list" class="btn" >Cancelar</a>                            
			</div>
		</form>
		<!-- END FORM-->       
	</div>
</div>