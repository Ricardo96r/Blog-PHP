<nav>
	<ul>
		<?php if(!isset($_SESSION['username'])) { ?>
            <li><a href="?<?php echo $prop['nombre'];?>=principal">Inicio</a></li>
            <li><a href="?<?php echo $prop['nombre'];?>=principal&amp;page=registro">Registro</a></li>
		<?php } else { ?>
                <li><a href="?<?php echo $prop['nombre'];?>=principal">Inicio</a></li>
                <li><a href="?<?php echo $prop['nombre'];?>=principal&amp;page=top">Top</a></li>
                <li><a href="?<?php echo $prop['nombre'];?>=principal&amp;page=explora">Explora</a></li>
                <li><a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=enviar_publicacion">Publica</a></li>
                <?php 
			}
			?>-
	</ul>
</nav>
<section>