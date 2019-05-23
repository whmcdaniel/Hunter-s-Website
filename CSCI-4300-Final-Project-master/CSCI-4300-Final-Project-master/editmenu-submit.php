<head>
	<title>Field to Farm - Edit Options</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<?php
	session_start();
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	$sql = "UPDATE `options` SET ";
	if(isset($_POST['cube']))
		$sql = $sql . " cube = 'Y',";
	else $sql = $sql . " cube = 'N',";
	if(isset($_POST['kielbasa']))
		$sql = $sql . " kielbasa = 'Y',";
	else $sql = $sql . " kielbasa = 'N',";
	if(isset($_POST['salami']))
		$sql = $sql . " salami = 'Y',";
	else $sql = $sql . " salami = 'N',";
	if(isset($_POST['sumSausage']))
		$sql = $sql . " sumSausage = 'Y',";
	else $sql = $sql . " sumSausage = 'N',";
	if(isset($_POST['bologna']))
		$sql = $sql . " bologna = 'Y',";
	else $sql = $sql . " bologna = 'N',";
	if(isset($_POST['imiBacon']))
		$sql = $sql . " imiBacon = 'Y',";
	else $sql = $sql . " imiBacon = 'N',";
	if(isset($_POST['slimJims']))
		$sql = $sql . " slimJims = 'Y',";
	else $sql = $sql . " slimJims = 'N',";
	if(isset($_POST['jerky']))
		$sql = $sql . " jerky = 'Y',";
	else $sql = $sql . " jerky = 'N',";
	if(isset($_POST['HQW']))
		$sql = $sql . " HQW = 'Y',";
	else $sql = $sql . " HQW = 'N',";
	if(isset($_POST['HQS']))
		$sql = $sql . " HQS = 'Y',";
	else $sql = $sql . " HQS = 'N',";
	if(isset($_POST['HQC']))
		$sql = $sql . " HQC = 'Y'";
	else $sql = $sql . " HQC = 'N'";
	$sql = $sql . " WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
		$stmt->execute([
		'id' => $_SESSION['id'],
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo '<h1 style="text-align: center"> Menu updated! </h1>';
	echo "<p style='margin-left: 10px'> Congratulations on updating your menu information.
		<a href='profile.php?search=" . $_SESSION['id'] . "'> click here </a> to go ahead and see your changes. </p>";	
?>