<head>
	<title>Field to Table - Signup</title>
	<meta charset="utf-8" />
</head>

<?php
    //database details
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	
	$sql = "SELECT COUNT(*) AS num FROM users WHERE Username = :username";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':username',strtolower($_POST['username']));
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row['num'] > 0) {
		echo "<h1> Error: Username already exists. Please try again </h1>";
		echo "<p> <a href='signup.php'> Click here to try again. </a>";
	} else {
		$sql = "INSERT INTO users (ID, Username, Password) VALUES (:id, :username, :password)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => NULL,
			'username' => strtolower($_POST['username']),
			'password' => $_POST['password'],
		]);
		
		$sql = "SELECT ID FROM users WHERE Username = :username AND Password = :password";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'username' => strtolower($_POST['username']),
			'password' => $_POST['password'],
		]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$sql = "INSERT INTO `userinfo` (`ID`, `piclocation`, `description`, `name`) VALUES (:id, '', '', '')";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $row['ID'],
		]);
		
		$sql = "INSERT INTO `options` (`ID`, `cube`, `kielbasa`, `salami`, `sumSausage`, `bologna`, `imiBacon`, `slimJims`, `jerky`, `HQW`, `HQS`, `HQC`) VALUES (:id, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N')";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $row['ID'],
		]);

		$sql = "INSERT INTO `markers` (`ID`) VALUES (:id)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $row['ID'],
		]);
		echo "<h1> User has been successfully created! </h1>";
		echo "<p> Congratulations on creating a new account.
		<a href='login.php'> click here </a> to go ahead and log in. </p>";		
	}		
?>