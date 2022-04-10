$(document).ready(function(){
  var id;
  $('#modify_submit').click(function() {
	   $(this).attr('translate-key') == "modify-button" ? show_input() : show_data();
     id = $(this).attr('name');
     translatePage();
  });

  $('#cancel_submit').click(function(){
    show_data();
  });
});

function show_input(){
  $('#modify_submit').attr("translate-key", "validate-button");
  console.log("input");
}

function show_data(){
  $('#modify_submit').attr("translate-key", "modify-button");
  console.log("data");
}
