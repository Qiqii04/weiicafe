<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION["no-title"])) {
            echo $_SESSION["no-title"];//display session message
            unset($_SESSION["no-title"]);//remove session message
        }
        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];//display session message
            unset($_SESSION["upload"]);//remove session message
        }
        ?>
        <br><br>

        <!-- Add Category Form starts -->
        <!-- enables file uploads in HTML forms -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title*</td>
                    <td><input type="text" name="title" placeholder="Enter Category Title" required></td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
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
                    <td><input type="submit" name="submit" value="Add Category" class="btn-secondary" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'"></td>
                    <td> 
                    <a href="<?php echo HOMEURL ?>admin/manage-category.php" class='btn-danger link-no-deco' style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: background-color 0.3s; background-color: #dc3545;" onmouseover="this.style.backgroundColor='#ff6b7d'" onmouseout="this.style.backgroundColor='#dc3545'">Cancel</a>

                    </td>
                </tr>
            </table>


        </form>




    </div>

</div>


<?php
//Check whether the submit is click
if (isset($_POST["submit"]) and $_SERVER["REQUEST_METHOD"] == "POST") {

    //get the value from form
    if (empty($_POST["title"])) {
        $_SESSION["no-title"] = "<div class='failed'>Please Enter Title</div>";
        header("Location:" . HOMEURL . "admin/add-category.php");
        die();
    } else {
        $title = $_POST["title"];
    }

    //check whether image is selected and set the value for image
    //true if the button press  even no image selected

    if (isset($_FILES["image"]["name"])) {
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
            $destination_path = "../images/category/" . $image_name;


            // upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or not
            //if not upload, stop the process and redirect with error message
            if ($upload == false) {
                $_SESSION["upload"] = "<div class='failed'>Failed to upload image</div>";
                header("Location:" . HOMEURL . "admin/add-category.php");
                //stop the process
                die();
            }
        }

    } else {
        //dont upload image and set as blank

        $image = "";
    }

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

    try {
        $query = "INSERT INTO tbl_category (title,image_name,featured,active) VALUES (:title,:image_name,:featured,:active)";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":image_name", $image_name);
        $stmt->bindParam(":featured", $featured);
        $stmt->bindParam(":active", $active);
        $stmt->execute();


        $pdo = null;
        $stmt = null;

        $_SESSION["add"] = "<div class='success'>Category Added Successfully</div> ";
        header("Location:" . HOMEURL . "admin/manage-category.php");


    } catch (PDOException $e) {
        die("Query Error " . $e->getMessage());
    }


}



?>