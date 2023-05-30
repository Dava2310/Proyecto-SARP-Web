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
            document.getElementById('Observacion').readonly = false;
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