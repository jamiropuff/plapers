<?php
$url_grade = '';
if($grade == 'Licenciaturas'){
    $url_grade = 'licenciaturas';
}
if($grade == 'Maestrías'){
    $url_grade = 'maestrias';
}
if($grade == 'Doctorados'){
    $url_grade = 'doctorados';
}
if($grade == 'Bachillerato'){
    $url_grade = 'bachillerato';
}
?>

<div class="container mt-2">
    <div class="page-banner-content">
        <h1 class="c-black fs-1"><?= $title ?></h1>
        <ul>
            <li class="c-gray fs-08"><a href="/" class="c-gray url-link">Inicio</a></li>
            <li class="c-gray fs-08"><a href="/oferta-educativa" class="c-gray url-link">Oferta Educativa</a></li>
            <li class="c-gray fs-08"><a href="/<?= $url_grade; ?>" class="c-gray url-link"><?= $grade ?></a></li>
            <li class="fs-08"><?= $title ?></li>
        </ul>
    </div>
</div>

<!-- mobile -->
<div class="info-oferta-movil mt-5 mb-5 d-sm-block d-md-block d-lg-none d-xl-none d-xxl-none">
    <div class="info-dialog" role="document">
        <div class="info-oferta-content">
            <div class="info-oferta-body">

                <div class="row">
                    <div class="col-12">

                        <form>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="nombre_infomovil" class="form-control h-40 mb-3" placeholder="Nombre(s)" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="apellidos_infomovil" class="form-control h-40 mb-3" placeholder="Apellidos" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="correo_infomovil" class="form-control h-40 mb-3" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="tel_infomovil" class="form-control h-40 mb-3" placeholder="Teléfono móvil">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="plantel_infomovil">Plantel</label>
                                        <select id="plantel_infomovil" class="form-control h-40 mb-3">
                                            <option value="" selected>Seleccionar</option>
                                            <option value="Montevideo">Montevideo</option>
                                            <option value="Tlalpan">Tlalpan</option>
                                            <option value="Tláhuac">Tláhuac</option>
                                            <option value="Sede Ecuador zoom">Sede Ecuador zoom</option>
                                            <option value="zoom">zoom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="interes_infomovil">Interés</label>
                                        <select id="interes_infomovil" class="form-control h-40 mb-3">
                                            <option value="" selected>Seleccionar</option>

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
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="medio_infomovil">¿Por qué medio te enteraste de nosotros?</label>
                                        <select id="medio_infomovil" class="form-control h-40 mb-3">
                                            <option value="" selected>Seleccionar</option>
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
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <textarea id="mensaje_infomovil" class="form-control" rows="5" placeholder="Mensaje"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input
                                            name="gridCheckInicio"
                                            value="Acepto los términos y la política de privacidad."
                                            class="form-check-input"
                                            type="checkbox"
                                            id="gridCheckInicio"
                                            required
                                            checked
                                        >
                                        <label class="form-check-label text-justify" for="gridCheckInicio">
                                        Al hacer click en <span class="c-blue text-bold">"Enviar"</span>, reconoces haber leído las Políticas de nuestro <a href="aviso-de-privacidad">Aviso de Privacidad</a> y autorizas estar de acuerdo con el uso de ellas, así como con los <a href="terminos-y-condiciones">Términos y Condiciones</a> del sitio.
                                        </label>
                                        <div class="help-block with-errors gridCheck-error"></div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="default-btn btn" onclick="solicitarInformacion('movil')">Enviar<i class="flaticon-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Start News Details Area-->
