import {validarFormDP} from '../validacion.js';
function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('espacio').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";
        document.getElementById('espacio').readOnly=true;
        document.getElementById('direccion').readOnly=true;
      
    } else {
        BotonCambiar.value="Modificar (Activado)";
        document.getElementById('espacio').readOnly=false;
        document.getElementById('direccion').readOnly=false;
   
    }
    
}

const btn_cambiar = document.getElementById("botonCambiar");
//eventos al dar click al boton de cambiar para hacer los campos editables
btn_cambiar.addEventListener("click",(e)=>{
    e.preventDefault();
    activarCampos();
})

//enviar datos 

const form = document.getElementById("form");

form.addEventListener("submit", (e)=>{
    
    e.preventDefault()

    const direccion = document.getElementById("direccion");

    let entrar= true;
    let warnings = "";

    const expresiones = {
        nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
        Apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        password: /^.{4,12}$/, // 4 a 12 digitos.
        Cedula: /^([VE]-)?\d{6,9}$/i,
        email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        telefono: /^(?:\+58)?[2469]\d{9}$/, // numero de telefono formato venezuela, con +58 mas 10 digitos
        direccion: /^[a-zA-Z0-9\sáéíóúñÑ#\-\.]+$/,
        nrocta : /^[0-9]{20}$/
    }

    if(!expresiones.direccion.test(direccion.value)){
        warnings += `El formato de direccion no es valido\n`;
        entrar = false;
        errorDir.innerHTML = '<b>Signos usados para direccion no validos </b>';
        direccion.style.borderColor ='red';
    }else{
        
        errorDir.innerHTML = '';
        direccion.style.borderColor ='black';
    }

    if(entrar){
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
       
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form);
        
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/proveedor/ctrl_datosTerreno.php',{
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
    }else{
        alert(warnings)
    }
})