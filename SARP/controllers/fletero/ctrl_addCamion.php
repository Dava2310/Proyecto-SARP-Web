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
    //----------DATOS DEL CHOFER 2-----------
    $cedula2 = $_POST['CI2'] ?? "";
    $nombre2 = $_POST['Nombre2'] ?? "";
    $apellido2 = $_POST['Apellido2'] ?? "";


    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        // se registran datos del camion
        $resultC = $con->query("insert into camiones
        (Placa, Modelo, Capacidad, ID_Fleteros)
        values
        ('$placa','$modelo','$capacidad','$usuario');");
        // registro de chofer 1
        $resultCh = $con->query("insert into choferes
        (Cedula, Nombre, Apellido)
        values
        ('$cedula','$nombre','$apellido');");
        // registro de chofer 2
        $resultCh2 = $con->query("insert into choferes
        (Cedula, Nombre, Apellido)
        values
        ('$cedula2','$nombre2','$apellido2');");

        //enlace chofer camion 1
        $resultCyC = $con->query("insert into camion_chofer
        (ID_Camion, ID_chofer)
        values
        ('$placa','$cedula');");

        //enlace chofer camion 2
        $resultCyC2 = $con->query("insert into camion_chofer
        (ID_Camion, ID_chofer)
        values
        ('$placa','$cedula2');");


        

        echo "<script>window.alert('Se ha registrado con exito');</script>";
        header("location: ../../views/fletero/addCamion.php");

        
    }
?>