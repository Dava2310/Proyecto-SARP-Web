<?php
 include("../../controllers/conexion.php");
 $connection = Connection::getInstance();
 $con = $connection->getConnection(); 
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'IDS');


  
 $sql = "SELECT * FROM solicitud_proveedor INNER JOIN planificaciones on solicitud_proveedor.ID_Planificacion = planificaciones.ID_Planificacion where planificaciones.ID_Planificacion= $valor and solicitud_proveedor.Estado_Aprobacion=1 and solicitud_proveedor.ID_Solicitud_Fletero IS NULL
 ";
 $result= mysqli_query($con,$sql);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>
<option value="">- Seleccione Solicitud-</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['ID_Solicitud_Proveedor'] ?>"><?= "ID solicitud: ",$op['ID_Solicitud_Proveedor'] ," Cantidad MP: " ,$op['Cantidad_MP'] ?></option>
<?php endforeach; ?>