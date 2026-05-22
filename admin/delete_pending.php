<?php
	require_once 'connect.php';
	$conn->query("DELETE FROM `transaction_data` WHERE `transaction_id` = '$_REQUEST[transaction_id]'") or die(mysqli_error());
	header("location:reserve.php");
?>