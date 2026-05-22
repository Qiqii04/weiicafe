<?php include("partials-front/menu.php"); ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>



        <?php
        //create sql query to display category from database
        try {
            $query = "SELECT * FROM tbl_category WHERE  active='Yes'";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $id = $row["id"];
                    $title = $row["title"];
                    $image_name = $row["image_name"];

                    ?>

                    <a href="category-foods.php?id=<?php echo $id?>">
                        <div class="box-3 float-container">
                            <?php
                            //check image is available or not
                            if ($image_name == "") {
                                //dispaly message
                                echo "<div class='failed'>Image not available</div>";
                            } else {
                                ?>
                                <img src="../images/category/<?php echo $image_name ?>" alt="Pizza" style="width: 300px; height: 250px;"
                                    class="img-responsive img-curve">
                                <?php
                            } ?>

                            <h3 class=""><?php echo $title?></h3>
                        </div>
                    </a>
                   

                    <?php

                }
            } else {
                echo "<div class='failed'>Category Not Added</div>";



            }
        } catch (PDOException $e) {
            die("Query Error " . $e->getMessage());
        }

        ?>

        







        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<!-- social Section Starts Here -->
<?php include("partials-front/footer.php")?>
<!-- social Section Ends Here -->



</body>

</html>