<!DOCTYPE html>
<?php include("partials/menu.php"); ?>
<?php

	require 'name.php';
?>
<html lang = "en">
	<head>
		<title>Weii Cafe Reservation</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
	</head>
<body>
	
	<div class = "container-fluid">	
		<br>
		<ul class = "nav nav-pills">
			<li><a href = "reserve.php">Reservation</a></li>
			<li><a href = "reservation_type.php">Add Reservation Type</a></li>			
		</ul>	
	</div>
	<br />
	<div class = "container-fluid">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<div class = "alert alert-info">Transaction / Reservation</div>
				<a class = "btn btn-success" href = "add_reservation.php"><i class = "glyphicon glyphicon-plus"></i> Add Reservation</a>
				<br />
				<br />
				<table id = "table" class = "table table-bordered">
					<thead>
						<tr>
							<th>Reservation Type</th>
							<th>Price (RM)</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("SELECT * FROM `reservation`") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
					?>	
						<tr>
							<td><?php echo $fetch['reservation_type']?></td>
							<td><?php echo $fetch['reservation_price']?></td>
							<td><center><img src = "../photo/<?php echo $fetch['photo']?>" height = "50" width = "50"/></center></td>
							<td><center><a class = "btn btn-warning" href = "edit_reservation.php?reservation_id=<?php echo $fetch['reservation_id']?>">
							<i class = "glyphicon glyphicon-edit"></i> Edit</a> 
							<a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_reservation.php?reservation_id=<?php echo $fetch['reservation_id']?>"><i class = "glyphicon glyphicon-remove"></i> 
							Delete</a></center></td>
						</tr>
					<?php
						}
					?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br />
	<br />
	
</body>
<script src = "../js/jquery.js"></script>
<script src = "../js/bootstrap.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
<script src = "../js/dataTables.bootstrap.js"></script>	
<script type = "text/javascript">
	function confirmationDelete(anchor){
		var conf = confirm("Are you sure you want to delete this record?");
		if(conf){
			window.location = anchor.attr("href");
		}
	} 
</script>

<script type = "text/javascript">
	$(document).ready(function(){
		$("#table").DataTable();
	});
</script>
</html>