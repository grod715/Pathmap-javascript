
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
    <label for="origen">Origen</label>
    <input type="text" name="origen" id="start" value="10.946685, -63.869982" placeholder="Posicion" />
    <br />
    <label for="destino">Destino</label>
    <input type="text" name="destino" id="end" value="10.955503,-63.854412" placeholder="Posicion" />
    <br />
    <input type="button" id="buscar" value="Buscar ruta"  />
    </div>
    <div id="map"></div>
    <script>

      // FUNCION QUE SE EJECUTA LUEGO DE CARGAR EL MAP DESDE LA API
      function initMap() {

        // VARIABLE PARA DARLE ESTILO A LA RUTA
        var stylePaths = new google.maps.Polyline({
          strokeColor:'#000', // color de linea
          strokeOpacity: 0.5, // transparencia
          strokeWeight: 3 // ancho de linea
        });


        // VARIABLES PARA CREAR LAS RUTAS
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions: stylePaths});


        // UBICACION ACTUAL
        currentLocation = new google.maps.LatLng(10.946685, -63.869982);

        // INICIALIZAMOS EL MAP 
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: currentLocation
        });


        // VINCULAMOS EL MAPA CON LA RUTA A GENERAR
        directionsDisplay.setMap(map);


        // AL PRESIONAR EL BOTON BUSCAR DISPARA LA FUNCION PARA OBTENER LA RUTA
        document.getElementById('buscar').addEventListener('click', function() {

          calculateAndDisplayRoute(directionsService, directionsDisplay);

        });


        // FUNCION DONDE SE OBTIENE Y MUESTRA LA RUTA
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {

          /* sutituir por los puntos recibidos del servidor
            var origin = new google.maps.LatLng(10.946685, -63.869982);
            var destination = new google.maps.LatLng(10.955503,-63.854412);
          */
          
          // VARIABLE QUE CONSTRUYE LA PETICION
          var request = {
                origin: document.getElementById('start').value,
                destination: document.getElementById('end').value,
                travelMode: google.maps.TravelMode.DRIVING,
                region:'ve'
          };

          // PETICION
          directionsService.route(request, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });
        }
      }

    </script>
    <!-- API KEY de Google:  Key=AIzaSyD6XxLLy_lTHU9MaXURrke-iOXz32H_htE -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6XxLLy_lTHU9MaXURrke-iOXz32H_htE&signed_in=true&callback=initMap" async defer> </script>
  </body>
</html>