<!-- Domicilio Fiscal - Area de Cliente -->
<main class="py-5" style="background-color: #0d0d0d; min-height: 80vh;">
    <div class="container">
        <!-- Breadcrumb / Titulo -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-white fw-bold">Domicilio Fiscal</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('mi-cuenta') ?>" class="text-white-50">Mi Cuenta</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Domicilio Fiscal</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-4">
            <!-- Columna Navegación -->
            <div class="col-lg-4 col-xl-3">
                <?= view('cliente/nav_cliente', ['seccion_activa' => 'domicilio_fiscal']) ?>
            </div>

            <!-- Columna Contenido Principal -->
            <div class="col-lg-8 col-xl-9">
                <div class="card bg-dark text-white border-secondary shadow-sm">
                    <div class="card-header bg-transparent border-secondary py-3">
                        <h5 class="card-title text-white mb-0">
                            <i class="fa-solid fa-file-invoice-dollar text-primary me-2"></i> Datos de Facturación (CFDI 4.0)
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="alerta_fiscal"></div>

                        <form id="formDomicilioFiscal" onsubmit="guardarDomicilioFiscal(event)" enctype="multipart/form-data">
                            <input type="hidden" id="fisc_id" name="id_facturacion" value="<?= esc($facturacion->id_facturacion ?? '') ?>">

                            <!-- Tipo de Persona -->
                            <div class="mb-4 p-3 bg-black rounded border border-secondary">
                                <label class="form-label text-white fw-bold mb-2">Régimen / Tipo de Persona *</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_persona" id="tipo_fisica" value="1" <?= (!isset($facturacion->tipo_persona) || $facturacion->tipo_persona == 1) ? 'checked' : '' ?> onchange="alternarTipoPersona()">
                                        <label class="form-check-label text-white" for="tipo_fisica">
                                            Persona Física
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_persona" id="tipo_moral" value="2" <?= (isset($facturacion->tipo_persona) && $facturacion->tipo_persona == 2) ? 'checked' : '' ?> onchange="alternarTipoPersona()">
                                        <label class="form-check-label text-white" for="tipo_moral">
                                            Persona Moral (Empresa)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <!-- Campos Persona Moral -->
                                <div class="col-md-12" id="grupo_razon_social" style="<?= (isset($facturacion->tipo_persona) && $facturacion->tipo_persona == 2) ? '' : 'display: none;' ?>">
                                    <label class="form-label text-white small">Razón Social * (Sin régimen societario, ej. S.A. de C.V.)</label>
                                    <input type="text" id="fisc_razon_social" name="razon_social" class="form-control bg-black text-white border-secondary" placeholder="Nombre oficial de la empresa" value="<?= esc($facturacion->razon_social ?? '') ?>">
                                </div>

                                <!-- Campos Persona Física -->
                                <div class="col-md-4 grupo_persona_fisica" style="<?= (isset($facturacion->tipo_persona) && $facturacion->tipo_persona == 2) ? 'display: none;' : '' ?>">
                                    <label class="form-label text-white small">Nombre(s) *</label>
                                    <input type="text" id="fisc_nombres" name="nombres" class="form-control bg-black text-white border-secondary" placeholder="Nombres" value="<?= esc($facturacion->nombres ?? '') ?>">
                                </div>
                                <div class="col-md-4 grupo_persona_fisica" style="<?= (isset($facturacion->tipo_persona) && $facturacion->tipo_persona == 2) ? 'display: none;' : '' ?>">
                                    <label class="form-label text-white small">Apellido Paterno *</label>
                                    <input type="text" id="fisc_paterno" name="paterno" class="form-control bg-black text-white border-secondary" placeholder="Paterno" value="<?= esc($facturacion->paterno ?? '') ?>">
                                </div>
                                <div class="col-md-4 grupo_persona_fisica" style="<?= (isset($facturacion->tipo_persona) && $facturacion->tipo_persona == 2) ? 'display: none;' : '' ?>">
                                    <label class="form-label text-white small">Apellido Materno</label>
                                    <input type="text" id="fisc_materno" name="materno" class="form-control bg-black text-white border-secondary" placeholder="Materno" value="<?= esc($facturacion->materno ?? '') ?>">
                                </div>

                                <!-- Identificación Fiscal -->
                                <div class="col-md-6">
                                    <label class="form-label text-white small">RFC *</label>
                                    <input type="text" id="fisc_rfc" name="rfc" class="form-control bg-black text-white border-secondary text-uppercase" placeholder="XAXX010101000" maxlength="13" value="<?= esc($facturacion->rfc ?? '') ?>" required>
                                    <small class="text-white-50">12 caracteres para Moral, 13 para Física.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">CURP (Opcional)</label>
                                    <input type="text" id="fisc_curp" name="curp" class="form-control bg-black text-white border-secondary text-uppercase" placeholder="18 caracteres" maxlength="18" value="<?= esc($facturacion->curp ?? '') ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label text-white small">Uso de CFDI *</label>
                                    <select id="fisc_uso" name="uso" class="form-select bg-black text-white border-secondary select2 no-nice-select" required style="width: 100%;">
                                        <option value="">Selecciona el uso de CFDI...</option>
                                        <?php foreach ($usos_cfdi as $uso): ?>
                                            <option value="<?= esc($uso['id_uso']) ?>" <?= (isset($facturacion->uso) && $facturacion->uso == $uso['id_uso']) ? 'selected' : '' ?>>
                                                <?= esc($uso['nombre_uso']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Domicilio Fiscal -->
                                <div class="col-12 mt-4">
                                    <h6 class="text-primary border-bottom border-secondary pb-2 mb-3">
                                        <i class="fa-solid fa-map-pin me-1"></i> Domicilio Fiscal Registrado ante el SAT
                                    </h6>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label text-white small">Calle *</label>
                                    <input type="text" id="fisc_calle" name="calle" class="form-control bg-black text-white border-secondary" placeholder="Calle" value="<?= esc($facturacion->calle ?? '') ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label text-white small">Núm. Ext *</label>
                                    <input type="text" id="fisc_numero" name="numero" class="form-control bg-black text-white border-secondary" placeholder="Ext" value="<?= esc($facturacion->numero ?? '') ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label text-white small">Núm. Int</label>
                                    <input type="text" id="fisc_interior" name="interior" class="form-control bg-black text-white border-secondary" placeholder="Int" value="<?= esc($facturacion->interior ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">Colonia *</label>
                                    <input type="text" id="fisc_colonia" name="colonia" class="form-control bg-black text-white border-secondary" placeholder="Colonia" value="<?= esc($facturacion->colonia ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">Municipio / Alcaldía *</label>
                                    <input type="text" id="fisc_municipio" name="municipio" class="form-control bg-black text-white border-secondary" placeholder="Municipio" value="<?= esc($facturacion->municipio ?? '') ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">Estado *</label>
                                    <select id="fisc_estado" name="estado" class="form-select bg-black text-white border-secondary select2 no-nice-select" required style="width: 100%;">
                                        <option value="">Selecciona el estado...</option>
                                        <?php foreach ($estados as $est): ?>
                                            <option value="<?= esc($est['id_estado']) ?>" <?= (isset($facturacion->estado) && $facturacion->estado == $est['id_estado']) ? 'selected' : '' ?>>
                                                <?= esc($est['nombre_estado']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-white small">Código Postal Fiscal *</label>
                                    <input type="text" id="fisc_cp" name="codigo_postal" class="form-control bg-black text-white border-secondary" placeholder="5 dígitos" maxlength="5" value="<?= esc($facturacion->codigo_postal ?? '') ?>" required>
                                </div>

                                <!-- Constancia de Situación Fiscal -->
                                <div class="col-12 mt-4">
                                    <h6 class="text-primary border-bottom border-secondary pb-2 mb-3">
                                        <i class="fa-solid fa-file-pdf me-1"></i> Constancia de Situación Fiscal (Opcional)
                                    </h6>
                                    <div class="p-3 bg-black rounded border border-secondary">
                                        <label class="form-label text-white small">Adjuntar CSF actualizada en formato PDF (máx. 5MB)</label>
                                        <input type="file" id="fisc_archivo" name="documento_situacion_fiscal" class="form-control bg-dark text-white border-secondary" accept="application/pdf">
                                        <?php if (!empty($facturacion->documento_situacion_fiscal)): ?>
                                            <div class="mt-2 text-success small">
                                                <i class="fa-solid fa-circle-check me-1"></i> Constancia cargada previamente:
                                                <a href="<?= base_url('uploads/constancias/' . esc($facturacion->documento_situacion_fiscal)) ?>" target="_blank" class="text-info text-decoration-underline ms-1">
                                                    Ver archivo
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-12 text-end mt-4">
                                    <button type="submit" id="btnGuardarFiscal" class="btn btn-primary px-4 py-2">
                                        <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Datos Fiscales
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
