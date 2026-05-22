<?php include("partials-front/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        
    <?php
        //get the search food
        $search = $_POST["search"];
    ?>
        <h3><a href="<?php echo HOMEURL?>menu/index.php" class="text-white">Back</a></h3>
        <br>
        <h2>Foods on Your Search: <br>  <p  class="text-white"><?php echo $search ?></p></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        //get the search food
        $search = $_POST["search"];



        try {

            $query = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $stmt = $pdo->prepare($query);

            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $id = $row["id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $image_name = $row["image_name"]

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
                            <p class="food-price">
                                RM <?php echo $price ?>
                            </p>
                            <p class="food-detail">
                                <?php echo $description ?>
                            </p>
                            <br>

                            <a href="<?php echo HOMEURL; ?>menu/cart.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>


                    <?php



                }


            } else {
                echo "<div class='failed'>Food Not Found </div>";

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
<?php include("partials-front/footer.php")?>
<!-- social Section Ends Here -->

<!-- footer Section Starts Here -->
<section class="footer">

</section>
<!-- footer Section Ends Here -->

</body>

</html>