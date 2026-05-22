<?php

//check whether user is logged in
if (!isset($_SESSION["customer"])) {//if user session is not set
    $_SESSION['no-login-message']="<div class='failed'>Please login first</div>";
    //redirect to login.php
    header("Location:".HOMEURL."menu/customer-login.php");
}
?>