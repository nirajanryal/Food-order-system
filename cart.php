<?php 
	
	session_start();
	if(!isset($_SESSION['username'],$_SESSION['email'],$_SESSION['userid'])){
		$_SESSION['url'] = "cart.php";
		header('location:login.php');
		die();
	}
	include('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body bgcolor="#EEEEEE">
	
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

	<section class="cartbody">
		<div class="cart-container">
			<h6>My Food Bag</h6>
			<div class="cart-table">
				<table>
					<th style="width: 45%">Item</th>
					<th style="width: 20%">Quantity</th>
					<th style="width: 10%">Price</th>
					<th style="width: 8%">Remove</th>
					<th style="width: 12%">Total</th>

					<?php
						
					$email = $_SESSION['email'];

					$q = "SELECT order.oid, order.food, order.price, order.quantity, order.total, order.instruction, food.image_name,food.description FROM `order` LEFT JOIN food ON order.food = food.title WHERE email ='$email' AND status='cart' ORDER BY order.oid DESC";

					$res = mysqli_query($con,$q);

					if(mysqli_num_rows($res)>0){

						$oidlist = array();

	                    while ($row = mysqli_fetch_assoc($res)) {

	                    	$oid = $row['oid'];
	                        $food = $row['food'];
	                        $image_name = $row['image_name'];
	                        $price = $row['price'];
	                        $quantity = $row['quantity'];
	                        $total = $row['total'];
	                        if($row['instruction']!=''){
	                        	$instruction = $row['instruction'];
	                        }else{
	                        	$instruction = "Special Notes not added.";
	                        }
	                        
	                        $description = $row['description'];

	                        array_push($oidlist, $oid);

					
							echo"<tr >
								<td>
									<img src='food/$image_name'>
									<div class='cartdesc'>
										<h5><span>$food</span></h5>
										<p>$description</p>
										<p><i><span>NOTE : </span>$instruction</i></p>

									</div>
								</td>
								<td>
									<div class='cartchange text-center'>
										<input type='hidden' value='$oid'  class='oid'>
										<input type='hidden' value='$price' class='price'>
										<button class='decrease' style='background-color: purple;'> - </button>
										<input type='text' name='quantity' class='quantity' value='$quantity' disabled>
										<button class='increase' style='background-color: grey;'> + </button>
									</div>
								</td>
								<td class='text-center'>Rs ".$price."</td>
								<td class='text-center'> 
									<button '><a href='remove.php?oid=$oid' style='text-decoration:none; color:red;font-weight:bold;'> x </a></button>
								</td>
								<td class='text-center'>Rs <span class='totalp'>".$total."</span></td>
							</tr>";
						}
					}else{
						echo "
	                        <tr>
	                        <td colspan=5 class='text-center'>No Food Added.</td>
	                        </tr>
	                    ";
					}

					?>
				</table>

				<?php
				if(mysqli_num_rows($res)>0){
					echo '<div class="grand">
						<table >
							<td style="width:42%"><i>Minimum Order should exceed Rs 500.</i></td>
							<td style="width:15%" class="tdshow">Delivery 
								<input type="text" name="" id="delivery" value="Rs 50"disabled="">
							</td>
							<td style="width:1%"></td>
							<td style="width: 15%" class="tdshow">Subtotal
								<input type="text" name="" id="subtotal" disabled="">
							</td>
							<td style="width:1%"></td>
							<td style="width: 15%" class="tdshow">Total
								<input type="text" name="" id="grandtotal" disabled="">
							</td>

							
						</table>

					

				</div>';} ?>
				<form>
					<input type="hidden" name="new-quantity" id="new-quantity">
					<input type="hidden" name="new-total" id="new-total">
					<input type="hidden" name="oid" id="oid">

				</form>
				<br>
				<form action="checkout.php" method="POST">
					<input type="hidden" name="oidlist" value="<?php foreach($oidlist as $key => $value) echo $value."," ; ?>">
					<input type="hidden" name="subtotal" id="stotal" value="">
					<input type="hidden" name="total" id="ttotal" value="">
					<?php
						if(mysqli_num_rows($res)>0){
					echo'<button id="checkout" > Checkout</button>';
				}
				?>
				</form>

			</div>
			
		</div>
	</section>

</body>

<script src="js/jquery-3.6.0.min.js"></script>

<script>

	$(document).ready(function(){
			$(".increase").click(function(){

				var $c = $(this).parent().find(".quantity");

				var q = Number($c.val());

				var g = $c.val(q+1);

				$("#new-quantity").val(g.val());

				var $p = $(this).parent().find(".price");

				var amount = Number($p.val());

				var h = amount*(q+1);
			
				var a = $(this).parent().parent().parent().find(".totalp").html(h);

				 $("#new-total").val(h);

				 var k = $(this).parent().find(".oid").val();

				 $("#oid").val(k);


				var newquantity = $('#new-quantity').val();
				var newtotal = $('#new-total').val();
				var oid = $('#oid').val();


				$.ajax({
					type:'POST',
					url:'update-cart.php',
					data:{
						newquantity:newquantity,
						newtotal:newtotal,
						oid:oid
					},
					cache:false,

					success: function (data) {

	        			document.getElementById('subtotal').value = "Rs "+data;
	        			if(parseInt(data)>=500){
	        					document.getElementById('checkout').disabled=false;
	        				}else{
	        					document.getElementById('checkout').disabled=true;
	        				}
	        			document.getElementById('stotal').value = "Rs "+data;
	        			var dat = parseInt(data)+50;
	        			document.getElementById('grandtotal').value = "Rs "+dat;
	        			document.getElementById('ttotal').value = "Rs "+dat;

	    			},
					
					 error: function(xhr, status, error) {
	                    console.error(xhr);
	                }
				});

			});

			$(".decrease").click(function(){

				var $c = $(this).parent().find(".quantity");

				var q = Number($c.val());

				if (q > 1) {

					var g = $c.val(q-1);

					$("#new-quantity").val(g.val());

					var $p = $(this).parent().find(".price");

					var amount = Number($p.val());

					var h = amount*(q-1);
				
					var a = $(this).parent().parent().parent().find(".totalp").html(h);

					$("#new-total").val(h);

					var k = $(this).parent().find(".oid").val();

					$("#oid").val(k);


					var newquantity = $('#new-quantity').val();
					var newtotal = $('#new-total').val();
					var oid = $('#oid').val();


					$.ajax({
						type:'POST',
						url:'update-cart.php',
						data:{
							newquantity:newquantity,
							newtotal:newtotal,
							oid:oid
						},
						cache:false,

						success: function (data) {

	        				document.getElementById('subtotal').value = "Rs "+data;
	        				if(parseInt(data)>=500){
	        					document.getElementById('checkout').disabled=false;
	        				}else{
	        					document.getElementById('checkout').disabled=true;

	        				}
	        				document.getElementById('stotal').value = "Rs "+data;
	        				var dat = parseInt(data)+50;
	        				document.getElementById('grandtotal').value = "Rs "+dat;
	        				document.getElementById('ttotal').value = "Rs "+dat;

		    			},
						
						 error: function(xhr, status, error) {
		                    console.error(xhr);
		                }
					});

				}

			});

			var a= 0;
			$(".totalp").each(function(){
				var value = parseInt($(this).html());
				var sum = a + value;
				a=sum;			

			});
			$("#subtotal").val("Rs "+a);
			$("#stotal").val("Rs "+a);
			var b = a+50;
			$("#grandtotal").val("Rs "+b);
			$("#ttotal").val("Rs "+b);

			if(parseInt(a)<=500){
				document.getElementById('checkout').disabled=true;
			}else{
				document.getElementById('checkout').disabled=false;
			}

		});

</script>


</html>


						