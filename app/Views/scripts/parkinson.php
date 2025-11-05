<script>

window.onload = function() {
    function initialize() {

        var latlng = new google.maps.LatLng(19.493306112320568, -99.14481874867558);
        var mapOptions = {
            zoom: 6,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        }
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        setMarkers(map, marcadores);
    }

    var marcadores = [
        ['IMPo Instituto Mexicano de Psicooncología - Plantel Montevideo', 19.493306112320568, -99.14481874867558, '<strong>IMPo Instituto Mexicano de Psicooncología<br>Plantel Montevideo</strong><br><br>Avenida Montevideo No. 625,<br>Colonia San Bartolo Atepehuacan,<br>Alcaldía Gustavo A. Madero,<br>C.P. 07730, Ciudad de México.<br><br><i class="ri-phone-line"></i> <a href="tel:+5563931100">(55) 6393 - 1100</a><br></a>']
    ];

    var infowindow;

    function setMarkers(map, marcadores) {

        for (var i = 0; i < marcadores.length; i++) {
            var myLatLng = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
            var marker = new google.maps.marker.AdvancedMarkerElement({
                position: myLatLng,
                map: map,
                title: marcadores[i][0],
            });
            (function(i, marker) {
                
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

    initialize();

}
</script>