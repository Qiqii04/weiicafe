<?php include ("partials/menu.php") ?>




<!-- Main Section Starts -->
<div class="main-content">


    <div class="wrapper">
    <a href="<?php echo HOMEURL?>index.php" class="link-no-deco">Back To Customer Site</a>
    <br><br>
        <h1> <strong>Dashboard</strong></h1>

        <br>

        <?php
        if (isset ($_SESSION["admin-login"])) {
            echo $_SESSION["admin-login"];
            unset($_SESSION["admin-login"]);

        }
        ?>
        <br>
        
        <div class="col-4 text-center">
            <?php
            $category_query = "SELECT * 
                                FROM tbl_category";
            $category_stmt = $pdo->prepare($category_query);
            $category_stmt->execute();
            $count = $category_stmt->rowCount();

            ?>
            <h1>
                <?php echo $count ?>
            </h1>
            <br>
            Categories

        </div>
        <div class="col-4 text-center">
            <?php
            $item_query = "SELECT * 
                                FROM tbl_food";
            $item_stmt = $pdo->prepare($item_query);
            $item_stmt->execute();
            $count = $item_stmt->rowCount();

            ?>
            <h1>
                <?php echo $count ?>
            </h1>
            <br>
            Item

        </div>
        <div class="col-4 text-center">
            <?php
            $order_query = "SELECT o.id, o.order_total, o.order_date, o.status, o.customer_id, o.order_num, c.name
            FROM tbl_order AS o
            INNER JOIN tbl_customer AS c ON o.customer_id = c.id
            GROUP BY o.order_num,o.customer_id  -- Group rows by order_num";
            $order_stmt = $pdo->prepare($order_query);
            $order_stmt->execute();
            $count = $order_stmt->rowCount();

            ?>
            <h1>
                <?php echo $count ?>
            </h1>
            <br>
            Order

        </div>
        <div class="col-4 text-center">
            <?php
            $order_query = "SELECT SUM(o.order_total) AS total_amount
            FROM tbl_order AS o
            INNER JOIN (
              SELECT order_num, MAX(order_date) AS max_date
              FROM tbl_order
              GROUP BY order_num,customer_id
            ) AS latest_orders ON o.order_num = latest_orders.order_num
            AND o.order_date = latest_orders.max_date
            INNER JOIN tbl_customer AS c ON o.customer_id = c.id
            WHERE o.status != 'Cancelled';";
            $order_stmt = $pdo->prepare($order_query);
            $order_stmt->execute();
            $count = $order_stmt->fetchAll(PDO::FETCH_ASSOC);
            $total = $count[0]['total_amount'];

            ?>
            <h1>
                RM
                <?php echo $total ?>
            </h1>
            <br>
            Revenue
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper">
        <h1><strong>Not Sure How to Do?</strong></h1>
        <h3><strong>Check these videos out!</strong></h3>
        <br>
        <center>
        <div class="row">
            <div class="col-md-6">
                
                <iframe width="560" height="315" src="https://www.youtube.com/embed/sMMsUk8NEGE?si=lS2qfRV2kVSgS3n4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        
                </div>
            <div class="col-md-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/S_MTKaDOPqE?si=vCbv0u5X1tZlHj2u" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/G-mUBECg9ok?si=w9WqmVQeXVGiysiu" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/mEz_t4LA9Jc?si=nYaQUmzB1y6mQLaL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/a1CpuJVzaI4?si=LaW7uQe2-GuHVWht" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/_TcV0EfK5KU?si=0Csc26FG3QD_EZb5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        </center>
    </div>


</div>




<!-- Main Section Ends -->










</body>

</html>