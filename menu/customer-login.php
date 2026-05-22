<?php
include ("../includes/dbh-inc.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WEii CAFE</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


    <div class="wrapper">
        
        <br>


        <br>
        <!-- Login Form Starts -->
        <form action="" method="POST">
            <div class="container d-flex justify-content-center align-items-center min-vh-100">

                <div class="row border rounded-5 p-3 bg-white shadow box-area">
                    <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                        style="background: transparent; background-color;">
                        <div class="featured-image mb-3">
                            <img src="../images/background.jpg" class="img-fluid" style="width: 500px;">
                        </div>
                        <p class="text-bold fs-2"
                            style="font-family: 'Courier New', Courier, monospace; font-weight: 800;">WEii CAFE</p>


                    </div>
                    <div class="col-md-6 right-box">
                        <div class="row align-items-center">
                            <div class="header-text mb-4">
                                <small>
                                    <?php
                                  
                                    if (isset ($_SESSION["no-login-message"])) {
                                        echo $_SESSION["no-login-message"];
                                        unset($_SESSION["no-login-message"]);

                                    }
                                    if (isset ($_SESSION["wrong-login"])) {
                                        echo $_SESSION["wrong-login"];
                                        unset($_SESSION["wrong-login"]);

                                    }
                                    if (isset ($_SESSION["register"])) {
                                        echo $_SESSION["register"];
                                        unset($_SESSION["register"]);

                                    }

                                    ?>
                                </small>
                                <h1 class="text-center">Customer Login</h1>
                            </div>
                            <div class="input-group mb-4 align-items-center">
                                <a href="<?php echo HOMEURL; ?>index.php" class='link-no-deco register-link'>Back
                                    to
                                    Home</a>
                            </div>
                            <div class="input-group mb-4 align-items-center">
                                <input type="text" name="username" class="form-control form-control-lg bg-light fs-6"
                                    placeholder="Username" id="username">
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" name="user_password" placeholder="Password" id="user_password"
                                    class="form-control form-control-lg bg-light fs-6">

                            </div>
                            <div class="input-group mb-4 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="formCheck">
                                    <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                            Me</small></label>
                                </div>

                            </div>
                            <div class="input-group mb-3">
                                <input type="submit" name="submit" value="Login" class="login-btn">
                            </div>
                            <div class="input-group mb-3">
                                <a href="<?php echo HOMEURL; ?>menu/customer-register.php"
                                    class="link-no-deco register-link">New User? Click Here to
                                    Register</a>

                            </div>
                        </div>
                    </div>









                </div>
            </div>
    </div>

    </div>
    </form>




    </div>


</body>

</html>


<?php

//Check sumbit button is click
if (isset ($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

    //process for login
    //get data from login form
    $username = $_POST["username"];
    $user_password = $_POST["user_password"];

    //query to check whether user in database
    try {
        $query = "SELECT * FROM tbl_customer WHERE name = :username AND customer_password=:user_password";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":user_password", $user_password);

        $stmt->execute();
        $count = $stmt->rowCount();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($count == 1) {
            //user available
            $_SESSION["login"] = "<div class='success'>Login Successfull</div>";
            $_SESSION["customer"] = $username;//to check whether user is logged in and log out will unset it
            $_SESSION['customer_id'] = $result[0]['id'];
            $_SESSION['customer_email'] = $result[0]['email'];
            $_SESSION['order_num'] = $result[0]['order_num'];
            header("Location:" . HOMEURL . "index.php");
            ob_end_flush();


        } else {
            //user not available
            $_SESSION["wrong-login"] = "<div class='failed'>User/Password Not Match</div>";
            header("Location:" . HOMEURL . "menu/customer-login.php");

        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die ("query error" . $e->getMessage());

    }


}


?>