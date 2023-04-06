<body class="login_body">
<div class="login-container">
		<div class="login-content">
			<p class="text-center">
				<i class="fas fa-user-circle fa-5x"></i>
			</p>
			<p class="text-center">
				Inicia sesión con tu cuenta
			</p>
			<form action="" method="POST" autocomplete="off" >
				<div class="form-group">
					<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; RUT</label>
					<input type="text" class="form-control" id="UserName" name="rut_login" pattern="\d{3,8}-[\d|kK]{1}" maxlength="35" required="" >
				</div>
				<div class="form-group">
					<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
					<input type="password" class="form-control" id="UserPassword" name="clave_login" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
				</div>
				<button type="submit" class="btn-login text-center">LOG IN</button>
               
			</form>
            <button type="submit" class="btn-login text-center"><a href="<?php echo SERVERURL;?>">VOLVER ATRAS</a></button>
            
		</div>
        </div>
      
        <?php
        if(isset($_POST['rut_login']) && isset($_POST['clave_login'])){
            require_once "./controladores/loginControlador.php";

            $inst_login = new loginControlador();
            echo $inst_login->iniciar_sesion_controlador();
        }
        ?>

</body>













    


