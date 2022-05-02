<?php
    $_titulo = "Solicitudes Pendientes";
    include('../templates/head.php');
?>
    <div class="container-fluid">
        <div class="row">
            <div class="pantalla">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LA VISTA -->
                <div class="contenido">
                    <header class="titulo-formulario row justify-content-between">
                        <div class=" col-md-6 col-sm-12 ">
                            <div class="row">
                                <h1><?=$_titulo?></h1>
                                <img class="imagen-titulo" src="../../assets/images/solicitudesPendientes.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="solicitudes">Lista de Solicitudes:</label>
                            <input list="solicitudes" name="solicitudes">
                                <datalist id="solicitudes">
                                    <option value="JavaScript"></option>
                                    <option value="HTML5"></option>
                                    <option value="CSS3"></option>
                                </datalist>
                            <input type="submit" value="Buscar" class="btn btn-info glyphicon glyphicon-pencil" style="color: black; font-weight: bold;">
                        </div>
                    </header>
                    <hr>
                    <form action="../../controllers/proveedor/ctrl_solicitudPendiente.php">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cantidadA">Cantidad a Arrimar:</label>
                                <input class="form-control" type="text" name="cantidadA" id="cantidadA" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="semana">Semana #:</label>
                                <input class="form-control" type="text" name="semana" id="semana" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idLote">ID del Lote Solicitado:</label>
                                <input class="form-control" type="text" name="idLote" id="idLote" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="observacion">Observación (opcional):</label>
                                <p><textarea class="observaciones" name="observacion" placeholder="Coloca tus observaciones!"></textarea></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
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