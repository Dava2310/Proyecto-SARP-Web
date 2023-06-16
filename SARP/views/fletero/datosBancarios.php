<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Datos Bancarios";
    include('../templates/headFletero.php');
    
    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    } else {
        
        /*
        if((time() - $_SESSION['time']) > 1000000){
            header('location: ../../controllers/salir.php');
            die();
        }
        */
    }
    $result = $con->query("select * from usuario where  ID_Usuario = '$usuario';");
    if(!($row = $result->fetch_object())){
		echo "<script> alert('Id de usuario indicada no existe'); </script>";
		echo "<script> window.location='../registros/login.php'; </script>";
	}
    //YA AQUI TENGO LOS DATOS DEL USUARIO
?>
<body>
    <div class="container-fluid">
        <div class="row"> 
            
                <?php
                    include("../templates/menuFletero.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS BANCARIOS -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo?></h1>
                            <img src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <!-- FORMULARIO DE LOS DATOS BANCARIOS PERSONALES -->
                        <form id="form" >
                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="Nombre">Nombre:</label>
                                    <input value="<?=$row->Nombre?>" readOnly class="form-control" type="text" name ="Nombre" id="Nombre">
                                    <p id='errorName'></p>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="Apellido">Apellido:</label>
                                    <input value="<?=$row->Apellido?>" readOnly class="form-control" type="text" name ="Apellido" id="Apellido">
                                    <p id='errorApellido'></p>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="Cedula">Cédula:</label>
                                    <input value="<?=$row->Cedula?>" readOnly class="form-control" type="text" name ="Cedula" id="Cedula">
                                    <p id='errorCedula'></p>
                                </div>
                                <div class="form-group  col-md-6  col-sm-12  " id="div-ctaP&A">
                                    <label for="ctaP&A">Cuenta (Personal/Autorizada):</label>
                                    <!-- lista para el tipo de cuenta P/A y en al elegir una opcion se llama una funcion que mostrara solo los datos bancarios personales o autorizados segun sea el caso -->
                                    <select  disabled class="form-control"  name="cuentapropia" id="ctaP&A"  >
                                            <option value=""> -- PERSONAL O AUTORIZADA -- </option>
                                            <option value="PERSONAL">PERSONAL</option>
                                            <option value="AUTORIZADA">AUTORIZADA</option>
                                        
                                    </select>
                                </div>

                                <div class="form-group col-md  col-sm-12 " id="divNombreA"  style="display: none;">
                                    <label for="NombreA">Nombre Autorizado:</label>
                                    <input  readOnly class="form-control" type="text" name ="NombreA" id="NombreA"> 
                                    <p id='errorNameA'></p>           
                                </div>

                                <div class="form-group col-md  col-sm-12 " id="divApellidoA" style="display: none;">
                                    <label for="ApellidoA">Apellido Autorizado:</label>
                                    <input  readOnly class="form-control" type="text" name ="ApellidoA" id="ApellidoA">
                                    <p id='errorApellidoA'></p>
                                </div>

                                <div id="div-Banco" class="form-group col-12 col-md-6">
                                    <label for="Banco-A">Banco:</label>
                                    <input  readOnly class="form-control" list="Banco" name="Banco" id="Banco-A" placeholder="-- SELECCIONE BANCO -- ">
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
                                    <p id='errorBancoA'></p>
                                </div>
                                <div id="div-nrocta" class="form-group col-12 col-md6 col-md-6">
                                    <label for="numcuenta">Nº de Cuenta:</label>
                                    <div class="input-group">
                                        <input readonly type="text" class="form-control col-2" name="CODbanco" id="CODbanco" >
                                        <input readOnly class="form-control"  type="text" name="numcuenta" id="numcuenta" >
                                    </div>
                                    <p id='errorNroCta'></p>
                                </div>
                                <div id="div-tcuenta"  class="form-group col-12 col-md-6">
                                    <label for="TpoCuenta-A">Tipo de Cuenta:</label>
                                    <select  class="form-control" list="TpoCuenta" name="TpoCuenta" id="TpoCuenta-A" disabled>
                                            <option value=""> -- TIPO DE CUENTA -- </option>
                                            <option value="AHORRO">AHORRO</option>
                                            <option value="CORRIENTE">CORRIENTE</option>
                                    </select>
                                    <p id='errorTipoBancoA'></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <input id="botonCambiar" type="" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                        <script type="module" src="../../assets/js/Proveedor/datosBancarios.js"></script>
    <?php
        include('../templates/footer.php');
    ?>