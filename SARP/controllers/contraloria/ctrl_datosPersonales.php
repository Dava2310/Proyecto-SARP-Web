<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $nombre = $_POST['nombre'] ?? "";
    $apellido = $_POST['apellido'] ?? "";
    $telefono = $_POST['tlf'] ?? "";
    $rif = $_POST['rif'] ?? "";
    $direccion = $_POST['direccion'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $result = $con->query("update usuario
            set Nombre='$nombre',
            Apellido = '$apellido',
            Telefono = '$telefono',
            RIF = '$rif',
            Direccion = '$direccion'
            where ID_Usuario = '$usuario';");
        echo "<script>window.alert('Se ha modificado con exito');</script>";
        header("location: ../../views/contraloria/datosPersonales.php");
    }
?>