<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Planificacion arrime";
    include('../templates/headFletero.php');

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
                    include("../templates/menuAgropecuaria.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h2>Planificacion de arrime</h2>
                            <img class="imagen-titulo" src="../../assets/images/planificacion.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        
                            <div class="row justify-content-between" style="margin-left: 10px; margin-bottom: 20px;">
                                <div class="  col-md-6 col-sm-12 ">
                                    <h3> Crear Nueva Planificacion:</h3>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    
                                    <button onclick="location.href='../agropecuaria/crearArrime.php'" class="btn btn-success glyphicon glyphicon-pencil">Crear</button>
                                </div>
                            
                            </div>
                            
                            <div class="row justify-content-between" style="margin-left: 10px; margin-bottom: 20px;">
                                <div class="  col-md-6 col-sm-12 ">
                                    <h3>Seguir modificando una planificacion:</h3>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="Semana">semana</label>
                                    <input  type="week" name ="Semana" id="Semana">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Generar reporte</button>
                                </div>
                            
                            </div>
                            
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>