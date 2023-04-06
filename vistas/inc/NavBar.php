<nav class="full-box navbar-info">
	<a href="#" class="float-left show-nav-lateral">
		<i class="fas fa-exchange-alt"></i>
	</a>
	<?php
	if ($_SESSION['privilegio_SDR'] == 4) {
	?>
		<a href="<?php echo SERVERURL . "trabajador-update/" . $inst_loginControlador->encryption($_SESSION['rut_SDR']) . "/"; ?>">
			<i class="fas fa-user-cog"></i>
		</a>
	<?php
	}

	?>

	<a href="<?php echo SERVERURL; ?>" class="btn-exit-system">
		<i class="fas fa-power-off"></i>
	</a>
</nav>