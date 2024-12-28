<?php 
	include('connect.php'); 
	session_start();
	

if(isset($_POST['food'])){
	$food=$_POST['food'];
	$email=$_POST['email'];

	$q = "SELECT firstname,lastname,food,review,`date` FROM review, userinfo WHERE food='$food' AND userinfo.uid=review.userid";

	$res = mysqli_query($con,$q);

	 echo"<div class='review'>

				<p style='margin-bottom: 5px;'' class='reviewtitle'>".$food." </p>

				";
    
    if(mysqli_num_rows($res)>0){
    
       
				while ($row = mysqli_fetch_assoc($res)) {
					echo"<div>
						<span><b>".$row['firstname']." ".$row['lastname']."</b></span>
						<p><i>".$row['review']."</i></p>
						<span style='float: right;'>".$row['date']." &nbsp;</span>

						<br>
					</div>

					";

				}

				
        
    }
    else{
    	echo "<label><i>No Reviews Yet.</i></label>";
    }

    echo"</div>";

    $q = "SELECT * FROM `order` WHERE status='delivered' AND email='$email' AND food='$food'";


    $res = mysqli_query($con,$q);

    if(mysqli_num_rows($res)>0){


				echo"<div id='ureview' >
					<textarea placeholder='Write a review.' class='reviewtext'></textarea>
					<img src='images/submit.png' class='sendreview' style='float: right;position: absolute;margin-top: 20px; vertical-align: middle;
					margin-left: 5px;'>
				</div>
				";
    }
    else{

    	echo"<div id='ureview' >
					<textarea placeholder='Food can be reviewed once delivered.'  disabled style='width:275px;'></textarea>
					
				</div>
				";
    }
}
?>