<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $IDsiembra=$_POST['IDLote'] ?? "";
    $solicitudMP=$_POST['SolicitudSiembraStda'] ?? "";
    $semana = $_POST['semana'];

    

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();    

        //obtener ID planificacion de la semana correspondiente
        $resultP = $con -> query("SELECT * from planificaciones where Semana = '$semana';");
        $row = $resultP -> fetch_object();
        $IDP = $row->ID_Planificacion;
        //OBTENER CANTIDAD TOTAL EN PLANIFICACION
        $ctdadP = $row -> Rango;

        // se registran datos de la fas 1 en planificaciones
        $resultC = $con->query("insert into solicitud_proveedor
        (ID_Siembra, Estado_Aprobacion, Cantidad_MP, ID_planificacion)
        values
        ('$IDsiembra',0,'$solicitudMP', '$IDP');");
       
        //restando los kilos solicitados en la siembra correspondiente
        $menosKilos = $con -> query("UPDATE siembras set Saldo_Restante  = Saldo_Restante - $solicitudMP, Kilos_Arrimados = Kilos_Arrimados + $solicitudMP where ID_Siembra = $IDsiembra ");

        $kilos_Restantes = $con -> query("SELECT Saldo_Restante from siembras where ID_Siembra = $IDsiembra");
        $rowKG =  $kilos_Restantes -> fetch_object();

        //restar la cantidad solicitada con la total en planificacion
        $nuevactdad = $ctdadP - $solicitudMP;

        //actualizar la materia prima en planificacion
        $sql = $con -> query("UPDATE planificaciones 
                            set Rango = '$nuevactdad'
                            where Semana = '$semana';");
       
        //esta variable es para retornar los datos
        $jsondata = array();
        
        $jsondata['nuevactdad'] = $nuevactdad;
        $jsondata['kilosRestantes'] = $rowKG -> Saldo_Restante ;
       echo json_encode($jsondata );

        
    }
    
?>