<?php
		if (isset($_POST['msg']) and isset($_POST['idmsg']) and is_numeric($_POST['idmsg']) and $_POST['idmsg'] > 0 and isset($_SESSION['username'])) {
			    $subcomentario = antiSqlInjection($_POST['msg']);
				$idmsg = antiSqlInjection($_POST['idmsg']);
				
                if(!isset($subcomentario) and empty($subcomentario)) {
                    echo "Porfavor no deje campos vacios";
                } elseif(strlen($subcomentario) < 20) {
                    echo "La nota es muy corta, tiene que tener mas de 20 caracteres";
                } elseif(strlen($subcomentario) > 400){
                    echo "La nota es muy larga, el máximo de caracteres es 400";
                } else {
                $enviar_nota = $db->query("
					INSERT INTO `subcomentarios` (`cuentas_idcuenta`, `comentarios_idcomentario`, `subcomentario`) 
					VALUES ('".$pf['idcuenta']."','".$idmsg."','".$subcomentario."')");
                echo "subcomentario enviado";
				}
			
			} else {
				echo "Error";
				}