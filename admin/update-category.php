<?php

include ("partials/menu.php");
ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            try {
                $query = "SELECT * FROM tbl_category WHERE id = $id";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $count = $stmt->rowCount();

                if ($count == 1) {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $title = $row["title"];
                        $current_image = $row["image_name"];
                        $featued = $row["featured"];
                        $active = $row["active"];
                    }

                } else {
                    $_SESSION["no-category-found"] = "<div class='failed'>Category not found</div>";
                    header("Location:" . HOMEURL . "admin/manage-category.php");
                    die("");
                }

            } catch (PDOException $e) {
                die($e->getMessage());

            }

        } else {
            header('Location:' . HOMEURL . 'admin/manage-category.php');

        }



        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <small>
                            <?php
                            if (isset($_SESSION["no-title"])) {
                                echo $_SESSION["no-title"];//display session message
                                unset($_SESSION["no-title"]);//remove session message
                            } ?>

                        </small>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($current_image != '') {
                            ?>
                            <img src="<?php echo HOMEURL; ?>images/category/<?php echo $current_image ?>" alt=""
                                width="200px">
                        <?php } else {
                            echo "<div class='failed'>Image Not Added</div>";
                        } ?>

                    </td>

                </tr>
                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
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

                    <td> <a href="<?php echo HOMEURL ?>admin/manage-category.php" class='btn-danger link-no-deco'
                            style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #dc3545;"
                            onmouseover="this.style.backgroundColor='#ff6b7d'"
                            onmouseout="this.style.backgroundColor='#dc3545'">Cancel</a>

                    </td>

                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

            //Get data from form
            $id = $_POST["id"];
            $title = $_POST["title"];
            if (empty($_POST["title"])) {
                $_SESSION["no-title"] = "<div class='failed'>Please Enter Title</div>";
                header("Location:" . HOMEURL . "admin/update-category.php");
                die();
            } else {
                $title = $_POST["title"];
            }
            $current_image = $_POST["current_image"];
            $featued = $_POST["featured"];
            $active = $_POST["active"];

            //update new image if selected
            //check whetehr image is selected
            if (isset($_FILES["image"]["name"])) {
                
                $image_name =  $_FILES["image"]["name"];

                if ($image_name != "") {

                    //get the extension of image
                    //$ext=end(explode(".", $image_name));
                    $randomNumber = rand(0, 100);

                    $image_name = $randomNumber . $_FILES["image"]["name"];

                    $source_path = $_FILES["image"]["tmp_name"];
                    $destination_path = "../images/category/" . $image_name;


                    // upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not
                    //if not upload, stop the process and redirect with error message
                    if ($upload == false) {
                        $_SESSION["upload"] = "<div class='failed'>Failed to upload image</div>";
                        header("Location:" . HOMEURL . "admin/manage-category.php");
                        //stop the process
                        die();
                    }

                    //remove current image
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        //if fail to remove image, add error message and stop process
                        if ($remove == false) {
                            //set session message
                            $_SESSION["remove-image"] = "<div class='failed'>Fail to remove current image</div>";

                            //redirect to manage category page
                            header("Location:" . HOMEURL . "admin/manage-category.php");

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
                $update_query = "UPDATE tbl_category SET 
                        title=:title,
                        image_name=:image_name,
                        featured=:featured,
                        active=:active
                        WHERE id=$id;
                        ";
                $stmt = $pdo->prepare($update_query);

                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":image_name", $image_name);
                $stmt->bindParam(":featured", $featued);
                $stmt->bindParam("active", $active);
                $stmt->execute();
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header("Location:" . HOMEURL . "admin/manage-category.php");
                ob_end_flush();
                $pdo = null;
                $stmt = null;

            } catch (PDOException $e) {
                $_SESSION['update'] = "<div class='failed'>Category Updated Unccessfully</div>";
                header("Location:" . HOMEURL . "admin/manage-category.php");
                die($e->getMessage());
            }


        }


        ?>
    </div>


</div>