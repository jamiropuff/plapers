let categorias = [];
let subcategorias = [];

const cargaCategorias = () => {
    fetch('/panel/catalogos/categorias/lista')
        .then(res => res.json())
        .then(data => {
            categorias = data;
            const select = document.getElementById('id_categoria');

            categorias.forEach(cat => {
                if (cat.activo === "1") {
                    const option = document.createElement('option');
                    option.value = cat.id_categoria;
                    option.textContent = cat.nom_categoria;
                    select.appendChild(option);
                }
            });
        })
        .catch(err => {
            console.error(err);
            alert('Error al cargar categorías');
        });
}

const cargaSubcategorias = () => {
    fetch('/panel/catalogos/subcategorias/lista')
        .then(res => res.json())
        .then(data => {
            subcategorias = data;
        })
        .catch(err => {
            console.error(err);
            alert('Error al cargar subcategorías');
        });
}

const filtraSubcategorias = () => {
    console.log('Filtrando subcategorías');
    const idCategoria = document.getElementById('id_categoria').value;
    const selectSub = document.getElementById('id_subcategoria');

    selectSub.innerHTML = '<option value="">Seleccione una subcategoría</option>';
    selectSub.disabled = true;

    if (!idCategoria) return;

    subcategorias
        .filter(sub => sub.id_categoria === idCategoria && sub.activo === "1")
        .forEach(sub => {
            const option = document.createElement('option');
            option.value = sub.id_subcategoria;
            option.textContent = sub.nom_subcategoria;
            selectSub.appendChild(option);
        });

    selectSub.disabled = false;
}

const mostrarProducto = (producto = "", subcategoria = "", categoria = "", foto = "", clave = "", descripcion = "", largo = "", ancho = "", precio = 0) => {
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

function modalAgregaProducto() {
    const modalBody = document.querySelector('#modalProducto .modal-body');

    modalBody.innerHTML = `
    <form id="formProducto" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nombre del producto</label>
        <input type="text" class="form-control" id="nom_producto" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Clave</label>
        <input type="text" class="form-control" id="clave" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select class="form-select" id="id_categoria" onchange="filtraSubcategorias()" required>
          <option value="">Seleccione una categoría</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Subcategoría</label>
        <select class="form-select" id="id_subcategoria" disabled required>
          <option value="">Seleccione una subcategoría</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" accept="image/*">
      </div>

      <div class="mb-3">
        <label class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" step="0.01" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" rows="3"></textarea>
      </div>

      <button type="button" class="btn btn-primary w-100" onclick="agregaProducto(event)">Guardar producto</button>
      <button type="button" class="btn btn-light w-100 mt-2" data-bs-dismiss="modal">Cancelar</button>
    </form>
  `;

    cargaCategorias();
    cargaSubcategorias();

    const modal = new bootstrap.Modal(
        document.getElementById('modalProducto')
    );
    modal.show();
}

function agregaProducto(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('nom_producto', document.getElementById('nom_producto').value);
    formData.append('clave', document.getElementById('clave').value);
    formData.append('id_categoria', document.getElementById('id_categoria').value);
    formData.append('id_subcategoria', document.getElementById('id_subcategoria').value);
    formData.append('precio', document.getElementById('precio').value);
    formData.append('descripcion', document.getElementById('descripcion').value);

    const foto = document.getElementById('foto').files[0];
    if (foto) {
        formData.append('foto', foto);
    }

    // console.log('Enviando datos del producto');
    // console.log(...formData);

    fetch('/panel/catalogos/productos/agrega', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.Code === 10000) {
                alert(data.Msg);
                bootstrap.Modal.getInstance(
                    document.getElementById('modalProducto')
                ).hide();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar el producto');
        });
}
