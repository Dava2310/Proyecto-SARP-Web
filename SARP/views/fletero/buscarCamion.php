<?php
    $_titulo = "Consultar camiones";
    include('../templates/headFletero.php');
?>
<body>
    <div class="container-fluid">
        <div class="row"> 
            
                <?php
                    include("../templates/menuFletero.php");
                ?>
                
            
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78;">
                    <div class="contenidoInterno"  style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h2>Buscar Camión</h2>
                                    <img class="imagen-titulo" src="../../assets/images/camion.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="Camiones">Lista de camiones:</label>
                                <input list="Camiones" name="Camiones">
                                    <datalist id="Camiones">
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
                                    <div class="form-group col-sm">
                                        <label for="Placa">Placa:</label>
                                        <input class="form-control" type="text" name="Placa" id="Placa" required>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Capacidad">Capacidad en Toneladas:</label>
                                        <input class="form-control" type="number" name="Capacidad" id="Capacidad" required>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Modelo">Modelo:</label>  
                                        <input class="form-control" type="text" name="Modelo" id="Modelo" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Cambiar datos</button>
                                        <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                        <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Guardar Cambios</button>
                                    </div>
                                </div>
                                    
                            </form>
                            <div class="row" style="margin-left: 10px; margin-top: 8px;">
                                <h2>Choferes</h2>
                                <img class="imagen-titulo" src="../../assets/images/chofer.png" alt=""  style="width: 50px; height: 50px;"> <hr> 
                            </div>
                            <hr> 
                            <form action="">   
                                <div class="row">    
                                    <div class="form-group col-sm">
                                        <label for="Nombre">Nombre Completo (1):</label>
                                        <input class="form-control" type="text" name ="Nombre" id="Nombre" required>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="CI">Cédula de Identidad (1):</label>
                                        <input class="form-control" type="text" name="CI" id="CI" required>
                                    </div> 
                                </div> 
                                
                                <div class="row">   
                                    <div class="form-group col-sm">
                                        <label for="Nombre2">Nombre Completo (2):</label>   
                                        <input class="form-control" type="text" name ="Nombre2" id="Nombre2">
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="CI2"> Cédula de Identidad (2):</label>
                                        <input class="form-control" type="text" name="CI2" id="CI2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Cambiar datos</button>
                                        <button type="reset" class="btn btn-danger glyphicon glyphicon-pencil">Eliminar</button>
                                        <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Guardar Cambios</button>
                                    </div>
                                </div>
                            </form>                          
<?php
    include ("../templates/footerFletero.php")
?>