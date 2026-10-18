/* =========================================================
   CARRITO PLAPERS - JAVASCRIPT PURO
   ========================================================= */

function escapar(valor) {
    return String(valor ?? '').replace(/[&<>"']/g, c => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
    })[c]);
}


/**
 * Compara las personalizaciones de dos placas.
 */
function mismaPersonalizacion(a, b) {
    if (!a || !b) {
        return !a && !b;
    }

    return (
        String(a.posicion ?? '') === String(b.posicion ?? '') &&
        String(a.linea1?.texto ?? '') === String(b.linea1?.texto ?? '') &&
        String(a.linea1?.fuente ?? '') === String(b.linea1?.fuente ?? '') &&
        String(a.linea2?.texto ?? '') === String(b.linea2?.texto ?? '') &&
        String(a.linea2?.fuente ?? '') === String(b.linea2?.fuente ?? '') &&
        String(a.linea3?.texto ?? '') === String(b.linea3?.texto ?? '') &&
        String(a.linea3?.fuente ?? '') === String(b.linea3?.fuente ?? '') &&
        String(a.color ?? '') === String(b.color ?? '') &&
        String(a.acabado ?? '') === String(b.acabado ?? '')
    );
}


/* =========================================================
   DESCUENTOS DEL CARRITO
   ========================================================= */

let catalogoDescuentos = [];
let catalogoDescuentosCargado = false;

// Leer el tipo de usuario de la cookie.
function obtenerTipoUsuario() {
    const cookie = document.cookie
        .split('; ')
        .find(fila => fila.startsWith('Tipo_Usuario='));

    return cookie ? Number(cookie.split('=').slice(1).join('=')) : 1;
}

// Consultar el catálogo de descuentos.
async function cargarCatalogoDescuentos() {
    try {
        const url = `${BASE_URL.replace(/\/$/, '')}/catalogos`;

        const respuesta = await fetch(url);

        if (!respuesta.ok) {
            throw new Error(`Error HTTP ${respuesta.status}`);
        }

        const catalogos = await respuesta.json();

        catalogoDescuentos = catalogos.descuentos || [];

        catalogoDescuentosCargado = true;

        aplicarPreciosCarrito();

        return true;

    } catch (error) {
        console.error('Error al cargar descuentos:', error);
        return false;
    }
}

// Aplicar los precios correspondientes a cada placa.
function aplicarPreciosCarrito() {
    if (!catalogoDescuentosCargado) {
        return;
    }

    const productos = cargarCarrito();

    if (!productos.length) {
        return;
    }

    // Contar todas las placas del carrito.
    const totalPlacas = productos.reduce((total, producto) => {
        return total + (Number(producto.cantidad) || 0);
    }, 0);

    const tipoUsuario = obtenerTipoUsuario();

    productos.forEach(producto => {
        const categoria = Number(producto.id_categoria);

        // Buscar la oferta correspondiente a la categoría y cantidad.
        const oferta = catalogoDescuentos.find(item => {
            const inicio = Number(item.rango_inicio);
            const fin = Number(item.rango_fin);

            return (
                Number(item.id_categoria) === categoria &&
                totalPlacas >= inicio &&
                (fin === -1 || totalPlacas <= fin)
            );
        });

        // Si no hay una oferta aplicable, conservar el precio actual.
        if (!oferta) {
            return;
        }

        // Tipo 2: precio con descuento.
        // Tipo 1: precio normal.
        const precio = Number(
            tipoUsuario === 2
                ? oferta.precio_final
                : oferta.precio
        );

        if (!Number.isFinite(precio)) {
            return;
        }

        producto.precio_unitario = precio;
        producto.precio = precio * (Number(producto.cantidad) || 0);
    });

    // Persistir los precios para que la vista los utilice.
    localStorage.setItem('Carrito', JSON.stringify(productos));
}


