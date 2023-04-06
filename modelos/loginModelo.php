<?php
require_once "mainModel.php";


class loginModelo extends mainModel
{
    /*------Modelo para iniciar sesion trabajador -----*/

    protected static function iniciar_sesion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM trabajador WHERE rut_Trabajador_PK=:rut AND clave_trabajador=:clave");
        $sql->bindParam(":rut", $datos['rut']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->execute();
        return $sql;
    }

    /*------Modelo para iniciar sesion cliente-----*/
    protected static function iniciar_sesion_cliente_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM cliente WHERE rut_cliente_pk=:rut AND clave_cliente=:clave");
        $sql->bindParam(":rut", $datos['rut']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->execute();
        return $sql;
    }

    /*------Modelo para iniciar sesion administrador-----*/
    protected static function iniciar_sesion_administrador_modelo($datos)
    {
        $sql3 = mainModel::conectar()->prepare("SELECT * FROM administrador WHERE rut_administrador_pk=:rut AND clave_administrador=:clave");
        $sql3->bindParam(":rut", $datos['rut']);
        $sql3->bindParam(":clave", $datos['clave']);
        $sql3->execute();
        return $sql3;
    }


    




}
