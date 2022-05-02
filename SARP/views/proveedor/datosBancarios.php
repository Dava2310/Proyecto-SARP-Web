<?php
    $_titulo = "Datos Bancarios Personales y Autorizados";
    $_titulo1 = "Datos Bancarios Personales";
    $_titulo2 = "Datos Bancarios Autorizados";
    include('../templates/head.php');
?>
    <div class="container-fluid">
        <div class="row">
            <div class="pantalla">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LOS DATOS BANCARIOS -->
                <div class="contenido">
                    <header class="titulo-formulario">
                        <h1><?=$_titulo1?></h1>
                        <img class="imagen-titulo" src="../../assets/images/bank.png" alt="">
                    </header>
                    <hr>
                    <!-- FORMULARIO DE LOS DATOS BANCARIOS PERSONALES -->
                    <form action="ctrl_bancarioPersonal.php">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="cuentaP">Cuenta Propia:</label>
                                <input class="form-control" type="text" name="cuentaP" id="cuentaP" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bancoP">Banco:</label>
                                <input class="form-control" type="text" name="bancoP" id="bancoP" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="numP">Nº de Cuenta:</label>
                                <input class="form-control" type="text" name="numP" id="numP" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tipoP">Tipo de Cuenta:</label>
                                <input class="form-control" type="text" name="tipoP" id="tipoP" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                            </div>
                        </div>
                    </form>
                    <!-- <br> -->
                    <hr>
                    <header class="titulo-formulario">
                        <h1><?=$_titulo2?></h1>
                        <img class="imagen-titulo" src="../../assets/images/bank.png" alt="">
                    </header>
                    <br>
                    <!-- FORMULARIO DE LOS DATOS BANCARIOS AUTORIZADOS -->
                    <form action="ctrl_bancarioAutorizado.php">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="cuentaA">Cuenta Autorizada:</label>
                                <input class="form-control" type="text" name="cuentaA" id="cuentaA" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bancoA">Banco:</label>
                                <input class="form-control" type="text" name="bancoA" id="bancoA" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="numA">Nº de Cuenta:</label>
                                <input class="form-control" type="text" name="numA" id="numA" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tipoA">Tipo de Cuenta:</label>
                                <input class="form-control" type="text" name="tipoA" id="tipoA" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        include('../templates/footer.php');
    ?>