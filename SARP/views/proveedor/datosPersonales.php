<?php
    $_titulo = "Datos Personales!";
    include('../templates/head.php');
?>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS PERSONALES -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo?></h1>
                            <img src="../../assets/images/datos-personales.png" style="width: 50px; height: 50px;" alt="">
                        </header>
                        <hr>
                        <form action="../../controllers/proveedor/ctrl_datosPersonales.php">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="nombre">Nombre</label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="apellido">Apellido</label>
                                    <input class="form-control" type="text" name="apellido" id="apellido" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="telefono">Número de Teléfono:</label>
                                    <input class="form-control" type="text" name="telefono" id="telefono" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="email">Correo de Usuario:</label>
                                    <input class="form-control" type="text" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="cedula">Cédula:</label>
                                    <input class="form-control" type="text" name="cedula" id="cedula" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="rif">RIF:</label>
                                    <input class="form-control" type="text" name="rif" id="rif" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="direccion">Dirección o habitación:</label>
                                    <input class="form-control" type="text" name="direccion" id="direccion" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <button class="btn btn-success glyphicon glyphicon-pencil">Modificar Datos</button>
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
    <?php
        include('../templates/footer.php');
    ?>

                
