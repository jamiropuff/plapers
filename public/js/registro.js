// Registro de Cliente Plapers
const registrarCliente = async (event) => {
    event.preventDefault();

    const nombres         = $("#reg_nombres").val().trim();
    const paterno         = $("#reg_paterno").val().trim();
    const materno         = $("#reg_materno").val().trim();
    const username        = $("#reg_username").val().trim();
    const correo          = $("#reg_correo").val().trim();
    const password        = $("#reg_password").val();
    const passwordConfirm = $("#reg_password_confirm").val();
    const aceptaTerminos  = $("#reg_terminos").is(":checked");

    const $errorDiv = $("#error_registro");
    $errorDiv.html('');

    if (!nombres || !paterno || !username || !correo || !password) {
        mostrarError('Por favor completa todos los campos requeridos.');
        return;
    }

    if (password.length < 6) {
        mostrarError('La contraseña debe tener al menos 6 caracteres.');
        return;
    }

    if (password !== passwordConfirm) {
        mostrarError('Las contraseñas no coinciden.');
        return;
    }

    if (!aceptaTerminos) {
        mostrarError('Debes aceptar el Aviso de Privacidad.');
        return;
    }

    const $btn = $("#btnRegistro");
    const $btnText = $("#btnRegistroText");
    const $btnSpinner = $("#btnRegistroSpinner");

    $btn.prop("disabled", true);
    $btnText.text("Creando cuenta...");
    $btnSpinner.removeClass("d-none");

    try {
        const response = await $.ajax({
            url: BASE_URL + '/registro/guardar',
            type: 'POST',
            dataType: 'json',
            data: {
                nombres: nombres,
                paterno: paterno,
                materno: materno,
                username: username,
                correo_electronico: correo,
                password: password,
                password_confirm: passwordConfirm,
                acepta_terminos: aceptaTerminos ? 1 : 0
            }
        });

        if (response.status === 1) {
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido a Plapers!',
                text: response.message,
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = response.redirect || BASE_URL + '/mi-cuenta';
            });
        } else {
            mostrarError(response.message || 'Error al procesar el registro.');
            $btn.prop("disabled", false);
            $btnText.text("Crear Cuenta");
            $btnSpinner.addClass("d-none");
        }
    } catch (error) {
        console.error('Error en el registro:', error);
        mostrarError('Hubo un error de conexión al servidor. Inténtalo más tarde.');
        $btn.prop("disabled", false);
        $btnText.text("Crear Cuenta");
        $btnSpinner.addClass("d-none");
    }
};

const mostrarError = (mensaje) => {
    const errorHtml = `
        <div class="alert alert-danger alert-dismissible fade show text-start py-2 px-3 small" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    $("#error_registro").html(errorHtml);
};
