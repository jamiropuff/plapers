// Cliente Portal JS - Plapers

// 1. Actualizar Datos Personales
const actualizarPerfilCliente = async (event) => {
    event.preventDefault();
    const nombres = $("#perfil_nombres").val().trim();
    const paterno = $("#perfil_paterno").val().trim();
    const materno = $("#perfil_materno").val().trim();

    if (!nombres || !paterno) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos requeridos',
            text: 'El nombre y apellido paterno son obligatorios.'
        });
        return;
    }

    const $btn = $("#btnGuardarPerfil");
    $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Guardando...');

    try {
        const response = await $.ajax({
            url: BASE_URL + '/mi-cuenta/actualizar-datos',
            type: 'POST',
            dataType: 'json',
            data: { nombres, paterno, materno }
        });

        if (response.status === 1) {
            Swal.fire({
                icon: 'success',
                title: '¡Actualizado!',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: response.message });
        }
    } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Error', text: 'Error al comunicarse con el servidor.' });
    } finally {
        $btn.prop("disabled", false).html('<i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios');
    }
};

// 2. Cambiar Contraseña
const cambiarPasswordCliente = async (event) => {
    event.preventDefault();
    const pass_actual        = $("#pass_actual").val();
    const pass_nueva         = $("#pass_nueva").val();
    const pass_nueva_confirm = $("#pass_nueva_confirm").val();

    if (!pass_actual || !pass_nueva || !pass_nueva_confirm) {
        Swal.fire({ icon: 'warning', title: 'Campos requeridos', text: 'Completa todos los campos de contraseña.' });
        return;
    }

    if (pass_nueva.length < 6) {
        Swal.fire({ icon: 'warning', title: 'Contraseña corta', text: 'La nueva contraseña debe tener mínimo 6 caracteres.' });
        return;
    }

    if (pass_nueva !== pass_nueva_confirm) {
        Swal.fire({ icon: 'warning', title: 'No coinciden', text: 'La confirmación de la nueva contraseña no coincide.' });
        return;
    }

    const $btn = $("#btnCambiarPass");
    $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Actualizando...');

    try {
        const response = await $.ajax({
            url: BASE_URL + '/mi-cuenta/cambiar-password',
            type: 'POST',
            dataType: 'json',
            data: { pass_actual, pass_nueva, pass_nueva_confirm }
        });

        if (response.status === 1) {
            Swal.fire({
                icon: 'success',
                title: 'Contraseña actualizada',
                text: response.message
            });
            $("#formCambiarPassword")[0].reset();
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: response.message });
        }
    } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo actualizar la contraseña.' });
    } finally {
        $btn.prop("disabled", false).html('<i class="fa-solid fa-key me-2"></i> Actualizar Contraseña');
    }
};

// 3. Mis Direcciones
const initSelect2Direccion = () => {
    const $estado = $('#dir_estado');
    if (!$estado.length) return;

    if ($.fn.niceSelect && $estado.next('.nice-select').length) {
        $estado.next('.nice-select').remove();
    }

    if ($estado.hasClass('select2-hidden-accessible')) {
        $estado.select2('destroy');
    }

    $estado.select2({
        dropdownParent: $('#modalDireccion'),
        width: '100%',
        placeholder: 'Selecciona un estado...',
        language: 'es'
    });
};

const abrirModalDireccion = () => {
    $("#formDireccion")[0].reset();
    $("#dir_id").val('');
    $("#modalDireccionTitulo").text("Nueva Dirección");

    if ($('#dir_estado').hasClass('select2-hidden-accessible')) {
        $('#dir_estado').val('').trigger('change');
    }

    const modalEl = document.getElementById('modalDireccion');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl, { focus: false });
    modal.show();
};

