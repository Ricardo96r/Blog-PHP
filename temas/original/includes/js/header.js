$(document).on("ready", function(){
	$("#entrar").hide();
	$("#header-memu-propiedades").hide();
	
	$("#login-boton").on("click", function (){
		$("#entrar").slideToggle();
	});
	
	$("#boton-propiedades").on("click", function (){
		$("#entrar").slideToggle();
	});	
	
	
	
	$("#nav_boton").on("click", function(){
		$("nav").toggle();
	});
});