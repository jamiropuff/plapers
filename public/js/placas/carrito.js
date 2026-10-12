/* =========================================================
   CARRITO PLAPERS - JAVASCRIPT PURO
   ========================================================= */

const CLAVE_CARRITO = 'Carrito';

/**
 * Obtiene el carrito de localStorage.
 * Migra la clave anterior "carrito" si fuera necesario.
 */
function cargarCarrito() {
    try {
        let carrito = localStorage.getItem(CLAVE_CARRITO);

        // if (carrito === null) {
        //     const carritoAnterior = localStorage.getItem('carrito');

        //     if (carritoAnterior !== null) {
        //         carrito = carritoAnterior;
        //         localStorage.setItem(CLAVE_CARRITO, carrito);
        //         localStorage.removeItem('carrito');
        //     }
        // }

        const productos = JSON.parse(carrito || '[]');

        return Array.isArray(productos) ? productos : [];
    } catch (error) {
        console.error('Error al cargar el carrito:', error);
        return [];
    }
}


/**
 * Guarda el carrito y notifica a los elementos
 * de la página que deben actualizarse.
 */
function guardarCarrito(productos) {
    localStorage.setItem(
        CLAVE_CARRITO,
        JSON.stringify(productos)
    );

    window.dispatchEvent(
        new CustomEvent('carrito:actualizado', {
            detail: calcularTotales(productos)
        })
    );
}

/**
 * Calcula el número total de unidades y el importe visual.
 * Los importes definitivos se calcularán en el backend.
 */
