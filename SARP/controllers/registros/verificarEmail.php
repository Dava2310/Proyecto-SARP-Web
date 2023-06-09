<?php

    $email = $_POST['email'] ?? "";

    if($email == ""){
        echo json_encode('No me indicaron los datos del usuario');
    } else {
        include("../conexion.php");
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        // Se hace primero la validacion que se encuentre
        // Un usuario con todos los datos excepto la password
        $result1 = $con->query("select * from usuario
        where Email='$email';");

        //validando que se encuentre el usuario
        if(!($row = $result1->fetch_object())){
            //Si no se encuentra
            $response = array(
                'message' => 'No se ha encontrado el usuario con estos datos',
                'id' => ""
            );
            
            echo json_encode($response);
        } else {
            // Si se encuentra
            // Se captura el ID del usuario encontrado
            $id = $row->Email;
            $pregunta = $row->Pregunta;

            // Crear un array asociativo con el mensaje y el ID
            $response = array(
                'message' => 'Contraseña recuperada con éxito.',
                'id' => $id,
                'pregunta' => $pregunta
            );

            // Convertir el array a JSON y enviarlo como respuesta
            echo json_encode($response);
        }
    }
?>
