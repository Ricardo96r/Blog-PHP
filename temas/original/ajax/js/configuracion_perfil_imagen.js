function archivo(evt) {
  var files = evt.target.files; // FileList object

  // Obtenemos la imagen del campo "file".
  for (var i = 0, f; f = files[i]; i++) {
	//Solo admitimos imágenes.
	if (!f.type.match('image.*')) {
		continue;
	}

	var reader = new FileReader();

	reader.onload = (function(theFile) {
		return function(e) {
		  // Insertamos la imagen
		 document.getElementById("img_pf_cambiar").innerHTML = ['<img class="thumb img-responsive center-block" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
		 $("#upload-form-file").css({ padding: "0px",});
		};
	})(f);

	reader.readAsDataURL(f);
  }
}
document.$(".upload_pf_img-form-file").addEventListener('change', archivo, false);

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
		
		var imagen = $('.perfil_imagen_cambiar')[0].files[0];
		
		if (!imagen) {
			$("#resultado").html("<div class='alert alert-warning'>Coloque una imagen</div>");
		} else if(imagen.type != 'image/png' && imagen.type != 'image/jpeg') {
			$("#resultado").html("<div class='alert alert-warning'><strong>Imagen no válida</strong>. Solo fotos con extenciones jpeg y png. Tu extencion es "+ imagen.type +"</div>");
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