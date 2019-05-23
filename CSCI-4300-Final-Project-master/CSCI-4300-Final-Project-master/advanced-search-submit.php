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
	session_start();
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	$sql = "SELECT ID FROM options WHERE ";
	if(isset($_POST['cube']))
		$sql = $sql . " cube = 'Y' OR";
	if(isset($_POST['kielbasa']))
		$sql = $sql . " kielbasa = 'Y' OR";
	if(isset($_POST['salami']))
		$sql = $sql . " salami = 'Y' OR";
	if(isset($_POST['sumSausage']))
		$sql = $sql . " sumSausage = 'Y' OR";
	if(isset($_POST['bologna']))
		$sql = $sql . " bologna = 'Y' OR";
	if(isset($_POST['imiBacon']))
		$sql = $sql . " imiBacon = 'Y' OR";
	if(isset($_POST['slimJims']))
		$sql = $sql . " slimJims = 'Y' OR";
	if(isset($_POST['jerky']))
		$sql = $sql . " jerky = 'Y' OR";
	if(isset($_POST['HQW']))
		$sql = $sql . " HQW = 'Y' OR";
	if(isset($_POST['HQS']))
		$sql = $sql . " HQS = 'Y' OR";
	if(isset($_POST['HQC']))
		$sql = $sql . " HQC = 'Y' OR";
	$sql = $sql . " '1' = '2'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$sql = "SELECT * FROM markers WHERE ID = :id AND 
		((lat > :lat - .8) AND (lat < :lat + .8) AND (lng > :lng - .8) AND (lng < :lng + .8))";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'lat' => $_POST['lat'],
			'lng' => $_POST['lng'],
			'id' => $row['ID'],
		]);
		$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
		echo '<marker id="' . $row2['ID'] . '" zip="' . $row2['zip'] . '" state="' . $row2['state'] .'" city="'. $row2['city'] .'" address="' . $row2['address'] . '" lng="' . $row2['lng'] . '" lat="' . $row2['lat'] . '" html="' . $row2['name'] . '"></marker>';
	}
?>
    </markers>
    <div id="map" style="width: 100%; height: 600px;"></div>
	<p><a href="index.php">Back to front page</a></p>
</body>
</html>