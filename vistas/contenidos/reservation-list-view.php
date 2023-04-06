<?php 
if( $_SESSION['privilegio_SDR']==0){
	echo $inst_loginControlador->forzar_cierre_sesion_controlador();
    exit();
}

?>
 
 <!-- Page header -->
  <div class="full-box page-header">
			    <h3 class="text-left">
			        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE RESERVAS EN EL SISTEMA
			    </h3>
			    <p class="text-justify">
			        En esta seccion podras Visualizar las reservas con su estatus y cambiar el estatus a DISPONIBLE
			    </p>
			</div>

			<div class="container-fluid">
			    <ul class="full-box list-unstyled page-nav-tabs">
				
					<li>
						<a class="active"  href="<?php echo SERVERURL;?>reservation-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp;RESERVACIONES</a>
					</li>
					<li>
						<a  href="<?php echo SERVERURL;?>agregar-mesa"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR MESAS</a>
					</li>
			    </ul>
			</div>

			 <div class="container-fluid">
			 <?php 
			//Instancia para mostar tabla con lista de reservas
			require_once "./controladores/reservasControlador.php";
			$inst_listar_mesas = new reservasControlador();


			echo $inst_listar_mesas->listar_reservas_controlador($pagina[0],20,$_SESSION['privilegio_SDR'],$_SESSION['rut_SDR'],$pagina[0],"");
			
			?>
				</div>
				