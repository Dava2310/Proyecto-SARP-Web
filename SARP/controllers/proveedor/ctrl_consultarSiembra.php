<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $idSiembra = $_POST ['idLote'] ?? "";
    $kilosT = $_POST['kilosT'] ?? "";
    $variedad = $_POST['variedad'] ?? "";
    $Fcosecha = $_POST['fechaC'] ?? "";
    $rendimiento = $_POST['rendimiento'] ?? "";
    $hectareas = $_POST['hectareas'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        $result = $con->query("update siembras
            set Kilos_Totales='$kilosT',
            Variedad = '$variedad',
            Fecha_Cosecha = '$Fcosecha',
            Hectareas = '$hectareas'
            where ID_Siembra = '$idSiembra';");
        echo json_encode('Se ha modificado con exito');
       
    }
?>