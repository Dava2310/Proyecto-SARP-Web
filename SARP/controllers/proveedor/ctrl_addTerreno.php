<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $folio = $_POST['folio'] ?? "";
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
        ( Tamanio, Ubicacion, ID_Usuario, Folio)
        values
        ('$tamanio','$ubicacion','$usuario', '$folio');");
        echo "<script>window.alert('Se ha registrado con exito');</script>";
        header("location: ../../views/proveedor/datosTerreno.php");
    }
?>