<?php
include("../../controllers/conexion.php");
$connection = Connection::getInstance();
$con = $connection->getConnection();
//el dato que enviamos a traves de ajax
$valor=$_POST['idso'];

//esta variable es para retornar los datos
$jsondata = array();

//la consulta que necesites para trer el codigo y el nombre del cliente
$usuario= "SELECT * FROM solicitud_proveedor INNER JOIN planificaciones on solicitud_proveedor.ID_Planificacion=planificaciones.ID_Planificacion WHERE ID_Solicitud_Proveedor = $valor;";
$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);

$Cantidad_MP=$resultados['Cantidad_MP'];
$Semana=$resultados['Semana'];
$ID_Siembra=$resultados['ID_Siembra'];
$Observaciones=$resultados['Observaciones'];


//agregamos nuestros datos al array para retornarlos
$jsondata['Cantidad_MP'] = $Cantidad_MP;
$jsondata['Semana'] = $Semana;
$jsondata['ID_Siembra'] = $ID_Siembra;
$jsondata['Observaciones'] = $Observaciones;
$jsondata['idsoli'] = $valor;



//este header es para el retorno correcto de datos con json
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);

?>