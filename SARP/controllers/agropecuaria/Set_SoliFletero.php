<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $idsoli = $_POST['solicitudes'] ?? "";
    $Placa=$_POST['camiones'] ?? "";
    $IDplani=$_POST['semana'] ?? "";
    

    

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        
        
        // se registran datos de solicitud fletero
        $resultC = $con->query("INSERT into solicitud_fletero
        (Placa, Estado_Aprobacion, ID_planificacion)
        values
        ('$Placa','0', '$IDplani');");
        
        // Obtener el último ID insertado
        $idFletero = $con -> insert_id;
        //se enlazan solicitud f con solicitud p
       $result = $con->query("UPDATE solicitud_proveedor SET  ID_Solicitud_Fletero= $idFletero WHERE ID_Solicitud_Proveedor = $idsoli;"); 
       
        
        
       echo json_encode("Solicitud Enviada");

        
    }
    
?>