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

        

        // se registran datos de solicitud fletero
        $resultC = $con->query("INSERT into solicitud_fletero
        (Placa, Estado_Aprobacion, ID_planificacion)
        values
        ('$Placa','0', '$IDplani');");
        

        //se enlazan solicitud f con solicitud p
       $result = $con->query("UPDATE solicitud_proveedor, solicitud_fletero set solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero 
       where solicitud_proveedor.ID_Planificacion = solicitud_fletero.ID_Planificacion 
       AND solicitud_fletero.ID_Planificacion = $IDplani and solicitud_proveedor.ID_Solicitud_Proveedor = $idsoli;");
       
        
        
       echo json_encode("Solicitud Enviada");

        
    }
    
?>