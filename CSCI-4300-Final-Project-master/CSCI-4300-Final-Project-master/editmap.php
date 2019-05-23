<!DOCTYPE html>
<?php
	session_start();
	$id = $_SESSION['id'];
	
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	
	$sql = "SELECT * FROM markers WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'id' => $id,
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<head>
	<title>Field to Table - Edit Map</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
	* {
		padding-left: 10px;
	}
</style>
<h1 style="text-align: center"> EDIT MAP INFO </h1>
<form action="editmap-submit.php" method="post" enctype="multipart/form-data" id="editProf">
	<div style="margin-bottom:10px;">
		<strong>Address:</strong>
		<input type="text" name="address" value="<?php echo $row['address'] ?>">
	</div>
	
	<div style="margin-bottom:10px;">
		<strong>City:</strong>
		<input type="text" name="city" value="<?php echo $row['city'] ?>">
	</div>

	<div style="margin-bottom:10px;">
		<strong>State:</strong>
		<input type="text" name="state" value="<?php echo $row['state'] ?>">
	</div>
	
	<div style="margin-bottom:10px;">
		<strong>Zip:</strong>
		<input type="text" name="zip" value="<?php echo $row['zip'] ?>">
	</div>
	
	<div style="margin-bottom:10px;">
		<strong>Latitude:</strong>
		<input type="text" name="lat" value="<?php echo $row['lat'] ?>">
	</div>
	
	<div style="margin-bottom:10px;">
		<strong>Longitude:</strong>
		<input type="text" name="lng" value="<?php echo $row['lng'] ?>">
	</div>
	<button type="submit" style="background-color: gray; color: white;" class="btn">Submit Edit</button>
</form>
<p><a href=<?php echo "profile.php?search=" . $_SESSION['id']?>>Return to Profile Page </a></p>