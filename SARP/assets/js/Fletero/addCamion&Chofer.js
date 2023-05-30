import {validarFormCamion,validarFormDP } from '../validacion.js';

const form_Camion = document.getElementById("form_Camion");
form_Camion.addEventListener("submit", (e)=>{
    e.preventDefault()
    //se destruturan los valores en varibales
    const [entrar, warnings] = validarFormCamion();
    console.log(entrar);
    
    if(entrar){
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
       
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form_Camion);
        console.log("listo")
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/fletero/ctrl_addCamion.php',{
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
                alert("Camion registrado con exito");
                
            }else{
                alert("Ya existe")
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
        console.log("listo")
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/fletero/ctrl_addChofer.php',{
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
                alert("Chofer registrado con exito");
                
            }else{
                alert(data)
            }
        })
        
    }else{
       
        alert(warnings); 
    }
})