let categorias = [];
let subcategorias = [];

const baseUrl = window.location.origin + '/';
//console.log(baseUrl);

document.addEventListener('DOMContentLoaded', () => {
    listarRegistro();
});

const obtenerProductos = async () => {
	try {
		const response = await fetch('/panel/catalogos/productos/lista');
		if (!response.ok) {
			throw new Error('Error HTTP: ' + response.status);
		}

		return await response.json();
		// console.log('Productos:', data);
	} catch (error) {
		console.error('Error:', error);
	}
}

const listarRegistro = async (cantidad = 50) => {
	// console.log("listarRegistro");

	let response = await obtenerProductos();
	console.log(response);

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
          <th class="align-middle">ID PRODUCTO</th>
          <th class="align-middle">CATEGORÍA</th>
          <th class="align-middle">SUBCATEGORÍA</th>
          <th class="align-middle">PRODUCTO</th>
          <th class="align-middle">FOTO</th>
          <th class="align-middle">MEDIDAS</th>
          <th class="align-middle">PRECIO</th>
          <th class="align-middle">ACTIVO</th>
          <th class="align-middle">ACCIONES</th>
        </tr>
      </thead>
	  <tbody class="border border-primary">
      `;

	let i = 1;

	for (const producto of response) {

        const activo = producto.activo == 1 ? "SI" : "NO";

        if (producto.foto) {
            foto = `${baseUrl}fotos/${producto.id_subcategoria}/${producto.foto}`;
        } else {
            foto = `${baseUrl}no-image.png`;
        }

		contenido += `
        <tr>
            <td>${i++}</td>
            <td>${producto.id_producto}</td>
            <td>${producto.nom_categoria}</td>
            <td class="text-center">${producto.nom_subcategoria}</td>
            <td class="text-center">${producto.nom_producto}</td>
            <td class="text-center"><img src="${foto}" alt="Foto de ${producto.nom_producto}" style="max-width: 100px; max-height: 100px;"></td>
            <td class="text-center">${producto.largo} x ${producto.ancho} cms.</td>
            <td class="text-center">${producto.precio_unitario}</td>
            <td class="text-center" id="activo-${producto.id_producto}">${activo}</td>
            <td class="text-center">
                <i class="fa-solid fa-eye fa-2x text-primary cur-pointer" onclick="mostrarProducto('${producto.nom_producto}','${producto.nom_subcategoria}','${producto.nom_categoria}','${foto}','${producto.clave}','${producto.descripcion}','${producto.largo}','${producto.ancho}','${producto.precio_unitario}')"></i>
                <!-- <i class="fa-solid fa-pencil"></i> -->
                <i class="fa-solid fa-power-off fa-2x toggle-status cur-pointer
                ${producto.activo == 1 ? 'text-success' : 'text-danger'}"
                    onclick="cambiaProductoJS(${producto.id_producto}, ${producto.activo})">
                </i>
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
						columns: [1, 2, 3, 4, 5, 6, 7, 8],
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
						columns: [1, 2, 3, 4, 5, 6, 7, 8],
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
						columns: [1, 2, 3, 4, 5, 6, 7, 8],
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
				{ targets: [9], orderable: false }, // icono y select
				{ targets: [9], searchable: false } // no filtrar
			],
			select: true,
			orderCellsTop: true,
			fixedHeader: true,
			initComplete: function () {
				var api = this.api();

				api.columns().eq(0).each(function (colIdx) {

					// ❌ NO filtrar las últimas 2 columnas
					if (colIdx < 1 || colIdx >= 9) {
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
