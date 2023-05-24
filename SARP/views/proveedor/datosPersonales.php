<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Datos Personales!";
    include('../templates/head.php');
    
    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();

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
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
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
                                    <input value="<?=$row->Nombre?>" readOnly class="form-control" type="text" name="nombre" id="nombre" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="Apellido">Apellido</label>
                                    <input value="<?=$row->Apellido?>" readOnly class="form-control" type="text" name="Apellido" id="Apellido" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="telefono">Número de Teléfono:</label>
                                    <input value="<?=$row->Telefono?>" readOnly class="form-control" type="text" name="telefono" id="telefono" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="email">Email de Usuario:</label>
                                    <input value="<?=$row->Email?>" readOnly class="form-control" type="text" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="Cedula">Cédula:</label>
                                    <input value="<?=$row->Cedula?>" readOnly class="form-control" type="text" name="Cedula" id="Cedula" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="rif">RIF:</label>
                                    <input value="<?=$row->RIF?>" readOnly class="form-control" type="text" name="rif" id="rif" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="direccion">Dirección o habitación:</label>
                                    <input value="<?=$row->Direccion?>" readOnly class="form-control" type="text" name="direccion" id="direccion" required>
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
                                if(document.getElementById('nombre').readOnly == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('nombre').readOnly=true;
                                    document.getElementById('Apellido').readOnly=true;
                                    document.getElementById('telefono').readOnly=true;
                                    //document.getElementById('email').disabled=true;
                                    //document.getElementById('Cedula').disabled=true;
                                    document.getElementById('rif').readOnly=true;
                                    document.getElementById('direccion').readOnly=true;
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('nombre').readOnly=false;
                                    document.getElementById('Apellido').readOnly=false;
                                    document.getElementById('telefono').readOnly=false;
                                    //document.getElementById('email').disabled=false;
                                    //document.getElementById('Cedula').disabled=false;
                                    document.getElementById('rif').readOnly=false;
                                    document.getElementById('direccion').readOnly=false;
                                }
                                
                            }
                        </script>
    <?php               
        include('../templates/footer.php');
    ?>

                
