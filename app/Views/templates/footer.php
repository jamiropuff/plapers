</main>

<?php
// $menu_bachillerato = [];
// $menu_licenciatura = [];
// $menu_maestria = [];
// $menu_doctorado = [];

// foreach ($menu_oferta as $menus){

//   //echo "grado_academico: ".$menus->id_grado_academico."<br>";

//   // Bachillerato
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 1 ){

//     $menu_bachillerato[] = array(
//       'grado_academico'=>'bachillerato', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if

//   // Licenciaturas
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 2 ){

//     $menu_licenciatura[] = array(
//       'grado_academico'=>'licenciaturas', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if

//   // Maestrías
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 3 ){

//     $menu_maestria[] = array(
//       'grado_academico'=>'maestrias', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if

//   // Doctorados
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 4 ){

//     $menu_doctorado[] = array(
//       'grado_academico'=>'doctorados', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if


// } // end foreach
?>

<!-- Footer area start here -->
<footer class="footer-area bg-image" data-background="<?= base_url() ?>/assets/images/footer-plapers/footer-bg-plapers.jpg">
    <div class="container">
        <div class="footer__wrp pt-65 pb-65 bor-top bor-bottom">
            <div class="row g-4">
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".1s">
                    <div class="footer__item">
                        <!-- <h4 class="footer-title">Customer Service</h4> -->
                        <ul>
                            <li><a href="#"><span></span>Placas Americanas</a></li>
                            <li><a href="#"><span></span>Placas Europeas</a></li>
                            <li><a href="#"><span></span>Placas Euromini</a></li>
                            <li><a href="#"><span></span>Placas Bicicleta</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                    <div class="footer__item">
                        <!-- <h4 class="footer-title">Get to Know Us</h4> -->
                        <ul>
                            <li><a href="#"><span></span>Nosotros</a></li>
                            <li><a href="#"><span></span>Galer&iacute;a</a></li>
                            <li><a href="#" data-toggle="modal" data-target=".bs-modal-aviso"><span></span>Aviso de Privacidad</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".3s">
                    <div class="footer__item">
                        <!-- <h4 class="footer-title">vapes new collections</h4> -->
                        <ul>
                            <li><a href="#"><span></span>FAQS</a></li>
                            <li><a href="#"><span></span>Contacto</a></li>
                            <li><a href="#" data-toggle="modal" data-target=".bs-modal-politica-venta"><span></span>Pil&iacute;ticas de Venta</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
                    <div class="footer__item newsletter">
                        <h4 class="footer-title">Bolet&iacute;n</h4>
                        <div class="subscribe">
                            <input type="email" placeholder="Tu Email">
                            <button><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="social-icon mt-40">
                            <a href="#0"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#0"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#0"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copy-text pt-35 pb-35">
            <a href="index.php" class="logo d-block">
                <img src="<?= base_url() ?>/assets/images/logo-plapers/logo-plapers.svg" alt="logo Plapers footer">
            </a>
            <p>&copy; Copyright 2026 Todos los derechos Reservados</p>
            <a href="#0" class="payment d-block image">
                <img src="<?= base_url() ?>/assets/images/icon/payment.png" alt="icon">
            </a>
        </div>
    </div>
</footer>
<!-- Footer area end here -->

<!-- Modal AVISO DE PRIVAIDAD -->
<div class="modal fade bs-modal-aviso bootstrap-modal" tabindex="-1" role="dialog" aria-labelledby="aviso-privacidad" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="aviso-privacidad">AVISO DE PRIVACIDAD</h4>
                </div>
                <div class="modal-body">
                    <p><strong>M&Oacute;NICA ÁLVAREZ ANAYA</strong>, con domicilio en la CALLE 12 N&Uacute;MERO 27, COLONIA SAN PEDRO DE LOS PINOS, ALCALD&Iacute;A BENITO JU&Aacute;REZ, C.P. 03800, CIUDAD DE M&Eacute;XICO, M&Eacute;XICO emite a favor del público en general el siguiente.</p>
                    <p>Dicho aviso es emitido de conformidad con lo establecido por la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, su Reglamento y demás disposiciones de la materia aplicables.</p>
                    <p>Los datos tutelados por la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y
                        que son recabados por la empresa M&Oacute;NICA &Aacute;LVAREZ ANAYA, a quienes en lo sucesivo de le denominar&aacute; PLAPERS,
                        serán utilizados con la mayor responsabilidad por parte del mismo y protegidos bajo las políticas de
                        privacidad de la empresa, sus colaboradores y trabajadores con el objeto de prestar adecuadamente los
                        servicios para los cuales somos contratados, a su vez, también son utilizados en virtud de la relación
                        laboral que existe con nuestros trabajadores, de acuerdo a la solicitud de información ya sea presencial o
                        por correo electrónico y finalmente los datos que la compañía atiende derivan de obligaciones adquiridas ya
                        sean contractuales y/o comerciales.</p>
                    <p>Así mismo, se enumeran de forma enunciativa más no de forma limitativa los fines para los cuales recabamos sus datos:</p>
                    <ul class="text">
                        <li>
                            Proveer los servicios y productos requeridos por nuestros contratantes.
                        </li>
                        <li>
                            Informar sobre cambios, nuevos productos o servicios que estén relacionados con contrato adquirido o
                            relaciones comerciales.
                        </li>
                        <li>
                            Dar cumplimiento a las obligaciones contraídas con nuestros clientes y proveedores.
                        </li>
                        <li>
                            Informar sobre los cambios en la prestación de su servicio.
                        </li>
                        <li>
                            Información corporativa.
                        </li>
                        <li>
                            Realizar gestiones de cobro, pagos o compensaciones.
                        </li>
                        <li>
                            Tener una relación patrón / trabajador.
                        </li>
                        <li>
                            Dar aviso a familiares de cualquier eventualidad o urgencia médica que pueda existir.
                        </li>
                        <li>
                            Conocer anteriores empleos de posibles trabajadores.
                        </li>
                        <li>
                            Evaluar la calidad del servicio.
                        </li>
                        <li>
                            Para Administrar nuestros sitios y servicios
                        </li>
                        <li>
                            Para realizar estudios de mercado y de consumo a efecto de adquirir y ofrecer productos y servicios personalizados, así como publicidad y contenidos adecuados a sus necesidades.
                        </li>
                        <li>
                            Con fines de comunicación, promoción, difusión (vía electrónica, correo electrónico, SMS, etc.) de productos y servicios.
                        </li>
                    </ul>
                    <p>Se hace del conocimiento que PLAPERS, única y exclusivamente podrá compartir información en los siguientes supuestos:</p>
                    <p class="text-justify">Por regla general no compartimos información sin el consentimiento explícito del titular y no la difundimos, distribuimos, ni comercializamos.</p>
                    <p class="text-justify">Para complementar un procedimiento solicitado por el titular.</p>
                    <p class="text-justify">Con terceros, proveedores de productos y/o servicios, para atender las necesidades del titular con la calidad y oportunidad ofrecida.</p>
                    <p class="text-justify">Para atender requerimientos de las autoridades o para proteger y defender los derechos de la empresa PLAPERS.</p>
                    <p class="text-justify">Esto siempre de acuerdo a lo estrictamente señalado en el Capítulo V artículos 36 y 37 de la Ley Federal de Protección de Datos Personales en Posesión de Particulares.</p>
                    <p class="text-justify"><strong>PLAPERS</strong>, transfiere únicamente Datos Personales y Datos Patrimoniales con personas físicas o morales que colaboren en la prestación de los servicios para los cuales somos contratados. Los Datos Personales Sensibles que nos sean transferidos son manejados de forma responsable y especialmente de forma confidencial.</p>
                    <p class="text-justify">En <strong>PLAPERS</strong>, protegemos y salvaguardamos sus datos personales para evitar daño, pérdida, destrucción, robo, extravió, alteración, así como el tratamiento no autorizado de sus Datos Personales. Los datos son protegidos de forma administrativa, técnica y física para evitar pérdidas, usos incorrectos o accesos no autorizados, publicación, modificación o destrucción de los datos personales que nos haya proporcionado.
                    </p>
                    <p class="text-justify">Para acceder, rectificar y cancelar sus datos personales, así como para oponerse al tratamiento de los mismos o revocar el consentimiento que para tal fin nos hayan otorgado, se pone a disposición nuestro Encargado de tratar los datos previstos en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, mediante las siguientes vías:</p>
                    <ul class="text mb-2">
                        <li>Correo Electrónico: ventas@plapers.com.mx</li>
                        <li>Teléfono: (55) 5686-1612</li>
                        <li>Dirección: Calle 12 No. 27, Col. San Pedro de los Pinos, Alcaldía Benito Juárez, C.P. 03800, Ciudad de M&eacute;xico, M&eacute;xico</li>
                    </ul>
                    <p class="text-justify"> Atentamente:</p>
                    <p class="text-justify">MÓNICA ÁLVAREZ ANAYA</p>
                    <p class="text-justify">M&eacute;xico, Ciudad de M&eacute;xico a 01 de Marzo de 2026. (Fecha de última actualización de este Aviso de Privacidad)</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- END MODAL AVISO DE PRIVACIDAD -->


<!-- Modal POLITICA DE VENTA -->
<div class="modal fade bs-modal-politica-venta bootstrap-modal" tabindex="-1" role="dialog" aria-labelledby="politica-venta" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="politica-venta">POL&Iacute;TICAS DE VENTA</h4>
                </div>
                <div class="modal-body">
                    <ul class="pol-ven">
                        <li>Las placas y modelos exhibidos en nuestra página WEB catálogo son “decorativas y personalizables”, por lo que el cliente es totalmente responsable del uso de este producto.</li>
                        <li>El cliente es responsable de:<br>
                            a. Elegir correctamente el modelo que solicita.<br>
                            b. Revisar que los textos y numeración solicitados sean los correctos.<br>
                            c. Que no tengan faltas de ortografía o que el texto deseado sea tal como lo quiera el cliente.<br>
                            d. Que su pedido no contenga, lo siguiente, ya que no serán atendidos:<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;i. Palabras obscenas<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;ii. Groserías<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;iii. Consignas políticas<br>
                            Se notificará oportunamente al cliente por medio de un correo electrónico o vía telefónica cuando esto proceda.<br>
                            <strong class="text-black text-justify">IMPORTANTE: Si un pedido contiene faltas de ortografía o se ha omitido una letra o número en el texto, así la fabricaremos, por eso es importante que revise bien los datos antes de generar su pedido con nosotros y estar totalmente seguro al hacer su compra.</strong>
                        </li>
                        <li class="text-justify">Cuando se desee colocar en las placas logotipos o nombres de marcas registradas, el cliente deberá contar con el permiso expreso y por escrito del dueño de las mismas para poder hacer uso de ellas. Si no es así, no será atendido el pedido.</li>
                        <li class="text-justify">Las placas americanas y de motocicleta no pueden contener el número de matrícula oficial, algo similar o semejante a cualquier número de matrícula oficial; ya que estos productos son solamente decorativos. La placa europea puede contener números de matrículas oficiales pero no sustituye a la placa oficial que este en vigencia.<br>
                            En caso que su pedido no proceda por los puntos anteriormente mencionados, se le notificará y será necesario que lo modifique el cliente, para su fabricación.</li>
                        <li class="text-justify">Una vez realizado el pedido el cliente cuenta con 30 días naturales para pagar su compra, de lo contrario su pedido se dará de baja automáticamente pasados los 30 días.</li>
                        <li class="text-justify">El cliente podrá cancelar su pedido haciéndole de nuestra parte la devolución correspondiente del depósito con un cargo del 20%</li>
                        <li class="text-justify">No hay modificaciones o cambios a un pedido una vez que éste se encuentre en proceso de fabricación.</li>
                        <li class="text-justify">Si el cliente cuenta con su propio diseño, ya sea para publicidad o evento especial, comuníquese directamente con nuestro equipo de ventas de mayoreo al correo ventas@plapers.com.mx.</li>
                        <li class="text-justify">Si el cliente cuenta con saldo pendiente por pagar, NO se ingresará el pedido hasta que no haya liquidado por completo su saldo.</li>
                        <li class="text-justify">El tiempo de producción del pedido empieza a correr a partir de confirmarse su depósito y diseño digital.</li>
                        <li class="text-justify">El tiempo de entrega es de 8 días hábiles, una vez confirmado el depósito y este tiempo de entrega solo aplica con modelos que tenemos en línea. Para modelos que los clientes mandan, el tiempo de entrega varía dependiendo la carga de trabajo y la dificultad del trabajo.</li>
                        <li class="text-justify">NO hay entregas urgentes.</li>
                        <li class="text-justify">Las entregas a domicilio tienen un costo extra y este varía a la cantidad de productos que se envían. En una guía de envío, solo se puede enviar hasta 10 de nuestros productos, sí son más de 10 productos se cobrarán dos guías, si son más de 20 productos, se cobran 3 guías y así sucesivamente.</li>
                        <li class="text-justify">Una vez enviado el pedido, es responsabilidad plena de la paquetería entregar el pedido a nuestro cliente. Nuestros clientes pueden rastrear personalmente su paquete en: http://www.fedex.com/mx/</li>
                        <li class="text-justify">NO nos hacemos responsables en caso de que se experimente un retraso por parte de la paquetería. Sin embargo, respaldamos su compra y nuestro personal de ventas le asistirá en caso de que se presente algún inconveniente en la entrega de su pedido.</li>
                        <li class="text-justify">En caso de que se presente algún retraso en la entrega o envío de su pedido, es responsabilidad de nuestro cliente ponerse en contacto con nuestro departamento de ventas. Estamos a su servicio en el teléfono (55) 5686-1612, así mismo, puede contactarnos a través de nuestro correo electrónico ventas@plapers.com.mx donde rápidamente le atenderemos.</li>
                        <li class="text-justify">La entrega de nuestros productos está reservado únicamente dentro de la República Mexicana. Ningún paquete puede ser enviado a una dirección que se encuentre fuera de los Estados Unidos Mexicanos ni a oficinas postales.</li>
                        <li class="text-justify">Horarios de atención: de lunes a viernes de 9:00 a 18:00 horas.</li>
                        <li class="text-justify">Para comunicarse directamente vía e-mail con un ejecutivo de ventas, nuestro correo electrónico es: ventas@plapers.com.mx.</li>
                        <li class="text-justify">Nos reservamos el derecho de vender nuestros productos a aquellos clientes que no cumplan con lo establecido en estas políticas de venta.</li>
                    </ul>
                    <p class="text-justify"><strong class="text-black text-justify">Al momento de ingresar a nuestra página y hacer un pedido el cliente acepta y entiende todo lo expresado en estas políticas de venta.</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- END MODAL POLITICA-VENTA -->

<!-- Back to top area start here -->
<div class="scroll-up">
    <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- Back to top area end here -->

<!-- Jquery 3. 7. 1 Min Js -->
<script src="<?= base_url() ?>/assets/js/jquery-3.7.1.min.js"></script>
<!-- Bootstrap min Js -->
<script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
<!-- Swiper bundle min Js -->
<script src="<?= base_url() ?>/assets/js/swiper-bundle.min.js"></script>
<!-- Counterup min Js -->
<script src="<?= base_url() ?>/assets/js/jquery.counterup.min.js"></script>
<!-- Wow min Js -->
<script src="<?= base_url() ?>/assets/js/wow.min.js"></script>
<!-- Magnific popup min Js -->
<script src="<?= base_url() ?>/assets/js/magnific-popup.min.js"></script>
<!-- Nice select min Js -->
<script src="<?= base_url() ?>/assets/js/nice-select.min.js"></script>
<!-- Pace min Js -->
<script src="<?= base_url() ?>/assets/js/pace.min.js"></script>
<!-- Isotope pkgd min Js -->
<script src="<?= base_url() ?>/assets/js/isotope.pkgd.min.js"></script>
<!-- Waypoints Js -->
<script src="<?= base_url() ?>/assets/js/jquery.waypoints.js"></script>
<!-- Script Js -->
<script src="<?= base_url() ?>/assets/js/script.js"></script>

<script src="<?= base_url() ?>/assets/dist/effect-cards-stack.js"></script>
<script src="<?= base_url() ?>/assets/js/home.js"></script>

<script>
    $(window).on("scroll", function () {

    if ($(window).width() >= 992) {

        if ($(this).scrollTop() > 100) {
            $(".top__header").addClass("fixed");
        } else {
            $(".top__header").removeClass("fixed");
        }

    }

});

$(window).on("scroll resize", function(){

    if($(window).width() >= 992){
        $("body").css("padding-top", $(".top__header").outerHeight());
    }else{
        $("body").css("padding-top", "0");
    }

});
</script>