function renderizarCarrito() {
    const productos = cargarCarrito();

    const escritorio = document.getElementById('carrito-desktop');
    const movil = document.getElementById('carrito-mobile');

    if (!escritorio || !movil) return;

    const moneda = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN'
    });

    function generarProducto(producto, indice, esMovil = false) {
        const cantidad = Math.max(1, parseInt(producto.cantidad, 10) || 1);
        const precio = Math.max(0, Number(producto.precio_unitario) || 0);
        const total = precio * cantidad;
        const p = producto.personalizacion || {};

        const esUltimo = indice === productos.length - 1;
        const claseBordeInferior = esUltimo ? '' : 'bor-bottom';

        const lineas = [1, 2, 3]
            .filter(n => p['linea' + n]?.texto)
            .map(n => `<div>Línea ${n}: ${escapar(p['linea' + n].texto)}</div>`)
            .join('');

        const imagen = producto.foto
            ? `<img src="${escapar(producto.foto)}"
                    alt="${escapar(producto.nom_producto)}"
                    style="width:85px;height:auto;object-fit:contain">`
            : '';



        const detalles = `
            <div>
                <h4>${escapar(producto.nom_producto)}</h4>
                <div class="text-white">${escapar(producto.nom_categoria)}</div>
                ${lineas}
                <div>Color: <div class="selector-color--item selector-color-${escapar(p.color ?? '')}" style="min-width:25px; min-height: 25px; vertical-align: middle;"></div></div>
                <div>Distribución: <img class="" src="${BASE_URL}/img/posiciones/p${escapar(p.posicion ?? '')}.png" style="width: 50px; border: 1px solid #ffffff; border-radius: 5px;"></div>
                <div>Acabado: ${escapar(p.acabado ?? '')}</div>
            </div>`;

        if (esMovil) {
            return `
                <div class="product p-4 bor-top ${claseBordeInferior}"
                     data-indice="${indice}">
                    <div class="product-details d-flex align-items-center gap-3">
                        ${imagen}${detalles}
                    </div>
                    <div class="mt-3">
                        Precio: <strong>${moneda.format(precio)}</strong>
                    </div>
                    <div class="mt-2">
                        Cantidad: ${cantidad}
                    </div>
                    <div class="mt-2">
                        Total: <strong>${moneda.format(total)}</strong>
                    </div>
                    <button type="button" class="remove-product mt-2 text-danger"
                            data-indice="${indice}">Eliminar ×</button>
                </div>`;
        }

        return `
            <div class="product p-4 bor-top ${claseBordeInferior} d-flex
                        justify-content-between align-items-center"
                 data-indice="${indice}">
                <div class="product-details d-flex align-items-center gap-3"
                     style="width:40%">
                    ${imagen}${detalles}
                </div>
                <div class="product-price text-center" style="width:15%">
                    <strong>${moneda.format(precio)}</strong>
                </div>
                <div class="product-quantity text-center" style="width:15%">
                    ${cantidad}
                </div>
                <div class="product-line-price text-center" style="width:15%">
                    <strong>${moneda.format(total)}</strong>
                </div>
                <div class="product-removal text-center" style="width:10%">
                    <button type="button" class="remove-product"
                            data-indice="${indice}" aria-label="Eliminar">
                        <i class="fa-solid fa-x heading-color"></i>
                    </button>
                </div>
            </div>`;
    }

    const vacio = `
        <div class="p-4 text-center">
            Tu carrito está vacío.
            <a href="/tienda">Seguir comprando</a>
        </div>`;

    escritorio.innerHTML = productos.length
        ? productos.map((p, i) => generarProducto(p, i)).join('')
        : vacio;

    movil.innerHTML = productos.length
        ? productos.map((p, i) => generarProducto(p, i, true)).join('')
        : vacio;

    const totales = calcularTotales(productos);
    const subtotal = moneda.format(totales.totalCompra);


    actualizarContadorCarrito();
    renderizarPlacasCarrito();
}

/**
 * Actualiza los detalles de pago del paso 1.
 * Los importes definitivos deberán calcularse en el backend.
 */

