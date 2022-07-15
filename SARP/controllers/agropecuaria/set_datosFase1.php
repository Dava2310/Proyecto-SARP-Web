<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $semana=$_POST['semana'] ?? "";
    $cantidad=$_POST['cantidad'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        // se registran datos de la fas 1 en planificaciones
        $resultC = $con->query("insert into planificaciones
        (Semana, Rango)
        values
        ('$semana','$cantidad');");
        // registro de chofer 1
        


        

        echo "<script>window.alert('Se ha registrado con exito');</script>";
        

        
    }
?>