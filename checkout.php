<?php 
	include('connect.php'); 
	session_start();

	if (!isset($_SESSION['email'], $_SESSION['username'])){
		$_SESSION['url'] = "cart.php";
		header('location:login.php');
		die();
	}
	if(!isset($_POST['oidlist'])){
		header('location:cart.php');
		die();
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<style type="text/css">

		span{
			padding-left: 10px;
			font-size: 14px;
			display: inline-block;

		}

		input{
			padding: 10px;
			margin-left: 10px;
			height: 20px;
			width: 94%;
			border: 1px solid rgba(74, 74, 74, 0.2);
		}

		p{
			padding: 10px;
			font-size: 15px;
			border-bottom: 1px solid rgba(74, 74, 74, 0.15); 
			margin-bottom: 10px;
			background-color: #F7F5F2;
		}

		select{
			width: 80%;
		}

		#datetime{
			display: none;
			padding: 0 40px;
		}

		.item{
			padding: 1%;
			max-height: 400px;
			margin: 10px;
			margin-top: 20px;
			position: relative;
			overflow: auto;
			box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
			font-size: 13px;
		}

		.item::-webkit-scrollbar {
			margin-left: 10px;
			margin: 5px;
		 	width: 5px;
		}

		 
		.item::-webkit-scrollbar-thumb {
		  background: red; 
		  border-radius: 10px;
		}
		
		td{
			background-image: none;
		}

		tr{
			border-bottom:1px solid rgba(74, 74, 74, 0.15);
		}

		table{
			border-collapse: collapse;
			
		}

		.tr{
			border: none;
		}

		button{
			outline: none;
			font-size: 15px;
			padding: 5px 10px;
			border: none;
			background: transparent;
			margin-top: 10px;
			cursor: pointer;
			color: white;
			border-radius: 2px;
		}

		.er{
			font-size: 13px;
			color: #ff2400;
			/*display: none;*/
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

<?php 

	$oids = $_POST['oidlist'];
	$subtotal = $_POST['subtotal'];
	$total = $_POST['total'];
	$oids = $_POST['oidlist'];

	$ext = substr($oids, 0, -1);

?>
	

	<section class="checkout" style="height: 90%">

		<div style="width: 86%;height: 10vh; border-bottom:  1px solid rgba(74, 74, 74, 0.15);background-color: #F7F5F2; padding: 3% 7% 0% 7%; font-size: 35px;">Checkout</div>
		<br>
		<div class="info">
		<form action="order.php" method="POST" id="myform" onsubmit="return validate()">
			<div style="height: auto;border: 1px solid rgba(74, 74, 74, 0.2);padding-bottom: 10px;">
				<p >DELIVERY ADDRESS</p>
				<span>ADDRESS LOCATION *<span class="er" id="adderror"></span></span>
				<input type="text" name="address" >
				<br><br>
				<span>DETAIL ADDRESS DIRECTION *<span class="er" id="adddirerror"></span></span>
				<input type="text" name="addressdir" >

			</div>
			<br>
			<div style="height: auto;border: 1px solid rgba(74, 74, 74, 0.2);padding-bottom: 10px;">
				<p >DELIVERY DATE AND TIME</p>
				<?php
					date_default_timezone_set("Asia/Dhaka");
					$date = date("h:i:sa"); 
					$date = strtotime($date);
					$date = strtotime("-15 minute", $date);

					$open = strtotime("10:00:00am");
					$close = strtotime("06:00:00pm");

					if($date>= $open && $date<=$close){
						echo"<label><input type='radio' name='schedule' id='asp' value='asp' style='width: 5%;vertical-align: middle;'>As Soon As Possible</label>";
					}
					else{
						echo"<label><input type='radio' name='schedule' id='asp' value='asp' disabled style='width: 5%;vertical-align: middle;'>As Soon As Possible  <span class='er'> (Delivery Service is closed at this moment)</span></label>";
					}

				?> 
				<br><br>
				<label><input type="radio" name="schedule" id="ldt" style="width: 5%;vertical-align: middle;">Schedule Delivery For Later Date/Time</label>
				<br>
				<br>
				<div id="datetime">
					<div style="float: left;width: 45%">
						<span>Date<span class="er" id="dateerror"></span></span><br>
						<select name="seldate" id="seldate">
							<option disabled="" selected="">Select Date</option>
							<?php 
								if($date<=$close){
									echo "<option>".date("Y-m-d")."</option>";
								}
							?>
							<option><?php echo date('Y-m-d', strtotime("+1 day"));?></option>
							<option><?php echo date('Y-m-d', strtotime("+2 day"));?></option>
							<option><?php echo date('Y-m-d', strtotime("+3 day"));?></option>
							<option><?php echo date('Y-m-d', strtotime("+4 day"));?></option>
						</select>
					</div>
					<div style="float: right;width: 45%">
						<span>Time<span class="er" id="timeerror"></span></span><br>
						<select name="seltime" id="seltime">
							<option disabled="" selected="">Select Time</option>
							<option>10:00AM - 10:30AM</option>
							<option>10:30AM - 11:00AM</option>
							<option>11:00AM - 11:30AM</option>
							<option>11:30AM - 12:00PM</option>
							<option>12:00PM - 12:30PM</option>
							<option>12:30PM - 1:00PM</option>
							<option>1:00PM - 1:30PM</option>
							<option>1:30PM - 2:00PM</option>
							<option>2:00PM - 2:30PM</option>
							<option>2:30PM - 3:00PM</option>
							<option>3:00PM - 3:30PM</option>
							<option>3:30PM - 4:00PM</option>
							<option>4:00PM - 4:30PM</option>
							<option>4:30PM - 5:00PM</option>
							<option>5:00PM - 5:30PM</option>
							<option>5:30PM - 6:00PM</option>
							
						</select>
					</div>
					<div style="clear: both;"></div>
				</div>
			</div>
			<br>
			<div style="height: auto;border: 1px solid rgba(74, 74, 74, 0.2);padding-bottom: 10px;">
				<p >PAYMENT OPTION</p>
				<label><input type="radio" name="paychoice" value="cod" checked="" id="cod" style="width: 5%;vertical-align: middle;">Cash On Delivery</label>
				<br><br>
				<label>
					<input type="radio" name="paychoice" value="esewa" id="esewa" style="width: 5%;vertical-align: middle;">
					<img src="images/esewa.png" height="20px"  style="vertical-align: middle;object-fit: contain;object-position: center;">
				</label>
				
			</div>
			<br>

			<div style="height: auto;border: 1px solid rgba(74, 74, 74, 0.2);padding-bottom: 10px;">
				<p>INFO</p>
				<span>FULLNAME *<span class="er" id="nameerror"></span></span>
				<input type="text" name="fullname" id="fullnam" readonly="readonly" value="<?php echo $_SESSION['username']; ?>">
				<br><br>
				<span>CONTACT NO. *<span class="er" id="contacterror"></span></span>
				<input type="text" name="contact" id="contac" readonly="readonly" value="<?php echo $_SESSION['contact']; ?>" >
				
			</div>

			<input type="hidden" name="oids" value="<?php echo $ext ?>">
			<input type="hidden" name="total" value="<?php echo substr($total, 3);?>">
			<button id="continue" type="submit" name="continue" style="background-color: blue;float: right;">Continue</button>
			

		</form>
		<button id="goback" style="background-color: green;float: left;">Go Back</button>
		</div>

		<div class="checkbag">
	
			<h5 class="text-center">My Bag</h5>
			<div class="item">
				<table cellspacing="0" >

					<?php


						$q="SELECT food,quantity,total FROM `order` WHERE oid IN($ext)";

						$res = mysqli_query($con,$q);

						if(mysqli_num_rows($res)>0){
							while ($row = mysqli_fetch_assoc($res)) {

								echo" <tr > 
									<td style='width: 5%;'>".$row['quantity']."x</td>
									<td style='width: 60%;' >
										<span style='word-break: break-word;'>".$row['food']."</span>
									</td>
									<td style='width: 25%;'>".$row['total']."</td>
								</tr>
								";

							}
						}
						else{
							echo "Bag is Empty.";
						}

					?>
					<tr class="tr">
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;Subtotal</td>
						<td><?php echo substr($subtotal, 3);?></td>
					</tr>
					<tr class="tr">
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;Delivery Charge</td>
						<td>50</td>
					</tr>
					<tr class="tr">
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;Grandtotal</td>
						<td><?php echo substr($total, 3);?></td>
					</tr>
					
				</table>
				
			</div>
			
		</div>
		
	</section>
	
	<div id="br" style="clear: both;"></div>

	<br>
	<br>
	<br>
	<br>
	<div class="footer" >
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

			
			$("#asp").click(function(){
				$("#datetime").slideUp();

			});


			$("#ldt").click(function(){
				$("#datetime").slideDown();
			});

	});

