<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SARP/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SARP/assets/css/datos.css">
    <title>Añadir Siembra</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="pantalla">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LA SIEMBRA -->
                <div class="contenido">
                    <header class="titulo-formulario">
                        <h1>Añadir Siembra</h1> 
                        <img class="imagen-titulo" src="/SARP/assets/images/siembra.png" alt="">
                    </header>
                    <hr>
                    <form action="">
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input class="form-control" type="text" name="fecha_inicio" id="fecha_inicio">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="kilos_totales">Kilos Totales por Lote:</label> 
                                <input class="form-control" type="text" name="kilos_totales" id="kilos_totales">
                            </div>
                        </div>
                        <!-- <br> -->
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="variedad">Variedad</label>
                                <input class="form-control" type="text" name="variedad" id="variedad">
                            </div>
                            <div class="form-group col-md-5">
                                <label  for="id_lote">ID del Lote Generado:</label> 
                                <input class="form-control" type="text" name="id_lote" id="id_lote">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="fecha_cosecha">Fecha Estimada de Cosecha:</label>
                                <input class="form-control"  type="text" name="fecha_cosecha" id="fecha_cosecha">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="rendimiento">Rendimiento Esperado:</label>
                                <input class="form-control" type="text" name="rendimiento" id="rendimiento">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="hectareas">Héctareas sembradas:</label>
                                <input class="form-control" type="text" name="hectareas" id="hectareas">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <button class="btn btn-success glyphicon glyphicon-pencil">Terminar Registro</button>
                                <button class="btn btn-primary glyphicon glyphicon-pencil">Terminar y Añadir Otro</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/SARP/assets/js/bootstrap.min.js"></script>
	<script src="/SARP/assets/js/jquery-3.2.1.min.js"></script>
</body>
</html>