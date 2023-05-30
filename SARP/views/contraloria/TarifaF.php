<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Tarifas";
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
    $result = $con->query("SELECT
     *
    FROM
    solicitud_proveedor
    INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
    INNER JOIN siembras ON solicitud_proveedor.ID_Siembra = siembras.ID_Siembra
    INNER JOIN usuario ON siembras.ID_Proveedor = usuario.ID_Usuario
    INNER JOIN planificaciones ON solicitud_proveedor.ID_Planificacion = planificaciones.ID_Planificacion
    WHERE
    solicitud_fletero.Estado_Aprobacion = 1 AND
    solicitud_proveedor.Estado_Aprobacion = 1");
?>
<body>
    <div class="container-fluid">   
        <div class="row"> 
                <?php
                    include("../templates/menuContraloria.php");
                ?>
                
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                    <div class="row">
                                        <h2 >Tarifas</h2>
                                        <img class="imagen-titulo" src="../../assets/images/aceptar.png" alt="" style="width: 50px; height: 50px;">
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
                        
                        <form action="" class="contenidoform" id="formulario">
                            <div class=" col-md-6 col-sm-12 " style="margin-bottom: 20px;">
                                    <div class="row">
                                        <h2 >Proveedores</h2>
                                        
                                    </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cantidadkilos">Materia Prima:</label>
                                    <input class="form-control" type="number" name="cantidadkilos" id="cantidadkilos" readonly  placeholder="Kilos arrimados">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="semana">Precio:</label>
                                    <input class="form-control" type="number" name="PrecioMP" id="PrecioMP"  placeholder="$USD">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Total">Total:</label>
                                    <input class="form-control" type="number" name="TotalMP" id="TotalMP" readonly placeholder="Materia Prima * Precio" onclick="CalcularMP()">
                                    
                                </div>
                                <div class="form-group col-md-4" style="display: none;">
                                    <label for="idsoli">ID solicitud:</label>
                                    <input class="form-control" type="text" name="idsoli" id="idsoli" required readonly>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cantidadkilos">Cuadrilla:</label>
                                    <input class="form-control" type="number" name="cantidadkilosA" id="cantidadkilosA" readonly placeholder="Kilos arrimados">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="semana">Precio:</label>
                                    <input class="form-control" type="number" name="PrecioCA" id="PrecioCA"  placeholder="$USD">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Total">Total:</label>
                                    <input class="form-control" type="number" name="TotalCA" id="TotalCA" readonly placeholder="Cuadrilla * Precio" onclick="CalcularCA()">
                                    
                                </div>

                            </div>
                            <hr>
                            <div class=" col-md-6 col-sm-12 " style="margin-bottom: 20px;">
                                    <div class="row">
                                        <h2 >Fletero</h2>
                                        
                                    </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cantidadkilos">Flete:</label>
                                    <input class="form-control" type="number" name="viaje" id="viaje" placeholder="Cantidad de viajes" >
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="semana">Precio:</label>
                                    <input class="form-control" type="number" name="PrecioFL" id="PrecioFL"  placeholder="$USD">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Total">Total:</label>
                                    <input class="form-control" type="number" name="TotalFL" id="TotalFL" readonly placeholder="nro de viajes * Precio flete" onclick="CalcularFL()">
                                    
                                </div>

                            </div>

                            <div class="row" >
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil" onclick="guardarTarifa()">Guardar Cambios</button>
                            </div>
                        </div>
                            
                        </div>
                        </form>
                        <script src="../../assets/js/contraloria/TarifaF.js"></script>
<?php
    include ("../templates/footerFletero.php")
?>