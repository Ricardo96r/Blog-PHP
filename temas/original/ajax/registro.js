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
			$("#resultado").html("Llene el campo cuenta"); 
			return false;
		
		// Contraseña
		} else if(contraseña1 == ""){
			$("#registro-form-contraseña1-input").focus();
			$("#resultado").html("Llene el campo contraseña");
			return false;
		} else if(contraseña2 == ""){
			$("#registro-form-contraseña2-input").focus();
			$("#resultado").html("Llene el campo repetir contraseña");
			return false;
		} else if(contraseña1 != contraseña2) {
			$("#registro-form-contraseña1-input").focus();
			$("#resultado").html("Los campos de contraseña y repetir contraseña no son iguales");
			return false;
			
		// Email
		} else if(email == ""){
            $("#registro-form-correo-input").focus();
			$("#resultado").html("Llene el campo de correo electrónico");
            return false;
        } else if(!validacion_email.test(email)){
            $("#registro-form-correo-input").focus();
			$("#resultado").html("El correo electrónico proporcionado no es válido");
            return false;
			
		// Nombres
		} else if(nombres == ""){
            $("#registro-form-nombres-input").focus();
			$("#resultado").html("Llene el campo de nombre");
            return false;
			
		// Nacimiento
		} else if(dia == "día" || mes == "mes" || año == "año"){
			$("#resultado").html("Ponga una fecha de nacimiento válida");
            return false;
			
		// Genero
		} else if(sexo == "género"){
			$("#resultado").html("Ponga su género");
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
						$("#resultado").html((respuesta == "Registrado") ? location.reload() : respuesta);
				},
				error: function() {
					$("#resultado").html("Error al enviar.")                 
				}
			});
			return false;
        }
    });
})();