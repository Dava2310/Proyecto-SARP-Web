<?php
  include("../../controllers/conexion.php");
  $connection = Connection::getInstance();
  $con = $connection->getConnection();
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'IDP');

 $query="SELECT * FROM usuario WHERE Cedula = $valor; ";
 $resultID= mysqli_query($con,$query);
 $resultados= mysqli_fetch_array($resultID);

 $id = $resultados['ID_Usuario'];
 

  
 $sql = "SELECT * FROM siembras WHERE ID_Proveedor = $id and Analisis = 'APROBADO'; ";
 $result= mysqli_query($con,$sql);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>
<option value="">- Seleccione Siembra-</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['ID_Siembra'] ?>"><?= $op['ID_Siembra'] ?></option>
<?php endforeach; ?>