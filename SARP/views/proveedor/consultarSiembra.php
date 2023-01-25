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
                                    <label for="Proveedores" class="col-sm-5 col-form-label">Lista de Siembra</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-7">
                                        <input placeholder="-- SELECCIONE SIEMBRA --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor" onchange='mifuncion(this.value)'>
                                            <datalist id="Proveedores" >
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
                        <form action="../../controllers/proveedor/ctrl_consultarSiembra.php" method="POST">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fechaI">Fecha de Inicio:</label>
                                    <input class="form-control" type="date" name="fechaI" id="fechaI" required readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kilosA">Kilos Arrimados:</label>
                                    <input class="form-control" type="text" name="kilosA" id="kilosA"  readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="saldoR">Saldo Restante:</label>
                                    <input class="form-control" type="text" name="saldoR" id="saldoR"  readOnly>
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
                                    <input class="form-control" type="text" name="kilosT" id="kilosT" required readOnly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fechaC">Fecha Estimada de Cosecha:</label>
                                    <input class="form-control" type="date" name="fechaC" id="fechaC" required readOnly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hectareas">Hectáreas Sembradas:</label>
                                    <input class="form-control" type="text" name="hectareas" id="hectareas" required readOnly>
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
                        <script type="text/javascript">
                            
                            function activarCampos(){
                                var BotonCambiar = document.getElementById('botonCambiar');
                                if(document.getElementById('kilosA').readOnly == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('kilosA').readOnly=true;
                                    document.getElementById('saldoR').readOnly=true;
                                    document.getElementById('variedad').readOnly=true;
                                    //document.getElementById('email').disabled=true;
                                    //document.getElementById('cedula').disabled=true;
                                    document.getElementById('kilosT').readOnly=true;
                                    document.getElementById('fechaC').readOnly=true;
                                    document.getElementById('hectareas').readOnly=true;
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('kilosA').readOnly=false;
                                    document.getElementById('saldoR').readOnly=false;
                                    document.getElementById('variedad').readOnly=false;
                                    //document.getElementById('email').disabled=false;
                                    //document.getElementById('cedula').disabled=false;
                                    document.getElementById('kilosT').readOnly=false;
                                    document.getElementById('fechaC').readOnly=false;
                                    document.getElementById('hectareas').readOnly=false;
                                }
                                
                            }
                            function mifuncion(idS){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/proveedor/get_datoSiembra.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idS : idS },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    // el tipo de información que se espera de respuesta
                                    dataType : 'json',
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        
                                        $("#fechaI").val(json.Fecha_Inicio);
                                        $("#kilosA").val(json.Kilos_Arrimados);
                                        $("#saldoR").val(json.Saldo_Restante);
                                        $("#variedad").val(json.Variedad);
                                        $("#idLote").val(json.ID_Siembra);
                                        $("#kilosT").val(json.Kilos_Totales);
                                        $("#fechaC").val(json.Fecha_Cosecha);
                                        $("#hectareas").val(json.Hectareas);
                                        $("#analisis").val(json.Analisis);
                                        $("#materiaS").val(json.MateriaSeca);
                                        $("#impureza").val(json.Impureza);
                                        $("#kilos").val(json.KilosMuestra);
                                        //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
                                        
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                })
                            }
                            function mifuncionEliminar(idS){
                                if(confirm('¿Seguro de eliminar?')){
                                    $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/proveedor/ctrl_eliminarSiembra.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idS : idS },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        alert('eliminada con exito');

                                        window.location='../../views/proveedor/consultarSiembra.php';
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                    })

                                }else{
                                    header("location: ../../views/proveedor/consultarSiembra.php");

                                    

                                }
                                


                            }

                        </script>
    <?php
        include('../templates/footer.php');
    ?>