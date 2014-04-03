<?php foreach ($products as $i => $product): ?>
	<div class="content-images-product-category-search" style="<?php echo ($i%5 == 0) ? 'margin: 0;' : '' ?>">
		<a href="<?php echo base_url(); ?>site/product/<?php echo $product['id']; ?>">
		<?php $image = substr($product['image'], 0, strrpos($product['image'], '.')).'_180x180'.substr($product['image'], strrpos($product['image'], '.')); ?>
		<img src="<?php echo base_url(); ?>assets/media/img/180x180/<?php echo $image; ?>" class="images-product-category">	
		<span class="description-product-category">
			<?php echo strtoupper($product['name']); ?>
			<span>
				$<?php echo number_format($product['price'], 2); ?></span>
		</span>
	</a></div>
<?php endforeach; ?>