<?php include('partials/menu.php')?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Weii Cafe Reservation</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
	<nav style = "background-color:rgba(0, 0, 0, 0.1);" class = "navbar navbar-default">
		<div  class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand" >Weii Cafe Reservation</a>
			</div>
		</div>
	</nav>	
	<ul id = "menu">
		
		<li><a href = "index_reservation.php">Make a reservation</a></li> 

	</ul>
	<div style = "margin-left:0;" class = "container">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<strong><h3>MAKE A RESERVATION</h3></strong>
				<br />
				<div class = "col-md-4"></div>
				<div class = "well col-md-4">
					<center><h3>Please visit our Cafe for verification</h3></center>
					<br />
					<center><h4>THANK YOU!</h4></center>
					<br />
					<center><a href = "index_reservation.php" class = "btn btn-success"><i class = "glphyicon glyphicon-check"></i> Back to reservation</a></center>
				</div>
				<div class = "col-md-4"></div>
			</div>
		</div>
	</div>
	<br />
	<br />

</body>
<script src = "js/jquery.js"></script>
<script src = "js/bootstrap.js"></script>	
</html>