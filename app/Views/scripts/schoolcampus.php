<script>
    // Modal Titulación
    const modalMapa = (id,title) => {

        // Cargamos el título
        $("#title-mapa").html('');
        $("#title-mapa").html(title);

        // Cargamos el mapa
        $(".modal-body").html('');
        let mapa = '';

        // Plantel Montevideo 
        if(id == 1){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.1223985094935!2d-99.14780628907687!3d19.493369138661112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9400e0132a9%3A0xb1094f28f93c82f3!2sIMPo%20Instituto%20Mexicano%20de%20Psicooncolog%C3%ADa%20Plantel%204!5e0!3m2!1ses-419!2smx!4v1718297768163!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;
            
            var lat = 19.493306112320568;
            var lng = -99.14481874867558;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Montevideo', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Montevideo</strong><br><br>Avenida Montevideo No. 625,<br>Colonia San Bartolo Atepehuacan,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07730, Ciudad de México.<br><br><i class="ri-phone-line"></i> <a href="tel:+5563931100">(55) 6393 - 1100</a><br></a>']
            ];


            initialize(marcadores,lat,lng);

        }

        // Plantel Montevideo 
        if(id == 2){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.1263093138045!2d-99.14700218907684!3d19.493200838666613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9b2bf7606db%3A0x58020480a0cd294c!2sAv.%20Montevideo%20613%2C%20San%20Bartolo%20Atepehuacan%2C%20Gustavo%20A.%20Madero%2C%2007730%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1718298427928!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = 19.493197760594576;
            var lng = -99.14442178533699;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Montevideo', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Montevideo</strong><br><br>Avenida Montevideo No. 613,<br>Colonia San Bartolo Atepehuacan,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07730, Ciudad de México.<br><br><i class="ri-phone-line"></i> <a href="tel:+5563931100">(55) 6393 - 1100</a>']
            ];


            initialize(marcadores,lat,lng);
        }

        // Plantel Montevideo 
        if(id == 3){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.1252180717265!2d-99.14901920321037!3d19.493247799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9b2bffbffe1%3A0xc9a2a4683f337e10!2sInstituto%20Mexicano%20de%20Estudios%20Superiores%20y%20de%20Posgrado!5e0!3m2!1ses-419!2smx!4v1718298340084!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = 19.493134446703866;
            var lng = -99.14429205723064;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Montevideo', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Montevideo</strong><br><br>Avenida Montevideo No. 611,<br>Colonia San Bartolo Atepehuacan,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07730, Ciudad de México,<br>(Servicios Escolares IMPo planta baja).<br><br><i class="ri-phone-line"></i> <a href="tel:+5563931100">(55) 6393 - 1100</a>']
            ];


            initialize(marcadores,lat,lng);
        }

        // Plantel Montevideo 
        if(id == 4){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.1443117633175!2d-99.1454435536145!3d19.49242609200244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9b204f0d15f%3A0x2f2f3cc6335efd73!2sAv.%20Montevideo%20517%2C%20San%20Bartolo%20Atepehuacan%2C%20Gustavo%20A.%20Madero%2C%2007730%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1718298494869!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = 19.492405829122678;
            var lng = -99.14058336442028;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Montevideo', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Montevideo</strong><br><br>Avenida Montevideo No. 517,<br>Colonia San Bartolo Atepehuacan,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07730, Ciudad de México,<br>(Servicios Escolares IMESP 2do. piso)<br><br><i class="ri-phone-line"></i> <a href="tel:+5563931100">(55) 6393 - 1100</a>']
            ];


            initialize(marcadores,lat,lng);
        }

        // Plantel Tlalpan 
        if(id == 5){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.1046801800035!2d-99.14531348907951!3d19.364619542772598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe4a57a5fcc9%3A0x5139e267033671f6!2sIMPo%20Instituto%20Mexicano%20de%20Psicooncolog%C3%ADa%20Plantel%20Tlalpan!5e0!3m2!1ses-419!2smx!4v1718298646522!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = 19.364599817180416;
            var lng = -99.1427383644208;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Tlalpan', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Tlalpan</strong><br><br>Calzada de Tlalpan 1471,<br>Colonia Portales Nte,<br>Alcaldía Benito Juárez,<br>C.P. 03300, Ciudad de México.<br><br><i class="ri-phone-line"></i> <a href="tel:+5563932000">(55) 6393 - 2000</a>']
            ];


            initialize(marcadores,lat,lng);
        }

        // Plantel Tláhuac 
        if(id == 6){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.5957187894082!2d-99.05057298908078!3d19.299939544828618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce0257036eb8ed%3A0x3e19f9ee74c2b2de!2sIMPo%20Instituto%20Mexicano%20de%20Psicooncolog%C3%ADa%20Plantel%20Tl%C3%A1huac!5e0!3m2!1ses-419!2smx!4v1718298734080!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = 19.299909685265863;
            var lng = -99.04798763557982;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Tláhuac', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Tláhuac</strong><br><br>Avenida Tláhuac No. 5991,<br>Colonia Santa Ana Poniente del Pueblo de Santiago Zapotitlán,<br>Alcaldía Tláhuac,<br>C.P. 13220, Ciudad de México.<br><br><i class="ri-phone-line"></i> <a href="tel:+5568192000">(55) 6819 - 2000</a>']
            ];


            initialize(marcadores,lat,lng);
        }

        // Plantel Quito, Ecuador
        if(id == 7){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.7032413665013!2d-78.4840350554228!3d-0.20431940268397686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a0cffbbd47f%3A0x150df394bd9f063c!2sEdificio%20Boreal!5e0!3m2!1ses-419!2smx!4v1718298871367!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = -0.20372034109602866;
            var lng = -78.4837796588956;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Quito, Ecuador', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Quito, Ecuador</strong><br><br>Av. 12 de octubre N24-739 y Colón;<br>Edif. Boreal,<br>8vo. Piso, oficina 805.<br><br><i class="ri-phone-line"></i> <a href="tel:+59325140380">(+593 2) 5140380</a>']
            ];


            initialize(marcadores,lat,lng);
        }

        // Plantel Montevideo 
        if(id == 8){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.1223985094935!2d-99.14780628907687!3d19.493369138661112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9400e0132a9%3A0xb1094f28f93c82f3!2sIMPo%20Instituto%20Mexicano%20de%20Psicooncolog%C3%ADa%20Plantel%204!5e0!3m2!1ses-419!2smx!4v1718297768163!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;
            
            var lat = 19.49336573601233;
            var lng = -99.14521485843879;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Montevideo', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Montevideo</strong><br><br>Avenida Montevideo No. 635,<br>Colonia San Bartolo Atepehuacan,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07730, Ciudad de México.<br><br><i class="ri-phone-line"></i> <a href="tel:+5563931100">(55) 6393 - 1100</a><br></a>']
            ];


            initialize(marcadores,lat,lng);

        }

        // Plantel Talismán
        if(id == 9){
            //mapa = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.5957187894082!2d-99.05057298908078!3d19.299939544828618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce0257036eb8ed%3A0x3e19f9ee74c2b2de!2sIMPo%20Instituto%20Mexicano%20de%20Psicooncolog%C3%ADa%20Plantel%20Tl%C3%A1huac!5e0!3m2!1ses-419!2smx!4v1718298734080!5m2!1ses-419!2smx" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;

            var lat = 19.47774634121066;
            var lng = -99.11772979307234;

            var marcadores = [
                ['IMPo Instituto Mexicano de Psicooncología - Plantel Talismán', lat, lng, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Talismán</strong><br><br>Avenida Talismán No. 50,<br>Colonia Estrella,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07810, Ciudad de México.<br><br></a>']
            ];


            initialize(marcadores,lat,lng);
        }

        
        //$(".modal-body").html(mapa);

        // Abrimos el modal
        $("#modal-mapa").modal('show');

    }


    //window.onload = function() {
        function initialize(marcadores,lat,lng) {

            var latlng = new google.maps.LatLng(lat, lng);
            var mapOptions = {
                zoom: 19,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: true,
            }
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            setMarkers(map, marcadores);
        }

        var infowindow;

        function setMarkers(map, marcadores) {

            for (var i = 0; i < marcadores.length; i++) {
                var myLatLng = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: marcadores[i][0],
                });
                (function(i, marker) {

                    // Abrimos la card de la información
                    infowindow = new google.maps.InfoWindow();
                    infowindow.setContent(marcadores[i][3]);
                    infowindow.open(map, marker);                    
                    
                    // Cerramos o abrimos la card de información al darle click
                    google.maps.event.addListener(marker, 'click', function() {
                        if (!infowindow) {
                            infowindow = new google.maps.InfoWindow();
                        }
                        infowindow.setContent(marcadores[i][3]);
                        infowindow.open(map, marker);
                    });
                })(i, marker);

            }
        };
    //}
</script>