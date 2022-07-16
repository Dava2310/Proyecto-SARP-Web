<?php

    $nombre = $_POST['nombre'] ?? "";
    $apellido = $_POST['apellido'] ?? "";
    $cedula = $_POST['cedula'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $pregunta = $_POST['question'] ?? "";
    $respuesta = $_POST['answer'] ?? "";
    $tipoUsuario = $_POST['tipoUsuario'] ?? "";
    $codigo = $_POST['codigo'] ?? "";

    if($nombre == ""){
        echo "<script> alert('No me indicaron los datos del usuario a agregar'); </script>";
        echo "<script> window.location('../../views/registros/register.php');</script>";
    } else {
        include("../conexion.php");

        //Para hacer la validacion de la pregunta, tenemos que verificar
        //Que corresponda el tipo de usuario con ese codigo de seguridad

        $result1 = $con->query("select * from codigo;");
        $row = $result1->fetch_object();

        $proceder = 0;

        switch($tipoUsuario){
            case 1:
                if($codigo == $row->codigoContraloria){
                    $proceder = 1;
                }
                break;
            case 2:
                if($codigo == $row->codigoAgropecuaria){
                    $proceder = 1;
                }
                break;
            case 3:
                if($codigo == $row->codigoProveedor){
                    $proceder = 1;
                }
                break;
            case 4:
                if($codigo == $row->codigoFletero){
                    $proceder = 1;
                }
                break;
        }

        if($proceder == 1){
            $result2 = $con->query("insert into usuario
            (tipo_Usuario, Nombre, Apellido, Cedula, Email, Password, Pregunta, Respuesta)
            values
            ('$tipoUsuario','$nombre','$apellido','$cedula','$email',md5('$password'), '$pregunta', '$respuesta');");
            echo "<script> alert('agregado con exito');</script>";
        } else {
            echo "<script> alert('Codigo invalido de seguridad');</script>";
            echo "<script>window.location='../../views/registros/register.php'</script>";
        }

        
    }

?>
<script>window.location="../../views/registros/login.php"</script>
