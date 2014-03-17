
<!--https://www.paypal.com/cgi-bin/webscr-->
<form name="formTpv" action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="f1" id="f1" method="post"> 
    <fieldset> 
        <input type="hidden" name="shipping" value="0"> 
        <input type="hidden" name="cmd" value="_xclick"> 
        <input type="hidden" name="rm" value="2"> 
        <input type="hidden" name="bn" value="nombre de la empresa vendedora"> 
        <input type="hidden" name="business" value="<?php echo $config['email']; ?>"> 
        <input type="hidden" name="item_name" value="Compra en <?php echo ucwords($config['name']); ?>"> 
        <input type="hidden" name="item_number" value="Venta Tienda"> 
        <input type="hidden" name="amount" value="<?php echo $amount; ?>"> 
        <input type="hidden" name="custom" value="<?php echo $amount; ?>"> 
        <input type="hidden" name="currency_code" value="MXN"> 
        <input type="hidden" name="image_url" value=""> 
        <input type="hidden" name="first_name" value="<?php echo $user['first_name'] ?>">
        <input type="hidden" name="last_name" value="<?php echo $user['last_name'] ?>"> 
        <input type="hidden" name="return" value="<?php echo base_url(); ?>cart/success"> 
        <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>cart/cancel"> 
        <input type="hidden" name="no_shipping" value="0"> 
        <input type="hidden" name="no_note" value="0"> 
    </fieldset> 
</form> 
<script type='text/javascript'>
    document.formTpv.submit();
</script>
