<?php

    $nombre = $_POST['nombre'] ?? "";
    $apellido = $_POST['apellido'] ?? "";
    $cedula = $_POST['cedula'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $tipoUsuario = $_POST['tipoUsuario'] ?? "";
    $codigo = $_POST['codigo'] ?? "";

    if($nombre == ""){
        echo "<script> alert('No me indicaron los datos del usuario a agregar'); </script>";
        echo "<script> window.location('../../views/registros/register.html');</script>";
    } else {
        include("../conexion.php");

        $result = $con->query("insert into usuario
            (tipo_Usuario, Nombre, Apellido, Cedula, Email, Password)
            values
            ('$tipoUsuario','$nombre','$apellido','$cedula','$email',md5('$password'));");
        echo "<script> alert('agregado con exito');</script>";
    }

    switch($tipoUsuario){
        case 1:
            echo "<script> window.location('../../views/contraloria/datosPersonales.php'); </script>";
            break;
        case 2:
            echo "<script> window.location('../../views/agropecuaria/datosPersonales.php'); </script>";
            break;
        case 3:
            echo "<script> window.alert('Me mandaste un PROVEEDOR');</script>";
            echo "<script> window.location='../../views/proveedor/datosPersonales.php'; </script>";
            break;
        case 4:
            echo "<script> window.location='../../views/fletero/datosPersonales.php'; </script>";
            break;
        default:
            echo "<script> window.location('../../views/registros/register.html'); </script>";
            echo "<script> window.alert('No se ha logrado identificar el tipo de Usuario Ingresado');</script>";
            
    }
?>
