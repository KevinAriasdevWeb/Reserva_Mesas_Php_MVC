<?php
require_once "mainModel.php";


class administradorModelo extends mainModel{

/*------Modelo Agregar cliente -----*/

protected static function agregar_administrador_modelo($datos){

$sql=mainModel::conectar()->prepare("INSERT INTO administrador(rut_administrador_pk,nombre,apellido,clave_administrador,correo_administrador,privilegio_administrador) 
VALUES(:rut,:nombre,:apellido,:clave,:correo,:privilegio_administrador)");

$sql->bindParam(":rut",$datos['rut']);
$sql->bindParam(":nombre",$datos['nombre']);
$sql->bindParam(":apellido",$datos['apellido']);
$sql->bindParam(":clave",$datos['clave']);
$sql->bindParam(":correo",$datos['correo']);
$sql->bindParam(":privilegio_administrador",$datos['privilegio_administrador']);
$sql->execute();
return $sql;


}




}


?>