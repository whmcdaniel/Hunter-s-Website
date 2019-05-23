<!DOCTYPE html>
<?php
	session_start();
	$id = $_SESSION['id'];
	
	$pdo = new PDO(
		"mysql:host=localhost;dbname=fieldtotable",
		'root',
		''
	);
	
	$sql = "SELECT name, description FROM userinfo WHERE ID = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'id' => $id,
	]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<head>
	<title>Field to Table - Edit Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<h1 style="text-align: center"> EDIT PROFILE </h1>
<style>
	* {
		padding-left: 10px;
	}
</style>
<form action="editprofile-submit.php" method="post" enctype="multipart/form-data" id="editProf">
  <div class="form-group">
    <label for="nameInput">Name:</label>
    <input type="text" name="name" class="form-control" id="nameInput" value="<?php echo $row['name'] ?>">
  </div>
	
  <div class="form-group">
    <label for="textArea">Description:</label><br>
    <textarea class="form-control" id="textArea" name="description" rows="3"><?php echo $row['description'] ?></textarea>
  </div>
	
  <div class="form-group">
    <label for="fileinput">Upload an image:</label>
    <input type="file" name="fileupload" class="form-control-file" id="fileinput">
  </div>
	<button type="submit" class="btn btn-primary">Submit Edit</button>
</form>

<h3> Temporary </h3>
<p><a href=<?php echo "profile.php?search=" . $_SESSION['id']?>>Return to Profile Page </a></p>