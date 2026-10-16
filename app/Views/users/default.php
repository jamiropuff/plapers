<!-- Login Area Start -->
<main>
    <section class="plap-auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-11">
                    <div class="plap-auth-card">
                        <div class="row g-0">
                            <!-- Columna Visual / Banner -->
                            <div class="col-lg-5 d-none d-lg-block">
                                <div class="plap-auth-banner" style="background-image: url('<?= base_url('assets/images/home-plapers/slider-plapers/plapers-slide-A.jpg') ?>');">
                                    <div>
                                        <img src="<?= base_url('assets/images/logo-plapers/logo-plapers.svg') ?>" alt="Logo Plapers" style="height: 40px;" class="mb-4">
                                        <h3 class="text-white fw-bold mb-3">Placas personalizadas a tu estilo</h3>
                                        <p class="text-white-50 small mb-4">Inicia sesión para gestionar tus pedidos, consultar el estado de fabricación y acceder a tus direcciones guardadas.</p>
                                    </div>

                                    <div class="pt-4 border-top border-secondary border-opacity-50">
                                        <div class="plap-auth-feature-pill">
                                            <div class="plap-auth-feature-icon">
                                                <i class="fa-solid fa-shield-halved"></i>
                                            </div>
                                            <span>Materiales y acabados de calidad automotriz</span>
                                        </div>
                                        <div class="plap-auth-feature-pill">
                                            <div class="plap-auth-feature-icon">
                                                <i class="fa-solid fa-truck-fast"></i>
                                            </div>
                                            <span>Envíos seguros a toda la República</span>
                                        </div>
                                        <div class="plap-auth-feature-pill mb-0">
                                            <div class="plap-auth-feature-icon">
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <span>Diseños 100% personalizados</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Formulario -->
                            <div class="col-lg-7 p-4 p-md-5">
                                <!-- Switcher Horizontal -->
                                <div class="plap-auth-switcher">
                                    <a href="<?= base_url('login') ?>" class="plap-auth-tab active">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i> Iniciar Sesión
                                    </a>
                                    <a href="<?= base_url('registro') ?>" class="plap-auth-tab">
                                        <i class="fa-solid fa-user-plus me-2"></i> Registrarse
                                    </a>
                                </div>

                                <div class="mb-4">
                                    <h2 class="text-white fw-bold mb-2">Bienvenido de nuevo</h2>
                                    <p class="text-white-50 small mb-0">Ingresa tus credenciales para acceder a tu cuenta.</p>
                                </div>

                                <div id="error_login"></div>

                                <form onsubmit="event.preventDefault(); loginCliente();">
                                    <div class="mb-3">
                                        <label for="uname" class="text-white small fw-medium mb-2 d-block">Usuario o Correo Electrónico</label>
                                        <div class="plap-auth-input-group mb-0">
                                            <i class="fa-solid fa-user input-icon"></i>
                                            <input type="text" id="uname" name="user" class="form-control" placeholder="Ej. carlos_gomez" autocomplete="username" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label for="pwd" class="text-white small fw-medium mb-0">Contraseña</label>
                                        </div>
                                        <div class="plap-auth-input-group mb-0">
                                            <i class="fa-solid fa-lock input-icon"></i>
                                            <input type="password" id="pwd" name="pass" class="form-control" placeholder="••••••••" autocomplete="current-password" required>
                                        </div>
                                    </div>

                                    <button type="button" class="plap-auth-btn-primary" onclick="loginCliente()">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i> Iniciar Sesión
                                    </button>

                                    <div class="text-center mt-4 pt-2 border-top border-secondary border-opacity-25">
                                        <p class="text-white-50 small mb-0">
                                            ¿Aún no tienes una cuenta?
                                            <a href="<?= base_url('registro') ?>" class="text-danger fw-bold ms-1 text-decoration-none">
                                                Crea tu cuenta aquí
                                            </a>
                                        </p>
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