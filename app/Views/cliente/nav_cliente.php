<?php
$seccion_activa = $seccion_activa ?? 'mi_cuenta';
$session = session();
$nombre_completo = trim(($session->get('Nombres') ?? '') . ' ' . ($session->get('Paterno') ?? ''));
if (empty($nombre_completo)) {
    $nombre_completo = $session->get('User') ?? 'Cliente';
}
?>

<div class="card bg-dark text-white border-secondary mb-4 shadow-sm">
    <div class="card-body p-4 text-center">
        <div class="avatar-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 75px; height: 75px; border-radius: 50%; background: linear-gradient(135deg, #0d6efd, #0dcaf0); color: #fff; font-size: 28px; font-weight: bold;">
            <?= strtoupper(substr($nombre_completo, 0, 1)) ?>
        </div>
        <h5 class="card-title text-white mb-1"><?= esc($nombre_completo) ?></h5>
        <p class="text-white-50 small mb-0">@<?= esc($session->get('User')) ?></p>
        <span class="badge bg-primary mt-2">Cliente Plapers</span>
    </div>

    <div class="list-group list-group-flush border-top border-secondary">
        <a href="<?= base_url('mi-cuenta') ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary d-flex align-items-center py-3 <?= ($seccion_activa === 'mi_cuenta') ? 'active bg-primary border-primary' : '' ?>">
            <i class="fa-solid fa-user me-3 fa-fw"></i> Mi Cuenta / Perfil
        </a>
        <a href="<?= base_url('mis-compras') ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary d-flex align-items-center py-3 <?= ($seccion_activa === 'mis_compras') ? 'active bg-primary border-primary' : '' ?>">
            <i class="fa-solid fa-box-open me-3 fa-fw"></i> Mis Compras
        </a>
        <a href="<?= base_url('mis-direcciones') ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary d-flex align-items-center py-3 <?= ($seccion_activa === 'mis_direcciones') ? 'active bg-primary border-primary' : '' ?>">
            <i class="fa-solid fa-location-dot me-3 fa-fw"></i> Mis Direcciones
        </a>
        <a href="<?= base_url('domicilio-fiscal') ?>" class="list-group-item list-group-item-action bg-dark text-white border-secondary d-flex align-items-center py-3 <?= ($seccion_activa === 'domicilio_fiscal') ? 'active bg-primary border-primary' : '' ?>">
            <i class="fa-solid fa-file-invoice me-3 fa-fw"></i> Domicilio Fiscal
        </a>
        <a href="<?= base_url('login/salir') ?>" class="list-group-item list-group-item-action bg-dark text-danger border-secondary d-flex align-items-center py-3">
            <i class="fa-solid fa-arrow-right-from-bracket me-3 fa-fw"></i> Cerrar Sesión
        </a>
    </div>
</div>
