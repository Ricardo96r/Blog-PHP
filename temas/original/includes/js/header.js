$(document).on("ready", function(){
	$("#entrar").hide();
	
	$("#login-boton").on("click", function (){
		$("#entrar").slideToggle(0);
	});
	
	$("#header-memu-propiedades").hide();

	$("#boton-propiedades").on("click", function (){
		$("#entrar").slideToggle(0, function(){
			$("#entrar").css({
				width: 215,
			})
		});
	});
	
	$("#nav_boton").on("click", function(){
		$('nav').toggle(0, function () {
				$("nav").css({visibility: "hidden"});
			}, function () {
				$("nav").css({visibility: "visible"});
			});
		});
});