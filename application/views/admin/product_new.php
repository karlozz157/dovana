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
			<li><a href="#">Nuevo Producto</a></li>
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
		<div class="caption"><i class="icon-reorder"></i> Nuevo Producto</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form method="post" id="validate-form" class="form-horizontal" enctype="multipart/form-data">	
			<div class="control-group">						
				<label class="control-label"><span class="required">*</span> Categoria</label>
				<div class="controls">
					<select name="category" class="validate[required]">
						<option value>Selecciona uno</option>
						<?php foreach ($categories as $category): ?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="control-group">				
				<label class="control-label"><span class="required">*</span> Nombre</label>
				<div class="controls">
					<input type="text" name="name" class="span8 validate[required] m-wrap">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Descripción</label>
				<div class="controls">
					<textarea name="description" class="span10 ckeditor validate[required] m-wrap" rows="8"></textarea>
				</div>
			</div>				
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> SKU</label>
				<div class="controls">
					<input type="text" name="sku" class="span3 validate[required] m-wrap">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Precio</label>
				<div class="controls">
					<input name="price" class="m-wrap span3 validate[required[custom[number]]]" type="text">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Articulos en Stock</label>
				<div class="controls">
					<input name="stock" class="m-wrap span3 validate[required[custom[number]]]" type="text">
				</div>
			</div>				
			<div class="control-group">
				<label class="control-label">Imagen Principal</label>
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
				<label class="control-label">Imagenes</label>
				<div class="controls">
					<input type="file" name="images[]" multiple/>
				</div>
			</div>								
			<div class="control-group">
				<label class="control-label">Status</label>
				<div class="controls">
					<input type="checkbox" name="active" id="active" value="1">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Productos Relacionados</label>
				<div class="controls">
					<input id="tags_1" name="products_related" type="text" class="m-wra tags" style="display: none;">
				</div>
			</div>
			<!--
			<div class="control-group">
				<label class="control-label">Producto Destacado</label>
				<div class="controls">
					<input type="checkbox" name="highlight" id="highlight" value="1">
				</div>
			</div>
			-->	
			<div class="form-actions">
				<button type="submit" class="btn blue">Guardar</button>
				<a href="<?php echo base_url(); ?>admin/product_list" class="btn" >Cancelar</a>                           
			</div>
		</form>
		<!-- END FORM-->       
	</div>
</div>
