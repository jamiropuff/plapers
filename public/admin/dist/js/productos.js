const mostrarProducto = (producto="", subcategoria="", categoria="", foto="", clave="", descripcion="", largo="", ancho="", precio=0) => {
    var myModal = new bootstrap.Modal(document.getElementById('modalProducto'), {
        keyboard: false
    });

    document.getElementById('modalProducto').querySelector('.modal-title').innerText = producto;
    document.getElementById('modalProducto').querySelector('.modal-body').innerHTML = `
        <p><strong>Categoría:</strong> ${categoria}</p>
        <p><strong>Subcategoría:</strong> ${subcategoria}</p>
        <p><strong>Clave:</strong> ${clave}</p>
        <p><strong>Descripción:</strong> ${descripcion}</p>
        <p><strong>Largo:</strong> ${largo} cm</p>
        <p><strong>Ancho:</strong> ${ancho} cm</p>
        <p><strong>Precio Unitario:</strong> $${precio}</p>
        <p><strong>Foto:</strong></p>
        <img src="${foto}" alt="${producto}" class="img-fluid"/>
    `;

    myModal.show();
}

function cambiaProductoJS(idProducto, estatusActual) {

    const formdata = new FormData();
    formdata.append('id_producto', idProducto);

    const nuevoEstatus = estatusActual == 1 ? 0 : 1;
    const ruta = nuevoEstatus === 1 ? 'activa' : 'desactiva';

    fetch(`/panel/catalogos/productos/${ruta}`, {
        method: 'POST',
        body: formdata
    })
    .then(r => r.json())
    .then(res => {
        if (res.Code === 10000) {

            // Texto ACTIVO
            const celdaActivo = document.getElementById(`activo-${idProducto}`);
            celdaActivo.innerHTML = nuevoEstatus === 1
                ? 'SI'
                : '<span class="activo-false">NO</span>';

            // Icono
            const icono = celdaActivo
                .parentElement
                .querySelector('.toggle-status');

            icono.classList.remove('text-success', 'text-danger');
            icono.classList.add(
                nuevoEstatus === 1 ? 'text-success' : 'text-danger'
            );

            // Actualiza onclick
            icono.setAttribute(
                'onclick',
                `cambiaProductoJS(${idProducto}, ${nuevoEstatus})`
            );

        } else {
            alert(res.Msg);
        }
    })
    .catch(err => console.error(err));
}