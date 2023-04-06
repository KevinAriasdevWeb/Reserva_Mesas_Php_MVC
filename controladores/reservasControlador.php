<?php

if ($peticionAjax) {
    require_once "../modelos/reservasModelo.php";
} else {
    require_once "./modelos/reservasModelo.php";
}


class reservasControlador extends reservasModelo
{
    /*------Controlador Agregar reserva -----*/
    public function agregar_reserva_controlador()
    {
        //datos mesa
        $cantidad_mesa = mainModel::limpiar_cadenas($_POST['cantidad_reg']);
        $rut_cliente = mainModel::limpiar_cadenas($_POST['cliente_rut']);
        $fecha_mesa = mainModel::limpiar_cadenas($_POST['fecha_reg']);
        $mesa = mainModel::limpiar_cadenas($_POST['numero_mesa_reg']);
        $estatus = mainModel::limpiar_cadenas($_POST['estatus_reg']);
        $hora_reserva = mainModel::limpiar_cadenas($_POST['hora_reserva_reg']);


        $check_estatus = mainModel::ejecutar_consulta_simple("SELECT estatus FROM reserva_mesa WHERE nombre='$mesa'");
        if ($check_estatus->rowCount() == 1) {
            $row = $check_estatus->fetch();

            $_SESSION['estatus_SDR'] = $row['estatus'];

            $check_rut = mainModel::ejecutar_consulta_simple("SELECT rut_cliente FROM reserva_mesa WHERE rut_cliente='$rut_cliente'");
            if ($check_rut->rowCount() > 0) {

                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "YA EXISTE UNA RESERVA PARA ESTE CLIENTE",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

                //Generando codigo aleatorio de reserva
                $correlativo=mainModel::ejecutar_consulta_simple("SELECT id FROM reserva_mesa WHERE rut_cliente='$rut_cliente'");
                $correlativo=($correlativo->rowCount())+1;
                $id_codigo=mainModel::generar_codigo_aleatorio("RS",5,$correlativo);

            /*== Asignando valores ==*/

            $datos_reserva_reg = [
                "id"=>$id_codigo,
                "cantidad" => $cantidad_mesa,
                "rut_cliente" => $rut_cliente,
                "estatus" => $estatus,
                "fecha" => $fecha_mesa,
                "numero_mesa" => $mesa,
                "hora_reserva" => $hora_reserva
            ];




            if ($_SESSION['estatus_SDR'] == 0) {
                $agregar_reserva = reservasModelo::agregar_reserva_modelo($datos_reserva_reg);

                if ($agregar_reserva->rowCount() == 1) {
                    $alerta = [
                        "Alerta" => "recargar",
                        "Titulo" => "Reserva registrada",
                        "Texto" => "La mesa fue registrada con exito",
                        "Tipo" => "success"
                    ];
                }
            } else {
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "La mesa ya esta ocupada elige otra1",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
        }

        
        

    }/* Final del controlador*/


    /*------Controlador Listar mesas -----*/
    public function listar_mesas_controlador($pagina, $registros, $url, $busqueda)
    {


        $pagina = mainModel::limpiar_cadenas($pagina);
        $registros = mainModel::limpiar_cadenas($registros);

        $url = mainModel::limpiar_cadenas($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadenas($busqueda);
        $tabla = "";

        //para asegurar que la url sea un numero
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT rut_cliente_pk  FROM cliente INNER JOIN reserva_mesa  ON cliente.rut_cliente_pk = reserva_mesa.rut_cliente $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reserva_mesa WHERE rut_cliente ORDER BY nombre ASC LIMIT $inicio, $registros";
        }

        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npagina = ceil($total / $registros);


        $tabla .= '<div class="table-responsive">
     <table border="0" style="width:80%;vertical-align:left;">
     <tbody>
         ';

        if ($total >= 1 && $pagina <= $Npagina) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                if ($rows['estatus']==0) {
                    $tabla .= ' 
                    
                    <td style="margin-right: 0px;vertical-align:left;width:10%;background-color:#49B677;border-radius: 20px;text-align: center;">
                    <a href="" class="btn-mesa2">
                    <font color="black" size="3"><strong>MESA ' . $rows['posicion'] . '</strong></font>
                   <img src="./vistas/assets/img/mesa.svg" style="width:100px;height:60px;"><br><strong>
                   <font color="blue">Disponible</font>
                       </strong>
                       </a>
                    </td>
                    ';
                   
                }else if ($rows['estatus'] ==1) {
                    $tabla .= ' 
                    
                    <td style=" width:10%;background-color:#DF575C;border-radius: 20px;text-align: center;">
                    <a href="" class="btn-mesa2">
                    <font color="black" size="3"><strong>MESA ' . $rows['posicion']  . '</strong></font>
                   <img src="./vistas/assets/img/mesa.svg" style="width:100px;height:60px;"><br><strong>
                   <font color="blue">Ocupado</font>
                       </strong>
                       </a>
                    </td>
                    ';
                    
                }
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

        


        return $tabla;
    }/* Final del controlador*/


    /*------Controlador Listar Reservas en administrador y trabajador -----*/
    public function listar_reservas_controlador($pagina, $registros, $privilegio, $rut, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reserva_mesa WHERE ((rut_cliente!='$rut')AND (rut_cliente LIKE '%$busqueda%')) ORDER BY posicion ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reserva_mesa WHERE rut_cliente!='$rut' ORDER BY posicion ASC LIMIT $inicio, $registros";
        }

        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npagina = ceil($total / $registros);


        $tabla .= '<div class="table-responsive">
         <table class="table table-dark table-sm" ">
        <thead>
            <tr class="text-center roboto-medium">
                
                <th>Mesa N°</th>
                <th>Cantidad Personas</th>
                <th>posicion</th>
                <th>Rut Cliente</th>
                <th>Estatus</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Actualizar</th>
                <th>PDF Reserva</th>
            </tr>
        </thead>
        <tbody>';

        if ($total >= 1 && $pagina <= $Npagina) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= ' <tr class="text-center" >
           
                <td>' . $rows['nombre'] . '</td>
                <td>' . $rows['cantidad'] . '</td>
                <td>' . $rows['posicion'] . '</td>
                <td>' . $rows['rut_cliente'] . '</td>';
                if ($rows['estatus'] == 1) {
                    $tabla .= '<td style="background-color:#DF575C;">Ocupado</td>';
                } else {
                    $tabla .= '<td style="background-color:#49B677;">Disponible</td>';
                }

                $tabla .= '   <td>' . $rows['fecha'] . '</td>
             <td>' . $rows['hora_reserva'] . '</td>
                <td>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/reservasAjax.php" method="POST" data-form="update" autocomplete="off">
                    <input type="hidden" name="estatus_mesa_update" value="' . $rows['posicion'] . '">
                  
                        <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync-alt"></i>	
                        </button>
                    </form>
                </td>
                <td>
				<a href="'.SERVERURL.'facturas/invoice.php?rut='.mainModel::encryption($rows['rut_cliente']).'" class="btn btn-info" target="_blank">
				<i class="fas fa-file-pdf"></i>	
				</a>
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
            $tabla .= '<p class="text-center">Mostrando Reserva ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npagina, $url, 20);
        }
        return $tabla;
    }/* Final del controlador*/


