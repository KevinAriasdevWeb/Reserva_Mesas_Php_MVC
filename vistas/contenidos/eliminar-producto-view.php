<?php 
if( $_SESSION['privilegio_SDR']==0){
	echo $inst_loginControlador->forzar_cierre_sesion_controlador();
    exit();
}

?>


<!-- Page header -->
<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS
				</h3>
			
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					
					<li>
						<a class="active" href="trabajador-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS</a>
					</li>
					
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
			<?php 
			
			require_once "./controladores/productosControlador.php";
			$inst_productos= new productosControlador();


			echo $inst_productos->listar_productos_controlador($pagina[0],10,$pagina[0]);
			
			?>
			</div>