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
        width: 680px;
    }

    .details thead
    {
        background-color: rgba(115, 120, 124, .2);
    }

    .details thead th
    {
        font-size: 13pt;
        font-weight: normal;
        text-transform: uppercase;
        padding: 7px 0px;
    }


    .details tbody td
    {
        font-size: 10pt;
        font-family: 'Brandon Grotesque Bold';       
        padding: 7px 14px;
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
        <tr>
            <td style="font-size: 26pt; font-style: italic; text-transform: uppercase;"><p>Hola <span><?php echo ucwords($user['first_name'].' '.$user['last_name']); ?></span></p></td>
        </tr>
        <tr>
            <td style="font-style: 16pt; font-style: italic;"><p>A CONTINUACIÓN ENCONTRARÁS LOS DETALLES DE TU COMPRA...</p></td>
        </tr>
        <tr>
            <td>    
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
            <td>
                <table class="details">
                    <thead>
                        <th colspan="5" style="font-style: italic;">Dirección de Envío:</th>
                    </thead>
                    <tbody>
                        <tr><td><?php echo ucwords($user['first_name'].' '.$user['last_name']); ?></td></tr>
                        <tr><td>México - <?php echo $address['estado']; ?></td></tr>
                        <tr><td><?php echo $address['municipio']; ?> - <?php echo $address['colonia']; ?></td></tr>
                        <tr><td><?php echo $address['codigo_postal'] ?></td></tr>
                        <tr><td><?php echo $address['calle']; ?> - <?php echo $address['no_exterior']; ?></td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <table class="details">
                <thead>
                    <th>ACUSE DE RECIBO</th>
                </thead>
                <tbody>
                    <tr><td>De: </td></tr>
                    <tr><td>Para: </td></tr>
                </tbody>
            </table>
        </tr>
        <tr>
            <td style="text-align: centenr; border-top: 1px solid #ccc; font-size: 22pt; font-style: italic; padding-top: 30px;">
                ¡DOVANA TE AGRADECE TU COMPRA!
            </td> 
        </tr>
    </table>
</div>
<script type="text/javascript">
    delete(localStorage.simpleCart_items);
    document.getElementById('count-items').innerHTML = 0;
</script>