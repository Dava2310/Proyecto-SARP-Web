function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('kilosA').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";
        document.getElementById('kilosA').readOnly=true;
        document.getElementById('saldoR').readOnly=true;
        document.getElementById('variedad').readOnly=true;
        //document.getElementById('email').disabled=true;
        //document.getElementById('Cedula').disabled=true;
        document.getElementById('kilosT').readOnly=true;
        document.getElementById('fechaC').readOnly=true;
        document.getElementById('hectareas').readOnly=true;
    } else {
        BotonCambiar.value="Modificar (Activado)";
        document.getElementById('kilosA').readOnly=false;
        document.getElementById('saldoR').readOnly=false;
        document.getElementById('variedad').readOnly=false;
        //document.getElementById('email').disabled=false;
        //document.getElementById('Cedula').disabled=false;
        document.getElementById('kilosT').readOnly=false;
        document.getElementById('fechaC').readOnly=false;
        document.getElementById('hectareas').readOnly=false;
    }
    
}

//al seleccionar siembra se rellenan los campos
function mifuncion(idS){
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
            
            $("#fechaI").val(json.Fecha_Inicio);
            $("#kilosA").val(json.Kilos_Arrimados);
            $("#saldoR").val(json.Saldo_Restante);
            $("#variedad").val(json.Variedad);
            $("#idLote").val(json.ID_Siembra);
            $("#kilosT").val(json.Kilos_Totales);
            $("#fechaC").val(json.Fecha_Cosecha);
            $("#hectareas").val(json.Hectareas);
            $("#analisis").val(json.Analisis);
            $("#materiaS").val(json.MateriaSeca);
            $("#impureza").val(json.Impureza);
            $("#kilos").val(json.KilosMuestra);
            //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })
}

//eliminar siembra
function mifuncionEliminar(idS){
    if(confirm('¿Seguro de eliminar?')){
        $.ajax({
        // la URL para la petición
        url : '../../controllers/proveedor/ctrl_eliminarSiembra.php',

        // la información a enviar en este caso el valor de lo que seleccionaste en el select
        data : { idS : idS },

        // especifica si será una petición POST o GET
        type : 'POST',

        

        // código a ejecutar si la petición es satisfactoria;
        success : function(json) {
            alert('eliminada con exito');
            location.reload();
            /* window.location='../../views/proveedor/consultarSiembra.php'; */
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
        })

    }else{
        /* header("location: ../../views/proveedor/consultarSiembra.php"); */

        

    }
    


}

//funcion para enviar datos a la BD con "submit"
const form = document.getElementById('form');

form.addEventListener("submit", (e) =>{
    e.preventDefault()
    //se gguardan los datos del formulario en formData
    const formData = new FormData(form);
    
    //usamos la API fetch para enviar datos al agregarUsuario.php 
    fetch('../../controllers/proveedor/ctrl_consultarSiembra.php',{
        //metodo de envio
        method : 'POST',
        //datos enviados
        body: formData
    })
    //se indica que la respuesta obtenida es en formato json
    .then(response => response.json())
    .then(data => {
        //data contiene la respuesta obtenida de agregarUsuario.php
        if(data == "agregado con exito"){
            alert("Modificado con exito");
            location.reload();
        }else{
            alert(data)
        }
    })
})