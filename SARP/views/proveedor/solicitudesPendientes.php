<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Solicitudes Pendientes";
    include('../templates/head.php');
 
    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    $n = $usuario;

    $sql= "SELECT * FROM solicitud_proveedor INNER JOIN siembras ON solicitud_proveedor.ID_Siembra=siembras.ID_Siembra WHERE siembras.ID_Proveedor = $n and solicitud_proveedor.Estado_Aprobacion=0 ; ";
    $result= mysqli_query($con,$sql);
    //YA AQUI TENGO LOS DATOS DEL USUARIO

?>
    <div class="container-fluid">
        <div class="row">
            
                <!-- CONTENIDO DEL MENU DE NAVEGACION -->
                <?php
                    include("../templates/menuProveedor.php");
                ?>

                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <!-- CONTENIDO DE LA VISTA -->
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h1><?=$_titulo?></h1>
                                    <img class="imagen-titulo" src="../../assets/images/solicitudesPendientes.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <div class="row">
                                    <label for="solicitudes" class="col-sm-5 col-form-label">Lista de Solicitudes</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-7">
                                        <input placeholder="-- SELECCIONE SOLICITUD --" class="form-control" list="solicitudes" name="solicitudes" id="solicitud" onchange="cargarSoli(this.value)" >
                                            <datalist id="solicitudes" >
                                                <?php
                                                    while($valores = mysqli_fetch_array($result)){
                                                        $id = $valores['ID_Solicitud_Proveedor'];
                                                        $cantidad = $valores['Cantidad_MP'];
                                                        echo "<option value=$id>Cantidad = $cantidad</option>";
                                                    }
                                                ?>
                                            </datalist>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <hr>
                        <form id="formulario">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cantidadA">Cantidad a Arrimar:</label>
                                <input class="form-control" type="text" name="cantidadA" id="cantidadA" required readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="semana">Semana #:</label>
                                <input class="form-control" type="text" name="semana" id="semana" required readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idLote">ID del Lote Solicitado:</label>
                                <input class="form-control" type="text" name="idLote" id="idLote" required readonly>
                            </div>
                            <div class="form-group col-md-4" style="display: none;">
                                <label for="idsoli">ID solicitud:</label>
                                <input class="form-control" type="text" name="idsoli" id="idsoli" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="observacion">Observación (opcional):</label>
                                <p><textarea class="observaciones" name="observacion" placeholder="Coloca tus observaciones!"></textarea></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-pencil" onclick="EliminarSoli()">Rechazar</button>
                                <button type="button" class="btn btn-success glyphicon glyphicon-pencil" onclick="aceptarSoli()">Aceptar</button>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">

                        function cargarSoli(idso){
                            $.ajax({
                                    // la URL para la petición
                                url : '../../controllers/proveedor/get_datosSoli.php',
                    
                                // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                data : { idso : idso },
                    
                                // especifica si será una petición POST o GET
                                type : 'POST',
                    
                                // el tipo de información que se espera de respuesta
                                dataType : 'json',
                    
                                // código a ejecutar si la petición es satisfactoria;
                                success : function(json) {
                                    
                                    $("#cantidadA").val(json.Cantidad_MP);
                                    $("#semana").val(json.Semana);
                                    $("#idLote").val(json.ID_Siembra);
                                    $("#observacion").val(json.Observaciones);
                                    $('#idsoli').val(json.idsoli);
                               
                                    
                                },
                    
                                // código a ejecutar si la petición falla;
                                error : function(xhr, status) {
                                    alert('Disculpe, existió un problema');
                                }
                            })

                        }

                        function EliminarSoli(){
                            var se = document.getElementById('solicitud').value;
                            if(se === ""){
                                    alert('Selecione solicitud a rechazar')

                            }else{
                                if(confirm('¿Seguro de Rechazar?')){
                                    $.ajax({
                                        data : { se : se },

                                        // especifica si será una petición POST o GET
                                        type : 'POST',
                                        
                                        dataType: 'json',
                                        // la URL para la petición
                                        url : '../../controllers/agropecuaria/ctrl_eliminarSolicitud.php',
                            
                                        // la información a enviar en este caso el valor de lo que seleccionaste en el select
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        alert('Rechazada con exito');
                                        location.reload();
                                       
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                    })
                            
                                }
                            }
                            


                        }
                        function aceptarSoli(){
                            var se = document.getElementById('solicitud').value;
                           
                            if(se === ""){
                                    alert('Selecione solicitud para aceptar')

                            }else{
                                if(confirm('¿Seguro de Aceptar?')){
                                    let form = document.getElementById('formulario');
                                    let data = new FormData(form);
                                    let id = document.getElementById('solicitud').value;

                                    fetch('../../controllers/proveedor/ctrl_aceptarsoli.php',{
                                        method: 'POST',
                                        body:data
                                        

                                    }).then(response => response.text()).then(response => {

                                       if(response == "ok"){
                                        alert('Aceptada con exito');
                                        location.reload();
                                       }else if(response == "no"){
                                        alert('No se puede aceptar');
                                       }else{
                                        alert('no recibo');
                                       }
                                        
                                        
                                        
                                    })
                            
                                }
                            }

                            
                        }

                                                    

                    </script>
    <?php
        include('../templates/footer.php');
    ?>