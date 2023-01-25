<?php
    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    //el dato que enviamos a traves de ajax
    $valor=$_POST['idC'];

    //esta variable es para retornar los datos
    $jsondata = array();

    //la consulta que necesites para trer datos del camion del fletero
    $usuario= "SELECT * FROM camiones WHERE Placa = '$valor'; ";
    $result= mysqli_query($con,$usuario);
    $resultados= mysqli_fetch_array($result);



    //guardar datos camion

    $Placa=$resultados['Placa'];
    $Modelo=$resultados['Modelo'];
    $Capacidad=$resultados['Capacidad'];
    $ID_Fleteros=$resultados['ID_Fleteros'];





    //agregamos nuestros datos al array para retornarlos
    $jsondata['Placa'] = $Placa;
    $jsondata['Modelo'] = $Modelo;
    $jsondata['Capacidad'] = $Capacidad;
    $jsondata['ID_Fleteros'] = $ID_Fleteros;





    //este header es para el retorno correcto de datos con json
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);

?>