function actualizarResumenPago() {
    const productos = cargarCarrito();
    const totales = calcularTotales(productos);

    const moneda = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN'
    });

    const cantidadProductos = totales.totalProductos;

    const radioEnvio = document.querySelector(
        'input[name="tipo_envio"]:checked'
    );

    const quiereEnvio = radioEnvio?.value === 'true';

    // El precio de los productos ya incluye IVA.
    const totalProductosConIVA = totales.totalCompra;

    // Separar subtotal e IVA de los productos.
    const subtotal = totalProductosConIVA / 1.16;
    const iva = totalProductosConIVA - subtotal;

    // Envío: $192 por cada bloque de hasta 20 placas.
    const PLACAS_POR_ENVIO = 20;
    const PRECIO_POR_ENVIO = 192;

    const numeroEnvios = quiereEnvio
        ? Math.ceil(cantidadProductos / PLACAS_POR_ENVIO)
        : 0;

    const precioEnvio = numeroEnvios * PRECIO_POR_ENVIO;

    // El envío no genera IVA.
    const totalPagar = totalProductosConIVA + precioEnvio;

    // Cantidad de productos y explicación de envíos.
    const elementoCantidad = document.getElementById('tcantidad');

    if (elementoCantidad) {
        elementoCantidad.childNodes[0].textContent =
            `${cantidadProductos} `;

        const explicacion = document.getElementById('texplicacion');
        const trEnvio = document.getElementById('trEnvio');

        if (explicacion) {
            explicacion.textContent = quiereEnvio
                ? `(${numeroEnvios} ${numeroEnvios === 1 ? 'envío' : 'envíos'})`
                : '';

            explicacion.classList.toggle('d-none', !quiereEnvio);
            trEnvio.classList.toggle('d-none', !quiereEnvio);

        }
    }

    // Importes.
    document.getElementById('tsubtotal').textContent = moneda.format(subtotal);

    document.getElementById('tenvio').textContent = moneda.format(precioEnvio);

    document.getElementById('tiva').textContent = moneda.format(iva);

    document.getElementById('ttotal').textContent = moneda.format(totalPagar);

    // Mostrar u ocultar la fila de envío.
    document.getElementById('fila-envio')
        ?.classList.toggle('d-none', !quiereEnvio);

    return {
        cantidadProductos,
        subtotal,
        precioEnvio,
        iva,
        totalPagar,
        numeroEnvios
    };
}


function generarVistaPlaca(producto) {
    const p = producto.personalizacion || {};

    const idProducto = producto.id_producto;
    const idCategoria = producto.id_categoria || 1;
    const idSubcategoria = producto.id_subcategoria || 0;
    const acabado = Number(p.acabado ?? 1);
    const color = p.color ?? 1;

    // La fotografía guardada en el carrito ya corresponde
    // al acabado seleccionado en detail.php.
    const foto = producto.foto || '';

    function generarLinea(numero) {
        const linea = p['linea' + numero] || {};
        const texto = linea.texto || '';
        const caracteres = Number(linea.caracteres ?? 0);

        if (numero > 1 && (!texto || caracteres <= 0)) {
            return '';
        }

        const clase = linea.clase ||
            `linea-${numero}`;

        const visibilidad = numero === 1
            ? ''
            : 'display:block;';

        return `
            <div class="${escapar(clase)}"
                 style="text-transform:uppercase;${visibilidad}">
                ${escapar(texto)}
            </div>
        `;
    }

    // Mismas reglas de acabados que detail.php.
    let imagenAcabado = '';

    if (acabado === 1) {
        // Tipo cordón
        imagenAcabado = `
            <img
                class="placa--img placa-overlay"
                src="${BASE_URL}/acabado/${encodeURIComponent(idCategoria)}/acabado-${encodeURIComponent(color)}.png"
                alt=""
            >
        `;
    } else if (acabado === 2 && Number(idSubcategoria) === 3) {
        // Tipo charola para subcategoría 3
        imagenAcabado = `
            <img
                class="placa--img placa-overlay"
                src="${BASE_URL}/acabado/${encodeURIComponent(idCategoria)}/acabado-ch-${encodeURIComponent(idProducto)}.png"
                alt=""
            >
        `;
    } else if (
        acabado === 2 &&
        [4, 5].includes(Number(idSubcategoria))
    ) {
        // Tipo charola para subcategorías 4 y 5
        imagenAcabado = `
            <img
                class="placa--img placa-overlay"
                src="${BASE_URL}/acabado/${encodeURIComponent(idCategoria)}/acabado-ch.png"
                alt=""
            >
        `;
    } else {
        // Tipo plano
        imagenAcabado = `
            <img
                class="placa--img placa-overlay"
                src="${BASE_URL}/acabado/${encodeURIComponent(idCategoria)}/acabado-pl.png"
                alt=""
            >
        `;
    }

    return `
        <div class="placa-preview categoria-${escapar(idCategoria)}">

            ${generarLinea(1)}
            ${generarLinea(2)}
            ${generarLinea(3)}

            <div class="imgs-zoom-area">
                <img
                    class="placa--img placa-base"
                    src="${escapar(foto)}"
                    alt="${escapar(producto.nom_producto || 'Placa personalizada')}"
                    loading="lazy"
                >

                ${imagenAcabado}
            </div>

        </div>
    `;
}


