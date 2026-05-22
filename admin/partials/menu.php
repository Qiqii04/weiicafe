<?php
include ("../includes/dbh-inc.php");
include ("login-check.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEii CAFE- HOME PAGE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/weiicafe/css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
</head>

<body>
    <!-- Menu Section Starts-->
    <div class="menu text-center">
        <div class="wrapper navbar">
            <ul>
                <li><a href="#" id="greeting"> Admin Panel
                    </a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Item</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="reserve.php">Reservation</a></li>
                <li><a href="add-post.php">Posts</a></li>
                <li><a href="unapprove-comment.php">Comments</a></li>
                <li><a href="logout.php" id="logout">Logout</a></li>



            </ul>
        </div>


    </div>




    <!-- Menu Section Ends-->