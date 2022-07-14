<?php
    session_start();
    $usuario = $_SESSION['ID'];

    //--------DATOS DEL CAMION----------
    $placa = $_POST['Placa'] ?? "";
    $modelo = $_POST['Modelo'] ?? "";
    $capacidad = $_POST['Capacidad'] ?? "";
    //----------DATOS DEL CHOFER-----------
    $cedula = $_POST['CI'] ?? "";
    $nombre = $_POST['Nombre'] ?? "";
    $apellido = $_POST['Apellido'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        //actualizar camion
        $resultC = $con->query("update camiones
            set Modelo = '$modelo',
            Capacidad = '$capacidad'
            where Placa = '$placa';");
        //actualizar chofer
        $resultCh = $con->query("update choferes
            set Nombre = '$nombre',
            Apellido = '$apellido'
            where Cedula = '$cedula';");


        echo "<script>window.alert('Se ha modificado con exito');</script>";
        header("location:../../views/fletero/buscarCamion.php");
    }
?>