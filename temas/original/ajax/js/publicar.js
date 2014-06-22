function imagen_fondo(evt) {
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
		 document.getElementById("img_publicacion").innerHTML = ['<img class="thumb img-responsive center-block" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
		 $("#upload-publicacion").css({ padding: "0px",});
		};
	})(f);

	reader.readAsDataURL(f);
  }
}
document.getElementById('upload-publicacion').addEventListener('change', imagen_fondo, false);

(function(){
    $("#publicacion-submit").click(function() {
		var fd = new FormData();
		var file_data = $('#publicacion_img')[0].files; // for multiple files
		
		for(var i = 0;i<file_data.length;i++){
			fd.append("publicacion_"+i, file_data[i]);
		}
		var other_data = $('form#form-publicacion').serializeArray();
		$.each(other_data,function(key,input){
			fd.append(input.name,input.value);
		});
		
		var imagen = $('#publicacion_img')[0].files[0];
		
		if (!imagen) {
			$("#resultado_publicacion").html("<div class='alert alert-warning'>Coloque una imagen</div>");
		} else if(imagen.type != 'image/png' && imagen.type != 'image/jpeg') {
			$("#resultado_publicacion").html("<div class='alert alert-warning'><strong>Imagen no válida</strong>. Solo fotos con extenciones jpeg y png. Tu extencion es "+ imagen.type +"</div>");
		} else if(imagen.size > 3145728) {
			$("#resultado_publicacion").html("<div class='alert alert-warning'>Solo se aceptan imagenes menores de 3MB</div>");
			
		} else {
			$.ajax({
				url:   "?p=ajax&action=publicacion",
				data: fd,
				contentType: false,
				processData: false,
				type: 'POST',
					beforeSend: function () {
							new Spinner(opts).spin(document.getElementById("resultado_publicacion"));
					},
					success:  function (respuesta) {
							$("#resultado_publicacion").html((respuesta == "Finalizado") ? location.reload() : "<div class='alert alert-warning'>" + respuesta + "</div>");
					},
					error: function() {
						$("#resultado_publicacion").html("Error al enviar.")                 
					}
				});
			return false;
		}
    });
})();