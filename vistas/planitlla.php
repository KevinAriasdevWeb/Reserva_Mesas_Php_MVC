<?php


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title><?php echo COMPANY; ?></title>
    <!-- CSS -->
    <?php
    include "./vistas/inc/Link.php";

    ?>


</head>

<body>
    <?php

    //llamamos al controlador  
    $peticionAjax = false;
    require_once "./controladores/vistasControlador.php";
    //instanciar el controlador de la vista
    $IV = new vistasControlador();
    //nombre de la vista que vamos a  mostrar
    $vistas = $IV->obtener_vistas_controlador();



    if ($vistas == "login" || $vistas == "404" || $vistas == "registro"|| $vistas == "reservas") {
        require_once "./vistas/contenidos/" . $vistas . "-view.php";
    } else {
        session_start(['name' => 'SDR']);
        // $pagina es para el listar trabajador y sus datos en la url
        $pagina=explode("/" , $_GET['views']);

        require_once "./controladores/loginControlador.php";
        $inst_loginControlador = new loginControlador();

        //verificamos si el usuario inicia sesion o no
        if (!isset($_SESSION['token_SDR']) || !isset($_SESSION['rut_SDR'])) {
            echo $inst_loginControlador->forzar_cierre_sesion_controlador();
            exit();
        }

    ?>

        <!-- Main container -->
        <main class="full-box main-container">

            <!-- Nav lateral -->
            <?php
            if ($_SESSION['privilegio_SDR'] == 3) {
                include "./vistas/inc/NavLateral.php";
            } else if ($_SESSION['privilegio_SDR'] == 2) {
                include "./vistas/inc/NavLateralTrabajador.php";
            } else {
                include "./vistas/inc/NavLateralCliente.php";
            }


            ?>



            <!-- Page content -->
            <section class="full-box page-content">
                <?php
                include "./vistas/inc/NavBar.php";

                include  $vistas;
                ?>
            </section>


        </main>


    <?php
     include "./vistas/inc/LogOut.php";
    }
    include "./vistas/inc/Script.php";

    ?>
</body>

</html>