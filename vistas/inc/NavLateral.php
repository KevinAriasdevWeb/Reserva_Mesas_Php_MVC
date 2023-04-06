<section class="full-box nav-lateral">
			<div class="full-box nav-lateral-bg show-nav-lateral"></div>
			<div class="full-box nav-lateral-content">
				<figure class="full-box nav-lateral-avatar">
					<i class="far fa-times-circle show-nav-lateral"></i>
					<img src="<?php echo SERVERURL;?>vistas/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
					<figcaption class="roboto-medium text-center">
					BIENVENIDO<br><?php echo $_SESSION['nombre_SDR']." ".$_SESSION['apellido_SDR']; ?><br><small class="roboto-condensed-light"><?php echo $_SESSION['rut_SDR'] ?><br><a ><i class="fab fa-dashcube fa-fw"></i> &nbsp; ADMINISTRADOR </a></small>
					</figcaption>
				</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
						<li>
							<a href="<?php echo SERVERURL;?>home"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard </a>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-users fa-fw"></i> &nbsp; Clientes <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>client-new"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Cliente</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>client-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de clientes</a>
								</li>
								<li>
								
								</li>
							</ul>
						</li>
						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-pallet fa-fw"></i> &nbsp;  Carta Menu<i class="fas fa-chevron-down"></i></a>
							<ul>
							<li>
									<a href="<?php echo SERVERURL;?>menu-client"><i class="fas fa-plus fa-fw"></i> &nbsp; Menu Productos</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>agregar-producto"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Productos</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>eliminar-producto"><i class="fas fa-plus fa-fw"></i> &nbsp; Eliminar Productos</a>
								</li>
							
							</ul>
						</li>

					

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-file-invoice-dollar fa-fw"></i> &nbsp; Reservas <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>reservation-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista reservas</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>agregar-mesa"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Agregar Mesa nueva</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Trabajadores <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>trabajador-new"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo trabajador</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>trabajador-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de trabajdores</a>
								</li>
								<li>
									
								</li>
							</ul>
						</li>

						
					</ul>
				</nav>
			</div>
		</section>