<!DOCTYPE html>

<head>
	<title>Field to Table - Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php	
	session_start();
	if(isset($_GET['search']))
		$id = $_GET['search'];
	
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	
	$sql = "SELECT * FROM userinfo WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'id' => $id,
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$sql = "SELECT * FROM markers WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'id' => $id,
	]);
	$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$sql = "SELECT * FROM options WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'id' => $id,
	]);
	$row3 = $stmt->fetch(PDO::FETCH_ASSOC);
	
?>
<style>
		* {padding-left: 10px;}
</style>
<h1 style="text-align:center"> PROFILE </h1>
<h2>Basic Information</h2>
<p><b>Name:</b> <?php echo $row['name'] ?></p>
<p><b>Description:</b> <?php echo $row['description'] ?></p>
<p><?php echo '<img src="/Images/' . $row["piclocation"] . '" class="img-thumbnail" style="width: 50%; height: 50%;" alt="Your profile picture here!">'?></p>
<h2>Location Information</h2>
<p><b>Address:</b> <?php echo $row2['address'] ?></p>
<p><b>City:</b> <?php echo $row2['city'] ?></p>
<p><b>State:</b> <?php echo $row2['state'] ?></p>
<p><b>Zip:</b> <?php echo $row2['zip'] ?></p>
<h2>Options</h2>
<table class="table table-striped table-bordered">
	<tr>
		<th scope="col">Type</th>
		<th scope="col">Available? (Y/N)</th>
	</tr>
	<tr>
		<td>Cube</td>
		<td><?php echo $row3['cube']?></td>
	</tr>
	<tr>
		<td>Kielbasa</td>
		<td><?php echo $row3['kielbasa']?></td>
	</tr>
	<tr>
		<td>Salami</td>
		<td><?php echo $row3['salami']?></td>
	</tr>
	<tr>
		<td>Summer Sausage</td>
		<td><?php echo $row3['sumSausage']?></td>
	</tr>
	<tr>
		<td>Bologna</td>
		<td><?php echo $row3['bologna']?></td>
	</tr>
	<tr>
		<td>ImiBacon</td>
		<td><?php echo $row3['imiBacon']?></td>
	</tr>
	<tr>
		<td>Slim Jims</td>
		<td><?php echo $row3['slimJims']?></td>
	</tr>
	<tr>
		<td>Jerky</td>
		<td><?php echo $row3['jerky']?></td>
	</tr>
	<tr>
		<td>Smoked Hind Quarters (Whole)</td>
		<td><?php echo $row3['HQW']?></td>
	</tr>
	<tr>
		<td>Smoked Hind Quarters (Steaks)</td>
		<td><?php echo $row3['HQS']?></td>
	</tr>
	<tr>
		<td>Smoked Hind Quarters (Chipped)</td>
		<td><?php echo $row3['HQC']?></td>
	</tr>
</table>
<?php
	if(isset($_SESSION['id']) && $_SESSION['id'] == $_GET['search'] )
		echo "<button type='button' class='btn btn-primary btn-lg' onclick='window.location.href=\"editprofile.php\"'>Edit Profile</button>
			<button type='button' class='btn btn-priamry btn-lg' onclick='window.location.href=\"editmap.php\"'>Edit Map Information</button>
			<button type='button' class='btn btn-primary btn-lg' onclick='window.location.href=\"editmenu.php\"'>Edit Menu Information</button>"
?>

<p><a href="index.php">To the front page</a></p>
<p><a href="displaymap.php">To the map</a></p>