<?php include ("partials/menu.php");
ob_start(); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>


        <br>
        <!-- Button to add admin -->
        <a href="<?php echo HOMEURL; ?>admin/manage-order.php" class=" link-no-deco">Back</a>
        <br><br>
        <?php
        if (isset ($_GET['id'])) {
            $order_id = $_GET['id'];
            $cus_id = $_GET['cus_id'];

            ?>
            <form action="" method="POST">
                <table class="tbl-30">


                    <?php
                    try {
                        $customer_id = $_SESSION['customer_id'];
                        $query = "SELECT c.name,o.order_total,o.order_date,o.status
                        FROM tbl_order as o
                        JOIN tbl_customer as c
                        ON o.customer_id=c.id
                        WHERE o.id=$order_id
                            ";

                        $stmt = $pdo->prepare($query);
                        $stmt->execute();


                        //check if the value exist
                

                        $count = $stmt->rowCount();
                        if ($count > 0) {
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $number = 1;
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td>No.</td>
                                    <td>
                                        <?php echo $number++ ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Customer Name</td>
                                    <td>
                                        <?php echo $row["name"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total (RM)</td>
                                    <td>
                                        <?php echo $row["order_total"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td>
                                        <?php echo $row["order_date"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <select name="status">
                                            <option <?php if ($row['status'] == 'Ordered') {
                                                echo "selected";
                                            }
                                            ?> value="Ordered">Ordered
                                            </option>
                                            <option <?php if ($row['status'] == 'Paid') {
                                                echo "selected";
                                            }
                                            ?> value="Paid">Paid
                                            </option>
                                            <option <?php if ($row['status'] == 'Cancelled') {
                                                echo "selected";
                                            }
                                            ?> value="Cancelled">
                                                Cancelled
                                            </option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <input type="hidden" name="id" value="<?php echo $order_id; ?>">
                                        <input type="hidden" name="date" value="<?php echo $row['order_date']; ?>">

                                        <input type="submit" name="submit" value="Save" class='btn-secondary' style="padding: 12px 24px; font-size: 18px; border-radius: 8px; border: none; transition: opacity 0.3s; background-color: #007bff;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">

                                    </td>
                                </tr>









                                <?php

                            }
                            ?>




                            <?php

                        } else {
                            //no data in database
                            //display message in table
                            ?>
                            <tr>
                                <td colspan="5">
                                    <div class="failed">Empty</div>
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


        } else {
            header("Location: " . HOMEURL . "admin/manage-order.php");

        }

        ?>






    </div>
</div>

</div>


<?php
if (isset ($_POST['submit']) and $_SERVER["REQUEST_METHOD"] == "POST") {

    $status = $_POST['status'];
    $id = $_POST['id'];
    $order_date = $_POST['date'];

    try {
        $update_query = "UPDATE tbl_order SET
                         
                         status='$status',
                         order_date='$order_date'
                         
                         
                         WHERE id=$id
                            ";

        $stmt2 = $pdo->prepare($update_query);
        $stmt2->execute();
        if ($status == "Paid" or $status =="Cancelled") {
            
            $update_cart_status_query = "UPDATE tbl_cart SET
            cart_status='$status'
            WHERE customer_id=$cus_id
            "
            ;
            $update_stmt = $pdo->prepare($update_cart_status_query);
            $update_stmt->execute();

            $_SESSION['order_num'] += 1;
            $current_order_num = $_SESSION['order_num'];
           

            $update_cus_order_num = "UPDATE tbl_customer SET
            order_num='$current_order_num'
            WHERE id=$cus_id";

            $update_cus_order_num_stmt = $pdo->prepare($update_cus_order_num);
            $update_cus_order_num_stmt->execute();
        }

        $stmt2 = null;
        $pdo = null;
        $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
       header("Location:" . HOMEURL . "admin/update-order.php");
        ob_end_flush();
        die();



    } catch (PDOException $e) {
        $_SESSION['update'] = "<div class='failed'>Order Updated Unccessfully</div>";
        header("Location:" . HOMEURL . "admin/manage-order.php");
        die ($e->getMessage());
    }
}





?>