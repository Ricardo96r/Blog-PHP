$(document).on("ready", function(){
	$("#entrar").hide();
	
	$("#login-boton").on("click", function (){
		$("#entrar").slideToggle();
	});
	
	$("#header-memu-propiedades").hide();
	
	$("#boton-propiedades").on("click", function (){
		$("#entrar").slideToggle();
	});
				
	$("#nav_boton").on("click", function(){
		$('nav').toggle(0, function () {
				$("nav").css({visibility: "hidden"});
			}, function () {
				$("nav").css({visibility: "visible"});
			});
		});
});