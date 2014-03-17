<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Categorías
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Categorías</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Nueva Categoría</a></li>
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
		<div class="caption"><i class="icon-reorder"></i> Nueva Categoría</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="" method="post" enctype="multipart/form-data" id="validate-form" class="form-horizontal">	
			<div class="control-group">
				<label class="control-label">Categoría</label>
				<div class="controls">
					<select name="sub_category">
							<option value="0">Es categoría principal</option>
						<?php foreach ($categories as $category): ?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>			
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Nombre</label>
				<div class="controls">
					<input type="text" name="name" class="span6 validate[required] m-wrap">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Descripción</label>
				<div class="controls">
					<textarea name="description" class="span6 validate[required] m-wrap" rows="3"></textarea>
				</div>
			</div>		
			<div class="control-group">
				<label class="control-label">Imagen</label>
				<div class="controls">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<span class="btn btn-file">
							<span class="fileupload-new">Seleccionar Imagen</span>
							<span class="fileupload-exists">Cambiar</span>
							<input type="file" class="default" name="image" accept="image/x-png, image/gif, image/jpeg">
						</span>
						<span class="fileupload-preview"></span>
						<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
					</div>
				</div>
			</div>			
			<div class="control-group">
				<label class="control-label">Status</label>
				<div class="controls">
					<input type="checkbox" name="active" value="1">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Mostrar Precios</label>
				<div class="controls">
					<input type="checkbox" name="show_price" id="active" value="1">
				</div>
			</div>			
			<div class="form-actions">
				<button type="submit" class="btn blue">Guardar</button>
				<a href="<?php echo base_url(); ?>admin/category_list" class="btn" >Cancelar</a>                            
			</div>
		</form>
		<!-- END FORM-->       
	</div>
</div>