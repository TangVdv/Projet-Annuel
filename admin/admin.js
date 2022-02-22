function suppr(id_article){
  const article_delete = new XMLHttpRequest();
  article_delete.onreadystatechange = function(){
    if (article_delete.readyState == 4) {
      document.location.href="article.php";
    }
  };
  article_delete.open("GET", "delete_article.php?index=" + id_article);
  article_delete.send();
}

function edit(id_article){
  document.cookie = "index = " + id_article;
  document.location.href="edit_article.php";
}

function admin_vérif(id_admin){
  checkbox = document.getElementById('flexCheckDefault');
  if (id_admin == 0) {
    checkbox.setAttribute("checked", "");
  }
  if (id_admin == 1) {
    checkbox.removeAttribute("checked");
  }
}

function edit_account(id_btn_edit, id_user, id_btn_suppr){

  const btn_save = document.createElement("button");
  const btn_cancel = document.createElement("button");

  const td_name = document.getElementById("name_"+id_user);
  const td_username = document.getElementById("username_"+id_user);
  const td_admin = document.getElementById("admin_"+id_user);

  const input_name = document.createElement("input");
  const input_username = document.createElement("input");
  const checkbox_admin = document.createElement("input");

  input_name.type= "text";
  input_name.name = "name";
  input_name.id = "input_name_" + id_user;
  input_name.className = "form-control form-control-sm text-center";
  input_name.value = td_name.innerHTML;

  input_username.type= "text";
  input_username.name = "username";
  input_username.id = "input_username_" + id_user;
  input_username.className = "form-control form-control-sm text-center";
  input_username.value = td_username.innerHTML;

  checkbox_admin.type = "checkbox";
  checkbox_admin.name = "checkbox";
  checkbox_admin.className = "form-check-input";
  checkbox_admin.id = "checkbox_admin_"+id_user;
  if (td_admin.innerHTML == "1") {
    checkbox_admin.setAttribute("checked", "");
  }

  //<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>

  btn_save.type = "button";
  btn_save.id = "btn_save_"+id_user;
  btn_save.className = "btn btn-success mx-2 btn-sm";
  btn_save.innerHTML = "Save";

  btn_cancel.type ="button";
  btn_cancel.id = "btn_cancel_"+id_user;
  btn_cancel.className = "btn btn-primary mx-2 btn-sm";
  btn_cancel.innerHTML = "Annuler";

  btn_save.setAttribute("onClick", "send_edit_profil("+ btn_save.id + "," + btn_cancel.id + ",'"+ id_btn_edit.id +"','"+ id_btn_suppr.id +"',"+ id_user +")");
  btn_cancel.setAttribute("onClick", "cancel("+ btn_save.id + "," + btn_cancel.id + ",'"+ id_btn_edit.id +"','"+ id_btn_suppr.id + "'," + id_user +")");

  const parent = id_btn_edit.parentNode;

  parent.removeChild(id_btn_edit);
  parent.removeChild(id_btn_suppr);

  parent.appendChild(btn_save);
  parent.appendChild(btn_cancel);

  td_name.innerHTML = "";
  td_username.innerHTML = "";
  td_admin.innerHTML = "";

  td_name.appendChild(input_name);
  td_username.appendChild(input_username);
  td_admin.appendChild(checkbox_admin);
}

function cancel(id_btn_save, id_btn_cancel, id_btn_edit, id_btn_suppr, id_user){


  const input_name = document.getElementById("input_name_"+id_user);
  const input_username = document.getElementById("input_username_"+id_user);
  const checkbox_admin = document.getElementById("checkbox_admin_"+id_user);

  const td_name = document.getElementById("name_"+id_user);
  const td_username = document.getElementById("username_"+id_user);
  const td_admin = document.getElementById("admin_"+id_user);

  if (checkbox_admin.checked == true) {
    td_admin.innerHTML = "1";
  }
  else {
    td_admin.innerHTML = "0";
  }

  td_name.innerHTML = input_name.value;
  td_username.innerHTML = input_username.value;


  const parent = id_btn_save.parentNode;

  parent.removeChild(id_btn_save);
  parent.removeChild(id_btn_cancel);

  const btn_edit = document.createElement("button");
  const btn_suppr = document.createElement("button");

  btn_edit.type = "button";
  btn_edit.className = "btn btn-primary btn-sm mx-1";
  btn_edit.id = id_btn_edit;
  btn_edit.setAttribute("onClick", "edit_account(" + id_btn_edit + "," + id_user + "," + id_btn_suppr + ")");
  btn_edit.innerHTML = "Editer";


  btn_suppr.type = "button";
  btn_suppr.className = "btn btn-danger btn-sm mx-1";
  btn_suppr.id = id_btn_suppr;
  btn_suppr.innerHTML = "Supprimer";
  btn_suppr.setAttribute("data-bs-toggle", "modal");
  btn_suppr.setAttribute("data-bs-target", "#exampleModal"+id_user);

  parent.appendChild(btn_edit);
  parent.appendChild(btn_suppr);

}

function send_edit_profil(id_btn_save, id_btn_cancel, id_btn_edit, id_btn_suppr, id_user){
  let name_user = document.getElementById("input_name_"+id_user).value;
  let username_user = document.getElementById("input_username_"+id_user).value;
  let admin_user = document.getElementById("checkbox_admin_"+id_user).checked;
  var admin;
  if (admin_user == true) {
    admin = 1;
  }
  else {
    admin = 0;
  }

  const profil_edit = new XMLHttpRequest();

  profil_edit.open("GET", "verif_account_admin.php?index=" + id_user + "&name=" + name_user + "&username=" + username_user + "&admin=" + admin);
  profil_edit.send();
  cancel(id_btn_save, id_btn_cancel, id_btn_edit , id_btn_suppr, id_user);
}

function delete_account(id_user){
  const account_delete = new XMLHttpRequest();
  account_delete.onreadystatechange = function(){
    if (account_delete.readyState == 4) {
      document.location.href="account.php";
    }
  };
  account_delete.open("GET", "vérif_delete_account.php?index=" + id_user);
  account_delete.send();
}

function delete_product(id_product){
  const product_delete = new XMLHttpRequest();
  product_delete.onreadystatechange = function(){
    if (product_delete.readyState == 4) {
      document.location.href="product.php";
    }
  };
  product_delete.open("GET", "delete_product.php?index=" + id_product);
  product_delete.send();
}

function edit_product(id_product){
  document.cookie = "index = " + id_product;
  document.location.href="edit_product.php";
}

function locate(){
    const name_option = document.getElementsByName('option');
    const input = document.getElementById('SearchBar');
    for (var i = 0; i < name_option.length; i++) {
      if (name_option[i].value == input.value) {
        let id = name_option[i].id;
        location.href=id;
        //console.log(name_option[i]);
        var id_tr = id[1];
        for (let j = 2; j < id.length; j++) {
             id_tr += id[j];
        }
        var color = 1;
        //console.log(id_tr);
        //console.log(id);
        var statut = 0;
        const tr = document.getElementById(id_tr);
        //console.log(tr);
        var varInterval = setInterval(function(){
          //console.log("transi");
          if (statut === 0 ){
            tr.style.background = "rgba(255,0,0,"+color/100+")";
            color++;
            //console.log(color/100);
            if (color === 100) {
              statut = 1;
            }
          }
          else{
            if (color > 1) {
              tr.style.background = "rgba(255,0,0,"+color/100+")";
              color--;
              //console.log(color/100);
            }
            else {
              //console.log("clear");
              clearInterval(varInterval);
            }
          }

        }, 5);

        input.value = "";
      }
    }
  }
