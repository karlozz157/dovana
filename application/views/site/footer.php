		</div>
		<div id="footer">
			<ul>
				<li><a href="#">2014 DOVANA // DERECHOS RESERVADOS</a></li>
				<li><a href="<?php echo base_url(); ?>site/nosotros" target="_blank">¿QUIÉNES SOMOS?</a></li>
				<li><a href="<?php echo base_url(); ?>site/aviso_privacidad_cambios_devoluciones" target="_blank">AVISO PRIVACIDAD // CAMBIOS Y DEVOLUCIONES</a></li>
				<li><a href="#">POLÍTICAS DE ENVÍOS</a></li>
				<li><a href="#">SIGUENOS EN </a></li>
			</ul>
		</div>

	</div>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery.validationEngine-es.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/simpleCart.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/alertify.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jssor.slider.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/script.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){

			$('.lightbox').click(function(event)
			{
				event.preventDefault();

				var src = $(this).attr('href');

				$('body').append('<div id="content-lightbox"><div><img src="'+base_url+'assets/site/images/close-icon.png" id="close-lightbox" /><img src="'+src+'" id="image-lightbox"/><span>* Para comprar esta obra favor de ir decoración para el hogar // arte</span></div></div>');

				//implement a callback
				setTimeout(function()
				{
					var height = $('#image-lightbox').height();
					var width  = $('#image-lightbox').width();

					$('#image-lightbox').css(
					{
						height     : height/5,
						width      : width/5,
					}).parent().parent().css('visibility', 'visible');

				}, 500);
			});

			$('#close-lightbox').live('click', function()
			{
				$('#content-lightbox').remove();
			});

			$( "#datepicker" ).datepicker();
			
			$('.formErrorContent').live('click', function()
			{
				$(this).parent().remove();
			});

			jQuery('.validate-form').validationEngine();
			

			var options = { $AutoPlay: true };
			var jssor_slider1 = new $JssorSlider$('slider1_container', options);
			var jssor_slider2 = new $JssorSlider$('slider2_container', options);
			
		});
	</script>
</body>
</html>