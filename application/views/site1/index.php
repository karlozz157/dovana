<div id="slider">
    <div class="slides" id="slides">
        <?php foreach ($slides as $slider): ?>
            <div class="slide" style="background: #fff; text-align: center;">
                <a href="<?php echo base_url(); ?>site/product/<?php echo $slider['id']; ?>">
                    <img src="<?php echo base_url(); ?>assets/media/img/<?php echo $slider['image']; ?>" style="margin-top: 25px; width: 350px;" /></a>                                    
                    <div style="font-family: 'TerminalDosisMedium', Arial, Helvetica, sans-serif; font-size: 25px; display: inline-block; vertical-align: top; text-align: left; margin-top: 75px;">
                        <?php echo $slider['name']; ?>
                        <a href="#" style="display: block; font-size: 16px;" class="add-to-cart" data-product-id="<?php echo $slider['id']; ?>" data-product-name="<?php echo $slider['name']; ?>" data-product-stock="<?php echo $slider['stock']; ?>" data-product-sku="<?php echo $slider['sku']; ?>" data-product-price="<?php echo $slider['price']; ?>">Agregar</a>
                        <span class="price" style="color: #fd5f37; display: block; font-size: 32px;">$<?php echo $slider['price']; ?></span>
                    </div>
            </div>            
        <?php endforeach; ?>
    </div>    
    <div id="slider-pager"></div>                    
</div>

<div class="inner-container clearfix">   
    <div id="all-product">
        <div class="product-listing">
     		<h3><span>Destacados</span></h3>
            <?php $this->load->view('site/foreach-products'); ?>
        </div>
    </div>
</div>
    		