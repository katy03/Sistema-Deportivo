$("#registro").click(function(e){

	var IDUsuario= $("#IDUsuario").val();
	var Nombres = $("#Nombres").val();
	var Apellidos = $("#Apellidos").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var confirmacion = $("#confirmacion").val();
	var route = "http://localhost:8000/usuario";
	var token = $("#token").val();

	$.ajax({
		url:route,
		headers: {'X-CSRF-TOKEN' : token},
		type: 'POST',
		dataType: 'json',
		data: {  IDUsuario, Nombres , Apellidos , email , password , confirmacion}
	});

	  e.stopImmediatePropagation();
    return false;

});