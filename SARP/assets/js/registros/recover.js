// Formulario de la pagina Recover
const form = document.getElementById("form");

// Campos a validar
const email = document.getElementById("email");
const newP = document.getElementById("newP");
const question = document.getElementById("question");
const answer = document.getElementById("answer");

//campos de error
const errorCorreo = document.getElementById("errorCorreo");
const errorPassword = document.getElementById("errorPassword")
const errorPregunta = document.getElementById("errorPregunta");
const errorRespuesta = document.getElementById("errorRespuesta");

// Expresiones regulares
const expresiones = {
    newP: /^.{4,12}$/, // 4 a 12 digitos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    question: /^[a-zA-Z0-9]{2,30}\?$/,
    answer: /^[a-zA-Z0-9]{2,30}/
}

// Eventos
form.addEventListener("submit", (e) => {
    
    let entrar = false;
    let warnings = "";

    if (!expresiones.email.test(email.value)){
        warnings += `El correo electrónico no es válido.\n`;
        entrar = true;
        errorCorreo.innerHTML = '<b>¡El correo no es valido! \n Ejemplo de correo valido: xxxx@gmail.com</b>';
        email.style.borderColor ='red';
    }

    if (!expresiones.newP.test(newP.value)){
        warnings += `La contraseña no es válida.\n`;
        entrar = true;
        errorPassword.innerHTML = '<b>¡La contraseña debe ser de 4 a 12 digitos!</b>';
        newP.style.borderColor ='red';
    }

    if (!expresiones.question.test(question.value)){
        warnings += `La pregunta no es válida.\n`;
        entrar = true;
        errorPregunta.innerHTML = '<b>¡La pregunta debe ser de 4 a 30 caracteres!</b>';
        question.style.borderColor ='red';
    }

    if (!expresiones.answer.test(answer.value)){
        warnings += `La respuesta no es válida.\n`;
        entrar = true;
        errorRespuesta.innerHTML = '<b>¡La respuesta debe ser de 4 a 30 caracteres!</b>';
        answer.style.borderColor ='red';
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