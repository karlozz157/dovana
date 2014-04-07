<div id="container-table-purchase-success">
    <table id="details-purchase-success">
        <tr><td id="welcome-details-purchase-success">Hola <?php echo ucwords($user['name']); ?></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td style="font-style: italic;">A CONTINUACIÓN ENCONTRARÁS LOS DETALLES DE TU COMPRA...</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td id="head-products-details-purchase-success">    
                <table id="list-product-details-purchase-success" class="details-purchase-success">
                    <thead>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Envoltura</th>
                        <th>Precio Total</th>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td class="column-center-details-purchase-success">$<?php echo $product['unit_price']; ?></td>
                                <td class="column-center-details-purchase-success"><?php echo $product['quantity']; ?></td>
                                <td class="column-center-details-purchase-success"><?php echo $sending['name']; ?></td>
                                <td class="column-center-details-purchase-success">$<?php echo $product['total_price']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: url('<?php echo base_url(); ?>/assets/site/images/logo-pajarito.png') no-repeat; background-position: center; background-size: 30%; padding-top: 15px;">
                <table class="details-send">
                    <tbody>
                        <tr><td style="font-style: italic; font-size: 11pt;">DIRECCIÓN DE ENVÍO</td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td><?php echo ucwords($user['first_name'].' '.$user['last_name']); ?></td></tr>
                        <tr><td>México - <?php echo $address['estado']; ?></td></tr>
                        <tr><td><?php echo $address['municipio']; ?> - <?php echo $address['colonia']; ?></td></tr>
                        <tr><td><?php echo $address['codigo_postal'] ?></td></tr>
                        <tr><td><?php echo $address['calle']; ?> - <?php echo $address['no_exterior']; ?></td></tr>
                    </tbody>
                </table>
                <table>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                </table>
                <table class="details-send">
                    <tbody>
                        <tr><td style="font-style: italic; font-size: 11pt;">ACUSE DE RECIBO</td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>De: <?php echo strtoupper($message['from_name']); ?></td></tr>
                        <tr><td>Para: <?php echo strtoupper($message['to_name']); ?></td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr><td style="font-family: 'Brandon Grotesque'; font-size: 11pt;font-style: italic; text-align: right;">En breve te enviaremos tu factura a tu mail.</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td style="text-align: center; border-top: 1px solid #333F48; font-size: 26pt; font-style: italic; padding-top: 30px;">
                ¡DOVANA TE AGRADECE TU COMPRA!
            </td> 
        </tr>
    </table>
</div>
<script type="text/javascript">
    delete(localStorage.simpleCart_items);
    document.getElementById('count-items').innerHTML = 0;
</script>