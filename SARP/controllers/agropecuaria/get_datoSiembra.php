<?php
include("../../controllers/conexion.php");
$connection = Connection::getInstance();
$con = $connection->getConnection();
//el dato que enviamos a traves de ajax
$valor=$_POST['idS'];

//esta variable es para retornar los datos
$jsondata = array();

//la consulta que necesites para trer el codigo y el nombre del cliente
$usuario= "SELECT * FROM siembras WHERE ID_Siembra = $valor; ";
$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);

$ID_Siembra=$resultados['ID_Siembra'];

$Kilos_Totales=$resultados['Saldo_Restante'];


//agregamos nuestros datos al array para retornarlos
$jsondata['ID_Siembra'] = $ID_Siembra;

$jsondata['Kilos_Totales'] = $Kilos_Totales;



//este header es para el retorno correcto de datos con json
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);

?>