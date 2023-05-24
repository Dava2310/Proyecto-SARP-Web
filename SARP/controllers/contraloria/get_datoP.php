<?php
    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
//el dato que enviamos a traves de ajax
$valor=$_POST['idP'];
 
//esta variable es para retornar los datos
$jsondata = array();
 
//la consulta que necesites para trer el codigo y el nombre del cliente
$usuario= "SELECT * FROM usuario WHERE Cedula = '$valor'; ";
$result= mysqli_query($con,$usuario);

$resultados= mysqli_fetch_array($result);
 
$nombre=$resultados['Nombre'];
$Apellido=$resultados['Apellido'];
$Cedula=$resultados['Cedula'];
$Email=$resultados['Email'];
$rif=$resultados['RIF'];
$direc=$resultados['Direccion'];
$tlf=$resultados['Telefono'];
$Banco=$resultados['Banco_P'];
$NroCuenta=$resultados['Cuenta_P'];
$tipoCta=$resultados['TipoCuenta_P'];
$nroctaA=$resultados['Cuenta_A'];
$bancoA=$resultados['Banco_A'];
$tipoCtaA=$resultados['TipoCuenta_A'];
$nombreA=$resultados['Nombre_A'];
$apellidoA=$resultados['Apellido_A'];

 
//agregamos nuestros datos al array para retornarlos
$jsondata['Nombre'] = $nombre;
$jsondata['Apellido'] = $Apellido;
$jsondata['Cedula'] = $Cedula;
$jsondata['Email'] = $Email;
$jsondata['RIF'] = $rif;
$jsondata['Direccion'] = $direc;
$jsondata['Telefono'] = $tlf;
$jsondata['Banco_P'] = $Banco;
$jsondata['Cuenta_P'] = $NroCuenta;
$jsondata['TipoCuenta_P'] = $tipoCta;
$jsondata['Cuenta_A'] = $nroctaA;
$jsondata['Banco_A'] = $bancoA;
$jsondata['TipoCuenta_A'] = $tipoCtaA;
$jsondata['Nombre_A'] = $nombreA;
$jsondata['Apellido_A'] = $apellidoA;

 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata);
 
?>