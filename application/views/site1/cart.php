<div class="inner-container">
	<div class="cart">
        <h3>
			<span>Carrito de Compras</span>
		</h3>
        <table>
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th class="name-header">Nombre</th>
                    <th>SKU</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
    		<tbody id="list-cart"></tbody>
    	</table>                               
        <div class="clearfix">	
            <div class="left-column">
                <div class="msg-red" id="login-error" style="display: none;"></div>
            </div>
        	<div class="right-column">
                <p class="total" id="total"></p>
                <p>
                    <a id="remove-cart" class="checkout">Eliminar</a>
                    <a href="javascript:window.location.reload();" class="checkout">Actualizar</a>
                	<a href="<?php echo base_url(); ?>cart/process_checkout" class="checkout">Comprar</a>
                </p>
        	</div>
        </div>
    </div><!-- end of #product-list -->
</div>