const cambiar_tipo_usuario = (id_usuario, id_tipo_usuario) => {
	console.log(`id_usuario: ${id_usuario}, id_tipo_usuario: ${id_tipo_usuario}`);	

	if(id_tipo_usuario>0){
		$.ajax({
			url: "/panel/clientes/cambiar_tipo_usuario",
			type: "post",
			data: {
				"id_usuario": id_usuario,
				"id_tipo_usuario": id_tipo_usuario
			},
			success: function(response) {
                console.log("success");
				console.log(response);
				console.log(response.Tipo_Usuario);
				id_tipo_usuario = response.Tipo_Usuario.id_tipo_usuario;
                console.log(id_tipo_usuario);
                if(id_tipo_usuario == 1){
                    descuento = "NO";
                }else{
                    descuento = "SI";
                }

				document.querySelector('#resultTipoUsuario_' + id_usuario).innerHTML = descuento;
				document.querySelector('#id_tipo_usuario_' + id_usuario).selectedIndex = 0;


			}
		});
	}
}