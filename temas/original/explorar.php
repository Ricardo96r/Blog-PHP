<?php
/*
Mysql -> tabla -> verificado {
	0 = No verificado
	1 = Se edito
	2 = Verificado
	}
*/

$explorar = $db->query('
	SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion 
	FROM publicaciones
	INNER JOIN cuentas
	ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
	WHERE publicaciones.verificado = 2
	ORDER BY `idpublicacion` DESC');
?> 
	<div class="well-bl-1">
    	<div class="row">
        	<div class="col-md-12 text-center">
            <label>País:</label>
            <select>
                 <option value="VE">VE</option>
                 <option value="ES">ES</option>
            </select>
            <label>Idioma:</label>
            <select>
                <option value="es">Español</option>
                <option value="en">Inglés</option>
            </select>
            </div>
		</div>
    </div>
<?php	
while ($explora = $explorar->fetch_array()) {
			post($explora);
			}