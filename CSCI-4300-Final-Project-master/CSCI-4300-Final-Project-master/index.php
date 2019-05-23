<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['id'])) {
		$pdo = new PDO(
			"mysql:host=localhost;dbname=fieldtotable",
			'root',
			''
		);
		
		$sql = "SELECT Username FROM users WHERE ID = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			'id' => $_SESSION['id'],
		]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
<html lang="en">
<head>
	<title>Field to Table - Main Page</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
	.jumbotron {
		background-color: green;
		color: #fff;
	}
	
	.container-fluid {
		padding: 60px 50px;
	}
  </style>
</head>
<div class="jumbotron text-center">
	<a href="index.php">
        <img class="center" src="Images/ftf.png" alt="logo" width="500" height="500">
    </a>
	<h3><strong>A site for hunters to find meat processors</strong></h3> 
	<form id="form" class="form-inline" action="search.php" method="get" role="form">
    <div class="input-group">
      <input type="text" name="search" class="form-control" size="50" placeholder="Search for a specific processor..." required></input>
      <div class="input-group-btn">
        <button type="submit" style="background-color:brown" class="btn btn-danger">Search</button>
      </div>
    </div>
	</form>
	<div class="container-fluid">
		<p><a style="color: white" href="advanced-search.php">Advanced search</a></p>
		<p><a style="color: white" href="displaymap.php">Check out the map!</a></p>
	</div>
	<?php
	if(isset($_SESSION['id'])) {
		echo '<button type=\'button\' class="btn btn-primary btn-lg" onclick=\'window.location.href="logout.php"\'>Log out</button>
			<button type=\'button\' class="btn btn-primary btn-lg" onclick=\'window.location.href="profile.php?search=' . $_SESSION['id'] . '"\'>View Profile</button>';
	} else {
		echo '<p>New User? <a href="signup.php" style="color: white"> Click here to sign up</a> </p>
		<p>Returning User? <a href="login.php" style="color: white">Click here to log in</a> </p>';
	}
?>
</div>
<div class="container-fluid text-center">
  <h2>Who are we?</h2>
  <h4><strong>Members:</strong> Lucas Kessler, Will McDaniel, Luke Nguyen</h4>
  <p><strong>What is this?:</strong> This serves to bridge the gap between processors and current advertising technology. Currently,
  processors have typically not been up to date on their internet presense, causing them to fall behind in
  advertising world. With this website, processors can create profiles and put information in about themselves.
  Users looking to use a processor's service can then search to find processors around them that process meat in
  the ways they want it.
</div>
