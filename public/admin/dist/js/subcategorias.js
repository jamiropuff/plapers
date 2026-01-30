let categorias = [];
let subcategorias = [];

document.addEventListener('DOMContentLoaded', () => {
    listarRegistro();
});

const obtenerSubcategorias = async () => {
	try {
		const response = await fetch('/panel/catalogos/subcategorias/lista');
		if (!response.ok) {
			throw new Error('Error HTTP: ' + response.status);
		}

		return await response.json();
		// console.log('Subcategorias:', data);
	} catch (error) {
		console.error('Error:', error);
	}
}

const listarRegistro = async (cantidad = 50) => {
	// console.log("listarRegistro");

	let response = await obtenerSubcategorias();
	// console.log(response);

	let divTable = document.getElementById("tblRegistros");
	divTable.innerHTML = "";

	let table = document.createElement("table");
	table.id = "tablaRegistros";
	table.setAttribute("class", "table table-bordered table-striped");
	divTable.append(table);

	var contenido = `  
      <thead class="bg-primary text-white">
        <tr>
          <th class="align-middle">#</th>
          <th class="align-middle">ID SUBCATEGORÍA</th>
          <th class="align-middle">CATEGORÍA</th>
          <th class="align-middle">SUBCATEGORÍA</th>
          <th class="align-middle">ACTIVO</th>
          <th class="align-middle">ACCIONES</th>
        </tr>
      </thead>
	  <tbody class="border border-primary">
      `;

	let i = 1;

	for (const subcategoria of response) {

        const activo = subcategoria.activo == 1 ? "SI" : "NO";

		contenido += `
        <tr>
            <td>${i++}</td>
            <td>${subcategoria.id_subcategoria}</td>
            <td>${subcategoria.nom_categoria}</td>
            <td>${subcategoria.nom_subcategoria}</td>
            <td id="activo-${subcategoria.id_subcategoria}">${activo}</td>
            <td class="text-center">
                <i class="fa-solid fa-pencil fa-2x text-warning cur-pointer" onclick="modalEditaSubcategoria(${subcategoria.id_subcategoria},${subcategoria.id_categoria},'${subcategoria.nom_subcategoria}')"></i>
                <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer
                ${subcategoria.activo == 1 ? 'text-success' : 'text-danger'}"
                    onclick="cambiaSubcategoriaJS(${subcategoria.id_subcategoria}, ${subcategoria.activo})">
            </td>
        </tr>
        `;
	}

	contenido += `</tbody>`;


	$("#tablaRegistros").html(contenido);

	// 👇 CLONAR THEAD PARA FILTROS
	$('#tablaRegistros thead tr')
		.clone(true)
		.removeClass('bg-primary text-white')
		.addClass('filters')
		.appendTo('#tablaRegistros thead');

	var tablaRegistros = $("#tablaRegistros")
		.DataTable({
			dom: "Bfrtip",
			responsive: true,
			lengthMenu: [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todos"],
			],
			lengthChange: false,
			autoWidth: false,
			scrollX: false,
			stateSave: false,
			pageLength: cantidad,
			order: [[0, "asc"]],
			language: {
				processing: "Procesando...",
				search: "Buscar:",
				lengthMenu: "Mostrar _MENU_ registros",
				info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
				infoEmpty: "Mostrando 0 a 0 de 0 registros",
				infoFiltered: "(filtrado de _MAX_ registros totales)",
				infoPostFix: "",
				loadingRecords: "Cargando...",
				zeroRecords: "No se encontraron resultados",
				emptyTable: "No hay datos disponibles en la tabla",
				paginate: {
					first: "Primero",
					previous: "Anterior",
					next: "Siguiente",
					last: "Último"
				},
				buttons: {
					pageLength: {
						_: "Mostrar %d filas",
						"-1": "Mostrar todos"
					}
				}
			},
			buttons: [
				{
					extend: "pageLength",
				},
				{
					extend: "excel",
					text: "Excel",
					className: "btn-dark",
					exportOptions: {
						columns: [1, 2, 3, 4],
					},
				},
				{
					extend: "pdfHtml5",
					text: "PDF",
					header: true,
					title: "PDF",
					duplicate: true,
					className: "btn-dark",
					pageOrientation: "landscape",
					pageSize: "A4",
					pageMargins: [5, 5, 5, 5],
					exportOptions: {
						columns: [1, 2, 3, 4],
						alignment: "center",
						stripHtml: false,
					},
					pageBreak: "after",
				},
				{
					extend: "print",
					text: "Imprimir",
					className: "btn-dark",
					pageSize: "A4",
					orientation: "landscape",
					exportOptions: {
						columns: [1, 2, 3, 4],
					},
				},
				{
					extend: "colvis",
					text: "Columnas",
					className: "btn-dark",
				},
			],
			select: {
				rows: {
					_: "%d filas seleccionadas",
					1: "1 fila seleccionada"
				}
			},
			columnDefs: [
				{ targets: 0, orderable: false },     // #
				{ targets: [4], orderable: false }, // icono y select
				{ targets: [4], searchable: false } // no filtrar
			],
			select: true,
			orderCellsTop: true,
			fixedHeader: true,
			initComplete: function () {
				var api = this.api();

				api.columns().eq(0).each(function (colIdx) {

					// ❌ NO filtrar las últimas 2 columnas
					if (colIdx < 1 || colIdx >= 4) {
						$('.filters th').eq(colIdx).html('');
						return;
					}

					var cell = $('.filters th').eq(colIdx);

					$(cell).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar" />');

					$('input', cell)
						.off('keyup change')
						.on('keyup change', function (e) {
							e.stopPropagation();
							api.column(colIdx).search(this.value).draw();
						});
				});
			}
		})
		.buttons()
		.container()
		.appendTo("#tablaRegistros_wrapper .col-md-6:eq(0)");
};

const cargaCategorias = (id = "") => {
    fetch('/panel/catalogos/categorias/lista')
        .then(res => res.json())
        .then(data => {

            const select = document.getElementById('id_categoria');
            select.innerHTML = '<option value="">Seleccione una categoría</option>';

            data.forEach(cat => {
                if (cat.activo === "1") {
                    const option = document.createElement('option');
                    option.value = cat.id_categoria;
                    option.textContent = cat.nom_categoria;

                    // 👉 Marcar como selected si coincide
                    if (id && String(cat.id_categoria) === String(id)) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                }
            });

        })
        .catch(err => {
            console.error(err);
            alert('Error al cargar categorías');
        });
};


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
                listarRegistro();
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
                listarRegistro();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar la subcategoría');
        });
}
