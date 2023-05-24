<?php

    $idSiembra = $_POST['idLote'] ?? "";
    $analisis = $_POST['analisis'] ?? "";
    $materiaS = $_POST['ms'] ?? "";
    $impureza = $_POST['impureza'] ?? "";
    $kilos = $_POST['kilos'] ?? "";

    if($idSiembra == ""){
        echo "<script> alert('No me indicaron los datos de la siembra'); </script>";
        echo "<script> window.location('../../views/agropecuaria/datosSiembras.php');</script>";
    } else {
        include("../conexion.php");
        $connection = Connection::getInstance();
        $con = $connection->getConnection();
        
        $result = $con->query("update siembras set
        Analisis = '$analisis', MateriaSeca = '$materiaS',
        Impureza = '$impureza', KilosMuestra = '$kilos'
        where ID_Siembra = '$idSiembra';");

        echo json_encode("agregado con exito");
    }
?>

