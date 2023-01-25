<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $IDsiembra=$_POST['IDLote'] ?? "";
    $solicitudMP=$_POST['SolicitudSiembraStda'] ?? "";
    $IDP = $_POST['semana'];

    

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();

        //obtener ID planificacion de la semana correspondiente
        $resultP = $con -> query("SELECT * from planificaciones where Semana = '$IDP';");
        $row = $resultP -> fetch_object();
        $IDP = $row->ID_Planificacion;
        //OBTENER CANTIDAD TOTAL EN PLANIFICACION
        $ctdadP = $row -> Rango;

        // se registran datos de la fas 1 en planificaciones
        $resultC = $con->query("insert into solicitud_proveedor
        (ID_Siembra, Estado_Aprobacion, Cantidad_MP, ID_planificacion)
        values
        ('$IDsiembra',0,'$solicitudMP', '$IDP');");
        // registro de chofer 1

        //restar la cantidad solicitada con la total en planificacion
        $nuevactdad = $ctdadP - $solicitudMP;

        //actualizar la materia prima en planificacion
        $sql = $con -> query("UPDATE planificaciones 
                            set Rango = '$nuevactdad'
                            where Semana = '$semana';");
       
        
        
       echo json_encode($semana);

        
    }
    
?>