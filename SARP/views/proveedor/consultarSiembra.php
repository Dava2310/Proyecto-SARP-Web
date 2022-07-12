<?php
    $_titulo = "Consultar Siembras";
    include('../templates/head.php');
?>
    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONETNIDO DE LA VISTA -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h1><?=$_titulo?></h1>
                                    <img class="imagen-titulo" src="../../assets/images/camion.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="Camiones">Lista de siembras:</label>
                                <input list="siembras" name="siembras">
                                    <datalist id="siembras">
                                        <option value="JavaScript"></option>
                                        <option value="HTML5"></option>
                                        <option value="CSS3"></option>
                                    </datalist>
                                <input type="submit" value="buscar" class="btn btn-info glyphicon glyphicon-pencil" style="color: black; font-weight: bold;">
                            </div>
                        </header>
                        <hr>
                        <form action="../../controllers/proveedor/ctrl_consultarSiembra.php">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fechaI">Fecha de Inicio:</label>
                                    <input class="form-control" type="text" name="fechaI" id="fechaI" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kilosA">Kilos Arrimados:</label>
                                    <input class="form-control" type="text" name="kilosA" id="kilosA" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="saldoR">Saldo Restante:</label>
                                    <input class="form-control" type="text" name="saldoR" id="saldoR" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="variedad">Variedad:</label>
                                    <input class="form-control" type="text" name="variedad" id="variedad" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="idLote">ID del Lote Generado:</label>
                                    <input class="form-control" type="text" name="idLote" id="idLote" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kilosT">Kilos Totales por Lote:</label>
                                    <input class="form-control" type="text" name="kilosT" id="kilosT" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fechaC">Fecha Estimada de Cosecha:</label>
                                    <input class="form-control" type="text" name="fechaC" id="fechaC" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hectareas">Hectáreas Sembradas:</label>
                                    <input class="form-control" type="text" name="hectareas" id="hectareas" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rendimiento">Rendimiento Esperado:</label>
                                    <input class="form-control" type="text" name="rendimiento" id="rendimiento" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Modificar Datos</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Eliminar</button>
                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <header class="titulo-formulario">
                            <h2>Datos de la muestra</h2>
                        </header>
                        <br>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="analisis">Analisis de la muestra:</label>
                                    <input class="form-control" type="text" name="analisis" id="analisis" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="materiaS">% de Materia Seca:</label>
                                    <input class="form-control" type="text" name="materiaS" id="materiaS" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="impureza">% de Impureza:</label>
                                    <input class="form-control" type="text" name="impureza" id="impureza" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="kilos">Cant. Kilos de la Muestra:</label>
                                    <input class="form-control" type="text" name="kilos" id="kilos" required>
                                </div>
                            </div>
                        </form>
    <?php
        include('../templates/footer.php');
    ?>