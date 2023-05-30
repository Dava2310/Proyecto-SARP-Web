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
   

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        
        $buscarCedula = $con->prepare("SELECT (COUNT(*) > 0) AS existe_cedula
        FROM choferes
        WHERE LOWER(Cedula) = LOWER(?);");

        $buscarCedula->bind_param("s", $Cedula);
       
        $buscarCedula->execute();

        $resultado = $buscarCedula->get_result();
        $existeCedula = $resultado->fetch_assoc()['existe_cedula'];

        

        if($existeCedula){
            echo json_encode('Error');
        }else{
            $resultC = $con->query("insert into choferes
            (Cedula, Nombre, Apellido, ID_Fleteros)
            values
            ('$Cedula','$nombre','$Apellido', '$usuario');");
            echo json_encode("agregado con exito");
            
        }
        $buscarCedula->close();
      
        


        

        

        
    }
?>