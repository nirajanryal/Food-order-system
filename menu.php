<?php
include('connect.php');
include('recommendation-user-based.php');
include('recommendation-content-based.php');
session_start();

?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		function scrollCarouselLeft() {
			document.getElementById('carousel').scrollBy({ left: -350, behavior: 'smooth' });
		}

		function scrollCarouselRight() {
			document.getElementById('carousel').scrollBy({ left: 350, behavior: 'smooth' });
		}
	</script>

</head>

<body>
	<div class="addcart" id="addcart">
		<div class="addcartitem" id="addcartitem">
			<button id="close">x</button>
			<p class="cart_title"> </p>
			<br>
			<p class="cart_price" style="font-size: 25px;opacity: 0.8;"></p>
			<br>
			<hr>
			<br>
			<span>Special Instructions</span>
			<br>
			<textarea placeholder="Add notes." id="instruct"></textarea>
			<br>
			<div id="quantity">
				<button id="decrease"> - </button>
				<input type="number" name="" disabled id="food-quantity">
				<button id="increase"> + </button>

				<button id="submit">
					<p>Add to Bag
						<span id="total" style="padding-left: 80px;">

						</span>
					</p>
				</button>
			</div>
		</div>
	</div>

	<div class="rating-modal" id="ratingModal" data-fid="">
		<div class="modal-content">
			<span class="close-btn">&times;</span>
			<h2>Rate This Item</h2>
			<div class="star-rating" id="starRating">
				<span class="star" data-value="1">&#9733;</span>
				<span class="star" data-value="2">&#9733;</span>
				<span class="star" data-value="3">&#9733;</span>
				<span class="star" data-value="4">&#9733;</span>
				<span class="star" data-value="5">&#9733;</span>
			</div>
			<p id="selectedRating">Selected Rating: None</p>
			<button id="submitRating">Submit Rating</button>
		</div>
	</div>

	<section class="header">
		<nav style="height: 7vh ; box-shadow: none;">
			<a href="index.php"><img src="images/logo.png"></a>
			<div class="nav-links">
				<ul>
					<li><a href="index.php">HOME</a> </li>
					<li><a href="menu.php">MENU</a> </li>
					<?php
					if (!isset($_SESSION['email'], $_SESSION['username'])) {
						echo "<li><a href='login.php'>LOGIN</a> </li>
							<li><a href='register.php' >REGISTER</a> </li>";
					} else {
						echo "<li><a href='cart.php'>BAG</a> </li>";
						echo "<li><a href='account.php'>MY ACCOUNT</a> </li>";
						echo "<li><a href='logout.php'>LOGOUT</a> </li>";
					}
					?>
				</ul>

			</div>
		</nav>

	</section>

	<section class="menubody">
		<div class="menubox">
			<img src="images/banner1.jpg">
			<div class="search">
				<input type="text" name="search" id="search" placeholder="Search Menu Items">
				<input type="button" name="searchbtn" value="Search" id="searchbtn">

			</div>


		</div>


		<div class="menulist">
			<div id="menu-header">
				<span id="span1">Categories</span>
				<span id="span2">Food Items</span>
				<span id="span3"></span>
			</div>
			<div class="category-list">
				<div>

					<?php

					$q = "SELECT cid,title FROM category WHERE active='Yes'";
					$res = mysqli_query($con, $q);

					if (mysqli_num_rows($res) > 0) {

						while ($row = mysqli_fetch_assoc($res)) {
							echo "<button class='categorybtn'>" . $row['title'] . "</button>";
						}
					} else {
						echo "No category found.";
					}

					?>
				</div>


				<?php
				if (isset($_SESSION['userid'])) {
					$userId = $_SESSION['userid'];
					$email = $_SESSION['email'];
					getRecommendations($userId, $con);

					$q = "SELECT food.fid, food.title, food.description, food.image_name, food.price 
							FROM recommendations 
							JOIN food ON recommendations.fid = food.fid 
							WHERE recommendations.uid = $userId 
							ORDER BY recommendations.score DESC 
							LIMIT 8";
					$res = mysqli_query($con, $q);

					// echo "<div class='recommendedfood'>
					// <br>
					// <p>Recommended Food for You</p>";
				
					if (mysqli_num_rows($res) > 0) {
						echo "<div class='recommendedfood'>
					<br>

					<p>You may also Like</p>";
						while ($row = mysqli_fetch_assoc($res)) {
							$description = substr($row['description'], 0, 70) . "...";
							echo "
								<div class='rfood'>
									<img src='food/" . $row['image_name'] . "' alt='" . $row['title'] . "'>
									<p class='title'>" . $row['title'] . "</p>
									<span>" . $description . "</span>
									<p class='price'>Rs " . $row['price'] . "</p>
									<button class='addbagbtn'>Add to Bag</button>
								</div>";
						}
						echo "</div>";

					}

					// recommend using content based algorithm
				

					?>


				</div>

				<div class="food-list">

					<?php

					if (isset($_POST['searchqbtn'])) {

						$search = mysqli_real_escape_string($con, $_POST['searchq']);

						echo "<br><p style='margin-left: 17px;'>Search Result for  \" " . $search . " \" </p>";
						$q = "SELECT fid,title,description,price,image_name FROM food WHERE active='Yes' AND title LIKE '%$search%' OR description LIKE '%$search%' ";

					} elseif (isset($_GET['category'])) {

						$c = $_GET['category'];

						$q = "SELECT fid,title,description,price,image_name FROM food WHERE active='Yes' AND category_id='$c' ORDER BY title";
					} else {

						$q = "SELECT fid,title,description,price,image_name FROM food WHERE active='Yes' ORDER BY title ";
					}
					$res = mysqli_query($con, $q);

					if (mysqli_num_rows($res) > 0) {

						while ($row = mysqli_fetch_assoc($res)) {
							$food_id = $row['fid'];
							$food_title = $row['title'];
							$user_has_ordered = false;

							if (isset($_SESSION['email'])) {
								$email = $_SESSION['email'];
								$order_check_q = "SELECT * FROM `order` WHERE email='$email' AND food='$food_title'";
								$order_check_res = mysqli_query($con, $order_check_q);
								if (mysqli_num_rows($order_check_res) > 0) {
									$user_has_ordered = true;
								}
							}

							$rating_q = "SELECT AVG(rating) as avg_rating FROM user_ratings WHERE fid='$food_id'";
							$rating_res = mysqli_query($con, $rating_q);
							$rating_row = mysqli_fetch_assoc($rating_res);
							$avg_rating = $rating_row['avg_rating'] ? round($rating_row['avg_rating'], 1) : 0;

							echo "<div class='food-items'>
									<h6 class='title'>" . $row['title'] . "</h6>
									<div class='divimage'>
										<img src='food/" . $row['image_name'] . "'>
									</div>
									<div class='divdesc'>" . $row['description'] . "</div>
									<div class='divprice'>
										<span class='price'>Rs " . $row['price'] . "</span>&nbsp;&nbsp;
										<a  class='cart'><img src='images/cart.png '></a>
									</div>
									<span class='average-rating'>Rating - <span class='ratingno'>" . $avg_rating . " </span></span>";

							if ($user_has_ordered) {
								echo "
										<span class='user-rate rate-yourself-btn' data-fid='" . $food_id . "'>Rate Item</span>";

							}
							echo "
									<button class='reviewbtn'><img src='images/review.png' style='height: 20px;'></button>
									
									<br>
								</div>";
						}
					} else {
						echo "<p style='margin-left: 17px;'>No food found.</p>";
					}

					?>


				</div>

				<br>
				<div class="reviewbox" >
					<div class="reviewboxdiv" ></div>

					<?php
					$recommendations = recommendFoodForUser($email, $con, 0.5, 5, 0.25);

					echo "<p>Recommended Food for You</p>";

					if (empty($recommendations)) {
						echo "<p>No recommendations available.</p>";
					} else {
						echo "
							<div style='position: relative; width: 100%; overflow: hidden;'>
								<div class='recommendedfood' id='carousel' style='display: flex; overflow-x: hidden; scroll-behavior: smooth;'>
							";
						foreach ($recommendations as $recommendation) {
							echo "
								<div class='rfood' style='min-width: 200px; flex-shrink: 0; padding: 10px; margin: 5px'>
									<img src='food/" . $recommendation['image'] . "' alt='" . $recommendation['title'] . "' style='width: 280px; height: 200px;'>
									<p class='title'>" . $recommendation['title'] . "</p>
									<span>" . $recommendation['description'] . "</span>
									<p class='price'>Rs " . $recommendation['price'] . "</p>
									<button class='addbagbtn'>Add to Bag</button>
								</div>
							";
						}
						echo "
							</div>
							<div style='display: flex; justify-content: center; margin-top: 10px;'>
								<button onclick='scrollCarouselLeft()' style='background-color: rgba(0,0,0,0.5); color: white; border: none; padding: 20px 20px; margin: 0 5px; cursor: pointer; border-radius: 50%;'>⟵</button>
								<button onclick='scrollCarouselRight()' style='background-color: rgba(0,0,0,0.5); color: white; border: none; padding: 20px 20px; margin: 0 5px; cursor: pointer; border-radius: 50%;'>⟶</button>
							</div>
						</div>";

					}
				}
				?>

			</div>


		</div>

		<form>
			<input type="hidden" name="foodtitle" value="" id="foodtitle">
			<input type="hidden" name="instruction" value="" id="instruction">
			<input type="hidden" name="quant" value="" id="quant">
			<input type="hidden" name="pric" value="" id="pric">
			<input type="hidden" name="totalamount" value="" id="totalamount">
		</form>

	</section>
	<br>
	<br>
	<br>

	<div id="cartmsg">

	</div>
	<div style="clear: both;"></div>
	<div class="footer">
		<br>
		<div class="wrap text-center">

			<a href="">Sitemap</a>|
			<a href="">Privacy Policy</a>|
			<a href="">Terms of Use</a>|
			<a href="">Terms and Conditions</a>

			<br><br>
			<a href=""> <img src="images/facebook.png"></a>
			<a href=""> <img src="images/instagram.png"></a>
			<a href=""> <img src="images/twitter.png"></a>
			<a href=""> <img src="images/github.png"></a>
			<a href=""> <img src="images/google.png"></a>



			<br><br>
			Copyright © 2021 Yummy Food Inc. All Rights Reserved.

		</div>
	</div>

