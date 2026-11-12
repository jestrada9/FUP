function cambia_de_pagina(){
    location.reload();
    window.close();
}
function cambia_de_pagina2(){
    history.go(-1);
}
function cambia_de_pagina3(){
    location.reload();
}
function cambia_de_pagina4(){
    location.reload();
    window.close();
}
function validar(){
  var validado = true;
  elementos = document.getElementsByClassName("inputFormu");
  for(i=0;i<elementos.length;i++){
    if(elementos[i].value == "" || elementos[i].value == null){
    validado = false
    }
  }
  if(validado){
    document.getElementById("btnGetData").disabled = false;
  }else{
     document.getElementById("btnGetData").disabled = true;
  }
}
function borra(){
document.getElementById("formulario2").reset();
}