<?php
// Paso 3: verificación final de la compra.
$envioDomicilio = (int) ($idTipoEnvio ?? 2) === 1;
$metodoPagoTexto = (int) ($idTipoPago ?? 0) === 1 ? 'PayPal' : ((int) ($idTipoPago ?? 0) === 2 ? 'Depósito bancario' : 'No definido');
$direccion = $direccionEnvio ?? null;
$facturacion = $datosFacturacion ?? null;
?>
<section class="cart-page pt-130 pb-130">
    <div class="container">
        <div class="mb-4">
            <h3 class="fw-bold">Verifica tu pedido</h3>
            <p>Revisa los productos y la información de tu compra antes de confirmarla.</p>
        </div>

        <!-- Se conserva la estructura que utiliza visualizarCarrito.js -->
        <div class="shopping-cart radius-10 bor sub-bg d-none d-md-block">
            <div class="column-labels py-3 px-4 d-flex justify-content-between align-items-center fw-bold text-white text-uppercase">
                <label class="product-details" style="width:40%">Producto</label>
                <label class="product-price text-center" style="width:15%">Precio</label>
                <label class="product-quantity text-center" style="width:15%">Cantidad</label>
                <label class="product-line-price text-center" style="width:15%">Total</label>
                <label class="product-removal text-center" style="width:10%"></label>
            </div>
            <div id="carrito-desktop"></div>
        </div>
        <div class="shopping-cart mobile-view bor sub-bg d-md-none">
            <div id="carrito-mobile"></div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-6 mb-3">
                <div class="card sub-bg text-white h-100">
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Datos de tu compra</h4>
                        <p class="mb-2"><strong>Tipo de envío:</strong>
                            <?= esc($envioDomicilio ? 'Envío a domicilio' : 'Recoger en oficina') ?>
                        </p>
                        <p class="mb-0"><strong>Método de pago:</strong> <?= esc($metodoPagoTexto) ?></p>
                        <small class="d-block mt-3">Para cambiar estas opciones, regresa al primer paso.</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card sub-bg text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Detalles de pago</h5>
                        <table style="width:100%">
                            <tr style="border-bottom:1px solid #6e6e6e">
                                <td class="td-title-1">Cantidad de productos:</td>
                                <td class="td-title-2" id="tcantidad">0 <small id="texplicacion" class="d-none"></small></td>
                            </tr>
                            <tr style="border-bottom:1px solid #6e6e6e"><td class="td-title-1">Subtotal</td><td class="td-title-2" id="tsubtotal">$ 0.00</td></tr>
                            <tr id="trEnvio" class="d-none" style="border-bottom:1px solid #6e6e6e"><td class="td-title-1">Envío</td><td class="td-title-2" id="tenvio">$ 0.00</td></tr>
                            <tr style="border-bottom:1px solid #6e6e6e"><td class="td-title-1">IVA</td><td class="td-title-2" id="tiva">$ 0.00</td></tr>
                            <tr style="border-bottom:1px solid #6e6e6e"><td class="order-total">Total a pagar</td><td class="order-total-price" id="ttotal">$ 0.00</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($envioDomicilio && $direccion): ?>
        <div class="card sub-bg text-white mt-3">
            <div class="card-body">
                <h5 class="fw-bold">Dirección de entrega</h5>
                <p class="mb-1"><strong>Recibe:</strong> <?= esc($direccion->recibe ?? '') ?></p>
                <p class="mb-1">
                    <?= esc(implode(', ', array_filter([
                        $direccion->calle ?? '', $direccion->numero ?? '',
                        $direccion->interior ?? '', $direccion->colonia ?? '',
                        $direccion->municipio ?? '', $direccion->codigo_postal ?? ''
                    ], static fn($v) => $v !== '' && $v !== null))) ?>
                </p>
                <p class="mb-0"><strong>Teléfono:</strong> <?= esc($direccion->telefono ?? '') ?></p>
            </div>
        </div>
        <?php endif; ?>

        <?php if ((int) ($requiereFactura ?? 0) === 1 && $facturacion): ?>
        <div class="card sub-bg text-white mt-3">
            <div class="card-body">
                <h5 class="fw-bold">Datos de facturación</h5>
                <p class="mb-1"><strong>Razón social:</strong> <?= esc($facturacion->razon_social ?? '') ?></p>
                <p class="mb-1"><strong>RFC:</strong> <?= esc($facturacion->rfc ?? '') ?></p>
                <p class="mb-1"><strong>Régimen fiscal:</strong> <?= esc($facturacion->regimen_fiscal ?? '') ?></p>
                <p class="mb-0"><strong>Código postal:</strong> <?= esc($facturacion->codigo_postal ?? '') ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Las vistas previas se generan con la función original -->
        <div id="placas" class="mt-4"></div>

        <div class="card sub-bg text-white mt-4">
            <div class="card-body">
                <label for="notas_adicionales" class="fw-bold">Notas adicionales (opcional)</label>
                <textarea id="notas_adicionales" class="form-control" rows="3" maxlength="1000" placeholder="Escribe alguna indicación para tu pedido..."></textarea>
            </div>
        </div>

        <div class="row mt-4 mb-2">
            <div class="col-md-12">
                <input type="checkbox" id="autorizacion_compra" style="transform:scale(1.3)">
                <label class="font-leyenda" for="autorizacion_compra">
                    Confirmo que revisé y autorizo los diseños personalizados de mi pedido. Entiendo que las placas son de uso decorativo y no de uso oficial.
                </label>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-3">
            <a href="<?= base_url('carrito/paso2') ?>" class="btn btn-secondary">Regresar</a>
            <button id="btnProcesarCompra" class="btn btn-primary" type="button">Procesar compra</button>
        </div>
    </div>
</section>

<script>
window.checkoutPaso3 = <?= json_encode([
    'idTipoEnvio' => (int) ($idTipoEnvio ?? 0),
    'idTipoPago' => (int) ($idTipoPago ?? 0),
    'requiereFactura' => (int) ($requiereFactura ?? 0),
    'idDireccion' => (int) session()->get('Checkout_Id_Direccion'),
    'idFacturacion' => (int) session()->get('Checkout_Id_Facturacion'),
    'csrfName' => csrf_token(),
    'csrfHash' => csrf_hash(),
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
</script>
