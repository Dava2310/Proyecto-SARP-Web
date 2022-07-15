<?php
 include("../../controllers/conexion.php");
//el dato que enviamos a traves de ajax
$valor=$_POST['IDs'];
 
//esta variable es para retornar los datos
$jsondata = array();
 
//la consulta que necesites para trer datos del camion del fletero
$usuario= "SELECT Cantidad_MP from solicitud_proveedor where ID_Siembra = $valor";
$result= mysqli_query($con,$usuario);

$ctdadTotal = 0;
while($resultados= mysqli_fetch_array($result)){
    $ctdadTotal = $ctdadTotal + $resultados['Cantidad_MP'];
}


 
$jsondata['totalsolicitud'] = $ctdadTotal;





 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata);
 
?>