<?php 
if( $_SESSION['privilegio_SDR']!=3){
	echo $inst_loginControlador->forzar_cierre_sesion_controlador();
    exit();
}

?>


<!-- Page header -->
<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE TRABAJADORES
				</h3>
				<p class="text-justify">
					
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="trabajador-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO TRABAJADOR</a>
					</li>
					<li>
						<a class="active" href="trabajador-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE TRABAJADORES</a>
					</li>
					<li>
						
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
			<?php 
			
			require_once "./controladores/trabajadorControlador.php";
			$inst_trabajador = new trabajadorControlador();


			echo $inst_trabajador->listar_trabajador_controlador($pagina[0],10,$_SESSION['privilegio_SDR'],$_SESSION['rut_SDR'],$pagina[0],"");
			
			?>
			</div>