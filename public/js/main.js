// Login
const loginCliente = (page = "") => {
    console.log('loginCliente');

    let user = $("#uname").val();
    let pass = $("#pwd").val();

    console.log(`user: ${user}, pass: ${pass}`);

    $.ajax({
        url: '/login/autenticar',
        type: 'POST',
        data: { "user": user, "pass": pass },
        success: function (response) {
            console.log('success login');
            console.log(response);
            console.log(JSON.parse(response));

            respuesta = JSON.parse(response);

            if (respuesta.status == 0) {
                console.log("error");
                error_message = ` ** Las credenciales son incorrectas <br> ${respuesta.message} `;
                $("#error_login").html(error_message);

                setTimeout(function () {
                    $("#error_login").html('');
                }, 5000);

            } else {
                console.log("success process")
                const parametros = new URLSearchParams(window.location.search);
                const destino = parametros.get('redirect');

                // Solo permitimos destinos internos expresamente autorizados.
                const destinosPermitidos = [
                    'carrito/paso2'
                ];

                if (destinosPermitidos.includes(destino)) {
                    window.location.href = `${BASE_URL}/${destino}`;
                } else {
                    window.location.href = `${BASE_URL}/cliente`;
                }
            }
        },
        error: function (obj, error, objError) {
            var error = objError;
            // console.log('Error al obtener el resultado. '+ error);
        }
    })
}


function verificaLogin() {
    const boton = document.getElementById('btn-siguiente-paso');

    // Volver a comprobar que el paso 1 esté completo.
    validarPaso1();

    if (boton && boton.disabled) {
        return;
    }

    // El servidor verificará la sesión del cliente.
    window.location.href = `${BASE_URL}/carrito/continuar`;
}
