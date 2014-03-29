<div id="wrapper-cart" >
    <h1>TU PEDIDO</h1>
    <table id="products-cart" class="table-products">
		<tbody id="list-cart"></tbody>
	</table>                               
    <div class="clearfix">	
        <div class="left-column">
            <div class="msg-red" id="login-error" style="display: none;"></div>
        </div>
    	<div class="right-column">
            <p class="grand-total">
                <p style="border-top: 1px solid #4B565C; display: inline-block; vertical:; float: left; margin-top: 40px; width: 75%;"></p>
                <p style="float: right; display: inline-block;" id="total"></p>
            </p>
            <div class="clear"></div>
            <p>
               <!--<a id="remove-cart" class="checkout">Eliminar</a>
                <a href="javascript:window.location.reload();" class="checkout">Actualizar</a>-->
            	<a href="<?php echo base_url(); ?>cart/process_checkout" id="process_checkout" class="checkout">
                    <span>Comprar</span>
                </a>
            </p>
    	</div>
    </div>
</div><!-- end of #product-list -->
<div class="clear"></div>
<style type="text/css">
    #cart-table-header
    {
        background: #D1CBC3;

    }
    #cart-count
    {
        background: #fff;
    }
</style>
