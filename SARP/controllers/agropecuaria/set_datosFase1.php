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
        
        $aceptar = true;
        $sql= "SELECT * FROM planificaciones; ";
        $result= mysqli_query($con,$sql);
        $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
        

        foreach($filas as $op):
            
            if($semana === $op['Semana']){
                $aceptar = false;

            }else{
                $aceptar = true;
            }

        endforeach;

        
       /*  do{
            $semSQL = $valores['Semana'];
            if($semana === $semSQL){
                $aceptar = false;

            }else{
                $aceptar = true;
            }
            
            
        }while($valores = mysqli_fetch_array($result)); */
       
        

        if($aceptar === true){
            // se registran datos de la fas 1 en planificaciones
            echo "ok";
            $resultP = $con->query("insert into planificaciones
            (Semana, Rango)
            values
            ('$semana','$cantidad');");
            

        }else{
            echo "no";

        }

       
        
            
        
            

        
        
    }
?>