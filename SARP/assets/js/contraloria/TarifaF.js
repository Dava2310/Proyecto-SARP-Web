function cargarSoli(idso){
    $.ajax({
            // la URL para la petición
        url : '../../controllers/proveedor/get_datosSoli.php',

        // la información a enviar en este caso el valor de lo que seleccionaste en el select
        data : { idso : idso },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'json',

        // código a ejecutar si la petición es satisfactoria;
        success : function(json) {
            
            $("#cantidadkilos").val(json.Cantidad_MP);
            $("#cantidadkilosA").val(json.Cantidad_MP);
            $("#semana").val(json.Semana);
            $("#Camion").val(json.Camion);
            $("#dias").val(json.Dia);
            $("#chofer").val(json.Chofer);
            $("#observacion").val(json.Obser);
            $('#idsoli').val(json.idsoli);
            

            
        },

        // código a ejecutar si la petición falla;
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    })

}



var KG = $("#cantidadkilos").val();

function CalcularMP(){
    var T_MP = document.getElementById('TotalMP');
    var T_CA = document.getElementById('TotalCA');
    var T_FL = document.getElementById('TotalCA');

    var P_MP = document.getElementById('PrecioMP').value;
    var P_CA = document.getElementById('PrecioCA').value;
    var P_FL = document.getElementById('PrecioFL').value;
    var KG = document.getElementById('cantidadkilos').value;

    if(P_MP == null || P_MP == '' || KG == '' || KG == null){
        alert('Ingrese Datos')
    }else{
        var kgMP = KG*P_MP;
        $("#TotalMP").val(kgMP);
    }


}

function CalcularCA(){
    

    var P_MP = document.getElementById('PrecioMP').value;
    var P_CA = document.getElementById('PrecioCA').value;
    var P_FL = document.getElementById('PrecioFL').value;
    var KG = document.getElementById('cantidadkilos').value;

    if(P_CA == null || P_CA == '' || KG == '' || KG == null){
        alert('Ingrese Datos')
    }else{
        var kgMP = KG*P_CA;
        $("#TotalCA").val(kgMP);
    }


}

function CalcularFL(){
    

    var P_MP = document.getElementById('PrecioMP').value;
    var P_CA = document.getElementById('PrecioCA').value;
    var P_FL = document.getElementById('PrecioFL').value;
    var FL = document.getElementById('viaje').value;

    if(P_FL == null || P_FL == '' || FL == '' || FL == null){
        alert('Ingrese Datos')
    }else{
        var kgMP = FL*P_FL;
        $("#TotalFL").val(kgMP);
    }


}


function guardarTarifa(){
    var T_FL = document.getElementById('TotalFL').value;
    var T_CA = document.getElementById('TotalCA').value;
    var T_MP = document.getElementById('TotalMP').value;

    if(T_CA=='' || T_FL=='' || T_MP =='' || T_CA==null || T_FL==null || T_MP == null){
        alert('llene los campos Totales');

    }else{
        let form = document.getElementById('formulario');
        let data = new FormData(form);

        fetch('../../controllers/contraloria/Set_Tarifa.php',{
            method: 'POST',
            body: data
        }).then(Response => response.text()).then(response =>{
            if (response == "ok"){
                alert('registrado con exito');
            }

        })
    }


}