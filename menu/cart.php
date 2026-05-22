<?php include("partials-front/menu.php"); ?>

<?php
//Check whether food id is set
if (isset($_GET["food_id"])) {
    //Get the food
    $food_id = $_GET["food_id"];

    



    //Get the details of the selected food
    try {
        $query = "SELECT * FROM tbl_food WHERE id=$food_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $title = $result[0]["title"];
            $price = $result[0]["price"];
            $image_name = $result[0]["image_name"];


        } else {
            //food not available
            //redirect to homepage
            header("Location:" . HOMEURL);
        }
    } catch (PDOException $e) {
    }

} else {
    header("Location:" . HOMEURL);

}


?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your item.</h2>

        <form action="#" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name == "") {
                        echo "<div class='failed'>Image not available</div>";
                    } else {
                        ?>
                        <img src="../images/food/<?php echo $image_name ?>" alt="" class="img-responsive img-curve ">
                        <?php
                    }

                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3>
                        <?php echo $title ?>
                    </h3>
                    <input type="hidden" name="food_id" value="<?php echo $food_id ?>">
                    <p class="food-price">RM
                        <?php echo $price ?>
                    </p>


                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    <input type="submit" name="submit" value="Add to cart" class="btn btn-primary" style="background-color: #8B4513; transition: background-color 0.3s; padding: 12px 24px; font-size: 18px;" onmouseover="this.style.backgroundColor='#A0522D'" onmouseout="this.style.backgroundColor='#8B4513'">



                </div>

            </fieldset>

            

        </form>

        <?php

        //check if submit click
        if (isset($_POST["submit"])) {

            $qty = $_POST["qty"];
            $total = $price * $qty;
            //$order_date = date("Y-m-d h:i:sa");//order date
           
          
            //save the cart in database
            try {
                $orderQuery = "INSERT INTO tbl_cart(food_id,qty,total,customer_id,order_num) VALUES
                    (
                    :food_id,
                    :qty,
                    :total,
                    :customer_id,
                    :order_num
                    );

                    
                    }";
                $stmt2 = $pdo->prepare($orderQuery);
                $stmt2->bindParam(":food_id", $food_id);
                $stmt2->bindParam(":qty", $qty);
                $stmt2->bindParam(":total", $total);
                $stmt2->bindParam(":customer_id", $_SESSION['customer_id']);
                $stmt2->bindParam(":order_num", $_SESSION['order_num']);
               
                $stmt2->execute();
                $_SESSION['order'] = "<div class='success text-center'>Food Added to Cart. </div>";
                header("Location:" . HOMEURL . "menu/index.php");

            } catch (PDOException $e) {
                $_SESSION['order'] = "<div class='failed text-center'>Failed to Add </div>";

                die($e->getMessage());
            }


        }

        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- social Section Starts Here -->
<?php include("partials-front/footer.php")?>
<!-- social Section Ends Here -->



</body>

</html>