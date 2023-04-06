<?php 
if( $_SESSION['privilegio_SDR']==0){
	echo $inst_loginControlador->forzar_cierre_sesion_controlador();
    exit();
}

?>
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
				//instancia del controlador para hacer conteo de reservaciones
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

				
			</div>
 
    
   

	