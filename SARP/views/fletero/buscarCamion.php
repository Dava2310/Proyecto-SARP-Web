<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Consultar camiones";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    $n = $usuario;

    
    $usuario= "SELECT * from camiones WHERE ID_Fleteros = $n ";
    $result= mysqli_query($con,$usuario);


?>
<body>
    <div class="container-fluid">
        <div class="row"> 
                <?php
                    include("../templates/menuFletero.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno"  style="padding-top: 25px;">
                        <header class="row justify-content-between" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <div class="row">
                                    <h2>Buscar Camión</h2>
                                    <img class="imagen-titulo" src="../../assets/images/camion.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="form-group  col-md-6 col-sm-12 ">
                                <div class="row">
                                    <label for="camiones" class="col-sm-4 col-form-label">Lista de Camiones</label>
                                        
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <div class="col-sm-8">
                                        <input placeholder="-- SELECCIONE CAMION --" class="form-control" list="camiones" name="camiones" id="camion" onchange='mifuncionC(this.value)'>
                                            <datalist id="camiones" >
                                                <?php
                                                    while($valores = mysqli_fetch_array($result)){
                                                        $id = $valores['ID_Fleteros'];
                                                        $placa = $valores['Placa'];
                                                        echo "<option value=$placa></option>";
                                                    }
                                                ?>
                                            </datalist>
                                    </div>
                                </div>
                            </div>
                        </header>
                            <hr>
                            <form action="../../controllers/fletero/ctrl_Camion&chofer.php" method="POST readonly">
                                <div class="row">
                                    <div class="form-group col-sm">
                                        <label for="Placa">Placa:</label>
                                        <input class="form-control" type="text" name="Placa" id="Placa" required readonly>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Capacidad">Capacidad en Toneladas:</label>
                                        <input class="form-control" type="number" name="Capacidad" id="Capacidad" required readonly>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Modelo">Modelo:</label>  
                                        <input class="form-control" type="text" name="Modelo" id="Modelo" required readonly>
                                    </div>
                                </div>
                                
                                    
                            
                                <div class="row justify-content-between" style="margin-left: 10px; margin-top: 25px;">
                                    <div class=" col-md-6 col-sm-12 ">
                                        <div class="row">
                                            <h2>Choferes</h2>
                                            <img class="imagen-titulo" src="../../assets/images/chofer.png" alt="" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                
                                    <div class="form-group  col-md-6 col-sm-12 ">
                                        <div class="row">
                                            <label  class="col-sm-4 col-form-label">Lista de Choferes</label>
                                                
                                            <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                            <div class="chof col-sm-8">
                                                <select id="chofer" disabled class="form-control" onchange='mifuncionCh(this.value)' >
                                                    <option value="">-- SELECCIONE CHOFER --</option>
                                                </select>

                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr> 
                              
                                <div class="row">    
                                    <div class="form-group col-sm">
                                        <label for="Nombre">Nombre:</label>
                                        <input class="form-control" type="text" name ="Nombre" id="Nombre" required readonly>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="Nombre">Apellido:</label>
                                        <input class="form-control" type="text" name ="Apellido" id="Apellido" required readonly>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label for="CI">Cédula de Identidad :</label>
                                        <input class="form-control" type="text" name="CI" id="CI" required readonly>
                                    </div> 
                                </div> 
                                
                                
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                        <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                        value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                        <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                    </div>
                                </div>
                            </form>  
                            
                            <script type="text/javascript">
                            
                            function activarCampos(){
                                var BotonCambiar = document.getElementById('botonCambiar');
                                if(document.getElementById('Modelo').readOnly == false){
                                    BotonCambiar.value="Modificar (Desactivado)";
                                    document.getElementById('Modelo').readOnly=true;
                                    document.getElementById('Capacidad').readOnly=true;
                                    document.getElementById('Nombre').readOnly=true;
                                    document.getElementById('Apellido').readOnly=true;
                                   
                                } else {
                                    BotonCambiar.value="Modificar (Activado)";
                                    document.getElementById('Modelo').readOnly=false;
                                    document.getElementById('Capacidad').readOnly=false;
                                    document.getElementById('Nombre').readOnly=false;
                                
                                    document.getElementById('Apellido').readOnly=false;
                                    
                                }
                                
                            }
                            function mifuncionC(idC){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/fletero/get_datosCamion.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idC : idC },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    // el tipo de información que se espera de respuesta
                                    dataType : 'json',
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        //aqui recibimos el "echo" del php(ajax.php)
                                        //y ahora solo colocas el valor en los campos
                                        $("#Placa").val(json.Placa);
                                      
                                        $("#Capacidad").val(json.Capacidad);
                                        $("#Modelo").val(json.Modelo);
                                      
                                        
                                       
                                        //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
                                        
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert(' Seleccione un camion');
                                        $("#Placa").val("");
                                      
                                        $("#Capacidad").val("");
                                        $("#Modelo").val("");

                                    }
                                })
                            }

                            //proceso para cargar lista de choferes a partir de los camiones
                            //se llama a la funcion que cargara datos a la lista cada vez que el camion cambie

                            $(document).ready(function(){

                                var chofer = $('#chofer');

                                $('#camion').change(function(){
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

                            


                            function mifuncionCh(idCh){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/fletero/get_datosChofer.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idCh : idCh },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    // el tipo de información que se espera de respuesta
                                    dataType : 'json',
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        //aqui recibimos el "echo" del php(ajax.php)
                                        //y ahora solo colocas el valor en los campos
                                       
                                        $("#Nombre").val(json.Nombre);
                                        $("#Apellido").val(json.Apellido);
                                        $("#CI").val(json.Cedula);
                                        
                                        
                                       
                                        //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
                                        
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert(' Seleccione un chofer');
                                        
                                        $("#Nombre").val("");
                                        $("#Apellido").val("");
                                        $("#CI").val("");
                                    }
                                })
                            }
                            

                        </script>
<?php
    include ("../templates/footerFletero.php")
?>