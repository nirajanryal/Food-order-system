<?php
	session_start();
	if(!isset($_SESSION['username'],$_SESSION['email'],$_SESSION['userid'])){
		header('location:login.php');
		die();
	}
include('connect.php');

if(isset($_POST['continue'])){

	$address = $_POST['address']."-".$_POST['addressdir'];
	$schedule = $_POST['schedule'];
	if($schedule!="asp"){
		$date = $_POST['seldate']."  ".$_POST['seltime'];
	}

	if($schedule=="asp"){

		date_default_timezone_set("Asia/Dhaka");
		$date = date("Y-m-d h:i:sa"); 
		$date = strtotime($date);
		$date = strtotime("-15 minute", $date);

		$date = date('Y-m-d h:i:sa', $date);
	}

	$fullname = $_POST['fullname'];
	$contact = $_POST['contact'];
	$oids = $_POST['oids'];
	$total = $_POST['total'];

	if($_POST['paychoice'] == "cod"){

		$q = "UPDATE `order` SET `order-date`='$date',`status`='ordered',`c-name`='$fullname',`c-contact`='$contact',`c-address`='$address',`payment`='cod' WHERE oid IN ($oids)";

		$res = mysqli_query($con,$q);

		if($res){

			echo " 
			<!DOCTYPE html>
			 <html>
			 <head>
			 	<title>
			 		
			 	</title>
			 </head>
			 <body>
			 	<div style='width: 100%;height: 50vh; text-align: center;margin-top: 120px;'>
				  	<img src='images/orderplaced.webp' style='border: 1px solid black;'>
				  	<br>
				  	<p>Your order has been placed successfully. Please check your order history for order status.</p>
				  	<br>
				  	<br>
				  	<br>
				  	<p>Redirecting to Menu...</p>
			 	</div>

			 	<script type='text/javascript'>
			 		setTimeout(function () {    
					    window.location.href = 'menu.php'; 
					},5000);
			 	</script>
			 
			 </body>
			 </html>
			 ";
		}
		else{
			echo "<script>alert('Checkout Failed')</script>";
			header('location:cart.php');
		}
	}
	if($_POST['paychoice'] == "esewa"){

		$q = "UPDATE `order` SET `order-date`='$date',`status`='ordered',`c-name`='$fullname',`c-contact`='$contact',`c-address`='$address',`payment`='esewa' WHERE oid IN ($oids)";

		$res = mysqli_query($con,$q);

		header("location:esewaform.php?oid=$oids&total=$total");
	}
}

?>