(function(){
    $("#login-submit").click(function() {
        var permiso = "allowed";
			email = $("#login-email").val();
            contraseña = $("#login-contraseña").val();
			validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
			
		/*
			Reiniciar errores
		*/
		$(".login-email").removeClass("has-error");
		$(".login-contraseña").removeClass("has-error");
		
		$("#resultado-email-error").html("");
		$("#resultado-contraseña-error").html(""); 
		
			
		/*
		-----------------------
		Errores al registrarse
		-----------------------
		*/
		// Permiso 
        if (permiso != "allowed") {
            $("#resultado").html("Error...");
            return false;
			
		// Email
		} else if(email == ""){
			$("#login-email").focus();
			$("#resultado-email-error").html(" *Llene el campo email"); 
			$(".login-email").addClass("has-error");
			return false;	
		} else if(!validacion_email.test(email)){
            $("#login-email").focus();
			$("#resultado-email-error").html(" *El correo electrónico proporcionado no es válido");
			$(".login-email").addClass("has-error");
            return false;
		
		// Contraseña
		} else if(contraseña == ""){
			$("#login-contraseña").focus();
			$("#resultado-contraseña-error").html(" *Ponga contraseña");
			$(".login-contraseña").addClass("has-error");
			return false;
			
		/*
		----------------
		Envio de datos
		----------------
		*/
        } else {
                var parametros = {
                        "permiso" : permiso,
                        "email" : email,
                        "contraseña" : contraseña,
                };
                $.ajax({
                        data:  parametros,
                        url:   '?p=ajax&action=login',
                        type:  'post',
                        beforeSend: function () {
                                new Spinner(opts).spin(document.getElementById('resultado'));
                        },
                        success: function(respuesta) {
                            $('#resultado').html((respuesta == 'Conectando...') 
							? location.reload() : "<div class='alert alert-warning text-center'><strong>" + respuesta + "</strong></div>");
                        },
						error: function() {
							$("#resultado").html("Error al enviar.")                 
				}
                });
			return false;
        }
    });
})();