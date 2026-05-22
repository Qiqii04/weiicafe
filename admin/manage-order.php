<?php include ("partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>


        <br>
        <?php
        if (isset ($_SESSION["update"])) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);

        }
        ?>
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Customer Name</th>
                <th>Order No.</th>
                <th>Total (RM)</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php

            try {
                //get all the orders details
                //select one latest order from same customer
                $query = "SELECT o.id, o.order_total, o.order_date, o.status, o.customer_id, o.order_num, c.name
                FROM tbl_order AS o
                INNER JOIN (
                  SELECT order_num, MAX(order_date) AS max_date
                  FROM tbl_order
                  GROUP BY order_num,customer_id
                ) AS latest_orders ON o.order_num = latest_orders.order_num
                AND o.order_date = latest_orders.max_date  -- Only include latest for each order_num
                INNER JOIN tbl_customer AS c ON o.customer_id = c.id
                ORDER BY o.order_num DESC;
                            ";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $count = $stmt->rowCount();
                if ($count > 0) {
                    //order available
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $number = 1;
                    foreach ($result as $row) {
                        $id = $row['id'];
                        $customer_name = $row['name'];
                        $customer_id = $row['customer_id'];

                        $total = $row["order_total"];
                        $order_date = $row["order_date"];
                        $order_num = $row["order_num"];

                        $status = $row["status"];

                        ?>
                        <tr>
                            <td>
                                <?php echo $number++; ?>
                            </td>

                            <td>
                                <?php echo $customer_name; ?>
                            </td>
                            <td>
                                <?php echo $order_num; ?>
                            </td>
                            <td>
                                <?php echo $total ?>
                            </td>
                            <td>
                                <?php echo $order_date ?>
                            </td>
                            <td>
                                <?php
                                if ($status == "Ordered") {
                                    echo "<label style='color:green'>$status</label>";
                                } else if ($status == "Paid") {
                                    echo "<label style='color:blue'>$status</label>";
                                } else if ($status == "Cancelled") {
                                    echo "<label style='color:red'>$status</label>";
                                }
                                ?>
                            </td>




                            <td>
                            <a href="<?php echo HOMEURL; ?>admin/update-order.php?id=<?php echo $id ?>&cus_id=<?php echo $customer_id ?>" class="btn-secondary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Update</a>

                            <a href="<?php echo HOMEURL; ?>admin/view-order-details.php?id=<?php echo $id ?>&order_num=<?php echo $order_num ?>&cus_id=<?php echo $customer_id ?>" class="btn-secondary link-no-deco" style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Order Details</a>


                            </td>


                        </tr>



                        <?php




                    }


                } else {
                    //no order
                    echo "<tr><td colspan='12' class='failed'>Order not Available</td></tr>";


                }

            } catch (PDOException $e) {

                die ($e->getMessage());

            }
            ?>


        </table>


    </div>
</div>

</div>