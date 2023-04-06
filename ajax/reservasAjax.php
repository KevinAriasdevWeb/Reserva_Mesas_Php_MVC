<?php

$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['cliente_rut']) || isset($_POST['estatus_mesa_update']) || isset($_POST['numero_m_reg'])){

  /*------Instancia al controlador -----*/
  require_once "../controladores/reservasControlador.php";
  
  $ins_cliente = new reservasControlador();
  
  

  /*------Asignar mesa al cliente -----*/
  if(isset($_POST['cliente_rut']) && isset($_POST['numero_mesa_reg'])){
    
   
        echo $ins_cliente->agregar_reserva_controlador();
    
    
   
  }

   /*------Update estatus mesa -----*/
   if(isset($_POST['estatus_mesa_update']) ){
    
    echo $ins_cliente->cambiar_estatus_mesas_controlador();
   
  }

  /*------Agregar Nueva Mesa al LOCAL-----*/
  if(isset($_POST['numero_m_reg']) ){
    
    echo $ins_cliente->agregar_mesa_controlador();
   
  }



 

}else{
session_start(['name'=>'SDR']);
session_unset();
session_destroy();
header("Location: ".SERVERURL."login/");
}


?>