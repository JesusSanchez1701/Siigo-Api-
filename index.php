<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'diseno/estilos.php';
    ?>
    <link rel="icon" href="imagenes/Login.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="my-5">
        <div class="jumbotron col-md-3 container">
            <h2>Iniciar Sesión</h2>
            <hr class="my-4">
            <div class="">
                <form action="controladores/insert.php" method="POST">
                    <div class="">
                        <input type="text" name="usuario" class="form-control" placeholder="Ingresa usuario">
                    </div>
                    <div class="mt-3">
                        <input type="password" name="contrasena" class="form-control" placeholder="Ingresa contraseña">
                    </div>
                    <div class="mt-3">
                        <a href="libreria/consultar_compra.php" class="btn btn-info btn-block" >Ingresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>