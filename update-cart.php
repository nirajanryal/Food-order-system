<?php
        
    session_start();
   

    include('connect.php');
if(isset($_POST['newquantity'],$_POST['newtotal'],$_POST['oid'])){
    $newquantity = $_POST['newquantity'];
    $newtotal = $_POST['newtotal'];
    $oid = $_POST['oid'];
    $email = $_SESSION['email'];

    $q = " UPDATE `order` SET quantity='$newquantity',total='$newtotal' WHERE email='$email' AND oid='$oid'";

    $res = mysqli_query($con,$q);

    if($res){

       $q = " SELECT total FROM `order` WHERE email='$email' AND status='cart'";

        $res = mysqli_query($con,$q);

        $a = 0;

        while ($row = mysqli_fetch_assoc($res)) {

            $a = $row['total'] + $a;
        }

        echo $a;


    }else{

        echo" Unable to update cart.";
    }

}


  ?>