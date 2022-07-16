<?php
 include("../../controllers/conexion.php");
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'IDs');

 $query="SELECT * from usuario INNER JOIN siembras INNER JOIN solicitud_proveedor on usuario.ID_Usuario = siembras.ID_Proveedor AND siembras.ID_Siembra = solicitud_proveedor.ID_Siembra WHERE solicitud_proveedor.ID_Planificacion = $valor ";

 $result= mysqli_query($con,$query);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>
<option value="">- Seleccione Proveedor-</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['Cedula'] ?>"><?= $op['Cedula'] ?></option>
<?php endforeach; ?>