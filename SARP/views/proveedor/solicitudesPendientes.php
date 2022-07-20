<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Solicitudes Pendientes";
    include('../templates/head.php');
 
    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    $n = $usuario;

    $sql= "SELECT * FROM solicitud_proveedor INNER JOIN siembras ON solicitud_proveedor.ID_Siembra=siembras.ID_Siembra WHERE siembras.ID_Proveedor = $n; ";
    $result= mysqli_query($con,$sql);
    //YA AQUI TENGO LOS DATOS DEL USUARIO

?>
    <div class="container-fluid">
        <div class="row">
            
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>

                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <!-- CONTENIDO DE LA VISTA -->
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h1><?=$_titulo?></h1>
                                    <img class="imagen-titulo" src="../../assets/images/solicitudesPendientes.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <div class="row">
                                    <label for="solicitudes" class="col-sm-5 col-form-label">Lista de Solicitudes</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-7">
                                        <input placeholder="-- SELECCIONE SOLICITUD --" class="form-control" list="solicitudes" name="solicitudes" id="solicitud" >
                                            <datalist id="solicitudes" >
                                                <?php
                                                    while($valores = mysqli_fetch_array($result)){
                                                        $id = $valores['ID_Solicitud_Proveedor'];
                                                        $cantidad = $valores['Cantidad_MP'];
                                                        echo "<option value=$id></option>";
                                                    }
                                                ?>
                                            </datalist>
                                    </div>
                                </div>
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
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Rechazar</button>
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
    <?php
        include('../templates/footer.php');
    ?>