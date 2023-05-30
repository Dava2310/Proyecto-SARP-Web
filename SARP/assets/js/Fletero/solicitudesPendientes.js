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
            $('#idsoli').val(json.idsoli);
            $('#dias').prop('disabled', false);

            let placa = json.Camion;

            let chofer = $('#chofer');
            $.ajax({
                data: {placa:placa}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/fletero/get_listaChofer.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                chofer.prop('disabled', false) //habilitar el select       

                chofer.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                
            });
       
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

    



}

/* const solicitud = document.getElementById("solicitud");
solicitud.addEventListener("change", (e)=>{
    let placa = document.getElementById("Camion").value;
    console.log(placa);
    let chofer = $('#chofer');
            $.ajax({
                data: {placa:placa}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/fletero/get_listaChofer.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                chofer.prop('disabled', false) //habilitar el select       

                chofer.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                
            });
}) */

/* $(document).ready(function(){

        var chofer = $('#chofer');

        $('#solicitud').click(function(){
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
    }) */

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

    const fechaInput = document.getElementById('dias');
    const fechaSeleccionada = new Date(fechaInput.value);

    if(se === ""){
        alert('Selecione solicitud para aceptar')

    }else if(fechaSeleccionada.toString() === 'Invalid Date'){
        alert('Debes seleccionar una fecha válida.');
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