<?php
    $_titulo = "Datos del Terreno";
    include('../templates/head.php');
?>
    <div class="container-fluid">
        <div class="row">
            <div class="pantalla">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS DEL TERRENO -->
                <div class="contenido">
                    <header class="titulo-formulario">
                        <h1><?=$_titulo?></h1> 
                        <img class="imagen-titulo" src="../../assets/images/terreno.png" alt="">
                    </header>
                    <hr>
                    <!-- FORMULARIO DE LOS DATOS DEL TERRENO -->
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
                </div>
            </div>
        </div>
    </div>
    <?php
        include('../templates/footer.php');
    ?>