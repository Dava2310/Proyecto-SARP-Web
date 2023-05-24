<?php

    // Variables globales
    global $nombre;
    global $Apellido;
    global $Cedula;
    global $email;
    global $password;
    global $pregunta;
    global $respuesta;
    global $tipoUsuario;
    global $codigo;

    /**
     * Esta funcion devuelve un valor booleano verdado o falso
     * Determinando mediante RegEx (Regular Expressions)
     * Si los datos ingresados son validos o no
     */
    function validateForm(){

        // Accediendo a las variables globales
        global $nombre, $Apellido, $Cedula, $email, $password, $pregunta, $respuesta, $tipoUsuario, $codigo;

        // Variable que mantiene el estado de correccion del formulario
        $isValid = true;

        // Si se encuentra que hubo datos enviados via POST
        if (isset($_POST['submit'])) {


            error_log("Llego", 0  , "error.log");

            // Se le ingresa a las variables globales, los valores del Formulario
            // En caso de que no encuentre alguna variable
            // Le asignara un valor vacio ""
            $nombre = $_POST['nombre'] ?? "";
            $Apellido = $_POST['Apellido'] ?? "";
            $Cedula = $_POST['Cedula'] ?? "";
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

            // Validacion del Apellido
            if (!empty($Apellido)) {
                if (!preg_match("/^[a-zA-Z ]{4,20}$/", $Apellido)) {
                    //echo "Formato de Apellido invalido";
                    $isValid = false;
                }
            } else {
                //echo "Apellido es un campo requerido";
                $isValid = false;
            }

            // Validacion del email
            if (!empty($email)) {
                if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                    //echo "Formato invalido de Email";
                    $isValid = false;
                }
            } else {
                //echo "El Email es un campo requerido";
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

            // Validacion de la Cedula
            if (!empty($Cedula)) {
                if (!preg_match("/^([VE]-)?\d{6,8}$/i", $Cedula)) {
                    //echo "Formato invalido de Cedula";
                    $isValid = false;
                }
            } else {
                //echo "La Cedula es un campo requerido";
                $isValid = false;
            }
        }

        return $isValid;
    }
    // valida si la Cedula y el Email registrado ya existen
    function validaExistencia($con, $email, $Cedula){
        // Variable que mantiene el estado de correccion del formulario
        $isValid = true;
        // Query buscando al usuario
        $stmt = $con->prepare("SELECT * FROM usuario WHERE Email = ? or Cedula = ?  LIMIT 1"); 
        $stmt->bind_param("ss", $email, $Cedula);
        $stmt->execute();
        // Recogiendo los resultados de la query
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Si hay alguien igual, no es valido
        if (($row)) {
            $isValid = false;
        }

        return $isValid;
    }

    /**
     * Esta funcion busca cambiar los codigos despues de que alguien se haya registrado
     * Y hayan pasado +24 horas antes del ultimo usuario antes de el
     */
    function cambiarCodigos($con){

        // Se manda a ejecutar una sentencia para seleccionar la fecha de la ultima actualizacion de codigos
        $query5 = "SELECT ultima_actualizacion FROM codigo ORDER BY idCodigos DESC LIMIT 1";
        $stmt5 = $con->prepare($query5);
        $stmt5->execute();

        // Si sucede un error
        if(!($stmt5->errno === 0)){
            echo json_encode("Error al buscar la ultima actualizacion de la tabla de codigos: ".$stmt5->error);
            //echo "<script>window.location='../../views/registros/register.php'</script>";
            exit;
        }

        // En caso de que no de error la ejecucion, se recogen los datos
        $result5 = $stmt5->get_result();
        $row5 = $result5->fetch_assoc();

        // Guardamos la hora actual del sistema
        $hora_actual = time();

        // Verificamos si han pasado 24 horas desde la ultima vez
        if($hora_actual - strtotime($row5['ultima_actualizacion']) > 86400) {

            // Generamos nuevos codigos de seguridad
            $code1 = rand(1000, 9999);
            $code2 = rand(1000, 9999);
            $code3 = rand(1000, 9999);
            $code4 = rand(1000, 9999);

            // Actualizamos los codigos en la base de datos
            $query2 = "UPDATE codigo SET codigoProveedor = ?, codigoFletero = ?, codigoAgropecuaria = ?, codigoContraloria = ?, ultima_actualizacion = ? WHERE idCodigos = 1";
            $stmt2 = $con->prepare($query2);
            $stmt2->bind_param("iiiii", $code1, $code2, $code3, $code4, $hora_actual);
            $stmt2->execute();

            if ($stmt2->errno === 0) {
                /* echo "Security codes have been updated in the database."; */
                //----proceso exitoso, envia el mensaje directamente de "agregado con exito" ubicado enlas funcion registroUsuario()-----
            } else {
                echo json_encode("Error al intentar actualizar los codigos: " . $stmt2->error);
            }
            
        } else {
            echo json_encode("Security codes have not been updated yet.");
        }
    }

    function registroUsuario(){
        $formIsValid = validateForm();

        // Accediendo a las variables globales
            $nombre = $_POST['nombre'] ?? "";
            $Apellido = $_POST['Apellido'] ?? "";
            $Cedula = $_POST['Cedula'] ?? "";
            $email = $_POST['email'] ?? "";
            $password = $_POST['password'] ?? "";
            $pregunta = $_POST['question'] ?? "";
            $respuesta = $_POST['answer'] ?? "";
            $tipoUsuario = $_POST['tipoUsuario'] ?? "";
            $codigo = $_POST['codigo'] ?? "";

        // Validando que el formulario sea correcto gracias a la funcion
        if (!$formIsValid) {
            echo "<script> alert('Los datos del formulario no son validos'); </script>";
            //echo "<script> window.location='../../views/registros/register.php';</script>";
            exit;
        }
        
        // Si no se ha devuelto, hacemos el resto del codigo:

        // Incluir la conexion con la base de datos
        include("../conexion.php");
        $connection = Connection::getInstance();
        $con = $connection->getConnection();

        //se valida la existencia del usuariuo registrado
        $formIsValid = validaExistencia($con, $email, $Cedula);
        //si existe se temina el proceso
        if (!$formIsValid) {
            echo json_encode('La Cedula o el Email ya existen');
            //echo "<script> window.location='../../views/registros/register.php';</script>";
            exit;
        }
        //Para hacer la validacion de la pregunta, tenemos que verificar
        //Que corresponda el tipo de usuario con ese codigo de seguridad

        $query3 = "SELECT * FROM codigo ORDER BY idCodigos DESC LIMIT 1";
        $stmt3 = $con->prepare($query3);

        if (!$stmt3->execute()) {
            echo "<script> alert('Error al buscar la informacion de los codigos);</script>";
            //echo "<script>window.location='../../views/registros/register.php'</script>";
            exit;
        }

        $result3 = $stmt3->get_result();
        $row3 = $result3->fetch_assoc();

        $proceder = 0;

        switch($tipoUsuario){
            case 1:
                if($codigo == $row3['codigoContraloria']){
                    
                    $proceder = 1;
                }
                break;
            case 2:
                if($codigo == $row3['codigoAgropecuaria']){
                    $proceder = 1;
                }
                break;
            case 3:
                if($codigo == $row3['codigoProveedor']){
                    $proceder = 1;
                }
                break;
            case 4:
                if($codigo == $row3['codigoFletero']){
                    $proceder = 1;
                }
                break;
        }

        // Si el codigo no coincide, no procede
        if ($proceder == 0) {
            //se codifica el ECHO ya que va a ser la respuesta que se envia al fetch
            echo json_encode("codigo no coincide");
            /* echo "<script> alert('Codigo invalido de seguridad');</script>"; */
            //echo "<script>window.location='../../views/registros/register.php'</script>";
            exit;
        }

        // Proceso de registro de usuario con mySQL
        // Usando prepared statements como medida de seguridad
        $stmt = $con->prepare("INSERT INTO usuario (tipo_Usuario, Nombre, Apellido, Cedula, Email, Password, Pregunta, Respuesta) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $password_md5 = md5($password);
        $stmt->bind_param("isssssss", $tipoUsuario, $nombre, $Apellido, $Cedula, $email, $password_md5, $pregunta, $respuesta);

        if (!$stmt->execute()) {
            //se codifica el ECHO ya que va a ser la respuesta que se envia al fetch
            echo json_encode("Error al agregar");
            exit;
        }

        // Unicamente en la seccion donde si se ejecuto el registro de usuario
        cambiarCodigos($con);
        //se codifica el ECHO ya que va a ser la respuesta que se envia al fetch
        echo json_encode("agregado con exito");
        exit;
        /* echo "<script> alert('agregado con exito');</script>"; */
        
        // Despues de que se haya logrado agregar con exito un usuario
        // Mandamos a revisar si se tienen que cambiar los codigos
        // Y hacerlo en casod e que sea necesario
        /* cambiarCodigos($con); */

    }

    function main(){
        registroUsuario();
    }

    main();
?>
<!-- <script>window.location="../../views/registros/login.php"</script> -->
