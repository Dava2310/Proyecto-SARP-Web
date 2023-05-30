<?php
include("../../controllers/conexion.php");
$connection = Connection::getInstance();
$con = $connection->getConnection();
//el dato que enviamos a traves de ajax
$valor=$_POST['idso'];

//esta variable es para retornar los datos
$jsondata = array();

//la consulta que necesites para trer el codigo y el nombre del cliente
$usuario= ("SELECT
*
FROM
solicitud_proveedor
LEFT JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
INNER JOIN planificaciones ON solicitud_proveedor.ID_Planificacion = planificaciones.ID_Planificacion
LEFT JOIN camiones ON solicitud_fletero.Placa = camiones.Placa
LEFT JOIN usuario ON camiones.ID_Fleteros = usuario.ID_Usuario
WHERE
solicitud_proveedor.ID_Solicitud_Proveedor = $valor");

$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);

$Cantidad_MP=$resultados['Cantidad_MP'];
$Semana=$resultados['Semana'];
$ID_Siembra=$resultados['ID_Siembra'];
$Observaciones=$resultados['Observaciones'];
$fecha = $resultados['Dia'];
$Nombre_Fletero = $resultados["Nombre"]." ".$resultados["Apellido"];
$Cedula_Fletero = $resultados['Cedula'];
$Placa = $resultados['Placa'];


//agregamos nuestros datos al array para retornarlos
$jsondata['Cantidad_MP'] = $Cantidad_MP;
$jsondata['Semana'] = $Semana;
$jsondata['ID_Siembra'] = $ID_Siembra;
$jsondata['Observaciones'] = $Observaciones;
$jsondata['idsoli'] = $valor;
$jsondata['Dia']= $fecha;
$jsondata['Nombre'] = $Nombre_Fletero;  
$jsondata['Placa'] = $Placa; 
$jsondata['Cedula'] = $Cedula_Fletero; 



//este header es para el retorno correcto de datos con json
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);

?>