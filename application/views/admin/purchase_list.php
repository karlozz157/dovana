<div class="row-fluid">
	<div class="span12">
		<!-- END BEGIN STYLE CUSTOMIZER -->   
		<h3 class="page-title">
			Compras
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<span class="icon-angle-right"></span>
			</li>
			<li>
				<a href="#">Compras</a>
				<span class="icon-angle-right"></span>
			</li>
			<li><a href="#">Listado de Compras</a></li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<?php if($pages > 1): ?>
	<div class="pagination" style="margin-top: 0;">
		<ul>	
			<?php for($i = 1; $i <= $pages; $i++): ?>
				<li><a href="<?php echo base_url(); ?>admin/product_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</div>
	<?php endif; ?>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-comments"></i>Listado de Compras</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>		
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Usuario</th>
					<th>Paypal Id</th>
					<th>Total</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($purchase as $p): ?>
					<tr>
						<td><?php echo $p['date']; ?></td>
						<td><?php echo ucwords($p['first_name'].' '.$p['last_name']); ?></td>
						<td><?php echo $p['txn_id']; ?></td>
						<td>$ <?php echo $p['total']; ?></td>
						<td><a href="<?php echo base_url(); ?>admin/purchase_view/<?php echo $p['id']; ?>" class="btn icn-only purple  tooltips" data-original-title="Detalles de la Compra"><i class="icon-list"></i></a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="pagination">
	<ul>
	<?php if($pages > 1): ?>
		<?php for($i = 1; $i <= $pages; $i++): ?>
			<li><a href="<?php echo base_url(); ?>admin/purchase_list/<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>
	<?php endif; ?>	
	</ul>
</div>
