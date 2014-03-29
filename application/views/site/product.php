<div id="left-product">
	<?php $image = substr($product['image'], 0, strrpos($product['image'], '.')).'_500x500'.substr($product['image'], strrpos($product['image'], '.')); ?>
	<img src="<?php echo base_url(); ?>assets/media/img/500x500/<?php echo $image; ?>" id="grand">
	<!--
	<div id="content-thumb">
        <div class="content-preview-image">
            <img class="preview-image" src="<?php echo base_url(); ?>assets/media/img/<?php echo $product['image']; ?>"/>
        </div>            
    	<?php foreach ($images as $image): ?>
        	<div class="content-preview-image">
            	<img class="preview-image" src="<?php echo base_url(); ?>assets/media/img/<?php echo $image['name']; ?>"/>
        	</div>
    	<?php endforeach; ?> 
	</div>
	-->
</div>
<div id="right-product">
	<h1 id="title-product"><?php echo strtoupper($product['name']); ?></h1>
	<p id="price-product">$<?php echo number_format($product['price'], 2); ?></p>
	<?php if($product['stock'] > 0): ?>
	<div id="price-quantity">
		<p style="margin-right: 10px;">CANTIDAD</p>
		<select id="quantity">
			<?php for($i = 1; $i <= $product['stock']; $i++): ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php endfor; ?>
		</select>
	</div>
	<?php endif; ?>
	<div class="clear"></div>
	<div id="description-product">
		<h3>DETALLES DEL PRODUCTO</h3>
		<p><?php echo $product['description']; ?></p>
	</div>
	<?php if($product['stock'] > 0): ?>
	<a href="" class="add-cart add-to-cart" data-product-id="<?php echo $product['id']; ?>" data-product-image="<?php echo $product['image']; ?>" data-product-stock="<?php echo $product['stock']; ?>" data-product-name="<?php echo $product['name']; ?>" data-product-sku="<?php echo $product['sku']; ?>" data-product-price="<?php echo $product['price']; ?>">
		<span>AGREGAR A TUS COMPRAS</span>
	</a>
	<?php endif; ?>
</div>
<div class="clear"></div>
<span class="hr"></span>
<div id="releated-product">
	<h2>PRODUCTOS RELACIONADOS</h2>
	<div>
		<?php foreach ($products as $i => $product): ?>
			<a href="<?php echo base_url(); ?>site/product/<?php echo $product['id']; ?>">
				<?php $image = substr($product['image'], 0, strrpos($product['image'], '.')).'_180x180'.substr($product['image'], strrpos($product['image'], '.')); ?>
				<img src="<?php echo base_url(); ?>assets/media/img/180x180/<?php echo $image; ?>" class="thumb-product" style="margin:<?php echo 4 == $i ? '0' : ''; ?>;">
			</a>
		<?php endforeach ?>
	</div>			
</div>
<span class="hr"></span>
<div class="clear"></div>
<script type="text/javascript">
	$('.preview-image').live('click', function()
	{
		$('#grand').attr('src', $(this).attr('src'));
	});
</script>
