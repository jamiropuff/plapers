// const params = new URLSearchParams(window.location.search);
// console.log(params);
// var kioskId = params.get('kioskId');

// const url = window.location.href;
// console.log(url);

const path = window.location.pathname;
console.log(path);

const segmentos = window.location.pathname.split('/');
const tipo = segmentos[segmentos.length - 1];

// console.log(tipo); // user o staff

document.addEventListener('DOMContentLoaded', () => {
    listarRegistro();
});

const obtenerUsuarios = async (tipo) => {
    try {
        const response = await fetch('/panel/usuarios/lista', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                tipo: tipo // "user" o "staff"
            })
        });

        if (!response.ok) {
            throw new Error('Error HTTP: ' + response.status);
        }

        return await response.json();
    } catch (error) {
        console.error('Error:', error);
    }
};

const listarRegistro = async (cantidad = 50) => {
    // console.log("listarRegistro");

    let response = await obtenerUsuarios(tipo);
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
          <th class="align-middle">ID USUARIO</th>
          <th class="align-middle">USUARIO</th>
          <th class="align-middle">NOMBRE</th>
          <th class="align-middle">CORREO ELECTRÓNICO</th>
          <th class="align-middle">ROL</th>
		  <th class="align-middle">ACTIVO</th>
          <th class="align-middle">EDITAR</th>
        </tr>
      </thead>
	  <tbody class="border border-primary">
      `;

    let i = 1;

    for (const usuarios of response.Usuarios) {

        contenido += `
        <tr>
            <td>${i++}</td>
            <td>${usuarios.Id_User}</td>
            <td>${usuarios.User}</td>
            <td>${usuarios.Nombres} ${usuarios.Paterno} ${usuarios.Materno}</td>
            <td>${usuarios.Email}</td>
            <td>${usuarios.Nom_Rol}</td>
            <td>${usuarios.Activo}</td>
            <td>
                <a href="/usuarios/editar/${usuarios.Id_User}" title="Edita Usuario">
                    <i class="fa-solid fa-pencil"></i>
                </a>
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
                { targets: 0, orderable: true },     // #
                // { targets: [7, 8], orderable: false }, // icono y select
                // { targets: [7, 8], searchable: false } // no filtrar
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

