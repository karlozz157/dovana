<style type="text/css">
    #container-table
    {
        background: #fff;
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
        color: #333;
        font-size: 12pt;
    }

    .text p
    {  
        margin: 10px 0;
    }

    .details
    {
        border: 1px solid #ccc;
        width: 680px;
    }
    span
    {
        color: rgba(115, 120, 124, .2);
    }

    .details thead
    {
        background-color: rgba(115, 120, 124, .2);
    }

    .details thead th
    {
        color: #000;
        font-size: 13pt;
        font-weight: normal;
        padding: 7px 0px;
    }


    .details tbody td
    {
        font-size: 10pt;
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
            <td class="text"><p>Hola <span><?php echo ucwords($user['first_name'].' '.$user['last_name']); ?></span></p></td>
        </tr>
        <tr>
            <td class="text"><p>A continuación encontrarás todos los detalles de tu compra:</p></td>
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
                        <th>Dirección de Envío:</th>
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
            <td class="text">
                <p>
                    Muchas gracias por comprar en nuestra tienda!<br />
                    <a href="javascript:window.location.href='<?php echo base_url(); ?>site/'">Aceptar</a>
                </p>
            </td> 
        </tr>
    </table>
</div>
<script type="text/javascript">
    delete(localStorage.simpleCart_items);
    document.getElementById('count-items').innerHTML = 0;
</script>