function renderizarPlacasCarrito() {
    const contenedor = document.getElementById('placas');

    if (!contenedor) return;

    const productos = cargarCarrito();

    contenedor.innerHTML = '';

    productos.forEach((producto, indice) => {
        if (!producto.personalizacion) return;

        const placa = document.createElement('div');
        placa.className = 'mb-4';

        placa.innerHTML = generarVistaPlaca(producto, indice);

        contenedor.appendChild(placa);
    });
}


function validarPaso1() {
    const checkbox = document.getElementById('disclamer');
    const boton = document.getElementById('btn-siguiente-paso');

    if (!checkbox || !boton) return;

    const productos = cargarCarrito();

    const totalProductos = productos.reduce((total, producto) => {
        return total + (parseInt(producto.cantidad, 10) || 0);
    }, 0);

    const tipoEnvio = document.querySelector(
        'input[name="tipo_envio"]:checked'
    );

    const metodoPago = document.querySelector(
        'input[name="metodo_pago"]:checked'
    );

    const valido =
        checkbox.checked &&
        totalProductos > 0 &&
        tipoEnvio !== null &&
        metodoPago !== null;

    boton.disabled = !valido;

    boton.classList.toggle('btn-secondary', !valido);
    boton.classList.toggle('btn-primary', valido);
}


// Mostrar alertas al cambiar las opciones.
document.addEventListener('change', function (event) {
    const esDisclaimer = event.target.matches('#disclamer');

    const esEnvio = event.target.matches(
        'input[name="tipo_envio"]'
    );

    const esPago = event.target.matches(
        'input[name="metodo_pago"]'
    );

    if (!esDisclaimer && !esEnvio && !esPago) return;

    validarPaso1();

    // Solo mostrar la alerta al cambiar el disclaimer.
    if (esDisclaimer && event.target.checked) {
        const pendientes = [];

        if (cargarCarrito().reduce(
            (total, producto) =>
                total + (parseInt(producto.cantidad, 10) || 0),
            0
        ) === 0) {
            pendientes.push('Agregar al menos un producto al carrito.');
        }

        if (!document.querySelector(
            'input[name="tipo_envio"]:checked'
        )) {
            pendientes.push('Seleccionar el tipo de envío.');
        }

        if (!document.querySelector(
            'input[name="metodo_pago"]:checked'
        )) {
            pendientes.push('Seleccionar el método de pago.');
        }

        if (pendientes.length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Completa los datos de tu compra',
                html: `
                    <p>Antes de continuar, necesitas:</p>
                    <ul style="text-align:left;">
                        ${pendientes.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                `,
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#ef4938'
            });
        }
    }
});



/* =========================================================
   EVENTOS DEL CARRITO
   ========================================================= */

