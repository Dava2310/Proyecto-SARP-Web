import {validarFormDP} from '../validacion.js';
//funcion que indica cual es el codigo del banco seleccionado
function cambiarCodBanco(codigo){
    if(codigo == "BANCO MERCANTIL"){
        $("#CODbanco").val("0105");

    }else if(codigo == "BANCO NACIONAL DE CRÉDITO"){
        $("#CODbanco").val("0191");

    }else if(codigo == "BANCO DEL CARIBE"){
        $("#CODbanco").val("0114");
        
    }else if(codigo == "BANCO DEL TESORO"){
        $("#CODbanco").val("0163");
        
    }else if(codigo == "BANCO EXTERIOR"){
        $("#CODbanco").val("0115");
        
    }else if(codigo == "BANCO CARONÍ"){
        $("#CODbanco").val("0128");
        
    }else if(codigo == "BANCO DE VENEZUELA"){
        $("#CODbanco").val("0102");
        
    }else if(codigo == "BANESCO BANCO UNIVERSAL"){
        $("#CODbanco").val("0134");
        
    }else if(codigo == "BANCO PROVINCIAL"){
        $("#CODbanco").val("0108");
        
    }else if(codigo == "BANCAMIGA BANCO UNIVERSAL"){
        $("#CODbanco").val("0172");
        
    }
}

function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('Banco-A').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";
        
        document.getElementById('numcuenta').readOnly=true;
        document.getElementById('ctaP&A').disabled=true;
        //document.getElementById('email').disabled=true;
        //document.getElementById('Cedula').disabled=true;
        document.getElementById('NombreA').readOnly=true;
        document.getElementById('ApellidoA').readOnly=true;
        document.getElementById('Banco-A').readOnly=true;
        
        document.getElementById('TpoCuenta-A').disabled=true;
    } else {
        BotonCambiar.value="Modificar (Activado)";
        
        document.getElementById('numcuenta').readOnly=false;
        document.getElementById('ctaP&A').disabled=false;
        //document.getElementById('email').disabled=true;
        //document.getElementById('Cedula').disabled=true;
        document.getElementById('NombreA').readOnly=false;
        document.getElementById('ApellidoA').readOnly=false;
        document.getElementById('Banco-A').readOnly=false;
        
        document.getElementById('TpoCuenta-A').disabled=false;
    }
    
}

//funcion para la seleccion de tipo de cuenta Personal/Autorizada
export function mifuncionP_A(P_A,idP){
    if(P_A == 'PERSONAL'){
    $.ajax({
        // la URL para la petición
        url : '../../controllers/agropecuaria/get_datoP.php',

        // la información a enviar en este caso el valor de lo que seleccionaste en el select
        data : { idP : idP },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'json',

        // código a ejecutar si la petición es satisfactoria;
        success : function(json) {
            //aqui recibimos el "echo" del php(ajax.php)
            //y ahora solo colocas el valor en los campos
            $("#Banco-A").val(json.Banco_P);
            //cambiar campo de codigo del banco
            cambiarCodBanco(json.Banco_P);
            $("#numcuenta").val(json.Cuenta_P);
            $("#TpoCuenta-A").val(json.TipoCuenta_P);
            //para que los campos nombre y apellidos autorizados no aparezcan
            document.getElementById('divNombreA').style.display="none";
            document.getElementById('divApellidoA').style.display="none";
            /* solucinando probelmas de responsividad */
            document.getElementById('div-ctaP&A').className="form-group  col-md-6  col-sm-12 ";   
               
            document.getElementById('div-Banco').className="form-group  col-md-6  col-sm-12 ";
            document.getElementById('div-nrocta').className="form-group  col-md-6  col-sm-12 ";     
            document.getElementById('div-tcuenta').className="form-group  col-md-6  col-sm-12 ";     
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

    }else if(P_A == 'AUTORIZADA'){
        $.ajax({
            // la URL para la petición
            url : '../../controllers/agropecuaria/get_datoP.php',

            // la información a enviar en este caso el valor de lo que seleccionaste en el select
            data : { idP : idP },

            // especifica si será una petición POST o GET
            type : 'POST',

            // el tipo de información que se espera de respuesta
            dataType : 'json',

            // código a ejecutar si la petición es satisfactoria;
            success : function(json) {
                //aqui recibimos el "echo" del php(ajax.php)
                //y ahora solo colocas el valor en los campos
                $("#Banco-A").val(json.Banco_A);
                //cambiar campo de codigo del banco
                cambiarCodBanco(json.Banco_A);
                $("#numcuenta").val(json.Cuenta_A);
                $("#TpoCuenta-A").val(json.TipoCuenta_A);
                //para que los campos nombre y apellidos autorizados si aparezcan
                document.getElementById('divNombreA').style.display="inline";
                document.getElementById('divApellidoA').style.display="inline";
                $("#NombreA").val(json.Nombre_A);
                $("#ApellidoA").val(json.Apellido_A);
                /* solucinando probelmas de responsividad */
                document.getElementById('div-ctaP&A').className="form-group col-xl-4 col-md-6  col-sm-12 ";   
                document.getElementById('divNombreA').className="form-group  col-xl-4 col-md-6  col-sm-12 "; 
                document.getElementById('divApellidoA').className="form-group  col-xl-4 col-md-6  col-sm-12 "; 
                document.getElementById('div-Banco').className="form-group col-xl-4  col-md-6  col-sm-12 ";
                document.getElementById('div-nrocta').className="form-group  col-xl-4 col-md-6  col-sm-12 ";     
                document.getElementById('div-tcuenta').className="form-group  col-xl-4 col-md-6  col-sm-12 ";     
        
                
                
                
                

            },

            // código a ejecutar si la petición falla;
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
            }
        })

    }else{
        document.getElementById('NombreA').value=null;
        document.getElementById('ApellidoA').value=null;
        document.getElementById('Banco-A').value=null;
        document.getElementById('numcuenta').value=null;
        document.getElementById('TpoCuenta-A').value=null;


    }

}

// ===================== ACCION PARA CAMBIAR EL CODIGO DEL NUMERO DE BANCO SEGUN EL BANCO SELECCIONADO 
var selectElement = document.getElementById("Banco-A");

selectElement.addEventListener("change", (e)=>{

    cambiarCodBanco(selectElement.value);
})



const btn_cambiar = document.getElementById("botonCambiar");
//eventos al dar click al boton de cambiar para hacer los campos editables
btn_cambiar.addEventListener("click",(e)=>{
    e.preventDefault();
    activarCampos();
})

//evento para cuando cambien cuenta de personal a autorizara
const P_A = document.getElementById("ctaP&A");
P_A.addEventListener("change", (e)=>{
    e.preventDefault()
    mifuncionP_A(P_A.value,document.getElementById("Cedula").value);
})

//funcion para enviar datos a la BD con "submit"
const form = document.getElementById('form');

form.addEventListener("submit", (e) =>{
    e.preventDefault()

    //se destruturan los valores en varibales
    const[entrar,warnings] = validarFormDP();
    if(entrar){
        //si la vairable entrar es false, se procede a enviar datos al servidor mediante el fetch

        //se gguardan los datos del formulario en formData
        const formData = new FormData(form);
        
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/proveedor/ctrl_bancarioPersonal&A.php',{
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
                alert("Modificado con exito");
                location.reload();
            }else{
                alert(data)
            }
        })
    }else{
        alert(warnings)
    }
})

// function limitarInput(event) {
//     var input = event.target;
//     if (input.value.length > 16) {
//         input.value = input.value.slice(0, 16);
//     }
// }