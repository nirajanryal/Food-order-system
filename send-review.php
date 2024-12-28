 <?php 
	include('connect.php'); 
	session_start();
	

if(isset($_POST['review'],$_POST['food'],$_POST['userid'])){
	$review=mysqli_real_escape_string($con, $_POST['review']);

	$review = str_replace(array("\\n", "\\r"), ' ', $review);

	$review = preg_replace(array('/\s{2,}/'), ' ', $review);

	$userid = $_POST['userid'];

	$food = $_POST['food'];

	date_default_timezone_set("Asia/Dhaka");
	$date = date("Y-m-d"); 
	

	$q = "INSERT INTO `review`(`userid`, `food`, `review`, `date`) VALUES ('$userid','$food','$review','$date')";

	$res = mysqli_query($con,$q);
    
   if($res){

   	$q="select firstname,lastname from userinfo where uid=$userid";
   	$ress = mysqli_query($con,$q);
   	$row = mysqli_fetch_assoc($ress);
   	echo"<div>
			<span><b>".$row['firstname']." ".$row['lastname']."</b></span>
			<p><i>".str_replace(array("\\"), '', $review)."</i></p>
			<span style='float: right;'>".$date." &nbsp;</span>

			<br>
		</div>

		";

   }

   else{
   	echo "<script>alert('cannot submit review.Please try again.');</script> ";
   }
}
?>