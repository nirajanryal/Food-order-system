<?php
	include('connect.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#delivery{
			width: 100%;
			height: 200px;
			background-color: red;
		}

		#delivery img{
			z-index: 2;
			height: 150px;
			width: 200px;
			vertical-align: middle;
		}

		#delivery span{
			font-size: 19px;
			font-weight: bold;
			color: white;
			margin-left: 100px;
		}

		marquee{
			width: 80%;
		}
	</style>
</head>
<body>
	<section class="header">
		<nav>
			<a href="index.php"><img src="images/logo.png"></a>
			<div class="nav-links">
				<ul>
					<li><a href="">HOME</a> </li>
					<li><a href="menu.php">MENU</a> </li>
					<?php 
						if (!isset($_SESSION['email'])) {
							echo"<li><a href='login.php'>LOGIN</a> </li>
							<li><a href='register.php' >REGISTER</a> </li>";
						}else{
							echo"<li><a href='cart.php'>BAG</a> </li>";
							echo"<li><a href='account.php'>MY ACCOUNT</a> </li>";
							echo"<li><a href='logout.php'>LOGOUT</a> </li>";
						}
					?>
				</ul>
				
			</div> 
		</nav>
		

	</section>
	<section class="body" >

		

		<div class="main-body">
			<div class="homediv"><h5>Life is too short to<br/> eat bad food.</h5> 
				<p>
					Foods and drinks available for delivery at your doorsteps.
				</p>
				<br>
				<br>
				<div class="search">
					<form action="menu.php" method="POST">
						<input type="text" name="searchq" placeholder="Search Menu Items">
						<input type="submit" name="searchqbtn" value="Search">
					</form>
				</div>
				<br>

			</div>

			<div class="rimage " ><img src="images/image1.png"  id="image"></div>

		</div>
		</section>
		<br>
		<br>
		<br>

		<div class="featured">
			<br><br>
			<h2>Featured Category</h2>
			<br>
			<?php

			$q = "SELECT cid,image_name FROM category WHERE featured='Yes' LIMIT 8";

			$res = mysqli_query($con,$q);

			while($row=mysqli_fetch_assoc($res)){
				echo"<div class='imagehover'><a href='menu.php?category=".$row['cid']."'><img src='category/".$row['image_name']."'></a></div>";
			}

			?>	
			
		</div>

		<div class="featuredfood ">
			<br>
			<h2>Featured Food</h2>

			<?php

			$q = "SELECT fid,title,description,image_name,price FROM food WHERE featured='Yes' LIMIT 8";

			$res = mysqli_query($con,$q);

			while($row = mysqli_fetch_assoc($res)){

				$description = substr($row['description'],0,70) . "...";

				echo"<div class='ffood'>
					<img src='food/".$row['image_name']."'>
					<p class='title'>".$row['title']."</p>
					<span>".$description."</span>
					<p class='price'>Rs ".$row['price']."</p>

					<button class='addbagbtn'>Add to Bag</button>
					</div>
				";
			}

			?>
			
			<br>
			<a href="menu.php"><button id="seemenu">See Menu</button><a>

		</div>

		



	<br>
	<div id="cartmsg" style="background-color: green;">
		
	</div>
	<div style="clear: both;"></div><br>

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

<script src="js/jquery-3.6.0.min.js"></script>

<script>

	$(document).ready(function(){

		$('.addbagbtn').click(function(){

			var email = "<?php echo isset($_SESSION['email']); ?>";
			var username = "<?php echo isset($_SESSION['username']); ?>";
					
			if(email=="" && username==""){

				window.location="login.php";
				
			}else{
				var title = $(this).parent().find('.title').html();
				var price = $(this).parent().find('.price').html();

				$.ajax({
					type:'POST',
					url:'add-cart.php',
					data:{
						foodtitle:title,
						price:price,
						page:"index"
					},
					cache:false,
					success: function (data) {

	        			$('#cartmsg').text(data);
	        			$('#cartmsg').show('fast');
	        			$('#cartmsg').delay(2000);
	        			$('#cartmsg').hide(500);

	    			},
					
					 error: function(xhr, status, error) {
	                    console.error(xhr);
	                }
				});
			}


		});
	});


</script>


</html>