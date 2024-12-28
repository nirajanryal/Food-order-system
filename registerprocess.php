
<?php


	include('connect.php');
	if(isset($_POST['submit']) && ($_POST['submitvalue'] == 'user')){
		$firstname=mysqli_real_escape_string($con,$_POST['firstname']);
		$lastname=mysqli_real_escape_string($con,$_POST['lastname']);
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$contact=mysqli_real_escape_string($con,$_POST['contact']);
		$password=sha1($_POST['password']);


		$q="SELECT email FROM `userinfo` WHERE email='$email'";
		$res=mysqli_query($con,$q);

		if(mysqli_num_rows($res) > 0) {
			header('location:register.php?block=email');
			die();
		}
		$q="SELECT contact FROM `userinfo` WHERE contact='$contact'";
		$res=mysqli_query($con,$q);

		if(mysqli_num_rows($res) > 0) {
			header('location:register.php?block=contact');
			die();
		}

		$query="INSERT INTO `userinfo`( `firstname`, `lastname`,  `email`, `contact`,`password`) VALUES ('$firstname','$lastname'
                 ,'$email','$contact','$password')";

		$result=mysqli_query($con,$query);

		if(!$result){
			// die("cannot insert data");
			die(mysqli_error($con));
		}
		else{

			header('location:login.php?success=true');
		}
	}



?>