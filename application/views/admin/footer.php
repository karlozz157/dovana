
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->       
		</div>
		<!-- BEGIN PAGE -->     
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/excanvas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>  

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>


	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jquery-validation/dist/additional-methods.min.js"></script>


    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/data-tables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/data-tables/DT_bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery.validationEngine-es.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery.validationEngine.js"></script>


	<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>  

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>


	<script src="<?php echo base_url(); ?>assets/admin/plugins/flot/jquery.flot.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/flot/jquery.flot.resize.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/flot/jquery.flot.pie.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/flot/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/flot/jquery.flot.crosshair.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->


	<!-- END CORE PLUG


	INS -->
	<script src="<?php echo base_url(); ?>assets/admin/scripts/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/scripts/notifications.js"></script>  
	<script src="<?php echo base_url(); ?>assets/admin/scripts/index.js"></script> 
	<script src="<?php echo base_url(); ?>assets/admin/scripts/functions.js"></script>   
  
	<script>
		jQuery(document).ready(function() { 
			App.init();
			$('#tags_1').tagsInput({width:'auto'});
			Notifications.init();
			Validate.init();
			Product.init();
			Chart.init();
			Index.initDashboardDaterange();
			$('#dashboard-report-range span').html('<?php echo isset($start) ? $start : "" ; ?>' + ' - ' + '<?php echo isset($end) ? $end : "" ; ?>');
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>