<div class="news-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="news-details">
                    <div class="news-simple-card"  data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1300" data-aos-once="true">
                        <h2 id="titulo"></h2>
                        <iframe id="video" width="100%" height="400" src="" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen controls></iframe>

                        <p id="descripcion" class="text-justify"></p>
                    </div>

                    <div id="planteles" class="theory" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1300" data-aos-once="true">
                        <!--
                        <div class="theory-box">
                            <h4>Plantel Montevideo (Presencial)</h4>
                            <p class="pl-20">&bull; Sábado 1 de junio de 7:00 a 12:00 horas. (un día a la semana)</p>
                        </div>
                        <div class="theory-box">
                            <h4>Plantel Tlalpan (Presencial)</h4>
                            <p class="pl-20">&bull; Próxima apertura mayo 2024</p>
                        </div>
                        <div class="theory-box">
                            <h4>Plantel Tláhuac (Presencial)</h4>
                            <p class="pl-20">&bull; Sábado 1 de junio de 13:00 a 18:30 horas. (un día a la semana).</p>
                        </div>
                        <div class="theory-box">
                            <h4>En línea - vía zoom</h4>
                            <p class="pl-20">&bull; Próxima apertura mayo 2024</p>
                            <p class="pl-20">&bull; Con profesores en tiempo real impartiendo tus asignaturas</p>
                        </div>
                        <div class="theory-box">
                            <h4>Sede Ecuador - Vía Zoom</h4>
                            <p class="pl-20">&bull; Próxima apertura mayo 2024</p>
                            <p class="pl-20">&bull; Para mayor información en Ecuador, comunícate al:</p>
                            <p class="pl-20">&bull; Teléfono: 02514 - 0380</p>
                            <p class="pl-20">&bull; <i class="fab fa-whatsapp"></i> 098 - 928 - 5616</p>
                        </div>
                        -->
                    </div>

                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left" data-aos-easing="ease-in-sine" data-aos-duration="1300" data-aos-once="true">
                <div class="related-post-area">
                    <div class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/Duracion.png" alt="Image">
                            <h3 class="c-blue">Duración</h3>
                            <p id="duracion"></p>
                        </div>
                    </div>
                    <div class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/Inversion.png" alt="Image">
                            <h3>Inversión</h3>
                            <div id="inversion"></div>
                        </div>
                    </div>
                    <div class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/Inicio de clases cuatrimestral.png" alt="Image">
                            <h3>Inicio de clases</h3>
                            <p id="inicio_clases"></p>
                        </div>
                    </div>

                    <div class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/Requisitos de Inscripcion.png" alt="Image">
                            <h3>Requisitos de inscripción</h3>
                            <div id="inscripcion"></div>
                        </div>
                    </div>
                    <div class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/Plan de estudios.png" alt="Image">
                            <h3>Plan de Estudios</h3>
                            <div id="plan_estudios"></div>
                        </div>
                    </div>
                    <div id="div_rvoe" class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/RVOE.png" alt="Image">
                            <div id="rvoe"></div>
                        </div>
                    </div>
                    <div id="div_titulacion" class="related-post-box">
                        <div class="related-post-content">
                            <img src="assets/images/icons/Opciones de titulacion.png" alt="Image">
                            <h3>Titulación</h3>
                            <div id="opciones_titulacion"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        

        <div class="row">
            <div class="col-12">
                <div class="health-care-area pt-70 pb-30">
                    
                    <hr id="linea_instalaciones" style="border: 2px #111d5e solid; opacity: 1;">
                    
                    <div class="container">    
                        <h2 id="titulo_instalaciones">Instalaciones</h2>
                        <div id="instalaciones" class="row justify-content-center">
                            <div class="col-5">
                                <div class="fs-1_1 text-center texto-instalaciones">Durante tu curso podrás consolidar tus conocimientos y habilidades en un entorno práctico y especializado, utilizando la cámara de Gesell.</div>
                            </div>
                            <div class="col-5">
                                <img src="<?= base_url() ?>/assets/images/campus/Camara-de-Gesell-1.png" class="img-instalaciones">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="row">
            <div class="col-12">
                <div class="health-care-area pt-70 pb-30">
                    
                    <hr id="linea_eventos" style="border: 2px #111d5e solid; opacity: 1;">
                    
                    <div class="container">    
                        <h2 id="titulo_eventos">Eventos</h2>
                        <div id="eventos" class="row justify-content-left"></div>
                    </div>
                </div>
            </div>
        </div>
        
        

        <div class="row">
            <div class="col-12">
                <!--Start Health Care Area-->
                <div class="health-care-area pt-100 pb-70">

                    <hr id="linea_promociones" style="border: 2px #111d5e solid; opacity: 1;">

                    <div class="container">
                        <h2 id="titulo_promociones">Promociones México</h2>
                        <div id="promociones" class="row justify-content-left"></div>
                    </div>
                </div>
                <!--End Health Care Area-->
            </div>
        </div>
    </div>
</div>
<!--End News Details Area-->


<div id="modal-titulacion" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opciones de Titulación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modalClose('modal-titulacion')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-titulacion" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modalClose('modal-titulacion')">Cerrar</button>
            </div>
        </div>
    </div>
</div>