const guardarDireccion = async (event) => {
    event.preventDefault();

    const id_direccion = $("#dir_id").val();
    const url = id_direccion ? BASE_URL + '/mis-direcciones/actualizar' : BASE_URL + '/mis-direcciones/guardar';

    const data = {
        id_direccion: id_direccion,
        recibe: $("#dir_recibe").val().trim(),
        telefono: $("#dir_telefono").val().trim(),
        calle: $("#dir_calle").val().trim(),
        numero: $("#dir_numero").val().trim(),
        interior: $("#dir_interior").val().trim(),
        colonia: $("#dir_colonia").val().trim(),
        municipio: $("#dir_municipio").val().trim(),
        estado: $("#dir_estado").val(),
        codigo_postal: $("#dir_cp").val().trim(),
        referencia: $("#dir_referencia").val().trim()
    };

    const $btn = $("#btnGuardarDir");
    $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Guardando...');

    try {
        const response = await $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data
        });

        if (response.status === 1) {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalDireccion')).hide();
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: response.message });
        }
    } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Error', text: 'Error al guardar la dirección.' });
    } finally {
        $btn.prop("disabled", false).html('<i class="fa-solid fa-floppy-disk me-1"></i> Guardar Dirección');
    }
};

const editarDireccion = async (id) => {
    try {
        const response = await $.ajax({
            url: BASE_URL + '/mis-direcciones/obtener/' + id,
            type: 'GET',
            dataType: 'json'
        });

        if (response.status === 1 && response.direccion) {
            const dir = response.direccion;
            $("#dir_id").val(dir.id_direccion);
            $("#dir_recibe").val(dir.recibe);
            $("#dir_telefono").val(dir.telefono);
            $("#dir_calle").val(dir.calle);
            $("#dir_numero").val(dir.numero);
            $("#dir_interior").val(dir.interior && dir.interior !== '0' ? dir.interior : '');
            $("#dir_colonia").val(dir.colonia);
            $("#dir_municipio").val(dir.municipio);
            $("#dir_cp").val(dir.codigo_postal);
            $("#dir_referencia").val(dir.referencia && dir.referencia !== '0' ? dir.referencia : '');

            $("#modalDireccionTitulo").text("Editar Dirección");
            const modalEl = document.getElementById('modalDireccion');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl, { focus: false });
            modal.show();

            // Set state in Select2
            if ($('#dir_estado').hasClass('select2-hidden-accessible')) {
                $('#dir_estado').val(dir.estado).trigger('change');
            } else {
                $('#dir_estado').val(dir.estado);
            }
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Dirección no encontrada.' });
        }
    } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Error', text: 'Error al consultar datos de la dirección.' });
    }
};

const eliminarDireccion = (id) => {
    Swal.fire({
        title: '¿Eliminar dirección?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await $.ajax({
                    url: BASE_URL + '/mis-direcciones/eliminar/' + id,
                    type: 'POST',
                    dataType: 'json'
                });

                if (response.status === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminada',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $(`#card-direccion-${id}`).fadeOut(300, function () { $(this).remove(); });
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                }
            } catch (e) {
                console.error(e);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Error al eliminar dirección.' });
            }
        }
    });
};

// 4. Domicilio Fiscal
const alternarTipoPersona = () => {
    const esMoral = $("#tipo_moral").is(":checked");
    if (esMoral) {
        $("#grupo_razon_social").slideDown();
        $(".grupo_persona_fisica").slideUp();
        $("#fisc_rfc").attr("maxlength", 12).attr("placeholder", "AAA010101AAA");
    } else {
        $("#grupo_razon_social").slideUp();
        $(".grupo_persona_fisica").slideDown();
        $("#fisc_rfc").attr("maxlength", 13).attr("placeholder", "AAAA010101AAA");
    }
};

const guardarDomicilioFiscal = async (event) => {
    event.preventDefault();

    const form = document.getElementById("formDomicilioFiscal");
    const formData = new FormData(form);

    const $btn = $("#btnGuardarFiscal");
    $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Guardando...');

    try {
        const response = await $.ajax({
            url: BASE_URL + '/domicilio-fiscal/guardar',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false
        });

        if (response.status === 1) {
            Swal.fire({
                icon: 'success',
                title: 'Datos Fiscales Guardados',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: response.message });
        }
    } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Error', text: 'Error al guardar los datos fiscales.' });
    } finally {
        const label = $("#fisc_id").val() ? 'Actualizar domicilio fiscal' : 'Guardar domicilio fiscal';
        $btn.prop("disabled", false).html('<i class="fa-solid fa-floppy-disk me-2"></i> ' + label);
    }
};

