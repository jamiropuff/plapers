<section class="cart-page pt-130 pb-130">
    <div class="container">
        <h2 class="text-white mb-2">Direcciones de tu compra</h2>
        <p class="text-white-50 mb-4">Elige por separado dónde recibir el pedido y qué domicilio fiscal usar para la factura.</p>

        <?php if (session()->getFlashdata('checkout_address_error')): ?>
            <div class="alert alert-danger" role="alert"><?= esc(session()->getFlashdata('checkout_address_error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('checkout_address_success')): ?>
            <div class="alert alert-success" role="status"><?= esc(session()->getFlashdata('checkout_address_success')) ?></div>
        <?php endif; ?>

        <form action="<?= base_url('carrito/paso2/domicilios') ?>" method="post" class="card sub-bg text-white">
            <?= csrf_field() ?>
            <div class="card-body p-4">
                <div class="mb-4">
                    <label for="id_direccion" class="form-label fw-bold">Domicilio de entrega</label>
                    <br>
                    <div class="form-text text-white-50 small">Para envío a domicilio, selecciona una dirección de entrega.</div>
                    <br>
                    <select name="id_direccion" id="id_direccion" class="form-select bg-black text-white border-secondary">
                        <option value="0">No aplica: recoger en oficina</option>
                        <?php foreach ($direcciones as $direccion): ?>
                            <?php
                            $direccionTexto = trim($direccion->calle . ' ' . $direccion->numero . ($direccion->interior ? ' Int. ' . $direccion->interior : '') . ', ' . $direccion->colonia . ', ' . $direccion->municipio . ', C.P. ' . $direccion->codigo_postal);
                            ?>
                            <option value="<?= esc($direccion->id_direccion) ?>" <?= (int) $direccionSeleccionada === (int) $direccion->id_direccion ? 'selected' : '' ?>>
                                <?= esc($direccion->recibe . ' — ' . $direccionTexto) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <a class="small btn btn-info" href="<?= base_url('mis-direcciones') ?>">Administrar domicilios de entrega</a>
                    <?php if (empty($direcciones)): ?>
                        <p class="text-warning small mt-2 mb-0">Aún no tienes direcciones guardadas. Agrega una para recibir tu pedido a domicilio.</p>
                    <?php endif; ?>
                </div>

                <div class="mt-4 mb-4">
                    <label for="id_facturacion" class="form-label fw-bold">Domicilio fiscal</label><br>
                    <select name="id_facturacion" id="id_facturacion" class="form-select bg-black text-white border-secondary">
                        <option value="0">No requiero factura</option>
                        <?php foreach ($facturaciones as $facturacion): ?>
                            <?php $titular = (int) $facturacion->tipo_persona === 2 ? $facturacion->razon_social : trim($facturacion->nombres . ' ' . $facturacion->paterno . ' ' . $facturacion->materno); ?>
                            <option value="<?= esc($facturacion->id_facturacion) ?>" <?= (int) $facturacionSeleccionada === (int) $facturacion->id_facturacion ? 'selected' : '' ?>>
                                <?= esc($titular . ' — RFC ' . $facturacion->rfc . ' — C.P. ' . $facturacion->codigo_postal) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <a class="small btn btn-info" href="<?= base_url('domicilio-fiscal') ?>">Administrar domicilios fiscales</a>
                    <?php if (empty($facturaciones)): ?>
                        <p class="text-white-50 small mt-2 mb-0">Puedes registrar varios domicilios fiscales desde tu cuenta y elegir uno cuando necesites factura.</p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Guardar selección de direcciones</button>
                <a href="<?= base_url('carrito') ?>" class="btn btn-outline-light ms-2">Regresar al carrito</a>
            </div>
        </form>
    </div>
</section>
