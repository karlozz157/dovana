		</div>
		<div id="footer">
			<ul>
				<li><a href="#">2014 DOVANA // DERECHOS RESERVADOS</a></li>
				<li><a href="#">¿QUIÉNES SOMOS?</a></li>
				<li><a href="#">COSTOS Y POLÍTICAS DE ENVÍOS</a></li>
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