<?php
	$idSiembra = $_POST ['idS'] ;
	
	if($idSiembra==""){
		echo "<script> alert(' id de la siembra a eliminar no indicada'); </script>";
        echo "<script> window.location='../../views/proveedor/consultarSiembra.php'; </script>";
	}else{
		
		include("../../controllers/conexion.php");
		$connection = Connection::getInstance();
        $con = $connection->getConnection();
		
		$result = $con->query("delete from siembras where ID_Siembra='$idSiembra';");
		echo json_encode('eliminado con exito'); 
       
        
		
	}
?>