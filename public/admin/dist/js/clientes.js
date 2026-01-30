document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;

    if (path === '/panel/clientes/ver-clientes') {
        listarRegistro();
    }
});

const obtenerClientes = async () => {
	try {
		const response = await fetch('/panel/clientes/lista');
		if (!response.ok) {
			throw new Error('Error HTTP: ' + response.status);
		}

		return await response.json();
		// console.log('Clientes:', data);
	} catch (error) {
		console.error('Error:', error);
	}
}

const listarRegistro = async (cantidad = 50) => {
	// console.log("listarRegistro");

	let response = await obtenerClientes();
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
          <th class="align-middle">ID CLIENTE</th>
          <th class="align-middle">CLIENTE</th>
          <th class="align-middle">CORREO ELECTRÓNICO</th>
          <th class="align-middle">ÚLTIMA COMPRA - ID ORDEN</th>
          <th class="align-middle">ACTIVO</th>
		  <th class="align-middle">DESCUENTO</th>
		  <th class="align-middle">VER</th>
		  <th class="align-middle">ACTIVAR DESCUENTO</th>
        </tr>
      </thead>
	  <tbody class="border border-primary">
      `;

	let i = 1;

	for (const cliente of response.Clientes) {

		const ultimaCompra = cliente.Ultima_Compra
			? cliente.Ultima_Compra.id_orden
			: 'Sin compras';

		const activo = cliente.Active == 1 ? 'SI' : 'NO';
		const descuento = cliente.Id_Tipo_Usuario == 1 ? 'NO' : 'SI';

		contenido += `
        <tr>
            <td>${i++}</td>
            <td>${cliente.Id_User}</td>
            <td>${cliente.Nombre} ${cliente.Paterno} ${cliente.Materno}</td>
            <td>${cliente.Correo_Electronico}</td>
            <td>${ultimaCompra}</td>
            <td>${activo}</td>
            <td  id="resultTipoUsuario_${cliente.Id_User}">${descuento}</td>
            <td class="text-center">
                <a href="/panel/clientes/info/${cliente.Id_User}" title="Ver cliente">
                    <i class="fa-solid fa-eye"></i>
                </a>
            </td>
            <td>
                <select id="id_tipo_usuario_${cliente.Id_User}" class="form-select form-select-sm" onchange="cambiar_tipo_usuario(${cliente.Id_User}, this.value)">
                    <option value="0">Seleccionar</option>
                    ${response.CatTipo_Usuario.map(t =>
			`<option value="${t.id_tipo_usuario}">${t.tipo_usuario}</option>`
		).join('')}
                </select>
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
						columns: [1, 2, 3, 4, 5],
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
						columns: [1, 2, 3, 4, 5],
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
						columns: [2, 3, 4, 5],
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
				{ targets: [7, 8], orderable: false }, // icono y select
				{ targets: [7, 8], searchable: false } // no filtrar
			],
			select: true,
			orderCellsTop: true,
			fixedHeader: true,
			initComplete: function () {
				var api = this.api();

				api.columns().eq(0).each(function (colIdx) {

					// ❌ NO filtrar las últimas 2 columnas
					if (colIdx < 1 || colIdx >= 7) {
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

const cambiar_tipo_usuario = (id_usuario, id_tipo_usuario) => {
	console.log(`id_usuario: ${id_usuario}, id_tipo_usuario: ${id_tipo_usuario}`);

	if (id_tipo_usuario > 0) {
		$.ajax({
			url: "/panel/clientes/cambiar_tipo_usuario",
			type: "post",
			data: {
				"id_usuario": id_usuario,
				"id_tipo_usuario": id_tipo_usuario
			},
			success: function (response) {
				console.log("success");
				console.log(response);
				console.log(response.Tipo_Usuario);
				id_tipo_usuario = response.Tipo_Usuario.id_tipo_usuario;
				console.log(id_tipo_usuario);
				if (id_tipo_usuario == 1) {
					descuento = "NO";
				} else {
					descuento = "SI";
				}

				document.querySelector('#resultTipoUsuario_' + id_usuario).innerHTML = descuento;
				document.querySelector('#id_tipo_usuario_' + id_usuario).selectedIndex = 0;


			}
		});
	}
}
