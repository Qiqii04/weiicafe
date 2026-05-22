<?php include ('includes/dbh-inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weii Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/client.css">
    <link rel="stylesheet" href="../css/customer-login.css">
    <link rel="icon" href="" type="image/x-icon">

    <style>
    .nav-link {
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -5px;
        width: 8px;
        height: 8px;
        background-color: red;
        border-radius: 50%;
        transform: translate(50%, -50%);
        display: none; /* Initially hide the dot */
    }

    /* Show the dot when the link is active */
    .nav-link.active::after {
        display: block;
    }
</style>


</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg bg-white fixed-top py-3">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="index.php">
                <img src="img/weiicafe_logo.png" alt="Logo" width="80" height="50"
                    class="d-inline-block align-text-top me-2">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link px-lg-4 rounded" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-lg-4 rounded" href="ourstory.php">Our Story</a>
                    </li>
              
                    <li class="nav-item">
                        <a class="nav-link px-lg-4 rounded" href="<?php echo HOMEURL ?>menu">Order Now</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-lg-4 rounded active" href="index_reservation.php">Reservations</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link px-lg-4 rounded" href="news.php">Announcement</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-lg-4 rounded" href="rating.php">Review</a>
                    </li>
                    
                

                    
                    <li class="nav-item">
                        <a class="nav-link px-lg-4 rounded" href="<?php echo HOMEURL ?>admin/login.php">Staff Portal</a>
                    </li>
                </ul>



                <!-- profile icon and button -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"></path>
                  </svg> -->
                        <?php if (isset ($_SESSION['customer'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-lg-4 rounded" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['customer']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo HOMEURL; ?>menu/customer-logout.php">Logout</a></li>

                            </ul>
                        </li>
                    <?php else: ?>
                        <a href="<?php echo HOMEURL; ?>menu/customer-login.php">Login</a>
                    <?php endif; ?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>