<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Datos Bancarios Personales y Autorizados";
    $_titulo1 = "Datos Bancarios Personales";
    $_titulo2 = "Datos Bancarios Autorizados";
    include('../templates/head.php');

    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    }
    $result = $con->query("select * from usuario where ID_Usuario = '$usuario';");
    if(!($row = $result->fetch_object())){
		echo "<script> alert('Id de usuario indicada no existe'); </script>";
		echo "<script> window.location='../registros/login.php'; </script>";
	}
?>
<body>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>

                <!-- CONTENIDO DE LOS DATOS BANCARIOS -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo1?></h1>
                            <img src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <!-- FORMULARIO DE LOS DATOS BANCARIOS PERSONALES -->
                        <form action="ctrl_bancarioPersonal.php">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cuentaP">Nombre y Apellido:</label>
                                    <input disabled class="form-control" type="text" name="cuentaP" id="cuentaP" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="bancoP">Banco:</label>
                                    <input disabled class="form-control" type="text" name="bancoP" id="bancoP" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="numP">Nº de Cuenta:</label>
                                    <input disabled class="form-control" type="text" name="numP" id="numP" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="tipoP">Tipo de Cuenta:</label>
                                    <input disabled class="form-control" type="text" name="tipoP" id="tipoP" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <input id="botonCambiar" type="" onclick="activarCampos1()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <header class="titulo-formulario">
                            <h1><?=$_titulo2?></h1>
                            <img class="imagen-titulo" src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <br>
                        <!-- FORMULARIO DE LOS DATOS BANCARIOS AUTORIZADOS -->
                        <form action="ctrl_bancarioAutorizado.php">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cuentaA">Nombre y Apellido:</label>
                                    <input disabled class="form-control" type="text" name="cuentaA" id="cuentaA" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="bancoA">Banco:</label>
                                    <input disabled class="form-control" type="text" name="bancoA" id="bancoA" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="numA">Nº de Cuenta:</label>
                                    <input disabled class="form-control" type="text" name="numA" id="numA" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="tipoA">Tipo de Cuenta:</label>
                                    <input disabled class="form-control" type="text" name="tipoA" id="tipoA" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <input id="botonCambiar2" type="" onclick="activarCampos2()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            function activarCampos1(){
                                var BotonCambiar1 = document.getElementById('botonCambiar');

                                if(document.getElementById('cuentaP').disabled == false){
                                    BotonCambiar1.value="Modificar (Desactivado)";
                                    document.getElementById('cuentaP').disabled=true;
                                    document.getElementById('bancoP').disabled=true;
                                    document.getElementById('numP').disabled=true;
                                    document.getElementById('tipoP').disabled=true;
                                } else {
                                    BotonCambiar1.value="Modificar (Activado)";
                                    document.getElementById('cuentaP').disabled=false;
                                    document.getElementById('bancoP').disabled=false;
                                    document.getElementById('numP').disabled=false;
                                    document.getElementById('tipoP').disabled=false;
                                }
                                
                            }
                            function activarCampos2(){
                                var BotonCambiar2 = document.getElementById('botonCambiar2');
                                if(document.getElementById('cuentaA').disabled == false){
                                    BotonCambiar2.value="Modificar (Desactivado)";
                                    document.getElementById('cuentaA').disabled=true;
                                    document.getElementById('bancoA').disabled=true;
                                    document.getElementById('numA').disabled=true;
                                    document.getElementById('tipoA').disabled=true;
                                } else {
                                    BotonCambiar2.value="Modificar (Activado)";
                                    document.getElementById('cuentaA').disabled=false;
                                    document.getElementById('bancoA').disabled=false;
                                    document.getElementById('numA').disabled=false;
                                    document.getElementById('tipoA').disabled=false;
                                }
                            }
                        </script>
    <?php
        include('../templates/footer.php');
    ?>