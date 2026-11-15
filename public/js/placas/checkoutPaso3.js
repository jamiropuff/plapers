/* =========================================================
   CHECKOUT PLAPERS - PASO 3
   Reutiliza funciones de visualizarCarrito.js sin modificarlo.
   ========================================================= */

(function () {
    'use strict';

    const URL_PROCESAR_COMPRA = `${BASE_URL.replace(/\/$/, '')}/carrito/procesar-compra`;

    function leerBorrador() {
        try {
            return JSON.parse(localStorage.getItem('checkoutPaso2Draft') || '{}');
        } catch (error) {
            console.error('No se pudo leer checkoutPaso2Draft:', error);
            return {};
        }
    }

    function boolEnvio(valor) {
        return valor === true || valor === 1 || valor === '1' ||
            String(valor).toLowerCase() === 'true';
    }

    function mostrarSeleccion(borrador) {
        const envio = document.getElementById('resumen-tipo-envio');
        const pago = document.getElementById('resumen-metodo-pago');
        if (envio) envio.textContent = boolEnvio(borrador.tipo_envio)
            ? 'Envío a domicilio' : 'Recoger en oficina';
        if (pago) pago.textContent = String(borrador.metodo_pago || '').toUpperCase() === 'PAYPAL'
            ? 'PayPal' : 'Depósito bancario';
    }

    function bloquearEdicionProductos() {
        document.querySelectorAll('#carrito-desktop .remove-product, #carrito-mobile .remove-product, #carrito-desktop .carrito-cantidad, #carrito-mobile .carrito-cantidad').forEach(el => {
            el.disabled = true;
            el.hidden = true;
        });
    }

    async function inicializarPaso3() {
        const borrador = leerBorrador();
        mostrarSeleccion(borrador);

        // El script compartido se encarga del catálogo, renderizado y previews.
        if (typeof cargarCatalogoDescuentos === 'function') {
            await cargarCatalogoDescuentos();
        }
        if (typeof aplicarPreciosCarrito === 'function') aplicarPreciosCarrito();
        if (typeof renderizarCarrito === 'function') renderizarCarrito();
        if (typeof renderizarPlacasCarrito === 'function') renderizarPlacasCarrito();

        // Fuerza el cálculo del resumen usando la selección persistida del paso 1.
        if (typeof actualizarResumenPago === 'function') actualizarResumenPago(3);
        bloquearEdicionProductos();

        const boton = document.getElementById('btnProcesarCompra');
        boton?.addEventListener('click', procesarCompra);
    }

    async function procesarCompra() {
        const boton = document.getElementById('btnProcesarCompra');
        const config = window.checkoutPaso3 || {};
        const borrador = leerBorrador();
        const productos = typeof cargarCarrito === 'function' ? cargarCarrito() : [];

        if (!productos.length) {
            await Swal.fire('Carrito vacío', 'Agrega productos antes de continuar.', 'warning');
            return;
        }

        if (borrador.tipo_envio !== 'true' && borrador.tipo_envio !== 'false' &&
            borrador.tipo_envio !== true && borrador.tipo_envio !== false) {
            await Swal.fire('Tipo de envío', 'No encontramos tu selección. Regresa al primer paso.', 'warning');
            return;
        }
        if (!['PAYPAL', 'DEPOSITO'].includes(String(borrador.metodo_pago || '').toUpperCase())) {
            await Swal.fire('Método de pago', 'No encontramos tu selección. Regresa al primer paso.', 'warning');
            return;
        }
        if (!document.getElementById('autorizacion_compra')?.checked) {
            await Swal.fire('Confirma tu pedido', 'Debes aceptar la autorización antes de continuar.', 'warning');
            return;
        }

        if (boton) boton.disabled = true;

        try {
            const formData = new FormData();
            formData.set('productos', JSON.stringify(productos));
            formData.set('id_tipo_envio', String(config.idTipoEnvio));
            formData.set('id_tipo_pago', String(config.idTipoPago));
            formData.set('id_direccion', String(config.idDireccion || 0));
            formData.set('id_facturacion', String(config.idFacturacion || 0));
            formData.set('requiere_factura', String(config.requiereFactura || 0));
            formData.set('notas_adicionales', document.getElementById('notas_adicionales')?.value || '');
            formData.set('autorizacion_compra', '1');

            const headers = { 'X-Requested-With': 'XMLHttpRequest' };
            if (config.csrfName && config.csrfHash) headers['X-CSRF-TOKEN'] = config.csrfHash;

            const response = await fetch(URL_PROCESAR_COMPRA, {
                method: 'POST',
                body: formData,
                headers,
                credentials: 'same-origin'
            });

            const contentType = response.headers.get('content-type') || '';
            const result = contentType.includes('application/json')
                ? await response.json()
                : { Msg: await response.text() };

            if (!response.ok || result.Code === 0 || result.Code === '0' || result.Code === 400) {
                throw new Error(result.Msg || 'No fue posible procesar la compra.');
            }

            // El controlador compartido aún debe implementar la respuesta de éxito
            // y el flujo de pago antes de limpiar el carrito o redirigir.
            if (result.Code === undefined && result.success !== true) {
                throw new Error(result.Msg || 'El servidor no confirmó el registro de la orden.');
            }

            if (result.redirect) {
                window.location.href = result.redirect;
                return;
            }

            // await Swal.fire('Solicitud recibida', result.Msg || 'El servidor confirmó el procesamiento.', 'success');


            await Swal.fire({
                title: '¡Compra realizada!',
                text: result.Msg || 'Tu pedido se registró correctamente.',
                icon: 'success',
                confirmButtonText: 'Ver mis compras',
                allowOutsideClick: false,
                allowEscapeKey: false
            });

            // Limpiar información del carrito y checkout
            localStorage.removeItem('Carrito');
            localStorage.removeItem('checkoutPaso2Draft');

            // Limpiar también el borrador de sesión, si existe
            sessionStorage.removeItem('checkoutPaso2Draft');

            // Redireccionar al historial de compras
            window.location.href = result.redirect || `${BASE_URL.replace(/\/$/, '')}/mis-compras`;


        } catch (error) {
            console.error('Error al procesar compra:', error);
            await Swal.fire('No se pudo procesar', error.message || 'Ocurrió un error inesperado.', 'error');
        } finally {
            if (boton) boton.disabled = false;
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', inicializarPaso3, { once: true });
    } else {
        inicializarPaso3();
    }
})();
