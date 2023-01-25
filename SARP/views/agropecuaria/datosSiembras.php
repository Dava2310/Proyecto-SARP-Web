<?php

    session_start();
    $usuario = $_SESSION['ID'];
    $n = 3;

    $_titulo = "Datos de Siembras";
    include('../templates/headFletero.php');

    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();
    
    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }

    //se seleccionan todos los datos de los usuarios que sean de tipo proveedor
    $usuario = "SELECT ID_Usuario,Cedula FROM usuario WHERE tipo_Usuario = $n;";
    $result = mysqli_query($con, $usuario);
    //YA AQUI TENGO TODOS LOS DATOS DEL USUARIO
?>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php
                include("../templates/menuAgropecuaria.php");
            ?>

            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                <div class="contenidoInterno" style="padding-top: 25px;">
                    <header class="row justify-content-between" style="margin-left: 10px;">
                        
                        <div class=" col-md-6 col-sm-12">
                            <h2>Designar muestra</h2> 
                            <img class="imagen-titulo" src="../../assets/images/siembra.png" alt="" style="width: 50px; height: 50px;">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="row">
                                <label for="Proveedor" class="col-sm-4 col-form-label">Lista de Proveedor</label>
                                <div class="col-sm-8">
                                    <input placeholder="-- SELECCIONE PROVEEDOR --" class="form-control" list="Proveedores" name="Proveedores" id="Proveedor" onchange='mifuncion(this.value)'>
                                    <datalist id="Proveedores">
                                        <?php
                                            while($valores = mysqli_fetch_array($result)){
                                                $id = $valores['ID_Usuario'];
                                                $cedula = $valores['Cedula'];
                                                echo "<option value=$cedula></option>";
                                            }
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </header>
                    <hr>
                    <form action="../../controllers/agropecuaria/ctrl_addDatosSiembra.php" method="POST">
                        <div class="row">
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <label for="siembras">Siembras del Proveedor:</label>
                                <select id="Siembra" disabled class="form-control " onchange='mifuncionSM(this.value)' >
                                            <option value="">-- SELECCIONE SIEMBRA --</option>
                                </select>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="idLote">ID de la Siembra:</label>
                                <input class="form-control" type="text" name ="idLote" id="idLote" readOnly>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-top: 8px;">
                            <h2>Datos de la muestra</h2> 
                            <!-- <img class="imagen-titulo"src="../../assets/images/bank.png" alt="" style="width: 50px; height: 50px;"> -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="analisis">Análisis de la Muestra:</label>
                                <input class="form-control" type="text" name ="analisis" id="analisis" required readOnly>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="ms">% de Materia Seca:</label>
                                <input class="form-control" type="number" name ="ms" id="ms" required readOnly>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="impureza">% de Impureza:</label>
                                <input class="form-control" type="number" name ="impureza" id="impureza" required readOnly>
                            </div>
                            <div class="form-group col-md col-sm-12 col-12">
                                <label for="kilos">Cant. Kilos de la Muestra:</label>
                                <input class="form-control" type="number" name ="kilos" id="kilos" required readOnly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="reset" class="btn btn-warning glyphicon glyphicon-pencil">Deshacer</button>
                                <button type="submit" class="btn btn-success glyphicon glyphicon-pencil">Guardar Cambios</button>
                                <input id="botonCambiar" type="" onclick="activarCampos()" class="btn btn-primary glyphicon glyphicon-pencil" 
                                    value="Permitir ingreso (Desactivado)" style="color: black; font-weight: bold;">
                            </div>
                        </div>
                    </form>
                    <script>

                            function activarCampos(){
                                var BotonCambiar = document.getElementById('botonCambiar');
                                if(document.getElementById('analisis').readOnly == false){
                                    BotonCambiar.value="Permitir Ingreso (Desactivado)";
                                    document.getElementById('analisis').readOnly=true;
                                    document.getElementById('ms').readOnly=true;
                                    document.getElementById('impureza').readOnly=true;
                                    document.getElementById('kilos').readOnly=true;
                                } else if(document.getElementById('analisis').readOnly == true && !(document.getElementById('idLote').value == "")) {
                                    BotonCambiar.value="Permitir Ingreso (Activado)";
                                    document.getElementById('analisis').readOnly=false;
                                    document.getElementById('ms').readOnly=false;
                                    document.getElementById('impureza').readOnly=false;
                                    document.getElementById('kilos').readOnly=false;
                                }
                                
                            }

                        //LLenar lista de la siembra a partir de proveedores
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

                                if(document.getElementById('Siembra').value == ""){
                                    document.getElementById('idLote').value="";
                                    document.getElementById('analisis').value="";
                                    document.getElementById('ms').value="";
                                    document.getElementById('impureza').value="";
                                    document.getElementById('kilos').value="";
                                } else {
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
                                        
                                        $("#idLote").val(json.ID_Siembra);
                                        $("#analisis").val(json.Analisis);
                                        $("#ms").val(json.MateriaSeca);
                                        $("#impureza").val(json.Impureza);
                                        $("#kilos").val(json.KilosMuestra);
                                        //$("#disponibilidad").val(json.Kilos_Totales);

                                        //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
                                        
                                    },
                        
                                        // código a ejecutar si la petición falla;
                                        error : function(xhr, status) {
                                            alert('Disculpe, existió un problema');
                                        }
                                    })
                                }

                                

                            }
                    

                    </script> 
                    
<?php
    include ("../templates/footerFletero.php")
?>