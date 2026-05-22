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

                                <h1 class="text-center">Customer Registration</h1>
                            </div>
                            <div class="input-group mb-4 align-items-center">
                                <a href="<?php echo HOMEURL ?>menu/customer-login.php"
                                    class='link-no-deco register-link'>Back
                                    to
                                    Login</a>
                            </div>
                            <small>
                                <?php
                                if (isset($_SESSION["no-name"])) {
                                    echo $_SESSION["no-name"];//display session message
                                    unset($_SESSION["no-name"]);//remove session message
                                }

                                ?>
                            </small>
                            <div class="input-group mb-4 align-items-center">
                                <input type="text" name="customer_name"
                                    class="form-control form-control-lg bg-light fs-6" placeholder="Username"
                                    id="username">
                            </div>
                            <small>
                                <?php
                                if (isset($_SESSION["no-pass"])) {
                                    echo $_SESSION["no-pass"];//display session message
                                    unset($_SESSION["no-pass"]);//remove session message
                                }
                                if (isset($_SESSION["weak-pass"])) {
                                    echo $_SESSION["weak-pass"];//display session message
                                    unset($_SESSION["weak-pass"]);//remove session message
                                }
                                ?>
                            </small>
                            <div class="input-group mb-4">
                                <small style="color:grey; font-size:12px">Password must be at least 8 characters and
                                    include uppercase (A), lowercase (a), number (1), and a special character</small>
                                <input type="password" name="customer_password" placeholder="Password"
                                    id="user_password" class="form-control form-control-lg bg-light fs-6">

                            </div>
                            <small>
                                <?php
                                if (isset($_SESSION["no-email"])) {
                                    echo $_SESSION["no-email"];//display session message
                                    unset($_SESSION["no-email"]);//remove session message
                                }
                                if (isset($_SESSION["invalid-email"])) {
                                    echo $_SESSION["invalid-email"];//display session message
                                    unset($_SESSION["invalid-email"]);//remove session message
                                }

                                ?>
                            </small>
                            <div class="input-group mb-4">
                                <input type="text" name="customer_email" placeholder="Email" id="user_email"
                                    class="form-control form-control-lg bg-light fs-6">

                            </div>
                            <small>
                                <?php
                                if (isset($_SESSION["no-contact"])) {
                                    echo $_SESSION["no-contact"];//display session message
                                    unset($_SESSION["no-contact"]);//remove session message
                                }
                                if (isset($_SESSION["invalid-contact"])) {
                                    echo $_SESSION["invalid-contact"];//display session message
                                    unset($_SESSION["invalid-contact"]);//remove session message
                                }
                                ?>
                            </small>
                            <div class="input-group mb-4">
                                <input type="text" name="customer_contact" placeholder="Contact [01]"
                                    id="customer_contact" class="form-control form-control-lg bg-light fs-6">

                            </div>
                            <div class="input-group mb-4 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="formCheck">
                                    <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                            Me</small></label>
                                </div>

                            </div>
                            <div class="input-group mb-3">
                                <input type="submit" name="submit" value="Register" class="login-btn">
                            </div>

                        </div>
                    </div>









                </div>
            </div>
    </div>

    </div>
    </form>
    <?php
    if (isset($_POST['submit']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST["customer_name"])) {
            $_SESSION["no-name"] = "<div class='failed'>Please Enter Name</div>";
            header("Location:" . HOMEURL . "menu/customer-register.php");
            die();
        } else {
            $customer_name = $_POST['customer_name'];
        }

        if (empty($_POST["customer_password"])) {
            $_SESSION["no-pass"] = "<div class='failed'>Please Enter Password</div>";
            header("Location:" . HOMEURL . "menu/customer-register.php");
            die();
        } else {
            $customer_password = $_POST['customer_password'];
        }
        // Regular expression for password validation
        $passwordRegex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_+={}\[\]:;'\"\\|,.<>\/?])[A-Za-z\d!@#$%^&*()\-_+={}\[\]:;'\"\\|,.<>\/?]{8,}$/";

        if (!preg_match($passwordRegex, $customer_password)) {
            $_SESSION["weak-pass"] = "<div class='failed'>Password must be at least 8 characters and include uppercase (A), lowercase (a), number (1), and a special character</div>";
            header("Location:" . HOMEURL . "menu/customer-register.php");
            die();
        }

        if (empty($_POST["customer_email"])) {
            $_SESSION["no-email"] = "<div class='failed'>Please Enter Email</div>";
            header("Location:" . HOMEURL . "menu/customer-register.php");
            die();
        } else {
            $customer_email = $_POST['customer_email'];
        }
        // Regular expression for email validation
        $emailRegex = "/^[^@]+@[^@]+$/";

        if (!preg_match($emailRegex, $customer_email)) {
            $_SESSION["invalid-email"] = "<div class='failed'>Please Enter a Valid Email</div>";
            header("Location:" . HOMEURL . "menu/customer-register.php");
            die();
        }

        if (empty($_POST["customer_contact"])) {
            $_SESSION["no-contact"] = "<div class='failed'>Please Enter Contact</div>";
            header("Location:" . HOMEURL . "menu/customer-registrater.php");
            die();
        } else {
            $customer_contact = $_POST['customer_contact'];
        }

        // Regular expression for contact validation
        $contactRegex = "/^01[2-9]-[0-9]{7}$/";

        if (!preg_match($contactRegex, $customer_contact)) {
            $_SESSION["invalid-contact"] = "<div class='failed'>Please Enter a Valid Contact</div>";
            header("Location:" . HOMEURL . "menu/customer-register.php");
            die();
        }


        try {

            $register_query = "INSERT INTO tbl_customer(name,customer_password,contact,email) VALUES
                    (
                    :name,:customer_password,:contact,:email
                    )";
            $stmt = $pdo->prepare($register_query);
            $stmt->bindParam(":name", $customer_name);
            $stmt->bindParam(":customer_password", $customer_password);
            $stmt->bindParam(":contact", $customer_contact);
            $stmt->bindParam(":email", $customer_email);

            $stmt->execute();
            $_SESSION['register'] = "<div class='success'>Register Successfully</div>";
            $stmt = null;
            $pdo = null;
            header("Location:" . HOMEURL . "menu/customer-login.php");
            ob_end_flush();



        } catch (PDOException $e) {
            $_SESSION['register'] = "<div class='failed'>Failed to register</div>";

            die($e->getMessage());
        }
    }


    ?>




    </div>


</body>

</html>