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
        echo "<script> window.location('../../views/registros/register.php');</script>";
    } else {
        include("../conexion.php");

        $result = $con->query("insert into usuario
            (tipo_Usuario, Nombre, Apellido, Cedula, Email, Password)
            values
            ('$tipoUsuario','$nombre','$apellido','$cedula','$email',md5('$password'));");
        echo "<script> alert('agregado con exito');</script>";
    }

?>
<script>window.location="../../views/registros/login.php"</script>
