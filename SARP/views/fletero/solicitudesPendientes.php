<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Solicitudes Pendientes";
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
    $sql= "SELECT * FROM solicitud_proveedor
    INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
    INNER JOIN camiones ON solicitud_fletero.Placa = camiones.Placa
    WHERE
    solicitud_fletero.Estado_Aprobacion = 0 AND
    camiones.ID_Fleteros = $usuario
    ";
    $result= mysqli_query($con,$sql);
?>
<body>
    <div class="container-fluid">   
        <div class="row"> 
                <?php
                    include("../templates/menuFletero.php");
                ?>
                
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                    <div class="row">
                                        <h2 >Solicitudes Pendientess</h2>
                                        <img class="imagen-titulo" src="../../assets/images/solicitudesPendientes.png" alt="" style="width: 50px; height: 50px;">
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
                                                    $id = $valores['ID_Solicitud_Fletero'];
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
                        
                        <form action="" class="contenidoform" id="formulario">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cantidadkilos">Cantidad en Kilos:</label>
                                    <input class="form-control" type="text" name="cantidadkilos" id="cantidadkilos" readonly>
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="semana">Semana:</label>
                                    <input class="form-control" type="text" name="semana" id="semana" readonly>
                                    
                                </div>
                          
                            </div>
                            <div class="row">
                                <!-- Dias -->
                                <div class="col-3" style="margin-bottom: 20px;">
                                    <label for="dias">Días:</label>
                                    <img class="imagen-titulo" src="../../assets/images/si.png" name= "dias"alt="" style="width: 50px; height: 50px;">
                                    <input class="form-control"type="date" name="dias" id="dias" required disabled>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Dias -->
                                <div class="col-4">
                                    <label for="Camion">Camion:</label>
                                    <input class="form-control"type="text" name="Camion" id="Camion" readonly >
                                </div>
                                <div class="col-4">  
                                
                                    <label  >Lista de Choferes</label>
                                        
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    
                                    <select id="chofer" name="chofer"  class="form-control" disabled >
                                        <option value="">-- SELECCIONE CHOFER --</option>
                                    </select>
                                            
                                        
                                    
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="form-group col-sm">
                                    <label for="observacion">Observacion</label>
                                    <textarea class="form-control" name="observacion" placeholder="Coloca tus observaciones!" style="max-height: 30vh;"></textarea>
                                </div>
                                <div class="form-group col-md-4" style="display: none;">
                                    <label for="idsoli">ID solicitud:</label>
                                    <input class="form-control" type="text" name="idsoli" id="idsoli" required readonly>
                                </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-12">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-pencil" onclick="EliminarSoli()">Rechazar</button>
                                <button type="button" class="btn btn-success glyphicon glyphicon-pencil" onclick="aceptarSoli()">Aceptar</button>
                            </div>
                        </div>
                        </form>
                        <script src="../../assets/js/Fletero/solicitudesPendientes.js" ></script>
<?php
    include ("../templates/footerFletero.php")
?>