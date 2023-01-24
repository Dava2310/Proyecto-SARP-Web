<?php

    // Variables globales
    global $nombre;
    global $apellido;
    global $cedula;
    global $email;
    global $password;
    global $pregunta;
    global $respuesta;
    global $tipoUsuario;
    global $codigo;

    function validateForm(){

        // Accediendo a las variables globales
        global $nombre, $apellido, $cedula, $email, $password, $pregunta, $respuesta, $tipoUsuario, $codigo;

        // Variable que mantiene el estado de correccion del formulario
        $isValid = true;

        // Si se encuentra que hubo datos enviados via POST
        if (isset($_POST['submit'])) {


            error_log("Llego", 0  , "error.log");

            // Se le ingresa a las variables globales, los valores del Formulario
            // En caso de que no encuentre alguna variable
            // Le asignara un valor vacio ""
            $nombre = $_POST['nombre'] ?? "";
            $apellido = $_POST['apellido'] ?? "";
            $cedula = $_POST['cedula'] ?? "";
            $email = $_POST['email'] ?? "";
            $password = $_POST['password'] ?? "";
            $pregunta = $_POST['question'] ?? "";
            $respuesta = $_POST['answer'] ?? "";
            $tipoUsuario = $_POST['tipoUsuario'] ?? "";
            $codigo = $_POST['codigo'] ?? "";

            // Validacion del nombre
            if (!empty($nombre)) {
                if (!preg_match("/^[a-zA-Z ]{4,20}$/", $nombre)) {
                    //echo "Formato de Nombre Invalido";
                    $isValid = false;
                } 
            } else {
                //echo "Nombre es un campo requerido";
                $isValid = false;
            }

            // Validacion del apellido
            if (!empty($apellido)) {
                if (!preg_match("/^[a-zA-Z ]{4,20}$/", $apellido)) {
                    //echo "Formato de apellido invalido";
                    $isValid = false;
                }
            } else {
                //echo "Apellido es un campo requerido";
                $isValid = false;
            }

            // Validacion del email
            if (!empty($email)) {
                if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                    //echo "Formato invalido de correo";
                    $isValid = false;
                }
            } else {
                //echo "El correo es un campo requerido";
                $isValid = false;
            }

            // Validacion de la contraseña
            if (!empty($password)) {
                $special_chars = '~!@#%^&*()_-+={[}]|\:;"\'<,>.?/';
                $regex = '/^[a-zA-Z0-9' . preg_quote($special_chars, '/') . ']{4,20}$/';
                if (preg_match($regex, $password)) {
                    //echo "Valid password";
                } else {
                    //echo "Invalid password format";
                }
            } else {
                //echo "Password is a required field";
            }

            // Validacion de la cedula
            if (!empty($cedula)) {
                if (!preg_match("/^([VE]-)?\d{6,8}$/i", $cedula)) {
                    //echo "Formato invalido de cedula";
                    $isValid = false;
                }
            } else {
                //echo "La cedula es un campo requerido";
                $isValid = false;
            }
        }

        return $isValid;
    }

    function registroUsuario(){
        $formIsValid = validateForm();

        // Accediendo a las variables globales
        global $nombre, $apellido, $cedula, $email, $password, $pregunta, $respuesta, $tipoUsuario, $codigo;

        // Validando que el formulario sea correcto gracias a la funcion
        if (!$formIsValid) {
            echo "<script> alert('Los datos del formulario no son validos'); </script>";
            echo "<script> window.location='../../views/registros/register.php';</script>";
            exit;
        }
        
        // Si no se ha devuelto, hacemos el resto del codigo:

        // Incluir la conexion con la base de datos
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

        // Si el codigo no coincide, no procede
        if ($proceder == 0) {
            echo "<script> alert('Codigo invalido de seguridad');</script>";
            echo "<script>window.location='../../views/registros/register.php'</script>";
            exit;
        }

        $result2 = $con->query("insert into usuario
            (tipo_Usuario, Nombre, Apellido, Cedula, Email, Password, Pregunta, Respuesta)
            values
            ('$tipoUsuario','$nombre','$apellido','$cedula','$email',md5('$password'), '$pregunta', '$respuesta');");
            echo "<script> alert('agregado con exito');</script>";

    }

    function main(){
        registroUsuario();
    }

    main();
?>
<script>window.location="../../views/registros/login.php"</script>
