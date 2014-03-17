<div id="content-contacto">
	<h3>¿TIENES ALGUNA DUDA, QUEJA O SUGERENCIA?</h3>
	<h2>Escríbenos a <a href="mailto:creandoregalos@dovana.mx">creandoregalos@dovana.mx</a> o esríbenos directamente</h2>
	<?php if($this->session->flashdata('contacto_success')): ?>
		<div class="msg-green"><?php echo $this->session->flashdata('contacto_success'); ?></div>
	<?php endif; ?>
	<?php if('' != validation_errors()): ?>
		<div class="msg-red">La validación de los campos es incorrecta.</div>
	<?php endif; ?>
	<form class="validate-form" onsubmit="return $(this).validationEngine('validate');" method="post">
		<input type="text" name="name" class="validate[required]" placeholder="NOMBRE">
		<input type="text" name="email" class="validate[required, custom[email]]" placeholder="EMAIL">
		<textarea name="message" placeholder="TU MENSAJE..." class="validate[required]"></textarea>
		<button><span>ENVIAR</span></button>
	</form>
</div>
<style type="text/css">
	#contact-table-header
	{
		background: #D1CBC3;
	}
</style>
