<?php
require_once "mainModel.php";


class productosModelo extends mainModel{

/*------Modelo Agregar reserva -----*/

protected static function agregar_producto_modelo($datos){

    $sql=mainModel::conectar()->prepare("INSERT INTO items(name,description,price,image,category) 
    VALUES(:name,:description,:price,:image,:category)");
    
    $sql->bindParam(":name",$datos['name']);
    $sql->bindParam(":description",$datos['description']);
    $sql->bindParam(":price",$datos['price']);
    $sql->bindParam(":image",$datos['image']);
    $sql->bindParam(":category",$datos['category']);
    $sql->execute();
    return $sql;
    
    
    }


    /*------Modelo Eliminar productos -----*/

protected static function eliminar_producto_modelo($id){
    $sql=mainModel::conectar()->prepare("DELETE FROM items WHERE id=:id");
    $sql->bindParam("id",$id);
    $sql->execute();
    return $sql;
    
    }

    /*------Modelo Datos Menu -----*/

    protected static function  datos_menu_modelo($tipo,$id){
        //Unico es para cargar datos del trabajador
        if($tipo=="Unico"){
            $sql4=mainModel::conectar()->prepare("SELECT * FROM items WHERE id=:ID");
            $sql4->bindParam("ID",$id);
        }elseif($tipo=="Contador"){
            $sql4=mainModel::conectar()->prepare("SELECT id FROM items WHERE id!='0'");
            
        }
        $sql4->execute();
        return $sql4;
       
        }

   

}