</body>
<script src="js/jquery-3.6.0.min.js"></script>


<script>
	$(document).ready(function () {
		$('#close').click(function () {
			$('.addcart').fadeOut();
			$('.addcartitem').slideUp('fast');
			$('#quantity').find('#food-quantity').val(1);
			$('#instruction').val('');
			$('#instruct').val('');

		});

		$(document).on("click", ".cart", function () {

			var email = "<?php echo isset($_SESSION['email']); ?>";
			var username = "<?php echo isset($_SESSION['username']); ?>";

			if (email == "" && username == "") {

				window.location = "login.php";

			} else {
				$('.addcart').show();
				$('.addcartitem').show();

				$count = 1;

				var a = $(this).parent().find('.price').html();
				var b = $(this).parent().parent().find('.title').html();

				var p = a.substr(3, 5);

				$('.addcartitem').find('.cart_title').html(b);
				$('#foodtitle').val(b);
				$('.addcartitem').find('.cart_price').html(a);
				$('#quantity').find('#total').html(a);
				$('#quantity').find('#food-quantity').val(1);

				$('#quant').val(1);
				$('#totalamount').val(a);
				$('#pric').val(a);

			}

		});

		$(document).on("click", ".addbagbtn", function () {

			var email = "<?php echo isset($_SESSION['email']); ?>";
			var username = "<?php echo isset($_SESSION['username']); ?>";

			if (email == "" && username == "") {

				window.location = "login.php";

			} else {
				$('.addcart').show();
				$('.addcartitem').show();

				$count = 1;

				var a = $(this).parent().find('.price').html();
				var b = $(this).parent().find('.title').html();

				var p = a.substr(3, 5);

				$('.addcartitem').find('.cart_title').html(b);
				$('#foodtitle').val(b);
				$('.addcartitem').find('.cart_price').html(a);
				$('#quantity').find('#total').html(a);
				$('#quantity').find('#food-quantity').val(1);

				$('#quant').val(1);
				$('#totalamount').val(a);
				$('#pric').val(a);

			}

		});

		$('#decrease').click(function () {


			var a = $(this).parent().parent().find('.cart_price').html();
			var p = a.substr(3, 5);

			var $c = $(this).parent().find('#food-quantity');

			var amount = Number($c.val());

			if (amount > 1) {
				var g = $c.val(amount - $count);
				var h = p * (amount - $count);

				var $d = $(this).parent().find('#total');

				$d.html('Rs ' + h);

				$('#quant').val($c.val());

				$('#totalamount').val('Rs ' + h);

			}

		});

		$('#increase').click(function () {

			var a = $(this).parent().parent().find('.cart_price').html();
			var p = a.substr(3, 5);

			var $c = $(this).parent().find('#food-quantity');

			var amount = Number($c.val());

			var g = $c.val(amount + $count);

			var h = p * (amount + $count);

			var $d = $(this).parent().find('#total');

			$d.html('Rs ' + h);

			$('#quant').val($c.val());

			$('#totalamount').val('Rs ' + h);



		});


		$('#instruct').keyup(function () {

			$('#instruction').val($('#instruct').val());
		});



		$('#submit').click(function () {
			var foodtitle = $('#foodtitle').val();
			var instruction = $('#instruction').val();
			var quant = $('#quant').val();
			var pric = $('#pric').val();
			var totalamount = $('#totalamount').val();

			$('.addcart').fadeOut();
			$('.addcartitem').fadeOut('fast');
			$('#instruction').val('');
			$('#instruct').val('');

			$.ajax({
				type: 'POST',
				url: 'add-cart.php',
				data: {
					foodtitle: foodtitle,
					instruction: instruction,
					quant: quant,
					pric: pric,
					totalamount: totalamount
				},
				cache: false,

				success: function (data) {

					$('#cartmsg').text(data);
					$('#cartmsg').show('fast');
					$('#cartmsg').delay(2000);
					$('#cartmsg').hide(500);

				},

				error: function (xhr, status, error) {
					console.error(xhr);
				}
			});


		});


		$(".categorybtn").click(function () {
			$(".categorybtn").css("font-weight", "normal");
			var a = $(this).html();
			$(this).css("font-weight", "bold");

			$(".reviewbox").hide();

			$.ajax({
				type: 'POST',
				url: 'get-food.php',
				data: {
					food: a
				},
				cache: false,

				success: function (data) {

					$('.food-list').html(data);

				},

				error: function (xhr, status, error) {
					console.error(xhr);
				}
			});
		});


		$("#searchbtn").click(function () {
			$(".reviewbox").hide();
			var a = $("#search").val();
			if (a == "") {

			} else {

				$.ajax({
					type: 'POST',
					url: 'search.php',
					data: {
						searchquery: a
					},
					cache: false,

					success: function (data) {

						$('.food-list').html(data);

					},

					error: function (xhr, status, error) {
						console.error(xhr);
					}
				});
			}
		});


		$(document).on("click", ".reviewbtn", function () {

			<?php

			if (isset($_SESSION['email']))
				echo "var email ='" . $_SESSION['email'] . "';";
			else
				echo "var email ='email';";
			?>


			$(".reviewboxdiv").show();
			$("#span3").html("Review");
			var b = $(this).parent().find('.title').html();

			$.ajax({
				type: 'POST',
				url: 'get-review.php',
				data: {
					food: b,
					email: email
				},
				cache: false,

				success: function (data) {

					$(".reviewboxdiv").html(data);

				},

				error: function (xhr, status, error) {
					console.error(xhr);
				}
			});


		});


		$(document).ready(function () {
			$('.rate-yourself-btn').on('click', function () {
				const fid = $(this).data('fid');
				$('#ratingModal').data('fid', fid).show();
			});

			$('.close-btn').on('click', function () {
				$('#ratingModal').hide();
			});

			$(window).on('click', function (event) {
				if ($(event.target).is('#ratingModal')) {
					$('#ratingModal').hide();
				}
				if ($(event.target).is('#addcart')) {
					$('#addcart').hide();
				}
			});

			$('#starRating').on('click', '.star', function () {
				const rating = $(this).data('value');
				$('#starRating .star').each(function () {
					$(this).toggleClass('filled', $(this).data('value') <= rating);
				});
				$('#selectedRating').text('Selected Rating: ' + rating + ' Star' + (rating > 1 ? 's' : ''));
			});

			$('#submitRating').on('click', function () {
				const rating = $('#starRating .star.filled:last').data('value');
				if (rating) {
					// alert('Rating Submitted: ' + rating + ' Stars');
					const fid = $('#ratingModal').data('fid');
					// alert(fid)

					$.ajax({
						type: 'POST',
						url: 'store-rating.php',
						data: {
							rating: rating,
							userid: <?php echo $_SESSION['userid'] ?>,
							fid: fid
						},
						cache: false,

						success: function (data) {

							$('#ratingModal').hide();
							$('#cartmsg').text(data);
							$('#cartmsg').show('fast');
							$('#cartmsg').delay(2000);
							$('#cartmsg').hide(500);
							console.log(data)

						},

						error: function (xhr, status, error) {
							console.error(xhr);
						}
					});
				} else {
					alert('Please select a rating before submitting.');
				}
			});
		});


		<?php
		if (isset($_SESSION['email']))
			echo "
						$(document).on('click','.sendreview',function(){

							var a = $('.reviewtext').val();
							a=a.replace(/(\\r\\n|\\n|\\r|<|>|;|\"|{|})/gm, '');
							var regex = /^[a-zA-Z0-9\s,.'\-:&@]{2,}$/;
							var userid = " . $_SESSION['userid'] . ";

							var food = $(this).parent().parent().find('.reviewtitle').html();

							if(regex.test(a)===false){
								
							}else{
								
								$.ajax({
								type:'POST',
								url:'send-review.php',
								data:{
									review:a,
									userid:userid,
									food:food
								},
								cache:false,
								
								success: function (data) {

									$('.review label').hide();
				        			$('.review').append(data);
				        			$('.reviewtext').val('');

				    			},
								
								 error: function(xhr, status, error) {
				                    console.error(xhr);
				                }
								});
							}

						});

						";
		?>


	});


</script>


<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>




</html>