<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $dias = $_POST['dias'] ?? "";
    $chofer = $_POST['chofer'] ?? "";
    $idsoli = $_POST['idsoli'] ?? "";
    $observacion = $_POST['observacion'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        $result = $con->query("update solicitud_fletero
            set Estado_Aprobacion= '1',
            Observaciones = '$observacion',
            Dia = '$dias',
            ID_chofer = '$chofer'
            where ID_Solicitud_Fletero = '$idsoli';");
        
            echo "ok";
    }
?>