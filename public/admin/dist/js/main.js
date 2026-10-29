/**
 * It takes the values of the input fields, sends them to the server, and if the server responds with a
 * status of 0, it displays an error message. Otherwise, it redirects the user to the /matches page.
 */
// Login
const login = () => {
    let user = $("#uname").val();
    let pass = $("#pwd").val();
 
    $.ajax({
        url: '/admin/login',
        type: 'POST',
        dataType: 'json',
        data: { "user" : user, "pass" : pass },
        success: function(response){
            const respuesta = response;

            if(respuesta.status == 0){
                $("#error_login").text(respuesta.message || 'Usuario y/o contraseña incorrectos');
                return;

            }else{
                $("#error_login").empty();
                window.self.location='/panel/home';
            }


        },
        error: function (obj, error, objError){
            $("#error_login").text('No fue posible iniciar sesión. Intenta nuevamente.');
        }
    })
}
