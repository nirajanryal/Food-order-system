<?php 
	
	session_start();
	if(!isset($_SESSION['username'],$_SESSION['email'],$_SESSION['userid'])){
		$_SESSION['url'] = "account.php";
		header('location:login.php');
		die();
	}
	include('connect.php'); 
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<style type="text/css">

		.settings{
			min-height: 300px;
			width: 15%;
			margin-left: 100px;
			padding: 2% 2% 2% 0%;
			float: left;
		}

		.settings a{
			text-decoration: none;
			display: block;
			margin-bottom: 13px;
			color: black;
		}

		.settingbox{
			min-height: 300px;
			width: 60%;
			margin-right: 150px;
			border-left:  1px solid rgba(74, 74, 74, 0.35);
			padding: 1%;
			padding-left: 20px;
			float: right;
		}

		.settingbox input{
			width: 350px;
			height: 20px;
			padding: 5px;
			margin-top: 5px;
			border: 1px solid rgba(74, 74, 74, 0.15);
		}

		.settingbox span{
			font-size: 13px;
			color: rgba(74, 74, 74, 0.8);
		}
		
		.leftbox{
			width: 40%;
			float: left;

		}

		.rightbox{
			width: 40%;
			float: right;
			margin-right: 40px;
			
		}

		#save{
			margin-top: 20px;
			width: 60px;
			border: none;
			padding: 1%;
			background-color: #fd0;
			color: #2d2c2c;
			transition: 0.5s;
		}

		#save:hover{
			background-color: #c2b280;
		}

		#message{
			font-size: 13px;

		}
	</style>

</head>

<body >
	
	<section class="header" style="background-color: white">
		<nav style="height: 7vh ;">
			<a href="index.html"><img src="images/logo.png"></a>
			<div class="nav-links">
				<ul>
					<li><a href="index.php">HOME</a> </li>
					<li><a href="menu.php">MENU</a> </li>
					<li><a href="cart.php">BAG</a> </li>
					<?php 
						if (!isset($_SESSION['email'], $_SESSION['username'])) {
							echo"<li><a href='login.php'>LOGIN</a> </li>
							<li><a href='register.php' >REGISTER</a> </li>";
						}else{
							echo"<li><a href='account.php'>MY ACCOUNT</a> </li>";
							echo"<li><a href='logout.php'>LOGOUT</a> </li>";
						}
					?>
				</ul>
				
			</div> 
		</nav>

	</section>

	

	<section class="account" style="height: 90%">

		<div style="width: 86%;height: 10vh; border-bottom:  1px solid rgba(74, 74, 74, 0.4); padding: 3% 7% 0% 7%; font-size: 35px;">Account Settings
		</div>
		<br>

		<div class="settings">
			
			<a href="account.php" style="font-weight: bold;">
				<img src="images/myprofile.png" style="width: 25px ; height: 25px;vertical-align: middle;">&nbsp;My Profile
			</a>
			
			<a href="changepassword.php">
				<img src="images/password.png" style="width: 25px ; height: 25px;vertical-align: middle;">&nbsp;Password
			</a>

			<a href="orderhistory.php">
				<img src="images/bag.png" style="width: 25px ; height: 25px;vertical-align: middle;">&nbsp;Order History
			</a>
		</div>


		<div class="settingbox">
			<div class="text-center"><img src="images/profile.png" style="width: 120px; height: 120px"></div>
			<br>

			<?php 

				$email = $_SESSION['email'];

				$q = "SELECT uid, firstname, lastname, contact FROM userinfo WHERE email='$email' ";

				$res = mysqli_query($con,$q);

				$row = mysqli_fetch_assoc($res);

			?>
			<form method="POST">
				<div class="leftbox">
					<span>FIRSTNAME</span><br>
					<input type="text" name="firstname" id="firstname" value="<?php echo $row['firstname'];?>">
					<br>
					<br>
					<span>PHONE NUMBER</span><br>
					<input type="text" name="contact" id="contact" value="<?php echo $row['contact'];?>">
				</div>

				<div class="rightbox">
					<span>LASTNAME</span><br>
					<input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname'];?>">
					<br>
					<br>
					<span>EMAIL</span><br>
					<input type="text" name="" id="email" disabled value="<?php echo $email;?>">
				</div>
				<div style="clear: both;"></div>

				<button name="save" id="save" type="submit">Save</button>
			</form>
			<br>
			<p id="message">
				<?php

					if(isset($_GET['success'])){
						$result = $_GET['success'];
						if($result == 'true')
							echo "Info Updated Successfully";
						if($result == 'false')
							echo "Cannot Update Info! Please try again later.";

					}
				?>
			</p>
		</div>
		
	</section>
<div style="clear: both;"></div>
	<br>
	<div class="footer">
		<br>
		<div class="wrap text-center">
			
			<a href="">Sitemap</a>|
			<a href="">Privacy Policy</a>|
			<a href="">Terms of Use</a>|
			<a href="">Terms and Conditions</a>

			<br><br>
			<a href=""> <img src="images/facebook.png"></a>
			<a href=""> <img src="images/instagram.png"></a>
			<a href=""> <img src="images/twitter.png"></a>
			<a href=""> <img src="images/github.png"></a>
			<a href=""> <img src="images/google.png"></a>

			

			<br><br>
			Copyright © 2021  Yummy Food Inc.  All Rights Reserved.
			
		</div>
	</div>
</body>

<?php 
	if(isset($_POST['save'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$contact = $_POST['contact'];
		$email = $_SESSION['email'];


		$q1 = "UPDATE userinfo set firstname='$firstname' ,lastname='$lastname', contact='$contact' WHERE email='$email'";

		$res = mysqli_query($con,$q1);

		if($res){
		
			header('location:account.php?success=true');
		}

		else{
		
			header('location:account.php?success=false');
		}

	}

?>

<script type="text/javascript">
        
        window.setTimeout("closeDiv();", 3000);
        function closeDiv() {
            document.getElementById('message').style.display ="none";
        }
    </script>
</html>