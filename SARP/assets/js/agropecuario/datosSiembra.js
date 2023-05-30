import {validarFormDP} from '../validacion.js';
function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('analisis').disabled == false){
        BotonCambiar.value="Permitir Ingreso (Desactivado)";
        document.getElementById('analisis').disabled=true;
        document.getElementById('ms').readOnly=true;
        document.getElementById('impureza').readOnly=true;
        document.getElementById('kilos').readOnly=true;
    } else if(document.getElementById('analisis').disabled == true && !(document.getElementById('idLote').value == "")) {
        BotonCambiar.value="Permitir Ingreso (Activado)";
        document.getElementById('analisis').disabled=false;
        document.getElementById('ms').readOnly=false;
        document.getElementById('impureza').readOnly=false;
        document.getElementById('kilos').readOnly=false;
    }
    
}

const btn_cambiar = document.getElementById("botonCambiar");
//eventos al dar click al boton de cambiar para hacer los campos editables
btn_cambiar.addEventListener("click",(e)=>{
    e.preventDefault()
    activarCampos()
})

//LLenar lista de la siembra a partir de proveedores
const proveedor = document.getElementById("Proveedor");
proveedor.addEventListener("change", (e)=>{
    
    let siemb = $('#Siembra');
    var IDP = proveedor.value;
    
    
    if(IDP !== ''){
        $.ajax({
            data: {IDP:IDP}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
            dataType: 'html', //tipo de datos que esperamos de regreso
            type: 'POST', //mandar variables como post o get
            url: '../../controllers/agropecuaria/get_listaSiembra.php', //url que recibe las variables
            
            success : function(data) {
           //metodo que se ejecuta cuando ajax ha completado su ejecucion      
           siemb.prop('disabled', false); //habilitar el select       
            document.getElementById('idLote').value="";
            document.getElementById('analisis').value="";
            document.getElementById('ms').value="";
            document.getElementById('impureza').value="";
            document.getElementById('kilos').value="";
               //establecemos el contenido html de siembras con la informacion que regresa ajax    
            siemb.html(data);
        },

            // código a ejecutar si la petición falla;
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
            }
        })

    }else{ //en caso de seleccionar una opcion no valida
        siemb.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
        siemb.prop('disabled', true); //deshabilitar el select
        document.getElementById('idLote').value="";
        document.getElementById('analisis').value="";
        document.getElementById('ms').value="";
        document.getElementById('impureza').value="";
        document.getElementById('kilos').value="";
    }

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

//evento para cargar datos de siembra
const siembra = document.getElementById("Siembra");

siembra.addEventListener("change", (e)=>{
    e.preventDefault()
    mifuncionSM(siembra.value);
})

//evento para enviar datos por fetch
//funcion para enviar datos a la BD con "submit"
const form = document.getElementById('form');

form.addEventListener("submit", (e) =>{
    e.preventDefault()

    //se valida el campo de analisis
    const analisis = document.getElementById("analisis").value;
    if(analisis == ""){
        alert("Seleccion una opcion de analisis");
        
    }else{
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form);
        console.log("listo")
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/agropecuaria/ctrl_addDatosSiembra.php',{
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
    }
    
    
    
    
    
})