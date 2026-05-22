<?php 
    //start the session
    session_start();


    $dsn = "mysql:host=localhost;dbname=weii_cafe";
    $dbusername="root";
    $dbpassword= "";
    
    define("HOMEURL","http://localhost/weiicafe/");
    date_default_timezone_set("Asia/Kuala_Lumpur");
    try{
        $pdo=new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){    
        echo "Connection Failed". " ".$e->getMessage();
    }


