<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $Finicio = $_POST['fecha_inicio'] ?? "";
    $kilosT = $_POST['kilos_totales'] ?? "";
    $variedad = $_POST['variedad'] ?? "";
    $Fcosecha = $_POST['fecha_cosecha'] ?? "";
    $rendimiento = $_POST['rendimiento'] ?? "";
    $hectareas = $_POST['hectareas'] ?? "";

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    } else {
        include('../conexion.php');
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        //se obtienen id del usuario y terreno de la tabla "terrenos"
        $result = $con->query("select * from terrenos t inner join usuario u on t.ID_Usuario = u.ID_Usuario where  u.ID_Usuario= '$usuario';");
        $row = $result->fetch_object();
        $IDproveedor = $row -> ID_Usuario;
        $IDTerreno = $row -> ID_Terreno;
        
        if($IDTerreno == NULL){
            echo json_encode('No tiene terreno registrado');
        }else {
            $result2 = $con->query("insert into siembras
            (ID_Terreno, ID_Proveedor, Fecha_Inicio, Variedad, Fecha_Cosecha, Hectareas, Kilos_Totales, Kilos_Arrimados, Saldo_Restante)
            values
            ('$IDTerreno','$IDproveedor','$Finicio','$variedad','$Fcosecha','$hectareas', '$kilosT', '0','$kilosT');");
            echo json_encode("agregado con exito");    
        }
    }
?>