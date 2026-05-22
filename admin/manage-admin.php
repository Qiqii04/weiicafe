<?php include("partials/menu.php") ?>


<!-- Main Section Starts -->
<div class="main-content">

    <div class="wrapper">

        <h1>Manage Admin</h1>
        <br>

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];//display session message
            unset($_SESSION["add"]);//remove session message
        }
        if (isset($_SESSION["delete"])) {
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }
        if (isset($_SESSION["update"])) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }
        
       
        if (isset($_SESSION["password-change-success"])) {
            echo $_SESSION["password-change-success"];
            unset($_SESSION["password-change-success"]);
        }
        ?>

        <br>
        <br>
        <!-- Button to add admin -->
        <button id="btn-addAdmin" class="btn-primary" style="padding: 12px 24px; font-size: 18px; border-radius: 10px; border: none;"><i class='bx bx-plus-medical'></i></button>

        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <!-- display admin from database -->
            <?php

            try {  //query to get all admin
                $query = "SELECT * FROM tbl_admin 
                            WHERE id!=1";

                $stmt = $pdo->prepare($query);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $number = 1;

                if (!empty($result)) {
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $number ?>
                            </td>
                            <td>
                                <?php echo $row["full_name"] ?>
                            </td>
                            <td>
                                <?php echo $row["username"] ?>
                            </td>
                            <td>
                            <a href="<?php echo HOMEURL; ?>admin/update-password.php?id=<?php echo $row["id"] ?>" class="btn-primary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none;">Change Password</a>
                            <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $row["id"] ?>" class="btn-secondary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #007bff;" onmouseover="this.style.backgroundColor='#B0C4DE'" onmouseout="this.style.backgroundColor='#007bff'">Update</a>
                            <?php if ($row["id"]!=1){ ?>
                            <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $row["id"] ?>" class="btn-danger link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #dc3545;" onmouseover="this.style.backgroundColor='#ff6b7d'" onmouseout="this.style.backgroundColor='#dc3545'">Delete</a>
                            <?php } ?>


                            </td>

                        </tr>
                        <?php $number ++;
                    }
                } else {

                    echo "No data in admin table";
                }

            } catch (PDOException $e) {
                echo die("Query Failed" . $e->getMessage());
            }

            ?>




        </table>


    </div>
</div>


<!-- Main Section Ends -->






<script src="manage-admin.js"></script>
</body>

</html>