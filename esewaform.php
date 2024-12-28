<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<script type="text/javascript">

function formAutoSubmit () {

var frm = document.getElementById("myid");

frm.submit();

}

window.onload = formAutoSubmit;

</script>

<?php
	$oids = $_GET['oid'];
	$total = $_GET['total'];
?>
    <form action="https://uat.esewa.com.np/epay/main" method="POST" id="myid">
    <input value="<?php echo $total;?>" name="tAmt" type="hidden">
    <input value="<?php echo $total;?>" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="<?php echo $oids;?>" name="pid" type="hidden">
    <input value="http://localhost/fourth/esuccess.php?payment=success" type="hidden" name="su">
    <input value="http://localhost/fourth/esuccess.php?payment=failed&oids=<?php echo $oids;?>" type="hidden" name="fu">
    <input value="Submit" type="submit">
    </form>
</body>

</html>