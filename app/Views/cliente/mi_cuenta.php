<!-- Mi Cuenta - Area de Cliente -->
<main class="py-5" style="background-color: #0d0d0d; min-height: 80vh;">
    <div class="container">
        <!-- Breadcrumb / Titulo -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white fw-bold">Mi Cuenta</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50">Inicio</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Mi Cuenta</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-4">
            <!-- Columna Navegación -->
            <div class="col-lg-4 col-xl-3">
                <?= view('cliente/nav_cliente', ['seccion_activa' => 'mi_cuenta']) ?>
            </div>

            <!-- Columna Contenido Principal -->
            <div class="col-lg-8 col-xl-9">
                <!-- Métricas Rápidas -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card bg-dark text-white border-secondary h-100 shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-primary bg-opacity-25 p-3 text-primary me-3">
                                    <i class="fa-solid fa-cart-shopping fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 small mb-1">Compras Realizadas</h6>
                                    <h3 class="mb-0 fw-bold"><?= esc($stats['total_pedidos'] ?? 0) ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-dark text-white border-secondary h-100 shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-success bg-opacity-25 p-3 text-success me-3">
                                    <i class="fa-solid fa-map-location-dot fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 small mb-1">Direcciones Guardadas</h6>
                                    <h3 class="mb-0 fw-bold"><?= esc($stats['total_direcciones'] ?? 0) ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-dark text-white border-secondary h-100 shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-info bg-opacity-25 p-3 text-info me-3">
                                    <i class="fa-solid fa-file-invoice-dollar fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="text-white-50 small mb-1">Datos Fiscales</h6>
                                    <h6 class="mb-0 fw-bold <?= !empty($stats['tiene_facturacion']) ? 'text-success' : 'text-warning' ?>">
                                        <?= !empty($stats['tiene_facturacion']) ? 'Configurado' : 'Pendiente' ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta: Información de la Cuenta y Datos Personales -->
                <div class="card bg-dark text-white border-secondary mb-4 shadow-sm">
                    <div class="card-header bg-transparent border-secondary py-3">
                        <h5 class="card-title text-white mb-0">
                            <i class="fa-solid fa-id-card text-primary me-2"></i> Datos Personales
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="alerta_perfil"></div>

                        <form id="formActualizarPerfil" onsubmit="actualizarPerfilCliente(event)">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-white-50 small">Nombre de Usuario</label>
                                    <input type="text" class="form-control bg-black text-white-50 border-secondary" value="<?= esc($usuario->username ?? '') ?>" readonly>
                                    <small class="text-muted">El usuario no se puede modificar.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white-50 small">Correo Electrónico</label>
                                    <input type="email" class="form-control bg-black text-white-50 border-secondary" value="<?= esc($usuario->correo_electronico ?? '') ?>" readonly>
                                    <small class="text-muted">Asociado a tu cuenta.</small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-white small">Nombre(s) *</label>
                                    <input type="text" id="perfil_nombres" name="nombres" class="form-control bg-black text-white border-secondary" value="<?= esc($info->nombres ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">Apellido Paterno *</label>
                                    <input type="text" id="perfil_paterno" name="paterno" class="form-control bg-black text-white border-secondary" value="<?= esc($info->paterno ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">Apellido Materno</label>
                                    <input type="text" id="perfil_materno" name="materno" class="form-control bg-black text-white border-secondary" value="<?= esc($info->materno ?? '') ?>">
                                </div>
                                <div class="col-12 text-end mt-4">
                                    <button type="submit" id="btnGuardarPerfil" class="btn btn-primary px-4 py-2">
                                        <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tarjeta: Seguridad / Cambio de Contraseña -->
                <div class="card bg-dark text-white border-secondary shadow-sm">
                    <div class="card-header bg-transparent border-secondary py-3">
                        <h5 class="card-title text-white mb-0">
                            <i class="fa-solid fa-lock text-warning me-2"></i> Cambiar Contraseña
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="alerta_password"></div>

                        <form id="formCambiarPassword" onsubmit="cambiarPasswordCliente(event)">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white small">Contraseña Actual *</label>
                                    <input type="password" id="pass_actual" name="pass_actual" class="form-control bg-black text-white border-secondary" placeholder="••••••••" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-white small">Nueva Contraseña *</label>
                                    <input type="password" id="pass_nueva" name="pass_nueva" class="form-control bg-black text-white border-secondary" placeholder="Mínimo 6 caracteres" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-white small">Confirmar Nueva Contraseña *</label>
                                    <input type="password" id="pass_nueva_confirm" name="pass_nueva_confirm" class="form-control bg-black text-white border-secondary" placeholder="Repite la contraseña" required>
                                </div>
                                <div class="col-12 text-end mt-4">
                                    <button type="submit" id="btnCambiarPass" class="btn btn-outline-warning px-4 py-2">
                                        <i class="fa-solid fa-key me-2"></i> Actualizar Contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('js/cliente.js') ?>"></script>
