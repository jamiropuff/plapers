
<script>

    const modalGetInfo = (modal,op) => {

        if(op == 'get'){
            // Ocultamos el boton del modal
            $("#infoModal").hide();
            // Abrimos el modal
            $(`#${modal}`).modal({
                backdrop: 'static',
                keyboard: false,
            });
            $(`#${modal}`).modal('show');
        }

        if(op == 'close'){
            // Cerramos el modal
            $(`#${modal}`).modal('hide');
            // Mostramos el boton del modal
            $("#infoModal").show();

        }
    }

    const solicitarInformacion = (op='') => {
        // console.log('solicitarInformacion');
        // console.log({op});

        // Obtenemos los inputs
        let nombre_info = $(`#nombre_info${op}`).val();
        let apellidos_info = $(`#apellidos_info${op}`).val();
        let correo_info = $(`#correo_info${op}`).val();
        let tel_info = $(`#tel_info${op}`).val();
        let plantel_info = $(`#plantel_info${op}`).val();
        let interes_info = $(`#interes_info${op}`).val();
        let medio_info = $(`#medio_info${op}`).val();
        let mensaje_info = $(`#mensaje_info${op}`).val();

        // console.log({nombre_info,apellidos_info,correo_info,tel_info,plantel_info,interes_info,medio_info,mensaje_info});

        // Validamos que se hayan capturado los datos
        if (nombre_info == "" || apellidos_info == "" || correo_info == "" || tel_info == "" || plantel_info == "" || interes_info == "" || medio_info == "" || mensaje_info == "")  {

            Swal.fire({
                title: 'Formulario de Información',
                text: 'Por favor, captura todos los datos para poder continuar',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });

            return false;

        }

        if (!$('#gridCheckInicio').prop('checked')) {
            Swal.fire({
                title: 'Formulario de Información',
                text: 'Por favor, acepta que reconoces haber leído las Políticas de nuestro Aviso de Privacidad y autorizas estar de acuerdo con el uso de ellas, así como con los Términos y Condiciones del sitio, para poder continuar.',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });

            return false;
        }
    
        // Validamos el recaptcha
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfCs6YpAAAAALLRFG-tbk5_VX1kMDyhuM9Lh6lx', {action:'validate_captcha'})
                .then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;

                // Ejecutamos la petición
                $.ajax({
                    url: "/solicitar_informacion",
                    type: 'POST',
                    data: {
                        'nombre': nombre_info,
                        'apellidos': apellidos_info,
                        'correo': correo_info,
                        'telefono': tel_info,
                        'plantel': plantel_info,
                        'interes': interes_info,
                        'medio': medio_info,
                        'mensaje': mensaje_info,
                        'token': token,
                    },
                    beforeSend: function() {
                        $("#loading1").show();
                    },
                    complete: function() {
                        $("#loading1").hide();
                    },
                    success: function(response) {
                        //console.log('success');
                        //console.log(response);

                        // Limpiamos los campos del formulario
                        if(response.message == 'success'){
                            $("#nombre_info").val('');
                            $("#apellidos_info").val('');
                            $("#correo_info").val('');
                            $("#tel_info").val('');
                            $("#plantel_info option[value=''").attr("selected",true);
                            $("#interes_info option[value=''").attr("selected",true);
                            $("#medio_info option[value=''").attr("selected",true);
                            $("#mensaje_info").val('');
                        }

                        // Información para la Alerta
                        var title = 'Formulario de Información';
                        var text = response.message_notify;
                        var icon = response.message;

                        Swal.fire({
                            title: title,
                            text: text,
                            icon: icon,
                            confirmButtonText: 'Aceptar',
                        });

                    },
                    error: function(obj, error, objError) {
                        var error = objError;
                        console.log('Error al obtener el resultado. ' + error);
                        $("#loading1").hide();
                    }
                });

            });
        });
    
    }

    const solicitarInformacionSlide = () => {

        // Obtenemos los inputs
        let nombre_info = $("#nombre_info_slide").val();
        let apellidos_info = $("#apellidos_info_slide").val();
        let correo_info = $("#correo_info_slide").val();
        let tel_info = $("#tel_info_slide").val();
        let plantel_info = $("#plantel_info_slide").val();
        let interes_info = $("#interes_info_slide").val();
        let medio_info = $("#medio_info_slide").val();
        let mensaje_info = $("#mensaje_info_slide").val();                

        // Validamos que se hayan capturado los datos
        if (nombre_info == "" || apellidos_info == "" || correo_info == "" || tel_info == "" || plantel_info == "" || interes_info == "" || medio_info == "" || mensaje_info == "")  {

            Swal.fire({
                title: 'Formulario de Información',
                text: 'Por favor, captura todos los datos para poder continuar',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });

            return false;

        }

        if (!$('#gridCheckSlide').prop('checked')) {
            Swal.fire({
                title: 'Formulario de Información',
                text: 'Por favor, acepta que reconoces haber leído las Políticas de nuestro Aviso de Privacidad y autorizas estar de acuerdo con el uso de ellas, así como con los Términos y Condiciones del sitio, para poder continuar.',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });

            return false;
        }
    
        // Validamos el recaptcha
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfCs6YpAAAAALLRFG-tbk5_VX1kMDyhuM9Lh6lx', {action:'validate_captcha'})
                .then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;

                // Ejecutamos la petición
                $.ajax({
                    url: "/solicitar_informacion",
                    type: 'POST',
                    data: {
                        'nombre': nombre_info,
                        'apellidos': apellidos_info,
                        'correo': correo_info,
                        'telefono': tel_info,
                        'plantel': plantel_info,
                        'interes': interes_info,
                        'medio': medio_info,
                        'mensaje': mensaje_info,
                        'token': token,
                    },
                    beforeSend: function() {
                        $("#loading1").show();
                    },
                    complete: function() {
                        $("#loading1").hide();
                    },
                    success: function(response) {
                        //console.log('success');
                        //console.log(response);

                        // Limpiamos los campos del formulario
                        if(response.message == 'success'){
                            $("#nombre_info_slide").val('');
                            $("#apellidos_info_slide").val('');
                            $("#correo_info_slide").val('');
                            $("#tel_info_slide").val('');
                            $("#plantel_info_slide option[value=''").attr("selected",true);
                            $("#interes_info_slide option[value=''").attr("selected",true);
                            $("#medio_info_slide option[value=''").attr("selected",true);
                            $("#mensaje_info_slide").val('');
                        }

                        var title = 'Formulario de Información';
                        var text = response.message_notify;
                        var icon = response.message;

                        Swal.fire({
                            title: title,
                            text: text,
                            icon: icon,
                            confirmButtonText: 'Aceptar',
                        });


                    },
                    error: function(obj, error, objError) {
                        var error = objError;
                        console.log('Error al obtener el resultado. ' + error);
                        $("#loading1").hide();
                    }
                });

            });
        });
    
    }

