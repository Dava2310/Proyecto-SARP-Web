//importacion de funcion de validacion
import {validarFormDP} from '../validacion.js';
function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('Nombre').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";
        document.getElementById('Nombre').readOnly=true;
        document.getElementById('Apellido').readOnly=true;
        document.getElementById('tlf').readOnly=true;
        //document.getElementById('email').disabled=true;
        //document.getElementById('Cedula').disabled=true;
        document.getElementById('rif').readOnly=true;
        document.getElementById('direccion').readOnly=true;
    } else {
        BotonCambiar.value="Modificar (Activado)";
        document.getElementById('Nombre').readOnly=false;
        document.getElementById('Apellido').readOnly=false;
        document.getElementById('tlf').readOnly=false;
        //document.getElementById('email').disabled=false;
        //document.getElementById('Cedula').disabled=false;
        document.getElementById('rif').readOnly=false;
        document.getElementById('direccion').readOnly=false;
    }
    
}
const form = document.getElementById('form');
const btn_modificar = document.getElementById('botonCambiar');


form.addEventListener("submit", (e) => {
    
    e.preventDefault()
    //se destruturan los valores en varibales
    const [entrar, warnings] = validarFormDP();
    console.log(entrar);
    
    if(entrar){
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
       
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form);
        console.log("listo")
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/datos_personales/ctrl_datosPersonales.php',{
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
                alert(data);
                location.reload();
            }else{
                alert(data)
            }
        })
        
    }else{
       
        alert(warnings); 
    }
})
// al presionar modificar se activan o desactivan los campos
btn_modificar.addEventListener("click", (e)=>{
    activarCampos()
})