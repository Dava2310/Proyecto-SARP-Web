//importacion de funcion de validacion
import {validarFormDP} from '../validacion.js';

function activarCampos(){
    var BotonCambiar = document.getElementById('botonCambiar');
    if(document.getElementById('Nombre').readOnly == false){
        BotonCambiar.value="Modificar (Desactivado)";
        document.getElementById('Nombre').readOnly=true;
        document.getElementById('Apellido').readOnly=true;
        document.getElementById('tlf').readOnly=true;
        //document.getElementById('email').disabled=true;
        //document.getElementById('Cedula').disabled=true;
        document.getElementById('rif').readOnly=true;
        document.getElementById('direccion').readOnly=true;
        document.getElementById('ctaP&A').disabled=true;
        document.getElementById('NombreA').readOnly=true;
        document.getElementById('ApellidoA').readOnly=true;
        document.getElementById('Banco-A').readOnly=true;
        document.getElementById('numcuenta').readOnly=true;
        document.getElementById('TpoCuenta-A').disabled=true;
    } else {
        BotonCambiar.value="Modificar (Activado)";
        document.getElementById('Nombre').readOnly=false;
        document.getElementById('Apellido').readOnly=false;
        document.getElementById('tlf').readOnly=false;
        //document.getElementById('email').disabled=false;
        //document.getElementById('Cedula').disabled=false;
        document.getElementById('rif').readOnly=false;
        document.getElementById('direccion').readOnly=false;
        document.getElementById('ctaP&A').disabled=false;
        document.getElementById('NombreA').readOnly=false;
        document.getElementById('ApellidoA').readOnly=false;
        document.getElementById('Banco-A').readOnly=false;
        document.getElementById('numcuenta').readOnly=false;
        document.getElementById('TpoCuenta-A').disabled=false;
    }
    
}

const btn_cambiar = document.getElementById("botonCambiar");
//eventos al dar click al boton de cambiar para hacer los campos editables
btn_cambiar.addEventListener("click",(e)=>{
    e.preventDefault()
    activarCampos()
})

//funcion para llenar lista de proveedor
function mifuncion(idP){
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
            $("#Nombre").val(json.Nombre);
            $("#Apellido").val(json.Apellido);
            $("#Cedula").val(json.Cedula);
            $("#Email").val(json.Email);
            $("#rif").val(json.RIF);
            $("#direccion").val(json.Direccion);
            $("#tlf").val(json.Telefono);
            $("#cuentapropia").val(json.Cuenta_A);
            $("#Banco-A").val(json.Banco_P);
            $("#numcuenta").val(json.Cuenta_P);
            $("#TpoCuenta-A").val(json.TipoCuenta_P);
            //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
            document.getElementById('ctaP&A').value="PERSONAL";
            //para que los campos nombre y apellidos autorizados no aparezcan
            document.getElementById('divNombreA').style.display="none";
            document.getElementById('divApellidoA').style.display="none";
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })
 }

const lista_proveedor = document.getElementById('Proveedor');

lista_proveedor.addEventListener("change", (e)=>{
    e.preventDefault()
    mifuncion(lista_proveedor.value)
})


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

//evento para cuando cambien cuenta de personal a autorizara
const P_A = document.getElementById("ctaP&A");
P_A.addEventListener("change", (e)=>{
    e.preventDefault()
    mifuncionP_A(P_A.value,document.getElementById("Proveedor").value);
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
        console.log("listo")
        //usamos la API fetch para enviar datos al agregarUsuario.php 
        fetch('../../controllers/datos_personales/ctrl_datosP.php',{
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