<?php
 include("../../controllers/conexion.php");
//el dato que enviamos a traves de ajax
$valor=$_POST['idS'];
 
//esta variable es para retornar los datos
$jsondata = array();
 
//la consulta que necesites para trer el codigo y el nombre del cliente
$usuario= "SELECT * FROM siembras WHERE ID_Siembra = $valor; ";
$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);
 
$ID_Siembra=$resultados['ID_Siembra'];
$ID_Terreno=$resultados['ID_Terreno'];
$ID_Proveedor=$resultados['ID_Proveedor'];
$Fecha_Inicio=$resultados['Fecha_Inicio'];
$Variedad=$resultados['Variedad'];
$Fecha_Cosecha=$resultados['Fecha_Cosecha'];
$Hectareas=$resultados['Hectareas'];
$Rendimiento=$resultados['Rendimiento'];
$Kilos_Totales=$resultados['Kilos_Totales'];


 
//agregamos nuestros datos al array para retornarlos
$jsondata['ID_Siembra'] = $ID_Siembra;
$jsondata['ID_Terreno'] = $ID_Terreno;
$jsondata['ID_Proveedor'] = $ID_Proveedor;
$jsondata['Fecha_Inicio'] = $Fecha_Inicio;
$jsondata['Variedad'] =$Variedad;
$jsondata['Fecha_Cosecha'] = $Fecha_Cosecha;
$jsondata['Hectareas'] = $Hectareas;
$jsondata['Rendimiento'] = $Rendimiento;
$jsondata['Kilos_Totales'] = $Kilos_Totales;


 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata);
 
?>