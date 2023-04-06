<?php

if ($peticionAjax) {
    require_once "../modelos/trabajadorModelo.php";
} else {
    require_once "./modelos/trabajadorModelo.php";
}


class trabajadorControlador extends trabajadorModelo
{

    /*------Controlador Agregar Trabajador -----*/
    public function agregar_trabajador_controlador()
    {
        //datos trabajador
        $rut_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_rut_reg']);
        $clave1_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_clave_1_reg']);
        $clave2_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_clave_2_reg']);
        $nombre_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_nombre_reg']);
        $apellido_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_apellido_reg']);
        $edad_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_edad_reg']);
        $correo_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_email_reg']);
        $telefono_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_telefono_reg']);
        $privilegio_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_privilegio_reg']);
        //direccion trabajador
        $direccion_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_direccion_reg']);
        $comuna_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_comuna_reg']);
        $numero_casa_trabajador = mainModel::limpiar_cadenas($_POST['trabajador_numero_casa_reg']);
        $region = mainModel::limpiar_cadenas($_POST['trabajador_region_reg']);



        /*== comprobar campos vacios ==*/
        if (
            $rut_trabajador == '' || $nombre_trabajador == '' || $clave1_trabajador == '' || $clave2_trabajador == ''
            || $apellido_trabajador == ''
        ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Verificando integridad de los datos ==*/











        /*== Comprobando el rut no este repetido ==*/

        $check_rut = mainModel::ejecutar_consulta_simple("SELECT rut_Trabajador_PK FROM trabajador WHERE rut_Trabajador_PK='$rut_trabajador'");
        if ($check_rut->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "EL RUT INGRESADO YA SE ENCUENTRA REGISTRADO EN EL SISTEMA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*== Comprobando el correo no este repetido ==*/

        if ($correo_trabajador != "") {
            if (filter_var($correo_trabajador, FILTER_VALIDATE_EMAIL)) {
                $check_correo = mainModel::ejecutar_consulta_simple("SELECT correo_trabajador FROM trabajador WHERE correo_trabajador='$correo_trabajador'");
                if ($check_correo->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto" => "EL CORREO INGRESADO YA SE ENCUENTRA REGISTRADO EN EL SISTEMA",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*== Comprobando las claves en los dos campos del formulario==*/

        if ($clave1_trabajador != $clave2_trabajador) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Las claves ingresadas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
        }


        /*== Comprobando privilegio==*/

        if ($privilegio_trabajador < 1 || $privilegio_trabajador > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El privilegio seleccionado no es valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /*== Asignando valores ==*/

        $datos_trabajador_reg = [
            "rut" => $rut_trabajador,
            "clave" => $clave1_trabajador,
            "nombre" => $nombre_trabajador,
            "apellido" => $apellido_trabajador,
            "edad" => $edad_trabajador,
            "correo" => $correo_trabajador,
            "telefono" => $telefono_trabajador,
            "privilegio" => $privilegio_trabajador,
            "direccion" => $direccion_trabajador,
            "comuna" => $comuna_trabajador,
            "numero_casa" => $numero_casa_trabajador,
            "region" => $region
        ];


        //almacenamos los datos en una variable
        $agregar_trabajador = trabajadorModelo::agregar_trabajador_modelo($datos_trabajador_reg);

        if ($agregar_trabajador->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Trabajador registrado",
                "Texto" => "Los datos del trabajador fueron registrados",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "NO SE PUDO REGISTRAR EL TRABAJADOR",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* Final del controlador*/


    /*------Controlador Listar Trabajador -----*/
    public function listar_trabajador_controlador($pagina, $registros, $privilegio, $rut, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadenas($pagina);
        $registros = mainModel::limpiar_cadenas($registros);
        $privilegio = mainModel::limpiar_cadenas($privilegio);
        $rut = mainModel::limpiar_cadenas($rut);
        $url = mainModel::limpiar_cadenas($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadenas($busqueda);
        $tabla = "";

        //para asegurar que la url sea un numero
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM trabajador WHERE ((rut_Trabajador_PK!='$rut')AND (rut_Trabajador_PK LIKE '%$busqueda%' OR Nombre LIKE '%$busqueda%' 
            OR apellido LIKE '%$busqueda%' OR correo_trabajador LIKE '%$busqueda%')) ORDER BY Nombre ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM trabajador WHERE rut_Trabajador_PK!='$rut' ORDER BY Nombre ASC LIMIT $inicio, $registros";
        }

        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npagina = ceil($total / $registros);


        $tabla .= '<div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>#</th>
                    <th>RUT</th>
                    <th>NOMBRE</th>
                    <th>EDAD</th>
                    <th>EMAIL</th>
                    <th>TELÉFONO</th>
                    <th>DIRECCION</th>
                    <th>NUMERO CASA</th>
                    <th>COMUNA</th>
                    <th>REGION</th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>';

            if($total>=1 && $pagina<=$Npagina){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
               foreach($datos as $rows){
               $tabla.=' <tr class="text-center" >
               <td>'.$contador.'</td>
                    <td>'.$rows['rut_Trabajador_PK'].'</td>
                    <td>'.$rows['Nombre'].' '.$rows['apellido'].'</td>
                    <td>'.$rows['edad'].'</td>
                    <td>'.$rows['correo_trabajador'].'</td>
                    <td>'.$rows['telefono_trabajador'].'</td>
                    <td>'.$rows['direccion'].'</td>
                    <td>'.$rows['numero_casa'].'</td>
                    <td>'.$rows['comuna'].'</td>
                    <td>'.$rows['region'].'</td>
                  
                    <td>
                        <a href="'.SERVERURL.'trabajador-update/'.mainModel::encryption($rows['rut_Trabajador_PK']).'/" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>	
                        </a>
                    </td>
                    <td>
                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/trabajadorAjax.php" method="POST" data-form="delete" autocomplete="off">
                        <input type="hidden" name="rut_trabajador_delete" value="'.mainModel::encryption($rows['rut_Trabajador_PK']).'">
                            <button type="submit" class="btn btn-warning">
                                    <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
           </tr>';
           $contador++;
               }
               $reg_final=$contador-1;
            }else{
                if($total>=1){
                    $tabla.='<tr class="text-center"> <td colspan="9"> 
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm"> Click aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"> <td colspan="9"> No hay registros en el sistema </td></tr>';
                }
                
            }

        $tabla.='</tbody></table></div>';

        
            
            if($total>=1 && $pagina<=$Npagina){
                $tabla.='<p class="text-center">Mostrando trabajador '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';

                $tabla.=mainModel::paginador_tablas($pagina, $Npagina, $url, 7);
            }
        return $tabla;
    }/* Final del controlador*/


/*------Controlador para eliminar Trabajador -----*/
public function eliminar_trabajador_controlador(){
/*Recibiendo el rut del trabajador */
$rut_trabajador=mainModel::decryption($_POST['rut_trabajador_delete']);
$rut_trabajador=mainModel::limpiar_cadenas($rut_trabajador);


/*Eliminando trabajador en la base de datos*/
$eliminar_trabajador=trabajadorModelo::eliminar_trabajador_modelo($rut_trabajador);

if($eliminar_trabajador->rowCount()==1){
    $alerta = [
        "Alerta" => "recargar",
        "Titulo" => "Trabajador Eliminado",
        "Texto" => "El trabajador ha sido eliminado exitosamente del sistema",
        "Tipo" => "success"
    ];
}else{
    $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto" => "No hemos podido eliminar el trabajador porfavor intente nuevamente ",
        "Tipo" => "error"
    ];
}
echo json_encode($alerta);
exit();


}/* Final del controlador*/



/*------Controlador Datos Trabajador -----*/

public function datos_trabajador_controlador($tipo,$rut){
$tipo=mainModel::limpiar_cadenas($tipo);
$rut=mainModel::decryption($rut);

$rut=mainModel::limpiar_cadenas($rut);

return trabajadorModelo::datos_trabajador_modelo($tipo,$rut);

}/* Final del controlador*/


/*------Controlador para actualizar Trabajador -----*/

public function actualizar_trabajador_controlador(){
//Recibir el rut
$rut=mainModel::decryption($_POST['trabajador_rut_update']);
$rut=mainModel::limpiar_cadenas($rut);

//Comprobar el usuario en la BD

$check_trabajador=mainModel::ejecutar_consulta_simple("SELECT * FROM  trabajador WHERE rut_Trabajador_PK='$rut'");
if($check_trabajador->rowCount()<=0){
    $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto" => "No hemos podido encontrar al trabajador en el sistema ",
        "Tipo" => "error"
    ];
echo json_encode($alerta);
exit();
}else{

$datos_trabajador=$check_trabajador->fetch();


}

$nombre=mainModel::limpiar_cadenas($_POST['trabajador_nombre_up']);
$apellido=mainModel::limpiar_cadenas($_POST['trabajador_apellido_up']);
$telefono=mainModel::limpiar_cadenas($_POST['trabajador_telefono_up']);
$edad=mainModel::limpiar_cadenas($_POST['trabajador_edad_up']);
$direccion=mainModel::limpiar_cadenas($_POST['trabajador_direccion_up']);
$comuna=mainModel::limpiar_cadenas($_POST['trabajador_comuna_up']);
$numero_casa=mainModel::limpiar_cadenas($_POST['trabajador_numero_casa_up']);
$region=mainModel::limpiar_cadenas($_POST['trabajador_region_up']);
$email=mainModel::limpiar_cadenas($_POST['trabajador_email_up']);
$clave1=mainModel::limpiar_cadenas($_POST['trabajador_clave_1_up']);
$clave2=mainModel::limpiar_cadenas($_POST['trabajador_clave_2_up']);
$privilegio=mainModel::limpiar_cadenas($_POST['trabajador_privilegio_up']);



$tipo_cuenta=mainModel::limpiar_cadenas($_POST['tipo_cuenta']);


/*== comprobar campos vacios ==*/
if (
    $rut == '' || $nombre == '' || $apellido == ''
) {
    $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto" => "No has llenado todos los campos que son obligatorios",
        "Tipo" => "error"
    ];
    echo json_encode($alerta);
    exit();
}


$datos_trabajador_up=[
    "rut_Trabajador_PK"=>$rut,
    "clave_trabajador"=>$clave1,
    "Nombre"=>$nombre,
    "apellido"=>$apellido,
    "edad"=>$edad,
    "correo_trabajador"=>$email,
    "telefono_trabajador"=>$telefono,
    "trabajador_privilegio"=>$privilegio,
    "direccion"=>$direccion,
    "comuna"=>$comuna,
    "numero_casa"=>$numero_casa,
    "region"=>$region

];

if(trabajadorModelo::actualizar_trabajador_modelo($datos_trabajador_up)){
    $alerta = [
        "Alerta" => "recargar",
        "Titulo" => "Se actualizo los datos del trabajador",
        "Texto" => "DATOS ACTUALIZADOS",
        "Tipo" => "success"
    ];
}else{
    $alerta = [
        "Alerta" => "simple",
        "Titulo" => "Ocurrio un error inesperado",
        "Texto" => "No se ha podido actualizar los datos",
        "Tipo" => "error"
    ];
}
echo json_encode($alerta);






}/* Final del controlador*/

}
