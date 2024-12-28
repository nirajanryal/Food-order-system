<?php
		
	session_start();
	

	include('connect.php');

	if(isset($_POST['page'])){

		$page = $_POST['page'];

		if($page=="index"){

			$foodtitle = $_POST['foodtitle'];
			$price = substr($_POST['price'],3);
			$email = $_SESSION['email'];

			$q = " INSERT INTO `order`( `food`, `price`, `quantity`, `total`, `instruction`,`email`) VALUES ('$foodtitle','$price',1,'$price','','$email')";

			$res = mysqli_query($con,$q);

			if($res){

				echo" Item Added to Cart.";

			}else{

				echo" Unable to Add Item.";
			}
		}
	}

	else{

		$foodtitle = $_POST['foodtitle'];
		$instruction = mysqli_real_escape_string($con,$_POST['instruction']);
		$quant = $_POST['quant'];
		$pric = substr($_POST['pric'],3);
		$totalamount = substr($_POST['totalamount'],3);
		$email = $_SESSION['email'];

		$q = " INSERT INTO `order`( `food`, `price`, `quantity`, `total`, `instruction`,`email`) VALUES ('$foodtitle','$pric','$quant','$totalamount','$instruction','$email')";

		$res = mysqli_query($con,$q);

		if($res){

			echo" Item Added to Cart.";

		}else{

			echo" Unable to Add Item.";
		}

	}

  ?>