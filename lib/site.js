let id = sessionStorage.getItem('id');
const radiobtn = document.getElementById("btnradio2");
console.log(radiobtn);
console.log(id);
//radiobtn.checked = true;


function radio(){
  var radios = document.getElementsByName('btnradio');
  var valeur;
  for(var i = 0; i < radios.length; i++){
   if(radios[i].checked){
     valeur = radios[i].value;
     sessionStorage.setItem('id', radios[i].id);
   }
  }
}
