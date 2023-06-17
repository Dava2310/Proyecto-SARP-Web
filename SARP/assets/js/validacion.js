
//validacion de datos personales
export function validarFormDP(){
    const nombre = document.getElementById("Nombre");
    const Apellido = document.getElementById("Apellido");
    const Cedula = document.getElementById("Cedula");
    const email = document.getElementById("Email");
    const rif = document.getElementById("rif");
    const tlf = document.getElementById("tlf");
    const direccion = document.getElementById("direccion");
    
    //posibles datos bancarios personal
    const nrocta = document.getElementById("numcuenta");
    const tipo_Cta = document.getElementById("TpoCuenta-A");
    const banco = document.getElementById("Banco-A");
    //datos bancarios autorizados
    

    const CtaP_A = document.getElementById("ctaP&A");
   
    let Nombre_A = "";
    let ApellidoA = "";

    if(!(CtaP_A == null)){
        //si el tippo de cuenta bancario es autorizada obtener nombre y apellido del autorizado, sino que se quede en blanco
        if(CtaP_A.value == "AUTORIZADA"){
            Nombre_A = document.getElementById("NombreA");
            ApellidoA = document.getElementById("ApellidoA");
        }
    }

    //lista de bancos
    const lista_bancos = ["BANCO NACIONAL DE CRÉDITO", "BANCO DEL CARIBE", "BANCO DEL TESORO", "BANCO EXTERIOR","BANCO CARONÍ","BANCO DE VENEZUELA","BANESCO BANCO UNIVERSAL","BANCO PROVINCIAL", "BANCAMIGA BANCO UNIVERSAL", "BANCO MERCANTIL" ] ;
    // lista de tipos de cuentas
    const lista_Tipo = ["AHORRO","CORRIENTE"];
    
    //errores
    const errorName = document.getElementById("errorName")
    const errorApellido = document.getElementById("errorApellido")
    const errorCedula = document.getElementById("errorCedula")
    const errorCorreo = document.getElementById("errorCorreo")
    

    const expresiones = {
        nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
        Apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        password: /^.{4,12}$/, // 4 a 12 digitos.
        Cedula: /^([VEJPG]-)?\d{6,9}$/i,
        email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        telefono: /^(?:\+58)?[2469]\d{9}$/, // numero de telefono formato venezuela, con +58 mas 10 digitos
        direccion: /^[a-zA-Z0-9\sáéíóúñÑ#\-\.]+$/,
        nrocta : /^[0-9]{16}$/
    }

    let entrar = true;
    let warnings = "";

    if(!expresiones.nombre.test(nombre.value)){
        
        warnings += `El nombre no es valido\n`;
        entrar = false;
        errorName.innerHTML = '<b>¡El nombre solo debe contener letras, maximo 40 caracteres!<b>'
        nombre.style.borderColor = 'red';
    }else{
           
        errorName.innerHTML = '';
        nombre.style.borderColor ='black';
    }

    

     if(!expresiones.Apellido.test(Apellido.value)){
        warnings += `El Apellido no es valido\n`;
        entrar = false;
        errorApellido.innerHTML = '<b>¡El Apellido solo debe contener letras, maximo 40 caracteres!<b>'
        Apellido.style.borderColor ='red';
    }else{
           
        errorApellido.innerHTML = '';
        Apellido.style.borderColor ='black';
    }

    if(!expresiones.Cedula.test(Cedula.value)){
        warnings += `La Cedula no es valida\n`;
        entrar = false;
        errorCedula.innerHTML = '<b>¡La Cedula debe contener de 6 a 8 numeros. Los formatos pueden ser: V-XXXXXXXX ; E-XXXXXXXX ; J-XXXXXXXX ; P-XXXXXXXX ; G-XXXXXXXX ; XXXXXXXX</b>';
        Cedula.style.borderColor ='red';
    }else{
           
        errorCedula.innerHTML = '';
        Cedula.style.borderColor ='black';
    }

    if(!(email == null)){
        if(!expresiones.email.test(email.value)){
            warnings += `El email no es valido\n`;
            entrar = false;
            errorCorreo.innerHTML = '<b>¡El Email no es valido!</b>';
            email.style.borderColor ='red';
        }else{
               
            errorCorreo.innerHTML = '';
            email.style.borderColor ='black';
        }
        
    }
    
    if (!(rif == null)){
        if(!expresiones.Cedula.test(rif.value)){
            warnings += `El rif no es valido\n`;
            entrar = false;
            errorRif.innerHTML = '<b>¡La Cedula debe contener de 6 a 8 numeros. Los formatos pueden ser: V-XXXXXXXX ; E-XXXXXXXX ; J-XXXXXXXX ; P-XXXXXXXX ; G-XXXXXXXX ; XXXXXXXX</b>';
            rif.style.borderColor ='red';
        }else{
           
            errorRif.innerHTML = '';
            rif.style.borderColor ='black';
        }
    }
    if(!(tlf == null)){
        if(!expresiones.telefono.test(tlf.value)){
            warnings += `El numero de telefono no es valido\n`;
            entrar = false;
            errorTlf.innerHTML = '<b>¡el numero de telefono debe contener de 10 digitos sin contar el codigo de area(+58). Los formatos pueden ser: +584126548778 / 4126548778 </b>'
            tlf.style.borderColor ='red';
        }else{
            
            errorTlf.innerHTML = '';
            tlf.style.borderColor ='black';
        }
    }
    if(!(direccion == null)){
        if(!expresiones.direccion.test(direccion.value)){
            warnings += `El formato de direccion no es valido\n`;
            entrar = false;
            errorDir.innerHTML = '<b>Signos usados para direccion no validos </b>'
            direccion.style.borderColor ='red';
        }else{
            
            errorDir.innerHTML = ''
            direccion.style.borderColor ='black';
        }
        
    } 
    if(!(nrocta == null)){
        if(!expresiones.nrocta.test(nrocta.value)){
            warnings += `El formato del numero de cuenta no es valido\n`;
            entrar = false;
            errorNroCta.innerHTML = '<b>El numero de cuenta debe de tener 16 digitos sin incluir prefijos</b>'
            nrocta.style.borderColor ='red';
        }else{
           
            errorNroCta.innerHTML = '';
            nrocta.style.borderColor ='black';
        }
    }
    if(!Nombre_A == ""){
        if(!expresiones.nombre.test(Nombre_A.value)){
            warnings += `El nombre Autorizado no es valido\n`;
            entrar = false;
            errorNameA.innerHTML = '<b>¡El nombre solo debe contener letras, maximo 40 caracteres!<b>'
            Nombre_A.style.borderColor = 'red';
        }else{
           
            errorNameA.innerHTML = '';
            Nombre_A.style.borderColor ='black';
        }
    }

    if(!(ApellidoA == "")){
        if(!expresiones.Apellido.test(ApellidoA.value)){
            warnings += `El Apellido Autorizado no es valido\n`;
            entrar = false;
            errorApellidoA.innerHTML = '<b>¡El Apellido solo debe contener letras, maximo 40 caracteres!<b>'
            ApellidoA.style.borderColor ='red';
        }else{
            
            errorApellidoA.innerHTML = '';
            ApellidoA.style.borderColor ='black';
        }
        
    }
    //verificar si lo ingresado en el campo BANCO esta en lista
    
    if(!(banco == null)){
        if(!(lista_bancos.some(bancos => bancos == banco.value))){
            warnings += `Banco no valido\n`;
            entrar = false;
            errorBancoA.innerHTML = '<b>¡Seleccione un banco de la lista!<b>'
            banco.style.borderColor ='red';
        }else{
            errorBancoA.innerHTML = '';
            banco.style.borderColor ='black';
        }
    }
    //Valida que se selecciona un tipo de cuenta de la lista
    if(!(tipo_Cta == null)){
        if(!(lista_Tipo.some(tipo => tipo == tipo_Cta.value ))){
            warnings += `tipo de cuenta no valida\n`;
            entrar = false;
            errorTipoBancoA.innerHTML = '<b>¡Seleccione un tipo de cuenta de la lista!<b>'
            tipo_Cta.style.borderColor ='red';
        }else{
            errorTipoBancoA.innerHTML = '';
            tipo_Cta.style.borderColor ='black';
        }
    }

    
    
    //retornamos ambos valores
    return [entrar, warnings];
}

//validacion de datos del camion
export function validarFormCamion(){
    //obtencion de campos a validar
    const Placa = document.getElementById("Placa");
    const Capacidad = document.getElementById("Capacidad");
    const Modelo = document.getElementById("Modelo");

    const expresiones = {
        Placa : /^[A-Z]\d{2}[A-Z]{2}\d[A-Z]$/i,
        Modelo: /^[A-Za-z\s]+$/
    }

    let entrar = true;
    let warnings = "";

    if(!expresiones.Placa.test(Placa.value)){
        
        warnings += `la placa no es valida\n`;
        entrar = false;
        errorPlaca.innerHTML = '<b>¡La placa debe coincidir con el siguiente formato: A12BC3D!<b>'
        Placa.style.borderColor = 'red';
    }else{
           
        errorPlaca.innerHTML = '';
        Placa.style.borderColor ='black';
    }

    if(!expresiones.Modelo.test(Modelo.value)){
        
        warnings += `El nombre no es valido\n`;
        entrar = false;
        errorModelo.innerHTML = '<b>¡Escriba correctamente la marca de su vehiculo!<b>'
        Modelo.style.borderColor = 'red';
    }else{
           
        errorModelo.innerHTML = '';
        Modelo.style.borderColor ='black';
    }

    //retornamos ambos valores
    return [entrar, warnings];
}