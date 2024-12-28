<?php 
	session_start();
	if(isset($_SESSION['email'])){
		header('location:menu.php');
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >



</div> 
<br>
<div class="text-center">
	<a href="index.php"><img src="images/logo.png" height="80px" width="90px"></a>
	<br>
	<br>
	<h2>Sign in to Food Order</h2>
	<br>
		<?php
		if (isset($_GET['success'])) {
              $res=$_GET['success'];
				if ($res == "true") {
				   echo "<div class='create-acc' style='color: white;background-image: linear-gradient(to right top, #436a94, #365a81, #294a6f, #1c3b5d, #0e2d4c); margin-bottom:15px; padding:1% 1.5%;'>Congratulations!!! Your account has been successfully created.</div>";
				}	
				if ($res == "invalid") {
				   echo "<div class='create-acc' style='color: green; background-color:red; margin-bottom:15px; padding:1% 1.5%;'>Invalid Email or Password.</div>";
				}			
			}
	?>

	<div class="login">
		<form action="loginprocess.php" method="post">
			<h5>Email</h5>
			<input type="text" name="email"  required>
			<br><br>
			<h5>Password</h5>
			<input type="password" name="password" required>
			<br><br>
			<input type="submit" name="submit" value="Sign in">
		</form>
	</div>
	<br>

	<div class="create-acc">
		New to Food Order? <a href="register.php">Create an account.</a>
	</div>

	<br>
	<br>
	<div class="loginfooter">
		<a href="">Terms</a>
		<a href="">Privacy</a>
		<a href="">Sitemap</a>
		<a href="">Contact</a>
	</div>
</div>


</body>
</html>
