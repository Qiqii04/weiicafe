<?php include ("partials/menu.php");
ob_start(); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Item</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            try {
                $query = "SELECT * FROM tbl_food WHERE id = $id";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $count2 = $stmt->rowCount();

                if ($count2 == 1) {
                    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result2 as $row) {
                        $title = $row["title"];
                        $description = $row["description"];
                        $price = $row["price"];
                        $current_image = $row["image_name"];
                        $current_category = $row["category_id"];

                        $featued = $row["featured"];
                        $active = $row["active"];
                    }

                } else {
                    $_SESSION["no-food-found"] = "<div class='failed'>Food not found</div>";
                    header("Location: " . HOMEURL . "admin/manage-food.php");
                    die("");
                }

            } catch (PDOException $e) {
                die($e->getMessage());

            }

        } else {
            header('Location: ' . HOMEURL . 'admin/manage-food.php');

        }



        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                    <small>
                            <?php
                            if (isset($_SESSION["item-title"])) {
                                echo $_SESSION["item-title"];//display session message
                                unset($_SESSION["item-title"]);//remove session message
                            } ?>

                        </small>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="food_description" cols="22" rows="3"><?php echo $description ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><small>
                            <?php
                            if (isset($_SESSION["price"])) {
                                echo $_SESSION["price"];//display session message
                                unset($_SESSION["price"]);//remove session message
                            } ?>

                        </small><input type="number" name="price" step="0.01" placeholder="RM" value="<?php echo $price ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($current_image != '') {
                            ?>
                            <img src="<?php echo HOMEURL; ?>images/food/<?php echo $current_image ?>" alt="" width="200px">
                        <?php } else {
                            echo "<div class='failed'>Image Not Added</div>";
                        } ?>

                    </td>

                </tr>
                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <td>Category</td>
                <td>
                    <select name="category">
                        <option value="">Select</option>
                        <?php
                        //display category from database
                        try {
                            //sql query to get active category from database
                            $query = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();

                            $count = $stmt->rowCount();

                            if ($count > 0) {
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $category_id = $row["id"];
                                    $title = $row["title"];
                                    ?>
                                    <option <?php if ($current_category == $category_id) {
                                        echo "selected ";
                                    } ?>value="<?php echo $category_id ?>">
                                        <?php echo $title ?>
                                    </option>



                                    <?php



                                }


                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }


                        } catch (PDOException $e) {
                            die($e->getMessage());
                        }
                        ?>




                    </select>
                </td>
                </tr>
                <tr>
                    <td>Show in Home Page</td>
                    <td>
                        <input <?php if ($featued == 'Yes') {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="Yes">Yes
                        <input <?php if ($featued == 'No') {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="No">No

                    </td>

                </tr>
                <tr>
                    <td>Item Available</td>
                    <td>
                        <input <?php if ($active == 'Yes') {
                            echo "checked";
                        } ?> type="radio" name="active"
                            value="Yes">Yes
                        <input <?php if ($active == 'No') {
                            echo "checked";
                        } ?> type="radio" name="active" value="No">No
                    </td>

                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Save" class='btn-secondary'
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;"
                            onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">

                    </td>
                    <td>
                        <a href="<?php echo HOMEURL ?>admin/manage-food.php" class='btn-danger link-no-deco'
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #dc3545;"
                            onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Cancel</a>

                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

            //Get data from form
            $title = $_POST["title"];
            if ($_POST["title"] =="") {
                $_SESSION["item-title"] = "<div class='failed'>Please Enter Title</div>";
                header("Location:" . HOMEURL . "admin/update-food.php?id=$id");
                die();
            }
            $description = $_POST["food_description"];
            $price = $_POST["price"];
            $price = $_POST["price"];
            if ($_POST["price"] < 0) {
                $_SESSION["price"] = "<div class='failed'>Please Enter Valid Price</div>";
                header("Location:" . HOMEURL . "admin/update-food.php?id=$id");
                die();
            }
            $current_image = $_POST["current_image"];
            $category = $_POST["category"];
            $featued = $_POST["featured"];
            $active = $_POST["active"];

            //update new image if selected
            //check whetehr image is selected
            if (isset($_FILES["image"]["name"])) {
                

                $image_name =$_FILES["image"]["name"];
                if ($image_name != "") {

                    //get the extension of image
                    //$ext=end(explode(".", $image_name));
                    $randomNumber = rand(0, 100);

                    $image_name = $randomNumber . $_FILES["image"]["name"];

                    $source_path = $_FILES["image"]["tmp_name"];
                    $destination_path = "../images/food/" . $image_name;


                    // upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not
                    //if not upload, stop the process and redirect with error message
                    if ($upload == false) {
                        $_SESSION["upload"] = "<div class='failed'>Failed to upload image</div>";
                        header("Location: " . HOMEURL . "admin/manage-food.php");
                        //stop the process
                        die();
                    }

                    //remove current image
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);

                        //if fail to remove image, add error message and stop process
                        if ($remove == false) {
                            //set session message
                            $_SESSION["remove-image"] = "<div class='failed'>Fail to remove current image</div>";

                            //redirect to manage category page
                            header("Location: " . HOMEURL . "admin/manage-food.php");

                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }



            //update database
            try {
                $update_query = "UPDATE tbl_food SET 
                        title=:title,
                        description=:food_description,
                        price=:price,
                        image_name=:image_name,
                        category_id=:category_id,
                        featured=:featured,
                        active=:active
                        WHERE id=$id;
                        ";
                $stmt = $pdo->prepare($update_query);

                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":food_description", $description);
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":image_name", $image_name);
                $stmt->bindParam(":category_id", $category);
                $stmt->bindParam(":featured", $featued);
                $stmt->bindParam("active", $active);
                $stmt->execute();
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";


                $pdo = null;
                $stmt = null;


                header("Location: " . HOMEURL . "admin/manage-food.php");
                ob_end_flush();
            } catch (PDOException $e) {
                $_SESSION['update'] = "<div class='failed'>Food Updated Unccessfully</div>";
                header("Location: " . HOMEURL . "admin/manage-food.php");
                die($e->getMessage());
            }


        }


        ?>
    </div>


</div>