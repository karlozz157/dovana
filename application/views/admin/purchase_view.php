
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid hidden-print">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<!-- END BEGIN STYLE CUSTOMIZER --> 
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Detalle Compra
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Inicio</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="#">Compras</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Detalle de Compra</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid invoice">
					<hr>
					<div class="row-fluid">
						<div class="span3">
							<h4>Cliente:</h4>
							<ul class="unstyled">
								<li><?php echo ucwords($user['name'].' '.$user['first_name'].' '.$user['last_name']); ?></li>
								<li><a href="mailto:<?php echo $user['email']; ?>;"><?php echo $user['email']; ?></a></li>
							</ul>
						</div>
						<div class="span4"></div>
						<div class="span4 invoice-payment">
							<h4>Detalles de la Compra (PayPal):</h4>
							<ul class="unstyled">
								<li><strong>Fecha:</strong> <?php echo $paypal['payment_date']; ?></li>
								<li><strong>PayPal Id:</strong> <?php echo $paypal['txn_id']; ?></li>
								<li><strong>Verify Sign:</strong> <?php echo $paypal['verify_sign']; ?></li>
							</ul>
						</div>
					</div>
					<div class="row-fluid" style="margin: 20px 0;">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Producto</th>
									<th class="hidden-480">Canitdad</th>
									<th class="hidden-480">Precio Unitario</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0; ?>
								<?php foreach($products as $i => $product): ?>
								<?php $total += $product['total_price']; ?>
								<tr>
									<td><?php echo ($i + 1); ?></td>
									<td><?php echo $product['name'] ?></td>
									<td><?php echo $product['quantity']; ?></td>
									<td class="hidden-480">$ <?php echo $product['unit_price']; ?></td>
									<td class="hidden-480">$ <?php echo $product['total_price']; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="row-fluid">
						<div class="span4">
							<div class="well">
								<h4>Dirección de Envío</h4>
								<address>
									<?php echo ucwords($address['calle']); ?>, No. Ext. <?php echo $address['no_exterior']; ?>, No. Int. <?php echo $address['no_interior']; ?><br>
									<?php echo ucwords($address['colonia']); ?>, <?php echo $address['codigo_postal']; ?><br />
									<?php echo $address['municipio']; ?>, <?php echo $address['estado']; ?><br>
									México<br />
								</address>
							</div>
						</div>
						<div class="span8">
							<div class="well">
								<h4>Mensaje de Envío</h4>
								<p>
									<b>De:</b> <?php echo ucwords($message['from_name'].' '.$message['from_second_name'].' '.$message['from_last_name']); ?><br>
									<b>Para:</b> <?php echo ucwords($message['to_name'].' '.$message['to_second_name'].' '.$message['to_last_name']); ?><br />
									<b>Mensaje:</b> <?php echo $message['from_message']; ?><br>
								</p>
							</div>
						</div>						
						<div class="span8 invoice-block">
							<ul class="unstyled amounts">
								<li><strong>Total:</strong> $ <?php echo $total; ?></li>
							</ul>
							<br>
							<a class="btn blue big hidden-print" onclick="javascript:window.print();">Imprimir <i class="icon-print icon-big"></i></a>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
