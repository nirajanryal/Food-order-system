<?php 
	include('connect.php'); 
	session_start();
	if(!isset($_SESSION['username'],$_SESSION['email'],$_SESSION['userid'])){
		$_SESSION['url'] = "orderhistory.php";
		header('location:login.php');
		die();
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<style type="text/css">

		.set{
			width: 100%;
			position: relative;
		}
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
			width: 40%;
			margin:0 auto;
			border-left:  1px solid rgba(74, 74, 74, 0.35);
			padding: 1%;
			padding-left: 20px;
			
		}

		.orderbox{
			min-height: 200px;
			width: 25%;
			float: right;
			border: 1px solid black;
			position: absolute;
			right: 0;
			top: 0;
			margin-right: 50px;

		}

		.settingbox p{
			border-bottom:  1px solid rgba(74, 74, 74, 0.35);
			font-size: 14px;
			font-weight: bold;
			padding-bottom: 8px;
		}

		

		.settingbox span{

			font-size: 13px;
			color: rgba(74, 74, 74, 0.8);
			border-bottom:  1px solid rgba(74, 74, 74, 0.35);
			display: block;
			padding: 10px 0px;
		}

		.head{
			color: rgba(74, 74, 75, 1);
			margin: 5px 0px;
			font-weight: bold;
			font-size: 12px;
		}
		
		.settingbox label{
			display: block;
			color: rgba(74, 74, 74, 0.8);
			font-size: 14px;
			padding: 3px;
		}

		.settingbox .status{
			display: inline-block;
			padding: 0px 5px 2px 5px;
			background-color: red;
			color: white;
			border-radius: 10px;
			border: none;
		}

		.settingbox .orderitems{
			margin: 5px 10px;
			display: none;
		}

		.ordergroup{
			width: 60%;
			border-bottom: 1px solid rgba(74, 74, 74, 0.35); 
			padding: 4px 0px;
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
		.past{
			display: none;
		}

		.pastorder{
			cursor: pointer;
		}

		.current{
			cursor: pointer;
		}

		#filter{
			border: 1px solid rgba(74, 74, 74, 0.35);
			cursor: pointer;
			padding: 3px 6px;
			margin-bottom: 8px;
			background: transparent;

		}

		#popup{
			display: none;
			position: absolute;
			width: 37%;
			height: auto;
			border: 1px solid rgba(74, 74, 74, 0.35);
			top: 40px;
			background-color: rgb(253, 252, 252);
			z-index: 2;
			padding: 1% 1% 1% 2%;
		}

		#popup p{
			border: none;

		}

		#popup input{
			width: 90%;
			height: 40px;
			padding: 1% 1% 1% 2%;
			font-size: 16px;
		}

		#popup button{
			padding: 2%;
			border: none;
			margin-top: 15px;
			margin-right: 50px;
			cursor: pointer;
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
		<div class="set">
			<div class="settings">
				
				<a href="account.php" >
					<img src="images/myprofile.png" style="width: 25px ; height: 25px;vertical-align: middle;">&nbsp;My Profile
				</a>
				
				<a href="changepassword.php" >
					<img src="images/password.png" style="width: 25px ; height: 25px;vertical-align: middle;">&nbsp;Password
				</a>

				<a href="orderhistory.php" style="font-weight: bold;">
					<img src="images/bag.png" style="width: 25px ; height: 25px;vertical-align: middle;">&nbsp;Order History
				</a>
			</div>


			<div class="settingbox">


				<button id="filter">Filter Order History</button>
				<div id="popup" >
					<div id="start" style="width: 50%;float: left;">
						<p>Start Date</p>
						<input type="date" id="sstart">
					</div>
					<div id="end" style="width: 50%;float: right;">
						<p>End Date</p>
						<input type="date" id="eend">
					</div>
					<div style="clear: both;"></div>
					<button style="background-color: green;color: white;" id="submit">FILTER</button>
					<button style="background-color: red;color: white;" id="clear">CLEAR</button>
				</div>


				<p>ORDER HISTORY</p>
				<div class="fitlerrecord" style="display: none;"></div>
				<span class='head'>CURRENT ORDER</span>

				<?php 

				$email = $_SESSION['email'];
				$todaydate =  date("Y-m-d");

				$q= "SELECT `order-date` ,GROUP_CONCAT( food SEPARATOR '-') as foods,GROUP_CONCAT(oid SEPARATOR '-') as oids,GROUP_CONCAT(`status` SEPARATOR '-') as status from `order` where email='$email' and status<>'cart' and `order-date` LIKE '$todaydate%:__:%' group by `order-date` order by `oid` desc ";

				$res = mysqli_query($con,$q);

				if(mysqli_num_rows($res)>0){

					while($row = mysqli_fetch_assoc($res)){

						$exts = explode('-', $row['status']);
						$c = array_count_values($exts); 
						$val = array_search(max($c), $c);

						$exto = explode(' ',$row['order-date']);
						$ext_o = $exto[0];

						echo "<div class='ordergroup'>
							<label>Order No. : #".$row['oids']."</label>
							<label>Order Date : ".$ext_o."</label>
							<label>Order Status : <span class='status current'>".$val."</span></label>
							";

						$extf = explode('-', $row['foods']);
						
						echo"<div class='orderitems'>";
						for ($i=0; $i <count($extf) ; $i++) { 
							echo"
							
								<label>&#x025B8; ".$extf[$i]." : <span class='status'>".$exts[$i]."</span></label>
								
							
							";
						}
						echo"</div>
						</div>
						";
					}
				}
				else{
					echo "<span class='norecord'> No records for current orders found. </span>";
				}
				
				?>



				<span class ='head'>SCHEDULE ORDER</span>

				<?php 

				$email = $_SESSION['email'];
				$todaydate =  date("Y-m-d");

				$q= "SELECT `order-date` ,GROUP_CONCAT( food SEPARATOR '-') as foods,GROUP_CONCAT(oid SEPARATOR '-') as oids,GROUP_CONCAT(`status` SEPARATOR '-') as status from `order` where email='$email' and status<>'cart' and `order-date` LIKE '$todaydate%:%-%:%' group by `order-date` order by `oid` desc ";

				$res = mysqli_query($con,$q);

				if(mysqli_num_rows($res)>0){

					while($row = mysqli_fetch_assoc($res)){

						$exts = explode('-', $row['status']);
						$c = array_count_values($exts); 
						$val = array_search(max($c), $c);

						$exto = explode(' ',$row['order-date']);
						$ext_o = $exto[0];

						echo "<div class='ordergroup'>
							<label>Order No. : #".$row['oids']."</label>
							<label>Order Date : ".$ext_o."</label>
							<label>Order Status : <span class='status current'>".$val."</span></label>
							";

						$extf = explode('-', $row['foods']);
						
						echo"<div class='orderitems'>";
						for ($i=0; $i <count($extf) ; $i++) { 
							echo"
							
								<label>&#x025B8; ".$extf[$i]." : <span class='status'>".$exts[$i]."</span></label>
								
							
							";
						}
						echo"</div>
						</div>
						";
					}
				}
				else{
					echo "<span class='norecord'> No records for schedule orders found. </span>";
				}
				
				?>


				<span  class="head pastorder">PAST ORDER</span>
				<?php 

				$email = $_SESSION['email'];
				$todaydate =  date("Y-m-d");

				$q= "SELECT `order-date` ,GROUP_CONCAT( food SEPARATOR '-') as foods,GROUP_CONCAT(oid SEPARATOR '-') as oids,GROUP_CONCAT(`status` SEPARATOR '-') as status from `order` where email='$email' and status<>'cart' and `order-date` NOT LIKE '$todaydate%:__:%' and `order-date` NOT LIKE '$todaydate%:%-%:%'  group by `order-date` order by `oid` desc LIMIT 3 ";

				$res = mysqli_query($con,$q);

				if(mysqli_num_rows($res)>0){

					while($row = mysqli_fetch_assoc($res)){

						$exts = explode('-', $row['status']);
						$c = array_count_values($exts); 
						$val = array_search(max($c), $c);

						$exto = explode(' ',$row['order-date']);
						$ext_o = $exto[0];

						echo "<div class='ordergroup past'>
							<label>Order No. : #".$row['oids']."</label>
							<label>Order Date : ".$ext_o."</label>
							<label>Order Status : <span class='status current'>".$val."</span></label>
							";

						$extf = explode('-', $row['foods']);
						
						echo"<div class='orderitems'>";
						for ($i=0; $i <count($extf) ; $i++) { 
							echo"
							
								<label>&#x025B8; ".$extf[$i]." : <span class='status'>".$exts[$i]."</span></label>
								
							
							";
						}
						echo"</div>
						</div>
						";
					}
				}
				else{
					echo "<span class='norecord'> No records for past orders found. </span>";
				}
				
				?>
				
			</div>

			<!-- <div class="orderbox">
				<p
			</div> -->
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
<script src="js/jquery-3.6.0.min.js"></script>


		<script>
			$(document).ready(function(){
				$(document).on("click",".current",function(){

					$(this).parent().parent().find(".orderitems").slideToggle();
				});

				$(".pastorder").click(function(){

					$(".past").slideToggle();
					$(".orderitems").slideUp();
				});

				$('#filter').click(function() {
				    $("#popup").toggle();
				    
				});

				$("#submit").click(function(){
					var a = $("#sstart").val();
					var b = $("#eend").val();

					$.ajax({
						type:'POST',
						url:'filter.php',
						data:{
							start:a,
							end:b
						},
						cache:false,
						
						success: function (data) {
							$("#popup").hide();
							$(".fitlerrecord").show();
							$(".ordergroup").hide();
		        			$('.fitlerrecord').html(data);

		    			},
						
						 error: function(xhr, status, error) {
		                    console.error(xhr);
		                }
					});
					$(".head").hide();
					$(".norecord").hide();
				});

				$("#clear").click(function(){
					$("#sstart").val(" ");
					$("#eend").val(" ");
				})
			});
		</script>

</html>