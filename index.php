
<?php include "templates/header.php";?>
<div class="formarea ml-3" >
        <ul>
            <li>
                <a href="create.php"><strong>Lisa</strong></a> - Lisa marker
            </li>
            <li>
                <a href="read.php"><strong>Leia</strong></a> - Leia marker
            </li>
            <li>
                <a href="update.php"><strong>Muuda</strong></a> - Muuda marker
            </li>
            <li>
                <a href="delete.php"><strong>Kustuta</strong></a> - Kustuta marker
            </li>
        </ul>
    <div class="row">
        <div class="col-2">
            <form method="post">
                <input name="name" class="form-control" placeholder="Nimetus"><br>
                <input id="lat" name="latitude" class="form-control" placeholder="Laiuskraad"><br>
                <input id="lng" name="longitude" class="form-control" placeholder="Pikkuskraad"><br>
                <textarea name="description" class="form-control" placeholder="Kirjeldus"></textarea><br>
                <input type="submit" name="submit" class="btn btn-primary" value="Lisa marker">
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    require "./config.php";
    require "./common.php";

    try{
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_marker =array(
            "name" => $_POST['name'],
            "latitude" => $_POST['latitude'],
            "longitude" => $_POST['longitude'],
            "description" => $_POST['description']
        );
        $sql = sprintf(
    "INSERT INTO %s (%s) values (%s)",
    "markers.markers",
    implode(", ", array_keys($new_marker)),
    ":" . implode(", :", array_keys($new_marker))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_marker);

        } catch(PDOException $error) {
        echo $sql ."<br>" . $error->getMessage();
    }
}
?>
<hr>

<div id="map"></div>
<script>
    var map;
    function initMap() {
        var start = {
            lat: 58.247537,
            lng: 22.479283
        };

        map = new google.maps.Map(document.getElementById('map'), {
            center: start,
            zoom: 15
        });

        map.addListener('click', function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            var newPlace = {lat: lat, lng: lng};
            addMarker(newPlace, null);

            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
        });

        fetch('json.php')
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                for (k in data) {
                    console.log(data[k]);
                    var place = data[k];
                    var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

                    addMarker(place, image);
                }
            });
    }

    function addMarker(place, image) {
        new google.maps.Marker({
            position: place,
            map: map,
            icon: image
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>

<?php include "templates/footer.php";?>