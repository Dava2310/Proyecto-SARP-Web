<?php
	$idSf = filter_input(INPUT_POST, 'se');

    $jsondata = array();
	
	if($idSf==""){
        $jsondata['eliminar'] = 0;
		
	}else{
		
		include("../../controllers/conexion.php");
		//devolver la cantidad solicitada a la planificacion al ser eliminada
		$resultctdad = $con->query("UPDATE solicitud_Proveedor, solicitud_fletero SET solicitud_proveedor.ID_Solicitud_Fletero= null WHERE solicitud_fletero.ID_Solicitud_Fletero=solicitud_proveedor.ID_Solicitud_Fletero AND solicitud_fletero.ID_Solicitud_Fletero = $idSf
		");

		
		
		//BORRAR
		$resultB = $con->query("DELETE from solicitud_fletero WHERE solicitud_fletero.ID_Solicitud_Fletero = $idSf");

        

		$jsondata['eliminar'] = 1;
		
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	}

	
?>