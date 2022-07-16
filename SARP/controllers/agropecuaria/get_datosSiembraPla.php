<?php
 include("../../controllers/conexion.php");
 //el dato que enviamos a traves de ajax
 $valor= $_POST['IDPL'];

 $jsondata= array(); 

 $sql = $con->query("SELECT Rango from planificaciones where ID_Planificacion = '$valor'");
 $resultados= mysqli_fetch_array($sql);
	$Rango=$resultados['Rango'];


  $jsondata['Rango'] = $Rango;

 //este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata);
 
?>