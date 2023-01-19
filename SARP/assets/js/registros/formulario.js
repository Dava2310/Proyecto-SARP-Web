const form = document.getElementById("form")

const nombre = document.getElementById("nombre")
const apellido = document.getElementById("apellido")
const cedula = document.getElementById("cedula")
const email = document.getElementById("email")
const password = document.getElementById("password")

const expresiones = {
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    password: /^.{4,12}$/, // 4 a 12 digitos.
    cedula: /^([VE]-)?\d{1,8}$/i,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

form.addEventListener("submit", e=> {
    
    let entrar = false;
    let warnings = "";

    console.log(nombre.value)

    if(!(expresiones.nombre.test(nombre.value))){
        
        warnings += `El nombre no es valido\n`;
        entrar = true;
    }
    if(!expresiones.apellido.test(apellido.value)){
        warnings += `El apellido no es valido\n`;
        entrar = true;
    }
    if(!expresiones.cedula.test(cedula.value)){
        warnings += `La cedula no es valida\n`;
        entrar = true;
    }
    if(!expresiones.email.test(email.value)){
        warnings += `El email no es valido\n`;
        entrar = true;
    }
    if(!expresiones.password.test(password.value)){
        warnings += `La contraseña no es valida\n`;
        entrar = true;
    }
    
    if(entrar){
        e.preventDefault()
        alert(warnings);
        //location.reload()
    } 
})