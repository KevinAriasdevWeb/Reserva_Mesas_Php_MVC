<?php
require_once "mainModel.php";


class clienteModelo extends mainModel{

/*------Modelo Agregar cliente -----*/

protected static function agregar_cliente_modelo($datos){

$sql=mainModel::conectar()->prepare("INSERT INTO cliente(rut_cliente_pk,nombre,apellido,clave_cliente,correo_cliente,telefono,direccion,comuna,privilegio_cliente) 
VALUES(:rut,:nombre,:apellido,:clave,:correo,:telefono,:direccion,:comuna,:privilegio_cliente)");

$sql->bindParam(":rut",$datos['rut']);
$sql->bindParam(":nombre",$datos['nombre']);
$sql->bindParam(":apellido",$datos['apellido']);
$sql->bindParam(":clave",$datos['clave']);
$sql->bindParam(":correo",$datos['correo']);
$sql->bindParam(":telefono",$datos['telefono']);
$sql->bindParam(":direccion",$datos['direccion']);
$sql->bindParam(":comuna",$datos['comuna']);
$sql->bindParam(":privilegio_cliente",$datos['privilegio_cliente']);
$sql->execute();
return $sql;
}

/*------Modelo Eliminar cliente -----*/

protected static function eliminar_cliente_modelo($rut_cliente){
    $sql=mainModel::conectar()->prepare("DELETE FROM cliente WHERE rut_cliente_pk=:rut");
    $sql->bindParam("rut",$rut_cliente);
    $sql->execute();
    return $sql;
    
    }


    /*------Modelo Datos Cliente -----*/

protected static function datos_cliente_modelo($tipo,$rut){
    //Unico es para cargar datos del trabajador
    if($tipo=="Unico"){
        $sql=mainModel::conectar()->prepare("SELECT * FROM cliente WHERE rut_cliente_pk=:RUT");
        $sql->bindParam("RUT",$rut);
    }elseif($tipo=="Contador"){
        $sql=mainModel::conectar()->prepare("SELECT rut_cliente_pk FROM cliente WHERE privilegio_cliente!='1'");
        
    }
    $sql->execute();
    return $sql;
   
    }


    /*------Modelo para actualizar Cliente -----*/

protected static function actualizar_cliente_modelo($datos){

    $sql=mainModel::conectar()->prepare("UPDATE cliente SET rut_cliente_pk=:rut_cliente_pk, nombre=:nombre ,apellido=:apellido,clave_cliente=:clave_cliente,correo_cliente=:correo_cliente,
    telefono=:telefono,direccion=:direccion,comuna=:comuna WHERE rut_cliente_pk=:rut_cliente_pk");
    $sql->bindParam("rut_cliente_pk",$datos['rut_cliente_pk']);
    $sql->bindParam("nombre",$datos['nombre']);
    $sql->bindParam("apellido",$datos['apellido']);
    $sql->bindParam("clave_cliente",$datos['clave_cliente']);
    $sql->bindParam("correo_cliente",$datos['correo_cliente']);
    $sql->bindParam("telefono",$datos['telefono']);
    $sql->bindParam("direccion",$datos['direccion']);
    $sql->bindParam("comuna",$datos['comuna']);
    $sql->execute();
    return $sql;


}
    





}


?>