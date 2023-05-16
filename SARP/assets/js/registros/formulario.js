// Archivo JS para validar el formulario de register.php

/* const form = document.getElementById('form');
 */
const nombre = document.getElementById("nombre")
const apellido = document.getElementById("apellido")
const cedula = document.getElementById("cedula")
const email = document.getElementById("email")
const password = document.getElementById("password")

const errorName = document.getElementById("errorName")
const errorApellido = document.getElementById("errorApellido")
const errorCedula = document.getElementById("errorCedula")
const errorCorreo = document.getElementById("errorCorreo")
const errorPassword = document.getElementById("errorPassword")



const expresiones = {
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    password: /^.{4,12}$/, // 4 a 12 digitos.
    cedula: /^([VE]-)?\d{6,8}$/i,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

const form = document.getElementById('form');



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

    if(!expresiones.apellido.test(apellido.value)){
        warnings += `El apellido no es valido\n`;
        entrar = true;
        errorApellido.innerHTML = '<b>¡El apellido solo debe contener letras, maximo 40 caracteres!<b>'
        apellido.style.borderColor ='red';
    }
    else
    {
        errorApellido.innerHTML = "";
        apellido.style.borderColor = '';
    }


    if(!expresiones.cedula.test(cedula.value)){
        warnings += `La cedula no es valida\n`;
        entrar = true;
        errorCedula.innerHTML = '<b>¡La cedula debe contener de 6 a 8 numeros. Los formatos pueden ser: V-XXXXXXXX ; E-XXXXXXXX ; XXXXXXXX';
        cedula.style.borderColor ='red';
    }
    else
    {
        errorCedula.innerHTML = ""; 
        cedula.style.borderColor = '';
    }


    if(!expresiones.email.test(email.value)){
        warnings += `El email no es valido\n`;
        entrar = true;
        errorCorreo.innerHTML = '<b>¡El correo no es valido!</b>';
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
                location.reload();
            }else{
                alert(data)
            }
        })
    }    
})
