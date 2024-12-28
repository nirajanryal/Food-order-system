<?php
session_start();
include('connect.php');

if (isset($_POST['rating'], $_POST['userid'], $_POST['fid'])) {
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $uid = mysqli_real_escape_string($con, $_POST['userid']);
    $fid = mysqli_real_escape_string($con, $_POST['fid']);

    $checkQuery = "SELECT * FROM `user_ratings` WHERE `uid` = '$uid' AND `fid` = '$fid'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE `user_ratings` SET `rating` = '$rating' WHERE `uid` = '$uid' AND `fid` = '$fid'";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            echo "Your rating has been updated successfully.";
        } else {
            die("Error: " . mysqli_error($con));
        }
    } else {
        $insertQuery = "INSERT INTO `user_ratings` (`uid`, `fid`, `rating`) VALUES ('$uid', '$fid', '$rating')";
        $insertResult = mysqli_query($con, $insertQuery);

        if ($insertResult) {
            echo "Item has been successfully rated.";
        } else {
            die("Error: " . mysqli_error($con));
        }
    }
} else {
    die("Error: Missing required parameters.");
}
?>