/* The `enviarContacto` function in the provided code is responsible for handling the submission of a
contact form. Here is a breakdown of what the function does: */
    const enviarContacto = () => {

        // Obtenemos los inputs
        let nombre_contacto = $("#nombre_contacto").val();
        let apellidos_contacto = $("#apellidos_contacto").val();
        let email_contacto = $("#email_contacto").val();
        let tel_contacto = $("#tel_contacto").val();
        let asunto_contacto = $("#asunto_contacto").val();
        let mensaje_contacto = $("#mensaje_contacto").val();

        // Validamos que se hayan capturado los datos
        if (nombre_contacto == "" || apellidos_contacto == "" || email_contacto == "" || tel_contacto == "" || asunto_contacto == "" || mensaje_contacto == "")  {

            Swal.fire({
                title: 'Formulario de Contacto',
                text: 'Por favor, captura todos los datos para poder continuar',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });

            return false;

        }

        if (!$('#gridCheckContacto').prop('checked')) {
            Swal.fire({
                title: 'Formulario de Contacto',
                text: 'Por favor, acepta que reconoces haber leído las Políticas de nuestro Aviso de Privacidad y autorizas estar de acuerdo con el uso de ellas, así como con los Términos y Condiciones del sitio, para poder continuar.',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });

            return false;
        }
    
        // Validamos el recaptcha
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfCs6YpAAAAALLRFG-tbk5_VX1kMDyhuM9Lh6lx', {action:'validate_captcha'})
                .then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;

                // Ejecutamos la petición
                $.ajax({
                    url: "/enviar_contacto",
                    type: 'POST',
                    data: {
                        'nombre': nombre_contacto,
                        'apellidos': apellidos_contacto,
                        'correo': email_contacto,
                        'telefono': tel_contacto,
                        'asunto': asunto_contacto,
                        'mensaje': mensaje_contacto,
                        'token': token,
                    },
                    beforeSend: function() {
                        $("#loading1").show();
                    },
                    complete: function() {
                        $("#loading1").hide();
                    },
                    success: function(response) {
                        //console.log('success');
                        //console.log(response);

                        // Limpiamos los campos del formulario
                        if(response.message == 'success'){
                            $("#nombre_contacto").val('');
                            $("#apellidos_contacto").val('');
                            $("#email_contacto").val('');
                            $("#tel_contacto").val('');
                            $("#asunto_contacto").val('');
                            $("#mensaje_contacto").val('');
                        }

                        var title = 'Formulario de Contacto';
                        var text = response.message_notify;
                        var icon = response.message;

                        Swal.fire({
                            title: title,
                            text: text,
                            icon: icon,
                            confirmButtonText: 'Aceptar',
                        });


                    },
                    error: function(obj, error, objError) {
                        var error = objError;
                        console.log('Error al obtener el resultado. ' + error);
                        $("#loading1").hide();
                    }
                });

            });
        });

    }


    // Modal Promociones
    const modalPromociones = () => {

        // Abrimos el modal
        $("#modal-promociones").modal('show');

    }
</script>