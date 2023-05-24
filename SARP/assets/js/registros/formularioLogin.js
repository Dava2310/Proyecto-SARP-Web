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

    //se valida que el Email este escrito de forma valida
    
    if(!expresiones.email.test(email.value)){
        //alert("hola")
        warnings += `El email no es valido\n`;
        entrar = true;
        errorCorreo.innerHTML = '<b>¡El Email no es valido! \n Ejemplo de Email valido: xxxx@gmail.com</b>';
        email.style.borderColor ='red';
    }
    
    if(entrar){
        e.preventDefault()
        alert(warnings);
        //location.reload()
    } else{
         //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch
        
        e.preventDefault();
        //se gguardan los datos del formulario en formData
        const formData = new FormData(form);

        //usamos la API fetch para enviar datos al validarUsuario.php 
        fetch('../../controllers/registros/validarUsuario.php',{
            //metodo de envio
            method : 'POST',
            //datos enviados
            body: formData
        })
        //se indica que la respuesta obtenida es en formato json
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Inicio de sesión exitoso') {
                
                switch(formData.get('tipoUsuario')){
                    case '1':
                        window.location='../../views/contraloria/datosPersonales.php';
                        break;
                    case '2':
                        window.location= '../../views/agropecuaria/datosPersonales.php';
                        break;
                    case '3':
                        window.location='../../views/proveedor/datosPersonales.php'
                        break;
                    case '4':
                        window.location='../../views/fletero/datosPersonales.php'
                        break;
                    default:
                        window.location='../../views/registros/login.php'; 
                        window.alert('No se ha logrado identificar el tipo de Usuario Ingresado');
                }
            } else {
                alert('Credenciales de inicio de sesión incorrectas');
            }
        })
        .catch(error => console.error(error));
            
    }
})