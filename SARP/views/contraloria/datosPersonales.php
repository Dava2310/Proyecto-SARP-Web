<?php
    $_titulo = "Datos Personales";
    include('../templates/headFletero.php');
?>
<body>
    <div class="container-fluid">
        <div class="row"> 
    
                <?php
                    include("../templates/menuContraloria.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <h2>Datos Personales</h2>
                            <img class="imagen-titulo" src="../../assets/images/datos-personales.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <form action="">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="Nombre">Nombre Completo:</label>
                                    <input class="form-control" type="text" name ="Nombre" id="Nombre">
                                </div>
                                <div class="form-group col-sm">
                                    <label for="CI">Cédula:</label>
                                    <input class="form-control" type="text" name ="CI" id="CI">
                                    

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="correo">Correo de Usuario:</label>
                                    <input class="form-control" type="email" name ="correo" id="correo">
                                </div>
                                <div class="form-group col-sm">
                                    <label for="tlf">Teléfono:</label>
                                    <input class="form-control" type="number" name ="tlf" id="tlf">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="rif">RIF:</label>
                                    <input class="form-control" type="text" name ="rif" id="rif">
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="direc">Dirección o Habitación:</label>
                                    <input class="form-control" type="text" name ="direc" id="direc">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                                </div>
                            </div>
                        </form>
<?php
    include ("../templates/footerFletero.php")
?>