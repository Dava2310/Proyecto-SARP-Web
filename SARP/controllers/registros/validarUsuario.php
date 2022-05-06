<?php
    session_start();
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $cargo = $_POST['tipoUsuario'] ?? "";

    if($email == ""){
        echo "<script> alert('No me indicaron los datos del usuario a validar'); </script>";
        echo "<script> window.location('../../views/registros/login.php');</script>";
        session_destroy();
    } else {
        /*
            PROCESO DE VALIDACION:
            Una query en MySQL que valide todos los 3 datos al mismo tiempo
            Y que la password sea encriptada al momento de pasar la comparacion
        */ 
        include("../conexion.php"); //Conexion a la base de datos.
        //Query Buscando al usuario
        $result = $con->query("select * from usuario 
        where tipo_Usuario = '$cargo' and Email = '$email'
        and Password = md5('$password');");

        //Validando que se haya encontrado al usuario.
        if(!($row = $result->fetch_object())){
            //echo "window.alert('$email $password $cargo');";
            echo "<script>window.alert('No se ha encontrado el usuario con estos datos');</script>";
            echo "<script>window.location='../../views/registros/login.php';</script>";
            session_destroy();
            //Si se encontro
        } else {
            

            $_SESSION['ID'] = $row->ID_Usuario;
            //Si se encontró al usuario, se le dirige a la página que le corresponde
            echo "<script>window.alert('Encontrado con exito, bienvenido: $row->Nombre $row->Apellido');</script>";
            switch($cargo){
                case 1:
                    echo "<script> window.location='../../views/contraloria/datosPersonales.php; </script>";
                    break;
                case 2:
                    echo "<script> window.location='../../views/agropecuaria/datosPersonales.php; </script>";
                    break;
                case 3:
                    //echo "<script> window.location='../../views/proveedor/datosPersonales.php;</script>";
                    header("location: ../../views/proveedor/datosPersonales.php");
                    break;
                case 4:
                    echo "<script> window.location='../../views/fletero/datosPersonales.php; </script>";
                    break;
                default:
                    echo "<script> window.location='../../views/registros/register.html'; </script>";
                    echo "<script> window.alert('No se ha logrado identificar el tipo de Usuario Ingresado');</script>";           
            }
        }     
    }
?>