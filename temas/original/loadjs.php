<?php 
/*
	Load: CSS
*/
?>  
    <script src="<?php echo 'temas/'.$prop['tema'];?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo 'temas/'.$prop['tema'];?>/js/bootstrap.min.js"></script>
    <script src="<?php echo 'temas/'.$prop['tema'];?>/js/javascript.js"></script>
    <script src="<?php echo 'temas/'.$prop['tema'];?>/js/spin.min.js"></script>
    <script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/publicar.js"></script>
    
<?php if ($page == 'configuracion') { ?>
		<script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/configuracion_perfil_imagen.js"></script>
        <script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/configuracion_perfil_imagen_fondo.js"></script>
        <script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/configuracion_perfil_nombre.js"></script>
<?php }
	if ($page == 'login') { ?>
		<script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/login.js"></script>
<?php }
	if ($page == 'registro') { ?>
		<script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/registro.js"></script>
<?php }