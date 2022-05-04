<?php
    $_titulo = "Datos del Terreno";
    include('../templates/head.php');
?>
<body>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS DEL TERRENO -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo?></h1>
                            <img src="../../assets/images/terreno.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <!-- FORMULARIO DEL TERRENO-->
                        <form action="../../controllers/proveedor/ctrl_datosTerreno.php">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="espacio">Tamaño en Hectáreas</label>
                                    <input class="form-control" type="text" name="espacio" id="espacio" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="ubicacion">Ubicación</label>
                                    <input class="form-control" type="text" name="ubicacion" id="ubicacion" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <button class="btn btn-primary glyphicon glyphicon-pencil">Modificar Datos</button>
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
    <?php
        include('../templates/footer.php');
    ?>