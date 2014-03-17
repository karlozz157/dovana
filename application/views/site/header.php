<html lang="es">  
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://necolas.github.io/normalize.css/3.0.0/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/validationEngine.jquery.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/alertify.core.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/alertify.default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/ui-lightness/jquery-ui-1.10.4.custom.css">
	<script type="text/javascript" src="http://karlozz157.com/projects/commerce/assets/site/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<a href="<?php echo base_url(); ?>site"><img src="<?php echo base_url(); ?>assets/site/images/Logo.png" id="logo"></a>
			<div id="info-header">
				<table>
					<tr>
						<td id="contact-table-header" style="border-bottom: 1px solid #4B565C;"><img src="<?php echo base_url(); ?>assets/site/images/icon-tel.png" id="icon-tel">
							<a href="<?php echo base_url(); ?>site/contacto">CONTACTO</a>
						</td>
						<td id="cart-table-header" rowspan="2" style="border-left: 1px solid #4B565C;">
							<img src="<?php echo base_url(); ?>assets/site/images/icon-cart.png" id="cart-image">
							<div id="cart-count">+0</div>
							<a style="display: block;" href="<?php echo base_url(); ?>cart/list_cart">TUS COMPRAS</a>
						</td>
					</tr>
					<tr>
						<td id="login-table-header">
							<?php if(true === empty($logged)): ?>
								<a href="<?php echo base_url(); ?>site/cart">ENTRAR // REGISTRATE</a>
							<?php else: ?>
								<a href="<?php echo base_url(); ?>site/logout">CERRAR SESIÓN</a>
							<?php endif; ?>
						</td>
					</tr>
				</table>
				<div id="search">
					<form method="get" action="<?php echo base_url(); ?>site/search">
						<img src="<?php echo base_url(); ?>assets/site/images/icon-search.png">
						<input  type="text" name="q"/></div>
					</form>
			</div>
			<div class="clear"></div>
			<div id="menu">
				<ul>
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo base_url(); ?>site/category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>   
                    	<?php $submenu = $this->commerce->getSubCategories($category['id']); ?>
                        <?php if(!empty($submenu)): ?>
                        <ul class="submenu">
                            <?php foreach ($submenu as $subCategory): ?>
                            <li><a href="<?php echo base_url(); ?>site/category/<?php echo $subCategory['id']; ?>"><?php echo ucwords(strtolower($subCategory['name'])); ?></a></li>    
                            <?php endforeach; ?>
                        </ul>
                    	<?php endif; ?>
                    </li>
                	<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div id="wrapper-content">
