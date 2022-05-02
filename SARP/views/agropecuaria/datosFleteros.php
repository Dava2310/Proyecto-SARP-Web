<?php
    $_titulo = "Datos Fleteros";
    include('../templates/headFletero.php');
?>
<body>
    <div class="container-fluid ">
        
        <div class="row"> 
            
            <?php
                include("../templates/menuAgropecuaria.php");
            ?> 
            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; ">
                <div class="contenidoInterno" style="padding-top: 25px;">
                    <header class="row justify-content-between" style="margin-left: 10px;">
                    
                        <div class=" col-md-6 col-sm-12 ">
                            <div class="row">
                                <h2>Datos Personales Fleteros</h2> 
                                <img class="imagen-titulo"src="../../assets/images/datos-personales.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-12 ">
                            <label for="Feteros">Lista de Fleteros</label>
                            <input list="Fleteros" name="Fleteros">
                                <datalist id="Fleteros">
                                    <option value="JavaScript"></option>
                                    <option value="HTML5"></option>
                                    <option value="CSS3"></option>
                                </datalist>
                            <input type="submit" value="buscar" class="btn btn-info glyphicon glyphicon-pencil" style="color: black; font-weight: bold;">
                        </div> 
                    </header>
                    <hr>
                    <form action="">
                        <div class="row">
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Nombre">Nombre Completo:</label>
                                <input class="form-control" type="text" name="Nombre" id="Nombre" required>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="Correo">Correo de Usuario:</label>
                                <input class="form-control" type="email" name="Correo" id="Correo" required>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="CI">Cédula:</label>  
                                <input class="form-control" type="text" name="CI" id="CI" required>
                            </div>
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="rif">RIF</label>  
                                <input class="form-control" type="text" name="rif" id="rif" required>
                            </div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <label for="direccion">Dirección o Habitación:</label>
                                <input class="form-control" type="text" name="direccion" id="direccion" required>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <label for="tlf">Teléfono:</label>
                                <input class="form-control" type="email" name="tlf" id="tlf" required>
                            </div>
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="sector">Sector de Trabajo:</label>  
                                <input class="form-control" type="text" name="sector" id="sector" required>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-top: 8px;">
                            <h2>Datos bancarios Fleteros</h2> 
                            <img class="imagen-titulo"src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group form-group col-xl-6 col-lg-3 col-md-6  col-sm-12 col-12">
                                <label for="cuentapropia">Cuenta Propia:</label>
                                <input class="form-control" type="text" name="cuentapropia" id="cuentapropia" >
                            </div>
                            <div class="form-group form-group col-xl-6 col-lg-3 col-md-6  col-sm-12 col-12">
                                <label for="Banco">Banco:</label>
                                <input class="form-control" type="email" name="Banco" id="Banco" >
                            </div>
                        <!-- </div>
                        <div class="row"> -->
                            <div class="form-group form-group col-xl-6 col-lg-3 col-md-6  col-sm-12 col-12">
                                <label for="numcuenta">Nº de Cuenta:</label>
                                <input class="form-control" type="text" name="numcuenta" id="numcuenta" >
                            </div>
                            <div class="form-group form-group col-xl-6 col-lg-3 col-md-6  col-sm-12 col-12">
                                <label for="tipocuenta">Tipo de Cuenta:</label>
                                <input class="form-control" type="email" name="tipocuenta" id="tipocuenta" >
                            </div>
                        </div>
                    
                        <div class="row" >
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Aceptar</button>
                            </div>
                        </div>
                            
                    </form>  
<?php
    include ("../templates/footerFletero.php")
?>

