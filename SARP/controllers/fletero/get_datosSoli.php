<?php
include("../../controllers/conexion.php");
//el dato que enviamos a traves de ajax
$valor=$_POST['idso'];

//esta variable es para retornar los datos
$jsondata = array();

//la consulta que necesites para trer el codigo y el nombre del cliente
$usuario= "SELECT
*
FROM
solicitud_proveedor
INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
INNER JOIN planificaciones ON solicitud_proveedor.ID_Planificacion = planificaciones.ID_Planificacion
WHERE
solicitud_fletero.ID_Solicitud_Fletero = $valor;";
$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);

$Cantidad_MP=$resultados['Cantidad_MP'];
$Semana=$resultados['Semana'];
$Dia=$resultados['Dia'];
$Camion=$resultados['Placa'];
$Chofer = $resultados['ID_chofer'];
$obser = $resultados['Observaciones'];



//agregamos nuestros datos al array para retornarlos
$jsondata['Cantidad_MP'] = $Cantidad_MP;
$jsondata['Semana'] = $Semana;
$jsondata['Camion'] = $Camion;
$jsondata['Dia'] = $Dia;
$jsondata['Chofer'] = $Chofer;
$jsondata['Obser'] = $obser;


$jsondata['idsoli'] = $valor;



//este header es para el retorno correcto de datos con json
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);

?>