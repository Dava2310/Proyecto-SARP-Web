//cargar datos de los arrimes registrados
function cargarArrime(IDPL){ 
    $.ajax({
        // la URL para la petición
        url : '../../controllers/agropecuaria/get_datosSiembraPla.php',

        // la información a enviar en este caso el valor de lo que seleccionaste en el select
        data : { IDPL : IDPL },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'json',

        // código a ejecutar si la petición es satisfactoria;
        success : function(json) {
            //aqui recibimos el "echo" del php(ajax.php)
            //y ahora solo colocas el valor en los campos
            $("#cantidad").val(json.Rango);
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })
}

const semana = document.getElementById("semana");
semana.addEventListener("change", (e)=>{
    e.preventDefault();
    cargarArrime(semana.value);
    Fase2_display =  document.getElementById('fase_2');
    Fase3_display = document.getElementById('fase_3');
    
    if ( Fase2_display.style.display == "flex"){
        Fase2_display.style.display = "none";
        document.getElementById('boton1').disabled = false;

    }
    if ( Fase3_display.style.display == "flex"){
        Fase3_display.style.display = "none";
        
    }
     
    
})
//------ EJECUCION AGREGAR FASE 1 --------
function fase1(){
    
    document.getElementById('fase_2').style.display="flex";
    /* document.getElementById('semana').disabled=true; */
    document.getElementById('cantidad').readOnly=true;
    document.getElementById('boton1').disabled = true;

            
    
    
}
const btn_Fase1 = document.getElementById("boton1");
btn_Fase1.addEventListener("click", (e)=>{
    e.preventDefault();
    fase1()
})
//-------- OBTENER DATOS DE LOS PROVEEDORES PARA LISTA DESPLEGABLE-----
function datosP(idP){
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
            $("#Nombre").val(json.Nombre + " " +json.Apellido);
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

}

const proveedor = document.getElementById("Proveedor");
proveedor.addEventListener("change", (e)=>{
    e.preventDefault();
    datosP(proveedor.value)

    //--------LLENAR LISTA SIEMBRA A PARTIR DE LISTA PROVEEDORES-------------------
    var siemb = $('#Siembra');
    var IDP = proveedor.value;
        
        if(IDP !== ''){
            $.ajax({
                data: {IDP:IDP}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/agropecuaria/get_listaSiembra.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                siemb.prop('disabled', false); //habilitar el select       

                siemb.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                
            });

        }else{ //en caso de seleccionar una opcion no valida
            siemb.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            siemb.prop('disabled', true); //deshabilitar el select
        }

})



//---------CARGAR DATOS DE LA LISTA SIEMBRA-----
function mifuncionSM(idS){
    $.ajax({
        // la URL para la petición
        url : '../../controllers/agropecuaria/get_datoSiembra.php',

        // la información a enviar en este caso el valor de lo que seleccionaste en el select
        data : { idS : idS },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'json',

        // código a ejecutar si la petición es satisfactoria;
        success : function(json) {
            
            $("#IDLote").val(json.ID_Siembra);
            $("#disponibilidad").val(json.Kilos_Totales);
           
           
            //para que al momento de selecciona a alguien se muestre primeramene los datos bancarios personales
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

}
const siembra = document.getElementById("Siembra");
siembra.addEventListener("change", (e)=>{
    e.preventDefault();
    mifuncionSM(siembra.value);
})

//------ EJECUCION AGREGAR FASE 2 --------
function fase2(){
    
    var Proveedor = document.querySelector('#Proveedor').value;
    var Siembra = document.querySelector('#Siembra').value;
    var Nombre = document.querySelector('#Nombre').value;
    var disponibilidad = parseFloat(document.querySelector('#disponibilidad').value);
    var IDLote = document.querySelector('#IDLote').value;
    var Stda = parseFloat(document.getElementById("Solicitud").value);
    var cda = parseFloat(document.getElementById("cantidad").value) ;

  
    
    if(
        Proveedor == null || Siembra == '' || Nombre == '' || disponibilidad == '' || IDLote =='' || Stda == '' 
    ){
        alert('rellene los campos correspondientes');

    }else if (Stda > cda){
       
        alert('Cantidad de MP solicitada supera la planificacion' + Stda.value + " > "+ cda.value);

    }else if(Stda > disponibilidad){
        alert('Cantidad de MP solicitada supera la disponibilidad de la siembra ');
        
        
    }else{
        document.getElementById('fase_3').style.display="flex";

        let form = document.getElementById('formulario');
        let data = new FormData(form);

        fetch('../../controllers/agropecuaria/set_datosFase2.php',{
            method: 'POST',
            body:data
            

        }).then(response => response.json()).then(datas => {

           var json = datas;
           $("#cantidad").val(json.nuevactdad);
           $("#disponibilidad").val(json.kilosRestantes);
           alert('Solicitud realizada con exito')
            // OBTENER LISTA DE SIEMBRAS PLANIFICADAS
            var sema = document.querySelector('#semana').value;
            var Sipla = $('#SiembraStda');
        
            $.ajax({
                data: {sema:sema}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/agropecuaria/get_SiembraPla.php', //url que recibe las variables
                success : function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                Sipla.prop('disabled', false); //habilitar el select       

                Sipla.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax     
                },
                error:function(xhr, status){
                alert('Disculpe, existió un problema');
                }        
                
            });
            
        })
        

       /*  $.ajax({
            data: {sema:sema},
            dataType: 'json',
            type: 'POST',
            url: '../../controllers/agropecuaria/get_totalSolicitud.php',
            success : function(json){
                $('#cantidadtemp').val(json.totalsolicitud);
            },
            error:function(xhr, status){
                alert('Disculpe, existió un problema');
            }
        }) */
    }

}
const btn_Fase2 = document.getElementById("btn_Fase2");
btn_Fase2.addEventListener("click", (e)=>{
    e.preventDefault();
    fase2();
})
//OBTENER CANTIDAD TOTAL SOLICITADA 
var ctdadTemp = document.getElementById('cantidadtemp');

ctdadTemp.addEventListener('click',function(){
    var sema = document.querySelector('#semana').value;
    $.ajax({
        data: {sema:sema},
        dataType: 'json',
        type: 'POST',
        url: '../../controllers/agropecuaria/get_totalSolicitud.php',
        success : function(json){
            $('#cantidadtemp').val(json.totalsolicitud);
        },
        error:function(xhr, status){
            alert('Disculpe, existió un problema');
        }
    })
})

/*  function getsiembraPLA(ids){
    $.ajax({
        url: '../../controllers/agropecuaria/get_datosSiembraPla.php',
        data: {ids:ids},

        type:'POST',
        dataType: 'json',
        success: function(json){
            $('#stda').val(json.ctda);

        },
        error: function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

} */
//ELIMINAR SOLICITUD
var botonEliminar = document.getElementById('borrar');

botonEliminar.addEventListener('click',function(){
    var se = document.getElementById('SiembraStda').value;
    if(se === ""){
        alert('Selecione solicitud a eliminar')

    }else{
        if(confirm('¿Seguro de eliminar?')){
        $.ajax({
            data : { se : se },

            // especifica si será una petición POST o GET
            type : 'POST',
            
            dataType: 'json',
            // la URL para la petición
            url : '../../controllers/agropecuaria/ctrl_eliminarSolicitud.php',

            // la información a enviar en este caso el valor de lo que seleccionaste en el select

        // código a ejecutar si la petición es satisfactoria;
        success : function(json) {
            alert('eliminada con exito');

            $('#cantidad').val(json.Rango)
             // Recargar lista de siembra
             var sema = document.querySelector('#semana').value;
            var Sipla = $('#SiembraStda');
        
            $.ajax({
                data: {sema:sema}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/agropecuaria/get_SiembraPla.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                Sipla.prop('disabled', false); //habilitar el select       

                Sipla.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                
            });
            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
        })

        }
        
    }
    


})