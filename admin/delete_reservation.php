<?php
require_once 'connect.php';

// Assuming $conn is your MySQLi connection object
$query = "DELETE FROM `reservation` WHERE `reservation_id` = '" . $conn->real_escape_string($_REQUEST['reservation_id']) . "'";
$result = $conn->query($query);

if (!$result) {
    die($conn->error);
}

header("location:reservation_type.php");
?>
