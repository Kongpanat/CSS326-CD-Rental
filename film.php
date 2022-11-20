<?php require_once('connect.php'); 
	session_start();
	//$user_id = $_SESSION['user_id'];
	if(isset($_SESSION['admin_id'])){
		$admin_id = $_SESSION['admin_id'];
	}
	if(isset($_GET['title'])){
		$title=$_GET['title'];
		//echo $title;
	}else{
		echo "Can not see title";
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
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <span class="lnr lnr-moon"></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header"
                    aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
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
                        <li class="nav-item">
                            <a class="nav-link" href="inventory.php">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Logout</a>
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
								$select= mysqli_query($mysqli, "SELECT * FROM film, film_genre WHERE film.title='$title' AND film.film_id=film_genre.film_id")or die('query faied');
								if(mysqli_num_rows($select)>0){
									$fetch = mysqli_fetch_assoc($select);
									$film_id=$fetch['film_id'];
								}
							?>
								<p><strong>Film Title: <?php echo $fetch['title']?> </strong></p>
								<p><strong>Release year: <?php echo $fetch['release_year']?> </strong></p>
								<p><strong>Genre: <?php echo $fetch['genre_name']?> </strong></p>
								<p><strong>Length: <?php echo $fetch['length']?> mins</strong></p>
								<p><strong>Rating: <?php echo $fetch['rating']?> stars</strong></p>
								<p><strong>Rental Rate: <?php echo $fetch['rental_rate']?> $/ days</strong></p>
								<!--<p>Consectetur adipisicing elit. Sint, corrupti deleniti, rem mollitia quam cum
									quo, animi
									ipsa praesentium officiis ducimus! Modi aperiam, nulla ipsum, totam natus
									consequuntur
									fugiat blanditiis.
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste harum, ut
									magni
									cupiditate. Nihil ipsum debitis voluptates voluptate illum consectetur
									sapiente dolorem
								</p> -->
								<br>
								<div class="col-md-8 offset-md-2 contact-form-holder mt-4">
									<div class="col-md-12 form-input">
										<select class="form-control" id="duration" name="duration">
											<option value="" disabled selected>Rent Duration</option>
											<!--Do php-->
											<?php
												$q="SELECT * FROM film WHERE film.title='$title' ";
												$result=$mysqli->query($q);
												$sel = mysqli_query($mysqli, "SELECT * FROM film WHERE film.title='$title'") or die('query failed');
												if(mysqli_num_rows($sel)>0){
													$row = mysqli_fetch_assoc($sel);
													$_SESSION['film_id']=$row['film_id'];
												}
												if(!$result){
													echo "Select failed. Error: ".$mysqli->error ;
													return false;
												}
												while($row=$result->fetch_array()){
											?>
											<option value="<?=$row['rental_duration']?>"><?=$row['rental_duration']?></option>
											<?php }	?>
										</select>
									</div>
									<br>
									<div class="col-md-12 form-input">
										<input type="number" class="form-control" id="amount" name="amount"
											placeholder="Amount">
									</div>
									<!--<form method="post" name="calc" action="">
										<div class="col-md-12 form-btn text-center">
											<button name="cal" value="Total cost"></button>
										</div>
									</form>-->
									<!--<div class="col-md-12 form-btn text-center">
                                        <input class="btn btn-block btn-secondary btn-red" type="submit" name="submit1" value="<?$title?>">
                                    </div>-->
									<?php 
											$title=$title;
										?>
									<!--Cost<h5 style="margin-left: 1em;">Total cost: <?=$x?> $</h5>->
												
									<br>
									<!--<input type="text" name="title" value = >-->
									<div class="col-md-12 form-btn text-center">
										<input class="btn btn-block btn-secondary btn-red" type="submit" name="add" value="ADD TO INVENTORY">
									</div>
									<br>
									
								</div>
							</div>
							<!-- End of film content Holder -->
						</div>
					</form>
								<?php if (isset($admin_id) ) : ?>
											<td><a href='film_edit.php?film_id=<?=$film_id?>'><button class="btn btn-block btn-secondary btn-red" name="edit">
                                               Edit
                                        </button></a></td>
										<?php endif ?>
                </div>
            </div>
        </section>
        <!-- End of Form Section -->

        <footer class="mastfoot mb-3 bg-white py-4 border-top">
            <div class="inner container">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                        <p class="mb-0">&copy; 2019 Moon. All Right Reserved. Design by <a
                                href="https://gettemplates.co" target="_blank">GetTemplates.co</a>.</p>
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