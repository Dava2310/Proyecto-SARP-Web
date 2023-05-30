
//llenar solicitudes a partir de semana
const semana = document.getElementById('semana');
semana.addEventListener("change", (e)=>{
    let soli = $('#solicitudes');

    
        var IDS = semana.value;
        
        
        if(IDS !== ''){
            $.ajax({
                data: {IDS:IDS}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/agropecuaria/get_listaSoli.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                soli.prop('disabled', false); //habilitar el select       

                soli.html(data); //establecemos el contenido html de solicitudes con la informacion que regresa ajax             
                
            });

        }else{ //en caso de seleccionar una opcion no valida
            soli.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            soli.prop('disabled', true); //deshabilitar el select
        }
   
})


function cargarArrime(idso){
    $.ajax({
        url:'../../controllers/proveedor/get_datosSoli.php',
            data : { idso : idso },

    // especifica si será una petición POST o GET
    type : 'POST',

    // el tipo de información que se espera de respuesta
    dataType : 'json',

    // código a ejecutar si la petición es satisfactoria;
    success : function(json) {
        
        $("#cantidadA").val(json.Cantidad_MP);
        $("#IDLote").val(json.ID_Siembra);
        document.getElementById('Fletero').readOnly=false;
        
    },

    // código a ejecutar si la petición falla;
    error : function(xhr, status) {
        alert('Disculpe, existió un problema');
    }

    })
}
function datosFletero(idP){
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
            
            //ajax para cargar lista de camion del fletero
            
            

        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

}


    //proceso para cargar lista de camiones a partir de los choferes

const fletero = document.getElementById("Fletero");
fletero.addEventListener("change", (e)=>{
    
    var cam = $('#camion');
    var idP = fletero.value;
        
        if(idP !== ''){
            $.ajax({
                data: {idP:idP}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                dataType: 'html', //tipo de datos que esperamos de regreso
                type: 'POST', //mandar variables como post o get
                url: '../../controllers/agropecuaria/Get_listaCamion.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                cam.prop('readOnly', false); //habilitar el select       

                cam.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
                
            });

        }else{ //en caso de seleccionar una opcion no valida
            cam.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            cam.prop('readOnly', true); //deshabilitar el select
        }

})

const camion = document.getElementById("camion");
camion.addEventListener("change", (e)=>{
    var idC = camion.value;
   
        
    if(idC !== ''){
        console.log(idC)
        $.ajax({
            data: {idC:idC}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
            dataType: 'json', //tipo de datos que esperamos de regreso
            type: 'POST', //mandar variables como post o get
            url: '../../controllers/fletero/get_datosCamion.php', //url que recibe las variables
            success : function(json) { //metodo que se ejecuta cuando ajax ha completado su ejecucion      
                $("#Capacidad").val(json.Capacidad);
            },
            error : function(xhr, status) {
            alert(' Seleccione un camion');
            
        
            $("#Capacidad").val("");
            

            }
        });

    }else{ //en caso de seleccionar una opcion no valida
        $("#Capacidad").val("");
    }
})



var form = document.getElementById('Formulario');


form.addEventListener('submit', function (e){
    e.preventDefault();
    let data = new FormData(form);
    fetch('../../controllers/agropecuaria/Set_SoliFletero.php',{
            method: 'POST',
            body:data
            

        }).then(response => response.json()).then(datas => {

            var mensaje = datas;
            
            alert(mensaje);
            location.reload();
            
            
        })
})

