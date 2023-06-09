// Formulario de la pagina Recover
const form = document.getElementById("form");

// Campos a validar
const email = document.getElementById("email");
const newP = document.getElementById("newP");
const question = document.getElementById("question");
const answer = document.getElementById("answer");
const newP2 = document.getElementById("newP2");

//campos de error
const errorCorreo = document.getElementById("errorCorreo");
const errorPassword = document.getElementById("errorPassword");
const errorPassword2 = document.getElementById("errorPassword2")
const errorPregunta = document.getElementById("errorPregunta");
const errorRespuesta = document.getElementById("errorRespuesta");
const coincidencia = document.getElementById("coincidencia");


// Expresiones regulares
const expresiones = {
    newP: /^.{4,12}$/, // 4 a 12 digitos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    question: /^\¿.{4,58}\?$/,
    answer: /^[a-zA-Z0-9]{4,30}/
}

// Eventos
window.addEventListener('DOMContentLoaded', (event) => {
    // Obtener el ID del usuario de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const pregunta = urlParams.get('pregunta');

    // Asignar el ID al campo de email y deshabilitarlo
    email.value = id;
    email.readOnly = true;

    question.value = pregunta;
    question.readOnly = true;
});

form.addEventListener("submit", (e) => {
    
    let entrar = false;
    let warnings = "";

    if (!expresiones.email.test(email.value)){
        warnings += `El Email electrónico no es válido.\n`;
        entrar = true;
        errorCorreo.innerHTML = '<b>¡El Email no es valido! \n Ejemplo de Email valido: xxxx@gmail.com</b>';
        email.style.borderColor ='red';
    }
    else
    {
        errorCorreo.innerHTML = "";
        email.style.borderColor = '';
    }

    if (!expresiones.newP.test(newP.value)){
        warnings += `La contraseña no es válida.\n`;
        entrar = true;
        errorPassword.innerHTML = '<b>¡La contraseña debe ser de 4 a 12 digitos!</b>';
        newP.style.borderColor ='red';
    }
    else
    {
        errorPassword.innerHTML = "";
        newP.style.borderColor = '';
    }

    if (!expresiones.newP.test(newP2.value)){
        warnings += `La contraseña no es válida.\n`;
        entrar = true;
        errorPassword2.innerHTML = '<b>¡La contraseña debe ser de 4 a 12 digitos!</b>';
        newP2.style.borderColor ='red';
    }
    else
    {
        errorPassword2.innerHTML = "";
        newP2.style.borderColor = '';
    }
    
    if (!expresiones.question.test(question.value)){
        warnings += `La pregunta no es válida.\n`;
        entrar = true;
        errorPregunta.innerHTML = '<b>¡La pregunta debe ser de 4 a 30 caracteres!</b>';
        question.style.borderColor ='red';
    }
    else
    {
        errorPregunta.innerHTML = "";
        question.style.borderColor = '';
    }

    if (!expresiones.answer.test(answer.value)){
        warnings += `La respuesta no es válida.\n`;
        entrar = true;
        errorRespuesta.innerHTML = '<b>¡La respuesta debe ser de 4 a 30 caracteres!</b>';
        answer.style.borderColor ='red';
    }
    else
    {
        errorRespuesta.innerHTML = "";
        answer.style.borderColor = '';
    }

    // Verificar que ambas contraseñas sean iguales
    if ((newP.value != newP2.value))
    {
        warnings += `Las contraseñas no coinciden.\n`;
        entrar = true;
        coincidencia.innerHTML = '<b>¡Las contraseñas deben coincidir!</b>';
        
        newP.style.borderColor = 'red';
        newP2.style.borderColor = 'red';
    }
    else
    {
        coincidencia.innerHTML = "";
        newP.style.borderColor = '';
        newP2.style.borderColor = '';
    }

    if (entrar) {
        e.preventDefault();
        alert(warnings);
    }else{
        e.preventDefault();
        //se guardan los datos del formulario en formData
        const formData = new FormData(form);
    
        //usamos la API fetch para enviar datos al recuperarPassword.php 
        fetch('../../controllers/registros/recuperarPassword.php ',{
            //metodo de envio
            method : 'POST',
            //datos enviados
            body: formData
        })
        //se indica que la respuesta obtenida es en formato json
        .then(response => response.json())
        .then(data => {
            //data contiene la respuesta obtenida de recuperarPassword.php 
            if(data == "Contraseña recuperada con éxito."){
                alert(data);
                window.location="../../views/registros/login.php"
            }else{
                alert(data)
            }
        })
        .catch(error => console.error(error));
    }

})