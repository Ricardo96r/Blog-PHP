(function(){
    $("#registro-submit").click(function() {
        var permiso = "allowed";
			cuenta = $("#registro-form-cuenta-input").val();
            contraseña1 = $("#registro-form-contraseña1-input").val();
			contraseña2 = $("#registro-form-contraseña2-input").val();
			email = $("#registro-form-correo-input").val();
            validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
            nombres = $("#registro-form-nombres-input").val();
            dia = $("#dia").val();
			mes = $("#mes").val();
			año = $("#año").val();
			sexo = $("#registro-form-sexo-input").val();
			
		/*
			Reiniciar errores
		*/
		$(".registro-form-cuenta-input").removeClass("has-error");
		$(".registro-form-contraseña1-input").removeClass("has-error");
		$(".registro-form-contraseña2-input").removeClass("has-error");
		$(".registro-form-correo-input").removeClass("has-error");
		$(".registro-form-nombres-input").removeClass("has-error");
		$(".registro-form-nacimiento-input").removeClass("has-error");
		$(".registro-form-sexo-input").removeClass("has-error");
		
		$("#resultado-cuenta-error").html("");
		$("#resultado-contraseña1-error").html(""); 
		$("#resultado-contraseña2-error").html("");
		$("#resultado-correo-error").html(""); 
		$("#resultado-nombres-error").html(""); 
		$("#resultado-nacimiento-error").html(""); 
		$("#resultado-sexo-error").html(""); 
		
			
		/*
		-----------------------
		Errores al registrarse
		-----------------------
		*/
		// Permiso 
        if (permiso != "allowed") {
            $("#resultado").html("Error...");
            return false;
			
		// Cuenta
		} else if(cuenta == ""){
			$("#registro-form-cuenta-input").focus();
			$("#resultado-cuenta-error").html(" *Llene el campo usuario"); 
			$(".registro-form-cuenta-input").addClass("has-error");
			return false;
		
		// Contraseña
		} else if(contraseña1 == ""){
			$("#registro-form-contraseña1-input").focus();
			$("#resultado-contraseña1-error").html(" *Ponga contraseña");
			$(".registro-form-contraseña1-input").addClass("has-error");
			return false;
		} else if(contraseña2 == ""){
			$("#registro-form-contraseña2-input").focus();
			$("#resultado-contraseña2-error").html(" *Complete");
			$(".registro-form-contraseña2-input").addClass("has-error");
			return false;
		} else if(contraseña1 != contraseña2) {
			$("#registro-form-contraseña1-input").focus();
			$("#resultado-contraseña1-error").html(" *Diferentes!");
			$("#resultado-contraseña2-error").html(" *Diferentes!");
			$(".registro-form-contraseña1-input").addClass("has-error");
			$(".registro-form-contraseña2-input").addClass("has-error");
			return false;
			
		// Email
		} else if(email == ""){
            $("#registro-form-correo-input").focus();
			$("#resultado-correo-error").html("Llene el campo de correo electrónico");
			$(".registro-form-correo-input").addClass("has-error");
            return false;
        } else if(!validacion_email.test(email)){
            $("#registro-form-correo-input").focus();
			$("#resultado-correo-error").html("El correo electrónico proporcionado no es válido");
			$(".registro-form-correo-input").addClass("has-error");
            return false;
			
		// Nombres
		} else if(nombres == ""){
            $("#registro-form-nombres-input").focus();
			$("#resultado-nombres-error").html("Llene el campo de nombre");
			$(".registro-form-nombres-input").addClass("has-error");
            return false;
			
		// Nacimiento
		} else if(dia == "día" || mes == "mes" || año == "año"){
			$("#resultado-nacimiento-error").html("Fecha inválida");
			$(".registro-form-nacimiento-input").addClass("has-error");
            return false;
			
		// Genero
		} else if(sexo == "0"){
			$("#resultado-sexo-error").html("Ponga su género");
			$(".registro-form-sexo-input").addClass("has-error");
            return false;
			
		/*
		----------------
		Envio de datos
		----------------
		*/
        } else {
			var datos = {
				"permiso" : permiso,
				"cuenta" : cuenta,
				"contraseña1" : contraseña1,
				"contraseña2" : contraseña2,
				"email" : email,
				"nombres" : nombres,
				"dia" : dia,
				"mes" : mes,
				"año" : año,
				"sexo" : sexo
				
			};
			$.ajax({
				type:  "POST",
				url:   "?p=ajax&action=registro",
				data:  datos,
				beforeSend: function () {
						new Spinner(opts).spin(document.getElementById("resultado"));
				},
				success:  function (respuesta) {
						$("#resultado").html((respuesta == "Registrado") ? location.reload() : "<div class='alert alert-warning'>" + respuesta + "</div>");
				},
				error: function() {
					$("#resultado").html("Error al enviar.")                 
				}
			});
			return false;
        }
    });
})();