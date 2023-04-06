<?php

$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['cliente_rut_reg']) || isset($_POST['rut_cliente_delete']) || isset($_POST['cliente_rut_update']) || isset($_POST['cliente_nombre_up'])){

  /*------Instancia al controlador -----*/
  require_once "../controladores/clienteControlador.php";
  
  $ins_cliente = new clienteControlador();
  


  /*------Agregar un trabajador -----*/
  if(isset($_POST['cliente_rut_reg']) && isset($_POST['cliente_nombre_reg'])){
    
    echo $ins_cliente->agregar_cliente_controlador();
   
  }

  /*------Eliminar un cliente -----*/
  if(isset($_POST['rut_cliente_delete']) ){
    
    echo $ins_cliente->eliminar_cliente_controlador();
   
  }

     /*------Actualizar un cliente datos -----*/
     if(isset($_POST['cliente_nombre_up'])){

       $ins_cliente->actualizar_cliente_controlador();
      }
    
    


}else{
session_start(['name'=>'SDR']);
session_unset();
session_destroy();
header("Location: ".SERVERURL."login/");
}


?>