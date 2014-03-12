$(document).on("ready", function(){
	$("#entrar").hide();
	$("#header-memu-propiedades").hide();
	
	$("#login-boton").on("click", function (){
		$("#entrar").slideToggle();
	});
	
	$("#boton-propiedades").on("click", function (){
		$("#entrar").slideToggle(0,function(){
			$("#entrar").css({
				// width:200, quita el responsive 
				})
			});
});
});