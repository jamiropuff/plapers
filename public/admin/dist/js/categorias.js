function cambiaCategoriaJS(idCategoria, estatusActual) {

    const formdata = new FormData();
    formdata.append('id_categoria', idCategoria);

    const nuevoEstatus = estatusActual == 1 ? 0 : 1;
    const ruta = nuevoEstatus === 1 ? 'activa' : 'desactiva';

    fetch(`/panel/catalogos/categorias/${ruta}`, {
        method: 'POST',
        body: formdata
    })
        .then(r => r.json())
        .then(res => {
            if (res.Code === 10000) {

                // Texto ACTIVO
                const celdaActivo = document.getElementById(`activo-${idCategoria}`);
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
                    `cambiaCategoriaJS(${idCategoria}, ${nuevoEstatus})`
                );

            } else {
                alert(res.Msg);
            }
        })
        .catch(err => console.error(err));
}

function modalAgregaCategoria() {
    const modalBody = document.querySelector('#modalCategorias .modal-body');

    modalBody.innerHTML = `
    <form id="formCategoria">
      <div class="mb-3">
        <label class="form-label">Nombre de la categoría</label>
        <input type="text" class="form-control" id="nom_categoria" required>
      </div>

      <button type="button" class="btn btn-primary w-100" onclick="agregaCategoria(event)">Guardar categoría</button>
      <button type="button" class="btn btn-light w-100 mt-2" data-bs-dismiss="modal">Cancelar</button>
    </form>
  `;

    const modal = new bootstrap.Modal(
        document.getElementById('modalCategorias')
    );
    modal.show();
}

function agregaCategoria(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('nom_categoria', document.getElementById('nom_categoria').value);

    // console.log('Enviando datos de la subcategoría');
    // console.log(...formData);

    fetch('/panel/catalogos/categorias/agrega', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
          // console.log(data);
            if (data.Code === 10000) {
                alert(data.Msg);
                bootstrap.Modal.getInstance(
                    document.getElementById('modalCategorias')
                ).hide();
                listarRegistros();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar la categoría');
        });
}

function modalEditaCategoria(idCategoria, nomCategoria) {
    const modalBody = document.querySelector('#modalCategorias .modal-body');

    modalBody.innerHTML = `
    <form id="formCategoria">
      <div class="mb-3">
        <label class="form-label">Nombre de la categoría</label>
        <input type="text" class="form-control" id="nom_categoria" value="${nomCategoria}" required>
      </div>

      <input type="hidden" id="id_categoria" value="${idCategoria}">
      <button type="button" class="btn btn-primary w-100" onclick="editaCategoria(event)">Guardar categoría</button>
      <button type="button" class="btn btn-light w-100 mt-2" data-bs-dismiss="modal">Cancelar</button>
    </form>
  `;

    const modal = new bootstrap.Modal(
        document.getElementById('modalCategorias')
    );
    modal.show();
}

function editaCategoria(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('id_categoria', document.getElementById('id_categoria').value);
    formData.append('nom_categoria', document.getElementById('nom_categoria').value);

    // console.log('Enviando datos de la subcategoría');
    // console.log(...formData);

    fetch('/panel/catalogos/categorias/edita', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.Code === 10000) {
                alert(data.Msg);
                bootstrap.Modal.getInstance(
                    document.getElementById('modalCategorias')
                ).hide();
                listarRegistros();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar la categoría');
        });
}

const listarRegistros = () => {
  // console.log('Listando categorías...');
    const tbody = document.querySelector('#tablaCategorias tbody');
    tbody.innerHTML = `
    <tr>
      <td colspan="5" class="text-center">
        Cargando registros...
      </td>
    </tr>
  `;

    fetch('/panel/catalogos/categorias/lista')
        .then(res => res.json())
        .then(data => {

            if (!Array.isArray(data)) {
                throw new Error('Formato de respuesta inválido');
            }

            tbody.innerHTML = '';
            let contador = 1;

            data.forEach(cat => {
                const activoTxt = cat.activo == 1 ? 'SI' : 'NO';
                const activoClass = cat.activo == 1 ? 'text-success' : 'text-danger';

                const tr = document.createElement('tr');
                tr.innerHTML = `
          <td class="text-center">${contador}</td>
          <td class="text-center">${cat.id_categoria}</td>
          <td class="text-center">${cat.nom_categoria}</td>
          <td class="text-center" id="activo-${cat.id_categoria}">
            ${activoTxt}
          </td>
          <td class="text-center">
            <i class="fa-solid fa-pencil fa-2x text-warning cur-pointer" onclick="modalEditaCategoria(${cat.id_categoria}, '${cat.nom_categoria}')"></i>
            <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer ${activoClass}"
              onclick="cambiaCategoriaJS(${cat.id_categoria}, ${cat.activo})">
            </i>
          </td>
        `;

                tbody.appendChild(tr);
                contador++;
            });

            if (contador === 1) {
                tbody.innerHTML = `
          <tr>
            <td colspan="5" class="text-center">
              No hay registros
            </td>
          </tr>
        `;
            }

        })
        .catch(err => {
            console.error(err);
            tbody.innerHTML = `
        <tr>
          <td colspan="6" class="text-center text-danger">
            Error al cargar subcategorías
          </td>
        </tr>
      `;
        });
}