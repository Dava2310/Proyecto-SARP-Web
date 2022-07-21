<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Transporte";
    include('../templates/headFletero.php');
    
    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    } else {
        
        /*
        if((time() - $_SESSION['time']) > 1000000){
            header('location: ../../controllers/salir.php');
            die();
        }
        */
    }
    $result2= $con->query("select Semana,ID_Planificacion from planificaciones;");

   /*  $sql= "SELECT * FROM solicitud_proveedor INNER JOIN siembras ON solicitud_proveedor.ID_Siembra=siembras.ID_Siembra WHERE  solicitud_proveedor.Estado_Aprobacion=1 ; ";
    $result= mysqli_query($con,$sql); */

    $query= "SELECT * FROM usuario WHERE tipo_Usuario = 4; ";
    $result= mysqli_query($con,$query);
    
    //YA AQUI TENGO LOS DATOS DEL USUARIO
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
                            <h2><?=$_titulo?></h2>
                            <img class="imagen-titulo" src="../../assets/images/chofer.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        <form   id="Formulario">
                            <div class="row">
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="semana">Semana</label>
                                    <select  class="form-control "  name="semana" id="semana"  >
                                        <option value=""> --SEMANA-- </option>
                                        <?php
                                            while($valores = mysqli_fetch_array($result2)){
                                                $id = $valores['ID_Planificacion'];
                                                $Semana = $valores['Semana'];
                                                echo "<option value=$id>$Semana</option>";
                                            }
                                        ?>
                                    
                                    </select>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                        <label for="IDLote">ID Lote:</label>
                                        <input  class="form-control" type="text" name="IDLote" id="IDLote" required readonly>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="solicitudes" >Solicitudes aceptadas</label>
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    <select id="solicitudes" name="solicitudes" disabled class="form-control " onchange="cargarArrime(this.value)">
                                            <option value="">-- SELECCIONE SOLICITUD--</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cantidadA">Cantidad a Arrimar:</label>
                                    <input class="form-control" type="text" name="cantidadA" id="cantidadA" required readonly>
                                </div>
                                
                                
                                <div class="form-group col-md-6">
                                    <label for="Fleteros" class="col-sm-4 col-form-label">Lista de Fleteros</label>
                                    
                                    <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                    
                                    <input placeholder="-- SELECCIONE FLETERO --" class="form-control" list="Fleteros" name="Fleteros" id="Fletero" onchange='datosFletero(this.value)' readonly>
                                        <datalist id="Fleteros" >
                                            <?php
                                                while($valores = mysqli_fetch_array($result)){
                                                    $Nombre = $valores['Nombre'];
                                                    $Apellido = $valores['Apellido'];
                                                    $cedula = $valores['Cedula'];
                                                    echo "<option value=$cedula>$Nombre $Apellido</option>";
                                                }
                                            ?>
                                        </datalist>
                                    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="Nombre">Nombre:</label>
                                    <input readOnly class="form-control" type="text" name="Nombre" id="Nombre" required>
                                </div>
                            
                                <div class="form-group col-md-3">
                                    <label for="Apellido">Apellido:</label>
                                    <input readOnly class="form-control" type="text" name="Apellido" id="Apellido" required>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12 ">
                                    
                                        <label for="camiones" class="col-sm-4 col-form-label">Lista de Camiones</label>
                                            
                                        <!-- se coloca el atributo "onchange='mifuncion(this.value)'" para que al momento de cambiar la seleccion llame a la funcion que mostrara los datos del fletero correspondiente -->
                                        
                                        <input placeholder="-- SELECCIONE CAMION --" class="form-control" list="camiones" name="camiones" id="camion"  readonly>
                                            <!-- <datalist id="camiones" >
                                                
                                            </datalist> -->
                                </div>
                                <div class="form-group  col-md-6 col-sm-12 ">
                                    
                                    <label  class="col-sm-4 col-form-label">Capacidad</label>
                                    <input readOnly class="form-control" type="text" name="Capacidad" id="Capacidad" required>
                                    
                                
                                </div>

                            
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil" >Enviar solicitud</button>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            
                            //llenar solicitudes a partir de semana
                            $(document).ready(function(){

                                var soli = $('#solicitudes');

                                $('#semana').change(function(){
                                    var IDS = $(this).val();
                                    
                                    if(IDS !== ''){
                                        $.ajax({
                                            data: {IDS:IDS}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                            dataType: 'html', //tipo de datos que esperamos de regreso
                                            type: 'POST', //mandar variables como post o get
                                            url: '../../controllers/agropecuaria/get_listaSoli.php' //url que recibe las variables
                                        }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                                            soli.prop('disabled', false); //habilitar el select       

                                            soli.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                                            
                                        });

                                    }else{ //en caso de seleccionar una opcion no valida
                                        soli.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                        soli.prop('disabled', true); //deshabilitar el select
                                    }
                                })
                            })

                            function cargarArrime(idso){
                                $.ajax({
                                    url:'../../controllers/proveedor/get_datosSoli.php',
                                     data : { idso : idso },

                                // especifica si será una petición POST o GET
                                type : 'POST',

                                // el tipo de información que se espera de respuesta
                                dataType : 'json',

                                // código a ejecutar si la petición es satisfactoria;
                                success : function(json) {
                                    
                                    $("#cantidadA").val(json.Cantidad_MP);
                                    $("#IDLote").val(json.ID_Siembra);
                                    document.getElementById('Fletero').readOnly=false;
                                    
                                },

                                // código a ejecutar si la petición falla;
                                error : function(xhr, status) {
                                    alert('Disculpe, existió un problema');
                                }

                                })
                            }
                            function datosFletero(idP){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/agropecuaria/get_datoP.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idP : idP },
                        
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
                                        
                                        //ajax para cargar lista de camion del fletero
                                        
                                     

                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                })

                            }

                            $(document).ready(function(){

                                var cam = $('#camion');

                                $('#Fletero').change(function(){
                                    var idP = $(this).val();
                                    
                                    if(idP !== ''){
                                        $.ajax({
                                            data: {idP:idP}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                            dataType: 'html', //tipo de datos que esperamos de regreso
                                            type: 'POST', //mandar variables como post o get
                                            url: '../../controllers/agropecuaria/Get_listaCamion.php' //url que recibe las variables
                                        }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                                            cam.prop('readOnly', false); //habilitar el select       

                                            cam.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                                            
                                        });

                                    }else{ //en caso de seleccionar una opcion no valida
                                        cam.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                        cam.prop('readOnly', true); //deshabilitar el select
                                    }
                                })
                            })

                             //proceso para cargar lista de choferes a partir de los camiones
                            //se llama a la funcion que cargara datos a la lista cada vez que el camion cambie

                            $(document).ready(function(){


                                $('#camion').change(function(){
                                    var idC = $(this).val();
                                    
                                    if(idC !== ''){
                                        $.ajax({
                                            data: {idC:idC}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                            dataType: 'html', //tipo de datos que esperamos de regreso
                                            type: 'POST', //mandar variables como post o get
                                            url: '../../controllers/fletero/get_datosCamion.php', //url que recibe las variables
                                            success : function(json) { //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                                                        
                                                $("#Capacidad").val(json.Capacidad);
                                            },
                                            error : function(xhr, status) {
                                            alert(' Seleccione un camion');
                                            
                                        
                                            $("#Capacidad").val("");
                                           

                                            }
                                        });

                                    }else{ //en caso de seleccionar una opcion no valida
                                        $("#Capacidad").val("");
                                    }
                                })
                            })
                            
                            var form = document.getElementById('Formulario');
                            

                            form.addEventListener('submit', function (e){
                                e.preventDefault();
                                let data = new FormData(form);
                                fetch('../../controllers/agropecuaria/Set_SoliFletero.php',{
                                        method: 'POST',
                                        body:data
                                        

                                    }).then(response => response.json()).then(datas => {

                                       var mensaje = datas;
                                       
                                       alert(mensaje);
                                        
                                        
                                        
                                    })
                            })
                        </script>
<?php
    include ("../templates/footerFletero.php")
?>