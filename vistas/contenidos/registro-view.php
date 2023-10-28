<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/index.css">
    <title>Registro</title>
</head>

<body class="body_index">
    <header>

        <div class="container__menu">
            <div class="logo_index">

                <img src="<?php echo SERVERURL; ?>vistas/images/logo3.png" alt="">
            </div>
            <div class="menu">
                <i class="fas fa-bars" id="btn_menu"></i>
                <div id="back_menu"></div>
                <nav id="nav">
                    <img src="<?php echo SERVERURL; ?>vistas/images/logo3.png" alt="">
                    <ul>

                        <li><a href="<?php echo SERVERURL; ?>">Inicio</a></li>
                        <li><a href="<?php echo SERVERURL; ?>registro" id="selected">Registro</a></li>
                        <li><a href="<?php echo SERVERURL; ?>login">Login</a></li>
                        <li><a href="<?php echo SERVERURL; ?>reservas">Reservas</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </header>

    <main>

        <div class="container__cover">
            <div class="form-register">

                <h4>Registro</h4>

                <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" data-form="save" autocomplete="off">
                    <input class="controls" type="text" pattern="\d{3,8}-[\d|kK]{1}" name="cliente_rut_reg" id="cliente_rut_reg" placeholder="Ingrese RUT con - guion ">
                    <input class="controls" type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" name="cliente_nombre_reg" id="cliente_nombre_reg" placeholder="Ingrese su Nombre">
                    <input class="controls" type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" name="cliente_apellido_reg" id="cliente_apellido_reg" placeholder="Ingrese su Apellido">
                    <input class="controls" type="password" pattern="[A-Za-z0-9!?-]{8,12}" name="cliente_clave_1_reg" id="cliente_clave_1_reg" placeholder="Ingrese su Contraseña min 8 caracteres">
                    <input class="controls" type="password"  pattern="[A-Za-z0-9!?-]{8,12}" name="cliente_clave_2_reg" id="cliente_clave_2_reg" placeholder="Repita su Contraseña">
                    <input class="controls" type="email" name="cliente_email_reg" id="cliente_email_reg" placeholder="Ingrese su Correo">
                    <input class="controls" type="text"  pattern="[0-9()+]{8,20}" name="cliente_telefono_reg" id="cliente_telefono_reg" placeholder="Ingrese su telefono">
                    <input class="controls" type="text"pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" name="cliente_direccion_reg" id="cliente_direccion_reg" placeholder="Ingrese su direccion">
                    <label for="cliente_direccion" class="bmd-label-floating">comuna</label>
										<select class="form-control" name="cliente_comuna_reg">
											<option value="" selected="" disabled="">Seleccione una opción</option>
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
                    
                    <p><a href="login">¿Ya tengo Cuenta?</a></p>
                    <p class="text-center" style="margin-top: 40px;">
                        <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i>  LIMPIAR</button>
                        
                        <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i>  REGISTRAR</button>
                    </p>
                </form>
            </div>
        </div>



    </main>

    <script src="<?php echo SERVERURL; ?>vistas/js/script.js"></script>

    <!--  footer -->
   <!--  footer -->
   <footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                   
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Llama  reserva nuestras mesas</h4>
                                <span>9xxxxx 0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Contacto</h4>
                                <span>resto-bar-platita@info.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                    <div class="cta-text">
                                <h4>Direccion</h4>
                                <span>1010 Avenue, Santiago Centro, Santiago</span>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18829.72209887011!2d-70.68411463386083!3d-33.458266573718845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c4f5c1b623a1%3A0x1cc3b94bad1ec315!2sLa%20Cazuela%20Bar%20Restaurante!5e0!3m2!1ses!2scl!4v1653534962584!5m2!1ses!2scl" width="500" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2022, All Right Reserved <a href="">RESTO-BAR PLATITA</a></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Terms</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Policy</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>





<style>
    .form-register {
        border: 1px solid #000000;
        width: 400px;
        background: #ffffff;
        padding: 30px;
        margin: auto;
        margin-top: 100px;
        border-radius: 4px;
        font-family: 'calibri';
        color: #212529;
        box-shadow: 7px 13px 37px #000;
    }

    .form-register h4 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .controls {
        width: 100%;
        background: #af954c36;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 16px;
        border: 1px solid #1f53c5;
        font-family: 'calibri';
        font-size: 18px;
        color: #212529;
    }

    .form-register p {

        height: 40px;
        text-align: center;
        font-size: 18px;
        line-height: 40px;
    }

    .form-register a {
        color: #212529;
        text-decoration: none;
    }

    .form-register a:hover {
        color: white;
        text-decoration: underline;
    }

    .form-register .botons {
        width: 100%;
        background: #323229;
        border: none;
        padding: 12px;
        color: #f8f9fa;
        margin: 16px 0;
        font-size: 16px;
    }
</style>