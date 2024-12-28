<?php 
    include('connect.php');

    if(isset($_GET['oid']))
    {
   
        $oid = $_GET['oid'];


        $sql = "DELETE FROM `order` WHERE  oid=$oid";

        $res = mysqli_query($con, $sql);

        if($res==true)
        {
            header('location:cart.php');
        }
    
    }
    else
    {
        header('location:cart.php');
    }
?>