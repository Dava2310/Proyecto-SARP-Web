<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Transporte";
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
    $result2= $con->query("select Semana,ID_Planificacion from planificaciones;");

   /*  $sql= "SELECT * FROM solicitud_proveedor INNER JOIN siembras ON solicitud_proveedor.ID_Siembra=siembras.ID_Siembra WHERE  solicitud_proveedor.Estado_Aprobacion=1 ; ";
    $result= mysqli_query($con,$sql); */

    $query= "SELECT * FROM usuario WHERE tipo_Usuario = 4; ";
    $result= mysqli_query($con,$query);
    
    //YA AQUI TENGO LOS DATOS DEL USUARIO
?>
<body>
    <div class="container-fluid">
        <div class="row"> 
    
                <?php
                    include("../templates/menuAgropecuaria.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h2><?=$_titulo?></h2>
                            <img class="imagen-titulo" src="../../assets/images/chofer.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <form   id="Formulario">
                            <div class="row">
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="semana">Semana</label>
                                    <select  class="form-control "  name="semana" id="semana"  >
                                        <option value=""> --SEMANA-- </option>
                                        <?php
                                            while($valores = mysqli_fetch_array($result2)){
                                                $id = $valores['ID_Planificacion'];
                                                $Semana = $valores['Semana'];
                                                echo "<option value=$id>$Semana</option>";
                                            }
                                        ?>
                                    
                                    </select>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                        <label for="IDLote">ID Lote:</label>
                                        <input  class="form-control" type="text" name="IDLote" id="IDLote" required readonly>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="solicitudes" >Solicitudes aceptadas</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <select id="solicitudes" name="solicitudes" disabled class="form-control " onchange="cargarArrime(this.value)">
                                            <option value="">-- SELECCIONE SOLICITUD--</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cantidadA">Cantidad a Arrimar:</label>
                                    <input class="form-control" type="text" name="cantidadA" id="cantidadA" required readonly>
                                </div>
                                
                                
                                <div class="form-group col-md-6">
                                    <label for="Fleteros" class="col-sm-4 col-form-label">Lista de Fleteros</label>
                                    
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    
                                    <input placeholder="-- SELECCIONE FLETERO --" class="form-control" list="Fleteros" name="Fleteros" id="Fletero" onchange='datosFletero(this.value)' readonly>
                                        <datalist id="Fleteros" >
                                            <?php
                                                while($valores = mysqli_fetch_array($result)){
                                                    $Nombre = $valores['Nombre'];
                                                    $Apellido = $valores['Apellido'];
                                                    $Cedula = $valores['Cedula'];
                                                    echo "<option value=$Cedula>$Nombre $Apellido</option>";
                                                }
                                            ?>
                                        </datalist>
                                    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="Nombre">Nombre:</label>
                                    <input readOnly class="form-control" type="text" name="Nombre" id="Nombre" required>
                                </div>
                            
                                <div class="form-group col-md-3">
                                    <label for="Apellido">Apellido:</label>
                                    <input readOnly class="form-control" type="text" name="Apellido" id="Apellido" required>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12 ">
                                    
                                        <label for="camiones" class="col-sm-4 col-form-label">Lista de Camiones</label>
                                            
                                        <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                        
                                        <input placeholder="-- SELECCIONE CAMION --" class="form-control" list="camiones" name="camiones" id="camion"  readonly>
                                            <!-- <datalist id="camiones" >
                                                
                                            </datalist> -->
                                </div>
                                <div class="form-group  col-md-6 col-sm-12 ">
                                    
                                    <label  class="col-sm-4 col-form-label">Capacidad</label>
                                    <input readOnly class="form-control" type="text" name="Capacidad" id="Capacidad" required>
                                    
                                
                                </div>

                            
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil" >Enviar solicitud</button>
                                </div>
                            </div>
                        </form>
                        <script src="../../assets/js/agropecuario/transporte.js"></script>
<?php
    include ("../templates/footerFletero.php")
?>