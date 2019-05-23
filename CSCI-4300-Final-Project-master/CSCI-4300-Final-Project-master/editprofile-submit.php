<head>
	<title>Field to Farm - Signup</title>
	<meta charset="utf-8" />
</head>

<?php
	session_start();
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	if(!empty($_FILES['fileupload']['name'])) {
		$sql = "SELECT piclocation FROM userinfo WHERE ID = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $_SESSION['id'],
		]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(file_exists("./Images/" . "USER" . $_SESSION['id'] . ".png")) {
			unlink("./Images/" . "USER" . $_SESSION['id'] . ".png");
		}
		
		$sql = "UPDATE userinfo SET description = :description, name = :name, piclocation = :piclocation WHERE ID = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $_SESSION['id'],
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'piclocation' => "USER" . $_SESSION['id'] . ".png",
		]);
	} else {
		$sql = "UPDATE userinfo SET description = :description, name = :name WHERE ID = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $_SESSION['id'],
			'name' => $_POST['name'],
			'description' => $_POST['description'],
		]);
	}
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$sql = "UPDATE markers SET name = :name WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'name' => $_POST['name'],
		'id' => $_SESSION['id'],
	]);
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$fileToMove = $_FILES['fileupload']['tmp_name'];
	$destination = "./Images/USER" . $_SESSION['id'] . ".png";
	move_uploaded_file($fileToMove, $destination);
	
	echo '<h1> Profile updated! </h1>';
	echo "<p> Congratulations on updating your profile information.
		<a href='profile.php?search=" . $_SESSION['id'] . "'> click here </a> to go ahead and see your changes. </p>";	
?>