<!DOCTYPE html>
<html>
<head>
	<LINK href="css/forms.css" rel="stylesheet" type="text/css">
</head>
<body>

<form action="signup-submit.php" style="border:1px solid #ccc" method="post">
  <div class="container">
    <h1>Sign Up</h1>

    <label for="username"><b>Name:</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <div class="clearfix">
      <button type="button" onclick="window.location.href ='index.php'" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>