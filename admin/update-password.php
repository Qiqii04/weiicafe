<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php

        $id = $_GET["id"];

        if (isset($_SESSION["password-not-match"])) {
            echo $_SESSION["password-not-match"];
            unset($_SESSION["password-not-match"]);
        }
        if (isset($_SESSION["user-not-found"])) {
            echo $_SESSION["user-not-found"];
            unset($_SESSION["user-not-found"]);
        }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>
                        Confirm Password
                    </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn btn-primary" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #007bff;" onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'">


                    </td>
                    <td>
                    <a href="<?php echo HOMEURL ?>admin/manage-admin.php" class='btn-danger link-no-deco' style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #dc3545;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Cancel</a>

                    </td>
                </tr>




            </table>



        </form>

    </div>

</div>


<?php
//check whether the submit button is clicked
if (isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

    //Get data from form
    $id = $_POST["id"];
    $current_password = md5($_POST["current_password"]);
    $new_password = md5($_POST["new_password"]);
    $confirm_password = md5($_POST["confirm_password"]);

   


    //Check whether Current Password is Correct


    try {
        $query = "SELECT * FROM tbl_admin WHERE id=:id AND user_password=:password";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $current_password);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



        // echo $result['user_password'];
        $count = $stmt->rowCount();
        if ($count == 1) {

            //User exist and password can be changed
            //Check whether New And Comfirm Password same
            if ($new_password == $confirm_password and $new_password!=md5("")) {
                try {
                    $change_password_query = "UPDATE tbl_admin SET user_password =:new_password WHERE id=:id";
                    $stmt = $pdo->prepare($change_password_query);
                    $stmt->bindParam(":new_password", $new_password);
                    $stmt->bindParam(":id", $id);
                    $stmt->execute();

                    $_SESSION["password-change-success"] = "<div class='success'>Password Changed Successfully</div>";
                    header("Location:" . HOMEURL . "admin/manage-admin.php");
                    $pdo=null;
                    $stmt=null;
                    exit();
                } catch (PDOException $e) {
                    die("Query Failed" . $e->getMessage());
                }


            } else {
                //Redirect to manage admin page
                $_SESSION["password-not-match"] = "<div class='failed'>Password not match</div>";
                echo $count;
                header("Location:" . HOMEURL . "admin/update-password.php?id= $id");
            }

        } else {
            //User not exist 
            $_SESSION["user-not-found"] = "<div class='failed'>Please enter current password</div>";
            echo $count;
            header("Location:" . HOMEURL . "admin/update-password.php?id= $id");

        }

    } catch (PDOException $e) {
        die("Query Failed" . $e->getMessage());
    }








}


?>