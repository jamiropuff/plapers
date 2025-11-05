<div class="container mt-2">
    <div class="page-banner-content">
        <h1 class="c-black fs-1"><?= $title ?></h1>
        <ul>
            <li class="c-gray fs-08"><a href="/" class="c-gray url-link">Inicio</a></li>
            <li class="fs-08"><?= $title ?></li>
        </ul>
    </div>
</div>

<!--Start Contact Us Area-->
<div class="contact-us-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1300" data-aos-once="true">
                <div class="contacts-form">
                    <h3>Contáctanos</h3>
                    <p>Haznos saber tus dudas y/o comentarios llenando el siguiente formulario.</p>
                    <form id="contactForm">

                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="nombre_contacto">Nombre(s)</label>
                                    <input type="text" name="nombre_contacto" id="nombre_contacto" class="form-control" required data-error="Por favor, escribe tu nombre">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="apellidos_contacto">Apellidos</label>
                                    <input type="text" name="apellidos_contacto" id="apellidos_contacto" class="form-control" required data-error="Por favor, escribe tus apellidos">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="email_contacto">Email</label>
                                    <input type="email" name="email_contacto" id="email_contacto" class="form-control" required data-error="Por favor, escribe tu email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
            
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="tel_contacto">Teléfono</label>
                                    <input type="text" name="tel_contacto" id="tel_contacto" class="form-control" required data-error="Por favor, escribe tu teléfono">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="asunto_contacto">Asunto</label>
                                    <input type="text" name="asunto_contacto" id="asunto_contacto" class="form-control" required data-error="Por favor, escribe tu asunto">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mensaje_contacto">Mensaje</label>
                                    <textarea name="mensaje_contacto" class="form-control" id="mensaje_contacto" cols="30" rows="8" required data-error="Por favor, escribe tu mensaje"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input
                                        name="gridCheckContacto"
                                        value="Acepto los términos y la política de privacidad."
                                        class="form-check-input"
                                        type="checkbox"
                                        id="gridCheckContacto"
                                        required
                                        checked
                                    >
                                    <label class="form-check-label text-justify" for="gridCheckContacto">
                                    Al hacer click en <span class="c-blue text-bold">"Enviar"</span>, reconoces haber leído las Políticas de nuestro <a href="aviso-de-privacidad">Aviso de Privacidad</a> y autorizas estar de acuerdo con el uso de ellas, así como con los <a href="terminos-y-condiciones">Términos y Condiciones</a> del sitio</a>
                                    </label>
                                    <div class="help-block with-errors gridCheck-error"></div>
                                </div>
                            </div>
            
                            <div class="col-lg-12 col-md-12">
                                <button type="button" class="default-btn" onclick="enviarContacto()">
                                    <span>Enviar mensaje</span>
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-easing="ease-in-sine" data-aos-duration="1300" data-aos-once="true">
                
                <iframe src="https://www.google.com/maps/d/embed?mid=1HQPCY-cvsygI_cLGW_o1Km0-3ax_x1o&hl=es&ehbc=2E312F" width="100%" height="100%"></iframe>
                
            </div>
        </div>
    </div>
</div>
<!--End Contact Us Area-->