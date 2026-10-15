<!-- cart page area start here -->
<main>
    <!-- Login area start here -->
    <section class="login-area pt-130 pb-130">
        <div class="container">
            <div class="login__item">
                <div class="row g-4">
                    <div class="col-xxl-8">
                        <div class="login__image">
                            <img src="assets/images/login/login-image1.jpg" alt="image">
                            <div class="btn-wrp">
                                <a class="active" href="/login">Iniciar Sesión</a>
                                <a href="/register">Registrarse</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="login__content">
                            <h2 class="text-white mb-65">Bienvenido</h2>

                            <div class="form-area login__form">
                                <div id="error_login"></div>
                                <form>
                                    <input type="text" id="uname" name="user" placeholder="Usuario" autocomplete="username" required>
                                    <input class="mt-30" type="password" id="pwd" name="pass" placeholder="Contraseña" autocomplete="current-password" required>
                                    <button type="button" class="mt-30" onclick="loginCliente()">Iniciar Sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login area end here -->
</main>