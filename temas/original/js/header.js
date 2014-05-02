$(document).on("ready", function(){
	$("#header-entrar").hide();
	
	$("#header-login-boton").on("click", function (){
		$("#header-entrar").slideToggle(0);
	});

	$("#header-boton-propiedades").on("click", function (){
		$("#header-entrar").slideToggle(0, function(){
			$("#header-entrar").css({
				width: 215,
			})
		});
	});
	
	$("#header-nav_boton-boton").on("click", function(){
		$('nav').toggle(0);
		});
	});