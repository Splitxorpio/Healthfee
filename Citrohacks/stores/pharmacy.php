<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Healthfee - Map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="../pages/style.css">
    <style>
        #map-canvas {
            height: 600px;
            margin: 0px;
            padding: 0px;
            width: 1300px;
            position: relative;
            border-radius: 25px;
            border: 2px solid #E66677;
        }

        #map-canvas-two {
            height: 600px;
            margin: 0px;
            padding: 0px;
            width: 1300px;
            position: relative;
            border-radius: 25px;
            border: 2px solid #E66677;
        }

        .containerbox {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <ul>
        <div>
            <a href="../pages/index.php">
                <img style="height: 75px; width: 75px;" src="../images/logo.png">
            </a>
        </div>
        <div class="nav_link">
            <li><a class="login" href="../pages/login.php">Log Out</a></li>
            <li><a class="login" href="../pages/index.php">Home</a></li>
        </div>
    </ul>
    <div class="containerbox">
        <h1 style="font-weight:300;">Find the closest Pharmacies near you!</h1>
        <br>
        <a class="signup" href="../pages/closest.php">Go Back</a>
        <br>
        <hr style="width: 500px;">
        <br>
        <div id="map-canvas"></div>
        <br>
    </div>
    <script>
        var map;
        var infowindow;
        const labels = "P";
        let labelIndex = 0;

        function initMap() {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;


                var locationvar = new google.maps.LatLng(latitude, longitude);
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: locationvar,
                    zoom: 14
                });
                var request = {
                    location: locationvar,
                    radius: 20000,
                    types: ['pharmacy', 'apothecary', 'drugstore', 'pharmaceutical']
                };
                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, callback);
                var markerloc = new google.maps.Marker({
                    map: map,
                    position: locationvar,
                    icon: 'https://i.stack.imgur.com/PtfzI.png',
                });
                google.maps.event.addListener(markerloc, 'click', function() {
                    infowindow.setContent("Your Location");
                    infowindow.open(map, this);
                });
            });


        }

        function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place) {
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                label: labels[labelIndex++ % labels.length],
                map: map,
                position: place.geometry.location,
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
        setTimeout(() => {
            google.maps.event.addDomListener(window, 'load', initMap);
        }, 1000);
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmoqxgE_EIvcCTyyW82CfqUy-GJUicJSE&callback=initMap&libraries=places"></script>
</body>

</html>