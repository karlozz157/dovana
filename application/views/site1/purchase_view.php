<div class="inner-container">
	<div class="cart">
        <h3>
			<span>Detalle de Compra</span>
		</h3>
        <table>
    		<tbody>
    			<tr>
    				<th>Fecha de Compra</th>
                    <th>Id PayPal</th>
                    <th colspan="2" class="name-header">Producto</th>
                    <th>SKU</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
                <?php $maxTotal = 0; ?>
                <?php foreach ($products as $product): ?>
                <?php $maxTotal += $product['total_price']; ?>
                <tr>
                	<td>
                		<?php echo $product['date']; ?>
                	</td>
                     <td><?php echo $product['paypal']; ?></td>
                    <td colspan="2" class="name" style="font-size: 13px;">
                        <div style="margin: 10px 0;">
                            <img src="<?php echo base_url(); ?>assets/media/img/<?php echo $product['image'] ?>" style="display: inline-block; width: 50px;" />
                            <div style="display: inline-block; vertical-align: top; width: 70%;"><?php echo $product['name']; ?></div>
                        </div>
                    </td>
                    <td style="font-size: 13px;">
                        <?php echo $product['sku']; ?>
                    </td>
                    <td class="qty">
              			<?php echo $product['quantity']; ?>
                    </td>
                    <td style="font-size: 13px;">
                        $<?php echo $product['unit_price']; ?>
                    </td>
                    <td class="red">
                        $<?php echo $product['total_price']; ?>
                    </td>
                </tr>                    
                <?php endforeach; ?>
        	</tbody>
    	</table>

        <div class="clearfix">  
            <div class="left-column" style="color: #636363; font: 13px 'pt_sans', Arial, Helvetica, sans-serif;">
                <p style="color: #f84e25; font-size: 22px;">Dirección de Envío</p>
                <address style="line-height: 19px;">
                    <?php echo ucwords($address['calle']); ?>, No. Ext. <?php echo $address['no_exterior']; ?>, No. Int. <?php echo $address['no_interior']; ?><br>
                    <?php echo ucwords($address['colonia']); ?>, <?php echo $address['codigo_postal'] ?><br>
                    <?php echo ucwords($address['municipio']); ?>, <?php echo $address['estado']; ?><br>
                    México<br>
                </address>
            </div>

		    <div class="left-column">
		        <div class="msg-red" id="login-error" style="display: none;"></div>
		    </div>
			<div class="right-column">
		        <p class="total">Total: $ <?php echo $maxTotal; ?></p>
		        <p>
		        	<a href="<?php echo base_url(); ?>cart/list_purchase" class="checkout">Regresar</a>
		        </p>
			</div>
		</div>


    </div><!-- end of #product-list -->
</div>