// Cambiar cantidades desde cualquiera de las dos vistas.
document.addEventListener('change', function (event) {
    if (!event.target.matches('.carrito-cantidad')) return;

    const indice = Number(event.target.dataset.indice);
    const cantidad = Number(event.target.value);

    if (!Number.isInteger(cantidad) || cantidad < 1) {
        renderizarCarrito();
        return;
    }

    try {
        actualizarCantidadCarrito(indice, cantidad);

        // Recalcular precios según la cantidad total de placas.
        aplicarPreciosCarrito();

        renderizarCarrito();
        actualizarResumenPago();
        validarPaso1();

    } catch (error) {
        console.error('Error al actualizar cantidad:', error);
        renderizarCarrito();
    }
});


// Eliminar una partida.
document.addEventListener('click', function (event) {
    const boton = event.target.closest('.remove-product');
    if (!boton) return;

    removerProductoCarrito(Number(boton.dataset.indice));

    aplicarPreciosCarrito();

    renderizarCarrito();
    actualizarResumenPago();
    validarPaso1();
});


// Inicializar el carrito y cargar el catálogo de descuentos.
async function inicializarCarrito() {
    await cargarCatalogoDescuentos();

    // Restaurar las opciones guardadas del checkout.
    restaurarBorradorCheckout();

    // Actualizar la vista del carrito.
    renderizarCarrito();
    // actualizarResumenPago();
    // validarPaso1();
}


// Cargar al entrar o refrescar la página.
if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        inicializarCarrito,
        { once: true }
    );
} else {
    inicializarCarrito();
}


// Actualizar la vista cuando el carrito cambie desde otro componente.
window.addEventListener('carrito:actualizado', function () {
    aplicarPreciosCarrito();

    renderizarCarrito();
    actualizarResumenPago();
    validarPaso1();
});


// Actualizar el resumen cuando cambie el tipo de envío.
document.addEventListener('change', function (event) {
    if (event.target.matches('input[name="tipo_envio"]')) {
        actualizarResumenPago();
        validarPaso1();
    }
});


/***********************************************************/

const CHECKOUT_DRAFT_KEY = 'checkoutPaso2Draft';

function obtenerBorradorCheckout() {
    try {
        return JSON.parse(
            localStorage.getItem(CHECKOUT_DRAFT_KEY)
        ) || {};
    } catch (error) {
        console.error('Error al recuperar el checkout:', error);
        return {};
    }
}

function guardarBorradorCheckout() {
    const tipoEnvio = document.querySelector(
        'input[name="tipo_envio"]:checked'
    );

    const metodoPago = document.querySelector(
        'input[name="metodo_pago"]:checked'
    );

    const disclaimer = document.getElementById('disclamer');

    const borrador = obtenerBorradorCheckout();

    borrador.tipo_envio = tipoEnvio?.value ?? null;
    borrador.metodo_pago = metodoPago?.value ?? null;
    borrador.disclaimer = disclaimer?.checked ?? false;

    localStorage.setItem(
        CHECKOUT_DRAFT_KEY,
        JSON.stringify(borrador)
    );
}

function restaurarBorradorCheckout() {
    const borrador = obtenerBorradorCheckout();

    if (borrador.tipo_envio !== null &&
        borrador.tipo_envio !== undefined) {

        document.querySelectorAll(
            'input[name="tipo_envio"]'
        ).forEach(input => {
            input.checked = input.value === borrador.tipo_envio;
        });
    }

    if (borrador.metodo_pago !== null &&
        borrador.metodo_pago !== undefined) {

        document.querySelectorAll(
            'input[name="metodo_pago"]'
        ).forEach(input => {
            input.checked = input.value === borrador.metodo_pago;
        });
    }

    const disclaimer = document.getElementById('disclamer');

    if (disclaimer &&
        typeof borrador.disclaimer === 'boolean') {
        disclaimer.checked = borrador.disclaimer;
    }

    validarPaso1();
    actualizarResumenPago();
}

// Guardar cada cambio automáticamente.
document.addEventListener('change', function (event) {
    if (
        event.target.matches('input[name="tipo_envio"]') ||
        event.target.matches('input[name="metodo_pago"]') ||
        event.target.matches('#disclamer')
    ) {
        guardarBorradorCheckout();
    }
});
