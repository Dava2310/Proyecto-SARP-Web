// Formulario de la pagina Recover
const form = document.getElementById('form');

// Campos a validar
const email = document.getElementById('email');
const newP = document.getElementById('newP');
const question = document.getElementById('question');
const answer = document.getElementById('answer');

// Expresiones regulares
const expresiones = {
    newP: /^.{4,12}$/, // 4 a 12 digitos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    question: /^[a-zA-Z0-9]{4,30}/,
    answer: /^[a-zA-Z0-9]{4,30}/
}

// Eventos
form.addEventListener('submit', (e) => {
    
    let entrar = false;
    let warnings = "";

    if (!expresiones.email.test(email.value)){
        warnings += "El correo electrónico no es válido.\n";
        entrar = true;
    }

    if (!expresiones.newP.test(newP.value)){
        warnings += "La contraseña no es válida.\n";
        entrar = true;
    }

    if (!expresiones.question.test(question.value)){
        warnings += "La pregunta no es válida.\n";
        entrar = true;
    }

    if (!expresiones.answer.test(answer.value)){
        warnings += "La respuesta no es válida.\n";
        entrar = true;
    }

    if (entrar) {
        e.preventDefault();
        alert(warnings);
    }

})