<ul class="clearfix grid-view">
	<?php foreach ($products as $p => $product): ?>
		<?php $i = isset($category) ? 3 : 4; ?>
		<?php $last = ($p + 1) % $i == 0 ? 'last' : ''; ?>
		<li class="product <?php echo $last; ?>">
        	<a href="<?php echo base_url(); ?>site/product/<?php echo $product['id']; ?>" class="thumb">
        		<img src="<?php echo base_url(); ?>assets/media/img/<?php echo $product['image']; ?>" style="margin-top: 15px; width: 70%;" alt="" />
        	</a>
			<div class="data">
				<a href="product.html" class="title"><?php echo $product['name']; ?></a>
				<div class="clearfix info">
					<a href="#" class="add-to-cart" data-product-id="<?php echo $product['id']; ?>" data-product-name="<?php echo $product['name']; ?>" data-product-sku="<?php echo $product['sku']; ?>" data-product-stock="<?php echo $product['stock']; ?>" data-product-price="<?php echo $product['price']; ?>">Agregar</a>
					<span class="price-text">$<span><?php echo $product['price']; ?></span></span>
				</div>
			</div>
        </li>
    <?php endforeach ?>
</ul>
<p class="pagination">
	<?php if(isset($length)): ?>
		<?php for($i = 1; $i < $length; $i++): ?>
			<a href="<?php echo base_url() ?>site/category/<?php echo $category; ?>/<?php echo $i; ?>/<?php echo $limit; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	<?php endif; ?>
</p>
