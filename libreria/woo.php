<?php
require __DIR__ . '/vendor/autoload.php';
use Automattic\WooCommerce\Client;

class woo
{
    function orderss()
    {
        $woocommerce = new  Client(
            'https://example.com.co/', //url del sitio
            '', //credenciales de woocomerce api res 
            '',
            [
                'versión' => 'wc / v3',
                'query_string_auth' => true,
                'verify_ssl' => false
            ]

        );
        //recibe el dato del id por metodo POST
        if (isset($_POST['consult'])) {
            $id = $_POST['orden'];
        }
        // si el id esta vacio retornar que no hay datos para consultar
        if ($id == '') {
            echo "<script >alert('No hay datos para consultar');
            window.location='consultar_compra.php';
            </script>";
        } else {
            //el try retorna si no hay una orden de woocomerce
            try {
                $wii = $woocommerce->get('orders/' . $id);
                $result[] = '';

                foreach ($wii as $key => $value) {
                    $result[$key] = $value;
                }

                return $result;
            } catch (Exception $ex) {
                echo "<script >alert('error en consulta');
                window.location='home.php';
                </script>" . $ex;
            }
        }
    }
}
// traer los datos del servicio woocomerce
$new = new woo();
$apiwoo = $new->orderss();
include '../ini/header.php';
?>
<form action="sabe.php" method="POST">
    <div class="container jumbotron my-5">            
        <h2>Información del producto</h2>
        <hr class="my-4">
        <label for="">Id Orden</label>
        <input type="text" class="form-control" name="id_orden" value="<?php echo $apiwoo['id'] ?>">
        <label for="">Moneda</label>
        <input type="text" class="form-control" name="moneda" value="<?php echo $apiwoo['currency'] ?>">
        <label for="">Precio del producto</label>
        <input type="text" class="form-control" name="valor" value="<?php echo $apiwoo['total'] ?>">
    </div>
    <div class="jumbotron container jumbotron my-5">
        <h2>Información del cliente</h2>
        <hr class="my-4">
        <?php $woo = json_decode(json_encode($apiwoo['billing'])); ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Nombres</label>
                <input type="text" class="form-control"    name="nombres" value="<?php echo $woo->first_name; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?php echo $woo->last_name; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Empresa</label>
                <input type="text" class="form-control" name="empresa" value="<?php echo $woo->company; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $woo->address_1; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?php echo $woo->city; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Código Postal</label>
                <input type="text" class="form-control" name="postal" value="<?php echo $woo->postcode; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $woo->email; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $woo->phone; ?>">
            </div>
        </div>
        <!--termina el form-row-->
    </div>
    <!--termina el container-->
    <div class="container my-5 jumbotron">
        <h2>Información del Producto comprado</h2>
        <hr class="my-4">
        <?php
        $dux =  json_decode(json_encode($apiwoo['line_items']), true);
        foreach ($dux as $key => $value) {
            $name = $value;
        }?>
        <label for="">Id del producto</label>
        <input type="text" class="form-control" name="id_producto" value="<?php echo $name['product_id'] ?>">
        <label for="">Nombre del producto</label>
        <input type="text" class="form-control" name="nombre_producto" value="<?php echo $name['name'] ?>">
        <input type="hidden" name="fecha" class="form-control" value="<?php echo date('Ymd'); ?>">
        <div class="mt-3">
            <input type="submit" name="datoss" value="Enviar" class="btn btn-info btn-block">
        </div>
    </div>
</form>
