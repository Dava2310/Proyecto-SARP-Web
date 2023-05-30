//funcion para enviar datos a la BD con "submit"
const form = document.getElementById('form');

form.addEventListener("submit", (e) =>{
    e.preventDefault()

    
    
    
    
    
    //se gguardan los datos del formulario en formData
    const formData = new FormData(form);
    
    //usamos la API fetch para enviar datos al agregarUsuario.php 
    fetch('../../controllers/proveedor/ctrl_addSiembra.php',{
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
            alert("agregado con exito");
            location.reload();
        }else{
            alert(data)
        }
    })
    
})