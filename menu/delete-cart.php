<?php include("partials-front/menu.php") ?>

<?php
//1. get the id of admin to be deleted
// 1. Get the ID from the URL (corrected):
$id = isset($_GET["id"]) ? $_GET["id"] : null;


//2. Create SQL query to delete admin
try{
 $query = "DELETE FROM tbl_cart WHERE id=$id";

 $stmt = $pdo->prepare($query);

 $stmt->execute();
 $stmt=null;
 $pdo=null;

 $_SESSION["delete-cart"] = "<div class='success' >Item removed from cart Successfully</div>";
 header("Location:".HOMEURL."menu/view-cart.php");
}catch(PDOException $e){
    $_SESSION["delete-cart"] = "<div class='failed'>Item Delete Unsuccessfully </div>";
    die("Query Error". $e->getMessage());

}




?>