<!DOCTYPE html>
<?php include("partials/menu.php"); ?>
<?php
	//require_once 'validate.php';
	require 'name.php';  
?>
<html lang="eng">
<head>
    <title>Weii Cafe Reservation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>

<div class="container-fluid">   
    <ul class="nav nav-pills">
        <br>
        <li class="active"><a href="reserve.php">Reservation</a></li>
        <li><a href="reservation_type.php">Add Reservation Type</a></li>            
    </ul>   
</div>
<br />
<div class="container-fluid">  
    <div class="panel panel-default">
        <?php
            $q_p = $conn->query("SELECT COUNT(*) as total FROM `transaction_data` WHERE `status` = 'Pending'") or die(mysqli_error());
            $f_p = $q_p->fetch_array();
            $q_ci = $conn->query("SELECT COUNT(*) as total FROM `transaction_data` WHERE `status` = 'Check In'") or die(mysqli_error());
            $f_ci = $q_ci->fetch_array();
        ?>
        <div class="panel-body">
            <a class="btn btn-success" href="reserve.php"><span class="badge"><?php echo $f_p['total']?></span> Pendings</a>
            <a class="btn btn-info disabled"><span class="badge"><?php echo $f_ci['total']?></span> Approved</a>
            <a class="btn btn-warning" href="checkout.php"><i class="glyphicon glyphicon-eye-open"></i> Completed</a>
            <br />
            <br />
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Reservation Type</th>
                        <th>Table no</th>
                        <th>Reservation Date and Time</th>
                        <th>Approval Date</th>
                        <th>Bill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = $conn->query("SELECT * FROM `transaction_data` NATURAL JOIN `guest` NATURAL JOIN `reservation` WHERE `status` = 'Check In'") or die(mysqli_query());
                        while($fetch = $query->fetch_array()){
                    ?>
                    <tr>
                    <td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
							<td><?php echo $fetch['reservation_type']?></td>
							<td><?php echo $fetch['reservation_no']?></td>
							<td><?php echo "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>"." @ "."<label>".date("h:i a", strtotime($fetch['checkin_time']))."</label>"?></td>
							<!-- <td><?php echo $fetch['days']?></td> -->
							<td><?php echo "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($fetch['checkin']."+".$fetch['days']."DAYS"))."</label>"?></td>
							<!-- <td><?php echo $fetch['status']?></td> -->
							<!-- <td><?php if($fetch['extra_bed'] == "0"){ echo "None";}else{echo $fetch['extra_bed'];}?></td> -->
							<!-- <td><?php echo "RM ".$fetch['bill'].".00"?></td> -->
							<td>RM 50.00</td>
							<td><center><a class = "btn btn-warning" href = "checkout_query.php?transaction_id=<?php echo $fetch['transaction_id']?>" onclick = "confirmationCheckin(); return false;"><i class = "glyphicon glyphicon-check"></i> Completed</a></center></td>
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

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>  
<script type="text/javascript">
    $(document).ready(function(){
        $("#table").DataTable({
            "error": function ( settings, techNote, message ) {
                console.error('DataTables Error:', message);
            }
        });
    });

    function confirmationCheckin(anchor){
        var conf = confirm("Are you sure you want to approved?");
        if(conf){
            window.location = anchor.attr("href");
        }
    }
</script>
</body>
</html>
