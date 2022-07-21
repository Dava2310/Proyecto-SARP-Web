<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $idlote = $_POST['idLote'] ?? "";
    $observacion = $_POST['observacion'] ?? "";
    $idsoli = $_POST['idsoli'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $result = $con->query("update solicitud_proveedor
            set Estado_Aprobacion= '1',
            Observaciones = '$observacion'
            where ID_Solicitud_Proveedor = '$idsoli';");
        
            echo "ok";
    }
?>