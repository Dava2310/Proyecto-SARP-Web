<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $tamanio = $_POST['espacio'] ?? "";
    $ubicacion = $_POST['ubicacion'] ?? "";
    

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        $result = $con->query("insert into terrenos
        ( Tamanio, Ubicacion, ID_Usuario)
        values
        ('$tamanio','$ubicacion','$usuario');");
        echo "<script>window.alert('Se ha registrado con exito');</script>";
        header("location: ../../views/proveedor/datosTerreno.php");
    }
?>