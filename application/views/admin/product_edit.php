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
			<li><a href="#">Editar Producto</a></li>
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
		<div class="caption"><i class="icon-reorder"></i> Editar Producto</div>
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
					<select name="category" id="category" class="validate[required]">
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
					<input type="text" class="span8 validate[required] m-wrap" name="name" value="<?php echo $product['name']; ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Descripción</label>
				<div class="controls">
					<textarea class="span10 ckeditor validate[required] m-wrap" name="description" rows="8"><?php echo $product['description']; ?></textarea>
				</div>
			</div>			
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> SKU</label>
				<div class="controls">
					<input type="text" class="span4 validate[required] m-wrap" name="sku" value="<?php echo $product['sku']; ?>">
				</div>
			</div>
			<div class="control-group">				
				<label class="control-label"><span class="required">*</span> Precio</label>
				<div class="controls">
					<input class="m-wrap validate[required[custom[number]]] span2" name="price" type="text" value="<?php echo $product['price']; ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="required">*</span> Articulos en Stock</label>
				<div class="controls">
					<input name="stock" class="m-wrap span2 validate[required[custom[number]]]" type="text" value="<?php echo $product['stock']; ?>">
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
					<?php if('' != $product['image']): ?>
						<a href="<?php echo base_url(); ?>assets/media/img/<?php echo $product['image']; ?>" target="_blank"><?php echo $product['image']; ?></a>
					<?php endif; ?>
				</div>
			</div>	
			<div class="control-group">
				<label class="control-label">Imagenes</label>
				<div class="controls">
					<input type="file" name="images[]" multiple/>
				<hr />
				<?php foreach ($images as $image): ?>
					<div style="border: 1px solid #ccc; display: inline-block; margin: 15px 10px; text-align: center; padding: 7px;">
						<span class="delete-image-product" data-id="<?php echo $image['id']; ?>" style="color: #ee162d; cursor: pointer; font-size: 25px; position: absolute;">✘</span>
						<img src="<?php echo base_url(); ?>assets/media/img/<?php echo $image['name']; ?>" style="width: 100px; height: 100px;"/>
					</div>
				<?php endforeach; ?>
				</div>
			</div>														
			<div class="control-group">
				<label class="control-label">Status</label>
				<div class="controls">
					<input type="checkbox" name="active" <?php echo 1 == $product['active']?'checked':''; ?> value="1">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Productos Relacionados</label>
				<div class="controls">
					<input id="tags_1" name="products_related" type="text" class="m-wra tags" style="display: none;" value="<?php echo '' != $product['products_related'] ? implode(json_decode($product['products_related']), ',') : ''; ?>">
				</div>
			</div>
			<!--			
			<div class="control-group">
				<label class="control-label">Producto Destacado</label>
				<div class="controls">
					<input type="checkbox" name="highlight" <?php echo 1 == $product['highlight']?'checked':''; ?> value="1">
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
<script type="text/javascript">
	var combo = document.getElementById('category');

	for(var i = 0; i < combo.length; i++)
	{
		if('<?php echo $product["category"]; ?>' == combo[i].value)
			combo.selectedIndex = i;
	}
</script>