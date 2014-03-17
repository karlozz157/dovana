<div class="inner-container">
	<div class="cart">
        <h3>
			<span>Lista de Compras</span>
		</h3>
        <table>
    		<tbody>
    			<tr>
                    <th>#</th>
    				<th>Fecha de Compra</th>
                    <th>Id PayPal</th>
                    <th>Total</th>
                    <th>Opciones</th>
                </tr>
                <?php $maxTotal = 0; ?>
                <?php foreach ($products as $i => $product): ?>
                <tr>
                    <td>
                        <?php echo ($i + 1); ?>
                    </td>
                    <td>
                    	<?php echo $product['date']; ?>
                    </td>
                    <td>
                        <?php echo $product['txn_id'] ?>
                    </td>
                    <td class="red">
                        $ <?php echo $product['total']; ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url(); ?>cart/purchase_view/<?php echo $product['id']; ?>" style="color: #f84e25;">
                            Detalles
                        </a>
                    </td>
                </tr>            
                <?php endforeach; ?>
        	</tbody>
    	</table>
    </div><!-- end of #product-list -->
</div>