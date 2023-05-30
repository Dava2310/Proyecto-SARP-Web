<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Solicitudes Aceptadas";
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

    $sql= "SELECT * FROM solicitud_proveedor INNER JOIN siembras ON solicitud_proveedor.ID_Siembra=siembras.ID_Siembra WHERE siembras.ID_Proveedor = $n and solicitud_proveedor.Estado_Aprobacion=1 ; ";
    $result= mysqli_query($con,$sql);
    //YA AQUI TENGO LOS DATOS DEL USUARIO

?>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LA VISTA -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h1><?=$_titulo?></h1>
                                    <img src="../../assets/images/aceptar.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                            <div class="row">
                                    <label for="solicitudes" class="col-sm-5 col-form-label">Lista de Solicitudes</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-7">
                                        <input placeholder="-- SELECCIONE SOLICITUD --" class="form-control" list="solicitudes" name="solicitudes" id="solicitud" onchange="cargarSoli(this.value)" >
                                            <datalist id="solicitudes" >
                                                <?php
                                                    while($valores = mysqli_fetch_array($result)){
                                                        $id = $valores['ID_Solicitud_Proveedor'];
                                                        $cantidad = $valores['Cantidad_MP'];
                                                        echo "<option value=$id>Cantidad = $cantidad</option>";
                                                    }
                                                ?>
                                            </datalist>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <hr>
                        <form action="../../controllers/proveedor/ctrl_solicitudAceptada.php" style="margin-left: 10px;">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cantidadA">Cantidad a Arrimar:</label>
                                <input class="form-control" type="text" name="cantidadA" id="cantidadA" required readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="semana">Semana #:</label>
                                <input class="form-control" type="text" name="semana" id="semana" required readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idLote">ID del Lote Solicitado:</label>
                                <input class="form-control" type="text" name="idLote" id="idLote" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="observacion">Observación (opcional):</label>
                                <p><textarea class="observaciones" name="observacion" id="observacion" placeholder="Coloca tus observaciones!" readonly></textarea></p>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <header class="titulo-formulario" style="margin-left: 10px;">
                        <h1>Dias Asignados de la Solicitud</h1>
                    </header>
                    <br>
                    <form action="" style="margin-left: 10px;">
                        <div class="row ">
                            <!-- Dias -->
                            <div class="col-3">
                                <label for="dias">Días:</label>
                                <img class="imagen-titulo" src="../../assets/images/si.png" name= "dias"alt="" style="width: 50px; height: 50px;">
                                <input class="form-control"type="date" name="dias" id="dias" disabled>
                            </div>
                            
                        </div>
                        <h1 style="margin-left: 10px; margin-top: 20px;">Datos de los Fleteros:</h1>
                        <div class="row">
                            <!-- Dias -->
                            <div class="col-sm">
                                <label for="namefletero" >Nombre:</label>
                            
                                <input class="form-control"type="text" name="namefletero" id="namefletero" readonly>
                            </div>
                            
                            <div class="col-sm">
                                <label for="dias">C.I:</label>
                            
                                <input class="form-control"type="text" name="cifletero" id="cifletero" readonly>
                            </div>

                            <div class="col-sm">
                                <label for="dias">Placa:</label>
                          
                                <input class="form-control"type="text" name="placafletero" id="placafletero" readonly>
                            </div>
                        </div>
                        
                       
                    </form>
                    <script type="text/javascript">

                        function cargarSoli(idso){
                            $.ajax({
                                    // la URL para la petición
                                url : '../../controllers/proveedor/get_datosSoli.php',

                                // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                data : { idso : idso },

                                // especifica si será una petición POST o GET
                                type : 'POST',

                                // el tipo de información que se espera de respuesta
                                dataType : 'json',

                                // código a ejecutar si la petición es satisfactoria;
                                success : function(json) {
                                    
                                    $("#cantidadA").val(json.Cantidad_MP);
                                    $("#semana").val(json.Semana);
                                    $("#idLote").val(json.ID_Siembra);
                                    $("#observacion").val(json.Observaciones);
                                     $("#dias").val(json.Dia);
                                     $("#namefletero").val(json.Nombre);  
                                    $("#cifletero").val(json.Cedula)
                                    $("#placafletero").val(json.Placa);
                                    
                            
                                    
                                },

                                // código a ejecutar si la petición falla;
                                error : function(xhr, status) {
                                    alert('Disculpe, existió un problema');
                                }
                            })

                        }                           

                    </script>
    <?php
        include('../templates/footer.php');
    ?>