<?php 
if($inst_loginControlador->encryption($_SESSION['rut_SDR'])!=$pagina[1]){
	if( $_SESSION['privilegio_SDR']!=3){
		echo $inst_loginControlador->forzar_cierre_sesion_controlador();
		exit();
}
}


?>
<!-- Page header -->
<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR TRABAJADOR
				</h3>
				<p class="text-justify">
				</p>
			</div>
			
			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a  href="<?php echo SERVERURL; ?>trabajador-new"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO TRABAJADOR</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>trabajador-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE TRABAJADOR</a>
					</li>
					<li>
						
					</li>
				</ul>	
			</div>
			
			<!-- Content -->
			<div class="container-fluid">
				<?php 
				//Controlador para actualizar datos de trabajor
				require_once "./controladores/trabajadorControlador.php"; 
				$inst_trabajador = new trabajadorControlador();

				$datos_trabajador=$inst_trabajador->datos_trabajador_controlador("Unico",$pagina[1]);

				if($datos_trabajador->rowCount()==1){
					$campos=$datos_trabajador->fetch();
				?>
				<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/trabajadorAjax.php" method="POST" data-form="update" autocomplete="off">

				<input type="hidden" name="trabajador_rut_update" value="<?php echo $pagina[1]?>">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="trabajador_nombre" class="bmd-label-floating">Nombre</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="trabajador_nombre_up" id="trabajador_nombre" maxlength="35" required="" value="<?php echo $campos['Nombre'];?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="trabajador_apellido" class="bmd-label-floating">Apellido</label>
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="trabajador_apellido_up" id="trabajador_apellido" maxlength="35" required="" value="<?php echo $campos['apellido'];?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="trabajador_telefono" class="bmd-label-floating">Teléfono</label>
										<input type="text" pattern="[0-9()+]{8,100}" class="form-control" name="trabajador_telefono_up" id="trabajador_telefono" maxlength="20" value="<?php echo $campos['telefono_trabajador'];?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
								<div class="form-group">
										<label for="trabajador_telefono" class="bmd-label-floating">Edad</label>
										<input type="text"  class="form-control" name="trabajador_edad_up" id="trabajador_edad" maxlength="20" value="<?php echo $campos['edad'];?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
								<div class="form-group">
										<label for="trabajador_direccion" class="bmd-label-floating">Direccion</label>
										<input type="text"  class="form-control" name="trabajador_direccion_up" id="trabajador_direccion" maxlength="20" value="<?php echo $campos['direccion'];?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
								<div class="form-group">
										<label for="trabajador_direccion" class="bmd-label-floating">comuna</label>
										<select class="form-control" name="trabajador_comuna_up">
											<option value="" selected="" disabled="">Seleccione una opción</option>
											>
											<option value="Cerillos">Cerillos</option>
                                            <option value="Cerro Navia">Cerro Navia</option>
                                            <option value="Conchalí">Conchalí</option>
                                            <option value="El bosque">El bosque</option>
                                            <option value="Estación Central">Estación Central</option>
                                            <option value="Huechuraba">Huechuraba</option>
                                            <option value="Independencia">Independencia</option>
                                            <option value="La Cisterna">La Cisterna</option>
                                            <option value="La Florida">La Florida</option>
                                            <option value="La Granja">La Granja</option>
                                            <option value="La Pintana">La Pintana</option>
                                            <option value="La Reina">La Reina</option>
                                            <option value="Las Condes">Las Condes</option>
                                            <option value="Lo Barnechea">Lo Barnechea</option>
                                            <option value="Lo Espejo">Lo Espejo</option>
                                            <option value="Lo Prado">Lo Prado</option>
                                            <option value="Macul">Macul</option>
                                            <option value="Maipú">Maipú</option>
                                            <option value="Ñuñoa">Ñuñoa</option>
                                            <option value="Pedro Aguirre Cerda">Pedro Aguirre Cerda</option>
                                            <option value="Peñalolén">Peñalolén</option>
                                            <option value="Providencia">Providencia</option>
                                            <option value="Pudahuel">Pudahuel</option>
                                            <option value="Quilicura">Quilicura</option>
                                            <option value="Quinta Normal">Quinta Normal</option>
                                            <option value="Recoleta">Recoleta</option>
                                            <option value="Renca">Renca</option>
                                            <option value="San Joaquín">San Joaquín</option>
                                            <option value="San Miguel">San Miguel</option>
                                            <option value="San Ramón">San Ramón</option>
                                            <option value="Vitacura">Vitacura</option>
                                            <option value="Puente Alto">Puente Alto</option>
                                            <option value="Pirque">Pirque</option>
                                            <option value="San José de Maipo">San José de Maipo</option>
                                            <option value="Colina">Colina</option>
                                            <option value="Lampa">Lampa</option>
                                            <option value="San Bernardo">San Bernardo</option>
                                            <option value="Buin">Buin</option>
                                            <option value="Calera de Tango">Calera de Tango</option>
                                            <option value="Paine">Paine</option>
                                            <option value="Melipilla">Melipilla</option>
                                            <option value="Padre Hurtado">Padre Hurtado</option>
                                            <option value="Peñaflor">Peñaflor</option>
                                            <option value="Talagante">Talagante</option>
                                            <option value="Isla de Maipo">Isla de Maipo</option>
                                            <option value="El Monte">El Monte</option>
                                            <option value="María Pinto">María Pinto</option>
                                            <option value="San Pedro">San Pedro</option>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-4">
								<div class="form-group">
										<label for="trabajador_direccion" class="bmd-label-floating">Numero Casa</label>
										<input type="text"  class="form-control" name="trabajador_numero_casa_up" id="trabajador_numero_casa" maxlength="20" value="<?php echo $campos['numero_casa'];?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
								<div class="form-group">
										<div class="form-group">
										<label for="trabajador_direccion" class="bmd-label-floating">Region</label>
										<select class="form-control" name="trabajador_region_up">
											<option value="" selected="" disabled="">Seleccione una opción</option>
											<option value="Region Metropolitana">Region Metropolitana</option>
											<option value="Arica Parinacota">Arica Parinacota"</option>
											<option value="Tarapacá">Tarapacá</option>
											<option value="Antofagasta">Antofagasta</option>
											<option value="Atacama">Atacama</option>
											<option value="Coquimbo">Coquimbo</option>
											<option value="Valparaíso">Valparaíso</option>
											<option value="O´higgins">O´higgins</option>
											<option value="Maule">Maule</option>
											<option value="Ñuble">Ñuble</option>
											<option value="Bío Bío">Bío Bío</option>
											<option value="Araucanía">Araucanía</option>
											<option value="Los Ríos">Los Ríos</option>
											<option value="Los Lagos">Los Lagos</option>
											<option value="Aysén">Aysén</option>
											<option value="Magallanes y Antártica Chilena">Magallanes y Antártica Chilena</option>	
										</select>
									</div>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="trabajador_rut" class="bmd-label-floating">RUT</label>
										<input type="text"  pattern="\d{3,8}-[\d|kK]{1}" class="form-control" name="trabajador_rut_up" id="trabajador_rut" maxlength="11" required="" value="<?php echo $campos['rut_Trabajador_PK'];?>" >
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="trabajador_correo" class="bmd-label-floating">Email</label>
										<input type="email" class="form-control" name="trabajador_email_up" id="trabajador_email" maxlength="70" value="<?php echo $campos['correo_trabajador'];?> ">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="trabajador_clave_1" class="bmd-label-floating">Contraseña</label>
										<input type="password" class="form-control" name="trabajador_clave_1_up" id="trabajador_clave_1" pattern="[A-Za-z0-9!?-]{8,12}" maxlength="100" required="" >
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="trabajador_clave_2" class="bmd-label-floating">Repetir contraseña</label>
										<input type="password" class="form-control" name="trabajador_clave_2_up" id="trabajador_clave_2" pattern="[A-Za-z0-9!?-]{8,12}" maxlength="100" required="" >
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
									<p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
									<p><span class="badge badge-dark">Sin privilegiosr</span> Sin permisos</p>
									<div class="form-group">
										<select class="form-control" name="trabajador_privilegio_up">
											
											<option value="3" <?php if($campos['trabajador_privilegio']==3){ echo 'selected=""';}?> >Control total <?php if($campos['trabajador_privilegio']==3){ echo '(Actual)';}?></option>
											<option value="2" <?php if($campos['trabajador_privilegio']==2){ echo 'selected=""';}?>>registar y edicion <?php if($campos['trabajador_privilegio']==2){ echo '(Actual)';}?></option>
											<option value="0  <?php if($campos['trabajador_privilegio']==0){ echo 'selected=""';}?>">Sin privilegio <?php if($campos['trabajador_privilegio']==0){ echo '(Actual)';}?></option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<?php if($inst_loginControlador->encryption($_SESSION['rut_SDR'])!=$pagina[1]){  ?>
							<input type="hidden" name="tipo_cuenta" value="Impropia">

					<?php
					 }else{
					 ?>
					<input type="hidden" name="tipo_cuenta" value="Propia">
					<?php
					 }
					 ?>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					</p>
				</form>
				<?php 
				}else{
				?>

				<div class="alert alert-danger text-center" role="alert">
					<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
					<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
					<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
				</div>
				<?php 
				}
				?>
			</div>	
			</div>