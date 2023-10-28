<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/index.css">
    <title>Index</title>
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

                        <li><a href="<?php echo SERVERURL; ?>" id="selected">Inicio</a></li>
                        <li><a href="registro">Registro</a></li>
                        <li><a href="login">Login</a></li>
                        <li><a href="reservas">Reservas</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </header>

    <main>
        <div class="container__cover">
        
            <div class="cover">
                <div class="text">
                <h1 style="background-color:#CA9F2D;" >RESTO-BAR PLATITA</h1>
                    <img src="<?php echo SERVERURL; ?>vistas/images/chef.png" alt="chef">
                    

                    <p>
                        
                        El comedor del platita, con cabida para treinta comensales, nos ofrece posada al abrigo de su gran chimenea.
                        El comedor del platita está pensado para albergar pequeñas celebraciones o comidas de empresa, con una capacidad de hasta ochenta personas.
                        Además dispone de proyector y pantalla lo que posibilita su utilización para presentaciones y eventos similares.
                        El local, inaugurado en el verano de 2020, ofrece cocina tradicional con toques de modernidad. El restaurante aprovecha los productos de la zona 
                        ( excelentes carnes, salazones, pulpo, productos de la huerta, pescados de la cercana ría de Vigo…) combinándolos con nuevos sabores y texturas.</p>
                    

                </div>

                <div class="svg">
                    <img src="<?php echo SERVERURL; ?>vistas/images/logo_main.png" alt="">
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo SERVERURL; ?>vistas/js/script.js"></script>

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
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            
                            <div class="cta-text">
                                <h4>Direccion</h4>
                                <span>1010 Avenue, Santiago Centro, Santiago</span>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18829.72209887011!2d-70.68411463386083!3d-33.458266573718845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c4f5c1b623a1%3A0x1cc3b94bad1ec315!2sLa%20Cazuela%20Bar%20Restaurante!5e0!3m2!1ses!2scl!4v1653534962584!5m2!1ses!2scl" width="350" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    
                   
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