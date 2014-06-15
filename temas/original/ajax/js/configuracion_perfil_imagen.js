(function(){
    $("#imagen_perfil-submit").click(function() {
		var fd = new FormData();
		var file_data = $('input[type="file"]')[0].files; // for multiple files
		
		for(var i = 0;i<file_data.length;i++){
			fd.append("file_"+i, file_data[i]);
		}
		var other_data = $('form').serializeArray();
		$.each(other_data,function(key,input){
			fd.append(input.name,input.value);
		});
		
		var imagen = $('#publicar-form-file-input')[0].files[0];
		
		if (!imagen) {
			$("#resultado").html("<div class='alert alert-warning'>Coloque una imagen</div>");
		}else if(imagen.type != "image/jpeg" || imagen.type != "image/png") {
			$("#resultado").html("<div class='alert alert-warning'><strong>Imagen inválida.</strong> Solo se aceptan imagenes image/jpeg y image/png. Tu extencion de archivo es: <strong>"+imagen.type+"</strong></div>");
		} else if(imagen.size > 3145728) {
			$("#resultado").html("<div class='alert alert-warning'>Solo se aceptan imagenes menores de 3MB</div>");
			
		} else {
			$.ajax({
				url:   "?p=ajax&action=configuracion_perfil_imagen",
				data: fd,
				contentType: false,
				processData: false,
				type: 'POST',
					beforeSend: function () {
							new Spinner(opts).spin(document.getElementById("resultado"));
					},
					success:  function (respuesta) {
							$("#resultado").html((respuesta == "Finalizado") ? location.reload() : "<div class='alert alert-warning'>" + respuesta + "</div>");
					},
					error: function() {
						$("#resultado").html("Error al enviar.")                 
					}
				});
			return false;
		}
    });
})();