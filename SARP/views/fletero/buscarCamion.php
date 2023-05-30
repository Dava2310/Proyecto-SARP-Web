<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Consultar camiones";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    $n = $usuario;

    
    $usuario= "SELECT * from camiones WHERE ID_Fleteros = $n ";
    $result= mysqli_query($con,$usuario);

    $Chofere = "SELECT * FROM choferes where ID_Fleteros = $n";
    $Resultado_Chofer= mysqli_query($con,$Chofere);


?>
<body>
    <div class="container-fluid">
        <div class="row"> 
                <?php
                    include("../templates/menuFletero.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno"  style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h2>Buscar Camión</h2>
                                    <img class="imagen-titulo" src="../../assets/images/camion.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group  col-md-6 col-sm-12 ">
                                <div class="row">
                                    <label for="camiones" class="col-sm-4 col-form-label">Lista de Camiones</label>
                                        
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-8">
                                        <input placeholder="-- SELECCIONE CAMION --" class="form-control" list="camiones" name="camiones" id="camion" >
                                            <datalist id="camiones" >
                                                <?php
                                                    while($valores = mysqli_fetch_array($result)){
                                                        $id = $valores['ID_Fleteros'];
                                                        $placa = $valores['Placa'];
                                                        echo "<option value=$placa></option>";
                                                    }
                                                ?>
                                            </datalist>
                                    </div>
                                </div>
                            </div>
                        </header>
                            <hr>
                            <form id="form_Camion">
                                <div class="row">
                                    <div class="form-group col-sm">
                                        <label for="Placa">Placa:</label>
                                        <input class="form-control" type="text" name="Placa" id="Placa" required readonly>
                                        <p id="errorPlaca"></p>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Capacidad">Capacidad en Toneladas:</label>
                                        <input class="form-control" type="number" name="Capacidad" id="Capacidad" required readonly>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Modelo">Modelo:</label>  
                                        <input class="form-control" type="text" name="Modelo" id="Modelo" required readonly>
                                        <p id="errorModelo"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                        
                                        <input id="botonCambiarC" type=""  class="btn btn-primary glyphicon glyphicon-pencil" 
                                        value="Modificar (Desactivado)" >
                                        <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                        
                                    </div>
                                </div>
                            </form>
                                    
                            
                                <div class="row justify-content-between" style="margin-left: 10px; margin-top: 25px;">
                                    <div class=" col-md-6 col-sm-12 ">
                                        <div class="row">
                                            <h2>Choferes</h2>
                                            <img class="imagen-titulo" src="../../assets/images/chofer.png" alt="" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                            
                                    <div class="form-group  col-md-6 col-sm-12 ">
                                        <div class="row">
                                            <label  class="col-sm-4 col-form-label">Lista de Choferes</label>
                                                
                                            <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                            <div class="chof col-sm-8">
                                                <input placeholder="-- SELECCIONE CHOFER --" class="form-control" list="Choferes" name="Choferes" id="Chofer" >
                                                <datalist id="Choferes" >
                                                <?php
                                                    while($valoresCH = mysqli_fetch_array($Resultado_Chofer)){
                                                        $idF = $valoresCH['ID_Fleteros'];
                                                        $Cedulas = $valoresCH['Cedula'];
                                                        echo "<option value=$Cedulas></option>";
                                                    }
                                                ?>
                                            </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr> 
                            <form id="form_Chofer" >
                                <div class="row">    
                                    <div class="form-group col-sm">
                                        <label for="Nombre">Nombre:</label>
                                        <input class="form-control" type="text" name ="Nombre" id="Nombre" required readonly>
                                        <p id="errorName"></p>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Nombre">Apellido:</label>
                                        <input class="form-control" type="text" name ="Apellido" id="Apellido" required readonly>
                                        <p id="errorApellido"></p>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Cedula">Cédula de Identidad :</label>
                                        <input class="form-control" type="text" name="Cedula" id="Cedula" required readonly>
                                        <p id="errorCedula"></p>
                                    </div> 
                                </div> 
                                
                                
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                        <input id="botonCambiar" type=""  class="btn btn-primary glyphicon glyphicon-pencil" 
                                        value="Modificar (Desactivado)" >
                                        <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                        <button id="asignar" type="button" class="btn btn-info">Asignar chofer al camion</button>
                                    </div>
                                </div>
                            </form>  
                            
                            <script type="module" src="../../assets/js/Fletero/buscarCamion.js"></script>
<?php
    include ("../templates/footerFletero.php")
?>