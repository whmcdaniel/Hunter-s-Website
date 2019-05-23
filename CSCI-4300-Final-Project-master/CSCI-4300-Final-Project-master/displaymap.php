<!DOCTYPE html>
<html> 
<head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsqq0fwojY763XT9oQx55S3xDUHD1KMUw&callback=initMap"
 type="text/javascript"></script>
</head>
    <script>
    function initialize() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: new google.maps.LatLng(42.877742,-97.380979),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
		
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				map.setCenter(pos);
			}, function() {
				handleLocationError(true, infowWindow, map.getCenter());
			});
		} else { handleLocationError(false, infowWindow, map.getCenter()); }
        var infowindow = new google.maps.InfoWindow();
        var marker;
        var location = {};
        var markers = document.getElementsByTagName("marker");

        for (var i = 0; i < markers.length; i++) {
            location = {
                name : markers[i].getAttribute("html"),
                address : markers[i].getAttribute("address"),
                city : markers[i].getAttribute("city"),
                state : markers[i].getAttribute("state"),
                zip : markers[i].getAttribute("zip"),
                pointlat : parseFloat(markers[i].getAttribute("lat")),
                pointlng : parseFloat(markers[i].getAttribute("lng")),
				id : parseFloat(markers[i].getAttribute("id"))
            };

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(location.pointlat, location.pointlng),
                map: map
            });
			
			google.maps.event.addListener(marker, 'mouseover', (function(marker,location) {
				return function() {
					infowindow.setContent(location.name);
					infowindow.open(map, marker);
				};
			})(marker, location));
			
            google.maps.event.addListener(marker, 'click', (function(marker,location) {
                return function() {
					window.location = "/profile.php?search=" + location.id;
                };
            })(marker, location));
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head> 
<body>
    <markers>
	<?php 
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	$sql = "SELECT * FROM markers";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		if($row['lat'] != 0 && $row['lng'] != 0)
			echo '<marker id="' . $row['ID'] . '" zip="' . $row['zip'] . '" state="' . $row['state'] .'" city="'. $row['city'] .'" address="' . $row['address'] . '" lng="' . $row['lng'] . '" lat="' . $row['lat'] . '" html="' . $row['name'] . '"></marker>';
	?>
    </markers>
    <div id="map" style="width: 100%; height: 600px;"></div>
	<p><a href="index.php">Back to front page</a></p>
</body>
</html>