const nuevoDomicilioFiscal = () => {
    const form = document.getElementById('formDomicilioFiscal');
    form.reset();
    $("#fisc_id").val('');
    $("#formDomicilioFiscal input[type=text], #formDomicilioFiscal input[type=hidden]").not('#fisc_id').val('');
    $("#tipo_fisica").prop('checked', true);
    $("#fisc_estado, #fisc_uso").val('').trigger('change');
    $("#fisc_archivo").val('');
    $("#fisc_csf_actual").hide();
    $("#tituloFormularioFiscal").text('Agregar domicilio fiscal');
    $("#btnGuardarFiscal").html('<i class="fa-solid fa-floppy-disk me-2"></i> Guardar domicilio fiscal');
    alternarTipoPersona();
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

const editarDomicilioFiscal = async (id) => {
    try {
        const response = await $.ajax({
            url: BASE_URL + '/domicilio-fiscal/obtener/' + id,
            type: 'GET',
            dataType: 'json'
        });
        if (response.status !== 1) {
            Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo cargar el domicilio fiscal.' });
            return;
        }

        const data = response.facturacion;
        $("#fisc_id").val(data.id_facturacion);
        $("#tipo_fisica").prop('checked', String(data.tipo_persona) === '1');
        $("#tipo_moral").prop('checked', String(data.tipo_persona) === '2');
        $("#fisc_razon_social").val(data.razon_social === '0' ? '' : data.razon_social);
        $("#fisc_nombres").val(data.nombres === '0' ? '' : data.nombres);
        $("#fisc_paterno").val(data.paterno === '0' ? '' : data.paterno);
        $("#fisc_materno").val(data.materno === '0' ? '' : data.materno);
        $("#fisc_rfc").val(data.rfc);
        $("#fisc_curp").val(data.curp === '0' ? '' : data.curp);
        $("#fisc_uso").val(data.uso).trigger('change');
        $("#fisc_calle").val(data.calle);
        $("#fisc_numero").val(data.numero);
        $("#fisc_interior").val(data.interior === '0' ? '' : data.interior);
        $("#fisc_colonia").val(data.colonia);
        $("#fisc_municipio").val(data.municipio);
        $("#fisc_estado").val(data.estado).trigger('change');
        $("#fisc_cp").val(data.codigo_postal);
        $("#fisc_archivo").val('');

        if (data.documento_situacion_fiscal) {
            $("#fisc_csf_link").attr('href', BASE_URL + '/uploads/constancias/' + encodeURIComponent(data.documento_situacion_fiscal));
            $("#fisc_csf_actual").show();
        } else {
            $("#fisc_csf_actual").hide();
        }

        $("#tituloFormularioFiscal").text('Editar domicilio fiscal');
        $("#btnGuardarFiscal").html('<i class="fa-solid fa-floppy-disk me-2"></i> Actualizar domicilio fiscal');
        alternarTipoPersona();
        document.getElementById('formDomicilioFiscal').scrollIntoView({ behavior: 'smooth', block: 'start' });
    } catch (e) {
        console.error(e);
        Swal.fire({ icon: 'error', title: 'Error', text: 'Error al cargar el domicilio fiscal.' });
    }
};

const eliminarDomicilioFiscal = (id) => {
    Swal.fire({
        title: '¿Eliminar domicilio fiscal?',
        text: 'Ya no aparecerá como opción para tus compras.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(async (result) => {
        if (!result.isConfirmed) return;
        try {
            const response = await $.ajax({
                url: BASE_URL + '/domicilio-fiscal/eliminar/' + id,
                type: 'POST',
                dataType: 'json'
            });
            if (response.status === 1) {
                $("#card-fiscal-" + id).fadeOut(200, function () { $(this).remove(); });
                if (String($("#fisc_id").val()) === String(id)) nuevoDomicilioFiscal();
                Swal.fire({ icon: 'success', title: 'Eliminado', text: response.message, timer: 1500, showConfirmButton: false });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo eliminar el domicilio fiscal.' });
            }
        } catch (e) {
            console.error(e);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Error al eliminar el domicilio fiscal.' });
        }
    });
};

// 5. Mis Compras - Detalle de Orden
const verDetalleCompra = async (id_orden) => {
    $("#modalFolioOrden").text('#' + id_orden);
    const modalEl = document.getElementById('modalDetalleCompra');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    const $contenido = $("#modalDetalleContenido");
    $contenido.html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `);

    try {
        const response = await $.ajax({
            url: BASE_URL + '/mis-compras/detalle/' + id_orden,
            type: 'GET',
            dataType: 'json'
        });

        if (response.status === 1) {
            const orden = response.orden;
            const productos = response.productos || [];

            let htmlProductos = '';
            productos.forEach((p) => {
                htmlProductos += `
                    <div class="border-bottom border-secondary py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-1">${p.nom_producto || 'Placa Personalizada'}</h6>
                            <p class="text-white-50 small mb-0">${p.nom_categoria || ''} - Cantidad: ${p.cantidad}</p>
                            ${p.texto_linea1 ? `<span class="badge bg-dark border border-secondary text-primary">L1: ${p.texto_linea1}</span>` : ''}
                            ${p.texto_linea2 ? `<span class="badge bg-dark border border-secondary text-primary">L2: ${p.texto_linea2}</span>` : ''}
                        </div>
                        <div class="text-end">
                            <span class="text-white fw-bold">$${parseFloat(p.total || 0).toFixed(2)} MXN</span>
                        </div>
                    </div>
                `;
            });

            const html = `
                <div class="mb-3 d-flex justify-content-between border-bottom border-secondary pb-3">
                    <div>
                        <span class="text-white-50 small">Fecha del Pedido:</span>
                        <div class="text-white fw-bold">${orden.fecha_pedido || 'N/A'}</div>
                    </div>
                    <div>
                        <span class="text-white-50 small">Estatus del Pedido:</span>
                        <div><span class="badge bg-info text-dark">${orden.estatus_pedido || 'Procesando'}</span></div>
                    </div>
                    <div>
                        <span class="text-white-50 small">Estatus del Pago:</span>
                        <div><span class="badge bg-success">${orden.estatus_pago || 'Pagado'}</span></div>
                    </div>
                </div>

                <h6 class="text-primary mt-3 mb-2"><i class="fa-solid fa-layer-group me-1"></i> Productos</h6>
                <div class="mb-3">${htmlProductos || '<p class="text-white-50">No hay detalles de productos disponibles.</p>'}</div>

                <div class="bg-black p-3 rounded border border-secondary mt-3">
                    <div class="d-flex justify-content-between small text-white-50 mb-1">
                        <span>Subtotal:</span>
                        <span>$${parseFloat(orden.subtotal || 0).toFixed(2)} MXN</span>
                    </div>
                    <div class="d-flex justify-content-between small text-white-50 mb-1">
                        <span>Envío:</span>
                        <span>$${parseFloat(orden.envio || 0).toFixed(2)} MXN</span>
                    </div>
                    <div class="d-flex justify-content-between small text-white-50 mb-2">
                        <span>IVA:</span>
                        <span>$${parseFloat(orden.iva || 0).toFixed(2)} MXN</span>
                    </div>
                    <div class="d-flex justify-content-between text-white fw-bold border-top border-secondary pt-2 fs-5">
                        <span>Total:</span>
                        <span class="text-primary">$${parseFloat(orden.total || 0).toFixed(2)} MXN</span>
                    </div>
                </div>
            `;
            $contenido.html(html);
        } else {
            $contenido.html(`<div class="alert alert-danger">${response.message || 'Error al cargar detalles'}</div>`);
        }
    } catch (e) {
        console.error(e);
        $contenido.html('<div class="alert alert-danger">Error al consultar los detalles de la compra.</div>');
    }
};

// Inicializaciones de Select2 en cliente
$(document).ready(function () {
    if ($('#modalDireccion').length && typeof initSelect2Direccion === 'function') {
        $('#modalDireccion').on('shown.bs.modal', function () {
            initSelect2Direccion();
        });

        initSelect2Direccion();
    }

    if ($('#fisc_estado').length && $.fn.select2) {
        if ($.fn.niceSelect && $('#fisc_estado').next('.nice-select').length) {
            $('#fisc_estado').next('.nice-select').remove();
        }
        $('#fisc_estado').select2({
            width: '100%',
            placeholder: 'Selecciona el estado...',
            language: 'es'
        });
    }

    if ($('#fisc_uso').length && $.fn.select2) {
        if ($.fn.niceSelect && $('#fisc_uso').next('.nice-select').length) {
            $('#fisc_uso').next('.nice-select').remove();
        }
        $('#fisc_uso').select2({
            width: '100%',
            placeholder: 'Selecciona el uso de CFDI...',
            language: 'es'
        });
    }
});

