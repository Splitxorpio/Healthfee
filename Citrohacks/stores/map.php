<?php
include "../pages/db.php";

// $data = $_COOKIE["data"];
// str_split($data);
// $decode=json_decode($data, true);
// echo $decode;
// $obj = json_decode($data);
// echo $obj;
// echo count($json, $mode = COUNT_NORMAL);
// for($i = 0; $)
// foreach($json as $hospital){
//     $id = $hospital['id'];
//     $hospital_name = $hospital['hospital_name'];
//     $location = $hospital['location'];

//     $sql = "INSERT INTO hospitals (id, hospital_name, location) VALUES ('$id','$hospital_name','$location')";
//     mysqli_query($conn, $sql);
// }


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Healthfee - Map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="../pages/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #map-canvas {
            height: 600px;
            margin: 0px;
            padding: 0px;
            width: 1300px;
            /* position: relative; */
            border-radius: 25px;
            border: 2px solid #E66677;
        }

        body {
            height: 1800px;
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
            /* width: 100vw;
            height: 100vh; */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 0;
        }

        .hospitals {
            width: 90%;
            margin: 20px 0;

        }

        .hospital {
            padding: 4% 3%;
            margin: 10px;
            background-color: #fff;
            border-radius: 10px;
            font-size: 25px;
        }

        a {
            text-decoration: none;
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
        <h1 style="font-weight:300;">Find the closest Hospitals near you!</h1>
        <br>
        <a class="signup" href="../pages/closest.php">Go Back</a>
        <br>
        <hr style="width: 500px;">
        <br>
        <div id="map-canvas"></div>
        <br>
        <br>
        <hr style="width: 1000px;">
        <div class="hospitals">

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var map;
        var infowindow;
        const labels = "H";
        let labelIndex = 0;

        function initMap() {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;


                var locationvar = new google.maps.LatLng(latitude, longitude);
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: locationvar,
                    zoom: 13
                });
                var request = {
                    location: locationvar,
                    radius: 20000,
                    types: ['hospital', 'health', 'Kaiser Permanente']
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
                
                var arr = [];
                for (var i = 0; i < results.length; i++) {
                    arr.push({
                        id: Math.floor(Math.random() * 100),
                        business_status: results[i].business_status,
                        name: results[i].name,
                        vicinity: results[i].vicinity,
                        rating: results[i].rating
                    });
                }
                

                var filtered = arr.filter((c, index) => {
                    return arr.indexOf(c) === index;
                });

                filtered.map(res => {
                    let div = document.querySelector('.hospitals');
                   
                    var rating = '<div></div>';
                    if(res.rating <= 1){
                          rating = '<div><i class="fas fa-star"></i></div>';
                    } else if(res.rating <= 2){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i></div>';
                    } else if(res.rating <= 3){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>';
                    } else if(res.rating <= 4){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>';
                    } else if(res.rating <= 5){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>';
                    } else if(res.rating <= 6){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>><i class="fas fa-star"></i></div>';
                    }
                    else if(res.rating <= 7){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>><i class="fas fa-star"></i>><i class="fas fa-star"></i></div>';
                    }else if(res.rating <= 8){
                        rating = '<div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>><i class="fas fa-star"></i>><i class="fas fa-star"></i></div>';
                    }
                    let html = `<br><a href="/Citrohacks/pages/review.php?id=${res.id}"><div class="hospital">${res.name} <br> ${rating} </div>
                     </a>`;
                    div.innerHTML += html;
                });
                // console.log(filtered);
                axios.post('uploadHospital.php' , filtered)
                    .then(data => {
                        console.log(data);
                    })
                
                // let json_string = JSON.stringify(arr);
                // document.cookie = `data=${JSON.stringify(json_string)}`;
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