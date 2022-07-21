<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $Flete=$_POST['TotalFL'] ?? "";
    $MP=$_POST['TotalMP'] ?? "";
    $CA=$_POST['TotalCA'] ?? "";
    $IDsol = $_POST['idsoli'] ?? "";

    

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        
     
            echo "ok";
            $resultP = $con->query("insert into tarifas
            (Pago_Flete, Pago_MP, Pago_Cuadrilla,ID_Solicitud_Proveedor)
            values
            ('$Flete','$MP','$CA','$IDsol');");
            

        
            $enlaze = $con->query("INSERT into odp_proveedor
            (ID_Contralor, Estado_Pago, ID_Solicitud)
            values
            ('$usuario','0','$IDsol');");

            $IDSS = $con -> query("SELECT ID_Solicitud_Fletero from solicitud_proveedor where ID_Solicitud_Proveedor = $IDsol");
            
            $resultados= mysqli_fetch_array($IDSS);

            $IDsF = $resultados['ID_Solicitud_Fletero'];

            $enlaze2 = $con->query("INSERT into odp_fletero
            (ID_Contralor, Estado_Pago, ID_Solicitud)
            values
            ('$usuario','0','$IDsF');");
       
        
            
        
        
        
    }
?>