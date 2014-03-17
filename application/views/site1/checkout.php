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
<div class="inner-container">
	<div class="cart">
        <h3>
			<span>lista de Articulos</span>
		</h3>
        <table>
    		<tbody>
    			<tr>
                    <th class="name-header">Nombre</th>
                    <th>SKU</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
                <?php $total = 0; $maxTotal = 0; ?>
                <?php foreach ($products as $product): ?>
                <?php
                    $total     = $product['quantity'] * $product['price'];
                  	$maxTotal += $total;  
                ?>
                <tr>
                    <td class="name" style="font-size: 13px;">
                    	
                        <?php echo $product['name']; ?>
                    </td>
                    <td style="font-size: 13px;">
                        <?php echo $product['sku']; ?>
                    </td>
                    <td class="qty">
              			<?php echo $product['quantity']; ?>
                    </td>
                    <td style="font-size: 13px;">
                        $<?php echo $product['price']; ?>
                    </td>
                    <td class="red">
                        $<?php echo $total; ?>
                    </td>
                </tr>                    
                <?php endforeach; ?>
        	</tbody>
    	</table>
 		<div class="clearfix">
        	<div class="right-column">
                <p class="total">Total: $<?php echo $maxTotal; ?></p>       	
        	</div>
        </div> 
        <h3>
			<span>Dirección de Envío</span>
		</h3>          	
		<div class="clearfix" style="border-top: 5px solid #efefef; padding-top: 20px;">
		    <div class="new-customer">
		        <div class="inner-container clearfix">
		            <div id="checkout">
		                <div class="pane current">        
		                    <form  onsubmit="return $(this).validationEngine('validate');" method="post" action="<?php echo base_url(); ?>cart/paypal" id="checkout-form-action">
		                        <div class="top clearfix">
		                            <fieldset>
	                                    <p>
	                                        <label for="mail"><span>*</span> Estado:</label>
	                                    	<select id="estado" name="estado" class="validate[required]">
	                                    	</select>
	                                    </p>
	                                    <p>
	                                        <label for="password"><span>*</span> Municipio:</label>
	                                    	<select id="municipio" name="municipio" class="validate[required]">
	                                    		<option value>Seleccione uno</option>
	                                    	</select>
										</p> 
	                                    <p>
	                                        <label for="re-password"><span>*</span> Colonia:</label>
	                                    	<input type="text" id="colonia" name="colonia" class="validate[required] text" maxlength="25">
	                                    </p>
	                                    <p>
	                                        <label for="l-name"><span>*</span> Codigo Postal:</label>
	                                        <input type="text" id="codigo_postal" name="codigo_postal" class="validate[required, custom[integer], maxSize[5]] text" maxlength="5">
	                                    </p>                                     
	                                    <p>
	                                        <label for="f-name"><span>*</span> Calle:</label>
	                                        <input type="text" id="calle" name="calle" class="validate[required] text" maxlength="100">
	                                    </p>
	                                    <p>
	                                        <label for="l-name"><span>*</span> No Exterior:</label>
	                                        <input type="text" id="no_exterior" name="no_exterior" class="validate[required, custom[integer]] text">
	                                    </p> 
	                                    <p>
	                                        <label for="l-name">No Interior:</label>
	                                        <input type="text" id="no_interior" name="no_interior" class="validate[custom[integer]] text" >
	                                    </p>
		                            </fieldset>
		                        </div>
		                        <div class=" clearfix">
		                            <input type="submit" id="submit" value="Comprar">
									<p>
										<a href="<?php echo base_url(); ?>cart/cancel" class="checkout">Cancelar</a>
									</p> 
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>    	
    </div><!-- end of #product-list -->
</div>
