<?php
 include("../../controllers/conexion.php");
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'placa');
  
 $sql = "SELECT * FROM camion_chofer WHERE ID_Camion = '$valor'; ";
 $result= mysqli_query($con,$sql);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>
<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['ID_Chofer'] ?>"><?= $op['ID_Chofer'] ?></option>
<?php endforeach; ?>