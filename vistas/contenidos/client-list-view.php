<!-- Page header -->
<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES
				</h3>
				<p class="text-justify">
					Aqui podras ver la lista de cliente y buscar informacion de los clientes.
				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="client-new"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR CLIENTE</a>
					</li>
					<li>
						<a class="active" href="<?php echo SERVERURL; ?>client-list"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES</a>
					</li>
					<li>
						
					</li>
				</ul>	
			</div>
			
			<!-- Content here-->
			<div class="container-fluid">
			<?php 
			
			require_once "./controladores/clienteControlador.php";
			$inst_cliente = new clienteControlador();


			echo $inst_cliente->listar_cliente_controlador($pagina[0],50,$_SESSION['privilegio_SDR'],$_SESSION['rut_SDR'],$pagina[0],"");
			
			?>
				</div>
		