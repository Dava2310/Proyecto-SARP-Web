<?php
  include("../../controllers/conexion.php");
  $connection = Connection::getInstance();
  $con = $connection->getConnection();
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'idP');

 $query="SELECT * from camiones INNER JOIN usuario on camiones.ID_Fleteros = usuario.ID_Usuario WHERE Cedula = '$valor'";
 
  

 $result= mysqli_query($con,$query);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>
<datalist id="camiones" >
<option value="">- Seleccione Camion-</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['Placa'] ?>"><?= $op['Modelo'] ?></option>
<?php endforeach; ?>
</datalist>