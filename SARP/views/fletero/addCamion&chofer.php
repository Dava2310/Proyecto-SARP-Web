<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Añadir Camion";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
?>
<body>
    

    <div class="container-fluid">
        <div class="row"> 
                <?php
                    include("../templates/menuFletero.php");
                ?>
                <div  class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;" >
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h2>Añadir Camion</h2>
                            
                            <img class="imagen-titulo" src="../../assets/images/camion.png" alt="" style="width: 50px; height: 50px;">
                            
                        </header>
                        <hr>
                        <form id="form_Camion" >
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="Placa">Placa:</label>
                                    <input class="form-control" type="text" name="Placa" id="Placa" required>
                                    <p id="errorPlaca"></p>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Capacidad">Capacidad en Toneladas:</label>
                                    <input class="form-control" type="number" name="Capacidad" id="Capacidad" required>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Modelo">Modelo:</label>  
                                    <input class="form-control" type="text" name="Modelo" id="Modelo" required>
                                    <p id="errorModelo"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Terminar registro</button>
                                </div>
                            </div>
                        </form>
                        <div class="row" style="margin-left: 10px; margin-top: 8px;">
                            <h2>Añadir Choferes</h2>
                            <img class="imagen-titulo" src="../../assets/images/chofer.png" alt="" style="width: 50px; height: 50px;"> 
                        </div>
                        <hr>
                        
                        <form id = "form_Chofer">
                            <div class="row">    
                                <div class="form-group col-sm">
                                    <label for="Nombre">Nombre:</label>
                                    <input class="form-control" type="text" name ="Nombre" id="Nombre" required>
                                    <p id="errorName"></p>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Apellido">Apellido:</label>
                                    <input class="form-control" type="text" name ="Apellido" id="Apellido" required>
                                    <p id="errorApellido"></p>
                                </div>
                                <div class="form-group col-sm">
                                    <label for="Cedula">Cédula de Identidad:</label>
                                    <input class="form-control" type="text" name="Cedula" id="Cedula" required>
                                    <p id="errorCedula"></p>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Terminar registro</button>
                                </div>
                            </div>
                        </form>   
                        <script type="module" src="../../assets/js/Fletero/addCamion&Chofer.js"></script>   
<?php
    include ("../templates/footerFletero.php")
?>
