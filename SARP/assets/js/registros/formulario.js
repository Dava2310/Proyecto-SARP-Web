// Archivo JS para validar el formulario de register.php

/* const form = document.getElementById('form');
 */

// ========================= Campos a validar ==================
const nombre = document.getElementById("nombre")
const Apellido = document.getElementById("Apellido")
const Cedula = document.getElementById("Cedula")
const email = document.getElementById("email")
const password = document.getElementById("password")
const togglePassword = document.getElementById("togglePassword");
const togglePassword2 = document.getElementById("togglePassword2");
const password2 = document.getElementById("password2")

// ========================= Campos de error ==================
const errorName = document.getElementById("errorName")
const errorApellido = document.getElementById("errorApellido")
const errorCedula = document.getElementById("errorCedula")
const errorCorreo = document.getElementById("errorCorreo")
const errorPassword = document.getElementById("errorPassword")
const errorPassword2 = document.getElementById("errorPassword2")
const coincidencia = document.getElementById("coincidencia")

const expresiones = {
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	Apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    password: /^.{4,12}$/, // 4 a 12 digitos.
    Cedula: /^([VE]-)?\d{6,8}$/i,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

const form = document.getElementById('form');

togglePassword.addEventListener("click", function(e) {

    e.preventDefault();

    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }

});

togglePassword2.addEventListener("click", function(e) {

    e.preventDefault();

    if (password2.type === "password") {
        password2.type = "text";
    } else {
        password2.type = "password";
    }

});

form.addEventListener("submit", (e) => {
    
    let entrar = false;
    let warnings = "";

    if(!(expresiones.nombre.test(nombre.value))){
        
        warnings += `El nombre no es valido\n`;
        entrar = true;
        errorName.innerHTML = '<b>¡El nombre solo debe contener letras, maximo 40 caracteres!<b>'
        nombre.style.borderColor = 'red';
    }
    else
    {
        errorName.innerHTML = "";
        nombre.style.borderColor = '';
    }

    if(!expresiones.Apellido.test(Apellido.value)){
        warnings += `El Apellido no es valido\n`;
        entrar = true;
        errorApellido.innerHTML = '<b>¡El Apellido solo debe contener letras, maximo 40 caracteres!<b>'
        Apellido.style.borderColor ='red';
    }
    else
    {
        errorApellido.innerHTML = "";
        Apellido.style.borderColor = '';
    }


    if(!expresiones.Cedula.test(Cedula.value)){
        warnings += `La Cedula no es valida\n`;
        entrar = true;
        errorCedula.innerHTML = '<b>¡La Cedula debe contener de 6 a 8 numeros. Los formatos pueden ser: V-XXXXXXXX ; E-XXXXXXXX ; XXXXXXXX';
        Cedula.style.borderColor ='red';
    }
    else
    {
        errorCedula.innerHTML = ""; 
        Cedula.style.borderColor = '';
    }


    if(!expresiones.email.test(email.value)){
        warnings += `El email no es valido\n`;
        entrar = true;
        errorCorreo.innerHTML = '<b>¡El Email no es valido!</b>';
        email.style.borderColor ='red';
    }
    else
    {
        errorCorreo.innerHTML = "";
        email.style.borderColor = '';
    }

    if(!expresiones.password.test(password.value)){
        warnings += `La contraseña no es valida\n`;
        entrar = true;
        errorPassword.innerHTML = '<b>¡La contraseña debe ser de 4 a 12 digitos!</b>';
        password.style.borderColor ='red';
    }
    else
    {
        errorPassword.innerHTML = "";
        password.style.borderColor = '';
    }
    
    if(!expresiones.password.test(password2.value)){
        warnings += `La contraseña no es valida\n`;
        entrar = true;
        errorPassword2.innerHTML = '<b>¡La contraseña debe ser de 4 a 12 digitos!</b>';
        password2.style.borderColor ='red';
    }
    else
    {
        errorPassword2.innerHTML = "";
        password2.style.borderColor = '';
    }

    if (password.value != password2.value)
    {
        warnings += "Las contraseñas no son iguales";
        entrar = true;
        coincidencia.innerHTML = "<b>Las contraseñas deben coincidir!</b>";
        password.style.borderColor = 'red';
        password2.style.borderColor = 'red';
    }
    else
    {
        coincidencia.innerHTML = "";
        password.style.borderColor = '';
        password2.style.borderColor = '';
    }

    // Si la variable entrar es true, no se direcciona hacia el servidor
    if(entrar){
        e.preventDefault()
        alert(warnings);
        //location.reload()
    }else{
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
        e.preventDefault();
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form);
    
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/registros/agregarUsuario.php',{
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
                // location.reload();
                window.location = '../../views/registros/login.php';
            }else{
                alert(data)
            }
        })
    }    
})