function calcularTotales(productos = cargarCarrito()) {
    return productos.reduce((totales, producto) => {
        const cantidad = Math.max(
            0,
            parseInt(producto.cantidad, 10) || 0
        );

        totales.totalProductos += cantidad;

        totales.totalCompra +=
            (Number(producto.precio_unitario) || 0) * cantidad;

        return totales;
    }, {
        totalProductos: 0,
        totalCompra: 0
    });
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

/**
 * Agrega un producto.
 * Recibe el objeto que ya construye agregarACarrito()
 * en detail.php.
 */
function agregarProductoCarrito(producto, cantidad) {
    const unidades = parseInt(
        cantidad ?? document.getElementById('cantidad')?.value,
        10
    );

    if (!producto || !producto.id_producto) {
        throw new Error('El producto no es válido.');
    }

    if (!Number.isInteger(unidades) || unidades < 1) {
        throw new Error('La cantidad debe ser al menos 1.');
    }

    const productos = cargarCarrito();
    const nuevo = {
        ...producto,
        cantidad: unidades,
        personalizacion: producto.personalizacion ?? null
    };

    // Los productos sin personalización se acumulan por ID.
    // Las placas se acumulan solo si coinciden sus opciones.
    const indice = productos.findIndex(actual => {
        if (
            String(actual.id_producto) !==
            String(nuevo.id_producto)
        ) {
            return false;
        }

        if (!actual.personalizacion && !nuevo.personalizacion) {
            return true;
        }

        return mismaPersonalizacion(
            actual.personalizacion,
            nuevo.personalizacion
        );
    });

    if (indice >= 0) {
        productos[indice].cantidad =
            (parseInt(productos[indice].cantidad, 10) || 0)
            + unidades;
    } else {
        productos.push(nuevo);
    }

    // Precio informativo, no es el precio autorizado para cobrar.
    productos.forEach(item => {
        item.precio = (
            (Number(item.precio_unitario) || 0) *
            (Number(item.cantidad) || 0)
        );
    });

    guardarCarrito(productos);

    return productos;
}

/**
 * Elimina una partida por su índice.
 */
function removerProductoCarrito(indice) {
    const productos = cargarCarrito();

    if (
        !Number.isInteger(indice) ||
        indice < 0 ||
        indice >= productos.length
    ) {
        return productos;
    }

    productos.splice(indice, 1);
    guardarCarrito(productos);

    return productos;
}

/**
 * Modifica la cantidad de una partida.
 */
function actualizarCantidadCarrito(indice, cantidad) {
    const productos = cargarCarrito();
    const unidades = parseInt(cantidad, 10);

    if (
        !productos[indice] ||
        !Number.isInteger(unidades) ||
        unidades < 1
    ) {
        throw new Error('Índice o cantidad no válidos.');
    }

    productos[indice].cantidad = unidades;
    productos[indice].precio =
        (Number(productos[indice].precio_unitario) || 0)
        * unidades;

    guardarCarrito(productos);

    return productos;
}

/**
 * Actualiza el contador del carrito en el encabezado.
 * Conserva la clase .cart-quantity de Carrito.vue.
 */
function actualizarContadorCarrito() {
    let productos = [];

    try {
        // Leer el carrito guardado
        productos = JSON.parse(
            localStorage.getItem('Carrito') ??
            localStorage.getItem('carrito') ??
            '[]'
        );

        if (!Array.isArray(productos)) {
            productos = [];
        }
    } catch (error) {
        console.error('Error al leer el carrito:', error);
    }

    // Sumar las cantidades de todas las partidas
    const total = productos.reduce((suma, producto) => {
        return suma + Math.max(
            0,
            parseInt(producto.cantidad, 10) || 0
        );
    }, 0);

    // Actualizar escritorio y móvil
    document.querySelectorAll('.cart-badge-dot').forEach(badge => {
        badge.textContent = total;
        badge.style.display = total > 0 ? 'inline-flex' : 'none';
    });
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

    function escapar(valor) {
        return String(valor ?? '').replace(/[&<>"']/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        })[c]);
    }

    function generarProducto(producto, indice, esMovil = false) {
        const cantidad = Math.max(1, parseInt(producto.cantidad, 10) || 1);
        const precio = Math.max(0, Number(producto.precio_unitario) || 0);
        const total = precio * cantidad;
        const p = producto.personalizacion || {};

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
                <div class="text-muted">${escapar(producto.nom_categoria)}</div>
                ${lineas}
                <div>Color: <div class="selector-color--item selector-color-${escapar(p.color ?? '')}"></div></div>
                <div>Distribución: <img class="" src="${BASE_URL}/img/posiciones/p${escapar(p.posicion ?? '')}.png" style="width: 70px; border: 1px solid #ffffff; border-radius: 10px;"></div>
                <div>Acabado: ${escapar(p.acabado ?? '')}</div>
            </div>`;

        if (esMovil) {
            return `
                <div class="product p-4 bor-top bor-bottom"
                     data-indice="${indice}">
                    <div class="product-details d-flex align-items-center gap-3">
                        ${imagen}${detalles}
                    </div>
                    <div class="mt-3">
                        Precio: ${moneda.format(precio)}
                    </div>
                    <div class="product-quantity mt-2">
                        <label>Cantidad:</label>
                        <input type="number" min="1" step="1"
                               class="form-control carrito-cantidad"
                               data-indice="${indice}" value="${cantidad}">
                    </div>
                    <div class="mt-2">
                        Total: <strong>${moneda.format(total)}</strong>
                    </div>
                    <button type="button" class="remove-product mt-2"
                            data-indice="${indice}">Eliminar ×</button>
                </div>`;
        }

        return `
            <div class="product p-4 bor-top bor-bottom d-flex
                        justify-content-between align-items-center"
                 data-indice="${indice}">
                <div class="product-details d-flex align-items-center gap-3"
                     style="width:40%">
                    ${imagen}${detalles}
                </div>
                <div class="product-price text-center" style="width:15%">
                    ${moneda.format(precio)}
                </div>
                <div class="product-quantity text-center" style="width:15%">
                    <input type="number" min="1" step="1"
                           class="form-control carrito-cantidad mx-auto"
                           style="width:75px"
                           data-indice="${indice}" value="${cantidad}">
                </div>
                <div class="product-line-price text-center" style="width:15%">
                    ${moneda.format(total)}
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

    document.getElementById('cart-subtotal-desktop').textContent = subtotal;
    document.getElementById('cart-subtotal-mobile').textContent = subtotal;

    actualizarContadorCarrito();
}


// Al cargar o refrescar la página
document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);

// Cuando se actualice el carrito en esta página
window.addEventListener('carrito:actualizado', actualizarContadorCarrito);

// Cuando cambie el carrito desde otra pestaña
window.addEventListener('storage', event => {
    if (event.key === 'Carrito' || event.key === 'carrito') {
        actualizarContadorCarrito();
    }
});

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
        renderizarCarrito();
    } catch (error) {
        console.error(error);
        renderizarCarrito();
    }
});

// Eliminar una partida.
document.addEventListener('click', function (event) {
    const boton = event.target.closest('.remove-product');
    if (!boton) return;

    removerProductoCarrito(Number(boton.dataset.indice));
    renderizarCarrito();
});

// Cargar el carrito al entrar o refrescar la página.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', renderizarCarrito);
} else {
    renderizarCarrito();
}

// Permitir actualizar la vista cuando se modifica el carrito.
window.addEventListener('carrito:actualizado', renderizarCarrito);


