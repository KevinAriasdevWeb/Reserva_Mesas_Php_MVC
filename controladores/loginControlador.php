<?php

if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}


class loginControlador extends loginModelo
{


    /*------Controlador para iniciar sesion administrador -----*/
    public function iniciar_sesion_controlador()
    {
        $usuario_rut = mainModel::limpiar_cadenas($_POST['rut_login']);
        $usuario_clave = mainModel::limpiar_cadenas($_POST['clave_login']);
        
        /*== comprobar campos vacios ==*/

        if ($usuario_rut == "" || $usuario_clave == "") {
            echo '
            <script> 
            Swal.fire({
                title: "Ocrrio un error inesperado",
                text: "No ha llenado todos los campos requeridos",
                type: "error",
                confirmButtonText: "Aceptar"
            });
            </script>
            ';
        }
        
        $datos_login = [
            "rut" => $usuario_rut,
            "clave" => $usuario_clave
        ];
      
        //inicion sesion trabajador
        $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);
      
        //inicion sesion cliente
        $datos_cuenta2 = loginModelo::iniciar_sesion_cliente_modelo($datos_login);
      
        //inicion sesion trabajador
        $datos_cuenta3 = loginModelo::iniciar_sesion_administrador_modelo($datos_login);

      

        if ($datos_cuenta->rowCount() == 1) {
            $row = $datos_cuenta->fetch();

            session_start(['name' => 'SDR']);

            $_SESSION['rut_SDR'] = $row['rut_Trabajador_PK'];
            $_SESSION['nombre_SDR'] = $row['Nombre'];
            $_SESSION['apellido_SDR'] = $row['apellido'];
            $_SESSION['privilegio_SDR'] = $row['trabajador_privilegio'];
            $_SESSION['token_SDR'] = md5(uniqid(mt_rand(), true));

            return header("Location:" . SERVERURL . "home-trabajador/");
        } else if ($datos_cuenta2->rowCount() == 1) {
            $row2 = $datos_cuenta2->fetch();
            session_start(['name' => 'SDR']);

            $_SESSION['rut_SDR'] = $row2['rut_cliente_pk'];
            $_SESSION['nombre_SDR'] = $row2['nombre'];
            $_SESSION['apellido_SDR'] = $row2['apellido'];
            $_SESSION['privilegio_SDR'] = $row2['privilegio_cliente'];
            $_SESSION['token_SDR'] = md5(uniqid(mt_rand(), true));

            return header("Location:" . SERVERURL . "home-cliente/");
        } else if ($datos_cuenta3->rowCount() == 1) {
            $row3 = $datos_cuenta3->fetch();

            session_start(['name' => 'SDR']);

            $_SESSION['rut_SDR'] = $row3['rut_administrador_pk'];
            $_SESSION['nombre_SDR'] = $row3['nombre'];
            $_SESSION['apellido_SDR'] = $row3['apellido'];
            $_SESSION['privilegio_SDR'] = $row3['privilegio_administrador'];
            $_SESSION['token_SDR'] = md5(uniqid(mt_rand(), true));

            return header("Location:" . SERVERURL . "home/");
        } else if($datos_cuenta->rowCount() == 0 || $datos_cuenta2->rowCount() == 0 || $datos_cuenta3->rowCount() == 0){
            echo '
                <script> 
                Swal.fire({
                    title: "Ocrrio un error inesperado",
                    text: "El usuario o clave son incorrectos ",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
                </script>
                ';
        }


        
       


        
    }/* Final del controlador*/








    /*------Controlador para forzar cierre de sesion -----*/
    public function forzar_cierre_sesion_controlador()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            return "<script> windows.location.href='" . SERVERURL . "login/'; </script>";
        } else {
            return header("Location:" . SERVERURL . "login/");
        }
    }/* Final del controlador*/




     /*------Controlador  cierre de sesion -----*/

     public function cerrar_sesion_controlador()
     {
         session_start(['name'=>'SDR']);
         $token=mainModel::decryption($_POST['token']);
         $usuario_rut=mainModel::decryption($_POST['rut']);

         if($token==$_SESSION['token_SDR'] && $usuario_rut==$_SESSION['rut_SDR']){
            session_unset();
            session_destroy();
            $alerta=[
                "Alerta"=>"redireccionar",
                "URL"=>SERVERURL."login/"
            ];
         }else{

            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"ocurrio un error inesperado al cerrar sesion",
                "Texto"=>"No se pudo cerrar la session en el sistema",
                "Tipo"=>"error"

            ];
         }

    echo json_encode($alerta);
     }/* Final del controlador*/


}
