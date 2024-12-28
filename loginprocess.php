<?php
	
	session_start();
	include('connect.php');

if(isset($_POST['email'],$_POST['password'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);

	$password=sha1($_POST['password']);


		$q="SELECT uid,firstname, lastname, email ,password,contact FROM `userinfo` WHERE email='$email' AND password='$password'";

		$res=mysqli_query($con,$q);

		if ($res) {

			if (mysqli_num_rows($res) == 1) {

				$row=mysqli_fetch_assoc($res);

				$_SESSION['email']=$row['email'];

				$_SESSION['username']=$row['firstname']." ".$row['lastname'];

				$_SESSION['userid'] = $row['uid'];
				
				$_SESSION['contact'] = $row['contact'];

				if(isset($_SESSION['url'])){

					header('location:'.$_SESSION['url']);

				}else{

					header('location:menu.php');
				}

			}else{

				header('location:login.php?success=invalid');

				die();
			}
		}
	}

		
		
?>