<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $banco = $_POST['Banco'] ?? "";
    $nrocuenta = $_POST['Nrocuenta'] ?? "";
    $tipocta = $_POST['TpoCuenta'] ?? "";
    $nombreA = $_POST['NombreA'] ?? "";
    $apellidoA = $_POST['ApellidoA'] ?? "";
    $bancoA = $_POST['BancoA'] ?? "";
    $nroctaA = $_POST['NrocuentaA'] ?? "";
    $tipoctaA = $_POST['TpoCuentaA'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        $result = $con->query("update usuario
            set Banco_P='$banco',
            Cuenta_P = '$nrocuenta',
            TipoCuenta_P = '$tipocta',
            Nombre_A = '$nombreA',
            Apellido_A = '$apellidoA',
            Banco_A = '$bancoA',
            Cuenta_A = '$nroctaA',
            TipoCuenta_A = '$tipoctaA'
            where ID_Usuario = '$usuario';");
        echo "<script>window.alert('Se ha modificado con exito');</script>";
        header("location: ../../views/fletero/datosBancarios.php");
    }
?>