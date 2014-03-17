<?php if('' != validation_errors()): ?>
    <div class="msg-red" style="text-align: center;">
        El email es requerido.
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('error_recover')): ?>
    <div class="msg-red" style="text-align: center;">
        <?php echo $this->session->flashdata('error_recover') ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('success_recover')): ?>
    <div class="msg-green" style="text-align: center;">
        <?php echo $this->session->flashdata('success_recover') ?>
    </div>
<?php endif; ?>



<div class="clearfix" style="text-align: center;">
	<div class="login" style="display: inline-block; float: none;">
		<h3><span>Recuperar Contraseña</span></h3>
		<form onsubmit="return $(this).validationEngine('validate');" id="recover-form-action" method="post">
			<input type="text" id="email-login" name="email" class="validate[required, custom[email]]" placeholder="Correo Electronico" />
			<input class="login-btn" type="submit" value="Entrar" />
		</form>
	</div>
</div>		