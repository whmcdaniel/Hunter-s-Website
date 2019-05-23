<?php
    //database details
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	
	$sql = "SELECT ID FROM users WHERE Username = :username AND Password = :password";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'username' => strtolower($_POST['username']),
		'password' => $_POST['password'],
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row['ID'] != NULL) {
		echo 'Account logged in! Redirecting you now...';
		session_start();
		$_SESSION["id"] = $row['ID'];
		header("Location: index.php");
		die();
	}
	else {
		echo "<h1>Oops. Account does not exists!</h1>";
		echo "<p><a href='login.php'>Let's try that again.</a></p>";
	}
?>

<head>
	<title>Field to Farm - Login</title>
	<meta charset="utf-8" />
</head>
