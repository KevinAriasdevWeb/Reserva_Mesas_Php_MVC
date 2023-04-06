<?php

if ($peticionAjax) {
    require_once "../modelos/productosModelo.php";
} else {
    require_once "./modelos/productosModelo.php";
}


class productosControlador extends productosModelo
{

    /*------Controlador Agregar productos -----*/
    public function agregar_producto_controlador()
    {
        //datos cliente
        $name = mainModel::limpiar_cadenas($_POST['name']);
        $description = mainModel::limpiar_cadenas($_POST['description']);
        $price = mainModel::limpiar_cadenas($_POST['price']);
        $category = mainModel::limpiar_cadenas($_POST['category']);
        $image = mainModel::limpiar_cadenas($_POST['image']);

        /*== Asignando valores ==*/

        $datos_producto_reg = [
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "category" => $category,
            "image" => $image

        ];


        $agregar_producto = productosModelo::agregar_producto_modelo($datos_producto_reg);

        if ($agregar_producto->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Producto registrado",
                "Texto" => "Los datos del producto fueron registrados",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "NO SE PUDO REGISTRAR EL PRODUCTO",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* Final del controlador*/

    /*------Controlador Agregar productos -----*/
    public function listar_productos_controlador($pagina, $registros, $url)
    {
        $pagina = mainModel::limpiar_cadenas($pagina);
        $registros = mainModel::limpiar_cadenas($registros);
        $url = mainModel::limpiar_cadenas($url);
        $url = SERVERURL . $url . "/";
        $tabla = "";

        //para asegurar que la url sea un numero
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
        $consulta = "SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category 
      FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id ";


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
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
                <th>PRECIO</th>
                <th>CATEGORY</th>
                <th>IMAGEN</th>
                <th>ELIMINAR</th>
            </tr>
        </thead>
        <tbody>';

        if ($total >= 1 && $pagina <= $Npagina) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= ' <tr class="text-center" >
          
                <td>' . $rows['id'] . '</td>
                <td>' . $rows['name'] . '</td>
                <td>' . $rows['description'] . '</td>
                <td>' . $rows['price'] . '</td>
                <td>' . $rows['category'] . '</td>
                <td>' . $rows['image'] . '</td>
                
                <td>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/productosAjax.php" method="POST" data-form="delete" autocomplete="off">
                    <input type="hidden" name="producto_delete" value="' . $rows['id'] . '">
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
            $tabla .= '<p class="text-center">Mostrando Productos ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npagina, $url, 7);
        }
        return $tabla;
    }/* Final del controlador*/

    public function eliminar_producto_controlador()
    {
        /*Recibiendo el rut del trabajador */
        $id = $_POST['producto_delete'];
        $id = mainModel::limpiar_cadenas($id);


        /*Eliminando trabajador en la base de datos*/
        $eliminar_producto = productosModelo::eliminar_producto_modelo($id);

        if ($eliminar_producto->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Producto Eliminado",
                "Texto" => "El Producto ha sido eliminado exitosamente del sistema",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido eliminar el Producto porfavor intente nuevamente ",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }/* Final del controlador*/




    public function datos_menu_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadenas($tipo);
        $rut = mainModel::decryption($id);

        $rut = mainModel::limpiar_cadenas($rut);

        return productosModelo::datos_menu_modelo($tipo, $id);
    }/* Final del controlador*/

}
