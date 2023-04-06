<?php
require_once "mainModel.php";


class reservasModelo extends mainModel{

/*------Modelo Agregar reserva -----*/

protected static function agregar_reserva_modelo($datos){

    $sql=mainModel::conectar()->prepare("UPDATE reserva_mesa SET id=:id,cantidad=:cantidad,rut_cliente=:rut_cliente,estatus=:estatus,fecha=:fecha,hora_reserva=:hora_reserva WHERE nombre=:numero_mesa");
    $sql->bindParam(":id",$datos['id']);
    $sql->bindParam(":cantidad",$datos['cantidad']);
    $sql->bindParam(":rut_cliente",$datos['rut_cliente']);
    $sql->bindParam(":estatus",$datos['estatus']);
    $sql->bindParam(":fecha",$datos['fecha']);
    $sql->bindParam(":numero_mesa",$datos['numero_mesa']);
    $sql->bindParam(":hora_reserva",$datos['hora_reserva']);
    $sql->execute();
    return $sql;
    
    
    }

  
 /*------Modelo para verificar estatus mesa-----*/
 protected static function estatus_mesa_modelo($datos)
 {
     $sql3 = mainModel::conectar()->prepare("SELECT estatus FROM reserva_mesa WHERE nombre=:numero_mesa ");
     $sql3->bindParam(":numero_mesa", $datos['numero_mesa']);
     $sql3->execute();
     return $sql3;
 }



 /*------Modelo Agregar reserva -----*/

protected static function cambiar_estatus_mesas_modelo($datos){

    $sql=mainModel::conectar()->prepare("UPDATE reserva_mesa SET rut_cliente=:rut_cliente, estatus=:estatus   WHERE posicion=:posicion");
    $sql->bindParam(":rut_cliente",$datos['rut_cliente']);
    $sql->bindParam(":posicion",$datos['posicion']);
    $sql->bindParam(":estatus",$datos['estatus']);
    
    $sql->execute();
    return $sql;
    
    
    }


    /*------Modelo Datos Reservas -----*/

protected static function datos_reservas_modelo($tipo,$rut){
    //Unico es para cargar datos del trabajador
    if($tipo=="Unico"){
        $sql4=mainModel::conectar()->prepare("SELECT * FROM reserva_mesa WHERE rut_cliente=:RUT");
        $sql4->bindParam("RUT",$rut);
    }elseif($tipo=="Contador"){
        $sql4=mainModel::conectar()->prepare("SELECT rut_cliente FROM reserva_mesa WHERE estatus!='0'");
        
    }
    $sql4->execute();
    return $sql4;
   
    }

  /*------Modelo Datos Reservas de clientes-----*/
    protected static function datos_reservas_cliente_modelo($tipo,$rut){
        //Unico es para cargar datos del trabajador
        if($tipo=="Unico"){
            $sql4=mainModel::conectar()->prepare("SELECT * FROM reserva_mesa WHERE rut_cliente=:RUT");
            $sql4->bindParam("RUT",$rut);
        }elseif($tipo=="Contador"){
            $sql4=mainModel::conectar()->prepare("SELECT * FROM reserva_mesa WHERE rut_cliente=:RUT AND estatus=1 " );
            $sql4->bindParam("RUT",$rut);
        }
        $sql4->execute();
        return $sql4;
       
        }



        /*------Modelo Agregar Mesa LOCAL -----*/

protected static function agregar_mesa_modelo($datos){

    $sql=mainModel::conectar()->prepare("INSERT INTO reserva_mesa(id,nombre,cantidad, posicion, rut_cliente, estatus, fecha, hora_reserva) 
    VALUES(:id,:nombre,:cantidad,:posicion,:rut_cliente,:estatus,:fecha,:hora_reserva)");
    $sql->bindParam(":id",$datos['id']);
    $sql->bindParam(":nombre",$datos['nombre']);
    $sql->bindParam(":cantidad",$datos['cantidad']);
    $sql->bindParam(":posicion",$datos['posicion']);
    $sql->bindParam(":rut_cliente",$datos['rut_cliente']);
    $sql->bindParam(":estatus",$datos['estatus']);
    $sql->bindParam(":fecha",$datos['fecha']);
    $sql->bindParam(":hora_reserva",$datos['hora_reserva']);
    $sql->execute();
    return $sql;
    
    
    }

    
    

}
