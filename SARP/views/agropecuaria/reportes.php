<?php
    $_titulo = "Reportes";
    include('../templates/headFletero.php');
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
                            <h2>Reportes</h2>
                            <img class="imagen-titulo" src="../../assets/images/report.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        
                            <div class="row justify-content-between" style="margin-left: 10px; margin-bottom: 20px;">
                                <div class="  col-md-6 col-sm-12 ">
                                    <h3> Disponibilidad de Arrime en el Campo.</h3>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Generar reporte</button>
                                </div>
                            
                            </div>
                            <div class="row justify-content-between" style="margin-left: 10px; margin-bottom: 20px;">
                                <div class="  col-md-6 col-sm-12 ">
                                    <h3> Planificaciones confirmadas.</h3>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Generar reporte</button>
                                </div>
                            
                            </div>
                            <div class="row justify-content-between" style="margin-left: 10px; margin-bottom: 20px;">
                                <div class="  col-md-6 col-sm-12 ">
                                    <h3> Listado de arrime Real.</h3>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Generar reporte</button>
                                </div>
                            
                            </div>
                            <div class="row justify-content-between" style="margin-left: 10px; margin-bottom: 20px;">
                                <div class="  col-md-6 col-sm-12 ">
                                    <h3> Reporte por Boleto Individual.</h3>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Generar reporte</button>
                                </div>
                            
                            </div>
                          
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>