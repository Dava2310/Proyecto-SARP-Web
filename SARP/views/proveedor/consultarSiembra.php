<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Consultar Siembras";
    include('../templates/head.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    $n = $usuario;

    $usuario= "SELECT ID_Siembra,ID_Proveedor FROM siembras WHERE ID_Proveedor = $n; ";
    $result= mysqli_query($con,$usuario);
    //YA AQUI TENGO LOS DATOS DEL USUARIO

?>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONETNIDO DE LA VISTA -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">

                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h1><?=$_titulo?></h1>
                                    <img class="imagen-titulo" src="../../assets/images/camion.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group  col-md-6 col-sm-12 ">
                                <div class="row">
                                    <label for="siembras" class="col-sm-5 col-form-label">Lista de Siembra</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-7">
                                        <input placeholder="-- SELECCIONE SIEMBRA --" class="form-control" list="siembras" name="siembras" id="siembra" onchange='mifuncion(this.value)'>
                                            <datalist id="siembras" >
                                                <?php
                                                    while($valores = mysqli_fetch_array($result)){
                                                        $id = $valores['ID_Siembra'];
                                                        $idP = $valores['ID_Proveedor'];
                                                        echo "<option value=$id></option>";
                                                    }
                                                ?>
                                            </datalist>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <hr>
                        <form id="form">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fechaI">Fecha de Inicio:</label>
                                    <input class="form-control" type="date" name="fechaI" id="fechaI" required readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kilosA">Kilos Arrimados:</label>
                                    <input class="form-control" type="number" name="kilosA" id="kilosA"  readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="saldoR">Saldo Restante:</label>
                                    <input class="form-control" type="number" name="saldoR" id="saldoR"  readOnly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="variedad">Variedad:</label>
                                    <input class="form-control" type="text" name="variedad" id="variedad" required readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="idLote">ID del Lote Generado:</label>
                                    <input class="form-control" type="text" name="idLote" id="idLote" required readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kilosT">Kilos Totales por Lote:</label>
                                    <input class="form-control" type="number" name="kilosT" id="kilosT" required readOnly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fechaC">Fecha Estimada de Cosecha:</label>
                                    <input class="form-control" type="date" name="fechaC" id="fechaC" required readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hectareas">Hectáreas Sembradas:</label>
                                    <input class="form-control" type="number" name="hectareas" id="hectareas" required readOnly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                    <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="button" class="btn btn-danger glyphicon glyphicon-pencil"  onclick= 'mifuncionEliminar(document.getElementById("idLote").value)'>Eliminar</button>
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <header class="titulo-formulario">
                            <h2>Datos de la muestra</h2>
                        </header>
                        <br>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="analisis">Analisis de la muestra:</label>
                                    <input class="form-control" type="text" name="analisis" id="analisis" required readOnly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="materiaS">% de Materia Seca:</label>
                                    <input class="form-control" type="text" name="materiaS" id="materiaS" required readOnly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="impureza">% de Impureza:</label>
                                    <input class="form-control" type="text" name="impureza" id="impureza" required readOnly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="kilos">Cant. Kilos de la Muestra:</label>
                                    <input class="form-control" type="text" name="kilos" id="kilos" required readOnly>
                                </div>
                            </div>
                        </form>
                        <script src="../../assets/js/Proveedor/consultarSiembra.js"></script>
    <?php
        include('../templates/footer.php');
    ?>