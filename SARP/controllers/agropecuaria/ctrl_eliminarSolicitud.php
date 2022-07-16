<?php
	$idSP = filter_input(INPUT_POST, 'se');

    $jsondata = array();
	
	if($idSP==""){
        $jsondata['eliminar'] = 0;
		
	}else{
		
		include("../../controllers/conexion.php");
		//devolver la cantidad solicitada a la planificacion al ser eliminada
		$resultctdad = $con->query("UPDATE planificaciones, solicitud_proveedor SET planificaciones.Rango = planificaciones.Rango + solicitud_proveedor.Cantidad_MP WHERE planificaciones.ID_Planificacion=solicitud_proveedor.ID_Planificacion AND solicitud_proveedor.ID_Solicitud_Proveedor = $idSP");

		$sql= $con ->query("SELECT Rango from planificaciones p INNER JOIN solicitud_proveedor sp on sp.ID_Planificacion=p.ID_Planificacion WHERE sp.ID_Solicitud_Proveedor = $idSP;");
		

		$resultados= mysqli_fetch_array($sql);
		$Rango=$resultados['Rango'];
		
		//BORRAR
		$resultB = $con->query("delete from solicitud_proveedor where ID_Solicitud_Proveedor=$idSP;");

        $jsondata['Rango'] = $Rango;

		
		
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	}

	
?>