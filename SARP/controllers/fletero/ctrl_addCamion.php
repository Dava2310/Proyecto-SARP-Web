<?php
    session_start();
    $usuario = $_SESSION['ID'];
    //--------DATOS DEL CAMION----------
    $placa = $_POST['Placa'] ?? "";
    $modelo = $_POST['Modelo'] ?? "";
    $capacidad = $_POST['Capacidad'] ?? "";
    //----------DATOS DEL CHOFER-----------
    $Cedula = $_POST['Cedula'] ?? "";
    $nombre = $_POST['Nombre'] ?? "";
    $Apellido = $_POST['Apellido'] ?? "";
    //----------DATOS DEL CHOFER 2-----------
    $cedula2 = $_POST['CI2'] ?? "";
    $nombre2 = $_POST['Nombre2'] ?? "";
    $apellido2 = $_POST['Apellido2'] ?? "";


    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();

        //verificar que la placa no existe
        $buscarPlaca = $con->prepare("SELECT (COUNT(*) > 0) AS existe_valor
        FROM camiones
        WHERE LOWER(Placa) = LOWER(?);");

        $buscarPlaca->bind_param("s", $placa);
       
        $buscarPlaca->execute();

        $resultado = $buscarPlaca->get_result();
        $existePlaca = $resultado->fetch_assoc()['existe_valor'];

        

        if(!($existePlaca)){
            $resultC = $con->query("insert into camiones
            (Placa, Modelo, Capacidad, ID_Fleteros)
            values
            ('$placa','$modelo','$capacidad','$usuario');");
            echo json_encode('agregado con exito');
        }else{
            echo json_encode('Error');
        }
        // se registran datos del camion

        
        

      /*   //enlace chofer camion 1
        $resultCyC = $con->query("insert into camion_chofer
        (ID_Camion, ID_chofer)
        values
        ('$placa','$Cedula');");

        //enlace chofer camion 2
        $resultCyC2 = $con->query("insert into camion_chofer
        (ID_Camion, ID_chofer)
        values
        ('$placa','$cedula2');");
 */

        

        
        
        
    }
?>