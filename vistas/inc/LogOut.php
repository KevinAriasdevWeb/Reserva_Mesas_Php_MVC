<script>
    let btn_salir = document.querySelector(".btn-exit-system");

    btn_salir.addEventListener('click', function(e) {

        e.preventDefault();
        Swal.fire({
            title: 'Quiere salir del sistema?',
            text: "LA sesion actual se cerrara y saldras del sistema",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, exit!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.value) {
                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo $inst_loginControlador->encryption($_SESSION['token_SDR']); ?>';
                let $usuario_rut = '<?php echo $inst_loginControlador->encryption($_SESSION['rut_SDR']); ?>';

                let datos = new FormData();

                datos.append('token', token);
                datos.append('rut', $usuario_rut);
                fetch(url, {
                    method: 'POST',
                    body: datos
                })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }
        });

    });
</script>

