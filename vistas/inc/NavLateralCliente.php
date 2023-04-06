<section class="full-box nav-lateral">
			<div class="full-box nav-lateral-bg show-nav-lateral"></div>
			<div class="full-box nav-lateral-content">
				<figure class="full-box nav-lateral-avatar">
					<i class="far fa-times-circle show-nav-lateral"></i>
					<img src="<?php echo SERVERURL;?>vistas/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
					<figcaption class="roboto-medium text-center">
					BIENVENIDO<br><?php echo $_SESSION['nombre_SDR']." ".$_SESSION['apellido_SDR']; ?><br><?php echo $_SESSION['rut_SDR'] ?><br>CLIENTE</small>
					</figcaption>
				</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
						<li>
							<a href="<?php echo SERVERURL;?>home-cliente"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard </a>
						</li>

					

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-pallet fa-fw"></i> &nbsp;  Carta Menu<i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>menu-client"><i class="fas fa-plus fa-fw"></i> &nbsp; Menu Productos</a>
								</li>
							
							</ul>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-file-invoice-dollar fa-fw"></i> &nbsp; Reservar Mesa <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>reserva-mesas"><i class="fas fa-plus fa-fw"></i> &nbsp; Nueva Reserva</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>reservation-reservation"><i class="far fa-calendar-alt fa-fw"></i> &nbsp;Reservaciones Hechas</a>
								</li>
							
							</ul>
						</li>

					

						<li>
							<a href="#"><i class="fas fa-store-alt fa-fw"></i> &nbsp; RESTO-BAR PLATITA</a>
						</li>
					</ul>
				</nav>
			</div>
		</section>