<?php include ("partials-front/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Order History</h1>


        <br>
        <!-- Button to add admin -->
        <a href="<?php echo HOMEURL; ?>menu/view-cart.php" class=" link-no-deco">Back to Cart</a>
        

        <br><br>

        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Image</th>
                    
                </tr>

                <?php
                try {
                    $customer_id = $_SESSION['customer_id'];
                    $query = "SELECT c.id,f.title,f.price,c.qty,c.total,f.image_name
                          FROM tbl_cart as c
                          INNER JOIN tbl_food as f
                          ON c.food_id = f.id
                          INNER JOIN tbl_customer as cus
                          ON cus.id = c.customer_id
                          
                          WHERE c.customer_id = $customer_id and c.submit =1 and c.cart_status = 'Unpaid' and c.cart_status!='Cancelled'
                            ";
                    $sum_query = "SELECT SUM(total) as total
                            FROM tbl_cart
                            WHERE customer_id = $customer_id and cart_status ='Unpaid' and submit=1";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    $stmt2 = $pdo->prepare($sum_query);
                    $stmt2->execute();

                    //check if the value exist
                    $sum_count = $stmt2->rowCount();
                    if ($sum_count > 0) {
                        $sum_result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        $order_total = $sum_result[0]['total'];

                    }

                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $number = 1;
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $number++ ?>
                                </td>
                                <td>
                                    <?php echo $row["title"] ?>
                                </td>
                                <td>
                                    <?php echo $row["price"] ?>
                                </td>
                                <td>
                                    <?php echo $row["qty"] ?>
                                </td>
                                <td>
                                    <?php echo $row["total"] ?>
                                </td>
                                <td>
                                    <?php
                                    //check whether image name is available
                                    if ($row["image_name"] != "") {
                                        //display the image 
                                        ?>
                                        <img src="<?php echo HOMEURL; ?>images/food/<?php echo $row["image_name"] ?>" alt=""
                                            width="100px">

                                        <?php
                                    } else {
                                        //display the message
                                        echo "<div class='failed'>Image Unavailable</div>";
                                    }
                                    ?>

                                </td>

                              

                            </tr>




                            <?php

                        }
                        ?>

                        <tr>
                            <td colspan='3'>Total</td>
                            <td>RM </td>
                            <td>
                                <?php echo $order_total ?>
                            </td>

                        </tr>
                        <tr>
                            <td colspan='6'><small>Please pay at counter</small></td>
                        </tr>
                       

                        <?php

                    } else {
                        //no data in database
                        //display message in table
                        ?>
                        <tr>
                            <td colspan="7">
                                <div class="failed">Your Active Order Is Empty</div>
                            </td>
                        </tr>

                        <?php

                    }
                } catch (PDOException $e) {
                    die ("Query Error " . $e->getMessage());
                }

                ?>


            </table>

        </form>


        
    </div>
</div>

</div>