
<?php 
    require __DIR__ . '/vendor/autoload.php';
    require '../diseno/estilos_2.php';
    use Automattic\WooCommerce\Client;
    $woocommerce = new  Client(
            'https://malibustore.com.co/', //url del sitio
            'ck_f951211d262cafb0c9a3c85ab86fbb810479347c', //credenciales de woocomerce
            'cs_d59c774222055b598098e0852b64f85e07d02a55', //credenciales de woocomerce
            [
            	'versión' => 'wc / v3',
            	'query_string_auth' => true,
            	'verify_ssl' => false
            ]

        );
    
    

    
    include '../ini/header.php';
   
    
?>

<form action="woo.php" method="POST">
    <div class="container jumbotron my-5">
             <h2>Consultar una compra</h2>
             <hr class="my-4">
             <label for="">Seleccionar Id Orden</label>
             <select name="orden" class="form-control">
                    <?php 
                    $ordenes = $woocommerce->get('orders');
                    $idOrdenes = [];
                    foreach ($ordenes as $orden) {
                       array_push($idOrdenes, $orden->id);  ?>
                       <option value="<?php echo($orden->id); ?>" class="from-control"><?php echo($orden->id); ?></option>
               <?php } ?> 
            </select>
        <div class="mt-3">
            <input type="submit" class="btn btn-primary btn-block" name="consult" id="enviar" value="Consultar">
        </div>
    </div>
</form>







