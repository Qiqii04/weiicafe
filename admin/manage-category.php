<?php 
    error_reporting(0);
    include("partials/menu.php");
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <?php
        if (isset ($_SESSION["add"])) {
            echo $_SESSION["add"];//display session message
            unset($_SESSION["add"]);//remove session message
        }
        if (isset ($_SESSION["remove-image"])) {
            echo $_SESSION["remove-image"];//display session message
            unset($_SESSION["remove-image"]);//remove session message
        }
        if (isset ($_SESSION["delete-category"])) {
            echo $_SESSION["delete-category"];//display session message
            unset($_SESSION["delete-category"]);//remove session message
        }
        if (isset ($_SESSION["no-category-found"])) {
            echo $_SESSION["no-category-found"];//display session message
            unset($_SESSION["no-category-found"]);//remove session message
        }
        if (isset ($_SESSION["update"])) {
            echo $_SESSION["update"];//display session message
            unset($_SESSION["update"]);//remove session message
        }
        if (isset ($_SESSION["upload"])) {
            echo $_SESSION["upload"];//display session message
            unset($_SESSION["upload"]);//remove session message
        }


        ?>
        <br><br>
        <!-- Button to add category -->
        <a href="<?php echo HOMEURL ?>admin/add-category.php" class="btn-primary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #28a745;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'"><i class='bx bx-plus-medical'></i></a>



        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            try {
                $query = "SELECT * FROM tbl_category";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $count = $stmt->rowCount();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $number = 1;
                if ($count > 0) {
                    //have data in database
                    //get data to display
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $number; ?>
                            </td>
                            <td>
                                <?php echo $row["title"] ?>
                            </td>

                            <td>
                                <?php
                                //check whether image name is available
                                if ($row["image_name"] != "") {
                                    //display the image 
                                    ?>
                                    <img src="<?php echo HOMEURL; ?>images/category/<?php echo $row["image_name"] ?>" alt=""
                                        width="100px">

                                    <?php
                                } else {
                                    //display the message
                                    echo "<div class='failed'>Image Unavailable</div>";
                                }
                                ?>

                            </td>

                            <td>
                                <?php echo $row["featured"] ?>
                            </td>
                            <td>
                                <?php echo $row["active"] ?>
                            </td>
                            <td>
                            <a href="<?php echo HOMEURL; ?>admin/update-category.php?id=<?php echo $row["id"] ?>&image_name=<?php echo $row["image_name"] ?>" class="btn-secondary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Update</a>

                            <a href="<?php echo HOMEURL; ?>admin/delete-category.php?id=<?php echo $row["id"] ?>&image_name=<?php echo $row["image_name"] ?>" class="btn-danger link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #dc3545;" onmouseover="this.style.backgroundColor='#ff6b7d'" onmouseout="this.style.backgroundColor='#dc3545'">Delete</a>

                            </td>

                        </tr>
                        <?php $number++;
                    }


                } else {
                    //no data in database
                    //display message in table
                    ?>
                    <tr>
                        <td colspan="6">
                            <div class="failed">No Category Added</div>
                        </td>
                    </tr>

                    <?php
                }

                $stmt = null;
                $pdo = null;
            } catch (PDOException $e) {
                die ("Query Error " . $e->getMessage());

            }

            ?>



        </table>


    </div>
</div>

</div>