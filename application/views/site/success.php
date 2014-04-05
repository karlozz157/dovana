<style type="text/css">
    #container-table
    {
        background: #fff;
        font-family: 'Brandon Grotesque Medium';
        padding: 25px 10px;
        margin-bottom: 25px;
    }
    #table-details-purchase
    {
        margin: auto;
        width: 700px;
    }

    .text
    {
        font-size: 12pt;
    }

    .text p
    {  
        margin: 10px 0;
    }

    .details
    {
        width: 700px;
    }

    .details thead
    {
        background-color: rgba(115, 120, 124, .2);
    }

    .details thead th
    {
        font-family: 'Brandon Grotesque Medium'; 
        font-size: 9pt;
        font-weight: normal;
        text-transform: uppercase;
        padding: 7px 0px;
    }


    .details tbody td
    {
        font-size: 10pt;
        font-family: 'Brandon Grotesque Bold';  
        text-transform: uppercase;     
        padding: 7px 14px;
    }

    .details-send td
    {
        font-family: 'Brandon Grotesque';
        font-size: 10pt;
        font-style: italic;
    }

    .column-center
    {  
        text-align: center;
    }

    #list-product
    {
        margin-bottom: 20px;
    }
    </style>
<div id="container-table">
    <table id="table-details-purchase">
        <tr><td style="font-size: 26pt; font-style: italic; text-transform: uppercase;"><p>Hola <span><?php echo ucwords($user['name']); ?></span></p></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td style="font-style: 14pt; font-style: italic; font-family: 'Brandon Grotesque';"><p>A CONTINUACIÓN ENCONTRARÁS LOS DETALLES DE TU COMPRA...</p></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td style="border-top: 1px solid #333F48; border-bottom: 1px solid #333F48; padding: 15px 0 0 0;">    
                <table id="list-product" class="details">
                    <thead>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td class="column-center"><?php echo $product['quantity']; ?></td>
                                <td class="column-center">$<?php echo $product['unit_price']; ?></td>
                                <td class="column-center">$<?php echo $product['total_price']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 15px;">
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
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table class="details-send">
                    <tbody>
                        <tr><td style="font-style: italic; font-size: 11pt;">ACUSE DE RECIBO</td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>De: </td></tr>
                        <tr><td>Para: </td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
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