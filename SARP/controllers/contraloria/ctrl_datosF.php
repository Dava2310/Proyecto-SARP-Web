<?php
    $P_A = $_POST['cuentapropia'] ?? ""; //determina si la cta es personal o autorizada
    $cedula = $_POST['CI'] ?? "";

    $nombre = $_POST['Nombre'] ?? "";
    $apellido = $_POST['Apellido'] ?? "";

    $telefono = $_POST['tlf'] ?? "";
    $rif = $_POST['rif'] ?? "";
    $direccion = $_POST['direccion'] ?? "";
    $banco = $_POST['Banco'] ?? "";
    $nrocuenta = $_POST['numcuenta'] ?? "";
    $tipocta = $_POST['TpoCuenta'] ?? "";
    $nombreA = $_POST['NombreA'] ?? "";
    $apellidoA = $_POST['ApellidoA'] ?? "";
    $bancoA = $_POST['Banco'] ?? "";
    $nroctaA = $_POST['numcuenta'] ?? "";
    $tipoctaA = $_POST['TpoCuenta'] ?? "";

 
        include('../conexion.php');
        if($P_A == "PERSONAL"){
            $result = $con->query("update usuario
                                set Nombre='$nombre',
                                Apellido = '$apellido',
                                Telefono = '$telefono',
                                RIF = '$rif',
                                Direccion = '$direccion',
                                Banco_P='$banco',
                                Cuenta_P = '$nrocuenta',
                                TipoCuenta_P = '$tipocta'
                                where Cedula = '$cedula';");
        }else if($P_A == "AUTORIZADA"){
            $result = $con->query("update usuario
                                set Nombre='$nombre',
                                Apellido = '$apellido',
                                Telefono = '$telefono',
                                RIF = '$rif',
                                Direccion = '$direccion',
                                Banco_A='$banco',
                                Cuenta_A = '$nrocuenta',
                                TipoCuenta_A = '$tipocta',
                                Nombre_A = '$nombreA',
                                Apellido_A='$apellidoA'
                                where Cedula = '$cedula';");
        }
        
    echo "<script>alert('Se ha modificado con exito');</script>";
    header("location: ../../views/contraloria/datosFleteros.php");
    
?>