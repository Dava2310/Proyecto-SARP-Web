<?php
    $P_A = $_POST['cuentapropia'] ?? ""; //determina si la cta es personal o autorizada
    $Cedula = $_POST['Cedula'] ?? "";

    $nombre = $_POST['Nombre'] ?? "";
    $Apellido = $_POST['Apellido'] ?? "";

    $telefono = $_POST['tlf'] ?? "";
    $rif = $_POST['rif'] ?? "";
    $direccion = $_POST['direccion'] ?? "";
    $banco = $_POST['Banco'] ?? "";
    $CodBanco = $_POST['CODbanco'] ?? "";
    $nrocuenta = $_POST['numcuenta'] ?? "";
    $tipocta = $_POST['TpoCuenta'] ?? "";
    $nombreA = $_POST['NombreA'] ?? "";
    $apellidoA = $_POST['ApellidoA'] ?? "";
    $bancoA = $_POST['Banco'] ?? "";
    $nroctaA = $_POST['numcuenta'] ?? "";
    $tipoctaA = $_POST['TpoCuenta'] ?? "";

    //inclute e codigo + el numero de cuenta
    $numCuenta = $CodBanco.$nrocuenta; 
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection(); 
        if($P_A == "PERSONAL"){
            $result = $con->query("update usuario
                                set Nombre='$nombre',
                                Apellido = '$Apellido',
                                Telefono = '$telefono',
                                RIF = '$rif',
                                Direccion = '$direccion',
                                Banco_P='$banco',
                                Cuenta_P = '$numCuenta',
                                TipoCuenta_P = '$tipocta'
                                where Cedula = '$Cedula';");
        }else if($P_A == "AUTORIZADA"){
            $result = $con->query("update usuario
                                set Nombre='$nombre',
                                Apellido = '$Apellido',
                                Telefono = '$telefono',
                                RIF = '$rif',
                                Direccion = '$direccion',
                                Banco_A='$banco',
                                Cuenta_A = '$numCuenta',
                                TipoCuenta_A = '$tipocta',
                                Nombre_A = '$nombreA',
                                Apellido_A='$apellidoA'
                                where Cedula = '$Cedula';");
        }
        
    echo json_encode("agregado con exito")
    
?>