 <?php
	require 'connect.php';
	 $query = $conn->query("SELECT * FROM `tbl_admin`") or die(mysqli_error());
	 $fetch = $query->fetch_array();
	 $name = $fetch['full_name'];
?> 

