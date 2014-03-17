<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Administrador
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Administrador</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Configuración</a></li>
		</ul>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i> Configuración</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="" method="post" id="config-form" class="form-horizontal">
			<div class="alert alert-error hide" style="display: none;">
				<button class="close" data-dismiss="alert"></button>
				Campos requeridos.
			</div>		
			<div class="control-group">
				<label class="control-label">Nombre del Sitio</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="<?php echo $config['name']; ?>" class="span6 m-wrap">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Correo Electronico</label>
				<div class="controls">
					<input type="text" name="email" id="email" value="<?php echo $config['email']; ?>" class="span6 m-wrap">
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn blue">Guardar</button>                           
			</div>
		</form>
		<!-- END FORM-->       
	</div>
</div>