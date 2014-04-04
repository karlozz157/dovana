<style type="text/css">
fieldset label
{
	display: inline-block;
	width: 100px;
}
fieldset p
{
	margin-bottom: 20px;
}
</style>
<div id="wrapper-checkout">
	<?php if ($this->session->flashdata('checkout_error')): ?>
		<div class="msg-red">
			<?php echo $this->session->flashdata('checkout_error'); ?>
		</div>
	<?php endif; ?>	
	<h1>TU PEDIDO</h1>
	<table id="description-checkout" class="table-products">
		<thead>
			<tr>
	            <th>PRODUCTO</th>
	            <th>CÓDIGO</th>
	            <th>PRECIO</th>
	            <th>CANTIDAD</th>
	            <th>ENVOLTURA</th>
	            <th>TOTAL</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php $total = 0; $maxTotal = 0; ?>
	        <?php foreach ($products as $product): ?>
	        <?php
	            $total     = (floatval($product['price']) + floatval($product['envoltura'])) * intval($product['quantity']);
	          	$maxTotal += $total;  
	        ?>
				<tr>
					<td><?php echo $product['name']; ?></td>
					<td><?php echo $product['sku']; ?></td>
					<td>$ <?php echo $product['price']; ?></td>
					<td><?php echo $product['quantity'] ?></td>
					<td>$ <?php echo number_format($product['envoltura'], 2); ?></td>
					<td>$ <?php echo number_format($total, 2); ?></td>
				</tr> 
	        <?php endforeach; ?>
		</tbody>
	</table>
	<form  onsubmit="return $(this).validationEngine('validate');" method="post" action="<?php echo base_url(); ?>cart/paypal" id="checkout-form-action" class="validate-form">
	<div class="clear"></div>
	<div id="checkout-send">
		<span style="background: #4B565C; color: #D1CBC3; float: left; font-family: 'Brandon Grotesque Bold'; font-size: 16px; display: block; text-align: right; vertical-align: top; padding: 5px 10px 5px 0; width: 100px;">ENVÍO</span>
		<select name="sending" id="sending" style="float: left; display: block; vertical-align: top; height: 31px;">
				<option value="0" data-price="0">SELECCIONA UNO</option>
			<?php foreach ($sending as $send): ?>
				<option value="<?php echo $send['id']; ?>" data-price="<?php echo $send['price']; ?>"><?php echo $send['name']; ?></option>
			<?php endforeach ?>
		</select>
		<div class="clear"></div>
		<div style="font-style: italic; margin-top: 10px;">
			* Recuerda que sólo se puede mandar a una sóla dirección. Si tienes varios regalos que hacer y<br />
			mandarlos a diferentes direcciones debes hacer tus compras por separado.
		</div>
	</div>
	<div id="checkout-total">	
		<div class="clear"></div>
		<span><b>TOTAL: $</b><b id="grand-total-checkout" data-total="<?php echo number_format($maxTotal, 2); ?>"><?php echo number_format($maxTotal, 2); ?><b></span>
	</div> 
	<div id="address-checkout">     
		<h3>DIRECCIÓN DE ENVÍO</h3>
			<p>
			    <label for="mail"><span>*</span> Estado</label>
				<select id="estado" name="estado" class="validate[required]">
					<option value>SELECCIONE UNO</option>
				</select>
			</p>
			<p>
			    <label for="password"><span>*</span> Municipio</label>
				<select id="municipio" name="municipio" class="validate[required]">
					<option value>SELECCIONE UNO</option>
				</select>
			</p> 
			<p>
			    <label for="re-password"><span>*</span> Colonia</label>
				<input type="text" id="colonia" name="colonia" class="validate[required] text" maxlength="25">
			</p>
			<p>
			    <label for="l-name"><span>*</span> Codigo Postal</label>
			    <input type="text" id="codigo_postal" name="codigo_postal" class="validate[required, custom[integer], maxSize[5]] text" maxlength="5">
			</p>                                     
			<p>
			    <label for="f-name"><span>*</span> Calle</label>
			    <input type="text" id="calle" name="calle" class="validate[required] text" maxlength="100">
			</p>
			<p>
			    <label for="l-name"><span>*</span> No Exterior</label>
			    <input type="text" id="no_exterior" name="no_exterior" class="validate[required, custom[integer]] text">
			</p> 
			<p>
			    <label for="l-name">No Interior</label>
			    <input type="text" id="no_interior" name="no_interior" class="validate[custom[integer]] text" >
			</p>
			<p>
				<input type="checkbox" name="factura" id="factura" data-iva="<?php echo $config['iva']; ?>" value="1" style="margin-bottom: 25px; width: 25px;"> 
				<span style="font-family: 'Brandon Grotesque'; font-style: italic; font-size: 9pt;">Necesito Factura</span>
				<button type="submit" id="purchase-checkout">
					<span>COMPRAR</span>
				</button>
			</p>
	</div>	 
	<div id="message-checkout">
		<h3>ESCRIBE UN MENSAJE EN TU REGALO</h3> 
			<p>DE:<p>
			<p>
				<input type="text" name="from_name" id="from_name" class="send" placeholder="NOMBRE">
				<input type="text" name="from_second_name" class="send" placeholder="APELLIDO PATERNO" style="margin: 0px 10px;">
				<input type="text" name="from_last_name" class="send" placeholder="APELLIDO MATERNO">
			</p>
			<p>PARA:</p>
			<p>
				<input type="text" name="to_name" class="send" placeholder="NOMBRE">
				<input type="text" name="to_second_name" class="send" placeholder="APELLIDO PATERNO" style="margin: 0px 10px;">
				<input type="text" name="to_last_name" class="send" placeholder="APELLIDO MATERNO">
			</p>
			<p>MENSAJE:</p>
			<p>
				<td colspan="3"><textarea name="from_message" class="send"></textarea></td>
			</p>
		
	</div>
		<?php foreach ($products as $product): ?>
			<?php if($product['envoltura'] != 0): ?>
				<input type="hidden" name="envoltura" value="1">
				<script type="text/javascript">
					$('.send').addClass('validate[required]');
				</script>
				<?php break; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</form>
</div>
<div class="clear"></div>

<script type="text/javascript">
(function(){

	$('#factura').live('click', function()
	{
		var iva     = $(this).attr('data-iva');
		var total   = $('#grand-total-checkout');
		var resullt = 0;

		if(true === $(this)[0].checked)
		{
			result = parseFloat(iva)/100 * parseFloat(total.text()) + parseFloat(total.text());
		}
		else
		{
			result = total.attr('data-total');
		}

		total.html(result);
	});

	var checkoutTotal = $('#checkout-total span b');
	localStorage.checkoutTotal = checkoutTotal.text();

	$('#sending').live('change', function()
	{
		var price = $($(this)[0][$(this)[0].selectedIndex]).attr('data-price')
		checkoutTotal.html(parseFloat(localStorage.checkoutTotal) + parseFloat(price));
	});
})();
</script>
