document.addEventListener('DOMContentLoaded', () => {
    listarRegistro();
});

const obtenerCategorias = async () => {
	try {
		const response = await fetch('/panel/catalogos/categorias/lista');
		if (!response.ok) {
			throw new Error('Error HTTP: ' + response.status);
		}

		return await response.json();
		// console.log('Categorias:', data);
	} catch (error) {
		console.error('Error:', error);
	}
}

const listarRegistro = async (cantidad = 50) => {
	// console.log("listarRegistro");

	let response = await obtenerCategorias();
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
          <th class="align-middle">ID CATEGORÍA</th>
          <th class="align-middle">CATEGORÍA</th>
          <th class="align-middle">ACTIVO</th>
          <th class="align-middle">ACCIONES</th>
        </tr>
      </thead>
	  <tbody class="border border-primary">
      `;

	let i = 1;

	for (const categoria of response) {

        const activo = categoria.activo == 1 ? "SI" : "NO";

		contenido += `
        <tr>
            <td>${i++}</td>
            <td>${categoria.id_categoria}</td>
            <td>${categoria.nom_categoria}</td>
            <td id="activo-${categoria.id_categoria}">${activo}</td>
            <td class="text-center">
                <i class="fa-solid fa-pencil fa-2x text-warning cur-pointer" onclick="modalEditaCategoria(${categoria.id_categoria}, '${categoria.nom_categoria}')"></i>
                <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer
                ${categoria.activo == 1 ? 'text-success' : 'text-danger'}"
                    onclick="cambiaCategoriaJS(${categoria.id_categoria}, ${categoria.activo})">
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
                listarRegistro();
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
                listarRegistro();
            } else {
                alert(data.Msg);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al guardar la categoría');
        });
}
