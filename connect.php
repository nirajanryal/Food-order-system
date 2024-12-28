<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodorder";

$con=mysqli_connect("$servername","$username","$password","$dbname");

		if (!$con) {
			die("cannot connect to database");
		}

?>