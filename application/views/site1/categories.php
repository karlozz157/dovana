<div id="sidebar">
	<h3><span>Categorías</span></h3>
	<ul>
		<?php foreach ($categories as $category): ?>
		<li><a href="<?php echo base_url(); ?>site/category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
		<?php endforeach ?>
	</ul>
</div>
