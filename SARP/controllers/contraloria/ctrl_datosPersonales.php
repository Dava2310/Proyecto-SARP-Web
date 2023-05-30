<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $nombre = $_POST['nombre'] ?? "";
    $Apellido = $_POST['Apellido'] ?? "";
    $telefono = $_POST['tlf'] ?? "";
    $rif = $_POST['rif'] ?? "";
    $direccion = $_POST['direccion'] ?? "";

    if(!(isset($usuario))){
        echo json_encode("no");
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        
        $result = $con->query("update usuario
            set Nombre='$nombre',
            Apellido = '$Apellido',
            Telefono = '$telefono',
            RIF = '$rif',
            Direccion = '$direccion'
            where ID_Usuario = '$usuario';");
        echo json_encode("agregado con exito");
    }
?>