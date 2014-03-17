<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Slider
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Slider</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Editar Slider</a></li>
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
		<div class="caption"><i class="icon-reorder"></i> Editar Slider</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="" method="post" enctype="multipart/form-data" id="validate-form" class="form-horizontal">	
			<input type="hidden" name="hidden">
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Tipo</label>
				<div class="controls">
					<select name="type" id="type" class="validate[required]">
						<option value>Escoge una opcion</option>
						<option value="1">Slider</option>
						<option value="2">Promociones</option>
					</select>
				</div>
			</div>			
			<div class="control-group">
				<label class="control-label"> Url</label>
				<div class="controls">
					<input type="text" name="url" class="span6 validate[custom[url]] m-wrap" value="<?php echo $slider['url']; ?>">
				</div>
			</div>	
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Imagen</label>
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
			<div class="form-actions">
				<button type="submit" class="btn blue">Guardar</button>
				<a href="<?php echo base_url(); ?>admin/category_list" class="btn" >Cancelar</a>                            
			</div>
		</form>
		<!-- END FORM-->       
	</div>
</div>
<script type="text/javascript">
	document.getElementById('type').selectedIndex = '<?php echo $slider["type"]; ?>';
</script>
