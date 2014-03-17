<style type="text/css">
fieldset p
{
    margin-bottom: 20px;
}
label
{
    display: inline-block;
    width: 120px;
}
</style>
<div class="clearfix">
    <?php if($this->session->flashdata('error_login_redirect_checkout')): ?>
        <div class="msg-red" style="text-align: center;">
            Para comprar es necesario que inicies sesión o te registres, una vez que hayas hecho alguna de las dos te redirigiremos al proceso de compra.
        </div>
    <?php endif; ?>  
    <?php  if($this->session->flashdata('error_login_redirect_checkout')){$redirect = '?redirect=checkout';}else{$redirect = '';} ?>  
    <div class="new-customer">
        <div class="inner-container clearfix">
            <div id="checkout">
                <div class="pane current">
                    <?php if($this->session->flashdata('success_register')): ?>
                        <div class="msg-green">
                            <?php echo $this->session->flashdata('success_register');  ?>
                        </div>
                    <?php endif; ?> 
                    <?php if($this->session->flashdata('error_register')): ?>
                        <div class="msg-red">
                            <?php echo $this->session->flashdata('error_register');  ?>
                        </div>
                    <?php endif; ?>           
                    <form  onsubmit="return $(this).validationEngine('validate');" method="post" action="<?php echo base_url(); ?>site/register<?php echo $redirect; ?>" id="register-form-action">
                        <div class="top clearfix">
                            <fieldset>
                                <legend>CREAR UNA NUEVA CUENTA</legend><br /><br />
                                    <p>
                                        <label for="mail"><span>*</span> Correo Electronico:</label>
                                        <input type="text" id="mail" name="email" class="validate[required, custom[email]] text">
                                    </p>
                                    <p>
                                        <label for="password"><span>*</span> Contraseña:</label>
                                        <input type="password" id="password" name="password" class="validate[required] text">
                                    </p> 
                                    <p>
                                        <label for="re-password"><span>*</span> Repetir Contraseña:</label>
                                        <input type="password" id="re-password" class="validate[required, equals[password]] text">
                                    </p>
                                    <p>
                                        <label for="f-name"><span>*</span> Nombre:</label>
                                        <input type="text" id="f-name" name="first_name" class="validate[required] text">
                                    </p>
                                    <p>
                                        <label for="l-name"><span>*</span> Apellidos:</label>
                                        <input type="text" id="l-name" name="last_name" class="validate[required] text">
                                    </p>                                                                                                  
                                    <p>
                                        <label for="gender"><span>*</span>Sexo:</label>
                                        <select id="gender" name="gender">
                                            <option value="male">Masculino</option>
                                            <option value="female">Femenino</option>
                                        </select>
                                    </p>
                                    <p>
                                        <input class="validate[required] checkbox" type="checkbox" id="agree" name="agree" />
                                        Aceptar aviso de privacidad y términos y condiciones.
                                    </p>
                            </fieldset>
                        </div>
                        <div class="bottom clearfix">
                            <input type="submit" id="submit" value="Registrarme">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

            <fieldset>

    <div class="login">
        <?php if($this->session->flashdata('error')): ?>
            <div class="msg-red">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
    	<h3><span>Iniciar Sesión</span></h3>
    	<form class="login-form" onsubmit="return $(this).validationEngine('validate');" id="login-form-action" method="post" action="<?php echo base_url(); ?>site/login<?php echo $redirect; ?>" >
        		<input type="text" id="email-login" name="email" class="validate[required, custom[email]]" placeholder="Correo Electronico" />
                <input type="password" id="password-login" name="password" class="validate[required]" placeholder="Contraseña" />
                <input class="login-btn" type="submit" value="Entrar" />
            </fieldset>
    	</form>
    </div>
</div>		
    