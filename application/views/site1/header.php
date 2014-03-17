<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo isset($config['name'])?$config['name']:''; ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/site/style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/site/jquery.selectBox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/validationEngine.jquery.css" />
    <style type="text/css">
    .message-ajax
    {
        box-shadow: 0px 0px 10px #000; border-radius: 3px; color: #333; display: none; left: 550px; top: 25px; position: fixed; z-index: 100;
    }
    </style>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
    </script>	
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	
    <!-- START of HEADER WRAPPER -->
	<div class="header-wrapper">
    		
            <div id="header" class="clearfix">
                    <!--
             
                    <a href="index.html" class="logo"><img src="<?php echo base_url(); ?>assets/site/images/logo.png" alt="BonFire Logo" /></a>
              
                    <strong class="slogan">SO TURN THE LIGHTS OUT</strong>-->
                    <ul class="top-nav">
                        <?php if(false != $logged): ?><li>Hola <?php echo ucwords($logged['first_name']); ?></li><?php endif; ?>
                        <li><a href="<?php echo base_url(); ?>cart/list_cart">Carrito de Compras</a></li>
                        <li><a href="<?php echo base_url(); ?>cart/list_cart" class="cart">&nbsp;</a><span class="cart-bubble" id="count-items"></span></li>    
                    <?php if(false != $logged): ?>
                        <!-- TOP NAV -->
                            <li><a href="<?php echo base_url(); ?>cart/list_purchase">Mi Compras</a></li>
                            <li><a href="<?php echo base_url(); ?>site/logout">Salir</a></li>
                <?php endif; ?>
                    </ul><!-- end of .top-nav -->
            </div><!-- end of #header -->
            
    </div>
	<!-- END OF HEADER WRAPPER -->
    
    
    <!-- START of NAVIGATION WRAPPER -->
    <div class="navigation-wrapper">    
            <!-- MAIN NAVIGATION -->
		    <ul id="navigation" class="clearfix">
            		<li><a href="<?php echo base_url(); ?>site"><img src="<?php echo base_url(); ?>assets/site/images/home.png" alt="" />Home</a></li>
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo base_url(); ?>site/category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>   
                        <ul>
                            <?php foreach ($this->commerce->getSubCategories($category['id']) as $subCategory): ?>
                            <li><a href="<?php echo base_url(); ?>site/category/<?php echo $subCategory['id']; ?>"><?php echo ucwords(strtolower($subCategory['name'])); ?></a></li>    
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php endforeach; ?>
		    </ul><!-- end of #navigation -->
            
  	</div>
    <!-- END of NAVIGATION WRAPPER -->
    
    
    <!-- START of BOTTOM -->
    <div class="bottom-wrapper">
    
		    <div id="bottom" class="clearfix">
                    <?php if(false === $logged): ?>
                        <strong class="welcome-message">Bienvenido, puedes <a href="<?php echo base_url(); ?>site/cart">Entrar</a> o <a href="<?php echo base_url(); ?>site/cart">Crear una Cuenta</a>.</strong>
                    <?php endif; ?> 
                    <div class="right">        
                        <form class="search" method="get" name="search" action="<?php echo base_url() ?>site/search/" onsubmit="search.submit()">
                    			<fieldset>
                    	        		<input type="text" id="s" name="q" value="<?php echo get_request('s'); ?>" placeholder="Search" />
                    	                <input class="submit" type="submit" value="Submit" />
                    	        </fieldset>
                    	</form><!-- end of .search -->
                    	
                    </div>
            
		    </div><!-- end of #bottom -->
            
    </div>
    <!-- END of BOTTOM -->
    
    <div class="msg-red message-ajax" id="message-ajax-error"></div>
    <div class="msg-blue message-ajax" id="message-ajax-success"></div>

    <div class="container">