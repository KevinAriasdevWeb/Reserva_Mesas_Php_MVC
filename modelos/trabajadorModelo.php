<?php
require_once "mainModel.php";


class trabajadorModelo extends mainModel{

/*------Modelo Agregar Trabajador -----*/

protected static function agregar_trabajador_modelo($datos){

$sql=mainModel::conectar()->prepare("INSERT INTO trabajador(rut_Trabajador_PK,clave_trabajador,nombre,apellido,edad,correo_trabajador,telefono_trabajador,trabajador_privilegio,direccion,comuna,numero_casa,region) 
VALUES(:rut,:clave,:nombre,:apellido,:edad,:correo,:telefono,:privilegio,:direccion,:comuna,:numero_casa,:region)");

$sql->bindParam(":rut",$datos['rut']);
$sql->bindParam(":clave",$datos['clave']);
$sql->bindParam(":nombre",$datos['nombre']);
$sql->bindParam(":apellido",$datos['apellido']);
$sql->bindParam(":edad",$datos['edad']);
$sql->bindParam(":correo",$datos['correo']);
$sql->bindParam(":telefono",$datos['telefono']);
$sql->bindParam(":privilegio",$datos['privilegio']);
$sql->bindParam(":direccion", $datos['direccion']);
$sql->bindParam(":comuna", $datos['comuna']);
$sql->bindParam(":numero_casa", $datos['numero_casa']);
$sql->bindParam(":region", $datos['region']);
$sql->execute();
return $sql;


}

/*------Modelo Eliminar Trabajador -----*/

protected static function eliminar_trabajador_modelo($rut_trabajdor){
$sql=mainModel::conectar()->prepare("DELETE FROM trabajador WHERE rut_Trabajador_PK=:rut");
$sql->bindParam("rut",$rut_trabajdor);
$sql->execute();
return $sql;

}



/*------Modelo Datos Trabajador -----*/

protected static function datos_trabajador_modelo($tipo,$rut){
    //Unico es para cargar datos del trabajador
    if($tipo=="Unico"){
        $sql=mainModel::conectar()->prepare("SELECT * FROM trabajador WHERE rut_Trabajador_PK=:RUT");
        $sql->bindParam("RUT",$rut);
    }elseif($tipo=="Contador"){
        $sql=mainModel::conectar()->prepare("SELECT rut_Trabajador_PK FROM trabajador WHERE trabajador_privilegio='2'");
        
    }
    $sql->execute();
    return $sql;
   
    }
    

/*------Modelo para actualizar Trabajador -----*/

protected static function actualizar_trabajador_modelo($datos){

    $sql=mainModel::conectar()->prepare("UPDATE trabajador SET rut_Trabajador_PK=:rut_Trabajador_PK, clave_trabajador=:clave_trabajador,Nombre=:Nombre,apellido=:apellido,edad=:edad
    ,correo_trabajador=:correo_trabajador,telefono_trabajador=:telefono_trabajador,trabajador_privilegio=:trabajador_privilegio,direccion=:direccion,comuna=:comuna,
    numero_casa=:numero_casa,region=:region WHERE rut_Trabajador_PK=:rut_Trabajador_PK");
    $sql->bindParam("rut_Trabajador_PK",$datos['rut_Trabajador_PK']);
    $sql->bindParam("clave_trabajador",$datos['clave_trabajador']);
    $sql->bindParam("Nombre",$datos['Nombre']);
    $sql->bindParam("apellido",$datos['apellido']);
    $sql->bindParam("edad",$datos['edad']);
    $sql->bindParam("correo_trabajador",$datos['correo_trabajador']);
    $sql->bindParam("telefono_trabajador",$datos['telefono_trabajador']);
    $sql->bindParam("trabajador_privilegio",$datos['trabajador_privilegio']);
    $sql->bindParam("direccion",$datos['direccion']);
    $sql->bindParam("comuna",$datos['comuna']);
    $sql->bindParam("numero_casa",$datos['numero_casa']);
    $sql->bindParam("region",$datos['region']);
 
    $sql->execute();
    return $sql;


}





}





?>