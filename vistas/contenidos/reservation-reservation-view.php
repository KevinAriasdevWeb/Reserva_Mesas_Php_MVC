    <!-- Page header -->
    <div class="full-box page-header">
        <h3 class="text-left">
            <i class="far fa-calendar-alt fa-fw"></i> &nbsp; RESERVACIONES CLIENTE
        </h3>
        <p class="text-justify">
            Podras visualizar tus datos de reserva
        </p>
    </div>

    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">

            <li>
                <a  href="reserva-mesas"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA RESERVA </a>
            </li>
            <li>
                <a class="active"href="reservation-reservation"><i class="far fa-calendar-alt"></i> &nbsp; RESERVACIONES</a>
            </li>

        </ul>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">

            <?php
            //Instancia para mostar tabla con lista de reservas de solo clientes
            if ($_SESSION['privilegio_SDR'] == 0) {
                require_once "./controladores/reservasControlador.php";
                $inst_listar_reservas = new reservasControlador();


                echo $inst_listar_reservas->listar_reservas_cliente_controlador($pagina[0], 10, $_SESSION['privilegio_SDR'], $_SESSION['rut_SDR'], $pagina[0], "");
            }



            ?>
        </div>

    </div>