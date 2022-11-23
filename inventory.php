<?php require_once('connect.php');
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory</title>
    <meta name="description" content="Core HTML Project">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- External CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/lightcase/lightcase.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://file.myfontastic.com/7vRKgqrN3iFEnLHuqYhYuL/icons.css" rel="stylesheet">

    <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

</head>

<body data-spy="scroll" data-target="#navbar-nav-header" class="static-layout">
    <div class="boxed-page">
        <!--Start Header-->
        <nav id="gtco-header-navbar" class="navbar navbar-expand-lg py-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="home.php">
                    <span class="lnr lnr-moon"></span>
                </a>
                <!--Menu Button-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="lnr lnr-menu"></span>
                </button>
                <!--End Menu Button-->
                <!--Hidden Menu-->
                <div class="collapse navbar-collapse" id="navbar-nav-header">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <?php if (!isset($admin_id)) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="inventory.php">Inventory</a>
                            </li>
                        <?php endif ?>
                        <?php if (isset($admin_id)) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="add_film.php">Add Film</a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <!--End Hidden Menu-->
            </div>
        </nav>
        <!--End Header-->

        <section id="gtco-contact-form" class="bg-white">
            <div class="container">
                <div class="section-content">
                    <!-- Section Title -->
                    <div class="title-wrap">
                        <h1 class="display-2 mb-4">Inventory</h1><br>
                    </div>
                    <!-- End of Section Title -->
                    <div class="row">
                        <!-- Contact Form Holder -->
                        <div class="col-md-8 offset-md-2 contact-form-holder mt-4">
                            <form method="post" name="login-form" action="">
                                <div class="row">
                                    <div class="col-md-12 form-input">
                                        <!--Begin Table-->
                                        <table style="text-align: center; border-collapse: collapse; border: 1px solid black; table-layout: fixed; width: 100%;">
                                            <tr>
                                                <th style="border: 1px solid black">Title</th>
                                                <th style="border: 1px solid black">Rent Date</th>
                                                <th style="border: 1px solid black">Return date</th>
                                                <th style="border: 1px solid black">Amount</th>
                                                <th style="border: 1px solid black">Rental Rate</th>
                                                <th style="border: 1px solid black">Price</th>
                                                <th style="border: 1px solid black">Del</th>
                                            </tr>
                                            <!--Do php in tr-->
                                            <?php
											//select title(film),rental date(rental),return date(rental), amount(rental), rental_rate(film), total_pay(payment)
                                            $select = mysqli_query($mysqli, "SELECT * FROM film,rental,payment WHERE rental.customer_id='$user_id'
											AND payment.customer_id='$user_id' AND payment.rental_id=rental.rental_id AND film.inventory_id=rental.inventory_id ORDER BY rental.return_date") or die('query failed');
											
											while ($row = $select->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <td><?= $row['title'] ?></td>
                                                    <td><?= $row['rental_date'] ?></td>
                                                    <td><?= $row['return_date'] ?></td>
                                                    <td><?= $row['amount'] ?></td>
                                                    <td><?= $row['rental_rate'] ?> / days</td>
                                                    <td><?= $row['total_pay']?></td>
                                                    <td><a href='del_inventory.php?rental_id=<?= $row['rental_id'] ?>'>Remove</a></td>
                                                </tr>
                                            <?php    }    ?>
                                        </table>
                                        <!--End Table-->
                                        <?php
										//Total Cost
                                        $stmt = mysqli_query($mysqli,    "SELECT SUM(total_pay) AS value_sum FROM payment 
											WHERE customer_id='$user_id'");
                                        $row = $stmt->fetch_array();
                                        $sum = $row['value_sum'];
                                        echo '<div style="text-align: justify; text-align-last: right">Total Cost: $' . $sum. '</div>';?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Start Footer-->
        <footer class="mastfoot mb-3 bg-white py-4 border-top">
            <div class="inner container">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                        <p class="mb-0">Project CSS326 Movie Rental System</p>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer-->
    </div>

    <!-- External JS -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script src="vendor/bootstrap/popper.min.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js "></script>
    <script src="vendor/owlcarousel/owl.carousel.min.js"></script>
    <script src="vendor/isotope/isotope.min.js"></script>
    <script src="vendor/lightcase/lightcase.js"></script>
    <script src="vendor/waypoints/waypoint.min.js"></script>
    <script src="vendor/countTo/jquery.countTo.js"></script>

    <!-- Main JS -->
    <script src="js/app.min.js "></script>
    <script src="//localhost:35729/livereload.js"></script>
</body>

</html>