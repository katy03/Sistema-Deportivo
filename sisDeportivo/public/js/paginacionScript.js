
$(document).on('click','.pagination a', function(e){
	e.preventDefault();
	var page = $(this).attr('href').split('page=')[1];
	var route ="/usuario";
	console.log(page);


$.ajax({
	url: route,
	data: {page: page},
	type: 'GET',
	dataType: 'json',
	success: function(data){
		console.log(data);
	}
});

});