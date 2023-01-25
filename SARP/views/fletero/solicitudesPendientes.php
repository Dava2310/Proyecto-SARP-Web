<?php
    session_start();
    $usuario = $_SESSION['ID'];
    $_titulo = "Solicitudes Pendientes";
    include('../templates/head.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    $n = $usuario;
    $sql= "SELECT * FROM solicitud_proveedor
    INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
    INNER JOIN camiones ON solicitud_fletero.Placa = camiones.Placa
    WHERE
    solicitud_fletero.Estado_Aprobacion = 0 AND
    camiones.ID_Fleteros = $usuario
    ";
    $result= mysqli_query($con,$sql);
?>
<body>
    <div class="container-fluid">   
        <div class="row"> 
                <?php
                    include("../templates/menuFletero.php");
                ?>
                
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                    <div class="row">
                                        <h2 >Solicitudes Pendientess</h2>
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
                                                    $id = $valores['ID_Solicitud_Fletero'];
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
                        
                        <form action="" class="contenidoform" id="formulario">
                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="cantidadkilos">Cantidad en Kilos:</label>
                                    <input class="form-control" type="text" name="cantidadkilos" id="cantidadkilos" readonly>
                                    
                                </div>
                                <div class="form-group col-sm">
                                    <label for="semana">Semana:</label>
                                    <input class="form-control" type="text" name="semana" id="semana" readonly>
                                    
                                </div>
                          
                            </div>
                            <div class="row">
                                <!-- Dias -->
                                <div class="col-3" style="margin-bottom: 20px;">
                                    <label for="dias">Días:</label>
                                    <img class="imagen-titulo" src="../../assets/images/si.png" name= "dias"alt="" style="width: 50px; height: 50px;">
                                    <input class="form-control"type="date" name="dias" id="dias">
                                </div>
                            </div>
                            <div class="row">
                                <!-- Dias -->
                                <div class="col-4">
                                    <label for="Camion">Camion:</label>
                                    <input class="form-control"type="text" name="Camion" id="Camion" readonly >
                                </div>
                                <div class="col-4">  
                                
                                    <label  >Lista de Choferes</label>
                                        
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    
                                    <select id="chofer" name="chofer" disabled class="form-control"  >
                                        <option value="">-- SELECCIONE CHOFER --</option>
                                    </select>
                                            
                                        
                                    
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="form-group col-sm">
                                    <label for="observacion">Observacion</label>
                                    <textarea class="form-control" name="observacion" placeholder="Coloca tus observaciones!" style="max-height: 30vh;"></textarea>
                                </div>
                                <div class="form-group col-md-4" style="display: none;">
                                    <label for="idsoli">ID solicitud:</label>
                                    <input class="form-control" type="text" name="idsoli" id="idsoli" required readonly>
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
                                url : '../../controllers/fletero/get_datosSoli.php',
                    
                                // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                data : { idso : idso },
                    
                                // especifica si será una petición POST o GET
                                type : 'POST',
                    
                                // el tipo de información que se espera de respuesta
                                dataType : 'json',
                    
                                // código a ejecutar si la petición es satisfactoria;
                                success : function(json) {
                                    
                                    $("#cantidadkilos").val(json.Cantidad_MP);
                                    $("#semana").val(json.Semana);
                                    $("#Camion").val(json.Camion);
                                    $('#idsoli').val(json.idsoli)
                               
                                    
                                },
                    
                                // código a ejecutar si la petición falla;
                                error : function(xhr, status) {
                                    alert('Disculpe, existió un problema');
                                }
                            })

                        }

                        $(document).ready(function(){

                                var chofer = $('#chofer');

                                $('#Camion').click(function(){
                                    var placa = $(this).val();
                                    
                                    if(placa !== ''){
                                        $.ajax({
                                            data: {placa:placa}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                            dataType: 'html', //tipo de datos que esperamos de regreso
                                            type: 'POST', //mandar variables como post o get
                                            url: '../../controllers/fletero/get_listaChofer.php' //url que recibe las variables
                                        }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                                            chofer.prop('disabled', false); //habilitar el select       

                                            chofer.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                                            
                                        });

                                    }else{ //en caso de seleccionar una opcion no valida
                                        chofer.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                        chofer.prop('disabled', true); //deshabilitar el select
                                    }
                                })
                            })

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
                                        url : '../../controllers/fletero/ctrl_eliminarSolicitud.php',
                            
                                        // la información a enviar en este caso el valor de lo que seleccionaste en el select
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        if(json.eliminar=="1"){
                                            alert('Rechazada con exito');
                                            location.reload();
                                        }else if(json.eliminar=="0"){
                                            
                                            alert('Problema');
                                            
                                        }
                                        
                                       
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

                                    fetch('../../controllers/fletero/ctrl_aceptarsoli.php',{
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
    include ("../templates/footerFletero.php")
?>