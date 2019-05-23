<!DOCTYPE html>
<html>
	<?php session_start(); $id = $_SESSION['id']?>
	<head>
		<title>Field to Table - Edit Menu</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<style>
	* {
			margin-left: 10px;
	}
	</style>
	<body>
		<div>
			<h1> Update Options </h1>
		</div>
		
		<form action="editmenu-submit.php" method="post">
		<fieldset>
		<legend>Please select options you have available:</legend>
			<input type="checkbox" name="cube" value="cube"> Cube<br>
			<input type="checkbox" name="kielbasa" value="kielbasa"> Venison Kielbasa<br>
			<input type="checkbox" name="salami" value="salami"> Venison Salami<br>
			<input type="checkbox" name="sumSausage" value="sumSausage"> Venison Summer Sausage<br>
			<input type="checkbox" name="bologna" value="bologna"> Venison Bologna<br>
			<input type="checkbox" name="slimJims" value="slimJims"> Venison Slim Jims<br>
			<input type="checkbox" name="imiBacon" value="imiBacon"> Venison Imitation Bacon<br>
			<input type="checkbox" name="jerky" value="jerky"> Venison Jerky<br>
			<input type="checkbox" name="HQW" value="HQW"> Venison Smoked Hind Quarters (Whole)<br>
			<input type="checkbox" name="HQS" value="HQS"> Venison Smoked Hind Quarters (Steaks)<br>
			<input type="checkbox" name="HQC" value="HQC"> Venison Smoked Hind Quarters (Chipped)<br>
		<input type="submit" value="Submit" style="margin-top: 10px">
		</fieldset>
		</form><br>
		<p><a href=<?php echo "profile.php?search=" . $_SESSION['id']?>>Return to Profile Page </a></p>
	</body>
</html>