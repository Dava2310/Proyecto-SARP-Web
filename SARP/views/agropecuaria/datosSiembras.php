<?php

    session_start();
    $usuario = $_SESSION['ID'];
    $n = 3;

    $_titulo = "Datos de Siembras";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }

    //se seleccionan todos los datos de los usuarios que sean de tipo proveedor
    $usuario = "SELECT ID_Usuario,Cedula FROM usuario WHERE tipo_Usuario = $n;";
    $result = mysqli_query($con, $usuario);
    //YA AQUI TENGO TODOS LOS DATOS DEL USUARIO
?>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php
                include("../templates/menuAgropecuaria.php");
            ?>

            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                <div class="contenidoInterno" style="padding-top: 25px;">
                    <header class="row justify-content-between" style="margin-left: 10px;">
                        
                        <div class=" col-md-6 col-sm-12">
                            <h2>Designar muestra</h2> 
                            <img class="imagen-titulo" src="../../assets/images/siembra.png" alt="" style="width: 50px; height: 50px;">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="row">
                                <label for="Proveedor" class="col-sm-4 col-form-label">Lista de Proveedor</label>
                                <div class="col-sm-8">
                                    <input placeholder="-- SELECCIONE PROVEEDOR --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor">
                                    <datalist id="Proveedores">
                                        <?php
                                            while($valores = mysqli_fetch_array($result)){
                                                $id = $valores['ID_Usuario'];
                                                $Cedula = $valores['Cedula'];
                                                echo "<option value=$Cedula></option>";
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
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="siembras">Siembras del Proveedor:</label>
                                <select id="Siembra" disabled class="form-control " >
                                        <option value="">-- SELECCIONE SIEMBRA --</option>
                                </select>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="idLote">ID de la Siembra:</label>
                                <input class="form-control" type="text" name ="idLote" id="idLote" readOnly>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-top: 8px;">
                            <h2>Datos de la muestra</h2> 
                            <!-- <img class="imagen-titulo"src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;"> -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="analisis">Análisis de la Muestra:</label>
                                <input class="form-control" type="text" name ="analisis" id="analisis" required readOnly>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="ms">% de Materia Seca:</label>
                                <input class="form-control" type="number" name ="ms" id="ms" required readOnly>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="impureza">% de Impureza:</label>
                                <input class="form-control" type="number" name ="impureza" id="impureza" required readOnly>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="kilos">Cant. Kilos de la Muestra:</label>
                                <input class="form-control" type="number" name ="kilos" id="kilos" required readOnly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                <input id="botonCambiar" type=""class="btn btn-primary glyphicon glyphicon-pencil" 
                                value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                            </div>
                        </div>
                    </form>
                    <script type="module" src="../../assets/js/agropecuario/datosSiembra.js"></script> 
                    
<?php
    include ("../templates/footerFletero.php")
?>