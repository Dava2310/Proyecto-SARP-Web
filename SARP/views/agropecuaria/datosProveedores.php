<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $n = 3;

    $_titulo = "Datos Proveedores";
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

    $usuario= "SELECT ID_Usuario,Cedula FROM usuario WHERE tipo_Usuario = 3; ";
    $result= mysqli_query($con,$usuario);
    //YA AQUI TENGO LOS DATOS DEL USUARIO
?>
<body>
    <div class="container-fluid ">
        
        <div class="row"> 
            
            <?php
                include("../templates/menuAgropecuaria.php");
            ?> 
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll; ">
                <div class="contenidoInterno" style="padding-top: 25px;">
                    <header class="row justify-content-between" style="margin-left: 10px;">
                    
                    <div class=" col-md-6 col-sm-12 ">
                            <div class="row">
                                <h2>Datos Personales Proveedores</h2> 
                                <img class="imagen-titulo"src="../../assets/images/datos-personales.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-12 ">
                            <div class="row">
                                <label for="Proveedores" class="col-sm-5 col-form-label">Lista de Proveedores</label>
                                <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                <div class="col-sm-7">
                                    <input placeholder="-- SELECCIONE PROVEEDOR --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor" >
                                        <datalist id="Proveedores" >
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
                                <label for="Nombre">Nombre Completo:</label>
                                <input readOnly class="form-control" type="text" name="Nombre" id="Nombre" required>
                                <p id='errorName'></p>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Apellido">Apellido:</label>
                                <input readOnly class="form-control" type="text" name="Apellido" id="Apellido" required>
                                <p id='errorApellido'></p>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Email">Email de Usuario:</label>
                                <input readOnly class="form-control" type="email" name="Email" id="Email" required>
                                <p id='errorCorreo'></p>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Cedula">Cédula:</label>  
                                <input readonly="readonly" class="form-control" type="text" name="Cedula" id="Cedula" required>
                                <p id='errorCedula'></p>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <label for="rif">RIF</label>  
                                <input readOnly class="form-control" type="text" name="rif" id="rif" required>
                                <p id='errorRif'></p>
                            </div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <label for="direccion">Dirección o Habitación:</label>
                                <input readOnly class="form-control" type="text" name="direccion" id="direccion" required>
                                <p id='errorDir'></p>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="tlf">Teléfono:</label>
                                <input readOnly class="form-control" type="text" name="tlf" id="tlf" required>
                                <p id='errorTlf'></p>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-top: 8px;">
                            <h2>Datos bancarios Proveedores</h2> 
                            <img class="imagen-titulo"src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group  col-md-6  col-sm-12  " id="div-ctaP&A">
                                <label for="cuentapropia">Cuenta (Personal/Autorizada):</label>
                                <!-- lista para el tipo de cuenta P/A y en al elegir una opcion se llama una funcion que mostrara solo los datos bancarios personales o autorizados segun sea el caso -->
                                <select  disabled class="form-control"  name="cuentapropia" id="ctaP&A"  >
                                        <option value=""> -- PERSONAL O AUTORIZADA -- </option>
                                        <option value="PERSONAL">PERSONAL</option>
                                        <option value="AUTORIZADA">AUTORIZADA</option>
                                    
                                </select>
                                <p id='errorTipoBancoA'></p>
                            </div>
                            <!-- se coloca el display: none para que los campos nombre y apellidos autorizados no aparezcan -->
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
                            <div id="div-Banco" class="form-group  col-md-6  col-sm-12   ">
                                <label for="Banco">Banco:</label>
                                <input  class="form-control" list="Banco" name="Banco" id="Banco-A" placeholder="-- SELECCIONE BANCO -- " readOnly>
                                        <datalist id="Banco">
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
                         
                            <div id="div-nrocta" class="form-group  col-md-6  col-sm-12  ">
                                <label for="numcuenta">Nº de Cuenta:</label>
                                <input readOnly class="form-control"  type="text" name="numcuenta" id="numcuenta" >
                                <p id='errorNroCta'></p>
                            </div>
                            <div id="div-tcuenta" class="form-group  col-md-6  col-sm-12  ">
                                <label for="tipocuenta">Tipo de Cuenta:</label>
                                <select  class="form-control" list="TpoCuenta" name="TpoCuenta" id="TpoCuenta-A" disabled>
                                        <option value=""> -- TIPO DE CUENTA -- </option>
                                        <option value="AHORRO">AHORRO</option>
                                        <option value="CORRIENTE">CORRIENTE</option>
                                </select>
                                <p id='errorTipoBancoA'></p>
                            </div>
                        </div>
                    
                        <div class="row" >
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <input id="botonCambiar" type=""class="btn btn-primary glyphicon glyphicon-pencil" 
                                value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                            </div>
                        </div>
                            
                    </form>  
                        <!-- Iniciamos el segmento de codigo javascript -->
                    <script type="module" src="../../assets/js/datos_personales/datosProveedores.js"></script>   
<?php
    include ("../templates/footerFletero.php")
?>


         
