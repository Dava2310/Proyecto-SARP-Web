<?php
 include("../../controllers/conexion.php");
 $connection = Connection::getInstance();
 $con = $connection->getConnection(); 
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'sema');

  
 $sql = "SELECT * FROM solicitud_proveedor INNER JOIN planificaciones ON solicitud_proveedor.ID_Planificacion=planificaciones.ID_Planificacion WHERE planificaciones.Semana = '$valor'";
 $result= mysqli_query($con,$sql);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>
<option value="">- Seleccione Siembra-</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['ID_Solicitud_Proveedor'] ?>"><?= "ID:",$op['ID_Siembra']," -> ","Solicitud:",$op['Cantidad_MP']?></option>
<?php endforeach; ?>