</script>


<script type="text/javascript">
		function validate() {
			var form = document.getElementById('myform');
			var address = form.address.value;
			var addressdir = form.addressdir.value;
			var fullname = form.fullname.value;
			var contact = form.contact.value;

			var addressregex = /^[a-zA-Z0-9\s,.'-]{3,}$/;
			var nameregex = /^[a-zA-Z\s]{3,25}$/;
			var contactregex = /^[9][0-9]{9}$/;

			if(address==""||(/^\s*$/.test(address))){
				document.getElementById('adderror').innerHTML = "(Address is required.)";
				document.getElementById('adderror').style.display ="inline-block";
				document.getElementById('myform').address.focus();
				return false;
			}
			else{
				document.getElementById('adderror').style.display ="none";
			}

			if(addressdir==""||(/^\s*$/.test(addressdir))){
				document.getElementById('adddirerror').innerHTML = "(Address direction is required.)";
				document.getElementById('adddirerror').style.display ="inline-block";
				document.getElementById('myform').addressdir.focus();
				return false;
			}
			else{
				document.getElementById('adddirerror').style.display ="none";
			}


			if(document.getElementById('asp').checked == true){

			}
			else if(document.getElementById('ldt').checked == true){
				var d = document.getElementById("seldate");
				var t = document.getElementById("seltime");
				if((d.selectedIndex == 0)&&(t.selectedIndex == 0)) {
				     document.getElementById('dateerror').innerHTML = "(Please select a date.)";
				     document.getElementById('timeerror').innerHTML = "(Please select a time.)";
				     return false;
				}
				else{
					document.getElementById('dateerror').style.display ="none";
					document.getElementById('timeerror').style.display ="none";
				}
				
			}else{
				document.getElementById('asp').focus();
				return false;
			}


			if(fullname==""||(/^\s*$/.test(fullname))){
				document.getElementById('nameerror').innerHTML = "(Fullname  is required.)";
				document.getElementById('nameerror').style.display ="inline-block";
				document.getElementById('myform').fullname.focus();
				return false;
			}
			else{
				document.getElementById('nameerror').style.display ="none";
			}

			if(contact==""||(/^\s*$/.test(contact))){
				document.getElementById('contacterror').innerHTML = "(Contact No. is required.)";
				document.getElementById('contacterror').style.display ="inline-block";
				document.getElementById('myform').contact.focus();
				return false;
			}
			else{
				document.getElementById('contacterror').style.display ="none";
			}


			if(addressregex.test(address)===false){
				document.getElementById('adderror').innerHTML = "(Please write valid address.)";
				document.getElementById('adderror').style.display ="inline-block";
				document.getElementById('myform').address.focus();
				return false;
			}
			else{
				document.getElementById('adderror').style.display ="none";
			}

			if(addressregex.test(addressdir)===false){
				document.getElementById('adddirerror').innerHTML = "(Please write valid address direction.)";
				document.getElementById('adddirerror').style.display ="inline-block";
				document.getElementById('myform').addressdir.focus();
				return false;
			}
			else{
				document.getElementById('adddirerror').style.display ="none";
			}

			if(nameregex.test(fullname)===false){
				document.getElementById('nameerror').innerHTML = "(Length must be between 3 to 25 alphabetic characters.)";
				document.getElementById('nameerror').style.display ="inline-block";
				document.getElementById('myform').fullname.focus();
				return false;
			}
			else{
				document.getElementById('nameerror').style.display ="none";
			}

			if(contactregex.test(contact)===false){
				document.getElementById('contacterror').innerHTML = "(Please write valid contact number.)";
				document.getElementById('contacterror').style.display ="inline-block";
				document.getElementById('myform').contact.focus();
				return false;
			}
			else{
				document.getElementById('contacterror').style.display ="none";
			}

			return true;

}
</script>
<script type="text/javascript">
	document.getElementById("goback").addEventListener("click", function(){
		window.location="cart.php";
	});

	document.getElementById("cod").addEventListener("click", function(){
		document.getElementById("fullnam").value = '<?php echo $_SESSION['username']; ?>';
		document.getElementById("contac").value = '<?php echo $_SESSION['contact']; ?>';
		document.getElementById("fullnam").readOnly = true;
		document.getElementById("contac").readOnly = true;
	});

	document.getElementById("esewa").addEventListener("click", function(){
		document.getElementById("fullnam").readOnly = false;
		document.getElementById("contac").readOnly = false;
	});

</script>
</html>


