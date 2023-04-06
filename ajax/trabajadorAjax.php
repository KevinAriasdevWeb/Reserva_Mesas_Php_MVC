<?php

$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['trabajador_rut_reg']) || isset($_POST['rut_trabajador_delete']) || isset($_POST['trabajador_rut_update'])){ 

  /*------Instancia al controlador -----*/
  require_once "../controladores/trabajadorControlador.php";
  
  $ins_trabajador = new trabajadorControlador();
  


  /*------Agregar un trabajador -----*/
  if(isset($_POST['trabajador_rut_reg']) && isset($_POST['trabajador_nombre_reg'])){
    
    echo $ins_trabajador->agregar_trabajador_controlador();
   
  }

   /*------Eliminar un trabajador -----*/
   if(isset($_POST['rut_trabajador_delete']) ){
    
    echo $ins_trabajador->eliminar_trabajador_controlador();
   
  }

   /*------Actualizar un trabajador datos -----*/
  if(isset($_POST['trabajador_rut_update'])){

  $ins_trabajador->actualizar_trabajador_controlador();
  }


  


}else{
session_start(['name'=>'SDR']);
session_unset();
session_destroy();
header("Location: ".SERVERURL."login/");
}


?>