<?php
    $_titulo = "Datos Bancarios";
    include('../templates/headFletero.php');
?>
<body>
   
    <div class="container-fluid">
        <div class="row"> 
            
                <?php
                    include("../templates/menuFletero.php");
                ?>
                 
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno" style="padding-top: 25px;">   
                            <header  class="row" style="margin-left: 10px;">
                                    <h2>Datos Bancarios Personales </h2>
                                    <img class="imagen-titulo" src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                            </header>
                            <hr>
                            <form action="">
                                <div class="row">
                                    <div class="form-group col-sm">
                                        <label for="ctaPropia">Cuenta Propia:</label>
                                        <input class="form-control" type="text" name ="ctaPropia" id="ctaPropia">
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Banco">Banco:</label>
                                        <input class="form-control" type="text" name ="Banco" id="Banco">

                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Nrocuenta">Nº de Cuenta:</label>
                                        <input class="form-control" type="text" name ="Nrocuenta" id="Nrocuenta">
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="TpoCuenta">Tipo de cuenta:</label>
                                        <input class="form-control" type="text" name ="TpoCuenta" id="TpoCuenta">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                        <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row" style="margin-left: 10px; margin-top: 8px;">
                                <h2>Datos Bancarios Autorizado</h2>
                                <img class="imagen-titulo" src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                            <hr>
                            <form action="">
                                <div class="row">
                                    <div class="form-group col-sm">
                                        <label for="Nombre">Nombre:</label>
                                        <input class="form-control" type="Nombre" name ="Nombre" id="Nombre">
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Banco">Banco:</label>
                                        <input class="form-control" type="text" name ="Banco" id="Banco">

                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Nrocuenta">Nº de Cuenta:</label>
                                        <input class="form-control" type="text" name ="Nrocuenta" id="Nrocuenta">
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="TpoCuenta">Tipo de cuenta:</label>
                                        <input class="form-control" type="text" name ="TpoCuenta" id="TpoCuenta">
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