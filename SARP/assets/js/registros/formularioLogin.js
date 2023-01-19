const form = document.getElementById("form")
const email = document.getElementById("email")
const password = document.getElementById("password")

const expresiones = {
    password: /^.{4,12}$/, // 4 a 12 digitos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

form.addEventListener("submit", e=>{

    let entrar = false;
    let warnings = "";

    //console.log(nombre.value)
    alert(email.value)
    
    if(!expresiones.email.test(email.value)){
        //alert("hola")
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