
<?php include "templates/header.php";?>

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

<form method="post">
    <input name="title" placeholder="Add title"><br>
    <input id="lat" name="latitude" placeholder="Add latitude"><br>
    <input id="lng" name="longitude" placeholder="Add longitude"><br>
    <textarea name="description"></textarea><br>
    <button name="action" value="add">Add marker</button>
</form>

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