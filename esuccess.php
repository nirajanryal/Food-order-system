<?php
include('connect.php');

	if($_GET['payment'] == "success"){

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
	if($_GET['payment'] == "failed"){
		
		$oids = $_GET['oids'];

		$q = "UPDATE `order` SET `order-date`='',`status`='cart',`c-name`='',`c-contact`='',`c-address`='',`payment`='' WHERE oid IN ($oids)";

		$res = mysqli_query($con,$q);

		echo " 
		<!DOCTYPE html>
		 <html>
		 <head>
		 	<title>
		 		
		 	</title>
		 </head>
		 <body>
		 	<div>
			  	Transaction Failed!!! Please try again later.
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

?>