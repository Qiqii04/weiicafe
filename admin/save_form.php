<?php
	require_once 'connect.php';
	if(ISSET($_POST['add_form'])){
		$reservation_no = $_POST['reservation_no'];
		$days = $_POST['days'];
		$extra_bed = $_POST['extra_bed'];
		$query = $conn->query("SELECT * FROM `transaction_data` WHERE `reservation_no` = '$reservation_no' && `status` = 'Check In'") or die(mysqli_error());
		$row = $query->num_rows;
		$time = date("H:i:s", strtotime("+8 HOURS"));
		if($row > 0){
			echo "<script>alert('Reservation not available')</script>";
		}else{
			$query2 = $conn->query("SELECT * FROM `transaction_data` NATURAL JOIN `guest` NATURAL JOIN `reservation` WHERE `transaction_id` = '$_REQUEST[transaction_id]'") or die(mysqli_error());
			$fetch2 = $query2->fetch_array();
			$total = $fetch2['reservation_price'] * $days;
			$total2 = 800 * $extra_bed;
			$total3 = $total + $total2;
			$checkout = date("Y-m-d", strtotime($fetch['checkin']."+".$days."DAYS"));
			$conn->query("UPDATE `transaction_data` SET `reservation_no` = '$reservation_no', `days` = '$days', `extra_bed` = '$extra_bed', `status` = 'Check In', `checkin_time` = '$time', `checkout` = '$checkout', `bill` = '$total3' WHERE `transaction_id` = '$_REQUEST[transaction_id]'") or die(mysqli_error());
			header("location:checkin.php");
		}
	}
?>