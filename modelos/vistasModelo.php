<?php
	
	class vistasModelo{

		/*--------- Modelo obtener vistas ---------*/
		protected static function obtener_vistas_modelo($vistas){
			$listaBlanca=["home","home-cliente","home-trabajador","reserva-mesas","client-list","client-new","client-search",
			"client-update","reservation-list","reservation-new","reservation-pending","reservation-reservation",
			"reservation-search","reservation-update","trabajador-update","trabajador-new","trabajador-search",
			"trabajador-list","menu-client","agregar-producto","eliminar-producto","agregar-mesa","productos-carrito"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenidos/".$vistas."-view.php")){
					$contenido="./vistas/contenidos/".$vistas."-view.php";
				}else{
					$contenido="404";
				}
			}elseif($vistas=="login"){
				$contenido="login";
			}elseif($vistas=="registro"){
				$contenido="registro";
			}elseif($vistas=="reservas"){
				$contenido="reservas";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}