<?php include ("partials/menu.php");
ob_start(); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Item</h1>

        <br><br>

        <?php
        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];//display session message
            unset($_SESSION["upload"]);//remove session message
        }

        ?>

        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title*</td>
                    <td>
                    <small>
                            <?php
                            if (isset($_SESSION["item-title"])) {
                                echo $_SESSION["item-title"];//display session message
                                unset($_SESSION["item-title"]);//remove session message
                            } ?>

                        </small><input type="text" name="title" placeholder="Food Name" required></td>
                </tr>

                <tr>
                    <td>Price*</td>

                    <td>
                        <small>
                            <?php
                            if (isset($_SESSION["price"])) {
                                echo $_SESSION["price"];//display session message
                                unset($_SESSION["price"]);//remove session message
                            } ?>

                        </small><input type="number" name="price" step='0.01' placeholder="RM" required>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="food_description" cols="22" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>



                <tr>

                    <td>Category*</td>
                    <td><small>
                            <?php
                            if (isset($_SESSION["category"])) {
                                echo $_SESSION["category"];//display session message
                                unset($_SESSION["category"]);//remove session message
                            } ?>

                        </small>
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
                                        $id = $row["id"];
                                        $title = $row["title"];
                                        ?>
                                        <option value="<?php echo $id ?>">
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
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Item Available</td>
                    <td><input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>

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
            $title = $_POST["title"];
            if ($_POST["title"] =="") {
                $_SESSION["item-title"] = "<div class='failed'>Please Enter Title</div>";
                header("Location:" . HOMEURL . "admin/add-food.php");
                die();
            }
            $description = $_POST["food_description"];
            $price = $_POST["price"];
            if ($_POST["price"] < 0) {
                $_SESSION["price"] = "<div class='failed'>Please Enter Valid Price</div>";
                header("Location:" . HOMEURL . "admin/add-food.php");
                die();
            }

            if ($_POST["category"] == "") {
                $_SESSION["category"] = "<div class='failed'>Please select category</div>";
                header("Location:" . HOMEURL . "admin/add-food.php");
                //stop the process
                die();
            }
            ;
            $category = $_POST["category"];
            //for radio input, check whether selected
            if (isset($_POST["featured"])) {
                $featured = $_POST["featured"];

            } else {
                //set default value if not select
                $featured = "No";
            }
            if (isset($_POST["active"])) {
                $active = $_POST["active"];

            } else {
                //set default value if not select
                $active = "No";
            }

            //true if the button press  even no image selected
            if (isset($_FILES['image']['name'])) {
                //save the image
                //to upload image, need image name, source path and destination
                $randomNumber = rand(0, 100);

                $image_name = $randomNumber.$_FILES["image"]["name"];

                //get the extension of image
                //$ext=end(explode(".", $image_name));
        
                //isset become true even no image select if open file explorer
                if ($image_name != "") {

                    //get the extension of image
                    //$ext=end(explode(".", $image_name));
        

                    $source_path = $_FILES["image"]["tmp_name"];
                    $destination_path = "../images/food/" . $image_name;


                    // upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not
                    //if not upload, stop the process and redirect with error message
                    if ($upload == false) {
                        $_SESSION["upload"] = "<div class='failed'>Failed to upload image</div>";
                        header("Location:" . HOMEURL . "admin/add-food.php");
                        //stop the process
                        die();
                    }
                }
            } else {
                $image_name = "";
            }


            try {
                $add_query = "INSERT INTO tbl_food (title,description,price,image_name,category_id,featured,active)VALUES
                ( :title,:description,:price,:image_name,:category_id,:featured,:active)";

                $stmt = $pdo->prepare($add_query);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":image_name", $image_name);
                $stmt->bindParam(":category_id", $category);
                $stmt->bindParam(":featured", $featured);
                $stmt->bindParam(":active", $active);

                $stmt->execute();

                $_SESSION['add-food'] = '<div class="success">Food Added Successfully</div>';
                header('Location:' . HOMEURL . 'admin/manage-food.php');
                ob_end_flush();
                $pdo = null;
                $stmt = null;

            } catch (PDOException $e) {
                $_SESSION['add-food'] = '<div class="failed">Food Added Unsuccessfully</div>';
                header('Location:' . HOMEURL . 'admin/manage-food.php');
                die("Query Error " . $e->getMessage());
            }

        }



        ?>
    </div>
</div>