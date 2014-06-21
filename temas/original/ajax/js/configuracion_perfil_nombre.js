(function(){
    $("#cambiar_nombre_perfil_submit").click(function() {
        var permiso = "allowed";
            nombres = $("#cambiar_nombre_perfil").val();
			
		/*
			Reiniciar errores
		*/
		$(".form_nombre_perfil").removeClass("has-error");

			
		/*
		-----------------------
		Errores al registrarse
		-----------------------
		*/
		// Permiso 
        if (permiso != "allowed") {
            $("#resultado_nombre_perfil").html("Error...");
            return false;
			
		// Cuenta
		} else if(nombres == ""){
			$("#cambiar_nombre_perfil").focus();
			$(".form_nombre_perfil").addClass("has-error");
			$("#resultado_nombre_perfil").html("<div class='alert alert-warning'>Llene el formulario</div>");
			return false;
		
		/*
		----------------
		Envio de datos
		----------------
		*/
        } else {
			var datos = {
				"permiso" : permiso,
				"nombres" : nombres,
			};
			$.ajax({
				type:  "POST",
				url:   "?p=ajax&action=configuracion_perfil_nombre",
				data:  datos,
				beforeSend: function () {
						new Spinner(opts).spin(document.getElementById("resultado_nombre_perfil"));
				},
				success:  function (respuesta) {
						$("#resultado_nombre_perfil").html((respuesta == "Finalizado") ? location.reload() : "<div class='alert alert-warning'>" + respuesta + "</div>");
				},
				error: function() {
					$("#resultado_nombre_perfil").html("Error al enviar.")                 
				}
			});
			return false;
        }
    });
})();