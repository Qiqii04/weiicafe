<?php include("partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Item</h1>

        <br>
        <?php
        if (isset($_SESSION["add-food"])) {
            echo $_SESSION["add-food"];//display session message
            unset($_SESSION["add-food"]);//remove session message
        }
        if (isset($_SESSION["remove-image"])) {
            echo $_SESSION["remove-image"];//display session message
            unset($_SESSION["remove-image"]);//remove session message
        }
        if (isset($_SESSION["delete-food"])) {
            echo $_SESSION["delete-food"];//display session message
            unset($_SESSION["delete-food"]);//remove session message
        }
        if (isset($_SESSION["update"])) {
            echo $_SESSION["update"];//display session message
            unset($_SESSION["update"]);//remove session message
        }
        ?>
        <br>
        <!-- Button to add admin -->
        <a href="<?php echo HOMEURL; ?>admin/add-food.php" class="btn-primary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #28a745;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'"><i class='bx bx-plus-medical'></i></a>


        <br> 
        <br>
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            try {
                $query = "SELECT * FROM tbl_food";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $count = $stmt->rowCount();
                if ($count > 0) {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $number = 1;
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $number++ ?>
                            </td>
                            <td>
                                <?php echo $row["title"] ?>
                            </td>
                            <td>
                                <?php echo $row["price"] ?>
                            </td>
                            <td>
                                <?php
                                //check whether image name is available
                                if ($row["image_name"] != "") {
                                    //display the image 
                                    ?>
                                    <img src="<?php echo HOMEURL; ?>images/food/<?php echo $row["image_name"] ?>" alt="" width="100px">

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
                            <a href="<?php echo HOMEURL ?>admin/update-food.php?id=<?php echo $row["id"] ?>" class="btn-secondary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Update</a>

                            <a href="<?php echo HOMEURL ?>admin/delete-food.php?id=<?php echo $row["id"] ?>&image_name=<?php echo $row["image_name"] ?>" class="btn-danger link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #dc3545;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Delete</a>

                            </td>

                        </tr>




                        <?php

                    }
                } else {
                    //no data in database
                    //display message in table
                    ?>
                    <tr>
                        <td colspan="7">
                            <div class="failed">No Food Added</div>
                        </td>
                    </tr>

                    <?php

                }
            } catch (PDOException $e) {
                die("Query Error " . $e->getMessage());
            }

            ?>


        </table>


    </div>
</div>

</div>