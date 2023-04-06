	<!-- Page header -->
    <div class="full-box page-header">
				<h3 class="text-center">
					<i class="fab fa-dashcube fa-fw "></i> &nbsp; SISTEMA GESTION DE RESERVAS MESAS 
				</h3>
				<p class="text-justify">

			</p>
			</div>
			
			<!-- Content -->
			<?php
				//instancia del controlador para hacer conteo de clientes
				require_once "./controladores/clienteControlador.php";
				$inst_cliente_conteo = new clienteControlador();
				$total_conteo_cliente=$inst_cliente_conteo->datos_cliente_controlador("Contador",0);
				?>
			<div class="full-box tile-container">
				<a href="<?php echo SERVERURL; ?>client-list" class="tile">
					<div class="tile-tittle">Clientes</div>
					<div class="tile-icon">
						<i class="fas fa-users fa-fw"></i>
						<p><?php echo $total_conteo_cliente->rowCount(); ?> Registrados</p>
					</div>
				</a>
				
				<?php
				//instancia del controlador para hacer conteo de productos
				require_once "./controladores/productosControlador.php";
				$inst_productos_conteo = new productosControlador();
				$total_conteo_productos=$inst_productos_conteo->datos_menu_controlador("Contador",0);
				?>
				<a href="<?php echo SERVERURL;?>menu-client" class="tile">
					<div class="tile-tittle">Menu</div>
					<div class="tile-icon">
						<i class="fas fa-pallet fa-fw"></i>
						<p><?php echo $total_conteo_productos->rowCount(); ?> Productos Registrado</p>
					</div>
				</a>

				<?php
				//instancia del controlador para hacer conteo de clientes
				require_once "./controladores/reservasControlador.php";
				$inst_reservas_conteo = new reservasControlador();
				$total_conteo_reservas=$inst_reservas_conteo->datos_reservas_controlador("Contador",0);
				?>
				<a href="<?php echo SERVERURL; ?>reservation-list" class="tile">
					<div class="tile-tittle">Reservaciones</div>
					<div class="tile-icon">
						<i class="far fa-calendar-alt fa-fw"></i>
						<p><?php echo $total_conteo_reservas->rowCount(); ?> Registradas</p>
					</div>
				</a>

				<?php
				//instancia del controlador para hacer conteo de trabajadores
				require_once "./controladores/trabajadorControlador.php";
				$inst_trabajador_conteo = new trabajadorControlador();
				$total_conteo_trabajador=$inst_trabajador_conteo->datos_trabajador_controlador("Contador",0);
				?>

				<a href="<?php echo SERVERURL; ?>trabajador-list" class="tile">
					<div class="tile-tittle">Trabajadores</div>
					<div class="tile-icon">
						<i class="fas fa-user-secret fa-fw"></i>
						<p> <?php echo $total_conteo_trabajador->rowCount(); ?> Registrados</p>
					</div>
				</a>

				<?php
				
				?>

			</div>