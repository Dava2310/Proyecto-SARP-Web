<?php
    session_start();
    $usuario = $_SESSION['ID'];

    //--------DATOS DEL CAMION----------
    $placa = $_POST['Placa'] ?? "";
    $modelo = $_POST['Modelo'] ?? "";
    $capacidad = $_POST['Capacidad'] ?? "";
    //----------DATOS DEL CHOFER-----------
    $Cedula = $_POST['Cedula'] ?? "";
    $nombre = $_POST['Nombre'] ?? "";
    $Apellido = $_POST['Apellido'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        //actualizar chofer
        $resultCh = $con->query("update choferes
            set Nombre = '$nombre',
            Apellido = '$Apellido'
            where Cedula = '$Cedula';");


        echo json_encode("agregado con exito");
    }
?>