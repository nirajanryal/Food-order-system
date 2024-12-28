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
	<style type="text/css">
		#error-mssg{
			width: auto;
			height: 4vh;
			position: absolute;
			padding: 1.5% 1% 1% 1%;
			right: 1.5%;
			bottom: 2%;
			color: rgb(255,255,255,0.9);
			background-color: red;
			border-radius: 7px;
			transition: 0.4s;
		}

		.er{
			font-size: 13px;
			margin:0 2%;
			color: #ff2400;
			display: none;
		}
	</style>
</head>
<body bgcolor="#EEEEEE">

	<div class="text-center register-box">
		<div><a href="index.php"><img src="images/arrow.png" style="vertical-align: middle;height: 25px;"> Back to homepage</a></div>
		<br>
	
		<div class="register">
			<img src="images/logo.png" height="60px" width="70px" >
			<br><br>
			<h2>&nbsp;Welcome to Food Review</h2>
			<br>

			<form action="registerprocess.php" method="post" id="myform" onsubmit=" return validate()">

				<input type="text" name="firstname" placeholder=" Firstname" autofocus >
				<span class="er" id="fnameerror"></span><br>	

				<input type="text" name="lastname" placeholder=" Lastname" >
				<span class="er" id="lnameerror"></span><br>

				<input type="text" name="email" placeholder=" Email" >
				<span class="er" id="emailerror"></span><br>
				
				<input type="text" name="contact" placeholder=" Contact" >
				<span class="er" id="contacterror"></span><br>
				
				<input type="password" name="password"  id="password" placeholder=" Password"  >	
				<span class="er" id="passworderror"></span><br>

				<input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm" onkeyup="check()"><br>
				<span id="message" style="margin-left: 13px; font-size: 13px; "></span><br>

				<input type="submit" id="submit" name="submit" value="Create your account" >
				<input type="hidden" name="submitvalue" value="user">
				<br>
				
				
			</form>	

		</div>
		<br>

		<div style="font-size: 13px;">Already have an account?<a href="login.php">&nbsp;Log in here.</a></div>
		
	</div>

	
		<?php
			if (isset($_GET['block'])) {
				echo '<div id="error-mssg">';
			        $res=$_GET['block'];	

					if ($res == "email") {
					   echo "Email is already in use. Try another one.";
					}	
					if ($res == "contact") {
					   echo "Contact is already in use. Try another one.";
					}	
				echo '</div>';		
			}
		?>
	

	<script type="text/javascript">
		 function check() {
		  if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
		    document.getElementById('message').style.color = 'green';
		    document.getElementById('message').style.display ="inline-block";
		    document.getElementById('message').innerHTML = 'Password matched.';
		  } else {
		    document.getElementById('message').style.color = 'red';
		    document.getElementById('message').style.display ="inline-block";
		    document.getElementById('message').innerHTML = 'Password did not matched.';
		  }
		}
</script>
<script type="text/javascript">
		function validate() {

			var form = document.getElementById('myform');
			var fname = form.firstname.value;
			var lname = form.lastname.value;
			var email = form.email.value;
			var contact = form.contact.value;
			var password = form.password.value;
			var confirm = form.confirm.value;

			var fnameregex = /^[a-zA-Z]{3,10}$/;
			var lnameregex = /^[a-zA-Z]{3,10}$/;
			var emailregex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var contactregex = /^[9][0-9]{9}$/;
			var passregex = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

			if(fname==""||(/^\s*$/.test(fname))){
				document.getElementById('fnameerror').innerHTML = "*Firstname is required.";
				document.getElementById('fnameerror').style.display ="inline-block";
				form.firstname.focus();
				return false;
			}
			else{
				document.getElementById('fnameerror').style.display ="none";
			}


			if(lname=="" || (/^\s*$/.test(lname))){
				document.getElementById('lnameerror').innerHTML = "*Lastname is required.";
				document.getElementById('lnameerror').style.display ="inline-block";
				form.lastname.focus();
				return false;
			}
			else{
				document.getElementById('lnameerror').style.display ="none";
			}

			if(email=="" || (/^\s*$/.test(email))){
				document.getElementById('emailerror').innerHTML = "*Email is required.";
				document.getElementById('emailerror').style.display ="inline-block";
				form.email.focus();
				return false;
			}
			else{
				document.getElementById('emailerror').style.display ="none";
			}

			if(contact=="" || (/^\s*$/.test(contact))){
				document.getElementById('contacterror').innerHTML = "*Contact is required.";
				document.getElementById('contacterror').style.display ="inline-block";
				form.contact.focus();
				return false;
			}
			else{
				document.getElementById('contacterror').style.display ="none";
			}

			if(password=="" || (/^\s*$/.test(password))){
				document.getElementById('passworderror').innerHTML = "*Password is required.";
				document.getElementById('passworderror').style.display ="inline-block";
				form.password.focus();
				return false;
			}
			else{
				document.getElementById('passworderror').style.display ="none";
			}

			if(confirm=="" || (/^\s*$/.test(confirm))){
				document.getElementById('message').innerHTML = "*Confirmation Password is required.";
				document.getElementById('message').style.display ="inline-block";
				document.getElementById('message').style.color ="#ff2400";
				form.confirm.focus();
				return false;
			}
			else{
				document.getElementById('message').style.display ="none";
			}



			if(fnameregex.test(fname)===false){
				document.getElementById('fnameerror').innerHTML = "*Length must be between 3 to 10 alphabetic characters.";
				document.getElementById('fnameerror').style.display ="inline-block";
				form.firstname.focus();
				return false;
			}
			else{
				document.getElementById('fnameerror').style.display ="none";
			}

			if(lnameregex.test(lname)===false){
				document.getElementById('lnameerror').innerHTML = "*Length must be between 3 to 10 alphabetic characters.";
				document.getElementById('lnameerror').style.display ="inline-block";
				form.lastname.focus();
				return false;
			}else{
				document.getElementById('lnameerror').style.display ="none";
			}

			if(emailregex.test(email)===false){
				document.getElementById('emailerror').innerHTML = "*Email is invalid.";
				document.getElementById('emailerror').style.display ="inline-block";
				form.email.focus();
				return false;
			}else{
				document.getElementById('emailerror').style.display ="none";
			}

			if(contactregex.test(contact)===false){
				document.getElementById('contacterror').innerHTML = "*Contact No. is invalid.";
				document.getElementById('contacterror').style.display ="inline-block";
				form.contact.focus();
				return false;
			}else{
				document.getElementById('contacterror').style.display ="none";
			}

			if(passregex.test(password)===false){
				document.getElementById('passworderror').innerHTML = "*Password must be at least 8 characters long and contain a number, an uppercase, a lowercase and a speical character.";
				document.getElementById('passworderror').style.display ="inline-block";
				form.password.focus();
				return false;
			}else{
				document.getElementById('passworderror').style.display ="none";
			}

			if(password != confirm){
				document.getElementById('message').style.color = 'red';
				document.getElementById('message').style.display ="inline-block";
		    	document.getElementById('message').innerHTML = 'Password did not matched.';
		    	return false;
			}
			return true;

		}
		
	</script>
	<?php
		if (isset($_GET['block'])) {
			echo"
				<script type='text/javascript'>
					
					window.setTimeout('closeDiv();', 4000);
					function closeDiv() {
						document.getElementById('error-mssg').style.display ='none';
					}
				</script>
				";
			}
	?>

</body>
</html>

