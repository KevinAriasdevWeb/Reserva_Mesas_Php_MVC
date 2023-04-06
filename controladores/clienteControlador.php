<?php

if ($peticionAjax) {
    require_once "../modelos/clienteModelo.php";
} else {
    require_once "./modelos/clienteModelo.php";
}


class clienteControlador extends clienteModelo
{

    /*------Controlador Agregar Cliente -----*/
    public function agregar_cliente_controlador()
    {
        //datos cliente
        $rut_cliente = mainModel::limpiar_cadenas($_POST['cliente_rut_reg']);
        $nombre_cliente = mainModel::limpiar_cadenas($_POST['cliente_nombre_reg']);
        $apellido_cliente = mainModel::limpiar_cadenas($_POST['cliente_apellido_reg']);
        $clave1_cliente = mainModel::limpiar_cadenas($_POST['cliente_clave_1_reg']);
        $clave2_cliente = mainModel::limpiar_cadenas($_POST['cliente_clave_2_reg']);
        $correo_cliente = mainModel::limpiar_cadenas($_POST['cliente_email_reg']);
        $telefono_cliente = mainModel::limpiar_cadenas($_POST['cliente_telefono_reg']);

        //direccion cliente
        $direccion_cliente = mainModel::limpiar_cadenas($_POST['cliente_direccion_reg']);
        $comuna_cliente = mainModel::limpiar_cadenas($_POST['cliente_comuna_reg']);




        /*== comprobar campos vacios ==*/
        if (
            $rut_cliente == '' || $nombre_cliente == '' || $clave1_cliente == '' || $clave2_cliente == ''
            || $apellido_cliente == ''
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

        $check_rut = mainModel::ejecutar_consulta_simple("SELECT rut_cliente_pk FROM cliente WHERE rut_cliente_pk='$rut_cliente'");
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

        if ($correo_cliente != "") {
            if (filter_var($correo_cliente, FILTER_VALIDATE_EMAIL)) {
                $check_correo = mainModel::ejecutar_consulta_simple("SELECT correo_cliente FROM cliente WHERE correo_cliente='$correo_cliente'");
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

        if ($clave1_cliente != $clave2_cliente) {
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




        /*== Asignando valores ==*/

        $datos_cliente_reg = [
            "rut" => $rut_cliente,
            "nombre" => $nombre_cliente,
            "apellido" => $apellido_cliente,
            "clave" => $clave1_cliente,
            "correo" => $correo_cliente,
            "telefono" => $telefono_cliente,
            "direccion" => $direccion_cliente,
            "comuna" => $comuna_cliente,
            "privilegio_cliente" => 0
        ];


        //almacenamos los datos en una variable
        $agregar_cliente = clienteModelo::agregar_cliente_modelo($datos_cliente_reg);

        if ($agregar_cliente->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Cliente registrado",
                "Texto" => "Los datos del Cliente fueron registrados",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "NO SE PUDO REGISTRAR EL CLIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* Final del controlador*/



    /*------Controlador Listar Trabajador -----*/
    public function listar_cliente_controlador($pagina, $registros, $privilegio, $rut, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE ((rut_cliente_pk!='$rut')AND (rut_cliente_pk LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' 
           OR apellido LIKE '%$busqueda%' OR correo_cliente LIKE '%$busqueda%')) ORDER BY nombre ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE rut_cliente_pk!='$rut' ORDER BY nombre ASC LIMIT $inicio, $registros";
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
                   <th>EMAIL</th>
                   <th>TELÉFONO</th>
                   <th>DIRECCION</th>
                   <th>COMUNA</th>
                   <th>ACTUALIZAR</th>
                   <th>ELIMINAR</th>
               </tr>
           </thead>
           <tbody>';

        if ($total >= 1 && $pagina <= $Npagina) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= ' <tr class="text-center" >
              <td>' . $contador . '</td>
                   <td>' . $rows['rut_cliente_pk'] . '</td>
                   <td>' . $rows['nombre'] . ' ' . $rows['apellido'] . '</td>
                   <td>' . $rows['correo_cliente'] . '</td>
                   <td>' . $rows['telefono'] . '</td>
                   <td>' . $rows['direccion'] . '</td>
                   <td>' . $rows['comuna'] . '</td>
                 
                   <td>
                       <a href="' . SERVERURL . 'client-update/' . mainModel::encryption($rows['rut_cliente_pk']) . '/" class="btn btn-success">
                               <i class="fas fa-sync-alt"></i>	
                       </a>
                   </td>
                   <td>
                       <form class="FormularioAjax" action="' . SERVERURL . 'ajax/clienteAjax.php" method="POST" data-form="delete" autocomplete="off">
                       <input type="hidden" name="rut_cliente_delete" value="' . mainModel::encryption($rows['rut_cliente_pk']) . '">
                           <button type="submit" class="btn btn-warning">
                                   <i class="far fa-trash-alt"></i>
                           </button>
                       </form>
                   </td>
          </tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"> <td colspan="9"> 
                   <a href="' . $url . '" class="btn btn-raised btn-primary btn-sm"> Click aca para recargar el listado</a>
                   </td></tr>';
            } else {
                $tabla .= '<tr class="text-center"> <td colspan="9"> No hay registros en el sistema </td></tr>';
            }
        }

        $tabla .= '</tbody></table></div>';



        if ($total >= 1 && $pagina <= $Npagina) {
            $tabla .= '<p class="text-center">Mostrando Cliente ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npagina, $url, 7);
        }
        return $tabla;
    }/* Final del controlador*/


    /*------Controlador para eliminar Trabajador -----*/
    public function eliminar_cliente_controlador()
    {
        /*Recibiendo el rut del trabajador */
        $rut_cliente = mainModel::decryption($_POST['rut_cliente_delete']);
        $rut_cliente = mainModel::limpiar_cadenas($rut_cliente);


        /*Eliminando trabajador en la base de datos*/
        $eliminar_cliente = clienteModelo::eliminar_cliente_modelo($rut_cliente);

        if ($eliminar_cliente->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Trabajador Eliminado",
                "Texto" => "El trabajador ha sido eliminado exitosamente del sistema",
                "Tipo" => "success"
            ];
        } else {
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



    /*------Controlador Datos Cliente -----*/

    public function datos_cliente_controlador($tipo, $rut)
    {
        $tipo = mainModel::limpiar_cadenas($tipo);
        $rut = mainModel::decryption($rut);

        $rut = mainModel::limpiar_cadenas($rut);

        return clienteModelo::datos_cliente_modelo($tipo, $rut);
    }/* Final del controlador*/


    /*------Controlador Update Cliente -----*/

    public function actualizar_cliente_controlador()
    {
        //Recibir el rut
        $rut = mainModel::decryption($_POST['cliente_rut_update']);
        $rut = mainModel::limpiar_cadenas($rut);

        //Comprobar el usuario en la BD

        $check_cliente = mainModel::ejecutar_consulta_simple("SELECT * FROM  cliente WHERE rut_cliente_pk='$rut'");
        if ($check_cliente->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido encontrar al cliente en el sistema ",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else{

        

        $nombre = mainModel::limpiar_cadenas($_POST['cliente_nombre_up']);
        $apellido = mainModel::limpiar_cadenas($_POST['cliente_apellido_up']);
        $telefono = mainModel::limpiar_cadenas($_POST['cliente_telefono_up']);
        $direccion = mainModel::limpiar_cadenas($_POST['cliente_direccion_up']);
        $comuna = mainModel::limpiar_cadenas($_POST['cliente_comuna_up']);
        $email = mainModel::limpiar_cadenas($_POST['cliente_email_up']);
        $clave1 = mainModel::limpiar_cadenas($_POST['cliente_clave_1_up']);
        $clave2 = mainModel::limpiar_cadenas($_POST['cliente_clave_2_up']);
    



        /*== comprobar campos vacios ==*/
        if (
            $rut == '' || $nombre == '' || $apellido == '' ||  $clave1 == ''||  $clave2 == ''
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

 
        $datos_cliente_up = [
            "rut_cliente_pk" => $rut,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "clave_cliente" => $clave1,
            "correo_cliente" => $email,
            "telefono" => $telefono,
            "direccion" => $direccion,
            "comuna" => $comuna

        ];

        if (clienteModelo::actualizar_cliente_modelo($datos_cliente_up))
         {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Se actualizo los datos del cliente",
                "Texto" => "DATOS ACTUALIZADOS",
                "Tipo" => "success"
            ];
            
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se ha podido actualizar los datos",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    }/* Final del controlador*/

    
}
