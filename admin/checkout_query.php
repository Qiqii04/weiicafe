<?php include("partials/menu.php"); ?>
<?php
	require_once 'connect.php';
	$time = date("H:i:s", strtotime("+8 HOURS"));
	$conn->query("UPDATE `transaction_data` SET `checkout_time` = '$time', `status` = 'Check Out' WHERE `transaction_id` = '$_REQUEST[transaction_id]'") or die(mysqli_error());
	header("location:checkout.php");
?>