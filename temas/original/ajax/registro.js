(function(){
    $("#registro-submit").click(function() {
        var permiso = 'allowed';
			cuenta = $("#registro-form-cuenta-input").val();
            contraseña1 = $("#registro-form-contraseña1-input").val();
			contraseña2 = $("#registro-form-contraseña2-input").val();
			email = $('#registro-form-correo-input').val();
            validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
            nombre = $('#registro-form-nombres-input').val();
            dia = $('#dia').val();
			mes = $('#mes').val();
			año = $('#año').val();
			sexo = $('#registro-form-sexo-input').val();
			
		/*
		-----------------------
		Errores al registrarse
		-----------------------
		*/
		// Permiso 
        if (permiso != "allowed") {
            $("#resultado").html('Error...');
            return false;
			
		// Cuenta
		} else if(cuenta == ""){
			$("#registro-form-cuenta-input").focus();    
			return false;
		
		// Contraseña
		} else if(contraseña == ""){
			$("#registro-form-contraseña1-input").focus();    
			return false;
		} else if(contraseña1 == ""){
			$("#registro-form-contraseña2-input").focus();    
			return false;
			
		// Email
		} else if(email == "" || !validacion_email.test(email)){
            $("#registro-form-correo-input").focus();
            return false;
        } else if(email == "" || !validacion_email.test(email)){
            $("#registro-form-correo-input").focus();    
            return false;
			
		// Nombre
			
		// Nacimiento
		
		// Genero
			
		/*
		----------------
		Envio de datos
		----------------
		*/
        } else {
			var datos = {
				"permiso" : permiso,
				"cuenta" : cuenta,
				"contraseña" : contraseña,
				"contraseña2" : contraseña2,
				"email" : email,
				"nombres" : nombres,
				"dia" : dia,
				"mes" : mes,
				"año" : año,
				"sexo" : sexo,
			};
			$.ajax({
				data:  datos,
				url:   '?p=ajax&action=registro',
				type:  'post',
				beforeSend: function () {
						new Spinner(opts).spin(document.getElementById('resultado'));
				},
				success:  function (respuesta) {
						$('#resultado').html((respuesta == 'Registrado') ? location.reload() : respuesta);
				},
				error: function() {
					$('#resultado').html('Error al enviar.')                 
				}
			});
			return false;
        }
    });
})();