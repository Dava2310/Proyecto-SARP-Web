<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Datos Personales!";
    include('../templates/headFletero.php');
    
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
    $result = $con->query("select * from usuario where  ID_Usuario = '$usuario';");
    if(!($row = $result->fetch_object())){
		echo "<script> alert('Id de usuario indicada no existe'); </script>";
		echo "<script> window.location='../registros/login.php'; </script>";
	}
    //YA AQUI TENGO LOS DATOS DEL USUARIO
?>
<body>
    <div class="container-fluid">
        <div class="row"> 
    
                <?php
                    include("../templates/menuAgropecuaria.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h2>Datos Personales</h2>
                            <img class="imagen-titulo" src="../../assets/images/datos-personales.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <form action="../../controllers/agropecuaria/ctrl_datosPersonales.php" method="POST">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="Nombre">Nombre:</label>
                                    <input value="<?=$row->Nombre?>" readonly class="form-control" type="text" name ="Nombre" id="Nombre" pattern="([a-z]|[A-Z]){3,15}">
                                </div>
                                <div class="form-group col-sm">
                                    <label for="apellido">Apellido:</label>
                                    <input value="<?=$row->Apellido?>" readonly class="form-control" type="text" name ="apellido" id="apellido" pattern="([a-z]|[A-Z]){3,15}">
                                </div>
                                
                            </div>
                            <div class="row">
                                 <div class="form-group col-sm">
                                    <label for="cedula">Cédula:</label>
                                    <input value="<?=$row->Cedula?>" readonly class="form-control" type="text" name ="cedula" id="cedula">
                                    

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rif">RIF:</label>
                                    <input value="<?=$row->RIF?>" readonly class="form-control" type="text" name ="rif" id="rif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="tlf">Teléfono:</label>
                                    <input value="<?=$row->Telefono?>" readonly class="form-control" type="text" name ="tlf" id="tlf">
                                </div>
                                <div class="form-group col-sm">
                                    <label for="correo">Correo de Usuario:</label>
                                    <input  value="<?=$row->Email?>" readonly class="form-control" type="email" name ="correo" id="correo">
                                </div>
                                
                            </div>
                           
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="direccion">Dirección o Habitación:</label>
                                    <input value="<?=$row->Direccion?>" readonly class="form-control" type="text" name ="direccion" id="direccion">
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
                                if(document.getElementById('Nombre').readOnly == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('Nombre').readOnly=true;
                                    document.getElementById('apellido').readOnly=true;
                                    document.getElementById('tlf').readOnly=true;
                                    //document.getElementById('email').disabled=true;
                                    //document.getElementById('cedula').disabled=true;
                                    document.getElementById('rif').readOnly=true;
                                    document.getElementById('direccion').readOnly=true;
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('Nombre').readOnly=false;
                                    document.getElementById('apellido').readOnly=false;
                                    document.getElementById('tlf').readOnly=false;
                                    //document.getElementById('email').disabled=false;
                                    //document.getElementById('cedula').disabled=false;
                                    document.getElementById('rif').readOnly=false;
                                    document.getElementById('direccion').readOnly=false;
                                }
                                
                            }
                        </script>
<?php
    include ("../templates/footerFletero.php")
?>