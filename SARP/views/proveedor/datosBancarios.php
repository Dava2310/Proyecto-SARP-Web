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
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo1?></h1>
                            <img src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <!-- FORMULARIO DE LOS DATOS BANCARIOS PERSONALES -->
                        <form action="../../controllers/proveedor/ctrl_bancarioPersonal.php" method="POST" >
                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="Nombre">Nombre:</label>
                                    <input value="<?=$row->Nombre?>" readOnly class="form-control" type="text" name ="Nombre" id="Nombre">
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="Apellido">Apellido:</label>
                                    <input value="<?=$row->Apellido?>" readOnly class="form-control" type="text" name ="Apellido" id="Apellido">
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="Banco">Banco:</label>
                                    <input value="<?=$row->Banco_P?>" readOnly class="form-control" list="Banco" name="Banco" id="BancoP">
                                        <datalist id="Banco" >
                                            <option value="BANCO NACIONAL DE CRÉDITO"></option>
                                            <option value="BANCO DEL CARIBE"></option>
                                            <option value="BANCO DEL TESORO"></option>
                                            <option value="BANCO EXTERIOR"></option>
                                            <option value="BANCO CARONÍ"></option>
                                            <option value="BANCO DE VENEZUELA"></option>
                                            <option value="BANESCO BANCO UNIVERSAL"></option>
                                            <option value="BANCO PROVINCIAL"></option>
                                            <option value="BANCAMIGA BANCO UNIVERSAL"></option>
                                            <option value="BANCO MERCANTIL"></option>
                                            
                                        </datalist>
                                    </input >
                                </div>
                                <div class="form-group col-12 col-md6 col-md-6">
                                    <label for="Nrocuenta">Nº de Cuenta:</label>
                                    <input value="<?=$row->Cuenta_P?>" readOnly class="form-control" type="text" name ="Nrocuenta" id="Nrocuenta">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="TpoCuenta">Tipo de cuenta:</label>
                                
                                    <input value="<?=$row->TipoCuenta_P?>" class="form-control" list="TpoCuenta" name="TpoCuenta" id="TpoCuentaP"readOnly>
                                        <datalist id="TpoCuenta">
                                            <option value="AHORRO"></option>
                                            <option value="CORRIENTE"></option>
                                        </datalist>
                                    </input >
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-top: 8px;">
                                <h2>Datos Bancarios Autorizado</h2>
                                <img class="imagen-titulo" src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                            <hr>
                        
                            <div class="row">
                                <div class="form-group col-6 col-md-4">
                                    <label for="NombreA">Nombre:</label>
                                    <input value="<?=$row->Nombre_A?>" readOnly class="form-control" type="text" name ="NombreA" id="NombreA">
                                    
                                </div>
                                <div class="form-group col-6 col-md-4">
                                    <label for="ApellidoA">Apellido:</label>
                                    <input value="<?=$row->Apellido_A?>" readOnly class="form-control" type="text" name ="ApellidoA" id="ApellidoA">
                                </div>
                                <div class="form-group col-6 col-md-4">
                                    <label for="BancoA">Banco:</label>
                                    <!--  <input value="" disabled class="form-control" type="text" name ="BancoA" id="BancoA"> -->
                                    <input value="<?=$row->Banco_A?>" class="form-control" list="BancoA" name="BancoA" id="Banco-A" readOnly>
                                        <datalist id="BancoA">
                                            <option value="BANCO NACIONAL DE CRÉDITO"></option>
                                            <option value="BANCO DEL CARIBE"></option>
                                            <option value="BANCO DEL TESORO"></option>
                                            <option value="BANCO EXTERIOR"></option>
                                            <option value="BANCO CARONÍ"></option>
                                            <option value="BANCO DE VENEZUELA"></option>
                                            <option value="BANESCO BANCO UNIVERSAL"></option>
                                            <option value="BANCO PROVINCIAL"></option>
                                            <option value="BANCAMIGA BANCO UNIVERSAL"></option>
                                            <option value="BANCO MERCANTIL"></option>
                                        </datalist>
                                    </input >

                                </div>
                                <div class="form-group col-6 col-md-6">
                                    <label for="NrocuentaA">Nº de Cuenta:</label>
                                    <input value="<?=$row->Cuenta_A?>" readOnly class="form-control" type="text" name ="NrocuentaA" id="NrocuentaA">
                                </div>
                                <div class="form-group col-6 col-md-6">
                                    <label for="TpoCuentaA">Tipo de cuenta:</label>
                                
                                    <input value="<?=$row->TipoCuenta_A?>" class="form-control" list="TpoCuentaA" name="TpoCuentaA" id="TpoCuenta-A" readOnly>
                                        <datalist id="TpoCuentaA">
                                            <option value="AHORRO"></option>
                                            <option value="CORRIENTE"></option>
                                        </datalist>
                                    </input >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                        function activarCampos(){
                            var BotonCambiar = document.getElementById('botonCambiar');
                            if(document.getElementById('BancoP').readOnly == false){
                                BotonCambiar.value="Modificar (Desactivado)";
                                document.getElementById('BancoP').readOnly=true;
                                document.getElementById('Nrocuenta').readOnly=true;
                                document.getElementById('TpoCuentaP').readOnly=true;
                                //document.getElementById('email').disabled=true;
                                //document.getElementById('cedula').disabled=true;
                                document.getElementById('NombreA').readOnly=true;
                                document.getElementById('ApellidoA').readOnly=true;
                                document.getElementById('Banco-A').readOnly=true;
                                document.getElementById('Nrocuenta-A').readOnly=true;
                                document.getElementById('TpoCuenta-A').readOnly=true;
                            } else {
                                BotonCambiar.value="Modificar (Activado)";
                                document.getElementById('BancoP').readOnly=false;
                                document.getElementById('Nrocuenta').readOnly=false;
                                document.getElementById('TpoCuentaP').readOnly=false;
                                //document.getElementById('email').disabled=true;
                                //document.getElementById('cedula').disabled=true;
                                document.getElementById('NombreA').readOnly=false;
                                document.getElementById('ApellidoA').readOnly=false;
                                document.getElementById('Banco-A').readOnly=false;
                                document.getElementById('NrocuentaA').readOnly=false;
                                document.getElementById('TpoCuenta-A').readOnly=false;
                            }
                            
                        }
                    </script>
    <?php
        include('../templates/footer.php');
    ?>