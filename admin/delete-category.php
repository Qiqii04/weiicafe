<?php include("../includes/dbh-inc.php") ?>

<?php


//check whether id and image is passed
if (isset($_GET["id"]) and isset($_GET["image_name"])) {
    $id = $_GET["id"];
    $image_name = $_GET["image_name"];

    //remove physical image file if available
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;

        //remove image from file
        $remove = unlink($path);

        //if fail to remove image, add error message and stop process
        if ($remove == false) {
            //set session message
            $_SESSION["remove-image"] = "<div class='failed'>Fail to remove image</div>";

            //redirect to manage category page
            header("Location:" . HOMEURL . "admin/manage-category.php");

            die();
        }


    }

    try {
        $query = "DELETE FROM tbl_category WHERE id=:id ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $_SESSION['delete-category'] = "<div class='success'>Category Deleted Successfully</div>";
        $pdo = null;
        $stmt = null;

        //redirect to manage category page
        header("Location:" . HOMEURL . "admin/manage-category.php");

    } catch (PDOException $e) {
        $_SESSION['delete-category'] = "<div class='failed'>Category Deleted Unsuccessfully</div>";
        die("Query error " . $e->getMessage());

    }

} else {
    //redirect to manage category page
    header("Location:" . HOMEURL . "admin/manage-category.php");
}