
	<!-- Page header -->
    <div class="full-box page-header">
				<h3 class="text-center">
					<i class="fab fa-dashcube fa-fw "></i> &nbsp; SISTEMA GESTION DE RESERVAS MESAS 
				</h3>
				<p class="text-justify">
					Menu Cliente en esta seccion podras Reservar una mesa en tiempo real y podras visualizar menu "Carta Restaurante" ademas de visualizar tu reserva.
				</p>
			</div>
			
			<!-- Content -->
			<div class="full-box tile-container">
			<?php
				//instancia del controlador para hacer conteo de clientes
				require_once "./controladores/reservasControlador.php";
				$inst_reservas_conteo = new reservasControlador();
				$total_conteo_reservas_clientes=$inst_reservas_conteo->datos_reservas_cliente_controlador("Contador",$_SESSION['rut_SDR']);
				?>
			
				<a href="<?php echo SERVERURL; ?>reservation-reservation" class="tile">
					<div class="tile-tittle">Reservaciones</div>
					<div class="tile-icon">
						<i class="far fa-calendar-alt fa-fw"></i>
						<p>Tienes: <?php echo $total_conteo_reservas_clientes->rowCount(); ?> Registradas</p>
					</div>
				</a>

				

				
			
			</div>