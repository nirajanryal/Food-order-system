<?php 
	include('connect.php'); 
	session_start();
	

if(isset($_POST['searchquery'])){
	$search=mysqli_real_escape_string($con, $_POST['searchquery']);

	$q = "SELECT fid,title,description,price,image_name FROM food WHERE active='Yes' AND title LIKE '%$search%' OR description LIKE '%$search%' ";

	$res = mysqli_query($con,$q);
    
    if(mysqli_num_rows($res)>0){
    
        while ($row = mysqli_fetch_assoc($res)) {
    
        	echo"<div class='food-items'>
	
				<h6 class='title'>".$row['title']."</h6>
	
				<div class='divimage'>
	
					<img src='food/".$row['image_name']."'>
	
				</div>
	
				<div class='divdesc'>".$row['description']."</div>
	
				<div class='divprice'>
	
					<span class='price'>Rs ".$row['price']."</span>&nbsp;&nbsp;
	
					<a  class='cart'><img src='images/cart.png '></a>
	
				</div>
				
					<button class='reviewbtn'><img src='images/review.png' style='height: 20px;'></button>
	
				<br>
	
			</div>";
        }
    }
    else{
    	echo "<br>No food found.";
    }
}
?>