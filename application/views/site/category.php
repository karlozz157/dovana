<div id="sidebar-category">
	<h2 id="title-sidebar-category"><?php echo $sidebar[0]['parentCategory']['name']; ?></h2>
	<ul id="menu-sidebar-category">
		<?php foreach ($sidebar[1]['subCategories'] as $subCategory): ?>
			<li><a href="<?php echo base_url(); ?>site/category/<?php echo $subCategory['id']; ?>" style="<?php echo $id == $subCategory['id'] ? 'font-family: Brandon Grotesque Medium; font-style: italic;' : ''; ?>"><?php echo $subCategory['name']; ?></a></li>
		<?php endforeach ?>
	</ul>
</div>
<div id="content-category">
	<div style="text-align: center;">
		<img src="<?php echo base_url(); ?>assets/site/images/title-index.png" style="margin-bottom: 15px; width: 650px;">
	</div>
	<?php if('' != $category['image']): ?>
		<img src="<?php echo base_url(); ?>assets/media/img/<?php echo $category['image']; ?>" id="image-category">
	<?php endif; ?>
	<div id="description-category" style="width: <?php echo '' == $category['image'] ? '95%' : ''; ?>">
		<h1 id="title-category"><?php echo strtoupper($category['name']); ?></h1>
		<p><?php echo $category['description']; ?></p>
	</div>
	<div class="clear"></div>
	<h2 id="images-title-category">GALERÍA DE PRODUCTOS</h2>
	<div id="content-products-gategory">
		<?php foreach ($products as $i => $product): ?>
			<div class="content-images-product-category <?php echo ($i%3 == 1) ? 'margin' : '' ?>">
				<a href="<?php echo base_url(); ?><?php if($product['lightbox'] == 0):  ?>site/product/<?php echo $product['id']; ?><?php else: ?>assets/media/img/<?php echo $product['image']; ?><?php endif; ?>" class="<?php echo $product['lightbox'] == 1 ? 'lightbox' : '' ?>">
				<?php $image = substr($product['image'], 0, strrpos($product['image'], '.')).'_250x250'.substr($product['image'], strrpos($product['image'], '.')); ?>
				<img src="<?php echo base_url(); ?>assets/media/img/250x250/<?php echo $image; ?>" class="images-product-category">	
				<span class="description-product-category">
					<?php $name = strtoupper($product['name']);
						if('SIN TITULO' != substr($name, 0, 10))
							echo $name;

					 ?>
					<span>
						$<?php echo number_format($product['price'], 2); ?></span>
				</span>
			</a></div>
		<?php endforeach; ?>
	</div>
</div>
<div class="clear"></div>