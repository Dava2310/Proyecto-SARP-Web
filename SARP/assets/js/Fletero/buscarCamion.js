import {validarFormCamion,validarFormDP } from '../validacion.js';

function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('Nombre').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";  
        document.getElementById('Nombre').readOnly=true;
        document.getElementById('Apellido').readOnly=true;
       
    } else {
        BotonCambiar.value="Modificar (Activado)";
        document.getElementById('Nombre').readOnly=false;
        document.getElementById('Apellido').readOnly=false;
        
    }
    
}

const botonCambiar = document.getElementById("botonCambiar");
botonCambiar.addEventListener("click",(e)=>{
    e.preventDefault()
    activarCampos()
})

function activarCamposC(){
    var BotonCambiar = document.getElementById('botonCambiarC');
    if(document.getElementById('Modelo').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";
        document.getElementById('Modelo').readOnly=true;
        document.getElementById('Capacidad').readOnly=true;
        
       
    } else {
        BotonCambiar.value="Modificar (Activado)";
        document.getElementById('Modelo').readOnly=false;
        document.getElementById('Capacidad').readOnly=false;
        
        
    }
    
}

const botonCambiarC = document.getElementById("botonCambiarC");
botonCambiarC.addEventListener("click",(e)=>{
    e.preventDefault()
    activarCamposC()
})

//cargar datos de camiuon
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

const listaCamion = document.getElementById("camion");
listaCamion.addEventListener("change", (e)=>{
    e.preventDefault();
    mifuncionC(listaCamion.value);
})


//cargar datos chofer
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
            $("#Cedula").val(json.Cedula);
            
            
            //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert(' Seleccione un chofer');
            
            $("#Nombre").val("");
            $("#Apellido").val("");
            $("#Cedula").val("");
        }
    })
}
const Chofer = document.getElementById("Chofer");
Chofer.addEventListener("change", (e)=>{
    e.preventDefault();
    mifuncionCh(Chofer.value);
})

//submit datos
const form_Camion = document.getElementById("form_Camion");
form_Camion.addEventListener("submit", (e)=>{
    e.preventDefault();

     //se llama la funcion de valiurdar se destruturan los valores en varibales
    const [entrar, warnings] = validarFormCamion();
    console.log(entrar);
    if(entrar){
         //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
         //se gguardan los datos del formulario en formData
        const formData = new FormData(form_Camion);
         //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/fletero/ctrl_actualizarCamion.php',{
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
                alert("Camion modificado con exito");
            }else{
                alert("Error")
            }
        })
        
    }else{
        
        alert(warnings); 
    }
})

const form_Chofer = document.getElementById("form_Chofer");
form_Chofer.addEventListener("submit", (e)=>{
    e.preventDefault()
    //se destruturan los valores en varibales
    const [entrar, warnings] = validarFormDP();
    console.log(entrar);
    
    if(entrar){
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
       
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form_Chofer);
        
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/fletero/ctrl_actualizarChofer.php',{
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
                alert("Chofer modificado con exito");
                
            }else{
                alert("error")
            }
        })
        
    }else{
       
        alert(warnings); 
    }
})

//asignar chofer al camion
const btn_asignar = document.getElementById("asignar");
btn_asignar.addEventListener("click", (e)=>{
    e.preventDefault;

    const form_Camion = document.getElementById("form_Camion");
    const form_Chofer = document.getElementById("form_Chofer");
    //se destruturan los valores en varibales
    const [entrar, warnings] = validarFormDP();
    const [entrarC, warningsC] = validarFormCamion();
    
    
    if(entrar & entrarC){
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
       
        //se gguardan los datos del formulario en formData
        const form_C = new FormData(form_Camion);
        const form_Ch = new FormData(form_Chofer);
        
        // Combina los datos de los dos formularios en un solo objeto FormData
        for (const [clave, valor] of form_Ch.entries()) {
            form_C.append(clave, valor);
        }
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/fletero/ctrl_asignarChofer.php',{
            //metodo de envio
            method : 'POST',
            //datos enviados
            body: form_C
        })
        //se indica que la respuesta obtenida es en formato json
        .then(response => response.json())
        .then(data => {
            //data contiene la respuesta obtenida de agregarUsuario.php
            if(data == "agregado con exito"){
                alert("Chofer asignado con exito");
                
            }else{
                alert("error")
            }
        })
        
    }else{
       
        alert(warnings + warningsC); 
    }
})
