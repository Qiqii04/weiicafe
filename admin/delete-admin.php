<?php include ("partials/menu.php") ?>

<?php
//1. get the id of admin to be deleted
// 1. Get the ID from the URL (corrected):
$id = isset ($_GET["id"]) ? $_GET["id"] : null;


//2. Create SQL query to delete admin
try {
    $query = "DELETE FROM tbl_admin WHERE id=$id";

    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $stmt = null;
    $pdo = null;

    $_SESSION["delete"] = "<div class='success' >Delete admin Successfully</div>";
    //3. Redirect to manage admin page with message (success/ fail)
    header("Location:" . HOMEURL . "admin/manage-admin.php");
} catch (PDOException $e) {
    $_SESSION["delete"] = "<div class='failed'>Admin Delete Unsuccessfully </div>";
    die ("Query Error" . $e->getMessage());

}



?>