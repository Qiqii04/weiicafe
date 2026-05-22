<?php
//include dbh.inc.php
include("../includes/dbh-inc.php");
//1. Destroy the session
unset($_SESSION['user']);

//2. Redirect to Login Page

header("Location: ".HOMEURL."admin/login.php");