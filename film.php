<?php require_once('connect.php');
session_start();
//$user_id = $_SESSION['user_id'];
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}
if (isset($_GET['title'])) {
    $title = $_GET['title'];
    //echo $title;
} else {
    echo "Can not see title";
}
if (isset($_SESSION['film_id'])){
		unset($_SESSION['film_id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Film</title>
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
        <nav id="gtco-header-navbar" class="navbar navbar-expand-lg py-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="home.php">
                    <span class="lnr lnr-moon"></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="lnr lnr-menu"></span>
                </button>
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
            </div>
        </nav>

        <section id="gtco-contact-form" class="bg-white">
            <div class="container">
                <div class="section-content">
                    <!-- Section Title -->
                    <div class="title-wrap">
                        <h1 class="display-2 mb-4">Film Detail</h1><br>
                    </div>
                    <!-- Detail -->
                    <form method="post" action="filmbackend.php">
                        <div class="row">
                            <!-- film Content Holder -->
                            <div class="col-md-8 offset-md-2 mt-4">
                                <?php
                                $select = mysqli_query($mysqli, "SELECT * FROM film, film_genre WHERE film.title='$title' AND film.film_id=film_genre.film_id") or die('query faied');
                                if (mysqli_num_rows($select) > 0) {
                                    $fetch = mysqli_fetch_assoc($select);
                                    $film_id = $fetch['film_id'];
									$_SESSION['film_id']=$film_id;
                                }
                                ?>
                                <p><strong>Film Title: </strong><?php echo $fetch['title'] ?></p>
                                <p><strong>Release year: </strong><?php echo $fetch['release_year'] ?></p>
                                <p><strong>Genre: </strong><?php echo $fetch['genre_name'] ?></p>
                                <p><strong>Length: </strong><?php echo $fetch['length'] ?> mins</p>
                                <p><strong>Rating: </strong><?php echo $fetch['rating'] ?></p>
                                <p><strong>Rental Rate: </strong>$<?php echo $fetch['rental_rate'] ?> / day</p>
                                <br>
                                <p><strong>Description:</strong></p>
                                <?php echo "<p>".$fetch['detail']."</p>" ?>
                                <br>

                                <?php if (!isset($admin_id)) : ?>
                                    <div class="col-md-8 offset-md-2 contact-form-holder mt-4">
                                        <div class="col-md-12 form-input">
                                            <input type="number" class="form-control" id="duration" name="duration" placeholder="Rent Duration" min="1">
                                        </div>
                                        <div class="col-md-12 form-input">
                                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" min="1">
                                        </div>
                                        <div class="col-md-12 form-btn text-center">
                                            <input class="btn btn-block btn-secondary btn-red" type="submit" name="add" value="ADD TO INVENTORY">
                                        </div>
                                    </div>
                                <?php endif ?>
                                <br>
                            </div>
                            <!-- End of film content Holder -->
                        </div>
                    </form>
                    <form method="post" action="film_edit.php?film_id=<?= $film_id ?>">
                    <?php if (isset($admin_id)) : ?>
                            <div class="col-md-8 offset-md-2 contact-form-holder mt-4">
                                <div class="col-md-12 form-btn text-center">
                                    <button class="btn btn-block btn-secondary btn-red" name="edit">EDIT</button>
                                </div>
                            </div>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </section>
        <!-- End of Form Section -->

        <footer class="mastfoot mb-3 bg-white py-4 border-top">
            <div class="inner container">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                        <p class="mb-0">Project CSS326 Movie Rental System</p>
                    </div>
                </div>
            </div>
        </footer>
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