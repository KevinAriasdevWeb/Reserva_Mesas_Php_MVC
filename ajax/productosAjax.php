<?php

$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['name']) || isset($_POST['description']) ||  isset($_POST['producto_delete'])) {

    /*------Instancia al controlador -----*/
    require_once "../controladores/productosControlador.php";

    $ins_producto = new productosControlador();



    /*------Eliminar un producto -----*/
   if(isset($_POST['producto_delete']) ){
    
    echo $ins_producto->eliminar_producto_controlador();
   
  }
} else {
    session_start(['name' => 'SDR']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
}
