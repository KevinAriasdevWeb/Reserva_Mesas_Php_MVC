<?php

require_once "./modelos/vistasModelo.php";
//creamois una clase vistaControlador que hereda de vistaModelo
class vistasControlador extends vistasModelo
{
    /*------Controlador que se encarga de obtener plantilla -----*/
    public function obtener_plantilla_controlador()
    {
        //este controlador muestra la plantilla
        return require_once "./vistas/planitlla.php";
    }

    /*------Controlador que se encarga de obtener vistas -----*/

    public function obtener_vistas_controlador()
    {
        if(isset($_GET['views'])){
            $ruta=explode("/", $_GET['views']);
            $respuesta=vistasModelo::obtener_vistas_modelo($ruta[0]);
        }else{
            $respuesta="index";
        }
        return $respuesta;
    }

}
