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
		 document.getElementById("publicar-form-file-text").innerHTML = ['<img class="thumb img-responsive center-block" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
		 $("#publicar-form-file").css({ padding: "0px",});
		};
	})(f);

	reader.readAsDataURL(f);
  }
}
document.getElementById('publicar-form-file').addEventListener('change', archivo, false);