<head>
	<title>Field to Farm - Edit Map</title>
	<meta charset="utf-8" />
</head>

<?php
	session_start();
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	$sql = "UPDATE markers SET address = :address, city = :city, state = :state, zip = :zip, lat = :lat, lng = :lng WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'id' => $_SESSION['id'],
		'address' => $_POST['address'],
		'city' => $_POST['city'],
		'state' => $_POST['state'],
		'zip' => $_POST['zip'],
		'lat' => $_POST['lat'],
		'lng' => $_POST['lng'],
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	echo '<h1 style="text-align: center"> Map updated! </h1>';
	echo "<p> Congratulations on updating your map information.
		<a href='profile.php?search=" . $_SESSION['id'] . "'> click here </a> to go ahead and see your changes. </p>";	
?>