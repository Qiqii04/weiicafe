<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_reservation'])){
		$reservation_type = $_POST['reservation_type'];
		$reservation_price = $_POST['reservation_price'];
		$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$photo_name = addslashes($_FILES['photo']['name']);
		$photo_size = getimagesize($_FILES['photo']['tmp_name']);
		move_uploaded_file($_FILES['photo']['tmp_name'],"../photo/" . $_FILES['photo']['name']);
		$conn->query("UPDATE `reservation` SET `reservation_type` = '$reservation_type', `reservation_price` = '$reservation_price', `photo` = '$photo_name' WHERE `reservation_id` = '$_REQUEST[reservation_id]'") or die(mysqli_error());
		header("location:reservation_type.php");
	}
?>