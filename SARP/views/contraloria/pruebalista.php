<label for="Proveedores">Lista de Proveedores</label>
<select name="Proveedores" id="Proveedores">

    <?php
    include("../../controllers/conexion.php");
    $proveedores= "SELECT ID_Usuario,Cedula FROM usuario WHERE tipo_Usuario = 3; ";
    $result= mysqli_query($con,$proveedores);
        while($valores = mysqli_fetch_array($result)){
            $id = $valores['ID_Usuario'];
            $cedula = $valores['Cedula'];
            echo "<option value=$id>$cedula</option>";
        }
    ?>
</select> 
