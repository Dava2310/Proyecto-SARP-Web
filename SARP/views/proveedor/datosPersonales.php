<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Datos Personales!";
    include('../templates/head.php');
    
    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    } else {
        
        /*
        if((time() - $_SESSION['time']) > 1000000){
            header('location: ../../controllers/salir.php');
            die();
        }
        */
    }
    $result = $con->query("select * from usuario where ID_Usuario = '$usuario';");
    if(!($row = $result->fetch_object())){
		echo "<script> alert('Id de usuario indicada no existe'); </script>";
		echo "<script> window.location='../registros/login.php'; </script>";
	}
    //YA AQUI TENGO LOS DATOS DEL USUARIO
?>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS PERSONALES -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h1><?=$_titulo?></h1>
                            <img src="../../assets/images/datos-personales.png" style="width: 50px; height: 50px;" alt="">
                        </header>
                        <hr>
                        <form action="../../controllers/proveedor/ctrl_datosPersonales.php" method="POST">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="nombre">Nombre</label>
                                    <input value="<?=$row->Nombre?>" disabled class="form-control" type="text" name="nombre" id="nombre" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="apellido">Apellido</label>
                                    <input value="<?=$row->Apellido?>" disabled class="form-control" type="text" name="apellido" id="apellido" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="telefono">Número de Teléfono:</label>
                                    <input value="<?=$row->Telefono?>" disabled class="form-control" type="text" name="telefono" id="telefono" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="email">Correo de Usuario:</label>
                                    <input value="<?=$row->Email?>" disabled class="form-control" type="text" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="cedula">Cédula:</label>
                                    <input value="<?=$row->Cedula?>" disabled class="form-control" type="text" name="cedula" id="cedula" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="rif">RIF:</label>
                                    <input value="<?=$row->RIF?>" disabled class="form-control" type="text" name="rif" id="rif" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="direccion">Dirección o habitación:</label>
                                    <input value="<?=$row->Direccion?>" disabled class="form-control" type="text" name="direccion" id="direccion" required>
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
                        <!-- FUNCION PARA HABILITAR O DESHABILITAR LOS CAMPOS -->
                        <script type="text/javascript">
                            function activarCampos(){
                                var BotonCambiar = document.getElementById('botonCambiar');
                                if(document.getElementById('nombre').disabled == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('nombre').disabled=true;
                                    document.getElementById('apellido').disabled=true;
                                    document.getElementById('telefono').disabled=true;
                                    //document.getElementById('email').disabled=true;
                                    //document.getElementById('cedula').disabled=true;
                                    document.getElementById('rif').disabled=true;
                                    document.getElementById('direccion').disabled=true;
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('nombre').disabled=false;
                                    document.getElementById('apellido').disabled=false;
                                    document.getElementById('telefono').disabled=false;
                                    //document.getElementById('email').disabled=false;
                                    //document.getElementById('cedula').disabled=false;
                                    document.getElementById('rif').disabled=false;
                                    document.getElementById('direccion').disabled=false;
                                }
                                
                            }
                        </script>
    <?php               
        include('../templates/footer.php');
    ?>

                
