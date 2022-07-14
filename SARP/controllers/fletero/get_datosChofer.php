<?php
 include("../../controllers/conexion.php");
//el dato que enviamos a traves de ajax
$valor=$_POST['idCh'];
 
//esta variable es para retornar los datos
$jsondata = array();
 
//la consulta que necesites para trer datos del camion del fletero
$usuario= "SELECT * FROM choferes WHERE Cedula = $valor; ";
$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);



//guardar datos camion
 
$Cedula=$resultados['Cedula'];
$Nombre=$resultados['Nombre'];
$Apellido=$resultados['Apellido'];

//agregamos nuestros datos al array para retornarlos
$jsondata['Cedula'] =$Cedula;
$jsondata['Nombre'] = $Nombre;
$jsondata['Apellido'] = $Apellido;



 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata);
 
?>