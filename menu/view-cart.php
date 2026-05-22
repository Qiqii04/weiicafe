<?php include ("partials-front/menu.php");
ob_start();

?>
<div class="main-content">
    <div class="wrapper">
        <h1>View Cart</h1>


        <br>
        <!-- Button to add admin -->
        <a href="<?php echo HOMEURL; ?>menu/foods.php" class=" link-no-deco">Add More |</i></a>
        <a href="<?php echo HOMEURL; ?>menu/history.php" class=" link-no-deco">View Order History</i></a>

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
                    <th>Actions</th>
                </tr>

                <?php
                try {
                    $customer_id = $_SESSION['customer_id'];
                    $query = "SELECT c.id,f.title,f.price,c.qty,c.total,c.order_num,f.image_name
                          FROM tbl_cart as c
                          JOIN tbl_food as f
                          ON c.food_id = f.id
                          JOIN tbl_customer as cus
                          ON cus.id = c.customer_id
                          WHERE c.customer_id = $customer_id and c.submit != 1
                            ";
                    $sum_query = "SELECT SUM(total) as total
                            FROM tbl_cart
                          WHERE customer_id = $customer_id and cart_status ='Unpaid'
                            "
                    ;
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
                        $current_order_total = 0;
                        foreach ($result as $row) {
                            $current_order_total += $row['total'];
                            $order_num=$row['order_num'];
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

                                <td>

                                    <a href="<?php echo HOMEURL ?>menu/delete-cart.php?id=<?php echo $row['id'] ?>" btn-danger
                                        link-no-deco>Delete</a>
                                </td>

                            </tr>




                            <?php

                        }
                        ?>

                        <tr>
                            <td colspan='3'>Total</td>
                            <td>RM </td>
                            <td>
                                <?php echo $current_order_total ?>
                            </td>

                        </tr>
                        <tr>
                            <td colspan='6'>



                            </td>
                            <td>
                                <input type="hidden" name="order_num" value="<?php echo $order_num; ?>">
                                <input type="submit" name="submit" value="Add to Order" class="btn btn-primary" style="padding: 12px 24px; font-size: 18px; transition: background-color 0.3s; background-color: #8B4513; border: none;" onmouseover="this.style.backgroundColor='#A0522D'" onmouseout="this.style.backgroundColor='#8B4513'">

                            </td>
                        </tr>

                        <?php

                    } else {
                        //no data in database
                        //display message in table
                        ?>
                        <tr>
                            <td colspan="7">
                                <div class="failed">Your Cart Is Empty</div>
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


        <?php
        if (isset ($_POST['submit'])) {
            try {

                $insert_query = "INSERT INTO tbl_order(order_total,order_date,status,customer_id,order_num) VALUES
                    (
                        :order_total,
                        :order_date,
                        :status,
                        :customer_id,
                        :order_num
                    
                    )";
                $status = 'Ordered';
                $order_total_submit = $order_total;
                $customer_order_id = $customer_id;
                $order_date = date("Y-m-d H:i:s");
                $order_num=$_POST['order_num'];

                $stmt = $pdo->prepare($insert_query);
                $stmt->bindParam(':order_total', $order_total_submit);
                $stmt->bindParam(':order_date', $order_date);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':customer_id', $customer_order_id);
                $stmt->bindParam(':order_num', $order_num);

                $stmt->execute();

                $update_cart_submit_status_query = "UPDATE tbl_cart SET
                                                    submit=1
                                                    WHERE customer_id = $customer_order_id"
                                                    ;
                $update_stmt = $pdo->prepare($update_cart_submit_status_query);
                $update_stmt->execute();

                



                header("Location:" . HOMEURL . "menu/view-cart.php");
                ob_end_flush();


            } catch (PDOException $e) {
                die ($e->getMessage());
            }

        }


        ?>

    </div>
</div>

</div>