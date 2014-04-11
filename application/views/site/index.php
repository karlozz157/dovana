<img src="<?php echo base_url(); ?>assets/site/images/title-index.png" style="margin: 0px auto 25px auto; display: block; width: 600px">

<?php if($sliders): ?>
<div style="border: 1px solid #73787C; padding: 10px;">
	<div id="slider1_container" class="slider-index" style="position: relative; top: 0px; left: 0px; height: 492px; width: 1000px;">
	    <div u="slides" style="cursor: move; text-align: center; position: absolute; overflow: hidden; left: 0px; top: 0px; 	height: 492px; width: 1000px;">
			<?php foreach ($sliders as $slider): ?>
				<div><a href="<?php echo '' != $slider['url']?$slider['url']:'#'; ?>"><img src="<?php echo base_url(); ?>assets/media/img/<?php echo $slider['image']; ?>" class="slider"></a></div>
			<?php endforeach ?>
	    </div>
	</div>
</div>
<?php endif; ?>

<h3 id="title-promociones">NOTICIAS DOVANA // PROMOCIONES</h3>

<?php if($promociones): ?>
<div style="border: 1px solid #73787C; padding: 10px;">
	<div id="slider2_container" class="slider-index" style="position: relative; top: 0px; left: 0px; height: 492px; width: 1000px;">
	    <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; 	height: 492px; width: 1000px;">
			<?php foreach ($promociones as $promocion): ?>
				<div><a href="<?php echo '' != $slider['url']?$slider['url']:'#'; ?>"><img src="<?php echo base_url(); ?>assets/media/img/<?php echo $promocion['image']; ?>" class="slider"></a></div>
			<?php endforeach ?>
	    </div>
	</div>
</div>
<?php endif; ?>