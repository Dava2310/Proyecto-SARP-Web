<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Planificacion arrime";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    } 

    $usuario= "SELECT ID_Usuario,Cedula FROM usuario WHERE tipo_Usuario = 3; ";
    $result= mysqli_query($con,$usuario);

    $result2= $con->query("select Semana,ID_Planificacion from planificaciones;");

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
                            <h2>Planificacion de arrime</h2>
                            <img class="imagen-titulo" src="../../assets/images/planificacion.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        
                            
                        <form  id="formulario" >
                            <div class="row justify-content-center" id="fase_1">
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="semana">Semana</label>
                                    <select  class="form-control "  name="semana" id="semana" >
                                        <option value=""> --SEMANA-- </option>
                                        <?php
                                            while($valores = mysqli_fetch_array($result2)){
                                                $id = $valores['ID_Planificacion'];
                                                $Semana = $valores['Semana'];
                                                echo "<option value=$Semana>$Semana</option>";
                                            }
                                        ?>
                                    
                                    </select>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="cantidad">Cantidad:</label>
                                    <input  class="form-control" type="number" name="cantidad" id="cantidad" required>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <button type="button" id="boton1" class="btn btn-success glyphicon glyphicon-pencil" >Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center" id="fase_2" style="display: none;">
                                
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="Proveedores">Proveedores:</label>
                                    <input placeholder="-- SELECCIONE PROVEEDOR --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor">
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
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label >Siembra:</label>  
                                    <div class="col-12">
                                        <select id="Siembra" disabled class="form-control">
                                            <option value="">-- SELECCIONE SIEMBRA --</option>
                                        </select>

                                        <!-- <input placeholder="-- SELECCIONE CHOFER --" class="form-control" list="choferes" name="choferes" id="chofer" onchange='mifuncionCh(this.value)'>
                                            <datalist id="choferes" >
                                                <
                                            </datalist> -->
                                    </div>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="Nombre">Nombre</label>  
                                    <input  class="form-control" type="text" name="Nombre" id="Nombre" required readonly>
                                </div>
                            
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="disponibilidad">disponibilidad</label>
                                    <input  class="form-control" type="number" name="disponibilidad" id="disponibilidad" required readonly>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="IDLote">ID Lote:</label>
                                    <input  class="form-control" type="text" name="IDLote" id="IDLote" required readonly>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="SolicitudSiembraStda">Solicitud:</label>  
                                    <input  class="form-control" type="number" name="SolicitudSiembraStda" id="Solicitud" >
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" id="btn_Fase2" class="btn btn-success glyphicon glyphicon-pencil">Agregar</button>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <hr>
                            
                            <div class="row align-items-center" id="fase_3" style="display: none;">
                                    
                                    <div class="form-group  col-md-6 col-sm-12">
                                        <label >Siembra Solicitada</label>
                                        <select id="SiembraStda" disabled class="form-control " >
                                            <option value="">-- SELECCIONE SIEMBRA --</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-6">
                                            <button  type="button" id="borrar" name="borrar" class="btn btn-danger glyphicon glyphicon-pencil">Eliminar</button>
                                    </div>
                                
                                
                                    <div class="form-group  col-md-6 col-sm-12">
                                        <label for="cantidadtemp">Cantidad temporal:</label>
                                        <input  class="form-control" type="number" name="cantidadtemp" id="cantidadtemp" readonly>
                                    </div>
                                
                                
                                
                            </div>
                            <hr>
                            
                           
                            
                            
                        </form>
                        <script src="../../assets/js/agropecuario/modificarArrime.js"></script>
                            
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>