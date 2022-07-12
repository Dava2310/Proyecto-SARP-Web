<?php
    $_titulo = "Solicitudes Aceptadas";
    include('../templates/head.php');
?>

    <div class="container-fluid">
        <div class="row">
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>
                <!-- CONTENIDO DE LA VISTA -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h1><?=$_titulo?></h1>
                                    <img src="../../assets/images/aceptar.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="solicitudes">Lista de Solicitudes:</label>
                                <input list="solicitudes" name="solicitudes">
                                    <datalist id="solicitudes">
                                        <option value="JavaScript"></option>
                                        <option value="HTML5"></option>
                                        <option value="CSS3"></option>
                                    </datalist>
                                <input type="submit" value="Buscar" class="btn btn-info glyphicon glyphicon-pencil" style="color: black; font-weight: bold;">
                            </div>
                        </header>
                        <hr>
                        <form action="../../controllers/proveedor/ctrl_solicitudAceptada.php">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cantidadA">Cantidad a Arrimar:</label>
                                <input class="form-control" type="text" name="cantidadA" id="cantidadA" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="semana">Semana #:</label>
                                <input class="form-control" type="text" name="semana" id="semana" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idLote">ID del Lote Solicitado:</label>
                                <input class="form-control" type="text" name="idLote" id="idLote" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="observacion">Observación (opcional):</label>
                                <p><textarea class="observaciones" name="observacion" placeholder="Coloca tus observaciones!"></textarea></p>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <header class="titulo-formulario">
                        <h1>Dias Asignados de la Solicitud</h1>
                    </header>
                    <br>
                    <form action="">
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
                        <h1>Datos de los Fleteros:</h1>
                        <div class="row">
                            <!-- Dias -->
                            <div class="col-sm">
                                <label for="dias">Nombre:</label>
                            </div>
                            <!-- Martes -->
                            <div class="form-group col-sm">
                                <input class="form-control"type="text" name="namefleteroMartes" id="namefleteroMartes">
                            </div>
                            <!-- Miercoles -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="namefleteroMiercoles" id="namefleteroMiercoles">
                            </div>
                            <!-- Jueves -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="namefleteroJueves" id="namefleteroJueves">
                            </div>
                            <!-- Viernes -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="namefleteroViernes" id="namefleteroViernes">
                            </div>
                            <!-- Sabado -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="namefleteroSabado" id="namefleteroSabado">
                            </div>
                        </div>
                        <div class="row">
                            <!-- Dias -->
                            <div class="col-sm">
                                <label for="dias">C.I:</label>
                            </div>
                            <!-- Martes -->
                            <div class="form-group col-sm">
                                <input class="form-control"type="text" name="cifleteroMartes" id="cifleteroMartes">
                            </div>
                            <!-- Miercoles -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="cifleteroMiercoles" id="cifleteroMiercoles">
                            </div>
                            <!-- Jueves -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="cifleteroJueves" id="cifleteroJueves">
                            </div>
                            <!-- Viernes -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="cifleteroViernes" id="cifleteroViernes">
                            </div>
                            <!-- Sabado -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="cifleteroSabado" id="cifleteroSabado">
                            </div>
                        </div>
                        <div class="row">
                            <!-- Dias -->
                            <div class="col-sm">
                                <label for="dias">Placa:</label>
                            </div>
                            <!-- Martes -->
                            <div class="form-group col-sm">
                                <input class="form-control"type="text" name="placafleteroMartes" id="placafleteroMartes">
                            </div>
                            <!-- Miercoles -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="placafleteroMiercoles" id="placafleteroMiercoles">
                            </div>
                            <!-- Jueves -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="placafleteroJueves" id="placafleteroJueves">
                            </div>
                            <!-- Viernes -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="placafleteroViernes" id="placafleteroViernes">
                            </div>
                            <!-- Sabado -->
                            <div class="form-group col-sm">
                                <input class="form-control" type="text" name="placafleteroSabado" id="placafleteroSabado">
                            </div>
                        </div>
                    </form>
    <?php
        include('../templates/footer.php');
    ?>