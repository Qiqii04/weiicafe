<?php include ("../includes/dbh-inc.php"); ?>
<?php include ("client-partials/customer-login-check.php") ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/customer-login.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>



</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar2">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/weiiLogo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                    <a href="<?php echo HOMEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo HOMEURL; ?>menu/index.php">Main Menu</a>
                    </li>
                   
                    <li>
                        <a href="<?php echo HOMEURL; ?>menu/categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo HOMEURL; ?>menu/foods.php">Foods</a>
                    </li>
                   
                    <li>
                        <a href="<?php echo HOMEURL; ?>menu/view-cart.php"><i class='bx bx-cart' style="font-size: 2em;"></i></a>
                    </li>
                    <li class="customer-dropdown">
                        <?php if (isset ($_SESSION['customer'])): ?>
                            <span class="customer-name">
                                <?php echo $_SESSION['customer']; ?> <i class='bx bxs-down-arrow' ></i>
                            </span>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo HOMEURL; ?>menu/customer-logout.php">Logout</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo HOMEURL; ?>menu/customer-login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>