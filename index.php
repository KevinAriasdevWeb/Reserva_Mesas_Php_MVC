<?php 

require_once "./config/APP.php";
require_once "./controladores/vistasControlador.php";
include "./vistas/inc/Link.php";

//instanciar el controlador de la vista
    $IV2 = new vistasControlador();
//nombre de la vista que vamosa  mostar
    $vistas=$IV2->obtener_vistas_controlador();
//Solo se mostrara index si esta en el buscar sino se carga la plantilla
    if($vistas=="index"){
        require_once "./vistas/contenidos/".$vistas."-view.php";
    }else{
       
            $plantilla = new vistasControlador();
            $plantilla -> obtener_plantilla_controlador();
        
        
    }


?>