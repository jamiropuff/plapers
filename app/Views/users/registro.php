<!-- Registro Area Start -->
<main>
    <section class="plap-auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-12">
                    <div class="plap-auth-card">
                        <div class="row g-0">
                            <!-- Columna Visual / Banner -->
                            <div class="col-lg-4 d-none d-lg-block">
                                <div class="plap-auth-banner" style="background-image: url('<?= base_url('assets/images/home-plapers/slider-plapers/plapers-slide-B.jpg') ?>');">
                                    <div>
                                        <img src="<?= base_url('assets/images/logo-plapers/logo-plapers.svg') ?>" alt="Logo Plapers" style="height: 40px;" class="mb-4">
                                        <h3 class="text-white fw-bold mb-3">Únete a la comunidad Plapers</h3>
                                        <p class="text-white-50 small mb-4">Crea tu cuenta gratuita para guardar tus diseños de placas personalizados, agilizar tus compras y rastrear tus entregas.</p>
                                    </div>

                                    <div class="pt-4 border-top border-secondary border-opacity-50">
                                        <div class="plap-auth-feature-pill">
                                            <div class="plap-auth-feature-icon">
                                                <i class="fa-solid fa-palette"></i>
                                            </div>
                                            <span>Guarda y personaliza tus diseños</span>
                                        </div>
                                        <div class="plap-auth-feature-pill">
                                            <div class="plap-auth-feature-icon">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <span>Guarda múltiples direcciones de envío</span>
                                        </div>
                                        <div class="plap-auth-feature-pill mb-0">
                                            <div class="plap-auth-feature-icon">
                                                <i class="fa-solid fa-file-invoice"></i>
                                            </div>
                                            <span>Facturación electrónica CFDI 4.0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Formulario -->
                            <div class="col-lg-8 p-4 p-md-5">
                                <!-- Switcher Horizontal -->
                                <div class="plap-auth-switcher">
                                    <a href="<?= base_url('login') ?>" class="plap-auth-tab">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i> Iniciar Sesión
                                    </a>
                                    <a href="<?= base_url('registro') ?>" class="plap-auth-tab active">
                                        <i class="fa-solid fa-user-plus me-2"></i> Registrarse
                                    </a>
                                </div>

                                <div class="mb-4">
                                    <h2 class="text-white fw-bold mb-2">Crear Cuenta de Cliente</h2>
                                    <p class="text-white-50 small mb-0">Llena tus datos para comenzar tu experiencia en Plapers.</p>
                                </div>

                                <div id="error_registro"></div>

                                <form id="formRegistro" onsubmit="registrarCliente(event)">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="text-white small fw-medium mb-1 d-block">Nombre(s) *</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-user input-icon"></i>
                                                <input type="text" id="reg_nombres" name="nombres" class="form-control" placeholder="Ej. Carlos" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-white small fw-medium mb-1 d-block">Apellido Paterno *</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-user-tag input-icon"></i>
                                                <input type="text" id="reg_paterno" name="paterno" class="form-control" placeholder="Ej. Gómez" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-white small fw-medium mb-1 d-block">Apellido Materno</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-user-tag input-icon"></i>
                                                <input type="text" id="reg_materno" name="materno" class="form-control" placeholder="Ej. López">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-white small fw-medium mb-1 d-block">Nombre de Usuario *</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-at input-icon"></i>
                                                <input type="text" id="reg_username" name="username" class="form-control" placeholder="Ej. carlos_gomez" autocomplete="username" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-white small fw-medium mb-1 d-block">Correo Electrónico *</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-envelope input-icon"></i>
                                                <input type="email" id="reg_correo" name="correo_electronico" class="form-control" placeholder="correo@ejemplo.com" autocomplete="email" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-white small fw-medium mb-1 d-block">Contraseña *</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-lock input-icon"></i>
                                                <input type="password" id="reg_password" name="password" class="form-control" placeholder="Mínimo 6 caracteres" autocomplete="new-password" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-white small fw-medium mb-1 d-block">Confirmar Contraseña *</label>
                                            <div class="plap-auth-input-group mb-0">
                                                <i class="fa-solid fa-shield-halved input-icon"></i>
                                                <input type="password" id="reg_password_confirm" name="password_confirm" class="form-control" placeholder="Repite tu contraseña" autocomplete="new-password" required>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input bg-dark border-secondary" type="checkbox" id="reg_terminos" name="acepta_terminos" value="1" required>
                                                <label class="form-check-label text-white-50 small ms-1" for="reg_terminos">
                                                    He leído y acepto el <a href="<?= base_url('aviso-de-privacidad') ?>" target="_blank" class="text-danger text-decoration-underline">Aviso de Privacidad</a> y los Términos de Compra.
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" id="btnRegistro" class="plap-auth-btn-primary">
                                                <span id="btnRegistroText"><i class="fa-solid fa-user-plus me-2"></i> Crear Cuenta</span>
                                                <span id="btnRegistroSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                                            </button>
                                        </div>

                                        <div class="col-12 text-center mt-3 pt-2 border-top border-secondary border-opacity-25">
                                            <p class="text-white-50 small mb-0">
                                                ¿Ya tienes una cuenta registrada?
                                                <a href="<?= base_url('login') ?>" class="text-danger fw-bold ms-1 text-decoration-none">
                                                    Inicia Sesión aquí
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?= base_url('js/registro.js') ?>"></script>
