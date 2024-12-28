<?php 
	include('connect.php'); 
	session_start();
	

if(isset($_POST['start'],$_POST['end'],$_SESSION['email'])){
	$start = $_POST['start'];
	$end = $_POST['end'];
	$email = $_SESSION['email'];

	$q= "SELECT `order-date` ,GROUP_CONCAT( food SEPARATOR '-') as foods,GROUP_CONCAT(oid SEPARATOR '-') as oids,GROUP_CONCAT(`status` SEPARATOR '-') as status from `order` where email='$email' and status<>'cart' and  cast(`order-date` as date) BETWEEN '$start' AND '$end' group by `order-date` order by `oid`  ";

		$res = mysqli_query($con,$q);
		if(mysqli_num_rows($res)>0){

			while($row = mysqli_fetch_assoc($res)){

				$exts = explode('-', $row['status']);
				$c = array_count_values($exts); 
				$val = array_search(max($c), $c);

				$exto = explode(' ',$row['order-date']);
				$ext_o = $exto[0];

				echo "<div class='ordergroup'>
					<label>Order No. : #".$row['oids']."</label>
					<label>Order Date : ".$ext_o."</label>
					<label>Order Status : <span class='status current'>".$val."</span></label>
					";

				$extf = explode('-', $row['foods']); 
				
				echo"<div class='orderitems'>";
				for ($i=0; $i <count($extf) ; $i++) { 
					echo"
					
						<label>&#x025B8; ".$extf[$i]." : <span class='status'>".$exts[$i]."</span></label>
						
					
					";
				}
				echo"</div>
				</div>
				";
			}
		}
		else{
			echo "<span class='norecord'> No records  found. </span>";
		}
	}
?>