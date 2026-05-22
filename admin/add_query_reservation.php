
<?php
	if(ISSET($_POST['add_reservation'])){
		$reservation_type = $_POST['reservation_type'];
		$reservation_price = $_POST['reservation_price'];
		$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$photo_name = addslashes($_FILES['photo']['name']);
		$photo_size = getimagesize($_FILES['photo']['tmp_name']);
		move_uploaded_file($_FILES['photo']['tmp_name'],"../photo/" . $_FILES['photo']['name']);
		$conn->query("INSERT INTO `reservation` (reservation_type, reservation_price, photo) VALUES('$reservation_type', '$reservation_price', '$photo_name')") or die(mysqli_error());
		header("location:reservation_type.php");
	}
?>