function show_form(){
  document.getElementById("form").style.display = "block";
  document.getElementById("photo").style.display = "none";
}

function hide_form(){
  document.getElementById("form").style.display = "none";
  document.getElementById("photo").style.display = "block";
}

function show_form_edit(id){
  console.log(id);
  document.getElementById("id_zdjecia").value= id;
  document.getElementById("form-edit").style.display = "block";
  document.getElementById("photo").style.display = "none";
}

function hide_form_edit(){
  document.getElementById("form-edit").style.display = "none";
  document.getElementById("photo").style.display = "block";
}