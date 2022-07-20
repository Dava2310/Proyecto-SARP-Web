<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $n = 3;

    $_titulo = "Datos Proveedores";
    include('../templates/headFletero.php');
    
    include("../../controllers/conexion.php");
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
                                    <input placeholder="-- SELECCIONE PROVEEDOR --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor" onchange='mifuncion(this.value)'>
                                        <datalist id="Proveedores" >
                                            <?php
                                                while($valores = mysqli_fetch_array($result)){
                                                    $id = $valores['ID_Usuario'];
                                                    $cedula = $valores['Cedula'];
                                                    echo "<option value=$cedula></option>";
                                                }
                                            ?>
                                        </datalist>
                                </div>
                            </div>
                        </div>
                    </header>
                    <hr>
                  
                    <form action="../../controllers/agropecuaria/ctrl_datosP.php" method="POST">
                        <div class="row">
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Nombre">Nombre Completo:</label>
                                <input readOnly class="form-control" type="text" name="Nombre" id="Nombre" required>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Apellido">Apellido:</label>
                                <input readOnly class="form-control" type="text" name="Apellido" id="Apellido" required>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Correo">Correo de Usuario:</label>
                                <input readOnly class="form-control" type="email" name="Correo" id="Correo" required>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="CI">Cédula:</label>  
                                <input readonly="readonly" class="form-control" type="text" name="CI" id="CI" required>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <label for="rif">RIF</label>  
                                <input readOnly class="form-control" type="text" name="rif" id="rif" required>
                            </div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <label for="direccion">Dirección o Habitación:</label>
                                <input readOnly class="form-control" type="text" name="direccion" id="direccion" required>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="tlf">Teléfono:</label>
                                <input readOnly class="form-control" type="text" name="tlf" id="tlf" required>
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
                                <select  disabled class="form-control"  name="cuentapropia" id="ctaP&A" onchange='mifuncionP_A(this.value,document.getElementById("Proveedor").value)' >
                                        <option value=""> -- PERSONAL O AUTORIZADA -- </option>
                                        <option value="PERSONAL">PERSONAL</option>
                                        <option value="AUTORIZADA">AUTORIZADA</option>
                                    
                                </select>
                            </div>
                            <!-- se coloca el display: none para que los campos nombre y apellidos autorizados no aparezcan -->
                            <div class="form-group col-md  col-sm-12 " id="divNombreA"  style="display: none;">
                                <label for="NombreA">Nombre Autorizado:</label>
                                <input  readOnly class="form-control" type="text" name ="NombreA" id="NombreA">            
                            </div>
                            <div class="form-group col-md  col-sm-12 " id="divApellidoA" style="display: none;">
                                    <label for="ApellidoA">Apellido Autorizado:</label>
                                    <input  readOnly class="form-control" type="text" name ="ApellidoA" id="ApellidoA">
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
                            </div>
                         
                            <div id="div-nrocta" class="form-group  col-md-6  col-sm-12  ">
                                <label for="numcuenta">Nº de Cuenta:</label>
                                <input readOnly class="form-control"  type="text" name="numcuenta" id="numcuenta" >
                            </div>
                            <div id="div-tcuenta" class="form-group  col-md-6  col-sm-12  ">
                                <label for="tipocuenta">Tipo de Cuenta:</label>
                                <select  class="form-control" list="TpoCuenta" name="TpoCuenta" id="TpoCuenta-A" disabled>
                                        <option value=""> -- TIPO DE CUENTA -- </option>
                                        <option value="AHORRO">AHORRO</option>
                                        <option value="CORRIENTE">CORRIENTE</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row" >
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                            </div>
                        </div>
                            
                    </form>  
                        <!-- Iniciamos el segmento de codigo javascript -->
                    <script type="text/javascript">
                            function activarCampos(){
                                var BotonCambiar = document.getElementById('botonCambiar');
                                if(document.getElementById('Nombre').readOnly == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('Nombre').readOnly=true;
                                    document.getElementById('Apellido').readOnly=true;
                                    document.getElementById('tlf').readOnly=true;
                                    //document.getElementById('email').disabled=true;
                                    //document.getElementById('cedula').disabled=true;
                                    document.getElementById('rif').readOnly=true;
                                    document.getElementById('direccion').readOnly=true;
                                    document.getElementById('ctaP&A').disabled=true;
                                    document.getElementById('NombreA').readOnly=true;
                                    document.getElementById('ApellidoA').readOnly=true;
                                    document.getElementById('Banco-A').readOnly=true;
                                    document.getElementById('numcuenta').readOnly=true;
                                    document.getElementById('TpoCuenta-A').disabled=true;
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('Nombre').readOnly=false;
                                    document.getElementById('Apellido').readOnly=false;
                                    document.getElementById('tlf').readOnly=false;
                                    //document.getElementById('email').disabled=false;
                                    //document.getElementById('cedula').disabled=false;
                                    document.getElementById('rif').readOnly=false;
                                    document.getElementById('direccion').readOnly=false;
                                    document.getElementById('ctaP&A').disabled=false;
                                    document.getElementById('NombreA').readOnly=false;
                                    document.getElementById('ApellidoA').readOnly=false;
                                    document.getElementById('Banco-A').readOnly=false;
                                    document.getElementById('numcuenta').readOnly=false;
                                    document.getElementById('TpoCuenta-A').disabled=false;
                                }
                                
                            }
                            function mifuncion(idP){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/agropecuaria/get_datoP.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idP : idP },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    // el tipo de información que se espera de respuesta
                                    dataType : 'json',
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        //aqui recibimos el "echo" del php(ajax.php)
                                        //y ahora solo colocas el valor en los campos
                                        $("#Nombre").val(json.Nombre);
                                        $("#Apellido").val(json.Apellido);
                                        $("#CI").val(json.Cedula);
                                        $("#Correo").val(json.Email);
                                        $("#rif").val(json.RIF);
                                        $("#direccion").val(json.Direccion);
                                        $("#tlf").val(json.Telefono);
                                        $("#cuentapropia").val(json.Cuenta_A);
                                        $("#Banco-A").val(json.Banco_P);
                                        $("#numcuenta").val(json.Cuenta_P);
                                        $("#TpoCuenta-A").val(json.TipoCuenta_P);
                                        //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
                                        document.getElementById('ctaP&A').value="PERSONAL";
                                        //para que los campos nombre y apellidos autorizados no aparezcan
                                        document.getElementById('divNombreA').style.display="none";
                                        document.getElementById('divApellidoA').style.display="none";
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                })
                             }
                             //funcion para la seleccion de tipo de cuenta Personal/Autorizada
                            function mifuncionP_A(P_A,idP){
                                if(P_A == 'PERSONAL'){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/agropecuaria/get_datoP.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idP : idP },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    // el tipo de información que se espera de respuesta
                                    dataType : 'json',
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        //aqui recibimos el "echo" del php(ajax.php)
                                        //y ahora solo colocas el valor en los campos
                                        $("#Banco-A").val(json.Banco_P);
                                        $("#numcuenta").val(json.Cuenta_P);
                                        $("#TpoCuenta-A").val(json.TipoCuenta_P);
                                        //para que los campos nombre y apellidos autorizados no aparezcan
                                        document.getElementById('divNombreA').style.display="none";
                                        document.getElementById('divApellidoA').style.display="none";
                                        /* solucinando probelmas de responsividad */
                                        document.getElementById('div-ctaP&A').className="form-group  col-md-6  col-sm-12 ";   
                                           
                                        document.getElementById('div-Banco').className="form-group  col-md-6  col-sm-12 ";
                                        document.getElementById('div-nrocta').className="form-group  col-md-6  col-sm-12 ";     
                                        document.getElementById('div-tcuenta').className="form-group  col-md-6  col-sm-12 ";     
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                })

                                }else if(P_A == 'AUTORIZADA'){
                                    $.ajax({
                                        // la URL para la petición
                                        url : '../../controllers/agropecuaria/get_datoP.php',
                            
                                        // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                        data : { idP : idP },
                            
                                        // especifica si será una petición POST o GET
                                        type : 'POST',
                            
                                        // el tipo de información que se espera de respuesta
                                        dataType : 'json',
                            
                                        // código a ejecutar si la petición es satisfactoria;
                                        success : function(json) {
                                            //aqui recibimos el "echo" del php(ajax.php)
                                            //y ahora solo colocas el valor en los campos
                                            $("#Banco-A").val(json.Banco_A);
                                            $("#numcuenta").val(json.Cuenta_A);
                                            $("#TpoCuenta-A").val(json.TipoCuenta_A);
                                            //para que los campos nombre y apellidos autorizados si aparezcan
                                            document.getElementById('divNombreA').style.display="inline";
                                            document.getElementById('divApellidoA').style.display="inline";
                                            $("#NombreA").val(json.Nombre_A);
                                            $("#ApellidoA").val(json.Apellido_A);
                                            /* solucinando probelmas de responsividad */
                                            document.getElementById('div-ctaP&A').className="form-group col-xl-4 col-md-6  col-sm-12 ";   
                                            document.getElementById('divNombreA').className="form-group  col-xl-4 col-md-6  col-sm-12 "; 
                                            document.getElementById('divApellidoA').className="form-group  col-xl-4 col-md-6  col-sm-12 "; 
                                            document.getElementById('div-Banco').className="form-group col-xl-4  col-md-6  col-sm-12 ";
                                            document.getElementById('div-nrocta').className="form-group  col-xl-4 col-md-6  col-sm-12 ";     
                                            document.getElementById('div-tcuenta').className="form-group  col-xl-4 col-md-6  col-sm-12 ";     
                                    
                                            
                                            
                                            
                                            

                                        },
                            
                                        // código a ejecutar si la petición falla;
                                        error : function(xhr, status) {
                                            alert('Disculpe, existió un problema');
                                        }
                                    })

                                }else{
                                    document.getElementById('NombreA').value=null;
                                    document.getElementById('ApellidoA').value=null;
                                    document.getElementById('Banco-A').value=null;
                                    document.getElementById('numcuenta').value=null;
                                    document.getElementById('TpoCuenta-A').value=null;


                                }
                            
                            }
                    </script>   
<?php
    include ("../templates/footerFletero.php")
?>


         
