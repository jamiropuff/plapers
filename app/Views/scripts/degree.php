<script>
    $(document).ready(function() {
        //console.log('ready');

        <?php if( isset($menu) && !empty($menu) ) : ?>
            oferta_educativa('<?=$menu?>');
        <?php endif ?>

    });

    // Oferta Educativa
    const oferta_educativa = menu => {

        //console.log('<?= BASE; ?>');

        //url = '/js/degree.json';
        url = '<?= BASE; ?>/list_degree';

        $.getJSON( url, function( json ) {        

            //console.log(json);

            let [pre,ruta] = menu.split("-");
            // console.log({pre});
            // console.log({ruta});

            let grado = '';

            if(pre == 'licenciatura'){
                grado = 'licenciaturas';
            }
            if(pre == 'maestria'){
                grado = 'maestrias';
            }
            if(pre == 'doctorado'){
                grado = 'doctorados';
            }

            if(pre == 'tecnico'){
                grado = 'bachillerato';
            }

            // console.log({grado});

            const datos = json[grado][menu];
            // console.log({datos});

            const contenidoModal = `
            <div id="modal-informacion" class="info-oferta">
                <div class="info-dialog" role="document">
                    <div class="info-oferta-content">
                        <div class="info-oferta-body">

                            <div class="row">
                                <div class="col-12">

                                    <form>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="nombre_info" class="form-control h-40 mb-3" placeholder="Nombre(s)" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="apellidos_info" class="form-control h-40 mb-3" placeholder="Apellidos" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="email" id="correo_info" class="form-control h-40 mb-3" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="tel_info" class="form-control h-40 mb-3" placeholder="Teléfono móvil">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="plantel_info">Plantel</label>
                                                    <select id="plantel_info" class="form-control h-40 mb-3">
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
                                                    <label for="interes_info">Interés</label>
                                                    <select id="interes_info" class="form-control h-40 mb-3">
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
                                                    <label for="medio_info">¿Por qué medio te enteraste de nosotros?</label>
                                                    <select id="medio_info" class="form-control h-40 mb-3">
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
                                                    <textarea id="mensaje_info" class="form-control" rows="5" placeholder="Mensaje"></textarea>
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
                                                <button type="button" class="default-btn btn" onclick="solicitarInformacion()">Enviar<i class="flaticon-paper-plane"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            `;


            // Page Banner
            //console.log('banner: '+datos.banner);
            //console.log('banner_mobile: '+datos.banner_mobile);
            //$("#banner").attr('style',`background-image: url('assets/images/page-banner/${datos.banner}'); background-position: ${datos.banner_posicion};`);
            $("#banner").html(`<img src="assets/images/page-banner/${datos.banner}" class="img-fluid image-banner"><div id="form_info_oferta">${contenidoModal}</div>`);
            $("#banner_mobile").html(`<img src="assets/images/page-banner/${datos.banner_mobile}" class="img-fluid image-banner">`);

            // Título, video, descripción
            $("#titulo").html(datos.titulo);
            
            // Video
            $("#video").hide();

            if(datos.video_activo){
                if(datos.video_activo == 1){
                    $("#video").show();
                    
                    if(datos.video != ''){
                        $("#video").show();
                        $("#video").attr('src', datos.video);
                        $("#video").attr('title', datos.titulo);
                    }
                }
            }    

            // Descripción
            $("#descripcion").html(datos.descripcion);

            // Planteles
            let planteles = '';
            sede_escuador = 0;
            for(i = 0; i < datos.planteles.length; i++){

                // Sede Ecuador
                if(datos.planteles[i].nombre.indexOf("Ecuador") >= 0){
                    sede_escuador = 1;

                    planteles += `
                    <div class="theory-box">
                        <h4 class="c-orange">${datos.planteles[i].nombre}</h4>
                    `;

                    for(j = 0; j < datos.planteles[i].info.length; j++){
                        planteles += `
                        <p class="pl-20 c-orange">${datos.planteles[i].info[j]}</p>
                    `;
                    }
                    planteles += `
                    </div>
                    `;
                }else{
                    if(sede_escuador == 1){
                        planteles += `
                        <div class="theory-box">
                            <h4 class="c-orange">${datos.planteles[i].nombre}</h4>
                        `;

                        for(j = 0; j < datos.planteles[i].info.length; j++){
                            planteles += `
                            <p class="pl-20 c-orange">${datos.planteles[i].info[j]}</p>
                        `;
                        }
                        planteles += `
                        </div>
                        `;
                    }else{
                        planteles += `
                        <div class="theory-box">
                            <h4>${datos.planteles[i].nombre}</h4>
                        `;

                        for(j = 0; j < datos.planteles[i].info.length; j++){
                            planteles += `
                            <p class="pl-20">${datos.planteles[i].info[j]}</p>
                        `;
                        }
                        planteles += `
                        </div>
                        `;
                    } // else
                } // else

            } // for

            $("#planteles").html(planteles);

            // Duración e Inicio de Clases
            $("#duracion").html(datos.duracion);
            $("#inicio_clases").html(datos.inicio_clases);

            // Inversión
            let inversion = '';
            for(k = 0; k < datos.inversion.length; k++){
                inversion += `
                <p class="mb-1">${datos.inversion[k]}</p>
                `;
            }

            $("#inversion").html(inversion);

            // Inscripción
            let inscripcion = '';
            for(l = 0; l < datos.inscripcion.length; l++){
                inscripcion += `
                <p class="mb-1"><a href="pdf/${datos.inscripcion[l].url}" target="_blank">${datos.inscripcion[l].descripcion}</a></p>
                `;
            }

            $("#inscripcion").html(inscripcion);

            // Plan de estudios
            let plan_estudios = `<p><a href="pdf/${datos.url_plan_estudios}" target="_blank">Ver Plan de Estudios</a></p>`;
            $("#plan_estudios").html(plan_estudios);

            // Opciones de titulación
            $("#div_titulacion").hide();
            if(datos.url_opciones_titulacion != '' && datos.url_opciones_titulacion != null){
                $("#div_titulacion").show();
                let opciones_titulacion = `<p><a onclick="modalTitulacion('${datos.url_opciones_titulacion}')" class="cur-pointer">Ver Opciones de Titulación</a></p>`;
                $("#opciones_titulacion").html(opciones_titulacion);
            }

            // RVOE
            $("#div_rvoe").hide();
            if(datos.url_rvoe != '' && datos.url_rvoe != null){
                $("#div_rvoe").show();
                let rvoe = `<h3><a href="pdf/${datos.url_rvoe}" target="_blank">RVOE</a></h3>`;
                $("#rvoe").html(rvoe);
            }

            // Promociones
            let promociones = '';
            let delay_time = 200;
            var total_promociones = datos.promociones.length; 

            if(total_promociones > 0){

                $("#linea_promociones").show();
                $("#titulo_promociones").show();

                for(m = 0; m < datos.promociones.length; m++){
                    promociones += `
                    <div class="col-lg-6 col-md-6 mb-5">
                        <div class="single-health-care-card mb-5">
                            <div class="img">
                                <img src="assets/images/promo/${datos.promociones[m]}" alt="Image" class="img-fluid" style="width: 85%">
                            </div>
                        </div>
                    </div>
                    `;
                    delay_time += 200;
                }

            }else{
                $("#linea_promociones").hide();
                $("#titulo_promociones").hide();
            }

            $("#promociones").html(promociones);


            // Eventos
            //console.log(datos.eventos);
            var total_eventos = datos.eventos.length; 

            if(total_eventos > 0){

                $("#linea_eventos").show();
                $("#titulo_eventos").show();

                let eventos = '';
                for(l = 0; l < total_eventos; l++){
                    eventos += `
                    <div class="col-12 col-lg-4 col-md-4">
                        <div class="single-health-care-card">
                            <div class="img">
                                <img src="assets/images/events_degree/${datos.eventos[l].imagen}" alt="Image" class="img-fluid" style="width: 85%">
                            </div>
                        </div>
                    </div>
                    `;
                }

            }else{
                $("#linea_eventos").hide();
                $("#titulo_eventos").hide();
            }

            $("#eventos").html(eventos);

        });

    }

    // Modal Titulación
    const modalTitulacion = (image) => {

        // Cargamos la imagen
        $("#body-titulacion").html('');
        let imagen_titulacion = `<img src="assets/images/titulacion/${image}" class="img-fluid" alt="Titulación" />`;
        $("#body-titulacion").html(imagen_titulacion);

        // Abrimos el modal
        $("#modal-titulacion").modal('show');

    }

    // Modal Información Oferta Educativa
    const modalInformacionOferta = (op) => {
        //console.log('modalInformacionOferta');

        const contenidoModal = `
            <div id="modal-informacion" class="info-oferta">
                <div class="info-dialog" role="document">
                    <div class="info-oferta-content">
                        <div class="info-oferta-body">

                            <div class="row">
                                <div class="col-12">

                                    <form>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="nombre_info" class="form-control" placeholder="Nombre(s)" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="apellidos_info" class="form-control" placeholder="Apellidos" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="email" id="correo_info" class="form-control" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="tel_info" class="form-control" placeholder="Teléfono móvil">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="plantel_info">Plantel</label>
                                                    <select id="plantel_info" class="form-control">
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
                                                    <label for="interes_info">Interés</label>
                                                    <select id="interes_info" class="form-control">
                                                        <option value="" selected>Seleccionar</option>
                                                        <option class="c-green-3" value="Bach. Tec. en Contabilidad">Bach. Tec. en Contabilidad</option>
                                                        <option class="c-green-3" value="Bach. Tec. en Trabajo Social">Bach. Tec. en Trabajo Social</option>
                                                        <option class="c-green-3" value="Bach. Tec. en Programación">Bach. Tec. en Programación</option>
                                                        <option class="c-green-3" value="Bach. Tec. en Administración de Recursos Humanos">Bach. Tec. en Administración de Recursos Humanos</option>
                                                        <option class="c-blue-3" value="Lic. en Psicopedagogía">Lic. en Psicopedagogía</option>
                                                        <option class="c-blue-3" value="Lic. en Informática Administrativa">Lic. en Informática Administrativa</option>
                                                        <option class="c-blue-3" value="Lic. en Administración y Finanzas">Lic. en Administración y Finanzas</option>
                                                        <option class="c-blue-3" value="Lic. en Gerontología">Lic. en Gerontología</option>
                                                        <option class="c-blue-3" value="Lic. en Psicología">Lic. en Psicología</option>
                                                        <option class="c-blue-3" value="Lic. en Trabajo Social">Lic. en Trabajo Social</option>
                                                        <option class="c-blue-3" value="Lic. en Derecho">Lic. en Derecho</option>
                                                        <option class="c-blue-3" value="Lic. en Ciencias de la Comunicación">Lic. en Ciencias de la Comunicación</option>
                                                        <option class="c-red" value="Maestría en Educación">Maestría en Educación</option>
                                                        <option class="c-red" value="Maestría en Evaluación Educativa">Maestría en Evaluación Educativa</option>
                                                        <option class="c-red" value="Maestría en Estudios del Suicidio">Maestría en Estudios del Suicidio</option>
                                                        <option class="c-red" value="Maestría en Comercio Exterior">Maestría en Comercio Exterior</option>
                                                        <option class="c-red" value="Maestría en Derecho Penal">Maestría en Derecho Penal</option>
                                                        <option class="c-red" value="Maestría en Derecho Familiar">Maestría en Derecho Familiar</option>
                                                        <option class="c-red" value="Maestría en Tanatología">Maestría en Tanatología</option>
                                                        <option class="c-red" value="Maestría en Psicoterapia Transpersonal">Maestría en Psicoterapia Transpersonal</option>
                                                        <option class="c-red" value="Maestría en Psicooncología">Maestría en Psicooncología</option>
                                                        <option class="c-black" value="Doctorado en Tanatología">Doctorado en Tanatología</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="medio_info">¿Por qué medio te enteraste de nosotros?</label>
                                                    <select id="medio_info" class="form-control">
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
                                                    <textarea id="mensaje_info" class="form-control" rows="5" placeholder="Mensaje"></textarea>
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
                                                <button type="button" class="default-btn btn" onclick="solicitarInformacion()">Enviar<i class="flaticon-paper-plane"></i></button>
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" onclick="modalInformacionOfertaClose()">Cerrar</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        `;

        // Agregamos el formulario al banner
        $("#form_info_oferta").html(contenidoModal);

        // Agregamos la clase active, ejecutamos el slide y quitamos la función del onclick
        if($("#form_info_oferta").hasClass("active") == false){
            $("#form_info_oferta").addClass('active');
            $("#form_info_oferta").toggle('slide');
            $("#banner").attr("onclick","");
        }
        
    }

    const modalInformacionOfertaClose = () => {
        //console.log('modalInformacionOfertaClose');

        // Quitamos la clase active y cerramos el formulario
        $("#form_info_oferta").removeClass('active');
        $("#form_info_oferta").toggle('slide');

        // Esperamos 1 segundo y colocamos la función al onclick
        setTimeout(() => {
            $("#banner").attr("onclick","modalInformacionOferta('active')");
        }, "1000");

    }

    const modalInformacionOfertaMovil = () => {
        console.log('modalInformacionOfertaMovil');

        // Se debe de crear el código en caso de que soliciten el formulario en los banners de la oferta educativa para movil

    }

</script>