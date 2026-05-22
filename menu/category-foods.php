<?php include("partials-front/menu.php"); ?>

<?php
//check whether id is passed
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    try {
        $query = "SELECT title FROM tbl_category WHERE id = $category_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $category_title = $result[0]["title"];

    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    header('Location: ' . HOMEURL . 'index.php');
}


?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">
                <?php echo $category_title ?>
            </a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        try {
            $query2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute();
            $count = $stmt2->rowCount();
            if ($count > 0) {
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result2 as $row) {
                    $id= $row["id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $image_name = $row["image_name"];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='failed'>Image not available</div>";
                            } else {
                                ?>
                                <img src="../images/food/<?php echo $image_name ?>" alt="" class="img-responsive img-curve img-size">
                                <?php
                            } ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4>
                                <?php echo $title ?>
                            </h4>
                            <p class="food-price">RM
                                <?php echo $price ?>
                            </p>
                            <p class="food-detail">
                                <?php echo $description ?>
                            </p>
                            <br>

                            <a href="<?php echo HOMEURL; ?>menu/cart.php?food_id=<?php echo $id; ?>" class="btn btn-primary" style="padding: 12px 24px; font-size: 18px; background-color: #8B4513; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#A0522D'" onmouseout="this.style.backgroundColor='#8B4513'">Add to Cart</a>

                        </div>
                    </div>



                    <?php

                }

            } else {
                echo "<div class='failed'>Food Not Available";
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }



        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->

<!-- footer Section Starts Here -->
<section class="footer">

</section>
<!-- footer Section Ends Here -->

</body>

</html>