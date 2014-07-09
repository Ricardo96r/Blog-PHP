(function(){
    $("#cambiar_password_submit").click(function() {
        var permiso = "allowed";
            contraseña = $("#password_actual").val();
			contraseña1 = $("#password1_cambiar").val();
			contraseña2 = $("#password2_cambiar").val();
			
		/*
			Reiniciar errores
		*/
		$(".form_password_actual").removeClass("has-error");
		$(".form_password1_cambiar").removeClass("has-error");
		$(".form_password2_cambiar").removeClass("has-error");

			
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
		} else if(contraseña == ""){
			$("#password_actual").focus();
			$(".form_password_actual").addClass("has-error");
			$("#resultado_password_cambiar").html("<div class='alert alert-warning'>Llene el formulario</div>");
			return false;
		} else if(contraseña1 == ""){
			$("#password1_cambiar").focus();
			$(".form_password1_cambiar").addClass("has-error");
			$("#resultado_password_cambiar").html("<div class='alert alert-warning'>Llene el formulario</div>");
			return false;
		} else if(contraseña2 == ""){
			$("#password2_cambiar").focus();
			$(".form_password2_cambiar").addClass("has-error");
			$("#resultado_password_cambiar").html("<div class='alert alert-warning'>Llene el formulario</div>");
			return false;
		} else if(contraseña1 != contraseña2){
			$(".form_password2_cambiar").addClass("has-error");
			$(".form_password2_cambiar").addClass("has-error");
			$("#resultado_password_cambiar").html("<div class='alert alert-warning'>Contraseñas no iguales</div>");
			return false;
		
		/*
		----------------
		Envio de datos
		----------------
		*/
        } else {
			var datos = {
				"permiso" : permiso,
				"contraseña" : contraseña,
				"contraseña1" : contraseña1,
				"contraseña2" : contraseña2,
			};
			$.ajax({
				type:  "POST",
				url:   "?p=ajax&action=seguridad_password",
				data:  datos,
				beforeSend: function () {
						new Spinner(opts).spin(document.getElementById("resultado_password_cambiar"));
				},
				success:  function (respuesta) {
						$("#resultado_password_cambiar").html((respuesta == "Finalizado") ? location.reload() : "<div class='alert alert-warning'>" + respuesta + "</div>");
				},
				error: function() {
					$("#resultado_password_cambiar").html("Error al enviar.")                 
				}
			});
			return false;
        }
    });
})();