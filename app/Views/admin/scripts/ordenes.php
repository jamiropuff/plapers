<script>
    const baseUrl = window.location.origin + '/';
    //console.log(baseUrl);

    document.addEventListener('DOMContentLoaded', () => {
        const path = window.location.pathname;

        if (path === '/panel/ordenes/activas') {
            listarRegistro();
        }
        if (path === '/panel/ordenes/finalizadas') {
            listarRegistroFinalizadas();
        }
        if (path === '/panel/ordenes/canceladas') {
            listarRegistroCanceladas();
        }
    });

    const generarOpcionesEstatusPedido = (orden, sessionRol) => {
        let options = '<option value="0">Seleccionar</option>';

        for (const estatus of orden.Cat_Tipo_Envio) {

            // Roles diferentes a producción
            if (sessionRol != 5) {
                if (estatus.id_estatus_pedido != 3 && estatus.id_estatus_pedido != 7) {
                    options += `
                    <option value="${estatus.id_estatus_pedido}">
                        ${estatus.estatus_pedido}
                    </option>
                `;
                }
            }
            // Producción
            else {
                if (estatus.id_estatus_pedido == 3 || estatus.id_estatus_pedido == 7) {
                    options += `
                    <option value="${estatus.id_estatus_pedido}">
                        ${estatus.estatus_pedido}
                    </option>
                `;
                }
            }
        }

        return options;
    }

    const obtenerOrdenes = async () => {
        try {
            const response = await fetch('/panel/ordenes/lista_activas');
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

        const sessionRol = <?= $session->Rol ?>;

        let response = await obtenerOrdenes();
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
          <th class="align-middle">ORDEN</th>
          <th class="align-middle">USUARIO</th>
          <th class="align-middle">TIPO DE PAGO</th>
          <th class="align-middle">CONSTANCIA<br>SITUACIÓN<br>FISCAL</th>
          <th class="align-middle">ENVÍO A DOMICILIO</th>
		  <th class="align-middle">ESTATUS DE PAGO</th>
		  <th class="align-middle">ESTATUS PEDIDO</th>
          <th class="align-middle">FECHA PEDIDO</th>
          <th class="align-middle">FECHA ENTREGA PRODUCCIÓN</th>
		  <th class="align-middle">VER PEDIDO</th>
          <th class="align-middle">VER FICHA DE PAGO</th>
          <th class="align-middle">MODIFICAR PAGO</th>
          <th class="align-middle">MODIFICAR PEDIDO</th>
          <th class="align-middle">DESCARGAR EXCEL</th>
        </tr>
      </thead>
	  <tbody class="border border-primary">
      `;

        let i = 1;

        for (const orden of response.data.Ordenes) {

            // Tipo de Envío
            const envio_domicilio = orden.Id_Tipo_Envio == 1 ? 'SI' : 'NO';

            // Fecha de producción
            let fecha_produccion = '';
            let hora_produccion = '';
            if (orden.Fecha_Produccion) {
                [fecha_produccion, hora_produccion] = orden.Fecha_Produccion.split(" ");
            }

            // Comprobante de pago
            let modal = "";
            let comprobante_pago = "";
            let comprobante_pago_thumb = "";
            if (orden.Comprobante) {
                comprobante_pago = `<img style="width: 50vw" class="img img-fluid" src="${baseUrl}uploads/comprobantes/${orden.Comprobante}"> `;
                comprobante_pago_thumb = `<img style="width: 60px; height: 80px; cursor:pointer" src="${baseUrl}uploads/comprobantes/${orden.Comprobante}" data-bs-toggle="modal" data-bs-target="#comprobanteModal_${orden.Id_Orden}"> `;

                modal = `
                <!-- Modal -->
                <div class="modal fade" id="comprobanteModal_${orden.Id_Orden}" tabindex="-1" aria-labelledby="comprobanteModalLabel_${orden.Id_Orden}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="comprobanteModalLabel_${orden.Id_Orden}">Comprobante de Pago</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ${comprobante_pago}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                `;

            }

            // Constancia de Situación Fiscal desde el Panel del Usuario
            if (orden.Constancia) {
                situacion_fiscal = `<a href="${baseUrl}uploads/constancias/${orden.Constancia}" target="_blank"><i class="fa-solid fa-file-pdf fa-2x"></i></a>`;
            } else {
                situacion_fiscal = "";
            }

            let optionsEstatusPago = '<option value="0">Seleccionar</option>';

            for (const estatus of response.estatusPago) {
                optionsEstatusPago += `
                    <option value="${estatus.id_estatus_pago}">
                        ${estatus.estatus_pago}
                    </option>
                `;
            }

            const opcionesPedido = generarOpcionesEstatusPedido(orden, sessionRol);

            contenido += `
                <tr>
                    <td>${i++}</td>
                    <td>${orden.Id_Orden}</td>
                    <td>${orden.Nombre} ${orden.Paterno} ${orden.Materno}</td>
                    <td class="text-center">${orden.Tipo_Pago}<br> ${comprobante_pago_thumb} ${modal}</td>
                    <td>${situacion_fiscal}</td>
                    <td>${envio_domicilio}</td>
                    <td class="text-center">
                        <div id="resultEstatusPago_${orden.Id_Orden}">${orden.Estatus_Pago}</div>
                    </td>
                    <td class="text-center">
                        <div id="resultEstatusPedido_${orden.Id_Orden}">${orden.Estatus_Pedido}</div>
                    </td>
                    <td class="text-center">${orden.Fecha_Pedido}</td>
                    <td class="text-center">${fecha_produccion}</td>
                    <td class="text-center"><a href="/panel/ordenes/productos/${orden.Id_Orden}"><i class="fa-solid fa-eye fa-2x"></i></a></td>
                    <td class="text-center"><a href="/panel/ordenes/orden/${orden.Id_Orden}"><i class="fa-regular fa-file-lines fa-2x"></i></a></td>

                    ${
                        (sessionRol == 1 || sessionRol == 3)
                        ? `
                            <td>
                                <select 
                                    id="id_estatus_pago_${orden.Id_Orden}" 
                                    class="form-select form-select-sm"
                                    onchange="cambiar_pago(${orden.Id_Orden}, this.value)">
                                    ${optionsEstatusPago}
                                </select>
                            </td>
                        `
                        : ''
                    }

                    <td>
                        <select 
                            id="id_estatus_pedido_${orden.Id_Orden}" 
                            class="form-select form-select-sm"
                            onchange="pedidoModal(${orden.Id_Orden}, this.value, ${orden.Id_Estatus_Pago})">
                            ${opcionesPedido}
                        </select>
                    </td>

                    <td class="text-center"><i class="fa-solid fa-file-export fa-2x"></i></td>
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
                order: [
                    [0, "asc"]
                ],
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
                buttons: [{
                        extend: "pageLength",
                    },
                    {
                        extend: "excel",
                        text: "Excel",
                        className: "btn-dark",
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
                columnDefs: [{
                        targets: 0,
                        orderable: false
                    }, // #
                    {
                        targets: [11, 12, 13, 14],
                        orderable: false
                    }, // icono y select
                    {
                        targets: [11, 12, 13, 14],
                        searchable: false
                    } // no filtrar
                ],
                select: true,
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    api.columns().eq(0).each(function(colIdx) {

                        // ❌ NO filtrar las últimas 2 columnas
                        if (colIdx < 1 || colIdx >= 10) {
                            $('.filters th').eq(colIdx).html('');
                            return;
                        }

                        var cell = $('.filters th').eq(colIdx);

                        $(cell).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar" />');

                        $('input', cell)
                            .off('keyup change')
                            .on('keyup change', function(e) {
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

    const obtenerOrdenesFinalizadas = async () => {
        try {
            const response = await fetch('/panel/ordenes/lista_finalizadas');
            if (!response.ok) {
                throw new Error('Error HTTP: ' + response.status);
            }
            return await response.json();
        } catch (error) {
            console.error('Error:', error);
        }
    }

    const listarRegistroFinalizadas = async (cantidad = 50) => {
        
        

        let divTable = document.getElementById("tblRegistros");
        divTable.innerHTML = `
        <div class="d-flex justify-content-center my-5">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `;

        let response = await obtenerOrdenesFinalizadas();
        const ordenes = response.data;
        
        var contenido = `
        <table id="tablaRegistros" class="table table-bordered table-striped">  
        <thead class="bg-success text-white">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ORDEN</th>
                <th class="text-center">USUARIO</th>
                <th class="text-center">TIPO DE PAGO</th>
                <th class="text-center">CONSTANCIA<br>SITUACIÓN<br>FISCAL</th>
                <th class="text-center">ENVÍO A DOMICILIO</th>
                <th class="text-center">ESTATUS DE PAGO</th>
                <th class="text-center">ESTATUS PEDIDO</th>
                <th class="text-center">FECHA PEDIDO</th>
                <th class="text-center">FECHA ENTREGA PRODUCCIÓN</th>
                <th class="text-center">VER PEDIDO</th>
                <th class="text-center">VER FICHA DE PAGO</th>
                <th class="text-center">MODIFICAR PAGO</th>
                <th class="text-center">MODIFICAR PEDIDO</th>
                <th class="text-center">DESCARGAR EXCEL</th>
            </tr>
        </thead>
	    <tbody class="border border-primary">
        
        ${ordenes.map((orden, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>${orden.id_orden}</td>
                <td>${orden.nombres} ${orden.paterno} ${orden.materno}</td>
                <td class="text-center">${orden.tipo_pago}</td>
                <td class="text-center"><i class="fa-solid fa-file-pdf fa-2x"></i></td>
                <td class="text-center">${orden.id_tipo_envio == 1 ? 'SI' : 'NO'}</td>
                <td class="text-center">${orden.estatus_pago}</td>
                <td class="text-center">${orden.estatus_pedido}</td>
                <td class="text-center">${orden.fecha_pedido}</td>
                <td class="text-center">${orden.fecha_produccion}</td>
                <td class="text-center"><i class="fa-solid fa-eye fa-2x"></i></td>
                <td class="text-center"><i class="fa-regular fa-file-lines fa-2x"></i></td>
                <td><select></select></td>
                <td><select></select></td>
                <td class="text-center"><i class="fa-solid fa-file-export fa-2x"></i></td>
            </tr>
        `).join('')}
        </tbody>
        </table>
      `;
    
      $("#tblRegistros").html(contenido);

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
                order: [
                    [0, "asc"]
                ],
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
                buttons: [{
                        extend: "pageLength",
                    },
                    {
                        extend: "excel",
                        text: "Excel",
                        className: "btn-dark",
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
                columnDefs: [{
                        targets: 0,
                        orderable: false
                    }, // #
                    {
                        targets: [11, 12, 13, 14],
                        orderable: false
                    }, // icono y select
                    {
                        targets: [11, 12, 13, 14],
                        searchable: false
                    } // no filtrar
                ],
                select: true,
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    api.columns().eq(0).each(function(colIdx) {

                        // ❌ NO filtrar las últimas 2 columnas
                        if (colIdx < 1 || colIdx >= 10) {
                            $('.filters th').eq(colIdx).html('');
                            return;
                        }

                        var cell = $('.filters th').eq(colIdx);

                        $(cell).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar" />');

                        $('input', cell)
                            .off('keyup change')
                            .on('keyup change', function(e) {
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

    const obtenerOrdenesCanceladas = async () => {
        try {
            const response = await fetch('/panel/ordenes/lista_canceladas');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data;
            
        } catch (error) {
            console.error('Error al obtener las ordenes canceladas:', error);
        }
    };

    const listarRegistroCanceladas = async (cantidad = 50 ) => {
        let divTable = document.getElementById("tblRegistros");
        divTable.innerHTML = `
        <div class="d-flex justify-content-center my-5">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        `;

        let response = await obtenerOrdenesCanceladas();
        const ordenes = response.data;
        var contenido = `
        <table id="tablaRegistros" class="table table-bordered table-striped">  
        <thead class="bg-success text-white">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ORDEN</th>
                <th class="text-center">USUARIO</th>
                <th class="text-center">TIPO DE PAGO</th>
                <th class="text-center">CONSTANCIA<br>SITUACIÓN<br>FISCAL</th>
                <th class="text-center">ENVÍO A DOMICILIO</th>
                <th class="text-center">ESTATUS DE PAGO</th>
                <th class="text-center">ESTATUS PEDIDO</th>
                <th class="text-center">FECHA PEDIDO</th>
                <th class="text-center">FECHA ENTREGA PRODUCCIÓN</th>
                <th class="text-center">VER PEDIDO</th>
                <th class="text-center">VER FICHA DE PAGO</th>
                <th class="text-center">MODIFICAR PAGO</th>
                <th class="text-center">MODIFICAR PEDIDO</th>
                <th class="text-center">DESCARGAR EXCEL</th>
            </tr>
        </thead>
	    <tbody class="border border-primary">

        ${ordenes.map((orden, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>${orden.id_orden}</td>
                <td>${orden.nombres} ${orden.paterno} ${orden.materno}</td>
                <td class="text-center">${orden.tipo_pago}</td>
                <td class="text-center"><i class="fa-solid fa-file-pdf fa-2x"></i></td>
                <td class="text-center">${orden.id_tipo_envio == 1 ? 'SI' : 'NO'}</td>
                <td class="text-center">${orden.estatus_pago}</td>
                <td class="text-center">${orden.estatus_pedido}</td>
                <td class="text-center">${orden.fecha_pedido}</td>
                <td class="text-center">${orden.fecha_produccion || ''}</td>
                <td class="text-center"><i class="fa-solid fa-eye fa-2x"></i></td>
                <td class="text-center"><i class="fa-regular fa-file-lines fa-2x"></i></td>
                <td><select></select></td>
                <td><select></select></td>
                <td class="text-center"><i class="fa-solid fa-file-export fa-2x"></i></td>
            </tr>
        `).join('')}
        </tbody>
        </table>
      `;

      $("#tblRegistros").html(contenido);

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
          order: [
            [0, "desc"]
          ],
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
          buttons: [{
            extend: "pageLength",
          },
          {
            extend: "excel",
            text: "Excel",
            className: "btn-dark",
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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
        columnDefs: [{
          targets: 0,
          orderable: false
        }, // #
        {
          targets: [11, 12, 13, 14],
          orderable: false
        }, // icono y select
        {
          targets: [11, 12, 13, 14],
          searchable: false
        } // no filtrar
        ],
        select: true,
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function() {
          var api = this.api();

          api.columns().eq(0).each(function(colIdx) {

            // ❌ NO filtrar las últimas 2 columnas
            if (colIdx < 1 || colIdx >= 10) {
              $('.filters th').eq(colIdx).html('');
              return;
            }

            var cell = $('.filters th').eq(colIdx);

            $(cell).html('<input type="text" class="form-control form-control-sm" placeholder="Buscar" />');

            $('input', cell)
              .off('keyup change')
              .on('keyup change', function(e) {
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

</script>