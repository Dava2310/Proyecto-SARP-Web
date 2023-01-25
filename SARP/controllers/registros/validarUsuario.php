<?php

    session_start();
    
    // Variables globales
    global $email;
    global $password;
    global $cargo;

    /**
     * Esta funcion devuelve un valor booleano verdado o falso
     * Determinando mediante RegEx (Regular Expressions)
     * Si los datos ingresados son validos o no
     */
    function validateForm(){
        
        // Accediendo a las variables globales
        global $email, $password, $cargo;

        // Variable que mantiene el estado de correccion del formulario
        $isValid = true;

        error_log("Empezara validacion", 0  , "error.log");

        // Si no se encuentra que hubo datos enviados via POST
        if (!(isset($_POST['submit']))) {

            $isValid = false;
            echo "No se encontraron datos via POST";
            exit;
        }

        // Se le ingresa a las variables globales, los valores del Formulario
        // En caso de que no encuentre alguna variable
        // Le asignara un valor vacio ""
        $email = $_POST['email'] ?? "";
        $password = $_POST['password'] ?? "";
        $cargo = $_POST['tipoUsuario'] ?? "";
        
        // ============ Validaciones ============= \\

        // Validacion del email
        if (!empty($email)) {
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                echo "Formato invalido de correo";
                $isValid = false;
            }
        } else {
            echo "El correo es un campo requerido";
            $isValid = false;
        }

        // Validacion de la contraseña
        if (!empty($password)) {
            $special_chars = '~!@#%^&*()_-+={[}]|\:;"\'<,>.?/';
            $regex = '/^[a-zA-Z0-9' . preg_quote($special_chars, '/') . ']{4,20}$/';
            if (preg_match($regex, $password)) {
                // echo "Valid password";
            } else {
                echo "Invalid password format";
                $isValid = false;
            }
        } else {
            echo "Password is a required field";
            $isValid = false;
        }

        return $isValid;
    }
    
    function inicioSesion(){

        $formIsValid = validateForm();

        // Accediendo a la variables globales
        global $email, $password, $cargo;

        // Validando que el formulario sea valido
        if (!$formIsValid) {
            echo "<script> alert('Los datos del formulario no son validos'); </script>";
            session_destroy();
            echo "<script> window.location='../../views/registros/register.php';</script>";
            exit;
        }

        error_log("Formulario correcto", 0  , "error.log");
        // ======== Resto del Inicio de Sesion ======= \\
        /*
            PROCESO DE VALIDACION:
            Una query en MySQL que valide todos los 3 datos al mismo tiempo
            Y que la password sea encriptada al momento de pasar la comparacion
        */ 

        // Incluir la conexion con la base de datos
        include("../conexion.php");
        $connection = Connection::getInstance();
        $con = $connection->getConnection();

        // Query buscando al usuario
        $stmt = $con->prepare("SELECT * FROM usuario WHERE tipo_usuario = ? and Email = ? and Password = ? LIMIT 1"); 
        $password_md5 = md5($password);
        $stmt->bind_param("iss", $cargo, $email, $password_md5);
        
        // Si da error la ejecucion
        if (!$stmt->execute()){
            echo "<script> alert('Error al validar usuario');</script>";
            session_destroy();
            echo "<script>window.location='../../views/registros/login.php';</script>";
            exit;
        }

        // Recogiendo los resultados de la query
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Si no hay nadie
        if (!($row)) {
            echo "<script>window.alert('No se ha encontrado el usuario con estos datos');</script>";
            echo "<script>window.location='../../views/registros/login.php';</script>";
            session_destroy();
            exit;
        }

        // Se le agrega la sesion, el ID del usuario
        $_SESSION['ID'] = $row['ID_Usuario'];
        $usuario = $_SESSION['ID'];
        error_log("Valor de la sesion: $usuario", 0  , "error.log");

        //Si se encontró al usuario, se le dirige a la página que le corresponde
        echo "<script>window.alert('Encontrado con exito, bienvenido: $row['Nombre'] $row->['Apellido'] ');</script>";
        
        switch($cargo){
        case 1:
            // header("location: ../../views/contraloria/datosPersonales.php");
            
            echo "<script> window.location='../../views/contraloria/datosPersonales.php; </script>";
            break;
        case 2:
            header("location: ../../views/agropecuaria/datosPersonales.php");
            
            // echo "<script> window.location='../../views/agropecuaria/datosPersonales.php; </script>";
            break;
        case 3:
            error_log("Llego como deberia", 0  , "error.log");
            header("location: ../../views/proveedor/datosPersonales.php");
            
            // echo "<script> window.location='../../views/proveedor/datosPersonales.php;</script>";
            break;
        case 4:
            header("location: ../../views/fletero/datosPersonales.php ");
            
            // echo "<script> window.location='../../views/fletero/datosPersonales.php; </script>";
            break;
        default:
            session_destroy();
            echo "<script> window.location='../../views/registros/register.html'; </script>";
            echo "<script> window.alert('No se ha logrado identificar el tipo de Usuario Ingresado');</script>";           
        }

    }

    // Function main
    function main(){
        inicioSesion();
    }

    main();
?>