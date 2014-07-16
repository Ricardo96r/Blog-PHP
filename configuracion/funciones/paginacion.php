<?php
function mostrar_mas($get, $count, $link, $cantidad) {
	if (isset($get) and is_numeric($get) and $get >= 0) {
		$count /= $cantidad;
		$gt = $get;
	?>
	<div class='well-bl-2 visible-xs visible-sm'><div class='row'><div class='col-xs-12'><?php publicidad();?></div></div></div>
 	
	<?php if ($get +1 >= $count) {?><div class="well-bl-1 text-center"><strong>No hay nada mas que mostrar</strong></div><?php }else {}
       if ($count != 0) { ?>
        <div class='row'>
    		<div class='col-xs-12'>
    			<div class='text-center'>
					<ul class='pagination pagination-lg'><?php
                      
                      	if ($get == 0) {
						  echo '<li class=disabled><a>&laquo; Anterior</a></li>';
						 } else {
						  echo '<li><a href='.$link.'='.($get-1).'>&laquo; Anterior</a></li>';
						 }
					
					# Si get == 0
                      if ($get == 0) {
						echo "<li class='active hidden-xs'><a href=".$link.'='.($get).'>'.($get).'</a></li>';
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+1).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+1).'>'.($get +1).'</a></li>';
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+2).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+2).'>'.($get +2).'</a></li>';
							    } 
						if ($get + 3 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+3).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+3).'>'.($get +3).'</a></li>';
							    } 
						if ($get + 4 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+4).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+4).'>'.($get +4).'</a></li>';
							    } 
								
					  # SI GET = 1
					  } else if ($get == 1) {
						echo '<li class=hidden-xs><a href='.$link.'='.($get-1).'>'.($get -1).'</a></li>'; 
						echo "<li class='active hidden-xs'><a href=".$link.'='.($get).'>'.($get).'</a></li>';
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+1).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+1).'>'.($get +1).'</a></li>';
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+2).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+2).'>'.($get +2).'</a></li>';
							    }
						if ($get + 3 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+3).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+3).'>'.($get +3).'</a></li>';
							    } 
                       		 
					   
						#Si get > 1
					  } else {
						echo '<li class=hidden-xs><a href='.$link.'='.($get-2).'>'.($get -2).'</a></li>';
						echo '<li class=hidden-xs><a href='.$link.'='.($get-1).'>'.($get -1).'</a></li>'; 
						echo "<li class='active hidden-xs'><a href=".$link.'='.($get).'>'.($get).'</a></li>';
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+1).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+1).'>'.($get +1).'</a></li>';
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+2).'</a></li>';
						    } else {
							   echo '<li class=hidden-xs><a href='.$link.'='.($get+2).'>'.($get +2).'</a></li>';
							    }
					  }
						if($get+1 >= $count) {
						  echo '<li class=disabled><a>Siguiente &raquo;</a></li>';
						  } else {
						  echo '<li><a href='.$link.'='.($get+1).'>Siguiente &raquo;</a></li>';
							}
					?></ul></div></div></div><?php
					#No hay nada esto pasa cuando count vale 0!
					  } else {
						  }
	} else {
		header('Location: ?p=404');
		}
	}