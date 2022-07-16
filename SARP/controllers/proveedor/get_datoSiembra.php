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
$Kilos_Totales=$resultados['Kilos_Totales'];
$Kilos_Arrimados=$resultados['Kilos_Arrimados'];
$Saldo_Restante=$resultados['Saldo_Restante'];
$Analisis=$resultados['Analisis'];
$MateriaSeca=$resultados['MateriaSeca'];
$Impureza=$resultados['Impureza'];
$KilosMuestra=$resultados['KilosMuestra'];

//agregamos nuestros datos al array para retornarlos
$jsondata['ID_Siembra'] = $ID_Siembra;
$jsondata['ID_Terreno'] = $ID_Terreno;
$jsondata['ID_Proveedor'] = $ID_Proveedor;
$jsondata['Fecha_Inicio'] = $Fecha_Inicio;
$jsondata['Variedad'] =$Variedad;
$jsondata['Fecha_Cosecha'] = $Fecha_Cosecha;
$jsondata['Hectareas'] = $Hectareas;
$jsondata['Kilos_Totales'] = $Kilos_Totales;
$jsondata['Kilos_Arrimados'] = $Kilos_Arrimados;
$jsondata['Saldo_Restante'] = $Saldo_Restante;
$jsondata['Analisis'] = $Analisis;
$jsondata['MateriaSeca'] = $MateriaSeca;
$jsondata['Impureza'] = $Impureza;
$jsondata['KilosMuestra'] = $KilosMuestra;



//este header es para el retorno correcto de datos con json
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);

?>