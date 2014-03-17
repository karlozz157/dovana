<div class="inner-container clearfix">
    <div id="product" class="clearfix">
        <div class="product-gallery">	
        	<div class="large-image" style="overflow: hidden; padding: 10px 0 20px 0;">
		   			<img src="<?php echo base_url(); ?>assets/media/img/<?php echo $product['image']; ?>" id="image-view" style="width: 55%;" />
        	</div>
                <div style="border: 1px solid #ccc; background: #fff; display: inline-block; margin: 0px 5px; text-align: center; padding: 5px;">
                    <img class="preview-image" src="<?php echo base_url(); ?>assets/media/img/<?php echo $product['image']; ?>" style="cursor: pointer; width: 65px; height: 75px;"/>
                </div>            
            <?php foreach ($images as $image): ?>
                <div style="border: 1px solid #ccc; background: #fff; display: inline-block; margin: 0px 5px; text-align: center; padding: 5px;">
                    <img class="preview-image" src="<?php echo base_url(); ?>assets/media/img/<?php echo $image['name']; ?>" style="cursor: pointer; width: 65px; height: 75px;"/>
                </div>
            <?php endforeach; ?>        
        </div>		
        <div class="product-detail">
    		<h2><?php echo $product['name']; ?></h2>
            <p>SKU: <?php echo $product['sku']; ?></p>
            <p>Disponibles: <?php echo $product['stock']; ?></p>
            <form class="options-form" method="get" action="#">
    			<fieldset>
                    <p class="qty">
                    	<label>Cantidad:</label>
                    	<select id="quantity">
                            <?php for ($i = 1; $i <= $product['stock']; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor ?>
                        </select>
                    </p>
                     <p class="price">Precio: $ <?php echo $product['price']; ?></p>
                    <a href="#" id="button-add-to-cart" class="add-to-cart" data-product-id="<?php echo $product['id']; ?>" data-product-stock="<?php echo $product['stock']; ?>" data-product-name="<?php echo $product['name']; ?>" data-product-sku="<?php echo $product['sku']; ?>" data-product-price="<?php echo $product['price']; ?>">Agregar</a>
	            </fieldset>
    	   </form>

        </div>
    </div>        
</div>

<div class="product-tabs">
    <ul class="tabs">
        <li><a>Descripción</a></li>
    </ul>									
    <div class="panes">
        <div class="tab-pane">
            <p><?php echo $product['description']; ?></p>
        </div>
    </div>
</div>

<div class="product-listing">
	<h3><span>Relacionados</span></h3>
    <?php $this->load->view('site/foreach-products'); ?>
</div>

<script type="text/javascript">
    $('.preview-image').click(function()
    {
        $('#image-view').attr('src', $(this).attr('src'));
    });
</script>
    		