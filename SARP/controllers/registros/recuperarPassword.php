<?php

    $email = $_POST['email'] ?? "";
    $password = $_POST['newP'] ?? "";
    $pregunta = $_POST['question'] ?? "";
    $respuesta = $_POST['answer'] ?? "";
    $tipoUsuario = $_POST['tipoUsuario'] ?? "";

    if($email == ""){
        echo "<script> alert('No me indicaron los datos del usuario'); </script>";
        echo "<script> window.location('../../views/registros/recover.php');</script>";
    } else {
        include("../conexion.php");
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        //Se hace primero la validacion que se encuentre
        //Un usuario con todos los datos excepto la password
        $result1 = $con->query("select * from usuario
        where Email='$email' and Pregunta = '$pregunta'
        and Respuesta = '$respuesta' and tipo_Usuario='$tipoUsuario';");

        //validando que se encuentre el usuario
        if(!($row = $result1->fetch_object())){
            //Si no se encuentra
            echo "<script>window.alert('No se ha encontrado el usuario con estos datos');</script>";
            echo "<script>window.location='../../views/registros/recover.php';</script>";
        } else {
            //Si se encuentra
            //Se captura el ID del usuario encontrado
            $id = $row->ID_Usuario;
            //Se cambia la contraseña de ese usuario
            $result2 = $con->query("update usuario
            set Password = md5('$password') 
            where ID_Usuario = '$id';");
            echo "<script> alert('Contraseña recuperada con éxito.'); </script>";
        }
    }




?>
<script>window.location="../../views/registros/login.php"</script>