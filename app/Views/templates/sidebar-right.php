<!-- Sidebar Modal -->
<div class="sidebarModal modal right fade" id="sidebarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" onclick="modalGetInfo('sidebarModal','close')"><i class="ri-close-line"></i></button>

            <div class="modal-body">
                <a href="/">
                    <img src="assets/images/logo_impo_web.png" class="main-logo" alt="logo">
                    <img src="assets/images/logo_impo_web.png" class="white-logo" alt="logo">
                </a>
                
                <div class="contact-form">
                    <h3>Solicitar información</h3>

                    <form id="contactForm">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="nombre_info_slide" class="form-control" required data-error="Ingresa el nombre" placeholder="Nombre(s)">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="apellidos_info_slide" class="form-control" required data-error="Ingresa los apeliidos" placeholder="Apellido(s)">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <input type="email" id="correo_info_slide" class="form-control" required data-error="Ingresa el correo" placeholder="Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" id="tel_info_slide" class="form-control" required data-error="Ingresa el teléfono" placeholder="Teléfono movil">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="plantel_info_slide">Plantel</label>
                                    <select id="plantel_info_slide" class="form-control">
                                        <option value="0">Seleccionar</option>
                                        <option value="Montevideo">Montevideo</option>
                                        <option value="Tlalpan">Tlalpan</option>
                                        <option value="Tláhuac">Tláhuac</option>
                                        <option value="Sede Ecuador zoom">Sede Ecuador zoom</option>
                                        <option value="zoom">zoom</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="interes_info_slide">Interés</label>
                                    <select id="interes_info_slide" class="form-control">
                                        <option value="0">Seleccionar</option>

                                        <option class="c-green-3" value="Bach. Tec. en Administración de Recursos Humanos">Bach. Tec. en Administración de Recursos Humanos</option>
                                        <option class="c-green-3" value="Bach. Tec. en Contabilidad">Bach. Tec. en Contabilidad</option>
                                        <option class="c-green-3" value="Bach. Tec. en Programación">Bach. Tec. en Programación</option>
                                        <option class="c-green-3" value="Bach. Tec. en Trabajo Social">Bach. Tec. en Trabajo Social</option>

                                        <option class="c-blue-3" value="Lic. en Administración y Finanzas">Lic. en Administración y Finanzas</option>
                                        <option class="c-blue-3" value="Lic. en Ciencias de la Comunicación">Lic. en Ciencias de la Comunicación</option>
                                        <option class="c-blue-3" value="Lic. en Derecho">Lic. en Derecho</option>
                                        <option class="c-blue-3" value="Lic. en Gerontología">Lic. en Gerontología</option>
                                        <option class="c-blue-3" value="Lic. en Informática Administrativa">Lic. en Informática Administrativa</option>
                                        <option class="c-blue-3" value="Lic. en Psicología">Lic. en Psicología</option>
                                        <option class="c-blue-3" value="Lic. en Psicopedagogía">Lic. en Psicopedagogía</option>
                                        <option class="c-blue-3" value="Lic. en Trabajo Social">Lic. en Trabajo Social</option>
                                        
                                        <option class="c-red" value="Maestría en Comercio Exterior">Maestría en Comercio Exterior</option>
                                        <option class="c-red" value="Maestría en Derecho Familiar">Maestría en Derecho Familiar</option>
                                        <option class="c-red" value="Maestría en Derecho Penal">Maestría en Derecho Penal</option>
                                        <option class="c-red" value="Maestría en Educación">Maestría en Educación</option>
                                        <option class="c-red" value="Maestría en Estudios del Suicidio">Maestría en Estudios del Suicidio</option>
                                        <option class="c-red" value="Maestría en Evaluación Educativa">Maestría en Evaluación Educativa</option>
                                        <option class="c-red" value="Maestría en Psicooncología">Maestría en Psicooncología</option>
                                        <option class="c-red" value="Maestría en Psicoterapia Transpersonal">Maestría en Psicoterapia Transpersonal</option>
                                        <option class="c-red" value="Maestría en Tanatología">Maestría en Tanatología</option>
                                        
                                        <option class="c-black" value="Doctorado en Tanatología">Doctorado en Tanatología</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="medio_info_slide">¿Por qué medio te enteraste de nosotros?</label>
                                    <select id="medio_info_slide" class="form-control">
                                        <option value="0">Seleccionar</option>
                                        <option value="Cartel">Cartel</option>
                                        <option value="Folleto">Folleto</option>
                                        <option value="Manta">Manta</option>
                                        <option value="Radio">Radio</option>
                                        <option value="Automóvil">Automóvil</option>
                                        <option value="Fachada">Fachada</option>
                                        <option value="Página de internet">Página de internet</option>
                                        <option value="Correo electrónico">Correo electrónico</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Youtube">Youtube</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea id="mensaje_info_slide" class="form-control" cols="30" rows="6" required data-error="Ingresa tu mensaje" placeholder="Mensaje"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input
                                        name="gridCheckSlide"
                                        value="Acepto los términos y la política de privacidad."
                                        class="form-check-input"
                                        type="checkbox"
                                        id="gridCheckSlide"
                                        required
                                        checked
                                    >
                                    <label class="form-check-label text-justify" for="gridCheckSlide">
                                    Al hacer click en <span class="c-blue text-bold">"Enviar"</span>, reconoces haber leído las Políticas de nuestro <a href="aviso-de-privacidad">Aviso de Privacidad</a> y autorizas estar de acuerdo con el uso de ellas, así como con los <a href="terminos-y-condiciones">Términos y Condiciones</a> del sitio.
                                    </label>
                                    <div class="help-block with-errors gridCheck-error"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="button" class="default-btn" onclick="solicitarInformacionSlide()">Enviar<span></span></button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="sidebar-contact-info">
                    <h3>Información de Contacto</h3>

                    <ul class="info-list">
                        <li><i class="ri-phone-fill"></i> <a href="tel:+525563931100">+52 55 6393 1100</a> - Plantel Montevideo</li>
                        
                        <li><i class="ri-phone-fill"></i> <a href="tel:+525563932000">+52 55 6393 2000</a> - Plantel Tlalpan</li>

                        <li><i class="ri-phone-fill"></i> <a href="tel:+525568192000">+52 55 6819 2000</a> - Plantel Tláhuac</li>
                    </ul>
                </div>
                <ul class="sidebar-social-list">
                    <li><a href="https://www.facebook.com/IMPoOficial/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com/impooficial/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCCmxYMZSLn7QGoyo1qFPl9A" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="https://radioimpo.com.mx/" target="_blank" title="Radio Impo"><i class="fas fa-microphone"></i></a></li>

                </ul>

            </div>
        </div>
    </div>
</div>
<!-- End Sidebar Modal -->