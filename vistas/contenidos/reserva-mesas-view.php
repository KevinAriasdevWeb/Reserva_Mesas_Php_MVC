 <!-- Page header -->
 <div class="full-box page-header">
     <h3 class="text-left">
         <i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA RESERVA
     </h3>
     <p class="text-justify">
         Reserva tu mesa en tiempo real y de forma sencilla.
     </p>
 </div>

 <div class="container-fluid">
     <ul class="full-box list-unstyled page-nav-tabs">
         <li>
             <a class="active" href="#"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA RESERVA </a>
         </li>
         <li>
             <a href="reservation-reservation"><i class="far fa-calendar-alt"></i> &nbsp; RESERVACIONES</a>
         </li>


 </div>

 <div class="container-fluid">



     <div class="container-fluid form-neon">


         <div class="form-group row">

             <?php

                require_once "./controladores/reservasControlador.php";
                $inst_mesa = new reservasControlador();


                echo $inst_mesa->listar_mesas_controlador($pagina[0], 20, $pagina[0], "");

                ?>





             <form class="form form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/reservasAjax.php" method="POST" data-form="save" autocomplete="off">
                 <div class="row">
                     <div class="col-12 col-md-6">
                         <div class="form-group">

                             <select class="form-control" name="numero_mesa_reg" id="q1" onchange="load(1,'');">
                                 <option value="">-- Selecciona Mesa --</option>
                                 <?php
                                    require 'config/database.php';
                                    $db = Database::connect();
                                    foreach ($db->query('SELECT * FROM reserva_mesa') as $row) {
                                        echo '<option value="' . $row['posicion'] . '">' . $row['nombre'] . '</option>';;
                                    }

                                    ?>
                             </select>
                         </div>
                     </div>
                     <div class="col-12 col-md-4">
                         <div class="form-group">
                             <label for="trabajador_rut" class="bmd-label-floating">RUT</label>
                             <input type="text" pattern="\d{3,8}-[\d|kK]{1}" class="form-control" name="cliente_rut" id="cliente_rut" maxlength="11" required="" value="<?php echo $_SESSION['rut_SDR'] ?>">
                         </div>
                     </div>
                     <div class="col-12 col-md-6">
                         <div class="form-group">
                             <label for="trabajador_correo" class="bmd-label-floating">Cantidad Personas</label>
                             <input type="text" class="form-control" name="cantidad_reg" id="cantidad_reg" maxlength="70">
                         </div>
                     </div>
                     <div class="col-12 col-md-4">
                         <div class="form-group">
                             <label for="trabajador_clave_1" class="bmd-label-floating"></label>
                             <input type="date" class="form-control" name="fecha_reg" id="fecha_reg" maxlength="100" required="">
                             <input type="hidden" class="form-control" name="estatus_reg" value="1">
                             <input type="time" name="hora_reserva_reg" step="1">
                         </div>
                     </div>

                     <p class="text-center" style="margin-top: 40px;">
                         <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                         &nbsp; &nbsp;
                         
                         <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                     </p>

                 </div>




             </form>
                                    
             <?php
      
      foreach ($db->query('SELECT * FROM reserva_mesa') as $row) {
          if ($row['estatus'] == 1 && $row['rut_cliente'] == $_SESSION['rut_SDR']) { ?>
           <div class="wrapper">

               <div class="form">
                   <input hidden type="text" spellcheck="false" value="http://localhost/mesas_reservas/facturas/invoice.php?rut=<?php echo $inst_mesa->encryptar_rut($_SESSION['rut_SDR']) ?>">

                   <button>Generar Código QR</button>

               </div>

               <div class="qr-code">
                   <img src="" alt="qr-code">
               </div>
           </div>

   <?php
          }
      }

      ?>

         </div>
         
     </div>

     



     <style>
         .outer_div {
             display: inline-block;
         }

         .table-responsive {


             min-height: .01%;
             overflow-x: auto;
         }
     </style>
     <script>
         const wrapper = document.querySelector(".wrapper"),
             qrInput = wrapper.querySelector(".form input"),
             generateBtn = wrapper.querySelector(".form button"),
             qrImg = wrapper.querySelector(".qr-code img");
         let preValue;

         generateBtn.addEventListener("click", () => {
             let qrValue = qrInput.value.trim();
             if (!qrValue || preValue === qrValue) return;
             preValue = qrValue;
             generateBtn.innerText = "Generating QR Code...";
             qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
             qrImg.addEventListener("load", () => {
                 wrapper.classList.add("active");
                 generateBtn.innerText = "Generate QR Code";
             });
         });

         qrInput.addEventListener("keyup", () => {
             if (!qrInput.value.trim()) {
                 wrapper.classList.remove("active");
                 preValue = "";
             }
         });
     </script>