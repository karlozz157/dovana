<img src="<?php echo base_url(); ?>assets/site/images/title-index.png" style="margin: auto; display: block; width: 600px">

<?php if($sliders): ?>
<div id="slider1_container" class="slider-index" style="position: relative; top: 0px; left: 0px; height: 512px; width: 1020px;">
    <div u="slides" style="border: 1px solid #73787C; cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; 	height: 512px; width: 1020px;">
		<?php foreach ($sliders as $slider): ?>
			<div><a href="<?php echo '' != $slider['url']?$slider['url']:'#'; ?>"><img src="<?php echo base_url(); ?>assets/media/img/<?php echo $slider['image']; ?>" class="slider"></a></div>
		<?php endforeach ?>
    </div>
</div>
<?php endif; ?>

<h3 id="title-promociones">NOTICIAS DOVANA // PROMOCIONES</h3>

<?php if($promociones): ?>
<div id="slider2_container" class="slider-index" style="position: relative; top: 0px; left: 0px; height: 512px; width: 1020px;">
    <div u="slides" style="border: 1px solid #73787C; cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; 	height: 512px; width: 1020px;">
		<?php foreach ($promociones as $promocion): ?>
			<div><a href="<?php echo '' != $slider['url']?$slider['url']:'#'; ?>"><img src="<?php echo base_url(); ?>assets/media/img/<?php echo $promocion['image']; ?>" class="slider"></a></div>
		<?php endforeach ?>
    </div>
</div>
<?php endif; ?>