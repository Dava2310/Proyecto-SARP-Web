//  para que activar o no los campos de titulo de propiedad
const OpcionPropSI = document.getElementById("inlineRadio1");

OpcionPropSI.addEventListener("click", (e)=>{
    document.getElementById("propiedad").style.display = "inline";
    document.getElementById("compromiso").style.display = "none";
    document.getElementById("checkboxCompromiso").style.display = "none";
})

const OpcionPropNO = document.getElementById("inlineRadio2");

OpcionPropNO.addEventListener("click", (e)=>{
    document.getElementById("propiedad").style.display = "none";
    document.getElementById("compromiso").style.display = "inline";
    document.getElementById("checkboxCompromiso").style.display = "inline";
    
    // Si no tiene informacion legal, se debe desabilitar el boton de registrar
    document.getElementById("aceptar").disabled = true;

})

const checkbox = document.getElementById('checkboxCompromiso');

checkbox.addEventListener('change', function() {
    if (checkbox.checked) {
        // Acción cuando se marca el checkbox
        document.getElementById("aceptar").disabled = false;
    } else {
        // Acción cuando se desmarca el checkbox
        document.getElementById("aceptar").disabled = true;
    }
});
