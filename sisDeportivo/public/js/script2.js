$(document).ready(function(){
	var tablaDatos = $("#datos");
	var route ="http://localhost:8000/usuarios";

	$.get(route, function(res){
		$(res).each(function(key,value){
			tablaDatos.append("<td><button value="+value.identificacion+"  OnClick='Mostrar(this);' class='btn-xs'><span class='glyphicon glyphicon-edit'  data-toggle='modal' data-target='#modificar'></span></button><button value="+value.identificacion+"  OnClick='Mostrar(this);' class='btn-xs'><span class='glyphicon glyphicon-refresh'></span></button></td></tr>");
		});
	});
});


function mostrarEstado(estado){
	console.log(estado);
	if(estado==true){
		return "Activo"}else{
			return "Inactivo"
		}
}

function Mostrar(btn){
	var route = "/usuario/"+btn.value+"/edit";
	$.get(route, function(res){
		$("#IDUsuario").val(res.IDUsuario);
		$("#Nombres").val(res.Nombres);
		$("#Apellidos").val(res.Apellidos);
		$("#estado").val(res.email);
		$("#id").val(res.id);


	});
}

$("#modificar").click(function(e){
	e.preventDefault();

	var value = $("#id").val();
	var dato = $("#email").val();
	var route ="/usuario/"+value+""+'?_method=PUT';
	var token = $("#token").val();


	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'PUT',
		dataType: 'json',
		data:{user: dato}
	});
});