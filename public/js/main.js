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
            console.log('success login');
            console.log(response);
            console.log(JSON.parse(response));

            respuesta = JSON.parse(response);

            if(respuesta.status == 0){
                console.log("error");
                error_message = ` ** Las credenciales son incorrectas <br> ${respuesta.message} `;
                $("#error_login").html(error_message);

                setTimeout(function(){ 
                $("#error_login").html('');
            }, 5000);

            }else{
                console.log("success process")
                window.self.location='/home';
            }


        },
        error: function (obj, error, objError){
            var error = objError;
            // console.log('Error al obtener el resultado. '+ error);
        }
    })
}
