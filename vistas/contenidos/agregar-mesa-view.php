<?php 
if( $_SESSION['privilegio_SDR']==0){
	echo $inst_loginControlador->forzar_cierre_sesion_controlador();
    exit();
}

?>

<!-- Page header -->
<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR MESAS LOCAL
				</h3>
				<p class="text-justify">
					
			</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
                <li>
						<a class="active" href="<?php echo SERVERURL;?>agregar-mesa"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR MESAS</a>
					</li>
					<li>
						<a  href="<?php echo SERVERURL;?>reservation-list"><i class="fas fa-clipboard-list fa-fw "></i> &nbsp;RESERVACIONES</a>
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
				<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/reservasAjax.php" method="POST" data-form="save" autocomplete="off">
					<fieldset>
						<legend><i class="fas fa-user"></i> &nbsp; Información Mesas</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="numero_mesa_reg" class="bmd-label-floating">Numero Mesa</label>
										<input type="text" pattern="^[0-9]{0-2}" class="form-control" name="numero_m_reg" id="numero_mesa_reg" maxlength="27">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="posicion_mesa_reg" class="bmd-label-floating">Posicion Mesa</label>
										<input type="text" pattern="^[0-9]{0-2}" class="form-control" name="posicion_mesa_reg" id="posicion_mesa_reg" maxlength="40">
									</div>
								</div>
								
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
						&nbsp; &nbsp;
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR MESA</button>
					</p>
				</form>
			</div>	