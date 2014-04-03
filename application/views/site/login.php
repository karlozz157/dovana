<div id="content-login">
	<div id="login">
		<h2>TU CUENTA</h2>
		<?php if ('' != $this->session->flashdata('error')): ?>
			<div class="msg-red"><?php echo $this->session->flashdata('error'); ?></div>				
		<?php endif; ?>
		<form method="post" action="<?php echo base_url(); ?>site/login" onsubmit="return $(this).validationEngine('validate');" class="validate-form">
			<input type="text" name="email" class="validate[required, custom[email]]" placeholder="EMAIL" value="<?php echo isset($_COOKIE['email-login'])?$_COOKIE['email-login']:''; ?>"/>
			<input type="password" name="password" class="validate[required]" placeholder="CONTRASEÑA" value="<?php echo isset($_COOKIE['password-login'])?$_COOKIE['password-login']:''; ?>"/>
			<div><input type="checkbox" style="display: inline-block; vertical-align: top; width: 20px;" name="remember-data" value="1"> <span style="display: inline-block;">RECORDAR MIS DATOS</span></div>
			<div>
				<a href="" style="color: #444F51; font-family: 'Brandon Grotesque Medium'; font-style: italic; float: left; font-size: 10pt;">¿Olvidaste tu contraseña?</a>
				<button type="submit" class="btn" style="float: right;">
					<span>ENTRAR</span>
				</button>
			</div>
			<div class="clear"></div>
			<div>
				<p style="font-size: 11pt;">BENEFICIOS DE TENER UNA CUENTA DOVANA</p>
				<p style="font-size: 10pt;">Tu cuenta Dovana te permitirá comprar y darle seguimiento a tus pedidos. También gozarás de beneficios exclusivos</p>
			</div>
		</form>
	</div>
	<div id="register">
		<h2>CLIENTE NUEVO</h2>
		<?php if ('' != $this->session->flashdata('error_register')): ?>
			<div class="msg-red"><?php echo $this->session->flashdata('error_register'); ?></div>				
		<?php endif; ?>

		<form method="post" action="<?php echo base_url(); ?>site/register" onsubmit="return $(this).validationEngine('validate');" class="validate-form">
			<input type="text" name="name" class="validate[required]" placeholder="NOMBRE" style="width: 32%;" />
			
			<input type="text" name="first_name" class="validate[required]" placeholder="APELLIDO PATERNO" style="margin: 0 1%; width: 32%;" />
			
			<input type="text" name="last_name" class="validate[required]" placeholder="APELLIDO MATERNO" style="width: 32%;" />

			<select name="gender" style="width: 32%;" class="validate[required]">
				<option value>GÉNERO</option>
				<option value="female">MUJER</option>
				<option value="male">HOMBRE</option>
			</select>

			<input type="text" name="birthday" id="datepicker" class="validate[required, custom[date]]" placeholder="CUMPLEAÑOS DIA/MES/AÑO" style="margin-left: 1%; width: 66%;" readonly max-length="11"/>
		
			<input type="email" name="email" id="email" class="validate[required]" placeholder="EMAIL" style="float: left; width: 48%;" />
			<input type="email" name="email_conf" class="validate[required, equals[email]]" placeholder="CONFIRMAR EMAIL" style="float: right;width: 48%;" />

			<input type="password" name="password" id="password" class="validate[required]" placeholder="CONTRASEÑA" style="float: left; width: 48%;" />
			<input type="password" name="password_conf" class="validate[required, equals[password]]" placeholder="CONFIRMAR CONTRASEÑA" style="float: right; width: 48%;" />

			<input type="text" name="telephone" class="validate[required, custom[integer]]" placeholder="TELÉFONO CASA / OFICINA" style="float: left; width: 48%;" />
			<input type="text" name="cellphone" class="validate[required, custom[integer]]" placeholder="TELÉFONO CELULAR" style="float: right; width: 48%;" />			
			
			<div class="clear"></div>
			<div>
				<div style="float: left;">
					<input type="checkbox" name="newsletter" value="1"/>
					<span style="font-family: 'Brandon Grotesque Medium'; font-style: italic; font-size: 10pt;">Deseo recicibir información de promociones y el Newsletter de Donavan</span>
				</div>

			<button type="submit" class="btn" style="float: right;">
				<span>REGISTRATE</span>
			</button>
			</div>		
		</form>
	</div>
</div>
<div class="clear"></div>
<style type="text/css">
	#login-table-header
	{
		background: #D1CBC3;
	}
</style>