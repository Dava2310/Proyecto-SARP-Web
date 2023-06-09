// Formulario de la pagina Recover
const form = document.getElementById("form");

// Campos a validar
const email = document.getElementById("email");

//campos de error
const errorCorreo = document.getElementById("errorCorreo");

// Expresiones regulares
const expresiones = {
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

// Eventos
form.addEventListener("submit", (e) => {
    
    e.preventDefault();

    let entrar = true;
    let warnings = "";

    if (!expresiones.email.test(email.value)){
        warnings += `El Email electrónico no es válido.\n`;
        entrar = false;
        errorCorreo.innerHTML = '<b>¡El Email no es valido! \n Ejemplo de Email valido: xxxx@gmail.com</b>';
        email.style.borderColor ='red';
    }

    if (!entrar) {   
        
        alert(warnings);
    }else{
        
        //se guardan los datos del formulario en formData
        const formData = new FormData(form);
    
        //usamos la API fetch para enviar datos al recuperarPassword.php 
        fetch('../../controllers/registros/verificarEmail.php ',{
            //metodo de envio
            method : 'POST',
            //datos enviados
            body: formData
        })
        //se indica que la respuesta obtenida es en formato json
        .then(response => response.json())
        .then(data => {
            //data contiene la respuesta obtenida de recuperarPassword.php 
            if(data.message == "No se ha encontrado el usuario con estos datos"){
                alert(data.message);
            }else{
                // Redirigir a la pantalla nueva con el ID como parámetro en la URL
                const id = data.id;
                const pregunta = data.pregunta;
                window.location = `../../views/registros/recover_2.php?id=${id}&pregunta=${pregunta}`;

                // alert(data)
            }
        })
        .catch(error => console.error(error));
    }

})