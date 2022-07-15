<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Planificacion arrime";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    } 

    $usuario= "SELECT ID_Usuario,Cedula FROM usuario WHERE tipo_Usuario = 3; ";
    $result= mysqli_query($con,$usuario);
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
                            <h2>Planificacion de arrime</h2>
                            <img class="imagen-titulo" src="../../assets/images/planificacion.png" alt="" style="width: 50px; height: 50px;">
                        </header>
                        <hr>
                        
                            
                        <form  id="formulario" >
                            <div class="row justify-content-center" id="fase_1">
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="semana">Semana</label>
                                    <input  class="form-control" type="week" name="semana" id="semana" required>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="cantidad">Cantidad:</label>
                                    <input  class="form-control" type="number" name="cantidad" id="cantidad" required>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <button onclick="fase1()" type="submit" class="btn btn-success glyphicon glyphicon-pencil">Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="fase_2" style="display: none;">
                                
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="Proveedores">Proveedores:</label>
                                    <input placeholder="-- SELECCIONE PROVEEDOR --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor" onchange='datosP(this.value)'>
                                        <datalist id="Proveedores" >
                                            <?php
                                                while($valores = mysqli_fetch_array($result)){
                                                    $id = $valores['ID_Usuario'];
                                                    $cedula = $valores['Cedula'];
                                                    echo "<option value=$cedula></option>";
                                                }
                                            ?>
                                        </datalist>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label >Siembra:</label>  
                                    <div class="col-12">
                                        <select id="Siembra" disabled class="form-control " onchange='mifuncionSM(this.value)' >
                                            <option value="">-- SELECCIONE SIEMBRA --</option>
                                        </select>

                                        <!-- <input placeholder="-- SELECCIONE CHOFER --" class="form-control" list="choferes" name="choferes" id="chofer" onchange='mifuncionCh(this.value)'>
                                            <datalist id="choferes" >
                                                <
                                            </datalist> -->
                                    </div>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="Nombre">Nombre</label>  
                                    <input  class="form-control" type="text" name="Nombre" id="Nombre" required readonly>
                                </div>
                            
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="disponibilidad">disponibilidad</label>
                                    <input  class="form-control" type="text" name="disponibilidad" id="disponibilidad" required readonly>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="IDLote">ID Lote:</label>
                                    <input  class="form-control" type="text" name="IDLote" id="IDLote" required readonly>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="SolicitudSiembraStda">Solicitud:</label>  
                                    <input  class="form-control" type="text" name="SolicitudSiembraStda" id="SolicitudSiembraStda" >
                                </div>
                                <div class="row">
                                    <button onclick="fase2()" type="button" class="btn btn-success glyphicon glyphicon-pencil">Agregar</button>
                                </div>
                                
                            </div>
                            <hr>
                            
                            <div class="row" id="fase_3" style="display: none;">
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="SiembraStda">Siembra Solicitada</label>
                                    <input  class="form-control" type="date" name="SiembraStda" id="SiembraStda" required>
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="cantidadtemp">Cantidad temporal:</label>
                                    <input  class="form-control" type="number" name="cantidadtemp" id="cantidadtemp" required>
                                </div>
                                
                            </div>
                            <hr>
                            
                           
                            <div class="row" >
                                <div class="form-group col-md-12">
                                    <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Limpiar</button>
                                    <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Modificar (Desactivado)" style="color: black; font-weight: bold;">
                                    <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                </div>
                            </div>
                            
                        </form>
                        <script>
                        //------ EJECUCION AGREGAR FASE 1 --------
                            function fase1(){
                                var sem = document.querySelector('#semana').value;
                                var cda = document.querySelector('#cantidad').value;

                                if(  sem === "" || cda === null  ){
                                    alert('rellene los campos correspondientes');
                                }else{

                                    document.getElementById('fase_2').style.display="flex";
                                    document.getElementById('semana').readOnly=true;
                                    document.getElementById('cantidad').readOnly=true;

                                    let form = document.getElementById('formulario');
                                    let data = new FormData(form);

                                    fetch('../../controllers/agropecuaria/set_datosFase1.php',{
                                        method: 'POST',
                                        body:data
                                        

                                    })
                                }
                                
                            }
                            //-------- OBTENER DATOS DE LOS PROVEEDORES PARA LISTA DESPLEGABLE-----
                            function datosP(idP){
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
                                        $("#Nombre").val(json.Nombre + " " +json.Apellido);
                                        
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                })

                            }

                            //--------LLENAR LISTA SIEMBRA A PARTIR DE LISTA PROVEEDORES-------------------
                            $(document).ready(function(){

                                var siemb = $('#Siembra');

                                $('#Proveedor').change(function(){
                                    var IDP = $(this).val();
                                    
                                    if(IDP !== ''){
                                        $.ajax({
                                            data: {IDP:IDP}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                            dataType: 'html', //tipo de datos que esperamos de regreso
                                            type: 'POST', //mandar variables como post o get
                                            url: '../../controllers/agropecuaria/get_listaSiembra.php' //url que recibe las variables
                                        }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                                            siemb.prop('disabled', false); //habilitar el select       

                                            siemb.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                                            
                                        });

                                    }else{ //en caso de seleccionar una opcion no valida
                                        siemb.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                        siemb.prop('disabled', true); //deshabilitar el select
                                    }
                                })
                            })
                           
                            //---------CARGAR DATOS DE LA LISTA SIEMBRA-----
                            function mifuncionSM(idS){
                                $.ajax({
                                    // la URL para la petición
                                    url : '../../controllers/proveedor/get_datoSiembra.php',
                        
                                    // la información a enviar en este caso el valor de lo que seleccionaste en el select
                                    data : { idS : idS },
                        
                                    // especifica si será una petición POST o GET
                                    type : 'POST',
                        
                                    // el tipo de información que se espera de respuesta
                                    dataType : 'json',
                        
                                    // código a ejecutar si la petición es satisfactoria;
                                    success : function(json) {
                                        
                                        $("#IDLote").val(json.ID_Siembra);
                                        $("#disponibilidad").val(json.Kilos_Totales);
                                       
                                       
                                        //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
                                        
                                    },
                        
                                    // código a ejecutar si la petición falla;
                                    error : function(xhr, status) {
                                        alert('Disculpe, existió un problema');
                                    }
                                })

                            }

                           //------ EJECUCION AGREGAR FASE 2 --------
                            function fase2(){
                                
                                var Proveedor = document.querySelector('#Proveedor').value;
                                var Siembra = document.querySelector('#Siembra').value;
                                var Nombre = document.querySelector('#Nombre').value;
                                var disponibilidad = document.querySelector('#disponibilidad').value;
                                var IDLote = document.querySelector('#IDLote').value;
                                var SolicitudSiembraStda = document.querySelector('#SolicitudSiembraStda').value;
                                var cda = document.querySelector('#cantidad').value;
                                if(
                                    Proveedor == null || Siembra == '' || Nombre == '' || disponibilidad == '' || IDLote =='' || SolicitudSiembraStda == '' 
                                ){
                                    alert('rellene los campos correspondientes');

                                }else if (SolicitudSiembraStda > cda || SolicitudSiembraStda > disponibilidad){
                                    alert('Cantidad de MP solicitada no admisible');

                                }else{
                                    document.getElementById('fase_3').style.display="flex";
                                    
                                }


                            }
                        </script>
                            
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>