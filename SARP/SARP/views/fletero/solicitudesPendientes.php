<?php
    $_titulo = "Solicitudes aceptadas";
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
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                    <div class="row">
                                        <h2 >Solicitudes Pendientess</h2>
                                        <img class="imagen-titulo" src="../../assets/images/solicitudesPendientes.png" alt="" style="width: 50px; height: 50px;">
                                    </div>
                                </div>


                                <div class="form-group col-sm">
                                    <label for="Cupos">Lista de Cupos:</label>
                                    <input list="Cupos" name="Cupos">
                                        <datalist id="Cupos">
                                            <option value="JavaScript"></option>
                                            <option value="HTML5"></option>
                                            <option value="CSS3"></option>
                                        </datalist>
                                    <input type="submit" value="buscar" class="btn btn-info glyphicon glyphicon-pencil" style="color: black; font-weight: bold;">
                                </div>
                        </header>
                        <hr>
                       
                        <form action="" class="contenidoform">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cantidadkilos">Cantidad en Kilos:</label>
                                    <input class="form-control" type="text" name="cantidadkilos" id="cantidadkilos">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="semana">Semana:</label>
                                    <input class="form-control" type="text" name="semana" id="semana">
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="sector">Sector:</label>
                                    <input class="form-control" type="text" name="sector" id="sector">  
                                </div>
                            </div>
                            <div class="row">
                                <!-- Dias -->
                                <div class="col-sm">
                                    <label for="dias">Días:</label>
                                    <img class="imagen-titulo" src="../../assets/images/si.png" name= "dias"alt="" style="width: 50px; height: 50px;">
                                </div>
                                <!-- Martes -->
                                <div class="form-group col-sm">
                                    <label for="martes">Martes:</label>
                                    <input class="form-control"type="text" name="martes" id="martes">
                                </div>
                                <!-- Miercoles -->
                                <div class="form-group col-sm">
                                    <label for="miercoles">Miércoles:</label>
                                    <input class="form-control" type="text" name="miercoles" id="miercoles">
                                    
                                </div>
                                <!-- Jueves -->
                                <div class="form-group col-sm">
                                    <label for="jueves">Jueves:</label>
                                    <input class="form-control" type="text" name="jueves" id="jueves">
                                   
                                </div>
                                <!-- Viernes -->
                                <div class="form-group col-sm">
                                    <label for="viernes">Viernes:</label>
                                    <input class="form-control" type="text" name="viernes" id="viernes">
                                    
                                </div>
                                <!-- Sabado -->
                                <div class="form-group col-sm">
                                    <label for="sabado">Sábado:</label>
                                    <input class="form-control" type="text" name="sabado" id="sabado">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="observacion">Observacion</label>
                                    <textarea class="form-control" name="observacion" placeholder="Coloca tus observaciones!" style="max-height: 30vh;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-danger glyphicon glyphicon-pencil">Limpiar</button>
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Aceptar</button>
                            </div>
                        </div>
                        </form>
<?php
    include ("../templates/footerFletero.php")
?>