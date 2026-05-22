<?php include ("partials/menu.php") ?>

<div class="main-content">


    <div class="wrapper">
        <h1>Update Admin</h1>

        <form action=" " method="POST">
            <br><br>

            <?php

            //get id of selected admin
            $id = $_GET["id"];

            try {
                $query = "SELECT * FROM tbl_admin WHERE id = $id";

                $stmt = $pdo->prepare($query);

                $stmt->execute();

                //check whether the data is available or not
                $count = $stmt->rowCount();

                //check whether return 1 row of admin data
                if ($count == 1) {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $full_name = $result[0]["full_name"];
                    $username = $result[0]["username"];


                } else {
                    header("Location:" . HOMEURL . "admin/manage-admin.php");
                }





            } catch (PDOException $e) {
                echo $e->getMessage();

            }
            ?>

            <table class="tbl-30">

                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>

                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #007bff;"
                            onmouseover="this.style.backgroundColor='#0056b3'"
                            onmouseout="this.style.backgroundColor='#007bff'">
                    </td>

                    <td>
                        <a href="<?php echo HOMEURL ?>admin/manage-admin.php" class='btn-danger link-no-deco'
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #dc3545;"
                            onmouseover="this.style.backgroundColor='#ff6b7d'"
                            onmouseout="this.style.backgroundColor='#dc3545'">Cancel</a>

                    </td>
                </tr>


            </table>



        </form>


    </div>
</div>

<?php

if (isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

    //get all value from form to update
    $id = $_POST["id"];
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];


    //sql query
    try {
        $query = "UPDATE tbl_admin SET full_name = '$full_name', username='$username' WHERE id='$id'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $_SESSION["update"] = "<div class='sucess'> Admin Updated Successfully</div>";
        $pdo = null;
        $stmt = null;
        header("Location:" . HOMEURL . "admin/manage-admin.php");
    } catch (PDOException $e) {
        $_SESSION["update"] = "<div class='failed'> Admin Updated Unsuccessfully</div>";
        die("Query failed" . $e->getMessage());
    }

}

?>