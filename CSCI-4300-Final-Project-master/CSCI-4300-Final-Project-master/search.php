<?php
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	
	$sql = "SELECT ID FROM userinfo WHERE name = :name LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'name' => $_GET['search'],
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row['ID'] == 0) {
		echo "<h1> Couldn't find a place with that name! </h1>";
		echo "<p> <a href='index.php'> Return to main page. </a>";
	} else {
		header("Location: profile.php?search=" . $row['ID']);
		die();
	}
?>