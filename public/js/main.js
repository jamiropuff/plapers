// Login
const loginCliente = () => {
    console.log('loginCliente');
 
    let user = $("#uname").val();
    let pass = $("#pwd").val();
 
    console.log(`user: ${user}, pass: ${pass}`);
 
    $.ajax({
        url: '/login/autenticar',
        type: 'POST',
        data: { "user" : user, "pass" : pass },
        success: function(response){
            let respuesta = (typeof response === 'string') ? JSON.parse(response) : response;

            if (respuesta.status == 0) {
                let error_message = `
                    <div class="alert alert-danger py-2 px-3 small mt-2 mb-3" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> ${respuesta.message || 'Credenciales incorrectas'}
                    </div>
                `;
                $("#error_login").html(error_message);

                setTimeout(function(){ 
                    $("#error_login").html('');
                }, 5000);
            } else {
                window.location.href = respuesta.redirect || '/mi-cuenta';
            }
        },
        error: function (obj, error, objError){
            var error = objError;
            // console.log('Error al obtener el resultado. '+ error);
        }
    })
}
