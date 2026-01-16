function cambiaSubcategoriaJS(idSubcategoria, estatusActual) {

    const formdata = new FormData();
    formdata.append('id_subcategoria', idSubcategoria);

    const nuevoEstatus = estatusActual == 1 ? 0 : 1;
    const ruta = nuevoEstatus === 1 ? 'activa' : 'desactiva';

    fetch(`/panel/catalogos/subcategorias/${ruta}`, {
        method: 'POST',
        body: formdata
    })
        .then(r => r.json())
        .then(res => {
            if (res.Code === 10000) {

                // Texto ACTIVO
                const celdaActivo = document.getElementById(`activo-${idSubcategoria}`);
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
                    `cambiaSubcategoriaJS(${idSubcategoria}, ${nuevoEstatus})`
                );

            } else {
                alert(res.Msg);
            }
        })
        .catch(err => console.error(err));
}

function modalAgregaSubcategoria() {
    const modalBody = document.querySelector('#modalSubcategorias .modal-body');

    modalBody.innerHTML = `
    <form id="formSubcategoria">
      <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select class="form-select" id="id_categoria" required>
          <option value="">Seleccione una categoría</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre de la subcategoría</label>
        <input type="text" class="form-control" id="nom_subcategoria" required>
      </div>

      <button type="button" class="btn btn-primary w-100" onclick="agregaSubcategoria(event)">Guardar subcategoría</button>
      <button type="button" class="btn btn-light w-100 mt-2" data-bs-dismiss="modal">Cancelar</button>
    </form>
  `;

    cargaCategorias();

    const modal = new bootstrap.Modal(
        document.getElementById('modalSubcategorias')
    );
    modal.show();
}

function agregaSubcategoria(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('id_categoria', document.getElementById('id_categoria').value);
    formData.append('nom_subcategoria', document.getElementById('nom_subcategoria').value);

    // console.log('Enviando datos de la subcategoría');
    // console.log(...formData);

    fetch('/panel/catalogos/subcategorias/agrega', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.Code === 10000) {
                alert(data.Msg);
                bootstrap.Modal.getInstance(
                    document.getElementById('modalSubcategorias')
                ).hide();
                listarRegistros();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar la subcategoría');
        });
}

function modalEditaSubcategoria(idSubcategoria, idCategoria, nomSubcategoria) {
    const modalBody = document.querySelector('#modalSubcategorias .modal-body');

    modalBody.innerHTML = `
    <form id="formSubcategoria">
      <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select class="form-select" id="id_categoria" required>
          <option value="">Seleccione una categoría</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Nombre de la subcategoría</label>
        <input type="text" class="form-control" id="nom_subcategoria" value="${nomSubcategoria}" required>
      </div>

      <input type="hidden" id="id_subcategoria" value="${idSubcategoria}">

      <button type="button" class="btn btn-primary w-100" onclick="editaSubcategoria(event)">Guardar subcategoría</button>
      <button type="button" class="btn btn-light w-100 mt-2" data-bs-dismiss="modal">Cancelar</button>
    </form>
  `;

    cargaCategorias(idCategoria);

    const modal = new bootstrap.Modal(
        document.getElementById('modalSubcategorias')
    );
    modal.show();
}

function editaSubcategoria(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('id_categoria', document.getElementById('id_categoria').value);
    formData.append('nom_subcategoria', document.getElementById('nom_subcategoria').value);
    formData.append('id_subcategoria', document.getElementById('id_subcategoria').value);

    // console.log('Enviando datos de la subcategoría');
    // console.log(...formData);

    fetch('/panel/catalogos/subcategorias/edita', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.Code === 10000) {
                alert(data.Msg);
                bootstrap.Modal.getInstance(
                    document.getElementById('modalSubcategorias')
                ).hide();
                listarRegistros();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar la subcategoría');
        });
}

const listarRegistros = () => {
    const tbody = document.querySelector('#tablaSubcategorias tbody');
    tbody.innerHTML = `
    <tr>
      <td colspan="6" class="text-center">
        Cargando registros...
      </td>
    </tr>
  `;

    fetch('/panel/catalogos/subcategorias/lista')
        .then(res => res.json())
        .then(data => {

            if (!Array.isArray(data)) {
                throw new Error('Formato de respuesta inválido');
            }

            tbody.innerHTML = '';
            let contador = 1;

            data.forEach(sub => {
                const activoTxt = sub.activo == 1 ? 'SI' : 'NO';
                const activoClass = sub.activo == 1 ? 'text-success' : 'text-danger';

                const tr = document.createElement('tr');
                tr.innerHTML = `
          <td class="text-center">${contador}</td>
          <td class="text-center">${sub.id_subcategoria}</td>
          <td class="text-center">${sub.nom_categoria}</td>
          <td class="text-center">${sub.nom_subcategoria}</td>
          <td class="text-center" id="activo-${sub.id_subcategoria}">
            ${activoTxt}
          </td>
          <td class="text-center">
            <i class="fa-solid fa-pencil fa-2x text-warning cur-pointer" onclick="modalEditaSubcategoria(${sub.id_subcategoria}, ${sub.id_categoria}, '${sub.nom_subcategoria}')"></i>
            <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer ${activoClass}"
              onclick="cambiaSubcategoriaJS(${sub.id_subcategoria}, ${sub.activo})">
            </i>
          </td>
        `;

                tbody.appendChild(tr);
                contador++;
            });

            if (contador === 1) {
                tbody.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">
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