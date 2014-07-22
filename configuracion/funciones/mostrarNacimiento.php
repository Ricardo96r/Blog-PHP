<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
function mostrarNacimiento( $type ) {
	if ($type == 'mes') {
		echo '
			<select name=mes class=form-control id=mes>
				<option value=mes>Mes</option>
				<option value=1>
					Enero
				</option>	
				<option value=2>
					Febrero
				</option>	
				<option value=3>
					Marzo
				</option>	
				<option value=4>
					Abril
				</option>	
				<option value=5>
					Mayo
				</option>	
				<option value=6>
					Junio
				</option>	
				<option value=7>
					Julio
				</option>
				<option value=8>
					Agosto
				</option>
				<option value=9>
					Septiembre
				</option>
				<option value=10>
					Octubre
				</option>
				<option value=11>
					Noviembre
				</option>
				<option value=12>
					Diciembre
				</option>
			</select>
	';
	}
	if ($type == 'dia') {
		echo '<select name=dia class=form-control id=dia>';
		echo '<option value=day>Día</option>';
		$maxdy = 31;
		for ($i = 1; $i <= $maxdy; $i++)
		{
			echo '<option value='.$i.'>'.$i.'</option>';
		}
		echo '</select>';
	}
	if ($type == 'año') {
		echo '<select name=año class=form-control id=año>';
		echo '<option value=año>Año</option>';
		for ($i = date('Y'); $i >= 1900; $i--)
		{
			echo '<option value='.$i.'>'.$i.'</option>';
		}	 
		
		echo '</select>';
	}
}