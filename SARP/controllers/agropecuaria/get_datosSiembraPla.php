<?php
 include("../../controllers/conexion.php");
 //el dato que enviamos a traves de ajax
 $valor= filter_input(INPUT_POST, 'ids');

  
 $sql = "SELECT * FROM solicitud_proveedor INNER JOIN planificaciones ON solicitud_proveedor.ID_Planificacion=planificaciones.ID_Planificacion WHERE planificaciones.Semana = '$valor'";
 $result= mysqli_query($con,$sql);
 $filas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
  mysqli_close($con);


 
?>