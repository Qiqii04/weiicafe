<?php include ("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br>

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];//display session message
            unset($_SESSION["add"]);//remove session message
        }
        ?>
        <br>
        <br>

        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" id="add-admin-form">
            <table class="tbl-30">

                <tr>
                    <td>Full Name:</td>
                    <td><input required type="text" name="full_name" placeholder="name"></td>
                    <td></td>

                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input required type="text" name="username" placeholder="username"></td>
                    <td></td>

                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input required type="password" name="user_password" placeholder="password"
                            id="adminPassword"></td>
                    <td></td>

                </tr>
                <tr>
                    <td>Comfirm Password:</td>
                    <td><input required type="password" name="comfirm_password" placeholder="re-enter password"
                            id="comfimrPassword"></td>
                    <td></td>

                </tr>
                <tr>
                    <td colspan>
                        <button type="submit" name="submit" value="Add Admin" class="btn-primary" id="submit-add-admin"
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #28a745;"
                            onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Add
                            </button>
                    </td>
                    <td> <a href="<?php echo HOMEURL ?>admin/manage-admin.php" class='btn-danger link-no-deco'
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s;"
                            onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Cancel</a>
                    </td>
                </tr>
                <form onsubmit="return confirm('Are you sure you want to submit?');">
                </form>


            </table>


        </form>
    </div>

</div>

<?php
//process the value from Form and save in database
//check whether the submit button is clicked

if (isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

    //button clicked

    //obtain the data
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $user_password = md5($_POST["user_password"]);
    $comfirm_password = md5($_POST["comfirm_password"]);

    $error = false;

    if (empty($full_name) || empty($username) || empty($user_password)) {

        echo "Please fill in all fields";

        $error = true;
    }
    if ($user_password != $comfirm_password) {

        echo "Please key in same password";

        $error = true;
    }
    if (!$error) {
        try {

            //sql query to save data into database
            $query = "INSERT INTO tbl_admin(full_name,username,user_password) VALUES (:full_name,:username,:user_password)";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam("user_password", $user_password);

            $stmt->execute();

            $_SESSION["add"] = "<div class='success'>Admin Added Successfully</div>";

            $pdo = null;
            $stmt = null;
            header("Location:" . HOMEURL . "admin/manage-admin.php");


        } catch (PDOException $e) {
            die("Query failed" . $e->getMessage());
        }
    } else {
        $_SESSION["add"] = "<div class='failed'>Failed to add admin</div>";

        header("Location: add-admin.php");
    }

} else {
    //button not clicked
    die();

}

?>