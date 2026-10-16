<!-- Mis Compras - Area de Cliente -->
<main class="py-5" style="background-color: #0d0d0d; min-height: 80vh;">
    <div class="container">
        <!-- Breadcrumb / Titulo -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white fw-bold">Mis Compras</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('mi-cuenta') ?>" class="text-white-50">Mi Cuenta</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Mis Compras</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-4">
            <!-- Columna Navegación -->
            <div class="col-lg-4 col-xl-3">
                <?= view('cliente/nav_cliente', ['seccion_activa' => 'mis_compras']) ?>
            </div>

            <!-- Columna Contenido Principal -->
            <div class="col-lg-8 col-xl-9">
                <div class="card bg-dark text-white border-secondary shadow-sm">
                    <div class="card-header bg-transparent border-secondary py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="fa-solid fa-box-open text-primary me-2"></i> Historial de Pedidos
                        </h5>
                        <span class="badge bg-secondary"><?= count($ordenes) ?> órdenes</span>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($ordenes)): ?>
                            <div class="p-5 text-center">
                                <div class="text-white-50 mb-3">
                                    <i class="fa-solid fa-cart-shopping fa-3x"></i>
                                </div>
                                <h5 class="text-white">Aún no tienes compras realizadas</h5>
                                <p class="text-white-50 small mb-4">Explora nuestro catálogo de placas personalizadas y haz tu primer pedido.</p>
                                <a href="<?= base_url('placas/tienda') ?>" class="btn btn-primary px-4 py-2">
                                    <i class="fa-solid fa-store me-2"></i> Ir a la Tienda
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="text-white-50 small border-secondary">
                                            <th class="ps-4">Folio</th>
                                            <th>Fecha</th>
                                            <th>Estatus Pedido</th>
                                            <th>Estatus Pago</th>
                                            <th>Total</th>
                                            <th class="text-end pe-4">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ordenes as $orden): ?>
                                            <tr class="border-secondary">
                                                <td class="ps-4 fw-bold text-primary">#<?= esc($orden->id_orden) ?></td>
                                                <td class="small text-white-50"><?= esc($orden->fecha_pedido ? date('d/m/Y', strtotime($orden->fecha_pedido)) : 'N/A') ?></td>
                                                <td>
                                                    <span class="badge bg-info text-dark">
                                                        <?= esc($orden->estatus_pedido ?? 'En proceso') ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if (isset($orden->id_estatus_pago) && $orden->id_estatus_pago == 2): ?>
                                                        <span class="badge bg-success">Pagado</span>
                                                    <?php elseif (isset($orden->id_estatus_pago) && $orden->id_estatus_pago == 3): ?>
                                                        <span class="badge bg-danger">Cancelado</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="fw-bold">$<?= number_format((float)($orden->total ?? 0), 2) ?> MXN</td>
                                                <td class="text-end pe-4">
                                                    <button class="btn btn-sm btn-outline-primary" onclick="verDetalleCompra(<?= esc($orden->id_orden) ?>)">
                                                        <i class="fa-solid fa-eye me-1"></i> Detalle
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Detalle de Compra -->
<div class="modal fade" id="modalDetalleCompra" tabindex="-1" aria-labelledby="modalDetalleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="modalDetalleLabel">
                    <i class="fa-solid fa-receipt text-primary me-2"></i> Detalle de la Orden <span id="modalFolioOrden"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalDetalleContenido">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/cliente.js') ?>"></script>
