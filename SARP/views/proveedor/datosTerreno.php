<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Datos del Terreno";

    include('../templates/head.php');
    include("../../controllers/conexion.php");

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
    }

    $result = $con->query("select * from terrenos t inner join usuario u on t.ID_Usuario = u.ID_Usuario where  u.ID_Usuario= '$usuario';");
    $row = $result->fetch_object();
   if( $row -> ID_Terreno == NULL){

        echo "<script>window.alert('No posee terreno registrado');</script>";
        echo "<script> window.location='addTerreno.php'; </script>";

   }
    

    
?>
<body>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS DEL TERRENO -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo?></h1>
                            <img src="../../assets/images/terreno.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <!-- FORMULARIO DEL TERRENO-->
                        <form action="../../controllers/proveedor/ctrl_datosTerreno.php" method="POST">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="espacio">Tamaño en Hectáreas</label>
                                    <input value="<?=$row->Tamanio?>"class="form-control" type="text" name="espacio" id="espacio" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="ubicacion">Ubicación</label>
                                    <input value="<?=$row->Ubicacion?>" class="form-control" type="text" name="ubicacion" id="ubicacion" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            function activarCampos(){
                                var BotonCambiar = document.getElementById('botonCambiar');
                                if(document.getElementById('espacio').readOnly == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('espacio').readOnly=true;
                                    document.getElementById('ubicacion').readOnly=true;
                                  
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('espacio').readOnly=false;
                                    document.getElementById('ubicacion').readOnly=false;
                               
                                }
                                
                            }
                        </script>
    <?php
        include('../templates/footer.php');
    ?>