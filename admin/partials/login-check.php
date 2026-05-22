<?php

//check whether user is logged in
if (!isset($_SESSION["user"])) {//if user session is not set
    $_SESSION['admin-no-login-message']="<div class='failed'>Please login to access admin panel</div>";
    //redirect to login.php
    header("Location:".HOMEURL."admin/login.php");
}
?>