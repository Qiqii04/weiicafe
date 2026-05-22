<?php
//include dbh.inc.php
include("../includes/dbh-inc.php");
//1. Destroy the session
unset($_SESSION["customer"]);

//2. Redirect to Home Page

header("Location: ".HOMEURL."menu/index.php");