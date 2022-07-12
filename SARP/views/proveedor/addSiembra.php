<?php
    $_titulo = "Añadir Siembras!";
    include('../templates/head.php');
?>
    <div class="container-fluid">
        <div class="row">
            
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LA SIEMBRA -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo?></h1>
                            <img src="../../assets/images/siembra.png" alt="" style="width: 50px; height: 50px; ">
                        </header>
                        <hr>
                        <!-- FORMULARIO DE LA SIEMBRA -->
                        <form action="../../controllers/proveedor/ctrl_addSiembra.php" method='post'>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="fecha_inicio">Fecha de Inicio</label>
                                    <input class="form-control" type="text" name="fecha_inicio" id="fecha_inicio" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="kilos_totales">Kilos Totales por Lote:</label> 
                                    <input class="form-control" type="text" name="kilos_totales" id="kilos_totales" required>
                                </div>
                            </div>
                            <!-- <br> -->
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="variedad">Variedad</label>
                                    <input class="form-control" type="text" name="variedad" id="variedad" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label  for="id_lote">ID del Lote Generado:</label> 
                                    <input class="form-control" type="text" name="id_lote" id="id_lote">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="fecha_cosecha">Fecha Estimada de Cosecha:</label>
                                    <input class="form-control"  type="text" name="fecha_cosecha" id="fecha_cosecha" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="rendimiento">Rendimiento Esperado:</label>
                                    <input class="form-control" type="text" name="rendimiento" id="rendimiento" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="hectareas">Héctareas sembradas:</label>
                                    <input class="form-control" type="text" name="hectareas" id="hectareas" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Terminar Registro</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Terminar y Añadir Otro</button>
                                </div>
                            </div>
                        </form>
    <?php
        include('../templates/footer.php');
    ?>