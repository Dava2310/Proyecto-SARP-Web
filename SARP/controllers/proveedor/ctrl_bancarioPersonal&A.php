<?php
    session_start();
    $P_A = $_POST['cuentapropia'] ?? ""; //determina si la cta es personal o autorizada
    $usuario = $_SESSION['ID'];
    $banco = $_POST['Banco'] ?? "";
    $nrocuenta = $_POST['numcuenta'] ?? "";
    $tipocta = $_POST['TpoCuenta'] ?? "";
    $nombreA = $_POST['NombreA'] ?? "";
    $apellidoA = $_POST['ApellidoA'] ?? "";
  /*   $bancoA = $_POST['BancoA'] ?? "";
    $nroctaA = $_POST['NrocuentaA'] ?? "";
    $tipoctaA = $_POST['TpoCuentaA'] ?? ""; */

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        if($P_A == "PERSONAL"){
            $result = $con->query("update usuario
                                set Banco_P='$banco',
                                Cuenta_P = '$nrocuenta',
                                TipoCuenta_P = '$tipocta'
                                where ID_Usuario = '$usuario';");
                                
        echo json_encode("agregado con exito");
        //si el tipo de cta es autorizada
        }else if($P_A == "AUTORIZADA"){
            $result = $con->query("update usuario
                                set Banco_A='$banco',
                                Cuenta_A = '$nrocuenta',
                                TipoCuenta_A = '$tipocta',
                                Nombre_A = '$nombreA',
                                Apellido_A='$apellidoA'
                                where ID_Usuario = '$usuario';");

            echo json_encode("agregado con exito");
        }else{

            echo json_encode("Seleccione cuenta personal o autorizada");
        }

       
        /* $result = $con->query("update usuario
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
        header("location: ../../views/proveedor/datosBancarios.php"); */
    }
?>