//  para que activar o no los campos de titulo de propiedad
const OpcionPropSI = document.getElementById("inlineRadio1");
OpcionPropSI.addEventListener("click", (e)=>{
    document.getElementById("propiedad").style.display = "inline";
})

const OpcionPropNO = document.getElementById("inlineRadio2");
OpcionPropNO.addEventListener("click", (e)=>{
    document.getElementById("propiedad").style.display = "none";
})