    /*------Controlador para eliminar Trabajador -----*/
    public function cambiar_estatus_mesas_controlador()
    {
        /*Recibiendo el rut del trabajador */
        $posicion = mainModel::limpiar_cadenas($_POST['estatus_mesa_update']);
        $estatus = 0;
        $rut = 0;
        if ($_POST['estatus_mesa_update']) {

            $rut = "11111111-" . (int)$_POST['estatus_mesa_update'];


            $datos_reserva_estatus = [
                "posicion" => $posicion,
                "rut_cliente" => $rut,
                "estatus" => $estatus
            ];
        }


        /*Eliminando trabajador en la base de datos*/
        $actualizar_mesa = reservasModelo::cambiar_estatus_mesas_modelo($datos_reserva_estatus);

        if ($actualizar_mesa->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Mesa Actualizada a Disponible",
                "Texto" => "Mesa actualizada exitosamente en el  sistema",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido actualizar la mesa porfavor intente nuevamente ",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }/* Final del controlador*/

    /*------Controlador Datos Reservas -----*/

    public function datos_reservas_controlador($tipo, $rut)
    {
        $tipo = mainModel::limpiar_cadenas($tipo);
        $rut = mainModel::decryption($rut);

        $rut = mainModel::limpiar_cadenas($rut);

        return reservasModelo::datos_reservas_modelo($tipo, $rut);
    }/* Final del controlador*/


    /*------Controlador Listar Reservas en Cliente -----*/
    public function listar_reservas_cliente_controlador($pagina, $registros, $privilegio, $rut, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reserva_mesa WHERE rut_cliente='$rut'  ORDER BY id ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM reserva_mesa WHERE rut_cliente='$rut' ORDER BY id ASC LIMIT $inicio, $registros";
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
                <th>Mesa N°</th>
                <th>Cantidad Personas</th>
                <th>posicion</th>
                <th>Rut Cliente</th>
                
                <th>Fecha</th>
                <th>Hora</th>
               
            </tr>
        </thead>
        <tbody>';

        if ($total >= 1 && $pagina <= $Npagina) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= ' <tr class="text-center" >';

                if ($rows['estatus'] == 1 && $rows['rut_cliente'] == $rut) {
                    $tabla .= ' <td>' . $contador . '</td>
                    <td>' . $rows['nombre'] . '</td>
                    <td>' . $rows['cantidad'] . '</td>
                    <td>' . $rows['posicion'] . '</td>
                    <td>' . $rows['rut_cliente'] . '</td>
                     <td>' . $rows['fecha'] . '</td>
             <td>' . $rows['hora_reserva'] . '</td>
           
                
       </tr>';
                }
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
            $tabla .= '<p class="text-center">Mostrando Reserva ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npagina, $url, 7);
        }
        return $tabla;
    }/* Final del controlador*/


    /*------Controlador Datos Reservas clientes -----*/

    public function datos_reservas_cliente_controlador($tipo, $rut)
    {
        $tipo = mainModel::limpiar_cadenas($tipo);
        $rut = mainModel::limpiar_cadenas($rut);

        return reservasModelo::datos_reservas_cliente_modelo($tipo, $rut);
    }/* Final del controlador*/


    /*------Controlador para agregar mesas a la lista de mesas disponibles -----*/
    public function agregar_mesa_controlador()
    {
        $mesa = mainModel::limpiar_cadenas($_POST['numero_m_reg']);
        $posicion_mesa = mainModel::limpiar_cadenas($_POST['posicion_mesa_reg']);
        /*== Asignando valores ==*/

        $datos_agregar_mesa = [
            "id"=>$mesa,
            "nombre" => $mesa,
            "cantidad" => 1,
            "posicion"=>$posicion_mesa,
            "rut_cliente" =>"25996851-8",
            "estatus" => 0,
            "fecha" => "2022-07-29",
            "hora_reserva" => "10:01:01"
        ];

        $agregar_mesa=reservasModelo::agregar_mesa_modelo($datos_agregar_mesa);
        if ($agregar_mesa->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Nueva Mesa registrada",
                "Texto" => "La mesa fue registrada con exito",
                "Tipo" => "success"
            ];
           
        }
        echo json_encode($alerta);




    }/* Final del controlador*/


    public function encryptar_rut($rut){
        $rut = mainModel::encryption($_SESSION['rut_SDR']);
        return $rut;
    }




}
