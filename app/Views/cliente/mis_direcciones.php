<!-- Mis Direcciones - Area de Cliente -->
<main class="py-5" style="background-color: #0d0d0d; min-height: 80vh;">
    <div class="container">
        <!-- Breadcrumb / Titulo -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white fw-bold">Mis Direcciones</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('mi-cuenta') ?>" class="text-white-50">Mi Cuenta</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Mis Direcciones</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-4">
            <!-- Columna Navegación -->
            <div class="col-lg-4 col-xl-3">
                <?= view('cliente/nav_cliente', ['seccion_activa' => 'mis_direcciones']) ?>
            </div>

            <!-- Columna Contenido Principal -->
            <div class="col-lg-8 col-xl-9">
                <div class="card bg-dark text-white border-secondary shadow-sm">
                    <div class="card-header bg-transparent border-secondary py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-white mb-0">
                            <i class="fa-solid fa-location-dot text-primary me-2"></i> Direcciones de Envío
                        </h5>
                        <button type="button" class="btn btn-primary btn-sm" onclick="abrirModalDireccion()">
                            <i class="fa-solid fa-plus me-1"></i> Nueva Dirección
                        </button>
                    </div>
                    <div class="card-body p-4">
                        <div id="alerta_direccion"></div>

                        <?php if (empty($direcciones)): ?>
                            <div class="text-center py-5">
                                <div class="text-white-50 mb-3">
                                    <i class="fa-solid fa-map-location-dot fa-3x"></i>
                                </div>
                                <h5 class="text-white">No tienes direcciones registradas</h5>
                                <p class="text-white-50 small mb-4">Guarda tus datos de envío para agilizar tus compras.</p>
                                <button type="button" class="btn btn-outline-primary px-4 py-2" onclick="abrirModalDireccion()">
                                    <i class="fa-solid fa-plus me-2"></i> Agregar mi primera dirección
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="row g-3">
                                <?php foreach ($direcciones as $dir): ?>
                                    <div class="col-md-6" id="card-direccion-<?= esc($dir->id_direccion) ?>">
                                        <div class="card bg-black border-secondary text-white h-100 shadow-sm">
                                            <div class="card-body p-3">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="card-title text-white fw-bold mb-0">
                                                        <i class="fa-solid fa-user-tag text-primary me-1"></i> <?= esc($dir->recibe) ?>
                                                    </h6>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-outline-info me-1" onclick="editarDireccion(<?= esc($dir->id_direccion) ?>)" title="Editar">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarDireccion(<?= esc($dir->id_direccion) ?>)" title="Eliminar">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="text-white-50 small mb-1">
                                                    <i class="fa-solid fa-phone me-1"></i> <?= esc($dir->telefono) ?>
                                                </p>
                                                <p class="text-white small mb-1">
                                                    <?= esc($dir->calle) ?> #<?= esc($dir->numero) ?><?= !empty($dir->interior) && $dir->interior !== '0' ? ' Int. ' . esc($dir->interior) : '' ?>
                                                </p>
                                                <p class="text-white-50 small mb-1">
                                                    Col. <?= esc($dir->colonia) ?>, C.P. <?= esc($dir->codigo_postal) ?>
                                                </p>
                                                <p class="text-white-50 small mb-2">
                                                    <?= esc($dir->municipio) ?>, <?= esc($dir->nom_estado ?? '') ?>
                                                </p>
                                                <?php if (!empty($dir->referencia) && $dir->referencia !== '0'): ?>
                                                    <div class="bg-dark p-2 rounded small text-white-50">
                                                        <strong class="text-white-50">Ref:</strong> <?= esc($dir->referencia) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Agregar/Editar Dirección -->
<div class="modal fade" id="modalDireccion" tabindex="-1" aria-labelledby="modalDireccionLabel" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="modalDireccionLabel">
                    <i class="fa-solid fa-location-dot text-primary me-2"></i> <span id="modalDireccionTitulo">Nueva Dirección</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDireccion" onsubmit="guardarDireccion(event)">
                <input type="hidden" id="dir_id" name="id_direccion" value="">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-white small">Nombre de quien recibe *</label>
                            <input type="text" id="dir_recibe" name="recibe" class="form-control bg-black text-white border-secondary" placeholder="Ej. Juan Pérez" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small">Teléfono de contacto *</label>
                            <input type="tel" id="dir_telefono" name="telefono" class="form-control bg-black text-white border-secondary" placeholder="10 dígitos" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label text-white small">Calle *</label>
                            <input type="text" id="dir_calle" name="calle" class="form-control bg-black text-white border-secondary" placeholder="Nombre de la calle" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-white small">Núm. Ext *</label>
                            <input type="text" id="dir_numero" name="numero" class="form-control bg-black text-white border-secondary" placeholder="Ext" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-white small">Núm. Int</label>
                            <input type="text" id="dir_interior" name="interior" class="form-control bg-black text-white border-secondary" placeholder="Int">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small">Colonia *</label>
                            <input type="text" id="dir_colonia" name="colonia" class="form-control bg-black text-white border-secondary" placeholder="Colonia o Fracc." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small">Municipio / Alcaldía *</label>
                            <input type="text" id="dir_municipio" name="municipio" class="form-control bg-black text-white border-secondary" placeholder="Municipio" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small">Estado *</label>
                            <select id="dir_estado" name="estado" class="form-select bg-black text-white border-secondary select2 no-nice-select" required style="width: 100%;">
                                <option value="">Selecciona un estado...</option>
                                <?php foreach ($estados as $est): ?>
                                    <option value="<?= esc($est['id_estado']) ?>"><?= esc($est['nombre_estado']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small">Código Postal *</label>
                            <input type="text" id="dir_cp" name="codigo_postal" class="form-control bg-black text-white border-secondary" placeholder="5 dígitos" maxlength="5" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white small">Referencias / Entre qué calles</label>
                            <textarea id="dir_referencia" name="referencia" class="form-control bg-black text-white border-secondary" rows="2" placeholder="Casa color blanco, portón negro, entre calle X y calle Y..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardarDir" class="btn btn-primary px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Dirección
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('js/cliente.js') ?>"></script>
